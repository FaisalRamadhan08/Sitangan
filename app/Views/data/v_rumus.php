<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Masterdata Rumus</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Masterdata Rumus</li>
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

                        <?php if (session()->get('role') !== 'user') : ?>
                            <div class="d-flex justify-content-end p-b-40">
                                <button type="button" class="btn btn-pill btn-primary btn-air-primary" data-bs-toggle="modal" data-bs-target="#addModal" onclick="addRumus()">
                                    <i class='fa fa-plus p-r-5'></i>
                                    Tambah Data
                                </button>
                            </div>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_rumus">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul Rumus</th>
                                        <th>Rumus</th>
                                        <?php if (session()->get('role') !== 'user') : ?>
                                            <th>Waktu Pembuatan</th>
                                            <th>Waktu Perubahan</th>
                                            <th>Aksi</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- MODAL ADD START -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                    <div class="modal-dialog modal-700" role="document">
                        <div class="modal-content">
                            <form action="<?php echo base_url('/Master_rumus/add_rumus'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Rumus</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="col-form-label">Judul Rumus:</label>
                                        <input name="judul_rumus" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Rumus:</label>
                                        <textarea class="summernote" name="rumus" cols="30" rows="10"></textarea>
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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/rumus.js'); ?>"></script>

<?= $this->endSection() ?>