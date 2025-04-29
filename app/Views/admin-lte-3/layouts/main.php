<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? $Pengaturan->judul ?></title>

    <!--FAVICON-->
    <link rel="icon" type="image/x-icon"
        href="<?= base_url((!empty($Pengaturan->favicon) ? 'file/app/' . $Pengaturan->favicon : 'public/assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
        href="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('public/assets/theme/' . $ThemePath . '/dist/css/adminlte.min.css') ?>">
    <!--JQuery UI-->
    <link href="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/jquery-ui/jquery-ui.min.css') ?>"
        rel="stylesheet">

    <!-- REQUIRED SCRIPTS -->
    <!-- JQuery Pack -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/jquery-ui/jquery-ui.js') ?>"></script>
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/moment/moment.min.js') ?>"></script>

    <!-- Bootstrap -->
    <script
        src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- AdminLTE Pack -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/dist/js/adminlte.js') ?>"></script>
    <script src="https://kit.fontawesome.com/6a88a04e5c.js" crossorigin="anonymous"></script>

    <!-- Plugin Tanggal Rentang -->
    <script
        src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <link rel="stylesheet"
        href="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/daterangepicker/daterangepicker.css'); ?>">

    <!-- JQUERY AUTO NUMBER -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/JAutoNumber/autonumeric.js') ?>"></script>

    <!-- Toastr -->
    <link rel="stylesheet"
        href="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.css') ?>">
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.js') ?>"></script>

    <!-- Select2 -->
    <script
        src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/select2/js/select2.full.min.js') ?>"></script>
    <link rel="stylesheet"
        href="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet"
        href="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

    <!-- Ekko Lightbox -->
    <link rel="stylesheet"
        href="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/ekko-lightbox/ekko-lightbox.css') ?>">
    <script
        src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
        
    <!-- Additional CSS/JS -->
    <?= $this->renderSection('styles') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('public/assets/theme/' . $ThemePath . '/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?= $this->include('admin-lte-3/layouts/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('admin-lte-3/layouts/sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $page_title ?? 'Dashboard' ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <?php if(isset($breadcrumbs)): ?>
                                    <?php foreach($breadcrumbs as $breadcrumb): ?>
                                        <?php if($breadcrumb['active']): ?>
                                            <li class="breadcrumb-item active"><?= $breadcrumb['title'] ?></li>
                                        <?php else: ?>
                                            <li class="breadcrumb-item"><a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['title'] ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="breadcrumb-item active"><?= $page_title ?? 'Dashboard' ?></li>
                                <?php endif; ?>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <!-- Footer -->
        <?= $this->include('admin-lte-3/layouts/footer') ?>
        
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Additional Scripts -->
    <?= $this->renderSection('scripts') ?>

    <!-- AdminLTE and other scripts -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- ChartJS -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/chart.js/Chart.min.js') ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/sparklines/sparkline.js') ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
    <!-- Summernote -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('public/assets/theme/' . $ThemePath . '/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
</body>
</html> 