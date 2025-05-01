<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pembelian') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Purchase Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php if (!empty($SQLItem)) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Form Penerimaan</h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (!empty($SQLBeli)) { ?>
                                            <?php // echo form_open(base_url('pembelian/faktur/cart_simpan.php'), 'autocomplete="off"') ?>
                                            <?php
                                            echo form_hidden('id_beli', $request->getVar('id'));
                                            echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : ''));

                                            if (!empty($SQLBeliDetRw)) {
                                                echo form_hidden('id_beli_det', $request->getVar('id_item_det'));
                                            }
                                            ?>
                                            <div class="form-group<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                                <label for="inputEmail3" class="control-label">Item</label>
                                                <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Item ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : ''), 'readonly' => 'TRUE']) ?>
                                            </div>
                                            <?php if (!empty($SQLItem)) { ?>
                                                <div class="form-group<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                                    <label for="inputEmail3" class="control-label">SKU</label>
                                                    <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => $SQLItem->kode, 'readonly' => 'true']) ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">Jml</label>
                                                            <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0', 'placeholder' => 'Jml ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->jml : ''), 'readonly' => 'TRUE']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="inputEmail3" class="control-label">Satuan</label>
                                                        <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>" readonly="TRUE">
                                                            <option value="">- Pilih -</option>
                                                            <?php foreach ($SQLSatuan as $satuan) { ?>
                                                                <option value="<?php echo $satuan->id ?>"<?php echo (!empty($SQLBeliDetRw) ? ($satuan->id == $SQLBeliDetRw->id_satuan ? ' selected' : '') : '') ?>><?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">Kekurangan</label>
                                                            <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0', 'placeholder' => 'Jml ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->jml - $SQLBeliDetRw->jml_diterima : ''), 'readonly' => 'TRUE']) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('gudang/penerimaan/data_beli_terima.php?id=' . $request->getVar('id')) ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <!--<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>-->
                                                </div>
                                            </div>
                                            <?php // echo form_close() ?>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($SQLBeliDetRw->jml_diterima < $SQLBeliDetRw->jml) { ?>
                                            <?php echo form_open(base_url('gudang/penerimaan/set_terima_item.php'), 'autocomplete="off"') ?>
                                            <?php
                                            echo form_hidden('id_beli', $request->getVar('id'));
                                            echo form_hidden('id_beli_det', $request->getVar('id_item_det'));
                                            echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : ''));
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group<?php echo (!empty($psnGagal['gudang']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Gudang</label>
                                                        <select name="gudang" class="form-control rounded-0<?php echo (!empty($psnGagal['gudang']) ? ' is-invalid' : '') ?>">
                                                            <!--<option value="">- Pilih -</option>-->
                                                            <?php foreach ($SQLGudang as $gudang) { ?>
                                                                <option value="<?php echo $gudang->id ?>"<?php // echo (!empty($SQLBeliDetRw) ? ($satuan->id == $SQLBeliDetRw->id_satuan ? ' selected' : '') : '')           ?>><?php echo strtoupper($gudang->gudang) ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group<?php echo (!empty($psnGagal['tgl_terima']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Tgl Terima</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                            <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_terima', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['tgl_terima']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Tgl diterima ...', 'value' => date('d/m/Y')]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Jml</label>
                                                        <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Jml Diterima ...']) ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="inputEmail3" class="control-label">Satuan</label>
                                                    <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>" readonly="TRUE">
                                                        <option value="">- Pilih -</option>
                                                        <?php foreach ($SQLSatuan as $satuan) { ?>
                                                            <option value="<?php echo $satuan->id ?>"<?php echo (!empty($SQLBeliDetRw) ? ($satuan->id == $SQLBeliDetRw->id_satuan ? ' selected' : '') : '') ?>><?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?></option>
                                                        <?php } ?>
                                                    </select>                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="control-label">Keterangan</label>
                                                        <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SN, pisahkan dengan koma atau titik koma  ...', 'rows' => '5']) ?>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Terima</button>
                                                </div>
                                            </div>
                                            <?php echo form_close() ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (!empty($SQLBeli)) { ?>            
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Item box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA RIWAYAT PENERIMAAN</h3>
                            </div>
                            <div class="card-body">                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"></th>
                                                    <th class="text-center">No</th>
                                                    <th class="text-left">Tgl</th>
                                                    <th class="text-left">Deskripsi</th>
                                                    <th class="text-center">Jml</th>
                                                    <th class="text-left"></th>
                                                </tr>                                    
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($SQLItemStokHist as $det) { ?>
                                                    <tr>
                                                        <td class="text-center" style="width: 65px;">
                                                            <a href="<?php echo base_url('gudang/penerimaan/cart_hapus.php?id=' . $det->id . '&id_beli=' . $request->getVar('id') . '&id_item=' . $request->getVar('id_item') . '&id_item_det=' . $request->getVar('id_item_det')) ?>" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Hapus [<?php echo $det->item; ?>] ?')"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                        <td class="text-center" style="width: 50px;"><?php echo $no ?></td>
                                                        <td class="text-left" style="width: 150px;"><?php echo tgl_indo2($det->tgl_masuk) ?></td>
                                                        <td class="text-left" style="width: 400px;">
                                                            <?php echo $det->keterangan ?>
                                                            <?php if (!empty($det->sn)) { ?>
                                                                <?php echo br(); ?>
                                                                <small><?php echo nl2br($det->sn) ?></small>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="text-center" style="width: 120px;"><?php echo $det->jml . (!empty($det->satuan) ? ' ' . $det->satuan : '') ?></td>
                                                        <td class="text-left"></td>
                                                    </tr>
                                                    <?php $no++; ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6 text-right">

                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        $("input[id=tgl]").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });

        $("input[id=jml]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
<?php echo session()->getFlashdata('gudang_toast'); ?>
    });
</script>