<?php

namespace App\Controllers;

use App\Models\M_aktivitas;
use App\Models\M_users;
use Config\Services;

class Master_users extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->UsersModel = new M_users($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }
    public function index(): string
    {
        return view('data/v_users');
    }

    // =================== START: FUNGSI AJAX LIST  =======================================================
    public function ajax_list()
    {
        $request = Services::request();
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->UsersModel->getDatatables();
            $data = [];
            $no = $request->getPost('start');
            foreach ($lists as $list) {
                $this->UsersModel->where('id', $list->id);
                $no++;
                $row = [];
                $tombolAction = "
                <div class='d-flex justify-content-center'>
                    <a type=\"button\" class=\"btn btn-pill btn-primary btn-air-primary mx-1 tampil_update_btn\" data-id=\"" . $list->id . "\" data-bs-toggle=\"modal\" data-bs-target=\"#updatedModal\"><i class='fa fa-edit'></i></a>
                    <a type=\"button\" class=\"btn btn-pill btn-danger btn-air-danger mx-1 deleted_users_btn\" data-id=\"" . $list->id . "\"><i class='fa fa-trash'></i></a>
                </div>";
                $row[] = $no;
                $row[] = $list->nama;
                $row[] = $list->email;
                $row[] = $list->role;
                if ($list->status == 'active') {
                    $row[] = '<span class="badge badge-primary">Aktif</span>';
                } else {
                    $row[] = '<span class="badge badge-danger"">Non aktif</span>';
                }

                if (empty($list->gambar)) {
                    $row[] = '<img class="img-70 zoomable-image" src="' . base_url('/assets/images/default/default.jpg') . '" data-bs-toggle=\"modal\" data-bs-target=\"#ImagesModal\">';
                } else {
                    $row[] = '<img class="img-40 zoomable-image" src="' . base_url('/assets/images/users/' . $list->gambar) . '" value="' . $list->gambar . '" data-bs-toggle=\"modal\" data-bs-target=\"#ImagesModal\">';
                }

                $row[] = $tombolAction;
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->UsersModel->countAll(),
                'recordsFiltered' => $this->UsersModel->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
    // =================== END: FUNGSI AJAX LIST  =========================================================

    // =================== START: FUNGSI SHOW UPDATE USERS  ===============================================
    public function show_update_users()
    {
        $id = $this->request->getGet('id_users');
        $data['row'] = $this->UsersModel->find($id);
        return $this->response->setJSON($data);
    }
    // ==================== END: FUNGSI SHOW UPDATE USERS  ================================================

    // ==================== START: FUNGSI DELETED USERS  ==================================================
    public function deleted_users()
    {
        $id = $this->request->getGet('id_users');
        $this->UsersModel->delete($id);
        $logAktivitas = array(
            'nama_user' => session()->get('nama_user'),
            'email' => session()->get('email'),
            'deskripsi' => 'mengapus master data user',
            'aksi' => 'delete',
        );
        $this->AktivitasModel->save($logAktivitas);
        return $this->response->setJSON(['success' => true]);
    }
    // ==================== END: FUNGSI DELETED USERS  =====================================================

    // ==================== START: FUNGSI ADD USERS  =======================================================
    public function add_users()
    {
        $valid = $this->validate([
            'gambar' => [
                'label' => 'Images',
                'rules'  => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,1024]',
                'errors' => [
                    'max_size' => '{field} size too large maximum 1024 KB',
                    'mime_in' => 'The file you selected is not {field}',
                ]
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            session()->setFlashdata('error', 'Please check your picture');
            return redirect()->to(base_url('/users'));
        } else {
            $unique = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
            $session = session();
            $images = $this->request->getFile('gambar');
            $targetPath = FCPATH . '/assets/images/users/';
            if ($images && $images->isValid()) {
                $namaGambar = $images->getRandomName();
                $images->move($targetPath, $namaGambar);
            } else {
                $namaGambar = '';
            }
            $email = $this->request->getVar('email');
            $existingData = $this->UsersModel->where(['email' => $email])->first();
            if ($existingData) {
                $session->setFlashdata('error', 'Email already exists !');
                return redirect()->to(base_url('/users'));
            } else {
                $data = array(
                    'nama' => $this->request->getPost('nama'),
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'gambar' => $namaGambar,
                    'role' => $this->request->getPost('role'),
                    'status' => $this->request->getPost('status'),
                    'unique'    => $unique,
                );
            };
            $this->UsersModel->save($data);
            $logAktivitas = array(
                'nama_user' => session()->get('nama_user'),
                'email' => session()->get('email'),
                'deskripsi' => 'menambahkan master data user',
                'aksi' => 'create',
            );
            $this->AktivitasModel->save($logAktivitas);
            $session->setFlashdata('success', 'Add data successfully!');
            return redirect()->to('/users');
        }
    }
    // ==================== END: FUNGSI ADD USERS  =========================================================

    // ==================== START: FUNGSI UPDATE USERS  ====================================================
    public function update_users()
    {
        $valid = $this->validate([
            'gambar' => [
                'label' => 'Images',
                'rules'  => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,1024]',
                'errors' => [
                    'max_size' => '{field} size too large maximum 1024 KB',
                    'mime_in' => 'The file you selected is not {field}',
                ]
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            session()->setFlashdata('error', 'Please check your picture');
            return redirect()->to(base_url('/users'));
        } else {
            $session = session();
            $id = $this->request->getPost('id');
            $existingData = $this->UsersModel->find($id);
            $targetPath = FCPATH . '/assets/images/users/';
            $images = $this->request->getFile('gambar');
            if ($images->isValid() && !$images->hasMoved()) {
                if (!empty($existingData['gambar'])) {
                    unlink(FCPATH . '/assets/images/users/' . $existingData['gambar']);
                }
                $namaImages = $images->getRandomName();
                $images->move($targetPath, $namaImages);
            } else {
                if (!empty($existingData['gambar'])) {
                    $namaImages = $existingData['gambar'];
                } else {
                    $namaImages = '';
                }
            }
            $email = $this->request->getPost('email');
            $existingDataByEmail = $this->UsersModel->where(['email' => $email, 'id !=' => $id])->first();
            $password = $this->request->getVar('password');
            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $data['password'] = $hashedPassword;
            } else {
                $hashedPassword = $existingData['password'];
            }

            if ($existingDataByEmail) {
                $session->setFlashdata('error', 'Email already exists !');
            } else {
                $data = array(
                    'id' => $id,
                    'nama' => $this->request->getPost('nama'),
                    'email' => $email,
                    'password' => $hashedPassword ,
                    'role' => $this->request->getPost('role'),
                    'gambar' => $namaImages,
                    'created_at' => $existingData['created_at'],
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->UsersModel->save($data);
                $logAktivitas = array(
                    'nama_user' => session()->get('nama_user'),
                    'email' => session()->get('email'),
                    'deskripsi' => 'mengubah master data user dengan id ' . $id .'',
                    'aksi' => 'update',
                );
                $this->AktivitasModel->save($logAktivitas);
                $session->setFlashdata('success', 'Updated data successfully!');
            }
            return redirect()->to('/users');
        }
    }
    // ==================== END: FUNGSI UPDATE USERS  ======================================================
}
