<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php // echo $Pengaturan->judul   ?></title>

        <!--FAVICON DISINI-->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/theme/admin-lte-3/dist/img/favicon.png') ?>">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/admin-lte-3/plugins/fontawesome-free/css/all.min.css') ?>">
        <!-- IonIcons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/admin-lte-3/dist/css/adminlte.min.css') ?>">

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="<?php echo base_url('assets/theme/admin-lte-3/plugins/jquery/jquery.min.js') ?>"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url('assets/theme/admin-lte-3/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <!-- AdminLTE -->
        <script src="<?php echo base_url('assets/theme/admin-lte-3/dist/js/adminlte.js') ?>"></script>
        <script src="https://kit.fontawesome.com/6a88a04e5c.js" crossorigin="anonymous"></script>
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                
                            </div>
                            <div class="col-sm-4">
                                <h1>&nbsp;</h1>
                            </div>
                            <div class="col-sm-4">
                                
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="error-page">
                        <h2 class="headline text-warning"> 404</h2>

                        <div class="error-content">
                            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Maaf, Halaman tidak di temukan.</h3>

                            <p>
                                Kami tidak dapat menemukan halaman yang anda tuju.
                                Silahkan <a href="<?php echo base_url('dashboard.php') ?>">Klik disini</a> untuk kembali ke halaman utama.
                            </p>
                        </div>
                        <!-- /.error-content -->
                    </div>
                    <!-- /.error-page -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">CV. Arshaka</a>.</strong>
                All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
    </body>
</html>