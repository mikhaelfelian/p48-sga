<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Item</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master/data_item.php') ?>">Data Item</a></li>
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
                <div class="col-md-6">
                    <?php echo form_open(base_url('master/set_item_simpan.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Item</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php echo form_hidden('id', (!empty($SQLItem->id) ? $SQLItem->id : '')) ?>
                            <?php echo form_hidden('route', (isset($_GET['route']) ? $request->getVar('route') : '')) ?>
                            <?php echo form_hidden('id_item', (isset($_GET['id_rab']) ? $request->getVar('id_rab') : '')) ?>
                            <?php echo form_hidden('status_item', (isset($_GET['id_rab']) ? $request->getVar('status') : '')) ?>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['kategori']) ? ' text-danger' : '') ?>">
                                        <label class="control-label">Kategori*</label>
                                        <select name="kategori" class="form-control rounded-0<?php echo (!empty($psnGagal['kategori']) ? ' is-invalid' : '') ?>">
                                            <option value="">-[Kategori]-</option>
                                            <?php foreach ($SQLKategori as $kategori) { ?>
                                                <option value="<?php echo $kategori->id; ?>"<?php echo (!empty($SQLItem->id_kategori) ? ($kategori->id == $SQLItem->id_kategori ? ' selected' : '') : '') ?>><?php echo $kategori->kategori.' / [' . $kategori->kode . '] '; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['merk']) ? ' text-danger' : '') ?>">
                                        <label class="control-label">Merk*</label>
                                        <select name="merk" class="form-control rounded-0<?php echo (!empty($psnGagal['merk']) ? ' is-invalid' : '') ?>">
                                            <option value="">-[Merk]-</option>
                                            <?php foreach ($SQLMerk as $merk) { ?>
                                                <option value="<?php echo $merk->id; ?>"<?php echo (!empty($SQLItem->id_merk) ? ($merk->id == $SQLItem->id_merk ? ' selected' : '') : '') ?>><?php echo $merk->merk; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                        <label class="control-label">SKU</label>
                                        <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => (!empty($SQLItem->kode) ? $SQLItem->kode : '')]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['satuan']) ? ' text-danger' : '') ?>">
                                        <label class="control-label">Satuan*</label>
                                        <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                            <option value="">-[Satuan]-</option>
                                            <?php foreach ($SQLSatuan as $satuan) { ?>
                                                <option value="<?php echo $satuan->id; ?>"<?php echo (!empty($SQLItem->id_satuan) ? ($satuan->id == $SQLItem->id_satuan ? ' selected' : '') : '') ?>><?php echo $satuan->satuanBesar; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                <label class="control-label">Item*</label>
                                <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nama item / produk ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : '')]) ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['harga_beli']) ? ' text-danger' : '') ?>">
                                        <label for="inputEmail3">Harga Beli</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp. </span>
                                            </div>
                                            <?php echo form_input(['id' => 'harga', 'name' => 'harga_beli', 'class' => 'form-control rounded-0' . (!empty($psnGagal['harga_beli']) ? ' is-invalid' : ''), 'value' => (!empty($SQLItem->harga_beli) ? $SQLItem->harga_beli : '')]) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['harga_jual']) ? ' text-danger' : '') ?>">
                                        <label for="inputEmail3">Harga Jual</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp. </span>
                                            </div>
                                            <?php echo form_input(['id' => 'harga', 'name' => 'harga_jual', 'class' => 'form-control rounded-0' . (!empty($psnGagal['harga_jual']) ? ' is-invalid' : ''), 'value' => (!empty($SQLItem->harga_jual) ? $SQLItem->harga_jual : '')]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['keterangan']) ? 'text-danger' : '') ?>">
                                <label class="control-label">Deskripsi</label>
                                <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control rounded-0' . (!empty($psnGagal['keterangan']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan deskripsi item / spek produk / dll ...', 'value' => (!empty($SQLItem->keterangan) ? $SQLItem->keterangan : '')]) ?>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['status']) ? 'text-danger' : '') ?>">
                                <label class="control-label">Status*</label>                                
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusAktif', 'name' => 'status', 'class' => 'custom-control-input', 'checked' => (!empty($SQLItem->status) ? ($SQLItem->status == '1' ? TRUE : FALSE) : ''), 'value' => '1']); ?>
                                    <label for="statusAktif" class="custom-control-label">Aktif</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <?php echo form_radio(['id' => 'statusNonAktif', 'name' => 'status', 'class' => 'custom-control-input custom-control-input-danger', 'checked' => (!empty($SQLItem->status) ? ($SQLItem->status == '0' ? TRUE : FALSE) : ''), 'value' => '0']); ?>
                                    <label for="statusNonAktif" class="custom-control-label">Non - Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('master/data_kategori.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
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
<script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/JAutoNumber/autonumeric.js') ?>"></script>

<!-- Toastr -->
<link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.css') ?>">
<script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.js') ?>"></script>

<script type="text/javascript">
                                        $(function () {
                                            $("input[id=harga]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
<?php echo session()->getFlashdata('master_toast'); ?>
                                        });
</script>