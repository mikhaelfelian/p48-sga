<?php
$session = \Config\Services::session();

// Initialize the mKaryawan model to get employee counts
$karyawanModel = new \App\Models\mKaryawan();
$totalEmployees = $karyawanModel->countAllEmployees();
$activeEmployees = $karyawanModel->countActiveEmployees();
$contractEmployees = $karyawanModel->countContractEmployees();
$inactiveEmployees = $karyawanModel->countInactiveEmployees();
?>

<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard SDM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard SDM</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Karyawan</span>
                            <span class="info-box-number">
                                <?= $totalEmployees ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Karyawan Aktif</span>
                            <span class="info-box-number">
                                <?= $activeEmployees ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Karyawan Kontrak</span>
                            <span class="info-box-number">
                                <?= $contractEmployees ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Karyawan Non-Aktif</span>
                            <span class="info-box-number">
                                <?= $inactiveEmployees ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
</div>
<!-- /.content -->