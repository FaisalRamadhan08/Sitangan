<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Beban Pencemaran Eksisting BOD</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Beban Pencemaran Eksisting BOD</li>
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
                                <a href="/Master_beban_pencemaran_eksisting_bod/eksport" type="button" class="btn btn-pill btn-secondary btn-air-secondary mx-1">
                                    <i class='bx bxs-file-export p-r-5'></i>
                                    Export Data
                                </a>
                            </div>

                            <div class="d-flex mt-2 mt-sm-0">
                                <button type="button" class="btn btn-pill btn-primary btn-air-primary w-100" data-bs-toggle="modal" data-bs-target="#addModal" onclick="addBod()">
                                    <i class='fa fa-plus p-r-5'></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_beban_pemcemaran_eksisting_bod">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Sungai</th>
                                        <th>Titik Pantau</th>
                                        <th>Nilai DTBP(kg/hari)</th>
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
                <form action="<?php echo base_url('/Master_beban_pencemaran_eksisting_bod/add'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Beban Pencemaran Eksisting BOD</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        <label class="col-form-label">Konsentrasi Baku Mutu Maksimum (mg/l):</label>
                                        <input id="konsentrasi_baku_mutu_maksimum_add" name="konsentrasi_baku_mutu_maksimum" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Debit Air Sungai Maksimum (m³/detik):</label>
                                        <input id="debit_air_sungai_maksimum_add" name="debit_air_sungai_maksimum" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor-K Maksimum:</label>
                                        <input id="faktor_k_maksimum_add" name="faktor_k_maksimum" type="text" class="form-control" value="86.4" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-bpm-button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiBPM()" disabled>
                                            Hitung Beban Pencemaran Maksimum
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai BPM (kg/hari):</label>
                                        <input id="bpm_add" name="bpm" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Konsentrasi Aktual (mg/l):</label>
                                        <input id="konsentrasi_aktual_add" name="konsentrasi_aktual" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Debit Air Sungai Aktual (m³/detik):</label>
                                        <input id="debit_air_sungai_aktual_add" name="debit_air_sungai_aktual" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor-K Aktual:</label>
                                        <input id="faktor_k_aktual_add" name="faktor_k_aktual" type="text" class="form-control" value="86.4" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-bpa-button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiBPA()" disabled>
                                            Hitung Beban Pencemaran Aktual
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai BPA (kg/hari):</label>
                                        <input id="bpa_add" name="bpa" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-dtbp-button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiDTBP()" disabled>
                                            Hitung Daya Tampung Beban Pencemaran
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai DTBP (kg/hari):</label>
                                        <input id="dtbp_add" name="dtbp" type="text" class="form-control" readonly>
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
                <form action="<?php echo base_url('/Master_beban_pencemaran_eksisting_bod/update'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updatedModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog modal-700" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data Beban Pencemaran Eksisting BOD</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <input id="id_update_eksisting_bod" name="id" type="hidden" class="form-control">
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama Sungai:</label>
                                        <select id="nama_sungai_update" name="nama_sungai" class="form-select">
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
                                        <label class="col-form-label">Konsentrasi Baku Mutu Maksimum (mg/l):</label>
                                        <input id="konsentrasi_baku_mutu_maksimum_update" name="konsentrasi_baku_mutu_maksimum" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Debit Air Sungai Maksimum (m³/detik):</label>
                                        <input id="debit_air_sungai_maksimum_update" name="debit_air_sungai_maksimum" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor-K Maksimum:</label>
                                        <input id="faktor_k_maksimum_update" name="faktor_k_maksimum" type="text" class="form-control" value="86.4" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-bpm-button-update" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiBPMUpdate()">
                                            Hitung Beban Pencemaran Maksimum
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai BPM (kg/hari):</label>
                                        <input id="bpm_update" name="bpm" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Konsentrasi Aktual (mg/l):</label>
                                        <input id="konsentrasi_aktual_update" name="konsentrasi_aktual" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Debit Air Sungai Aktual (m³/detik):</label>
                                        <input id="debit_air_sungai_aktual_update" name="debit_air_sungai_aktual" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Faktor-K Aktual:</label>
                                        <input id="faktor_k_aktual_update" name="faktor_k_aktual" type="text" class="form-control" value="86.4" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-bpa-button-update" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiBPAUpdate()">
                                            Hitung Beban Pencemaran Aktual
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai BPA (kg/hari):</label>
                                        <input id="bpa_update" name="bpa" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="hitung-dtbp-button-update" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiDTBPUpdate()">
                                            Hitung Daya Tampung Beban Pencemaran
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Nilai DTBP (kg/hari):</label>
                                        <input id="dtbp_update" name="dtbp" type="text" class="form-control" readonly>
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
                                <h5 class="modal-title">Detail Parameter Beban Pencemaran Eksisting BOD</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table m-b-10 table-stripedd text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Konsentrasi Baku Mutu Maksimum (mg/l)</th>
                                                <th>Debit Air Sungai Maksimum (m³/detik)</th>
                                                <th>Faktor-K Maksimum</th>
                                                <th>Nilai BPM(kg/hari)</th>
                                                <th>Konsentrasi Aktual (mg/l)</th>
                                                <th>Debit Air Sungai Aktual(m³/detik)</th>
                                                <th>Faktor-K Aktual</th>
                                                <th>Nilai BPA(kg/hari)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="konsentrasi_baku_mutu_maksimum_detail"></td>
                                                <td id="debit_air_sungai_maksimum_detail"></td>
                                                <td id="faktor_k_maksimum_detail"></td>
                                                <td id="bpm_detail"></td>
                                                <td id="konsentrasi_aktual_detail"></td>
                                                <td id="debit_air_sungai_aktual_detail"></td>
                                                <td id="faktor_k_aktual_detail"></td>
                                                <td id="bpa_detail"></td>
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
                <form action="<?php echo base_url('/Master_beban_pencemaran_eksisting_bod/import'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Import Data Beban Pencemaran Eksisting BOD</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body max-height-550">
                                    <div class="mb-3 text-center">
                                        <div class="alert alert-danger">
                                            <i data-feather="alert-octagon" class="m-r-5"></i>
                                            Harap download tempalate yang telah disediakan:
                                        </div>
                                        <a href="<?php echo base_url('/assets/template_excel/BebanPencemaranEksistingBOD.xlsx'); ?>" download="Template excel beban pencemaran eksisting BOD" type="button" class="btn btn-primary btn-air-primary w-50">
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

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/beban_pemcemaran_eksisting_bod.js'); ?>"></script>
<?= $this->endSection() ?>