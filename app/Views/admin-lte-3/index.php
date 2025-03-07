<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $Pengaturan->judul ?></title>

        <!--FAVICON DISINI-->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url((!empty($Pengaturan->favicon) ? 'file/app/' . $Pengaturan->favicon : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/fontawesome-free/css/all.min.css') ?>">
        <!-- IonIcons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/dist/css/adminlte.min.css') ?>">
        <!--JQuery UI-->
        <link href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/jquery-ui/jquery-ui.min.css') ?>" rel="stylesheet">

        <!-- REQUIRED SCRIPTS -->
        <!-- JQuery Pack -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/jquery-ui/jquery-ui.js') ?>"></script>
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/moment/moment.min.js') ?>"></script>
        
        <!-- Bootstrap -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        
        <!-- AdminLTE Pack -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/dist/js/adminlte.js') ?>"></script>
        <script src="https://kit.fontawesome.com/6a88a04e5c.js" crossorigin="anonymous"></script>
        
        <!-- Plugin Tanggal Rentang -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/daterangepicker/daterangepicker.js') ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/daterangepicker/daterangepicker.css'); ?>">
        
        
        <!-- JQUERY AUTO NUMBER -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/JAutoNumber/autonumeric.js') ?>"></script>
        
        <!-- Toastr -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.css') ?>">
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.js') ?>"></script>
        
        <!-- Select2 -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/select2/js/select2.full.min.js') ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/select2/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <?php echo view($menu_atas) ?>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('logout.php') ?>" role="button" onclick="return confirm('Ingin keluar ?')">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar elevation-0 sidebar-light-info">
                <!-- Brand Logo -->
                <a href="<?php echo base_url('dashboard.php') ?>" class="brand-link">
                    <img src="<?php echo base_url((!empty($Pengaturan->logo_header) ? 'file/app/' . $Pengaturan->logo_header : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="<?php echo $Pengaturan->judul . ' Logo'; ?>" class="brand-image img-circle elevation-0" style="width: 33px; height: 33px; background-color: #fff;">
                    <span class="brand-text font-weight-light"><?php echo $Pengaturan->judul_app; ?></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?php echo base_url((!empty($Pengguna->file_name) ? 'file/profile/' . $Pengguna->file_name : 'assets/theme/admin-lte-3/dist/img/user2-160x160.jpg')) ?>" class="img-circle elevation-0" alt="User Image" style="width: 34px; height: 34px;">
                        </div>
                        <div class="info">
                            <a href="<?php echo base_url('profile/' . $Pengguna->id) ?>" class="d-block"><?php echo ucwords($Pengguna->first_name) ?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <img src="<?php echo base_url((!empty($Pengaturan->logo) ? 'file/app/' . $Pengaturan->logo : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="<?php echo $Pengaturan->judul . ' Logo'; ?>" class="brand-image img-rounded elevation-0" style="width: 209px; height: 85px; background-color: transparent;">
                        <hr/>
                        <?php echo view($menu_kiri); ?>
                    </nav>                    
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <?php echo view($konten) ?>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#"><?php echo $Pengaturan->judul ?></a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0.0
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->
    </body>
</html>