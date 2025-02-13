<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Potensial Pencemaran Domestik</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Potensial Pencemaran Domestik</li>
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
                                <a href="/Master_potensial_domestik/eksport" type="button" class="btn btn-pill btn-secondary btn-air-secondary mx-1">
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
                            <table class="table m-b-10 table-stripedd text-center" id="table_potensial_domestik">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>DAS</th>
                                        <th>Titik Pantau</th>
                                        <th>PBP Domestik</th>
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
                <form action="<?php echo base_url('/Master_potensial_domestik/add'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Potensial Domestik</h5>
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
                                        <label class="col-form-label">Jumlah Penduduk:</label>
                                        <input id="jumlah_penduduk_add" name="jumlah_penduduk" type="number" min="0" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Emisi:</label>
                                        <select id="faktor_emisi_add" name="faktor_emisi" class="form-select form-control">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Faktor Emisi--</option>
                                            <option value="38">TSS</option>
                                            <option value="40">BOD</option>
                                            <option value="55">COD</option>
                                            <option value="1.95">Total-N</option>
                                            <option value="0.21">Total-P</option>
                                        </select>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="col-form-label">Rasio Ekivalen Kota:</label>
                                        <select id="rasio_ekivalen_kota_add" name="rasio_ekivalen_kota" class="form-select form-control">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Rasio Ekivalen --</option>
                                            <option value="1">Kota</option>
                                            <option value="0.8125">Pinggiran Kota</option>
                                            <option value="0.6250">Pedalaman</option>
                                        </select>
                                    </div>

                                    <div class=" mb-3">
                                        <label class="col-form-label">Rasio Ekivalen Kota:</label>
                                        <select id="koefisien_transfer_beban_add" name="koefisien_transfer_beban" class="form-select form-control">
                                            <option selected="" disabled="" value="">-- Pilih Jarak Terhadap Sungai --</option>
                                            <option value="1">0-100</option>
                                            <option value="0.85">100-500</option>
                                            <option value="0.3">>500</option>
                                        </select>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="col-form-label">Faktor Konversi:</label>
                                        <input id="faktor_konversi_add" name="faktor_konversi" type="text" class="form-control" value="1000" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai Alpha:</label>
                                        <input id="nilai_alpha_add" name="nilai_alpha" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-domestik-button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPDomestik()" disabled>
                                            Hitung Potensial Domestik
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai PBP Domestik:</label>
                                        <input id="pbp_domestik_add" name="pbp_domestik" type="text" class="form-control" readonly>
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
                <form action="<?php echo base_url('/Master_potensial_domestik/update'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updatedModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data Potensial Domestik</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <input id="id_update_potensial_domestik" name="id" type="hidden" class="form-control">
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
                                        <label class="col-form-label">Jumlah Penduduk:</label>
                                        <input id="jumlah_penduduk_update" name="jumlah_penduduk" type="number" min="0" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor Emisi:</label>
                                        <select id="faktor_emisi_update" name="faktor_emisi" class="form-select form-control">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Faktor Emisi--</option>
                                            <option value="38">TSS</option>
                                            <option value="40">BOD</option>
                                            <option value="55">COD</option>
                                            <option value="1.95">Total-N</option>
                                            <option value="0.21">Total-P</option>
                                        </select>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="col-form-label">Rasio Ekivalen Kota:</label>
                                        <select id="rasio_ekivalen_kota_update" name="rasio_ekivalen_kota" class="form-select form-control">
                                            <option selected="" disabled="" value="">-- Pilih Jenis Rasio Ekivalen --</option>
                                            <option value="1">Kota</option>
                                            <option value="0.8125">Pinggiran Kota</option>
                                            <option value="0.6250">Pedalaman</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Rasio Ekivalen Kota:</label>
                                        <select id="koefisien_transfer_beban_update" name="koefisien_transfer_beban" class="form-select form-control">
                                            <option selected="" disabled="" value="">-- Pilih Jarak Terhadap Sungai --</option>
                                            <option value="1">0-100</option>
                                            <option value="0.85">100-500</option>
                                            <option value="0.3">>500</option>
                                        </select>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="col-form-label">Faktor Konversi:</label>
                                        <input id="faktor_konversi_update" name="faktor_konversi" type="text" class="form-control" value="1000" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai Alpha:</label>
                                        <input id="nilai_alpha_update" name="nilai_alpha" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-potensial-domestik-button-update" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPDomestikUpdate()">
                                            Hitung Potensial Domestik
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai PBP Domestik:</label>
                                        <input id="pbp_domestik_update" name="pbp_domestik" type="text" class="form-control" readonly>
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
                                <h5 class="modal-title">Detail Parameter Potensial Domestik</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table m-b-10 table-stripedd text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Jumlah Penduduk</th>
                                                <th>Faktor Emisi</th>
                                                <th>Rasio Ekivalen Kota</th>
                                                <th>Koefisien Transfer Beban</th>
                                                <th>Faktor Konversi</th>
                                                <th>Nilai Alpha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="jumlah_penduduk_detail"></td>
                                                <td id="faktor_emisi_detail"></td>
                                                <td id="rasio_ekivalen_kota_detail"></td>
                                                <td id="koefisien_transfer_beban_detail"></td>
                                                <td id="faktor_konversi_detail"></td>
                                                <td id="nilai_alpha_detail"></td>
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
                <form action="<?php echo base_url('/Master_potensial_domestik/import'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Import Data Potensial Domestik</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <div class="mb-3 text-center">
                                        <div class="alert alert-danger">
                                            <i data-feather="alert-octagon" class="m-r-5"></i>
                                            Harap download tempalate yang telah disediakan:
                                        </div>
                                        <a href="<?php echo base_url('/assets/template_excel/PotensialDomestik.xlsx'); ?>" download="Template excel Potensial Domestik" type="button" class="btn btn-primary btn-air-primary w-50">
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

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/potensial_domestik.js'); ?>"></script>
<?= $this->endSection() ?>