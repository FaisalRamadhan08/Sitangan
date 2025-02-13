<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_aktivitas;
use App\Models\M_potensial_domestik;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Master_potensial_domestik extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->potensialDomestikModel = new M_potensial_domestik($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }

    public function index()
    {
        return view('data/v_potensial_domestik');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->potensialDomestikModel->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->potensialDomestikModel->where('id', $list->id);
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
                $row[] = $list->pbp_domestik;
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
                'recordsTotal' => $this->potensialDomestikModel->countAll(),
                'recordsFiltered' => $this->potensialDomestikModel->countFiltered(),
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
        $data['row'] = $this->potensialDomestikModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW PARAMETER ==========================================
    // ==================== START: FUNGSI DELETED ================================================
    public function deleted()
    {
        $id = $this->request->getGet('id');
        $this->potensialDomestikModel->delete($id);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengapus data potensial domestik',
            'aksi' => 'delete',
        );
        $this->AktivitasModel->save($logAktivitas);
        return $this->response->setJSON(['success' => true]);
    }
    // ==================== END: FUNGSI DELETED ===================================================

    // ==================== START: FUNGSI EKSPORT  ===================================================
    public function eksport()
    {
        $potensialDomestik = $this->potensialDomestikModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Das');
        $sheet->setCellValue('C1', 'Titik Pantau');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Jumlah Penduduk');
        $sheet->setCellValue('F1', 'Faktor Emisi');
        $sheet->setCellValue('G1', 'Rasio Ekivalen Kota');
        $sheet->setCellValue('H1', 'Koefisien Transfer Beban');
        $sheet->setCellValue('I1', 'Faktor Konversi');
        $sheet->setCellValue('J1', 'Nilai Alpha');
        $sheet->setCellValue('K1', 'PBP Domestik');
        $rows = 2;
        $No = 1;
        foreach ($potensialDomestik as $val) {
            $sheet->setCellValue('A' . $rows, $No);
            $sheet->setCellValue('B' . $rows, $val['das']);
            $sheet->setCellValue('C' . $rows, $val['titik_pantau']);
            $sheet->setCellValue('D' . $rows, $val['created_at']);
            $sheet->setCellValue('E' . $rows, $val['jumlah_penduduk']);
            $sheet->setCellValue('F' . $rows, $val['faktor_emisi']);
            $sheet->setCellValue('G' . $rows, $val['rasio_ekivalen_kota']);
            $sheet->setCellValue('H' . $rows, $val['koefisien_transfer_beban']);
            $sheet->setCellValue('I' . $rows, $val['faktor_konversi']);
            $sheet->setCellValue('J' . $rows, $val['nilai_alpha']);
            $sheet->setCellValue('K' . $rows, $val['pbp_domestik']);
            $rows++;
            $No++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H:i:s') . '-Potensial Domestik';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'export excel data potensial domestik',
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
                'jumlah_penduduk' =>   $excel[3],
                'faktor_emisi' =>   $excel[4],
                'rasio_ekivalen_kota' =>  $excel[5],
                'koefisien_transfer_beban' =>   $excel[6],
                'faktor_konversi' =>  $excel[7],
                'nilai_alpha' =>   $excel[8],
                'pbp_domestik' =>   $excel[9],
            ];
            $this->potensialDomestikModel->save($data);
            $jumlahsukses++;;
        }
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'import excel data potensial domestik',
            'aksi' => 'import',
        );
        $this->AktivitasModel->save($logAktivitas);
        session()->setFlashdata('success', "$jumlahsukses data berhasil disimpan");
        return redirect()->to('/potensial_domestik');
    }
    // ==================== END: FUNGSI IMPORT  =====================================================

    // ==================== START: FUNGSI ADD  ======================================================
    public function add()
    {
        $session = session();
        $data = array(
            'das' => $this->request->getPost('das'),
            'titik_pantau' => $this->request->getPost('titik_pantau'),
            'jumlah_penduduk' => $this->request->getPost('jumlah_penduduk'),
            'faktor_emisi' => $this->request->getPost('faktor_emisi'),
            'rasio_ekivalen_kota' => $this->request->getPost('rasio_ekivalen_kota'),
            'koefisien_transfer_beban' => $this->request->getPost('koefisien_transfer_beban'),
            'faktor_konversi' => $this->request->getPost('faktor_konversi'),
            'nilai_alpha' => $this->request->getPost('nilai_alpha'),
            'pbp_domestik' => $this->request->getPost('pbp_domestik'),
        );
        $this->potensialDomestikModel->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'menambahkan data potensial domestik',
            'aksi' => 'create',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'Add data successfully!');
        return redirect()->to('/potensial_domestik');
    }
    // ==================== END: FUNGSI ADD  ========================================================

    // =================== START: FUNGSI SHOW UPDATE  ===============================
    public function show_updated()
    {
        $id = $this->request->getGet('id');
        $data['row'] = $this->potensialDomestikModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW UPDATE  ==================================
    
    // ==================== START: FUNGSI UPDATE  =====================================================
    public function update()
    {
        $session = session();
        $id = $this->request->getPost('id');
        $existingData =  $this->potensialDomestikModel->find($id);
        $data = array(
            'id' => $this->request->getPost('id'),
            'das' => $this->request->getPost('das'),
            'titik_pantau' => $this->request->getPost('titik_pantau'),
            'jumlah_penduduk' => $this->request->getPost('jumlah_penduduk'),
            'faktor_emisi' => $this->request->getPost('faktor_emisi'),
            'rasio_ekivalen_kota' => $this->request->getPost('rasio_ekivalen_kota'),
            'koefisien_transfer_beban' => $this->request->getPost('koefisien_transfer_beban'),
            'faktor_konversi' => $this->request->getPost('faktor_konversi'),
            'nilai_alpha' => $this->request->getPost('nilai_alpha'),
            'pbp_domestik' => $this->request->getPost('pbp_domestik'),
            'created_at' => $existingData['created_at'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->potensialDomestikModel->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengubah data potensial domestikdengan id ' . $this->request->getPost('id') . '',
            'aksi' => 'update',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'update data successfully!');
        return redirect()->to('/potensial_domestik');
    }
    // ==================== END: FUNGSI UPDATE  ========================================================
}
