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
                        <li class="breadcrumb-item active">Sistem</li>
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
                    <?php echo form_open_multipart(base_url('pengaturan/pengaturan_set_' . (!empty($Pengaturan) ? 'update' : 'simpan') . '.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Pengaturan</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php echo form_hidden('id', (!empty($Pengaturan->id) ? $Pengaturan->id : '')) ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['judul']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Judul*</label>
                                        <?php echo form_input(['id' => 'judul', 'name' => 'judul', 'class' => 'form-control rounded-0' . (!empty($psnGagal['judul']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan sudul aplikasi ...', 'value' => (!empty($Pengaturan->judul) ? $Pengaturan->judul : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['judul_app']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Judul App*</label>
                                        <?php echo form_input(['id' => 'judul_app', 'name' => 'judul_app', 'class' => 'form-control rounded-0' . (!empty($psnGagal['judul_app']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan judul sistem ...', 'value' => (!empty($Pengaturan->judul_app) ? $Pengaturan->judul_app : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['url_app']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Base URL</label>
                                        <?php echo form_input(['id' => 'url_app', 'name' => 'url_app', 'class' => 'form-control rounded-0' . (!empty($psnGagal['url_app']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Base URL ...', 'value' => (!empty($Pengaturan->url_app) ? $Pengaturan->url_app : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['kota']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Kota</label>
                                        <?php echo form_input(['id' => 'kota', 'name' => 'kota', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kota']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kota ...', 'value' => (!empty($Pengaturan->kota) ? $Pengaturan->kota : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['alamat']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Alamat</label>
                                        <?php echo form_input(['id' => 'alamat', 'name' => 'alamat', 'class' => 'form-control rounded-0' . (!empty($psnGagal['alamat']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan alamat ...', 'value' => (!empty($Pengaturan->alamat) ? $Pengaturan->alamat : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['no_tlp']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Telp</label>
                                        <?php echo form_input(['id' => 'no_tlp', 'name' => 'no_tlp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_tlp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan telp ...', 'value' => (!empty($Pengaturan->tlp) ? $Pengaturan->tlp : '')]) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['no_tlp']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Limit Hutang Pelanggan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp. </span>
                                            </div>
                                            <input type="text" id="limit_hutang" name="limit_hutang" value="<?php echo (!empty($Pengaturan->limit_hutang) ? $Pengaturan->limit_hutang : '') ?>" class="form-control rounded-0 text-left" style="vertical-align: middle;" placeholder="Isikan limit hutang ...">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (!empty($psnGagal['kode_plgn']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Kode Pelanggan*</label>
                                                <?php echo form_input(['id' => 'kode_plgn', 'name' => 'kode_plgn', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode_plgn']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kode pelanggan ...', 'value' => (!empty($Pengaturan->kode_plgn) ? $Pengaturan->kode_plgn : '')]) ?>
                                            </div>                                           
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (!empty($psnGagal['kode_supp']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Kode Supplier*</label>
                                                <?php echo form_input(['id' => 'kode_supp', 'name' => 'kode_supp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode_plgn']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kode supplier ...', 'value' => (!empty($Pengaturan->kode_supp) ? $Pengaturan->kode_supp : '')]) ?>
                                            </div>                                           
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (!empty($psnGagal['kode_kary']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Kode Karyawan*</label>
                                                <?php echo form_input(['id' => 'kode_kary', 'name' => 'kode_kary', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode_kary']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kode karyawan ...', 'value' => (!empty($Pengaturan->kode_kary) ? $Pengaturan->kode_kary : '')]) ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (!empty($psnGagal['jml_item']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Jml Item</label>
                                                <?php echo form_input(['id' => 'jml_item', 'name' => 'jml_item', 'class' => 'form-control rounded-0' . (!empty($psnGagal['jml_item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan jumlah item ...', 'value' => (!empty($Pengaturan->jml_item) ? $Pengaturan->jml_item : '')]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (!empty($psnGagal['jml_ppn']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Jml Ppn</label>
                                                <?php echo form_input(['id' => 'jml_ppn', 'name' => 'jml_ppn', 'class' => 'form-control rounded-0' . (!empty($psnGagal['jml_ppn']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan jumlah ppn ...', 'value' => (!empty($Pengaturan->jml_ppn) ? $Pengaturan->jml_ppn : '')]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (!empty($psnGagal['pph']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Jml PPH</label>
                                                <?php echo form_input(['id' => 'pph', 'name' => 'pph', 'class' => 'form-control rounded-0' . (!empty($psnGagal['pph']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan jumlah pph ...', 'value' => (!empty($Pengaturan->pph) ? $Pengaturan->pph : '')]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Logo Utama</label>
                                                <?php echo form_upload(['id'=>'fupload_logo', 'name'=>'fupload_logo', 'class'=>'form-control rounded-0' . (!empty($psnGagal['fupload_logo']) ? ' is-invalid' : '')]) ?>
                                                <br/>
                                                <div class="text-center">
                                                    <img src="<?php echo base_url((!empty($Pengaturan->logo) ? 'public/file/app/' . $Pengaturan->logo : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="<?php echo $Pengaturan->judul . ' Logo'; ?>" class="brand-image img-circle elevation-0" style="width: 160px; height: 65px; background-color: #fff;">
                                                    <?php if (!empty($Pengaturan->logo)) : ?>
                                                    <br/><br/>
                                                        <?php if(!hakAdminM()) : ?>
                                                        <a href="<?= base_url('pengaturan/hapus_img.php?type=logo'); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus logo ini?');">
                                                            <i class="fas fa-trash"></i> Hapus Logo
                                                        </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Logo Header</label>
                                                <?php echo form_upload(['id'=>'fupload_logo_hdr', 'name'=>'fupload_logo_hdr', 'class'=>'form-control rounded-0' . (!empty($psnGagal['fupload_logo_hdr']) ? ' is-invalid' : '')]) ?>
                                                <br/>
                                                <div class="text-center">
                                                    <img src="<?php echo base_url((!empty($Pengaturan->logo_header) ? 'public/file/app/' . $Pengaturan->logo_header : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="<?php echo $Pengaturan->judul . ' Logo'; ?>" class="brand-image img-circle elevation-0" style="width: 33px; height: 33px; background-color: #fff;">
                                                    <?php if (!empty($Pengaturan->logo_header)) : ?>
                                                    <br/><br/>
                                                        <?php if(!hakAdminM()) : ?>
                                                        <a href="<?= base_url('pengaturan/hapus_img.php?type=logo_header'); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus logo header ini?');">
                                                            <i class="fas fa-trash"></i> Hapus Logo Header
                                                        </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Logo Favicon</label>
                                                <?php echo form_upload(['id'=>'fupload_logo_fav', 'name'=>'fupload_logo_fav', 'class'=>'form-control rounded-0' . (!empty($psnGagal['fupload_logo_fav']) ? ' is-invalid' : '')]) ?>
                                                <br/>
                                                <div class="text-center">
                                                    <img src="<?php echo base_url((!empty($Pengaturan->favicon) ? 'public/file/app/' . $Pengaturan->favicon : 'assets/theme/admin-lte-3/dist/img/AdminLTELogo.png')); ?>" alt="Favicon <?php echo $Pengaturan->judul . ' Logo'; ?>" class="brand-image img-circle elevation-0" style="width: 33px; height: 33px; background-color: #fff;">
                                                    <?php if (!empty($Pengaturan->favicon)) : ?>
                                                    <br/><br/>
                                                        <?php if(!hakAdminM()) : ?>
                                                        <a href="<?= base_url('pengaturan/hapus_img.php?type=favicon'); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus favicon ini?');">
                                                            <i class="fas fa-trash"></i> Hapus Favicon
                                                        </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('pengaturan') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
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
<script type="text/javascript">
    $(function () {
        $("input[id=limit_hutang]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
        <?php echo session()->getFlashdata('pengaturan_toast'); ?>
    });
</script>