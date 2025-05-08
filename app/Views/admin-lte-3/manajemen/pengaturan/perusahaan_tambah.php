<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pengaturan') ?>">Pengaturan</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pengaturan/perusahaan_list.php') ?>">Data Perusahaan</a></li>
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
                <div class="col-md-12">
                    <?php echo form_open_multipart(base_url('pengaturan/perusahaan_set_simpan.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Pengaturan</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php echo form_hidden('id', (!empty($SQLProfile->id) ? $SQLProfile->id : '')) ?>
                            <?php echo form_hidden('id_pengaturan', (!empty($Pengaturan->id) ? $Pengaturan->id : '')) ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['npwp']) ? 'has-error' : '') ?>">
                                        <label class="control-label">NPWP</label>
                                        <?php echo form_input(['id' => 'npwp', 'name' => 'npwp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['npwp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan NPWP Perusahaan ...', 'value' => (!empty($SQLProfile->npwp) ? $SQLProfile->npwp : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['nama']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Nama*</label>
                                        <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control rounded-0' . (!empty($psnGagal['nama']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan judul sistem ...', 'value' => (!empty($SQLProfile->nama) ? $SQLProfile->nama : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['kota']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Kota</label>
                                        <?php echo form_input(['id' => 'kota', 'name' => 'kota', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kota']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kota ...', 'value' => (!empty($SQLProfile->kota) ? $SQLProfile->kota : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['alamat']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Alamat</label>
                                        <?php echo form_input(['id' => 'alamat', 'name' => 'alamat', 'class' => 'form-control rounded-0' . (!empty($psnGagal['alamat']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan alamat ...', 'value' => (!empty($SQLProfile->alamat) ? $SQLProfile->alamat : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['no_telp']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Telp</label>
                                        <?php echo form_input(['id' => 'no_telp', 'name' => 'no_telp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_telp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan telp ...', 'value' => (!empty($SQLProfile->no_telp) ? $SQLProfile->no_telp : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['nm_dirut']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Nama Direktur</label>
                                        <?php echo form_input(['id' => 'nm_dirut', 'name' => 'nm_dirut', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_telp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan telp ...', 'value' => (!empty($SQLProfile->direktur) ? $SQLProfile->direktur : '')]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group <?php echo (!empty($psnGagal['fupload_logo']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Logo Kop</label>
                                                <?php echo form_upload(['id' => 'fupload_logo', 'name' => 'fupload_logo', 'class' => 'form-control rounded-0' . (!empty($psnGagal['fupload_logo']) ? ' is-invalid' : '')]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php if (!empty($SQLProfile)) { ?>
                                                <div class="form-group">
                                                    <br/>
                                                    <div class="text-center">
                                                        <img src="<?php echo base_url((!empty($SQLProfile->logo_kop) ? 'file/app/' . $SQLProfile->logo_kop : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="<?php echo $SQLProfile->nama . ' Logo'; ?>" class="brand-image img-circle elevation-0" style="width: 160px; height: 65px; background-color: #fff;">
                                                        <?php if (!empty($SQLProfile->logo_kop)) : ?>
                                                        <br/><br/>
                                                            <?php if(!hakAdminM()) : ?>
                                                            <a href="<?= base_url('pengaturan/hapus_img.php?type=logo_kop_profile&id='.$SQLProfile->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus logo ini?');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group <?php echo (!empty($psnGagal['fupload_logo']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Logo Watermark</label>
                                                <?php echo form_upload(['id' => 'fupload_logo_wm', 'name' => 'fupload_logo_wm', 'class' => 'form-control rounded-0' . (!empty($psnGagal['fupload_logo']) ? ' is-invalid' : '')]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php if (!empty($SQLProfile)) { ?>
                                                <div class="form-group">
                                                    <br/>
                                                    <div class="text-center">
                                                        <img src="<?php echo base_url((!empty($SQLProfile->logo_wm) ? 'file/app/' . $SQLProfile->logo_wm : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="<?php echo $SQLProfile->nama . ' Logo'; ?>" class="brand-image img-circle elevation-0" style="width: 160px; height: 65px; background-color: #fff;">
                                                        <?php if (!empty($SQLProfile->logo_wm)) : ?>
                                                        <br/><br/>
                                                            <?php if(!hakAdminM()) : ?>
                                                            <a href="<?= base_url('pengaturan/hapus_img.php?type=logo_wm_profile&id='.$SQLProfile->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus logo watermark ini?');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('pengaturan/perusahaan_list.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
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

<script type="text/javascript">
    $(function () {
        <?php echo session()->getFlashdata('pengaturan_toast'); ?>
    });
</script>