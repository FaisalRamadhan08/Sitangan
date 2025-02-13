<!-- Page Body Start-->
<div class="page-body-wrapper sidebar-icon">
    <!-- Page Sidebar Start-->
    <header class="main-nav">
        <nav class=p-t-35>
            <div class="main-navbar">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="mainnav">
                    <ul class="nav-menu custom-scrollbar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        <li><a class="nav-link menu-title link-nav" href="dashboard"><i data-feather="home"></i><span>Dashboard</span></a></li>
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Sistem Informasi Geografis</h6>
                            </div>
                        </li>
                        <?php if (session()->get('role') !== 'user') : ?>
                            <li><a class="nav-link menu-title link-nav" href="informasi_titik_pantau"><i class='bx bx-map-pin'></i><span>Informasi Titik Pantau</span></a></li>
                        <?php endif ?>
                        <li><a class="nav-link menu-title link-nav" href="titik_pantau"><i data-feather="map-pin"></i><span>Titik Pantau</span></a></li>
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Kualitas Air Sungai</h6>
                            </div>
                        </li>

                        <?php if (session()->get('role') !== 'user') : ?>
                            <li><a class="nav-link menu-title link-nav" href="status_mutu_air"><i class="bx bx-water"></i><span>Status Mutu Air</span></a></li>
                        <?php else : ?>
                            <li><a class="nav-link menu-title link-nav cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalStatusMutuAir"><i class="bx bx-water"></i><span>Status Mutu Air</span></a></li>
                        <?php endif ?>

                        <li><a class="nav-link menu-title link-nav" href="index_kualitas_air"><i class='bx bx-line-chart'></i><span>Indeks Kualitas Air</span></a></li>
                        <li class="dropdown"><a class="nav-link menu-title"><i data-feather="box"></i><span>Beban Pencemaran</span></a>
                            <ul class="nav-submenu menu-content">
                                <?php if (session()->get('role') !== 'user') : ?>
                                    <li><a href="beban_pencemaran_eksisting_bod"><span>Beban Pencemaran Eksisting BOD</span></a></li>
                                <?php else : ?>
                                    <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalEksistingBOD">Beban Pencemaran Eksisting BOD</a></li>
                                <?php endif ?>
                                <li><a class="submenu-title" href="javascript:void(0)">Potensi Beban Pencemaran<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">
                                        <?php if (session()->get('role') !== 'user') : ?>
                                            <li><a href="potensial_domestik">Domestik</a></li>
                                            <li><a href="potensial_pertanian">Pertanian</a></li>
                                            <li><a href="potensial_peternakan">Peternakan</a></li>
                                            <li><a href="potensial_industri_1">Industri Tier 1</a></li>
                                            <li><a href="potensial_industri_2">Industri Tier 2</a></li>
                                            <li><a href="potensial_industri_3">Industri Tier 3</a></li>
                                        <?php else : ?>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalDomestik">Domestik</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalPertanian">Pertanian</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalPeternakan">Peternakan</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#Modalindustri_1">Industri Tier 1</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#Modalindustri_2">Industri Tier 2</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#Modalindustri_3">Industri Tier 3</a></li>
                                        <?php endif ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-main-title">
                            <div>
                                <h6>Kualitas Udara</h6>
                            </div>
                        </li>

                        <?php if (session()->get('role') !== 'user') : ?>
                            <li><a class="nav-link menu-title link-nav" href="status_mutu_udara"><i class="bx bx-wind"></i><span>Status Mutu Udara</span></a></li>
                        <?php else : ?>
                            <li><a class="nav-link menu-title link-nav cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalStatusMutuUdara"><i class="bx bx-water"></i><span>Status Mutu Udara</span></a></li>
                        <?php endif ?>

                        <li><a class="nav-link menu-title link-nav" href="index_kualitas_udara"><i class='bx bx-line-chart'></i><span>Indeks Kualitas Udara</span></a></li>
                        <li class="dropdown"><a class="nav-link menu-title"><i data-feather="box"></i><span>Forecasting</span></a>
                            <ul class="nav-submenu menu-content">
                                <?php if (session()->get('role') !== 'user') : ?>
                                    <li><a href="forecasting_ispu"><span>Forecasting Indeks Standar Pencemaran Udara</span></a></li>
                                <?php else : ?>
                                    <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalForecastingISPU">Forecasting Indeks Standar Pencemaran Udara</a></li>
                                <?php endif ?>
                                <li><a class="submenu-title" href="javascript:void(0)">Forecasting Berdasarkan Zat Pencemar<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">
                                        <?php if (session()->get('role') !== 'user') : ?>
                                            <li><a href="zat_so2">Zat SO2</a></li>
                                            <li><a href="zat_co">Zat CO</a></li>
                                            <li><a href="zat_no2">Zat NO2</a></li>
                                            <li><a href="zat_o3">Zat O3</a></li>
                                            <li><a href="zat_hc">Zat HC</a></li>
                                            <li><a href="zat_pm10">Zat PM10</a></li>
                                            <li><a href="zat_pm25">Zat PM2,5</a></li>
                                        <?php else : ?>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalSO2">Zat SO2</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalCO">Zat CO</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalNO2">Zat NO2</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalO3">Zat O3</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalHC">Zat HC</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalPM10">Zat PM10</a></li>
                                            <li><a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ModalPM25">Zat PM2,5</a></li>
                                        <?php endif ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <li class="sidebar-main-title">
                            <div>
                                <h6>Konfigurasi</h6>
                            </div>
                        </li>
                        <?php if (session()->get('role') === 'superadmin') : ?>
                            <li><a class="nav-link menu-title link-nav" href="users"><i data-feather="users"></i><span>Masterdata User</span></a></li>
                        <?php endif ?>
                        <li><a class="nav-link menu-title link-nav" href="rumus"><i class='bx bx-math'></i><span>Masterdata Rumus</span></a></li>
                        <?php if (session()->get('role') === 'superadmin') : ?>
                            <li><a class="nav-link menu-title link-nav" href="aktivitas_users"><i data-feather="briefcase"></i><span>Aktivitas User</span></a></li>
                        <?php endif ?>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
        </nav>
    </header>
    <!-- Page Sidebar Ends-->
    <?= $this->include('v_perhitungan_user') ?>