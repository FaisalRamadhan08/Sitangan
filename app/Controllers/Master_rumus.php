<?php

namespace App\Controllers;

use App\Models\M_aktivitas;
use App\Models\M_rumus;
use Config\Services;

class Master_rumus extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->rumusModel = new M_rumus($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }
    public function index(): string
    {
        return view('data/v_rumus');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->rumusModel->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->rumusModel->where('id', $list->id);
                $no++;
                $row = [];
                $tombolAction = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-danger btn-air-danger mx-1 deleted_rumus_btn\" data-id=\"" . $list->id . "\"><i class='fa fa-trash'></i></a>
                </div>";
                $row[] = $no;
                $row[] = $list->judul_rumus;
                $row[] = $list->rumus;
                if (session()->get('role') !== 'user') {
                    $row[] = $list->created_at;
                    $row[] = $list->updated_at;
                    $row[] = $tombolAction;
                }
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->rumusModel->countAll(),
                'recordsFiltered' => $this->rumusModel->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
    // =================== END: FUNGSI AJAX LIST  =========================================================

    // ==================== START: FUNGSI DELETED RUMUS  ==================================================
    public function deleted_rumus()
    {
        $id = $this->request->getGet('id_rumus');
        $this->rumusModel->delete($id);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengapus data rumus',
            'aksi' => 'delete',
        );
        $this->AktivitasModel->save($logAktivitas);
        return $this->response->setJSON(['success' => true]);
    }
    // ==================== END: FUNGSI DELETED RUMUS  =====================================================

    // ==================== START: FUNGSI ADD RUMUS  ==================================================
    public function add_rumus()
    {
        $session = session();
        $judulRumus = $this->request->getpost('judul_rumus');
        $existingData = $this->rumusModel->where(['judul_rumus' => $judulRumus])->first();
        if ($existingData) {
            $session->setFlashdata('error', 'Judul rumus already exists !');
            return redirect()->to(base_url('/rumus'));
        } else {
            $data = array(
                'judul_rumus' => $judulRumus,
                'rumus' => $this->request->getpost('rumus'),
            );
        };
        $this->rumusModel->save($data);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'menambahkan data rumus',
            'aksi' => 'create',
        );
        $this->AktivitasModel->save($logAktivitas);
        $session->setFlashdata('success', 'Add data successfully!');
        return redirect()->to('/rumus');
    }
    // ==================== END: FUNGSI ADD RUMUS  =====================================================

}
