<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
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
                    <div class="col-lg-3 col-md-4 mb-3 pt-3">
                        <div class="card-dashboard">
                            <div class="card-bodyika">
                                <div class="d-flex align-items-center">
                                    <div class="card-iconika rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bxs-location-plus"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="card-titleika">Titik Pantau Per Sungai</h6>
                                        <h5 class="card-titleika">3</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 mb-3 pt-3">
                        <div class="card-dashboard">
                            <div class="card-bodyika">
                                <div class="d-flex align-items-center">
                                    <div class="card-iconika rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bxs-bar-chart-alt-2"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="card-titleika">Jumlah Sungai</h6>
                                        <h5 class="card-titleika">5</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 mb-3 pt-3">
                        <div class="card-dashboard">
                            <div class="card-bodyika">
                                <div class="d-flex align-items-center">
                                    <div class="card-iconika rounded-circle d-flex align-items-center justify-content-center">
                                        <i class='bx bx-current-location'></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="card-titleika">Jumlah Titik Pantau</h6>
                                        <h5 class="card-titleika">15</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 mb-3 pt-3">
                        <div class="card-dashboard ">
                            <div class="card-bodyika">
                                <div class="d-flex align-items-center">
                                    <div class="card-iconika rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bxs-bar-chart-alt-2"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="card-titleika">Jumlah Kecamatan</h6>
                                        <h5 class="card-titleika">3</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs justify-content-center" id="icon-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#status_mutu_air" role="tab" aria-controls="status_mutu_air" aria-selected="true">Status Mutu Air</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#index_kualitas_air" role="tab" aria-controls="index_kualitas_air" aria-selected="false">Indeks Kualitas Air</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#beban_pencemaran_eksisting" role="tab" aria-controls="beban_pencemaran_ekesisting" aria-selected="false">Beban Pencemaran Eksisting</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#status_mutu_udara" role="tab" aria-controls="status_mutu_udara" aria-selected="false">Status Mutu Udara</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#index_kualitas_udara" role="tab" aria-controls="#index_kualitas_udara" aria-selected="false">Indeks Kualitas Udara</a></li>
                        </ul>
                        <div class="tab-content" id="icon-tabContent">
                            <div class="tab-pane fade show active" id="status_mutu_air" role="tabpanel">
                                <div class="d-flex m-t-15 m-b-5">
                                    <label class="col-form-label m-r-10">Filter:</label>
                                    <div class="col-xl-10 col-sm-9 mx-1">
                                        <input class="datepicker-here form-control digits" id="filterstatusmutuair" type="text" data-language="en" data-min-view="months" data-view="months" data-date-format="MM yyyy" value="<?= date('F Y') ?>">
                                    </div>
                                    <button class=" btn btn-primary btn-air-primary" onclick="getDataStatusmutuair()">
                                        Tampilkan
                                    </button>
                                </div>
                                <div id="statusmutuair"></div>
                            </div>
                            <div class="tab-pane fade" id="index_kualitas_air" role="tabpanel">
                                <div class="d-flex m-t-15 m-b-5">
                                    <label class="col-form-label m-r-10">Filter:</label>
                                    <div class="col-xl-10 col-sm-9 mx-1">
                                        <input class="form-control digits" type="text" name="datefilter" id="filterindexkualitasair" value="<?= date('m/d/Y') ?> - <?= date('m/d/Y', strtotime('+30 days')) ?>">
                                    </div>
                                    <button class=" btn btn-primary btn-air-primary" onclick="getDataIndexKualitasAir()">
                                        Tampilkan
                                    </button>
                                </div>
                                <div id="indexkualitasair"></div>
                            </div>
                            <div class="tab-pane fade" id="beban_pencemaran_eksisting" role="tabpanel">
                                <div class="d-flex m-t-15 m-b-5">
                                    <label class="col-form-label m-r-10">Filter:</label>
                                    <div class="col-xl-10 col-sm-9 mx-1">
                                        <input class="datepicker-here form-control digits" id="filterbebanpencemaraneksisting" type="text" data-language="en" data-min-view="months" data-view="months" data-date-format="MM yyyy" value="<?= date('F Y') ?>">
                                    </div>
                                    <button class=" btn btn-primary btn-air-primary" onclick="getDataBebanPencemaranEksisting()">
                                        Tampilkan
                                    </button>
                                </div>
                                <div id="bebanpencemaraneksisting"></div>
                            </div>
                            <div class="tab-pane fade" id="index_kualitas_udara" role="tabpanel">
                                <div class="d-flex m-t-15 m-b-5">
                                    <label class="col-form-label m-r-10">Filter:</label>
                                    <div class="col-xl-10 col-sm-9 mx-1">
                                        <input class="form-control digits" type="text" name="datefilter" id="filterindexkualitasudara" value="<?= date('m/d/Y') ?> - <?= date('m/d/Y', strtotime('+30 days')) ?>">
                                    </div>
                                    <button class=" btn btn-primary btn-air-primary" onclick="getDataIndexKualitasUdara()">
                                        Tampilkan
                                    </button>
                                </div>
                                <div class="tab-content" id="icon-tabContent">
                            <div class="tab-pane fade show active" id="status_mutu_udara" role="tabpanel">
                                <div class="d-flex m-t-15 m-b-5">
                                    <label class="col-form-label m-r-10">Filter:</label>
                                    <div class="col-xl-10 col-sm-9 mx-1">
                                        <input class="datepicker-here form-control digits" id="filterstatusmutuudara" type="text" data-language="en" data-min-view="months" data-view="months" data-date-format="MM yyyy" value="<?= date('F Y') ?>">
                                    </div>
                                    <button class=" btn btn-primary btn-air-primary" onclick="getDataStatusmutuudara()">
                                        Tampilkan
                                    </button>
                                </div>
                                <div id="statusmutuudara"></div>
                            </div>
                            <div class="tab-pane fade" id="index_kualitas_udara" role="tabpanel">
                                <div class="d-flex m-t-15 m-b-5">
                                    <label class="col-form-label m-r-10">Filter:</label>
                                    <div class="col-xl-10 col-sm-9 mx-1">
                                        <input class="form-control digits" type="text" name="datefilter" id="filterindexkualitasudara" value="<?= date('m/d/Y') ?> - <?= date('m/d/Y', strtotime('+30 days')) ?>">
                                    </div>
                                    <button class=" btn btn-primary btn-air-primary" onclick="getDataIndexKualitasUdara()">
                                        Tampilkan
                                    </button>
                                </div>
                                <div id="indexkualitasudara"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/dashboard.js'); ?>"></script>
<?= $this->endSection() ?>