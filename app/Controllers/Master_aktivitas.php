<?php

namespace App\Controllers;

use App\Models\M_aktivitas;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Master_aktivitas extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->AktivitasModel = new M_aktivitas($request);
    }
    public function index(): string
    {
        return view('data/v_aktivitas_user');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->AktivitasModel->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->AktivitasModel->where('id', $list->id);
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_user;
                $row[] = $list->email;
                $row[] = $list->deskripsi;
                $row[] = $list->created_at;
                $row[] = $list->aksi;
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->AktivitasModel->countAll(),
                'recordsFiltered' => $this->AktivitasModel->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
    // =================== END: FUNGSI AJAX LIST  =========================================================

    // =================== START : EXPORT EXCEL ============================================================
    public function export()
    {
        $aktivitasUser = $this->AktivitasModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Nama Pengguna');
        $sheet->setCellValue('C1', 'Email Pengguna');
        $sheet->setCellValue('D1', 'Deskripsi');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'Aksi');
        $rows = 2;
        $No = 1;
        foreach ($aktivitasUser as $val) {
            $sheet->setCellValue('A' . $rows, $No);
            $sheet->setCellValue('B' . $rows, $val['nama_user']);
            $sheet->setCellValue('C' . $rows, $val['email']);
            $sheet->setCellValue('D' . $rows, $val['deskripsi']);
            $sheet->setCellValue('E' . $rows, $val['created_at']);
            $sheet->setCellValue('F' . $rows, $val['aksi']);
            $rows++;
            $No++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-H:i:s') . '-Aktivitas User';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'export excel data aktivitas user',
            'aksi' => 'export',
        );
        $this->AktivitasModel->save($logAktivitas);
    }

    // =================== END : EXPORT EXCEL ============================================================
}
