<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_aktivitas;
use App\Models\M_potensial_peternakan;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Master_potensial_peternakan extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->potensialPeternakanModel = new M_potensial_peternakan($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }

    public function index()
    {
        return view('data/v_potensial_peternakan');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->potensialPeternakanModel->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->potensialPeternakanModel->where('id', $list->id);
                $no++;
                $row = [];
                $tombolAction = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-primary btn-air-primary mx-1 tampil_update_btn\" data-id=\"" . $list->id . "\" data-bs-toggle=\"modal\" data-bs-target=\"#updatedModal\"><i class='fa fa-edit'></i></a>
                    <a type=\"button\" class=\"btn btn-pill btn-danger btn-air-danger mx-1 deleted_btn\" data-id=\"" . $list->id . "\"><i class='fa fa-trash'></i></a>
                </div>";
                $row[] = $no;
                $row[] = $list->das;
                $row[] = $list->titik_pantau;
                $row[] = $list->pbp_peternakan;
                $row[] = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-primary-light btn-air-info mx-1 tampil_detail_btn\" data-id=\"" . $list->id . "\" data-bs-toggle=\"modal\" data-bs-target=\"#detailModal\"><i class='fa fa-eye'></i></a>
                </div>";
                $row[] = $list->created_at;
                $row[] = $tombolAction;
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->potensialPeternakanModel->countAll(),
                'recordsFiltered' => $this->potensialPeternakanModel->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
    // =================== END: FUNGSI AJAX LIST  ===============================================

    // =================== START: FUNGSI SHOW PARAMETER =========================================
    public function detail_parameter()
    {
        $id = $this->request->getGet('id');
        $data['row'] = $this->potensialPeternakanModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW PARAMETER ==========================================
    // ==================== START: FUNGSI DELETED ================================================
    public function deleted()
    {
        $id = $this->request->getGet('id');
        $this->potensialPeternakanModel->delete($id);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengapus data potensial peternakan',
            'aksi' => 'delete',
        );
        $this->AktivitasModel->save($logAktivitas);
        return $this->response->setJSON(['success' => true]);
    }
    // ==================== END: FUNGSI DELETED ===================================================

    // ==================== START: FUNGSI EKSPORT  ===================================================
    public function eksport()
    {
        $potensialPeternakan = $this->potensialPeternakanModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Das');
        $sheet->setCellValue('C1', 'Titik Pantau');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Jumlah Ternak');
        $sheet->setCellValue('F1', 'Jenis Perternakan');
        $sheet->setCellValue('G1', 'Nama Parameter');
        $sheet->setCellValue('H1', 'Faktor Emisi Limbah Perternakan');
        $sheet->setCellValue('I1', 'Persentase Limbah');
        $sheet->setCellValue('J1', 'Faktor Pengali');
        $sheet->setCellValue('K1', 'PBP Peternakan');
        $rows = 2;
        $No = 1;
        foreach ($potensialPeternakan as $val) {
            $sheet->setCellValue('A' . $rows, $No);
            $sheet->setCellValue('B' . $rows, $val['das']);
            $sheet->setCellValue('C' . $rows, $val['titik_pantau']);
            $sheet->setCellValue('D' . $rows, $val['created_at']);
            $sheet->setCellValue('E' . $rows, $val['jumlah_ternak']);
            $sheet->setCellValue('F' . $rows, $val['jenis_ternak']);
            $sheet->setCellValue('G' . $rows, $val['nama_parameter']);
            $sheet->setCellValue('H' . $rows, $val['faktor_emisi']);
            $sheet->setCellValue('I' . $rows, $val['persentase_limbah']);
            $sheet->setCellValue('J' . $rows, $val['faktor_pengali']);
            $sheet->setCellValue('K' . $rows, $val['pbp_peternakan']);
            $rows++;
            $No++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H:i:s') . '-Potensial Peternakan';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'export excel data potensial peternakan',
            'aksi' => 'export',
        );
        $this->AktivitasModel->save($logAktivitas);
    }
    // ==================== END: FUNGSI EKSPORT  =====================================================

    // ==================== START: FUNGSI IMPORT  ===================================================
    public function import()
    {
        $file_excel = $this->request->getFile('import_excel');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);
        $jumlahsukses = 0;
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        foreach ($sheetData as $s => $excel) {
            if ($s >= 0 && $s <= 8) {
                continue;
            }

            if ($excel[1] == null && $excel[2] == null) {
                break;
            }

            $data = [
                'das' => $excel[1],
                'titik_pantau' =>   $excel[2],
                'jumlah_ternak' =>   $excel[3],
                'jenis_ternak' =>   $excel[4],
                'nama_parameter' =>  $excel[5],
                'faktor_emisi' =>   $excel[6],
                'persentase_limbah' =>  $excel[7],
                'faktor_pengali' =>   $excel[8],
                'pbp_peternakan' =>   $excel[9],
            ];


            $this->potensialPeternakanModel->save($data);
            $jumlahsukses++;;
        }
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'import excel data potensial peternakan',
            'aksi' => 'import',
        );
        $this->AktivitasModel->save($logAktivitas);
        session()->setFlashdata('success', "$jumlahsukses data berhasil disimpan");
        return redirect()->to('/potensial_peternakan');
    }
    // ==================== END: FUNGSI IMPORT  =====================================================

    // ==================== START: FUNGSI ADD  ======================================================
    public function add()
    {
        $session = session();
        $data = array(
            'das' => $this->request->getPost('das'),
            'titik_pantau' => $this->request->getPost('titik_pantau'),
            'jumlah_ternak' => $this->request->getPost('jumlah_ternak'),
            'jenis_ternak' => $this->request->getPost('jenis_ternak'),
            'nama_parameter' => $this->request->getPost('nama_parameter'),
            'faktor_emisi' => $this->request->getPost('faktor_emisi'),
            'persentase_limbah' => $this->request->getPost('persentase_limbah'),
            'faktor_pengali' => $this->request->getPost('faktor_pengali'),
            'pbp_peternakan' => $this->request->getPost('pbp_peternakan'),
        );
        $this->potensialPeternakanModel->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'menambahkan data potensial peternakan',
            'aksi' => 'create',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'Add data successfully!');
        return redirect()->to('/potensial_peternakan');
    }
    // ==================== END: FUNGSI ADD  ========================================================

    // =================== START: FUNGSI SHOW UPDATE  ===============================
    public function show_updated()
    {
        $id = $this->request->getGet('id');
        $data['row'] = $this->potensialPeternakanModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW UPDATE  ==================================

    // ==================== START: FUNGSI UPDATE  =====================================================
    public function update()
    {
        $session = session();
        $id = $this->request->getPost('id');
        $existingData = $this->potensialPeternakanModel->find($id);
        $data = array(
            'id' => $this->request->getPost('id'),
            'das' => $this->request->getPost('das'),
            'titik_pantau' => $this->request->getPost('titik_pantau'),
            'jumlah_ternak' => $this->request->getPost('jumlah_ternak'),
            'jenis_ternak' => $this->request->getPost('jenis_ternak'),
            'nama_parameter' => $this->request->getPost('nama_parameter'),
            'faktor_emisi' => $this->request->getPost('faktor_emisi'),
            'persentase_limbah' => $this->request->getPost('persentase_limbah'),
            'faktor_pengali' => $this->request->getPost('faktor_pengali'),
            'pbp_peternakan' => $this->request->getPost('pbp_peternakan'),
            'created_at' => $existingData['created_at'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->potensialPeternakanModel->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengubah data potensial peternakan dengan id ' . $id . '',
            'aksi' => 'update',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'update data successfully!');
        return redirect()->to('/potensial_peternakan');
    }
    // ==================== END: FUNGSI UPDATE  ========================================================
}
