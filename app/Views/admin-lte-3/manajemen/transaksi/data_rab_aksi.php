<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RAB</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data RAB</li>
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
                <div class="col-lg-8">
                    <!-- Default box -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $SQLPlgnRw->nama ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12">
                                        <?php echo view($konten_aksi) ?>                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" style="overflow-x: scroll;">
                                        <h4>Detail Item</h4>
                                        <?php echo view($konten_list_tind) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Log Aktifitas</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12" style="overflow-x: scroll;">
                                        <?php echo view($konten_list_log) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php echo view($konten_kanan) ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        
        <?php echo session()->getFlashdata('transaksi_toast'); ?>
    });
</script>