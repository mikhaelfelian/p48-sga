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
                        <li class="breadcrumb-item active">Tambah</li>
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
                <div class="col-md-4">
                    <?php echo form_open(base_url('master/set_merk_simpan.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Merk</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php echo form_hidden('id', (!empty($SQLMerk->id) ? $SQLMerk->id : '')) ?>
                            <div class="form-group <?php echo (!empty($psnGagal['kode']) ? 'has-error' : '') ?>">
                                <label class="control-label">Kode*</label>
                                <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kode kode ...', 'value' => (!empty($SQLMerk->kode) ? $SQLMerk->kode : '')]) ?>
                            </div>

                            <div class="form-group <?php echo (!empty($psnGagal['merk']) ? 'has-error' : '') ?>">
                                <label class="control-label">Merk</label>
                                <?php echo form_input(['id' => 'merk', 'name' => 'merk', 'class' => 'form-control rounded-0' . (!empty($psnGagal['merk']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan merk merk ...', 'value' => (!empty($SQLMerk->merk) ? $SQLMerk->merk : '')]) ?>
                            </div>

                            <div class="form-group <?php echo (!empty($psnGagal['keterangan']) ? 'has-error' : '') ?>">
                                <label class="control-label">Keterangan</label>
                                <?php echo form_input(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control rounded-0' . (!empty($psnGagal['keterangan']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan keterangan merk ...', 'value' => (!empty($SQLMerk->keterangan) ? $SQLMerk->keterangan : '')]) ?>
                            </div>

                            <div class="form-group <?php echo (!empty($psnGagal['status']) ? 'has-error' : '') ?>">
                                <label class="control-label">Status*</label>                                
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusAktif','name' => 'status', 'class' => 'custom-control-input', 'checked' => (!empty($SQLMerk->status) ? ($SQLMerk->status == '1' ? TRUE : FALSE) : ''), 'value' => '1']); ?>
                                    <label for="statusAktif" class="custom-control-label">Aktif</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusNonAktif','name' => 'status', 'class' => 'custom-control-input custom-control-input-danger', 'checked' => (!empty($SQLMerk->status) ? ($SQLMerk->status == '0' ? TRUE : FALSE) : ''), 'value' => '0']); ?>
                                    <label for="statusNonAktif" class="custom-control-label">Non - Aktif</label>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('master/data_merk.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
                                </div>
                                <div class="col-lg-6 text-right">
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
<!-- Toastr -->
<link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.css') ?>">
<script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.js') ?>"></script>

<script type="text/javascript">
                                        $(function () {
<?php echo session()->getFlashdata('master_toast'); ?>
                                        });
</script>