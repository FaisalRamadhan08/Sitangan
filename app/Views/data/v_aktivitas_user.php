<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Aktivitas User</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Aktivitas User</li>
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
                        <div class="d-flex justify-content-start p-b-40">
                            <a href="/Master_aktivitas/export" type="button" class="btn btn-pill btn-primary btn-air-primary mx-1">
                                <i class='bx bxs-file-export p-r-5'></i>
                                Export Excel
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_aktivitas">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email Pengguna</th>
                                        <th>Deskripsi</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/aktivitas_users.js'); ?>"></script>

<?= $this->endSection() ?>