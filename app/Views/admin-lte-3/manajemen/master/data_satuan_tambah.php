<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Satuan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master/data_satuan.php') ?>">Data Satuan</a></li>
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
                    <?php echo form_open(base_url('master/set_satuan_' . (!empty($SQLSatuan) ? 'update' : 'simpan') . '.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Satuan</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php echo form_hidden('id', (!empty($SQLSatuan->id) ? $SQLSatuan->id : '')) ?>
                            <div class="form-group <?php echo (!empty($psnGagal['satuan']) ? 'has-error' : '') ?>">
                                <label class="control-label">Satuan Kecil*</label>
                                <?php echo form_input(['id' => 'satuan', 'name' => 'satuan', 'class' => 'form-control rounded-0' . (!empty($psnGagal['satuan']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan satuan ...', 'value' => (!empty($SQLSatuan->satuanTerkecil) ? $SQLSatuan->satuanTerkecil : '')]) ?>
                            </div>

                            <div class="form-group <?php echo (!empty($psnGagal['satuanBesar']) ? 'has-error' : '') ?>">
                                <label class="control-label">Satuan Besar</label>
                                <?php echo form_input(['id' => 'satuanBesar', 'name' => 'satuanBesar', 'class' => 'form-control rounded-0' . (!empty($psnGagal['satuanBesar']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan satuan Besar ...', 'value' => (!empty($SQLSatuan->satuanBesar) ? $SQLSatuan->satuanBesar : '')]) ?>
                            </div>

                            <div class="form-group <?php echo (!empty($psnGagal['jml']) ? 'has-error' : '') ?>">
                                <label class="control-label">Jml</label>
                                <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan jml ...', 'value' => (!empty($SQLSatuan->jml) ? $SQLSatuan->jml : '')]) ?>
                            </div>

                            <div class="form-group <?php echo (!empty($psnGagal['status']) ? 'has-error' : '') ?>">
                                <label class="control-label">Status*</label>                                
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusAktif','name' => 'status', 'class' => 'custom-control-input', 'checked' => (!empty($SQLSatuan->status) ? ($SQLSatuan->status == '1' ? TRUE : FALSE) : ''), 'value' => '1']); ?>
                                    <label for="statusAktif" class="custom-control-label">Aktif</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusNonAktif','name' => 'status', 'class' => 'custom-control-input custom-control-input-danger', 'checked' => (!empty($SQLSatuan->status) ? ($SQLSatuan->status == '0' ? TRUE : FALSE) : ''), 'value' => '0']); ?>
                                    <label for="statusNonAktif" class="custom-control-label">Non - Aktif</label>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('master/data_satuan.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
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