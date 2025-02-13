<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SITANGAN - DLH Kota Cimahi</title>
    <link rel="icon" href="<?php echo base_url('/assets/images/logo/favicon.png'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('/assets/images/logo/favicon.png'); ?>" type="image/x-icon">
    <?= $this->include('/layout/source/css') ?>
</head>

<body>
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5 d-none d-xl-flex flex-column align-items-center justify-content-center">
                    <lottie-player src="https://lottie.host/ee4a0308-40cf-4006-a7dd-8ade1755c065/COuyQLZErJ.json" background="transparent" speed="1" style="width: auto; height: 400px;" loop autoplay></lottie-player>
                </div>
                <div class="col-xl-7 p-0">
                    <div class="login-card">
                        <?php
                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-danger dark alert-dismissible fade show">
                                !!! Terdapat kesalahan data yaitu :
                                <ul>
                                    <?php foreach ($errors as $key => $error) { ?>
                                        <li><?= esc($error) ?></li>
                                    <?php } ?>
                                </ul>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }
                        ?>
                        <form class="theme-form login-form" action="<?php echo base_url('/Master_login/login'); ?>" method="post" enctype="multipart/form-data">
                            <div class="p-b-20 justify-content-center text-center">
                                <img class="img-fluid img-200" src="<?php echo base_url('/assets/images/logo/logo-sitangan.png'); ?>" alt="logologinpage">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group"><span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <input class="form-control" name="email" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <input class="form-control" name="password" type="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php $validation = \Config\Services::validation(); ?>
                                <div class="g-recaptcha" data-sitekey="<?= getenv('GOOGLE_RECAPTCHA_SITEKEY') ?>"></div>
                                <?php if ($validation->getError('g-recaptcha-response')) { ?>
                                    <div class='text-danger mt-2'>
                                        * <?= $validation->getError('g-recaptcha-response'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <button class="btn btn-primary btn-block w-100 m-b-10" type="submit">Login</button>
                            <p><a href="#" class="ms-2" data-bs-toggle="modal" data-bs-target="#forgetPasswordModal">Lupa Password</a></p>
                            <p>Belum Memiliki Akun?<a href="#" class="ms-2" data-bs-toggle="modal" data-bs-target="#registrasiModal">Buat Akun</a></p>
                        </form>
                    </div>

                    <!-- MODAL FORGET PASSWORD START -->
                    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?php echo base_url('/Master_login/change_new_password/' . $token); ?>/" method="post" class="theme-form" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Password Baru</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="col-form-label">Password:</label>
                                            <input name="send_password" type="password" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL FORGET PASSWORD END -->
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#changePasswordModal').modal('show');
        });
    </script>
    <!-- <?= $this->include('/layout/source/js'); ?> -->
</body>

</html>