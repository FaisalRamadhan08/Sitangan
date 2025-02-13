<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Potensial Pencemaran Pertanian</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Potensial Pencemaran Pertanian</li>
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
                        <div class="d-flex flex-column flex-sm-row justify-content-between p-b-40">
                            <div class="d-flex">
                                <button type="button" class="btn btn-pill btn-primary btn-air-primary mx-1" data-bs-toggle="modal" data-bs-target="#importModal">
                                    <i class='bx bxs-file-import p-r-5'></i>
                                    Import Data
                                </button>
                                <a href="/Master_potensial_pertanian/eksport" type="button" class="btn btn-pill btn-secondary btn-air-secondary mx-1">
                                    <i class='bx bxs-file-export p-r-5'></i>
                                    Export Data
                                </a>
                            </div>

                            <div class="d-flex mt-2 mt-sm-0">
                                <button type="button" class="btn btn-pill btn-primary btn-air-primary w-100" data-bs-toggle="modal" data-bs-target="#addModal" onclick="add()">
                                    <i class='fa fa-plus p-r-5'></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_potensial_pertanian">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>DAS</th>
                                        <th>Titik Pantau</th>
                                        <th>PBP Pertanian</th>
                                        <th>Detail</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- MODAL ADD START -->
                <form action="<?php echo base_url('/Master_potensial_pertanian/add'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Potensial Pertanian</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <div class="mb-3">
                                        <label class="col-form-label">Das:</label>
                                        <select id="das_add" name="das" class="form-select">
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
                                        <label class="col-form-label">Jenis Pertanian:</label>
                                        <select id="jenis_pertanian_add" name="jenis_pertanian" class="form-select">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Pertanian --</option>
                                            <option value="sawah">Sawah</option>
                                            <option value="palawija">Palawija</option>
                                            <option value="perkebunan lain">Perkebunan Lain</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama Parameter:</label>
                                        <select id="nama_parameter_add" name="nama_parameter" class="form-select">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Parameter --</option>
                                            <option value="tss">TSS</option>
                                            <option value="bod">BOD</option>
                                            <option value="cod">COD</option>
                                            <option value="total-n">Total-N</option>
                                            <option value="total-p">Total-P</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Emisi (kg/ha/musim tanam):</label>
                                        <input id="faktor_emisi_add" name="faktor_emisi" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Luas Lahan:</label>
                                        <input id="luas_lahan_add" name="luas_lahan" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Pengali:</label>
                                        <input id="faktor_pengali_add" name="faktor_pengali" type="text" class="form-control" readonly>
                                    </div>

                                    <div class=" mb-3">
                                        <label class="col-form-label">Lama Musim Tanam(hari):</label>
                                        <input id="lama_musim_tanam_add" name="lama_musim_tanam" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-pertanian-button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPPertanian()" disabled>
                                            Hitung Potensial Pertanian
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai PBP Pertanian:</label>
                                        <input id="pbp_pertanian_add" name="pbp_pertanian" type="text" class="form-control" readonly>
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
                <!-- MODAL ADD END-->

                <!-- MODAL UPDATE START -->
                <form action="<?php echo base_url('/Master_potensial_pertanian/update'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updatedModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data Potensial Pertanian</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <input id="id_update_potensial_pertanian" name="id" type="hidden" class="form-control">
                                    <div class="mb-3">
                                        <label class="col-form-label">Das:</label>
                                        <select id="das_update" name="das" class="form-select">
                                            <option value="cisangkan">Cisangkan</option>
                                            <option value="cibaligo">Cibaligo</option>
                                            <option value="cibeureum">Cibeureum</option>
                                            <option value="cibabat">Cibabat</option>
                                            <option value="cimahi">Cimahi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Titik Pantau:</label>
                                        <select id="titik_pantau_update" name="titik_pantau" class="form-select">
                                            <option value="hulu">Hulu</option>
                                            <option value="tengah">Tengah</option>
                                            <option value="hilir">Hilir</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Jenis Pertanian:</label>
                                        <select id="jenis_pertanian_update" name="jenis_pertanian" class="form-select">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Pertanian --</option>
                                            <option value="sawah">Sawah</option>
                                            <option value="palawija">Palawija</option>
                                            <option value="perkebunan lain">Perkebunan Lain</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama Parameter:</label>
                                        <select id="nama_parameter_update" name="nama_parameter" class="form-select">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Parameter --</option>
                                            <option value="tss">TSS</option>
                                            <option value="bod">BOD</option>
                                            <option value="cod">COD</option>
                                            <option value="total-n">Total-N</option>
                                            <option value="total-p">Total-P</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Emisi (kg/ha/musim tanam):</label>
                                        <input id="faktor_emisi_update" name="faktor_emisi" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Luas Lahan:</label>
                                        <input id="luas_lahan_update" name="luas_lahan" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Pengali:</label>
                                        <input id="faktor_pengali_update" name="faktor_pengali" type="text" class="form-control" readonly>
                                    </div>

                                    <div class=" mb-3">
                                        <label class="col-form-label">Lama Musim Tanam(hari):</label>
                                        <input id="lama_musim_tanam_update" name="lama_musim_tanam" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-pertanian-button-update" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPPertanianUpdate()">
                                            Hitung Potensial Pertanian
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai PBP Pertanian:</label>
                                        <input id="pbp_pertanian_update" name="pbp_pertanian" type="text" class="form-control" readonly>
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
                <!-- MODAL UPDATE END -->

                <!-- MODAL DETAIL PARAMETER START-->
                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                    <div class="modal-dialog modal-1200" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Parameter Potensial Pertanian</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table m-b-10 table-stripedd text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Jenis Pertanian</th>
                                                <th>Nama Parameter</th>
                                                <th>Faktor Emisi</th>
                                                <th>Luas Lahan</th>
                                                <th>Faktor Pengali</th>
                                                <th>Lama Musim Tanam</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="jenis_pertanian_detail"></td>
                                                <td id="nama_parameter_detail"></td>
                                                <td id="faktor_emisi_detail"></td>
                                                <td id="luas_lahan_detail"></td>
                                                <td id="faktor_pengali_detail"></td>
                                                <td id="lama_musim_tanam_detail"></td>
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

                <!-- MODAL IMPORT START -->
                <form action="<?php echo base_url('/Master_potensial_pertanian/import'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Import Data Potensial Pertanian</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <div class="mb-3 text-center">
                                        <div class="alert alert-danger">
                                            <i data-feather="alert-octagon" class="m-r-5"></i>
                                            Harap download tempalate yang telah disediakan:
                                        </div>
                                        <a href="<?php echo base_url('/assets/template_excel/PotensialPertanian.xlsx'); ?>" download="Template excel Potensial Pertanian" type="button" class="btn btn-primary btn-air-primary w-50">
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
</div>

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/potensial_pertanian.js'); ?>"></script>
<?= $this->endSection() ?>