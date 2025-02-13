<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Masterdata User</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Masterdata User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
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

                        <div class="d-flex justify-content-end p-b-40">
                            <button type="button" class="btn btn-pill btn-primary btn-air-primary" data-bs-toggle="modal" data-bs-target="#addModal" onclick="addUser()">
                                <i class='fa fa-plus p-r-5'></i>
                                Tambah Data
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_users">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <!-- MODAL ADD START -->
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                            <div class="modal-dialog modal-700" role="document">
                                <div class="modal-content">
                                    <form action="<?php echo base_url('/Master_users/add_users'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data Users</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama:</label>
                                                <input name="nama" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Email:</label>
                                                <input name="email" type="email" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Password:</label>
                                                <input name="password" type="password" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Role:</label>
                                                <select name="role" class="form-select">
                                                    <option value="user">Users</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="superadmin">Superadmin</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Status:</label>
                                                <select name="status" class="form-select">
                                                    <option value="active">Aktif</option>
                                                    <option value="inactive">Non Aktif</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Gambar:</label>
                                                <input name="gambar" type="file" class="form-control" accept=".png, .jpg, .jpeg">
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- MODAL ADD END -->

                        <!-- MODAL UPDATE START -->
                        <div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                            <div class="modal-dialog modal-700" role="document">
                                <div class="modal-content">
                                    <form action="<?php echo base_url('/Master_users/update_users'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ubah Data Users</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input id="id_update_master_user" name="id" type="hidden" class="form-control">
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama:</label>
                                                <input id="nama_update" name="nama" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Email:</label>
                                                <input id="email_update" name="email" type="email" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Password:</label>
                                                <input id="password_update" name="password" type="password" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Role:</label>
                                                <select name="role" id="role" class="form-select">
                                                    <option value="user">Users</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="superadmin">Superadmin</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Status:</label>
                                                <select name="status" id="status" class="form-select">
                                                    <option value="active">Aktif</option>
                                                    <option value="inactive">Non Aktif</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Gambar:</label>
                                                <input id="gambar" name="gambar" type="file" class="form-control" accept=".png, .jpg, .jpeg">
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- MODAL UPDATE END -->

                        <!-- MODAL DETAIL IMAGES START-->
                        <div class="modal fade" id="detailImagesModal" tabindex="-1" role="dialog" aria-labelledby="detailImagesModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Gambar Users</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img class="w-100" id="zoomedImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- MODAL DETAIL IMAGES END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/users.js'); ?>"></script>

<?= $this->endSection() ?>