<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Informasi Titik Pantau</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Informasi Titik Pantau</li>
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
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_informasi_titik_pantau">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Lokasi</th>
                                        <th>Titik Pantau</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Waktu Pantau</th>
                                        <th>Detail Media</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <!-- MODAL DETAIL MEDIA START-->
                        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
                            <div class="modal-dialog modal-700" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Media Informasi Titik Pantau</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                                        <div class="mb-3">
                                            <label class="col-form-label">Gambar:</label>
                                            <img class="w-100" id="images">
                                        </div>

                                        <div class="mb-3">
                                            <label class="col-form-label">Video:</label>
                                            <video id="videoPlayer" controls class="w-100" autoplay type="video/mp4"></video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- MODAL DETAIL MEDIA END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/informasi_titik_pantau.js'); ?>"></script>

<?= $this->endSection() ?>