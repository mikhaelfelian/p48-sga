<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Stok</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('gudang') ?>">Gudang</a></li>
                        <li class="breadcrumb-item active">Data Stok</li>
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
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Item</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">SKU*</label>
                                <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control rounded-0', 'placeholder' => 'Isikan SKU ...', 'value' => (!empty($SQLItem->kode) ? $SQLItem->kode : ''), 'readonly' => TRUE]) ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Item</label>
                                <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control rounded-0', 'placeholder' => 'Isikan nama item / produk ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : ''), 'readonly' => TRUE]) ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Stok</label>
                                        <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control rounded-0', 'placeholder' => 'Isikan stok ...', 'value' => (!empty($SQLItem->jml) ? (float) $SQLItem->jml : ''), 'readonly' => TRUE]) ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Satuan</label>
                                        <select name="satuan" class="form-control rounded-0" disabled="TRUE">
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($SQLSatuan as $satuan) { ?>
                                                <option value="<?php echo $satuan->id ?>" <?php echo (!empty($SQLSatuan) ? ($SQLItem->id_satuan == $satuan->id ? 'selected' : '') : '') ?>><?php echo $satuan->satuanTerkecil; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('gudang/stok/data_item.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
                                </div>
                                <div class="col-lg-6 text-right">

                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Stok Per Gudang</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Gudang</th>
                                        <th class="text-center"></th>
                                        <th colspan="4" class="text-left">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($SQLItemStok as $gd) { ?>
                                        <?php echo form_open(base_url('gudang/stok/set_item_simpan.php'), 'autocomplete="off"') ?>
                                        <?php echo form_hidden('id_item', $SQLItem->id) ?>
                                        <?php echo form_hidden('id', $gd->id) ?>
                                        <?php echo form_hidden('id_gudang', $gd->id_gudang) ?>
                                        <?php echo form_hidden('satuan', $gd->id_satuan) ?>

                                        <tr>
                                            <th><?php echo $gd->gudang; ?></th>
                                            <th>:</th>
                                            <td class="text-right" style="width: 120px;">
                                                <?php if (hakSA() == TRUE || hakOwner() == TRUE) { ?>
                                                    <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control rounded-0', 'value' => $gd->jml]); ?>
                                                <?php } else { ?>
                                                    <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control rounded-0', 'value' => $gd->jml, 'disabled' => 'TRUE']); ?>
                                                <?php } ?>
                                            </td>
                                            <td class="text-left"><?php echo $gd->satuan; ?></td>
                                            <td class="text-left">
                                                <?php if (hakSA() == TRUE || hakOwner() == TRUE) { ?>
                                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i></button>
                                                <?php } ?>
                                            </td>
                                            <td class="text-left"><?php echo status_gd($gd->status); ?></td>
                                        </tr>
                                        <?php echo form_close() ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Stok Detail</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-left">Gudang</th>
                                        <th class="text-center">Jml</th>
                                        <th class="text-left">Satuan</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($SQLItemHist as $det) { ?>
                                        <tr>
                                            <td class="text-left" style="width: 250px;">
                                                <?php echo $det->gudang.br() ?>
                                                <span class="mailbox-read-time float-left"><?php echo tgl_indo8($det->tgl_simpan) ?></span>
                                            </td>
                                            <td class="text-center" style="width: 100px;">
                                                <?php echo (float)$det->jml ?>
                                            </td>
                                            <td class="text-left">
                                                <?php echo $det->satuan ?>
                                            </td>
                                            <td class="text-left" style="width: 450px;">
                                                <?php echo $det->keterangan ?>
                                            </td>
                                            <td class="text-left">
                                                <?php echo status_stok($det->status) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
<?php echo session()->getFlashdata('gudang_toast'); ?>
    });
</script>