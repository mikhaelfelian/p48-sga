<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembelian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Pembelian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $SQLPsnBaru ?></h3>
                            <p>PO Baru</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo base_url('pembelian/pesanan/data_pesanan.php?filter_status=0') ?>" class="small-box-footer">Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $SQLPsnPros ?></h3>
                            <p>PO Proses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="<?php echo base_url('pembelian/pesanan/data_pesanan.php?filter_status=1') ?>" class="small-box-footer">Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $SQLBeliBaru ?></h3>
                            <p>Faktur Baru</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo base_url('pembelian/faktur/data_pembelian.php?filter_status=0') ?>" class="small-box-footer">Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $SQLBeliPros ?></h3>
                            <p>Faktur Proses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="<?php echo base_url('pembelian/faktur/data_pembelian.php?filter_status=1') ?>" class="small-box-footer">Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>