<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
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
                    <?php if ($SQLRab->status == 0 || (isset($_GET['id_item']) && isset($_GET['id_item_det']))) { ?>
                        <!-- Form Item box -->
                        <?php echo form_open(base_url('transaksi/rab/cart_simpan.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id_rab', (!empty($SQLRab) ? $SQLRab->id : '')) ?>
                        <?php echo form_hidden('id_rab_det', (!empty($SQLRabDetRw) ? $SQLRabDetRw->id : '')) ?>
                        <!-- status sebagai potongan -->
                        <?php echo form_hidden('status', 3) ?> 
                        <!-- potongan akan berpengaruh ke RAB -->
                        <?php echo form_hidden('status_biaya', 1) ?> 

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">INPUT POTONGAN</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis</label>
                                                    <div class="col-sm-9">
                                                        <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Item ...', 'value' => (!empty($SQLRabDetRw) ? $SQLRabDetRw->item : (!empty($SQLItem->item) ? $SQLItem->item : ''))]) ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jml</label>
                                                    <div class="col-sm-4">
                                                        <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Jml ...', 'value' => (!empty($SQLRabDetRw) ? $SQLRabDetRw->jml : '')]) ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row<?php echo (!empty($psnGagal['harga']) ? ' text-danger' : '') ?>">
                                                    <label class="col-sm-3 col-form-label">Harga</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp.</span>
                                                            </div>
                                                            <?php echo form_input(['id' => 'harga', 'name' => 'harga', 'class' => 'form-control rounded-0 pull-right' . (!empty($psnGagal['harga']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Potongan ...', 'value' => (!empty($SQLRabDetRw) ? $SQLRabDetRw->harga : '')]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Catatan</label>
                                                    <div class="col-sm-9">
                                                        <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control pull-left rounded-0', 'placeholder' => 'Isikan catatan / spek ...', 'rows' => '8', 'value' => (!empty($SQLRabDetRw) ? $SQLRabDetRw->keterangan : '')]) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    <?php } ?>


                    <!-- Item box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DATA POTONGAN</h3>
                        </div>
                        <div class="card-body">
                            <?php echo view($konten_list) ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php if ($SQLRab->status > 0) { ?>
                                        <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6 text-right">

                                </div>
                            </div>                            
                        </div>
                    </div>
                    <!-- /.card -->
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
        $("input[id=harga],input[id=jml]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
<?php echo session()->getFlashdata('transaksi_toast'); ?>
    });
</script>