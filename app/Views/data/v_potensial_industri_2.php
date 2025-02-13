<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Potensial Pencemaran Industri Tier 2 <br> (Debit Dan Konsentrasi Diketahui)</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Potensial Pencemaran Industri Tier 2 (Parameter BOD)</li>
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
                                <a href="/Master_potensial_industri_2/eksport" type="button" class="btn btn-pill btn-secondary btn-air-secondary mx-1">
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
                            <table class="table m-b-10 table-stripedd text-center" id="table_potensial_industri_2">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kecamatan</th>
                                        <th>Nama Perusahaan</th>
                                        <th>PBP Perindustrian (Kg/hari)</th>
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
                <form action="<?php echo base_url('/Master_potensial_industri_2/add'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Potensial Industri Tier 2</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <div class="mb-3">
                                        <label class="col-form-label">Kecamatan:</label>
                                        <select id="kecamatan_add" name="kecamatan" class="form-select">
                                            <option value="cimahi utara">Cimahi Utara</option>
                                            <option value="cimahi tengah">Cimahi Tengah</option>
                                            <option value="cimahi selatan">Cimahi Selatan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama Perusahaan:</label>
                                        <input id="nama_perusahaan_add" name="nama_perusahaan" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Konsentrasi Limbah Industri (mg/l):</label>
                                        <input id="param_1_formula_2_add" name="param_1_formula_2" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Laju Alir Buangan Air Limbah (l/jam):</label>
                                        <input id="param_2_formula_2_add" name="param_2_formula_2" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Jumlah Jam Operasi Per-tahun (jam/tahun):</label>
                                        <input id="param_3_formula_2_add" name="param_3_formula_2" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor konversi (mg/kg):</label>
                                        <input id="param_4_formula_2_add" name="param_4_formula_2" type="text" class="form-control" value="100000" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-industri-2-button-add" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPindustri2()" disabled>
                                            Hitung Potensial Perindustrian Tier 2
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">PBP Perindustrian (Kg/hari):</label>
                                        <input id="pbp_industri_formula_2_add" name="pbp_industri_formula_2" type="text" class="form-control" readonly>
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
                <form action="<?php echo base_url('/Master_potensial_industri_2/update'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updatedModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data Potensial Industri Tier 2</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <input id="id_update_potensial_industri_2" name="id" type="hidden" class="form-control">
                                    <div class="mb-3">
                                        <label class="col-form-label">Kecamatan:</label>
                                        <select id="kecamatan_update" name="kecamatan" class="form-select">
                                            <option value="cimahi utara">Cimahi Utara</option>
                                            <option value="cimahi tengah">Cimahi Tengah</option>
                                            <option value="cimahi selatan">Cimahi Selatan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama Perusahaan:</label>
                                        <input id="nama_perusahaan_update" name="nama_perusahaan" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Konsentrasi Limbah Industri (mg/l):</label>
                                        <input id="param_1_formula_2_update" name="param_1_formula_2" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Laju Alir Buangan Air Limbah (l/jam):</label>
                                        <input id="param_2_formula_2_update" name="param_2_formula_2" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Jumlah Jam Operasi Per-tahun (jam/tahun):</label>
                                        <input id="param_3_formula_2_update" name="param_3_formula_2" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor konversi (mg/kg):</label>
                                        <input id="param_4_formula_2_update" name="param_4_formula_2" type="text" class="form-control" value="100000" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-industri-2-button-update" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPindustri2Update()">
                                            Hitung Potensial Perindustrian Tier 2
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">PBP Perindustrian (Kg/hari):</label>
                                        <input id="pbp_industri_formula_2_update" name="pbp_industri_formula_2" type="text" class="form-control" readonly>
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
                                <h5 class="modal-title">Detail Parameter Potensial Industri Tier 2</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table m-b-10 table-stripedd text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Konsentrasi Limbah Industri (mg/l):</th>
                                                <th>Laju Alir Buangan Air Limbah (l/jam):</th>
                                                <th>Jumlah Jam Operasi Per-tahun (jam/tahun):</th>
                                                <th>Faktor konversi (mg/kg):</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="param_1_formula_2_detail"></td>
                                                <td id="param_2_formula_2_detail"></td>
                                                <td id="param_3_formula_2_detail"></td>
                                                <td id="param_4_formula_2_detail"></td>
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
                <form action="<?php echo base_url('/Master_potensial_industri_2/import'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Import Data Potensial Industri Tier 2</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <div class="mb-3 text-center">
                                        <div class="alert alert-danger">
                                            <i data-feather="alert-octagon" class="m-r-5"></i>
                                            Harap download tempalate yang telah disediakan:
                                        </div>
                                        <a href="<?php echo base_url('/assets/template_excel/PotensialIndustriTier2.xlsx'); ?>" download="Template excel Potensial Industri Tier 2" type="button" class="btn btn-primary btn-air-primary w-50">
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

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/potensial_industri_2.js'); ?>"></script>
<?= $this->endSection() ?>