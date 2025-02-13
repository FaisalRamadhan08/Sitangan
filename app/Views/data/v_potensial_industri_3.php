<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Potensial Pencemaran Industri Tier 3 <br> (Jumlah Karyawan Diketahui)</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Potensial Pencemaran Industri Tier 3 (Parameter BOD)</li>
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
                                <a href="/Master_potensial_industri_3/eksport" type="button" class="btn btn-pill btn-secondary btn-air-secondary mx-1">
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
                            <table class="table m-b-10 table-stripedd text-center" id="table_potensial_industri_3">
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
                <form action="<?php echo base_url('/Master_potensial_industri_3/add'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Potensial Industri Tier 3</h5>
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
                                        <label class="col-form-label">Jumlah Karyawan (orang):</label>
                                        <input id="param_1_formula_3_add" name="param_1_formula_3" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Emisi BOD (gr/hari/karyawan):</label>
                                        <select id="param_2_formula_3_add" name="param_2_formula_3" class="form-select">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Sektor Industri --</option>
                                            <option value="79.1">Pewarnaan/Pencelupan</option>
                                            <option value="37.9">Pangan</option>
                                            <option value="10.3">Logam</option>
                                            <option value="17.9">Kertas</option>
                                            <option value="47.1">Serat Poliester</option>
                                            <option value="219.2">Tekstil</option>
                                            <option value="96.4">Laundry</option>
                                            <option value="4.7">Mesin</option>
                                            <option value="57.3">Barang Plastik</option>
                                            <option value="13.5">Suku Cadang Mobil/Motor</option>
                                            <option value="2">Keramik dan Ubin</option>
                                            <option value="144.4">Penyamakan Kulit</option>
                                            <option value="50.4">Sabun dan Detergen</option>
                                            <option value="1898.2">Kimia</option>
                                            <option value="0.2">Barang Logam</option>
                                            <option value="0.6">Percetakan</option>
                                            <option value="0.3">Kaca</option>
                                            <option value="123">Rumah Sakit</option>
                                            <option value="55">Hotel</option>
                                            <option value="17">Restoran</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Konversi (1000):</label>
                                        <input id="param_3_formula_3_add" name="param_3_formula_3" type="text" class="form-control" value="1000" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-industri-3-button-add" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPindustri3()" disabled>
                                            Hitung Potensial Perindustrian Tier 3
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">PBP Perindustrian (Kg/hari):</label>
                                        <input id="pbp_industri_formula_3_add" name="pbp_industri_formula_3" type="text" class="form-control" readonly>
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
                <form action="<?php echo base_url('/Master_potensial_industri_3/update'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updatedModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data Potensial Industri Tier 3</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <input id="id_update_potensial_industri_3" name="id" type="hidden" class="form-control">
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
                                        <label class="col-form-label">Jumlah Karyawan (orang):</label>
                                        <input id="param_1_formula_3_update" name="param_1_formula_3" type="text" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Emisi BOD (gr/hari/karyawan):</label>
                                        <select id="param_2_formula_3_update" name="param_2_formula_3" class="form-select">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Sektor Industri --</option>
                                            <option value="79.1">Pewarnaan/Pencelupan</option>
                                            <option value="37.9">Pangan</option>
                                            <option value="10.3">Logam</option>
                                            <option value="17.9">Kertas</option>
                                            <option value="47.1">Serat Poliester</option>
                                            <option value="219.2">Tekstil</option>
                                            <option value="96.4">Laundry</option>
                                            <option value="4.7">Mesin</option>
                                            <option value="57.3">Barang Plastik</option>
                                            <option value="13.5">Suku Cadang Mobil/Motor</option>
                                            <option value="2">Keramik dan Ubin</option>
                                            <option value="144.4">Penyamakan Kulit</option>
                                            <option value="50.4">Sabun dan Detergen</option>
                                            <option value="1898.2">Kimia</option>
                                            <option value="0.2">Barang Logam</option>
                                            <option value="0.6">Percetakan</option>
                                            <option value="0.3">Kaca</option>
                                            <option value="123">Rumah Sakit</option>
                                            <option value="55">Hotel</option>
                                            <option value="17">Restoran</option>
                                        </select>
                                    </div>

                                    <div class=" mb-3">
                                        <label class="col-form-label">Faktor Konversi (1000):</label>
                                        <input id="param_3_formula_3_update" name="param_3_formula_3" type="text" class="form-control" value="1000" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-industri-3-button-update" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPindustri3Update()">
                                            Hitung Potensial Perindustrian Tier 3
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">PBP Perindustrian (Kg/hari):</label>
                                        <input id="pbp_industri_formula_3_update" name="pbp_industri_formula_3" type="text" class="form-control" readonly>
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
                                <h5 class="modal-title">Detail Parameter Potensial Industri Tier 3</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table m-b-10 table-stripedd text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Jumlah Karyawan (orang):</th>
                                                <th>Faktor Emisi BOD (gr/hari/karyawan):</th>
                                                <th>Faktor Konversi (1000):</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="param_1_formula_3_detail"></td>
                                                <td id="param_2_formula_3_detail"></td>
                                                <td id="param_3_formula_3_detail"></td>
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
                <form action="<?php echo base_url('/Master_potensial_industri_3/import'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
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
                                        <a href="<?php echo base_url('/assets/template_excel/PotensialIndustriTier3.xlsx'); ?>" download="Template excel Potensial Industri Tier 3" type="button" class="btn btn-primary btn-air-primary w-50">
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

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/potensial_industri_3.js'); ?>"></script>
<?= $this->endSection() ?>