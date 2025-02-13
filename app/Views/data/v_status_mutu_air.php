<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Status Mutu Air</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Status Mutu Air</li>
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
                        <div class="d-flex flex-column flex-sm-row justify-content-between p-b-40">
                            <div class="d-flex">
                                <button type="button" class="btn btn-pill btn-primary btn-air-primary mx-1" data-bs-toggle="modal" data-bs-target="#importModal">
                                    <i class='bx bxs-file-import p-r-5'></i>
                                    Import Data
                                </button>
                                <a href="/Master_status_mutu_air/eksport_status_mutu_air" type="button" class="btn btn-pill btn-secondary btn-air-secondary mx-1">
                                    <i class='bx bxs-file-export p-r-5'></i>
                                    Export Data
                                </a>
                            </div>

                            <div class="d-flex mt-2 mt-sm-0">
                                <button type="button" class="btn btn-pill btn-primary btn-air-primary w-100" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class='fa fa-plus p-r-5'></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_status_mutu_air">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Sungai</th>
                                        <th>Titik Pantau</th>
                                        <th>Nilai Pij</th>
                                        <th>Status Mutu Air</th>
                                        <th>Detail</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- MODAL ADD START -->
                        <form action="<?php echo base_url('/Master_status_mutu_air/add_status_mutu_air'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                                <div class="modal-dialog modal-700" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data Status Mutu Air</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
                                        </div>
                                        <div class="modal-body max-height-550">
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama Sungai:</label>
                                                <select id="nama_sungai_add" name="nama_sungai" class="form-select">
                                                    <option value="cisangkan">Cisangkan</option>
                                                    <option value="cibaligo">Cibaligo</option>
                                                    <option value="cibeureum">Cibeureum</option>
                                                    <option value="cibabat">Cibabat</option>
                                                    <option value="cimahi">Cimahi</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Titik Pantau:</label>
                                                <select id="titik_pantau_add" name="titik_pantau" class="form-select">
                                                    <option value="hulu">Hulu</option>
                                                    <option value="tengah">Tengah</option>
                                                    <option value="hilir">Hilir</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Debit:</label>
                                                <input id="debit_add" name="debit" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Nilai Ph:</label>
                                                <input id="nilai_ph_add" name="nilai_ph" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">DO(m3/s):</label>
                                                <input id="do_add" name="do" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">BOD(m3/s):</label>
                                                <input id="bod_add" name="bod" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">COD(m3/s):</label>
                                                <input id="cod_add" name="cod" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">TSS(mg/L):</label>
                                                <input id="tss_add" name="tss" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">NO3-N(m3/s):</label>
                                                <input id="no3_n_add" name="no3_n" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">T-Phosphat(m3/s):</label>
                                                <input id="t_phosphat_add" name="t_phosphat" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Fecal Coli(MPN/100 mL):</label>
                                                <input id="fecal_coli_add" name="fecal_coli" type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <button type="button" id="hitung-button" class="btn btn-primary btn-air-primary w-100" onclick="hitungStatusMutuAir()" disabled>
                                                    Hitung status mutu air
                                                </button>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Nilai Pij:</label>
                                                <input id="nilai_pij_add" name="nilai_pij" type="text" class="form-control" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Status Mutu Air:</label>
                                                <input id="status_mutu_air_add" name="status_mutu_air" type="text" class="form-control" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Informasi Titik Pantau:</label>
                                                <br>
                                                <button type="button" class="btn btn-primary-light btn-air-light" data-bs-toggle="modal" data-bs-target="#addInformasiModal">
                                                    Detail Informasi
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" onclick="closeModal()">Kembali</button>
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL DETAIL INFORMASI START-->
                            <div class="modal fade" id="addInformasiModal" tabindex="-1" role="dialog" aria-labelledby="addInformasiModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Informasi Titik Pantau</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-8 col-xl-6">
                                                    <div id="add_maps_status_mutu" style="width: 100%; height: 570px;"></div>
                                                </div>
                                                <div class="col-sm-8 col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Latitude:</label>
                                                        <input id="latitude_add" name="latitude" type="text" class="form-control" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="col-form-label">Longitude:</label>
                                                        <input id="longitude_add" name="longitude" type="text" class="form-control" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="col-form-label">Gambar:</label>
                                                        <input class="form-control" name="gambar" type="file" accept="image/*">
                                                        <img class="w-25 p-t-10">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="col-form-label">Video:</label>
                                                        <input class="form-control" name="video" type="file" accept="video/*">
                                                        <video class="w-50 p-t-10" autoplay type="video/mp4"></video>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL DETAIL INFORMASI END -->
                        </form>
                    </div>
                </div>
                <!-- MODAL DETAIL PARAMETER START-->
                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                    <div class="modal-dialog modal-1200" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Parameter Status Mutu Air</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table m-b-10 table-stripedd text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Debit(m3/s)</th>
                                                <th>Nilai PH</th>
                                                <th>DO(m3/s)</th>
                                                <th>BOD(m3/s)</th>
                                                <th>COD(m3/s)</th>
                                                <th>TSS(mg/L)</th>
                                                <th>NO3-N(m3/s)</th>
                                                <th>T-Phosphat(m3/s)</th>
                                                <th>Fecal Coli(MPN/100 mL)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="debit_detail"></td>
                                                <td id="nilai_ph_detail"></td>
                                                <td id="do_detail"></td>
                                                <td id="bod_detail"></td>
                                                <td id="cod_detail"></td>
                                                <td id="tss_detail"></td>
                                                <td id="no3_n_detail"></td>
                                                <td id="t_phosphat_detail"></td>
                                                <td id="fecal_coli_detail"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL DETAIL PARAMETER END -->
            </div>
            <!-- MODAL ADD END -->
            <!-- MODAL UPDATE START -->
            <form action="<?php echo base_url('/Master_status_mutu_air/update_status_mutu_air'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                <div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                    <div class="modal-dialog modal-700" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Data Status Mutu Air</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
                            </div>
                            <div class="modal-body max-height-550">
                                <input id="id_update_status_mutu_air" name="id" type="hidden" class="form-control">
                                <div class="mb-3">
                                    <label class="col-form-label">Nama Sungai:</label>
                                    <select name="nama_sungai" id="nama_sungai" class="form-select">
                                        <option value="cisangkan">Cisangkan</option>
                                        <option value="cibaligo">Cibaligo</option>
                                        <option value="cibeureum">Cibeureum</option>
                                        <option value="cibabat">Cibabat</option>
                                        <option value="cimahi">Cimahi</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Titik Pantau:</label>
                                    <select name="titik_pantau" id="titik_pantau" class="form-select">
                                        <option value="hulu">Hulu</option>
                                        <option value="tengah">Tengah</option>
                                        <option value="hilir">Hilir</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Debit:</label>
                                    <input id="debit" name="debit" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Nilai Ph:</label>
                                    <input id="nilai_ph" name="nilai_ph" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">DO(m3/s):</label>
                                    <input id="do" name="do" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">BOD(m3/s):</label>
                                    <input id="bod" name="bod" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">COD(m3/s):</label>
                                    <input id="cod" name="cod" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">TSS(mg/L):</label>
                                    <input id="tss" name="tss" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">NO3-N(m3/s):</label>
                                    <input id="no3_n" name="no3_n" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">T-Phosphat(m3/s):</label>
                                    <input id="t_phosphat" name="t_phosphat" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Fecal Coli(MPN/100 mL):</label>
                                    <input id="fecal_coli" name="fecal_coli" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <button type="button" id="hitung-button" class="btn btn-primary btn-air-primary w-100" onclick="hitungStatusMutuAirUpdate()">
                                        Hitung status mutu air
                                    </button>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Nilai Pij:</label>
                                    <input id="nilai_pij" name="nilai_pij" type="text" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Status Mutu Air:</label>
                                    <input id="status_mutu_air" name="status_mutu_air" type="text" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Informasi Titik Pantau:</label>
                                    <br>
                                    <button type="button" class="btn btn-primary-light btn-air-light" data-bs-toggle="modal" data-bs-target="#informasiModal">
                                        Detail Informasi
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" onclick="closeModal()">Kembali</button>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL DETAIL INFORMASI START-->
                <div class="modal fade" id="informasiModal" tabindex="-1" role="dialog" aria-labelledby="informasiModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Informasi Titik Pantau</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-8 col-xl-6">
                                        <div id="maps_status_mutu" style="width: 100%; height: 570px;"></div>
                                    </div>
                                    <div class="col-sm-8 col-xl-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Latitude:</label>
                                            <input id="latitude" name="latitude" type="text" class="form-control" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="col-form-label">Longitude:</label>
                                            <input id="longitude" name="longitude" type="text" class="form-control" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="col-form-label">Gambar:</label>
                                            <input class="form-control" name="gambar" type="file" id="gambar">
                                            <img class="w-25 p-t-10" id="images">
                                        </div>

                                        <div class="mb-3">
                                            <label class="col-form-label">Video:</label>
                                            <input class="form-control" name="video" type="file" id="video">
                                            <video id="videoPlayer" class="w-50 p-t-10" autoplay type="video/mp4"></video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL DETAIL INFORMASI END -->
            </form>
            <!-- MODAL UPDATE END -->

            <!-- MODAL IMPORT START -->
            <form action="<?php echo base_url('/Master_status_mutu_air/import_status_mutu_air'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Import Data Status Mutu Air</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body max-height-550">
                                <div class="mb-3 text-center">
                                    <div class="alert alert-danger">
                                        <i data-feather="alert-octagon" class="m-r-5"></i>
                                        Harap download tempalate yang telah disediakan:
                                    </div>
                                    <a href="<?php echo base_url('/assets/template_excel/StatusMutuAir.xlsx'); ?>" download="Template excel status mutu air" type="button" class="btn btn-primary btn-air-primary w-50">
                                        Download Template
                                    </a>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">File Excel:</label>
                                    <input id="import_excel" name="import_excel" type="file" class="form-control" accept=".xlsx, .xls" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- MODAL IMPORT END -->
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/status_mutu_air.js'); ?>"></script>
<?= $this->endSection() ?>