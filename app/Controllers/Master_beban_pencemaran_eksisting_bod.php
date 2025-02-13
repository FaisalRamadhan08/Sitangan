<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_aktivitas;
use App\Models\M_eksisting_bod;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Master_beban_pencemaran_eksisting_bod extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->EksistingBodModel = new M_eksisting_bod($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }

    public function index()
    {
        return view('data/v_beban_pencemaran_eksisting_bod');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->EksistingBodModel->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->EksistingBodModel->where('id', $list->id);
                $no++;
                $row = [];
                $tombolAction = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-primary btn-air-primary mx-1 tampil_update_btn\" data-id=\"" . $list->id . "\" data-bs-toggle=\"modal\" data-bs-target=\"#updatedModal\"><i class='fa fa-edit'></i></a>
                    <a type=\"button\" class=\"btn btn-pill btn-danger btn-air-danger mx-1 deleted_btn\" data-id=\"" . $list->id . "\"><i class='fa fa-trash'></i></a>
                </div>";
                $row[] = $no;
                $row[] = $list->nama_sungai;
                $row[] = $list->titik_pantau;
                $row[] = $list->dtbp;
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
                'recordsTotal' => $this->EksistingBodModel->countAll(),
                'recordsFiltered' => $this->EksistingBodModel->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
    // =================== END: FUNGSI AJAX LIST  ===============================================

    // =================== START: FUNGSI SHOW PARAMETER =========================================
    public function detail_parameter_eksisting_bod()
    {
        $id = $this->request->getGet('id');
        $data['row'] = $this->EksistingBodModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW PARAMETER ==========================================
    // ==================== START: FUNGSI DELETED ================================================
    public function deleted()
    {
        $id = $this->request->getGet('id');
        $this->EksistingBodModel->delete($id);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengapus data beban pencemaran eksisting bod',
            'aksi' => 'delete',
        );
        $this->AktivitasModel->save($logAktivitas);
        return $this->response->setJSON(['success' => true]);
    }
    // ==================== END: FUNGSI DELETED ===================================================

    // ==================== START: FUNGSI EKSPORT  ===================================================
    public function eksport()
    {
        $Eksisting_bod = $this->EksistingBodModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Nama Sungai');
        $sheet->setCellValue('C1', 'Titik Pantau');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Konsentrasi Baku Mutu Maksimum (mg/l)');
        $sheet->setCellValue('F1', 'Debit Air Sungai Maksimum (m³/detik)');
        $sheet->setCellValue('G1', 'Faktor-K Maksimum');
        $sheet->setCellValue('H1', 'Nilai BPM(kg/hari)');
        $sheet->setCellValue('I1', 'Konsentrasi Aktual (mg/l)');
        $sheet->setCellValue('J1', 'Debit Air Sungai Aktual(m³/detik)');
        $sheet->setCellValue('K1', 'Faktor-K Aktual');
        $sheet->setCellValue('L1', 'Nilai BPA(kg/hari)');
        $sheet->setCellValue('M1', 'Nilai DTBP(kg/hari)');
        $rows = 2;
        $No = 1;
        foreach ($Eksisting_bod as $val) {
            $sheet->setCellValue('A' . $rows, $No);
            $sheet->setCellValue('B' . $rows, $val['nama_sungai']);
            $sheet->setCellValue('C' . $rows, $val['titik_pantau']);
            $sheet->setCellValue('D' . $rows, $val['created_at']);
            $sheet->setCellValue('E' . $rows, $val['konsentrasi_baku_mutu_maksimum']);
            $sheet->setCellValue('F' . $rows, $val['debit_air_sungai_maksimum']);
            $sheet->setCellValue('G' . $rows, $val['faktor_k_maksimum']);
            $sheet->setCellValue('H' . $rows, $val['bpm']);
            $sheet->setCellValue('I' . $rows, $val['konsentrasi_aktual']);
            $sheet->setCellValue('J' . $rows, $val['debit_air_sungai_aktual']);
            $sheet->setCellValue('K' . $rows, $val['faktor_k_aktual']);
            $sheet->setCellValue('L' . $rows, $val['bpa']);
            $sheet->setCellValue('M' . $rows, $val['dtbp']);
            $rows++;
            $No++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H:i:s') . '-Beban Pencemaran Eksisting BOD';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'export excel data beban pencemaran eksisting bod',
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
                'nama_sungai' => $excel[1],
                'titik_pantau' =>   $excel[2],
                'konsentrasi_baku_mutu_maksimum' =>   $excel[3],
                'debit_air_sungai_maksimum' =>   $excel[4],
                'faktor_k_maksimum' =>  $excel[5],
                'bpm' =>   $excel[6],
                'konsentrasi_aktual' =>  $excel[7],
                'debit_air_sungai_aktual' =>   $excel[8],
                'faktor_k_aktual' =>   $excel[9],
                'bpa' =>   $excel[10],
                'dtbp' =>   $excel[11],
            ];
            $this->EksistingBodModel->save($data);
            $jumlahsukses++;;
        }
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'import excel data beban pencemaran eksisting bod',
            'aksi' => 'import',
        );
        $this->AktivitasModel->save($logAktivitas);
        session()->setFlashdata('success', "$jumlahsukses data berhasil disimpan");
        return redirect()->to('/beban_pencemaran_eksisting_bod');
    }
    // ==================== END: FUNGSI IMPORT  =====================================================

    // ==================== START: FUNGSI ADD  ======================================================
    public function add()
    {
        $session = session();
        $data = array(
            'nama_sungai' => $this->request->getPost('nama_sungai'),
            'titik_pantau' => $this->request->getPost('titik_pantau'),
            'konsentrasi_baku_mutu_maksimum' => $this->request->getPost('konsentrasi_baku_mutu_maksimum'),
            'debit_air_sungai_maksimum' => $this->request->getPost('debit_air_sungai_maksimum'),
            'faktor_k_maksimum' => $this->request->getPost('faktor_k_maksimum'),
            'bpm' => $this->request->getPost('bpm'),
            'konsentrasi_aktual' => $this->request->getPost('konsentrasi_aktual'),
            'debit_air_sungai_aktual' => $this->request->getPost('debit_air_sungai_aktual'),
            'faktor_k_aktual' => $this->request->getPost('faktor_k_aktual'),
            'bpa' => $this->request->getPost('bpa'),
            'dtbp' => $this->request->getPost('dtbp'),
        );
        $this->EksistingBodModel->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'menambahkan data beban pencemaran eksisting bod',
            'aksi' => 'create',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'Add data successfully!');
        return redirect()->to('/beban_pencemaran_eksisting_bod');
    }
    // ==================== END: FUNGSI ADD  ========================================================

    // =================== START: FUNGSI SHOW UPDATE  ===============================
    public function show_updated()
    {
        $id = $this->request->getGet('id');
        $data['row'] = $this->EksistingBodModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW UPDATE  ==================================
    
    // ==================== START: FUNGSI UPDATE  =====================================================
    public function update()
    {
        $session = session();
        $id = $this->request->getPost('id');
        $existingData = $this->EksistingBodModel->find($id);
        $data = array(
            'id' => $this->request->getPost('id'),
            'nama_sungai' => $this->request->getPost('nama_sungai'),
            'titik_pantau' => $this->request->getPost('titik_pantau'),
            'konsentrasi_baku_mutu_maksimum' => $this->request->getPost('konsentrasi_baku_mutu_maksimum'),
            'debit_air_sungai_maksimum' => $this->request->getPost('debit_air_sungai_maksimum'),
            'faktor_k_maksimum' => $this->request->getPost('faktor_k_maksimum'),
            'bpm' => $this->request->getPost('bpm'),
            'konsentrasi_aktual' => $this->request->getPost('konsentrasi_aktual'),
            'debit_air_sungai_aktual' => $this->request->getPost('debit_air_sungai_aktual'),
            'faktor_k_aktual' => $this->request->getPost('faktor_k_aktual'),
            'bpa' => $this->request->getPost('bpa'),
            'dtbp' => $this->request->getPost('dtbp'),
            'created_at' => $existingData['created_at'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->EksistingBodModel->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengubah data beban pencemaran eksisting bod',
            'aksi' => 'update',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'update data successfully!');
        return redirect()->to('/beban_pencemaran_eksisting_bod');
    }
    // ==================== END: FUNGSI UPDATE  ========================================================
}
