<?php

namespace App\Controllers;

use App\Models\M_aktivitas;
use App\Models\M_users;
use Config\Services;

class Master_login extends BaseController
{
    // ========================= START: KONTRUKTOR  =====================================================
    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->UsersModel = new M_users($request);
        $this->AktivitasModel = new M_aktivitas($request);
    }
    // ========================= END: KONTRUKTOR  ========================================================

    public function index(): string
    {
        return view('/auth/v_login');
    }

    public function login()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $login = $this->UsersModel->where('email', $email)->first();
        // if (!$this->validate(
        //     [
        //         'g-recaptcha-response' => [
        //             'rules' => 'required|verifyrecaptcha',
        //             'errors' => [
        //                 'required' => 'Please verify captcha',
        //                 'verifyrecaptcha' => 'Please verify captcha'
        //             ]
        //         ]
        //     ]
        // )) {
        //     session()->setFlashdata("error", "Harap verifikasi captcha");
        //     return redirect()->to('/')->withInput();
        // }
        if ($login) {
            $pass = $login['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id' => $login['id'],
                    'nama_user' => $login['nama'],
                    'email' => $login['email'],
                    'gambar' => $login['gambar'],
                    'role' => $login['role'],
                    'logged_in' => TRUE,
                ];
                $session->set($ses_data);
                session()->setFlashdata("success", "Login berhasil");
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata("error", "Password yang anda masukan salah!");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("error", "Email tidak ditemukan!");
            return redirect()->back();
        }
    }

    public function regitrasi_users()
    {
        $valid = $this->validate([
            'gambar' => [
                'label' => 'Gambar',
                'rules'  => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,1024]',
                'errors' => [
                    'max_size' => 'Ukuran maksimum {field} 1024 KB',
                    'mime_in' => 'File yang Anda pilih bukan {field}',
                ]
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            session()->setFlashdata('error', 'Silakan periksa gambar Anda');
            return redirect()->to(base_url('/'));
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
                $session->setFlashdata('error', 'Email telah tersedia');
                return redirect()->to(base_url('/'));
            } else {
                $data = array(
                    'nama' => $this->request->getPost('nama'),
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'gambar' => $namaGambar,
                    'role' => 'user',
                    'status' => 'active',
                    'unique'    => $unique,
                );
            };
            $this->UsersModel->save($data);
            $session->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/');
        }
    }

    public function updated_profile()
    {
        $valid = $this->validate([
            'gambar' => [
                'label' => 'Gambar',
                'rules'  => 'mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,1024]',
                'errors' => [
                    'max_size' => 'Ukuran maksimum {field} 1024 KB',
                    'mime_in' => 'File yang Anda pilih bukan {field}',
                ]
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            session()->setFlashdata('error', 'Silakan periksa gambar Anda');
            return redirect()->to(base_url('/dashboard'));
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
                $namaImages = $existingData['gambar'];
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
                $session->setFlashdata('error', 'Email telah tersedia');
            } else {
                $data = array(
                    'id' => $id,
                    'nama' => $this->request->getPost('nama'),
                    'email' => $email,
                    'password' => $hashedPassword,
                    'gambar' => $namaImages,
                    'created_at' => $existingData['created_at'],
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->UsersModel->save($data);
                $logAktivitas = array(
                    'nama_user' => session()->get('nama_user'),
                    'deskripsi' => 'mengubah data user dengan id ' . $id . '',
                    'aksi' => 'update',
                );
                $this->AktivitasModel->save($logAktivitas);
                $session->setFlashdata('success', 'Data berhasil diperbaharui');
            }
            return redirect()->to('/dashboard');
        }
    }

    public function lupa_password()
    {
        $email = $this->request->getPost('send_email', FILTER_SANITIZE_EMAIL);
        $userdata = $this->UsersModel->verifyEmail($email);

        if (!empty($userdata)) {
            if ($this->UsersModel->updatedAt($userdata['unique'])) {
                $to = $email;
                $subject = 'Pembaruan Kata Sandi';
                $token = $userdata['unique'];
                $message = 'Hi ' . $userdata['nama'] . ',<br><br>' .
                    'Permintaan pembaruan kata sandi anda diterima. Silahkan klik ' .
                    'link dibawah ini untuk memperbarui kata sandi anda.<br><br>' .
                    '<a  href="' . base_url() . 'Master_login/reset_password/' . $token . '" class="btn btn-primary-gradien btn-sm">
                    Klik disini untuk memperbarui kata sandi anda</a><br><br>' .
                    'tautan diatas akan kadaluarsa setelah 15 menit menerima email ini <br><br>' .
                    'Jika anda tidak melakukan permintaan pembaruan kata sandi, mohon abaikan email ini.<br><br>' .
                    'Hormat,<br>' .
                    'Admin';
                $email = \Config\Services::email();
                $email->setTo($to);
                $email->setFrom('dlh@cimahikota.go.id', 'DLH KOTA CIMAHI');
                $email->setSubject($subject);
                $email->setMessage($message);
                if ($email->send()) {
                    session()->setFlashdata('success', 'Silahkan cek email anda');
                    return redirect()->to(base_url('/'));
                } else {
                    session()->setFlashdata('error', 'Gagal mengirimkan data');
                    return redirect()->to(base_url('/'));
                }
            }
        }
        session()->setFlashdata('error', 'Email tidak ditemukan');
        return redirect()->to(base_url('/'));
    }

    public function reset_password($token = null)
    {
        if (!empty($token)) {
            $userdata = $this->UsersModel->verifyToken($token);
            if (!empty($userdata)) {
                if ($this->checkexpirydate($userdata['updated_at'])) {
                    $data = [
                        'token' => $token,
                    ];
                    return view('/auth/v_reset_password', $data);
                } else {
                    session()->setFlashdata('error', 'Tautan setel ulang kata sandi telah Kedaluwarsa');
                    return redirect()->to(base_url('/'));
                }
            } else {
                session()->setFlashdata('error', 'Tidak dapat menemukan akun pengguna');
                return redirect()->to(base_url('/'));
            }
        } else {
            session()->setFlashdata('error', 'Maaf! akses tidak sah');
            return redirect()->to(base_url('/'));
        }
    }

    public function checkexpirydate($time)
    {
        $update_time = strtotime($time);
        $current_time = time();
        $diff = ($current_time - $update_time);
        if ($diff < 900) {
            return true;
        } else {
            return false;
        }
    }

    public function change_new_password($token)
    {
        $existingData = $this->UsersModel->where(['unique' => $token])->first();
        $data = array(
            'id' => $existingData['id'],
            'password' => password_hash($this->request->getVar('send_password'), PASSWORD_DEFAULT),
            'unique'    => md5(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' . time())),
            'created_at' => $existingData['created_at'],
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->UsersModel->save($data);
        session()->setFlashdata("success", "Kata sandi berhasil diperbaharui");
        return redirect()->to('/');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
