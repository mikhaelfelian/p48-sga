<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master/data_supplier.php') ?>">Data Supplier</a></li>
                        <li class="breadcrumb-item active"><?php echo (!empty($SQLSupplier->id) ? 'Ubah' : 'Tambah'); ?></li>
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
                <div class="col-md-6">
                    <?php echo form_open(base_url('master/set_supplier_' . (!empty($SQLSupplier) ? 'update' : 'simpan') . '.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Supplier</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php if (!empty($SQLSupplier->id)) { ?>
                                <?php echo form_hidden('id', (!empty($SQLSupplier->id) ? $SQLSupplier->id : '')) ?>
                                <div class="form-group <?php echo (!empty($psnGagal['kode']) ? 'has-error' : '') ?>">
                                    <label class="control-label">Kode</label>
                                    <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kode ...', 'value' => (!empty($SQLSupplier->kode) ? $SQLSupplier->kode : ''), 'readonly' => 'true']) ?>
                                </div>
                            <?php } ?>

                            <div class="form-group <?php echo (!empty($psnGagal['nama']) ? 'has-error' : '') ?>">
                                <label class="control-label">Nama*</label>
                                <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control rounded-0' . (!empty($psnGagal['nama']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nama supplier ...', 'value' => (!empty($SQLSupplier->nama) ? $SQLSupplier->nama : '')]) ?>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['no_telp']) ? 'has-error' : '') ?>">
                                <label class="control-label">No. Telp</label>
                                <?php echo form_input(['id' => 'no_telp', 'name' => 'no_telp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_telp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nomor telepon supplier ...', 'value' => (!empty($SQLSupplier->no_telp) ? $SQLSupplier->no_telp : '')]) ?>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['no_hp']) ? 'has-error' : '') ?>">
                                <label class="control-label">No. HP</label>
                                <?php echo form_input(['id' => 'no_hp', 'name' => 'no_hp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_hp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nomor hp supplier ...', 'value' => (!empty($SQLSupplier->no_hp) ? $SQLSupplier->no_hp : '')]) ?>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['npwp']) ? 'has-error' : '') ?>">
                                <label class="control-label">NPWP</label>
                                <?php echo form_input(['id' => 'npwp', 'name' => 'npwp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['npwp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nomor telepon pelanggan ...', 'value' => (!empty($SQLSupplier->npwp) ? $SQLSupplier->npwp : '')]) ?>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['alamat']) ? 'has-error' : '') ?>">
                                <label class="control-label">Alamat*</label>
                                <?php echo form_textarea(['id' => 'alamat', 'name' => 'alamat', 'class' => 'form-control rounded-0' . (!empty($psnGagal['alamat']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan alamat supplier ...', 'value' => (!empty($SQLSupplier->alamat) ? $SQLSupplier->alamat : '')]) ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['kota']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Kota*</label>
                                        <?php echo form_input(['id' => 'kota', 'name' => 'kota', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kota']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kota ...', 'value' => (!empty($SQLSupplier->kota) ? $SQLSupplier->kota : '')]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['provinsi']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Provinsi*</label>
                                        <?php echo form_input(['id' => 'provinsi', 'name' => 'provinsi', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kota']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan provinsi ...', 'value' => (!empty($SQLSupplier->provinsi) ? $SQLSupplier->provinsi : '')]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['status']) ? 'has-error' : '') ?>">
                                <label class="control-label">Status*</label>                                
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusAktif', 'name' => 'status', 'class' => 'custom-control-input', 'checked' => (!empty($SQLSupplier->status) ? ($SQLSupplier->status == '1' ? TRUE : FALSE) : ''), 'value' => '1']); ?>
                                    <label for="statusAktif" class="custom-control-label">Aktif</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusNonAktif', 'name' => 'status', 'class' => 'custom-control-input custom-control-input-danger', 'checked' => (!empty($SQLSupplier->status) ? ($SQLSupplier->status == '0' ? TRUE : FALSE) : ''), 'value' => '0']); ?>
                                    <label for="statusNonAktif" class="custom-control-label">Non - Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('master/data_supplier.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
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