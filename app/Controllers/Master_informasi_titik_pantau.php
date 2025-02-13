<?php

namespace App\Controllers;

use App\Models\M_gis;
use Config\Services;

class Master_informasi_titik_pantau extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->GisModel = new M_gis($request);
    }
    
    public function index(): string
    {
        return view('data/v_informasi_titik_pantau');
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
                $tombolDetail = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-primary-light btn-air-info mx-1 tampil_detail_btn\" data-id=\"" . $list->id . "\" data-bs-toggle=\"modal\" data-bs-target=\"#detailModal\"><i class='fa fa-eye'></i></a>
                </div>";
                $row[] = $no;
                $row[] = $list->nama_sungai;
                $row[] = $list->titik_pantau;
                $row[] = $list->latitude;
                $row[] = $list->longitude;
                $row[] = $list->created_at;
                $row[] = $tombolDetail;
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


    // =================== START: FUNGSI SHOW DETAIL MEDIA INFORMASI TITIK PANTAU ==========================
    public function detail_informasi_titik_pantau()
    {
        $id = $this->request->getGet('id_informasi_titik');
        $data['row'] = $this->GisModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW DETAIL MEDIA INFORMASI TITIK PANTAU  ===========================
}
