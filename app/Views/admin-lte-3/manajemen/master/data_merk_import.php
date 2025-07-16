<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Merk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master/data_merk.php') ?>">Data Merk</a></li>
                        <li class="breadcrumb-item active">Import</li>
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
                <div class="col-md-5">
                    <?php echo form_open_multipart(base_url('master/set_merk_upload.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Merk</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>


                            <div class="form-group <?php echo (!empty($psnGagal['fupload']) ? 'has-error' : '') ?>">
                                <label class="control-label">Import Excel</label>
                                <?php echo form_upload(['id' => 'fupload', 'name' => 'fupload', 'class' => 'form-control rounded-0' . (!empty($psnGagal['fupload']) ? ' is-invalid' : ''), 'accept' => '.xls, .xlsx, .csv']) ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('master/data_merk.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button type="button" class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo base_url('master/xls_merk.php?status_temp=1') ?>'"><i class="fa fa-file-excel"></i> Template</button>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- Page script -->
<script type="text/javascript">
    $(function () {
        <?php echo session()->getFlashdata('master_toast'); ?>
    });
</script>