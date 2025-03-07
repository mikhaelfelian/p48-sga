<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Masuk | <?php echo $Pengaturan->judul ?></title>
        <!--FAVICON DISINI-->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url((!empty($Pengaturan->favicon) ? 'file/app/' . $Pengaturan->favicon : 'public/assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>">
        
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/fontawesome-free/css/all.min.css') ?>">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/dist/css/adminlte.min.css') ?>">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <!--<a href="<?php echo base_url(); ?>"><?php echo $Pengaturan->judul ?></a>-->
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-header text-center">
                    <a href="#" class="h1"><img src="<?php echo base_url((!empty($Pengaturan->logo) ? 'file/app/' . $Pengaturan->logo : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="<?php echo $Pengaturan->judul ?>" class="brand-image img-rounded" style="width: 209px; height: 94px; background-color: #fff;"></a>
                </div>
                <div class="card-body login-card-body  rounded-circle">
                    <p class="login-box-msg">Silahkan masuk menggunakan ID</p>
                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
                    <?php echo form_open(base_url('login/cek_login.php')); ?>
                    <div class="input-group mb-3">
                        <?php echo form_input(['name' => 'user', 'class' => 'form-control' . (!empty($psnGagal['user']) ? ' is-invalid' : ''), 'placeholder' => 'ID Pengguna ...']) ?>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <?php echo form_password(['name' => 'pass', 'class' => 'form-control' . (!empty($psnGagal['pass']) ? ' is-invalid' : ''), 'placeholder' => 'Kata Sandi ...']) ?>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <?php echo reCaptcha2('reCaptcha2', ['id' => 'recaptcha_v2'], ['theme' => 'light']); ?>                                    
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="icheck-primary">
                                <?php echo form_checkbox(['id' => 'remember', 'name' => 'ingat', 'value' => '1']) ?>
                                <label for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-0">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/jquery/jquery.min.js') ?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/dist/js/adminlte.min.js') ?>"></script>


        <!-- Toastr -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.css') ?>">
        <script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.js') ?>"></script>
        <!-- Page script -->
        <script type="text/javascript">
            $(function () {
                <?php echo session()->getFlashdata('login_toast'); ?>
            });
        </script>
    </body>
</html>
