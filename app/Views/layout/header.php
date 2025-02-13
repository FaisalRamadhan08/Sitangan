    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <div class="logo-wrapper p-l-20">
                        <a href="/dashboard"><img class="img-fluid" style="width: 130px; height: auto;" src="/assets/images/logo/logo-sitangan.png" alt="logo"></a>
                    </div>

                    <div class="dark-logo-wrapper p-l-20">
                        <a href="/dashboard"><img class="img-fluid" style="width: 130px; height: auto;" src="/assets/images/logo/logo-sitangan.png" alt="logo"></a>
                    </div>
                    <div class="toggle-sidebar" title='Toggle Sidebar'><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
                </div>

                <div class="nav-right col pull-right right-menu p-0">
                    <ul class="nav-menus">

                        <li><a class="text-dark" href="#!" title='Full Screen' onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>

                        <li>
                            <div class="mode" title='Dark'><i class="fa fa-moon-o"></i></div>
                        </li>

                        <li class="onhover-dropdown">
                            <div class="bookmark-box">
                                <?php
                                $gambarSesi = session()->get('gambar');
                                $gambarSrc = empty($gambarSesi) ? 'assets/images/default/sample.png' : base_url('assets/images/users/') . $gambarSesi;
                                ?>
                                <img src="<?= $gambarSrc; ?>" alt="Profile" class="rounded-circle img-30">
                            </div>

                            <div class="bookmark-dropdown onhover-show-div b-r-10">
                                <ul class="m-t-5 ">
                                    <center>
                                        <li class="dropdown-header">
                                            <h6><?= session()->get('nama_user') ?></h6>
                                            <span><?= session()->get('role') ?></span>
                                        </li>
                                    </center>
                                    <hr>
                                    <div class="d-flex justify-content-center">
                                        <button class="onhover-dropdown p-0 btn btn-primary mx-1">
                                            <a class="btn txt-light" type="button" href="#" data-bs-toggle="modal" data-bs-target="#updatedProfileModal" onclick="upadatePrifle()">
                                                <i data-feather="settings" class="m-r-5"></i>
                                                Update Profile
                                            </a>
                                        </button>

                                        <button class="onhover-dropdown p-0 btn btn-primary">
                                            <a class="btn txt-light" type="button" href="<?php echo base_url('/Master_login/logout'); ?>">
                                                <i data-feather="log-out" class="m-r-5"></i>
                                                Logout
                                            </a>
                                        </button>
                                    </div>
                                    <hr>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>

        <!-- MODAL UPDATE PROFILE START -->
        <div class="modal fade" id="updatedProfileModal" tabindex="-1" role="dialog" aria-labelledby="updatedProfileModalLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?php echo base_url('/Master_login/updated_profile'); ?>" method="post" class="theme-form" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Profile</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input id="id" name="id" type="hidden" class="form-control" value="<?= session()->get('id'); ?>">
                            <div class="mb-3">
                                <label class="col-form-label">Name:</label>
                                <input id="nama" name="nama" type="text" class="form-control" value="<?= session()->get('nama_user'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Email:</label>
                                <input id="email" name="email" type="email" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Password:</label>
                                <input id="password" name="password" type="password" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Gambar:</label>
                                <input id="gambar" name="gambar" type="file" class="form-control" accept=".png, .jpg, .jpeg">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL UPDATE PROFILE END -->

        <script>
            function upadatePrifle() {
                $("#password").val("");
            }
        </script>