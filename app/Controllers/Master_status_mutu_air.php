<?php

namespace App\Controllers;

use App\Models\M_aktivitas;
use App\Models\M_gis;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Master_status_mutu_air extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->GisModel = new M_gis($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }

    public function index(): string
    {
        return view('data/v_status_mutu_air');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->GisModel->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->GisModel->where('id', $list->id);
                $no++;
                $row = [];
                $tombolAction = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-primary btn-air-primary mx-1 tampil_update_btn\" data-id=\"" . $list->id . "\" data-bs-toggle=\"modal\" data-bs-target=\"#updatedModal\"><i class='fa fa-edit'></i></a>
                    <a type=\"button\" class=\"btn btn-pill btn-danger btn-air-danger mx-1 deleted_status_mutu_btn\" data-id=\"" . $list->id . "\"><i class='fa fa-trash'></i></a>
                </div>";
                $row[] = $no;
                $row[] = $list->nama_sungai;
                $row[] = $list->titik_pantau;
                $row[] = number_format((float)$list->nilai_pij, 2, ',', '');
                if ($list->status_mutu_air == 'Memenuhi Baku Mutu') {
                    $row[] = '<span class="badge badge-primary">Memenuhi Baku Mutu</span>';
                } else if ($list->status_mutu_air == 'Tercemar Ringan') {
                    $row[] = '<span class="badge badge-blue">Tercemar Ringan</span>';
                } else if ($list->status_mutu_air == 'Tercemar Sedang') {
                    $row[] = '<span class="badge badge-warning">Tercemar Sedang</span>';
                } else if ($list->status_mutu_air == 'Tercemar Berat') {
                    $row[] = '<span class="badge badge-danger">Tercemar berat</span>';
                }
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
                'recordsTotal' => $this->GisModel->countAll(),
                'recordsFiltered' => $this->GisModel->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
    // =================== END: FUNGSI AJAX LIST  =========================================================

    // ==================== START: FUNGSI DELETED STATUS MUTU AIR  ================================================
    public function deleted_status_mutu()
    {
        $id = $this->request->getGet('id_status_mutu_air');
        $this->GisModel->delete($id);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengapus data status mutu air',
            'aksi' => 'delete',
        );
        $this->AktivitasModel->save($logAktivitas);
        return $this->response->setJSON(['success' => true]);
    }
    // ==================== END: FUNGSI DELETED STATUS MUTU AIR  ===================================================

    // =================== START: FUNGSI SHOW UPDATE STATUS MUTU AIR  ==============================================
    public function show_updated_status_mutu_air()
    {
        $id = $this->request->getGet('id_status_mutu_air');
        $data['row'] = $this->GisModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW UPDATE STATUS MUTU AIR  ================================================

    // =================== START: FUNGSI SHOW PARAMETER STATUS MUTU AIR  ============================================
    public function detail_parameter_titik_pantau()
    {
        $id = $this->request->getGet('id');
        $data['row'] = $this->GisModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW PARAMETER STATUS MUTU AIR  =============================================

    // ==================== START: FUNGSI ADD STATUS MUTU AIR  ======================================================
    public function add_status_mutu_air()
    {
        $valid = $this->validate([
            'latitude' => [
                'label' => 'Latitude',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} cannot be empty',
                ]
            ],
            'longitude' => [
                'label' => 'Longitude',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} cannot be empty',
                ]
            ],
            'gambar' => [
                'label' => 'Images',
                'rules'  => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,1024]',
                'errors' => [
                    'max_size' => '{field} size too large maximum 1024 KB',
                    'mime_in' => 'The file you selected is not {field}',
                ]
            ],

            'video' => [
                'label' => 'Video',
                'rules'  => 'mime_in[video,video/mp4,video/mkv]|max_size[video,15000]',
                'errors' => [
                    'max_size' => '{field} size too large maximum 15 MB',
                    'mime_in' => 'The file you selected is not {field}',
                ]
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            session()->setFlashdata('error', 'Please check your data!');
            return redirect()->to(base_url('/status_mutu_air'));
        } else {
            $session = session();
            $images = $this->request->getFile('gambar');
            $video = $this->request->getFile('video');
            $targetPath = FCPATH . '/assets/images/gis/';
            $targetPathVideo = FCPATH . '/assets/video/gis/';
            if ($images->isValid() && !$images->hasMoved()) {
                $namaGambar = $images->getRandomName();
                $images->move($targetPath, $namaGambar);
            } else {
                $namaGambar = '';
            }

            if ($video->isValid() && !$video->hasMoved()) {
                $namaVideo = $video->getRandomName();
                $video->move($targetPathVideo, $namaVideo);
            } else {
                $namaVideo = '';
            }
            $data = array(
                'nama_sungai' => $this->request->getPost('nama_sungai'),
                'titik_pantau' => $this->request->getPost('titik_pantau'),
                'debit' => $this->request->getPost('debit'),
                'nilai_ph' => $this->request->getPost('nilai_ph'),
                'do' => $this->request->getPost('do'),
                'bod' => $this->request->getPost('bod'),
                'cod' => $this->request->getPost('cod'),
                'tss' => $this->request->getPost('tss'),
                'no3_n' => $this->request->getPost('no3_n'),
                't_phosphat' => $this->request->getPost('t_phosphat'),
                'fecal_coli' => $this->request->getPost('fecal_coli'),
                'nilai_pij' => $this->request->getPost('nilai_pij'),
                'status_mutu_air' => $this->request->getPost('status_mutu_air'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'gambar' => $namaGambar,
                'video' => $namaVideo,
            );
            $logAktivitas = array(
                'nama_user' => session()->get('nama_user'),
                'email' => session()->get('email'),
                'deskripsi' => 'menambahkan data status mutu air',
                'aksi' => 'create',
            );
            $this->GisModel->save($data);
            $this->AktivitasModel->save($logAktivitas);
            $session->setFlashdata('success', 'Add data successfully!');
            return redirect()->to('/status_mutu_air');
        }
    }
    // ==================== END: FUNGSI ADD STATUS MUTU AIR  ========================================================

    // ==================== START: FUNGSI ADD STATUS MUTU AIR  ======================================================
    public function update_status_mutu_air()
    {
        $valid = $this->validate([
            'latitude' => [
                'label' => 'Latitude',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} cannot be empty',
                ]
            ],
            'longitude' => [
                'label' => 'Longitude',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} cannot be empty',
                ]
            ],
            'gambar' => [
                'label' => 'Images',
                'rules'  => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,1024]',
                'errors' => [
                    'max_size' => '{field} size too large maximum 1024 KB',
                    'mime_in' => 'The file you selected is not {field}',
                ]
            ],

            'video' => [
                'label' => 'Video',
                'rules'  => 'mime_in[video,video/mp4,video/mkv]|max_size[video,15000]',
                'errors' => [
                    'max_size' => '{field} size too large maximum 15 MB',
                    'mime_in' => 'The file you selected is not {field}',
                ]
            ]
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            session()->setFlashdata('error', 'Please check your data!');
            return redirect()->to(base_url('/status_mutu_air'));
        } else {
            $session = session();
            $id = $this->request->getPost('id');
            $existingData = $this->GisModel->find($id);
            $images = $this->request->getFile('gambar');
            $video = $this->request->getFile('video');
            $targetPath = FCPATH . '/assets/images/gis/';
            $targetPathVideo = FCPATH . '/assets/video/gis/';
            if ($images->isValid() && !$images->hasMoved()) {
                if (!empty($existingData['gambar'])) {
                    unlink(FCPATH . '/assets/images/gis/' . $existingData['gambar']);
                }
                $namaGambar = $images->getRandomName();
                $images->move($targetPath, $namaGambar);
            } else {
                $namaGambar = $existingData['gambar'];
            }

            if ($video->isValid() && !$video->hasMoved()) {
                if (!empty($existingData['video'])) {
                    unlink(FCPATH . '/assets/video/gis/' . $existingData['video']);
                }
                $namaVideo = $video->getRandomName();
                $video->move($targetPathVideo, $namaVideo);
            } else {
                $namaVideo = $existingData['video'];
            }
            $data = array(
                'id' => $id,
                'nama_sungai' => $this->request->getPost('nama_sungai'),
                'titik_pantau' => $this->request->getPost('titik_pantau'),
                'debit' => $this->request->getPost('debit'),
                'nilai_ph' => $this->request->getPost('nilai_ph'),
                'do' => $this->request->getPost('do'),
                'bod' => $this->request->getPost('bod'),
                'cod' => $this->request->getPost('cod'),
                'tss' => $this->request->getPost('tss'),
                'no3_n' => $this->request->getPost('no3_n'),
                't_phosphat' => $this->request->getPost('t_phosphat'),
                'fecal_coli' => $this->request->getPost('fecal_coli'),
                'status_mutu_air' => $this->request->getPost('status_mutu_air'),
                'nilai_pij' => $this->request->getPost('nilai_pij'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'gambar' => $namaGambar,
                'video' => $namaVideo,
                'created_at' => $existingData['created_at'],
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $logAktivitas = array(
                'nama_user' => session()->get('nama_user'),
                'email' => session()->get('email'),
                'deskripsi' => 'mengubah data status mutu air dengan id ' . $id .'',
                'aksi' => 'update',
            );
            $this->GisModel->save($data);
            $this->AktivitasModel->save($logAktivitas);
            $session->setFlashdata('success', 'Update data successfully!');
            return redirect()->to('/status_mutu_air');
        }
    }
    // ==================== END: FUNGSI ADD STATUS MUTU AIR  =========================================================

    // ==================== START: FUNGSI EKSPORT STATUS MUTU AIR  ===================================================
    public function exspor_status_mutu_air()
    {
        $Statusmutuair = $this->GisModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Nama Sungai');
        $sheet->setCellValue('C1', 'Titik Pantau');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Latitude');
        $sheet->setCellValue('F1', 'Longitude');
        $sheet->setCellValue('G1', 'Debit(m3/s)');
        $sheet->setCellValue('H1', 'Nilai Ph');
        $sheet->setCellValue('I1', 'DO(m3/s)');
        $sheet->setCellValue('J1', 'BOD(m3/s)');
        $sheet->setCellValue('K1', 'COD(m3/s)');
        $sheet->setCellValue('L1', 'TSS(mg/L)');
        $sheet->setCellValue('M1', 'NO3-N(m3/s)');
        $sheet->setCellValue('N1', 'T-Phosphat(m3/s)');
        $sheet->setCellValue('O1', 'Fecal Coli(MPN/100 mL)');
        $sheet->setCellValue('P1', 'Nilai PIJ');
        $sheet->setCellValue('Q1', 'Status Mutu Air');
        $rows = 2;
        $No = 1;
        foreach ($Statusmutuair as $val) {
            $sheet->setCellValue('A' . $rows, $No);
            $sheet->setCellValue('B' . $rows, $val['nama_sungai']);
            $sheet->setCellValue('C' . $rows, $val['titik_pantau']);
            $sheet->setCellValue('D' . $rows, $val['created_at']);
            $sheet->setCellValue('E' . $rows, $val['latitude']);
            $sheet->setCellValue('F' . $rows, $val['longitude']);
            $sheet->setCellValue('G' . $rows, $val['debit']);
            $sheet->setCellValue('H' . $rows, $val['nilai_ph']);
            $sheet->setCellValue('I' . $rows, $val['do']);
            $sheet->setCellValue('J' . $rows, $val['bod']);
            $sheet->setCellValue('K' . $rows, $val['cod']);
            $sheet->setCellValue('L' . $rows, $val['tss']);
            $sheet->setCellValue('M' . $rows, $val['no3_n']);
            $sheet->setCellValue('N' . $rows, $val['t_phosphat']);
            $sheet->setCellValue('O' . $rows, $val['fecal_coli']);
            $sheet->setCellValue('P' . $rows, $val['nilai_pij']);
            $sheet->setCellValue('Q' . $rows, $val['status_mutu_air']);
            $rows++;
            $No++;
        }
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'export excel data status mutu air',
            'aksi' => 'export',
        );
        $this->AktivitasModel->save($logAktivitas);
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H:i:s') . '-Status Mutu Air';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    // ==================== END: FUNGSI EKSPORT STATUS MUTU AIR  =====================================================

    // ==================== START: FUNGSI IMPORT STATUS MUTU AIR  ===================================================
    public function import_status_mutu_air()
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

            $Param_1 = $excel[6];
            $Param_2 = $excel[7];
            $Param_3 = $excel[8];
            $Param_4 = $excel[9];
            $Param_5 = $excel[10];
            $Param_6 = $excel[11];
            $Param_7 = $excel[12];
            $Param_8 = $excel[13];

            $bktss = 50;
            $bkdo = 4;
            $bkbod = 3;
            $bkcod = 25;
            $bkfosfat = 0.2;
            $bkfecal = 1000;
            $bkcoliform = 10;

            if ($Param_1 <= 7.5) {
                $nilai1 = ($Param_1 - 7.5) / (6 - 7.5);
            } else {
                $nilai1 = ($Param_1 - 7.5) / (9 - 7.5);
            }

            $nilai2 =  ((7 - $Param_2) / (7 - $Param_2)) / $bkdo;
            $nilai3 =  $Param_3 / $bkbod;
            $nilai4 =  $Param_4 / $bkcod;
            $nilai5 = $Param_5 / $bktss;
            $nilai6 = $Param_6 / $bkcoliform;
            $nilai7 = $Param_7 / $bkfosfat;
            $nilai8 = $Param_8 / $bkfecal;

            if ($nilai1 > 1) {
                $nlai1 = 1 + (5 * (log10($nilai8)));
            } else {
                $nlai1 = $nilai1; //ph
            }
            if ($nilai2 > 1) {
                $nlai2 = 1 + (5 * (log10(((7 - $Param_2) / (7 - $bkdo)) / $bkdo)));
            } else {
                $nlai2 = $nilai2; //do
            }
            if ($nilai3 > 1) {
                $nlai3 = 1 + (5 * (log10($Param_3 / $bkbod)));
            } else {
                $nlai3 = $nilai3; //bod
            }
            if ($nilai4 > 1) {
                $nlai4 = 1 + (5 * (log10($Param_4 / $bkcod)));
            } else {
                $nlai4 = $nilai4; //cod
            }
            if ($nilai5 > 1) {
                $nlai5 = 1 + (5 * (log10($Param_5 / $bktss)));
            } else {
                $nlai5 = $nilai1; //tss
            }
            if ($nilai6 > 1) {
                $nlai6 = 1 + (5 * (log10($Param_6 / $bkcoliform)));
            } else {
                $nlai6 = $nilai6; //coliform revisi no3n
            }
            if ($nilai7 > 1) {
                $nlai7 = 1 + (5 * (log10($Param_7 / $bkfosfat)));
            } else {
                $nlai7 = $nilai7; //fosfat
            }
            if ($nilai8 > 1) {
                $nlai8 = 1 + (5 * (log10($Param_8 / $bkfecal)));
            } else {
                $nlai8 = $nilai8;
            }


            $nl1 = $nlai1;
            // 1 + (5 * (Math.log10(coltss / bktss)));
            $nl2 = $nlai2;
            // 1 + (5 * (Math.log10(coldo / bkdo)));
            $nl3 = $nlai3;
            $nl4 = $nlai4;
            // 1 + (5 * (Math.log10(colcod / bkcod)));
            $nl5 = $nlai5;
            // 1 + (5 * (Math.log10(colfosfat / bkfosfat)));
            $nl6 = $nlai6;
            $nl7 = $nlai7;
            $nl8 = $nlai8;

            $nilairata = ($nl1 + $nl2 + $nl3 + $nl4 + $nl5 + $nl6 + $nl7 + $nl8) / 8;
            $nilaimax = max($nl1, $nl2, $nl3, $nl4, $nl5, $nl6, $nl7, $nl8);
            $nilairata2 = pow($nilairata, 2);
            $nilaimax2 = pow($nilaimax, 2);

            $nilaipij = sqrt(($nilairata2 + $nilaimax2) / 2);


            if ($nilaipij <= 1) {
                $statusmutu = "Memenuhi Baku Mutu";
            } else if ($nilaipij <= 5) {
                $statusmutu = "Tercemar Ringan";
            } else if ($nilaipij <= 10) {
                $statusmutu = "Tercemar Sedang";
            } else if ($nilaipij > 10) {
                $statusmutu = "Tercemar Berat";
            }

            if ($excel[1] == null && $excel[2] == null) {
                break;
            }

            $data = [
                'nama_sungai' => $excel[1],
                'titik_pantau' =>   $excel[2],
                'latitude' =>   $excel[3],
                'longitude' =>   $excel[4],
                'debit' =>  $excel[5],
                'nilai_ph' =>   $excel[6],
                'do' =>  $excel[7],
                'bod' =>   $excel[8],
                'cod' =>   $excel[9],
                'tss' =>   $excel[10],
                'no3_n' =>   $excel[11],
                't_phosphat' =>   $excel[12],
                'fecal_coli' =>   $excel[13],
                'nilai_pij' =>   $nilaipij,
                'status_mutu_air' =>   $statusmutu,
            ];
            $this->GisModel->save($data);
            $jumlahsukses++;;
        }
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'import excel data status mutu air',
            'aksi' => 'import',
        );
        $this->AktivitasModel->save($logAktivitas);
        session()->setFlashdata('success', "$jumlahsukses data berhasil disimpan");
        return redirect()->to('/status_mutu_air');
    }
    // ==================== END: FUNGSI IMPORT STATUS MUTU AIR  =====================================================
}
