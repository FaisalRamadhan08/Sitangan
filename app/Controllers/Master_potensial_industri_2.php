<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_aktivitas;
use App\Models\M_potensial_industri_2;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Master_potensial_industri_2 extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->potensialIndustri2Model = new M_potensial_industri_2($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }

    public function index()
    {
        return view('data/v_potensial_industri_2');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->potensialIndustri2Model->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->potensialIndustri2Model->where('id', $list->id);
                $no++;
                $row = [];
                $tombolAction = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-primary btn-air-primary mx-1 tampil_update_btn\" data-id=\"" . $list->id . "\" data-bs-toggle=\"modal\" data-bs-target=\"#updatedModal\"><i class='fa fa-edit'></i></a>
                    <a type=\"button\" class=\"btn btn-pill btn-danger btn-air-danger mx-1 deleted_btn\" data-id=\"" . $list->id . "\"><i class='fa fa-trash'></i></a>
                </div>";
                $row[] = $no;
                $row[] = $list->kecamatan;
                $row[] = $list->nama_perusahaan;
                $row[] = $list->pbp_industri_formula_2;
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
                'recordsTotal' => $this->potensialIndustri2Model->countAll(),
                'recordsFiltered' => $this->potensialIndustri2Model->countFiltered(),
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
        $data['row'] = $this->potensialIndustri2Model->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW PARAMETER ==========================================
    // ==================== START: FUNGSI DELETED ================================================
    public function deleted()
    {
        $id = $this->request->getGet('id');
        $this->potensialIndustri2Model->delete($id);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengapus data potensial industri tier 2',
            'aksi' => 'delete',
        );
        $this->AktivitasModel->save($logAktivitas);
        return $this->response->setJSON(['success' => true]);
    }
    // ==================== END: FUNGSI DELETED ===================================================

    // ==================== START: FUNGSI EKSPORT  ===================================================
    public function eksport()
    {
        $potensialIndustri2 = $this->potensialIndustri2Model->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Kecamatan');
        $sheet->setCellValue('C1', 'Nama Perusahaan');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Konsentrasi Limbah Industri (mg/l)');
        $sheet->setCellValue('F1', 'Laju Alir Buangan Air Limbah (l/jam)');
        $sheet->setCellValue('G1', 'Jumlah Jam Operasi Per-tahun (jam/tahun)');
        $sheet->setCellValue('H1', 'Faktor konversi (mg/kg)');
        $sheet->setCellValue('I1', 'PBP Perindustrian(Kg/hari)');
        $rows = 2;
        $No = 1;
        foreach ($potensialIndustri2 as $val) {
            $sheet->setCellValue('A' . $rows, $No);
            $sheet->setCellValue('B' . $rows, $val['kecamatan']);
            $sheet->setCellValue('C' . $rows, $val['nama_perusahaan']);
            $sheet->setCellValue('D' . $rows, $val['created_at']);
            $sheet->setCellValue('E' . $rows, $val['param_1_formula_2']);
            $sheet->setCellValue('F' . $rows, $val['param_2_formula_2']);
            $sheet->setCellValue('G' . $rows, $val['param_3_formula_2']);
            $sheet->setCellValue('H' . $rows, $val['param_4_formula_2']);
            $sheet->setCellValue('I' . $rows, $val['pbp_industri_formula_2']);
            $rows++;
            $No++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H:i:s') . '-Potensial Industri Formula 2';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'export excel data potensial industri tier 2',
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
                'kecamatan' => $excel[1],
                'nama_perusahaan' =>   $excel[2],
                'param_1_formula_2' =>   $excel[3],
                'param_2_formula_2' =>   $excel[4],
                'param_3_formula_2' =>  $excel[5],
                'param_4_formula_2' =>   $excel[6],
                'pbp_industri_formula_2' =>   $excel[7],
            ];


            $this->potensialIndustri2Model->save($data);
            $jumlahsukses++;;
        }
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'import excel data potensial industri tier 2',
            'aksi' => 'import',
        );
        $this->AktivitasModel->save($logAktivitas);
        session()->setFlashdata('success', "$jumlahsukses data berhasil disimpan");
        return redirect()->to('/potensial_industri_2');
    }
    // ==================== END: FUNGSI IMPORT  =====================================================

    // ==================== START: FUNGSI ADD  ======================================================
    public function add()
    {
        $session = session();
        $data = array(
            'kecamatan' => $this->request->getPost('kecamatan'),
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'param_1_formula_2' => $this->request->getPost('param_1_formula_2'),
            'param_2_formula_2' => $this->request->getPost('param_2_formula_2'),
            'param_3_formula_2' => $this->request->getPost('param_3_formula_2'),
            'param_4_formula_2' => $this->request->getPost('param_4_formula_2'),
            'pbp_industri_formula_2' => $this->request->getPost('pbp_industri_formula_2'),
        );
        $this->potensialIndustri2Model->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'menambahkan data potensial industri tier 2',
            'aksi' => 'create',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'Add data successfully!');
        return redirect()->to('/potensial_industri_2');
    }
    // ==================== END: FUNGSI ADD  ========================================================

    // =================== START: FUNGSI SHOW UPDATE  ===============================
    public function show_updated()
    {
        $id = $this->request->getGet('id');
        $data['row'] = $this->potensialIndustri2Model->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW UPDATE  ==================================
    
    // ==================== START: FUNGSI UPDATE  =====================================================
    public function update()
    {
        $session = session();
        $id = $this->request->getPost('id');
        $existingData =   $this->potensialIndustri2Model->find($id);
        $data = array(
            'id' => $this->request->getPost('id'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'param_1_formula_2' => $this->request->getPost('param_1_formula_2'),
            'param_2_formula_2' => $this->request->getPost('param_2_formula_2'),
            'param_3_formula_2' => $this->request->getPost('param_3_formula_2'),
            'param_4_formula_2' => $this->request->getPost('param_4_formula_2'),
            'pbp_industri_formula_2' => $this->request->getPost('pbp_industri_formula_2'),
            'created_at' => $existingData['created_at'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->potensialIndustri2Model->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengubah data potensial industri tier 2 dengan id ' . $this->request->getPost('id') . '',
            'aksi' => 'update',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'update data successfully!');
        return redirect()->to('/potensial_industri_2');
    }
    // ==================== END: FUNGSI UPDATE  ========================================================
}
