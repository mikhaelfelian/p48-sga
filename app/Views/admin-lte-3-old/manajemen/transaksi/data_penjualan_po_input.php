<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<!-- Item box -->
<?php if (!empty($SQLItem)) { ?>
    <?php echo form_open(base_url('transaksi/cart_simpan_po.php'), 'autocomplete="off"') ?>
    <?php echo form_hidden('id_penj', $SQLPenj->id); ?>
    <?php echo form_hidden('id_penj_det', $request->getVar('id_item_det')); ?>
    <?php echo form_hidden('id_item', $request->getVar('id_item')); ?>
    <?php echo form_hidden('id_po', $request->getVar('id_po')); ?>
    <?php echo form_hidden('id_satuan', $SQLRabDetRw->id_satuan); ?>
    <?php echo form_hidden('status', $request->getVar('status')); ?>
    <?php echo form_hidden('act', $request->getVar('act')); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">FORM INPUT PO <i><small><?php echo (!empty($SQLPORw->supplier) ? '- '.$SQLPORw->supplier : '') ?></i></small></h3>
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Item</label>
                        <div class="col-sm-9">                                                      
                            <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Item ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : ''), 'readonly' => 'true']) ?>
                        </div>
                    </div>
                    <div class="form-group row<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">SKU</label>
                        <div class="col-sm-9">
                            <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => $SQLItem->kode, 'readonly' => 'true']) ?>
                        </div>
                    </div>
                    <div class="form-group row<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jml</label>
                        <div class="col-sm-4">
                            <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Jml ...']) ?>
                        </div>
                        <div class="col-sm-5">
                            <?php echo form_input(['id' => 'jml_rab', 'name' => 'jml_rab', 'class' => 'form-control pull-right rounded-0', 'placeholder' => 'Jml ...', 'value' => (!empty($SQLRabDetRw) ? $SQLRabDetRw->jml : ''), 'readonly' => 'true']) ?>
                        </div>
                    </div>
                    <div class="form-group row<?php echo (!empty($psnGagal['harga']) ? ' text-danger' : '') ?>">
                        <label class="col-sm-3 col-form-label">HPP</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <?php echo form_input(['id' => 'harga', 'name' => 'harga', 'class' => 'form-control rounded-0 pull-right' . (!empty($psnGagal['harga']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Harga Jual ...', 'value' => (!empty($SQLRabDetRw) ? $SQLRabDetRw->harga_hpp : 0)]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row<?php echo (!empty($psnGagal['status_ppn']) ? ' text-danger' : '') ?>">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">PPn</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <?php echo form_checkbox(['id' => 'customSwitch3', 'name' => 'status_ppn', 'value' => '1', 'class' => 'custom-control-input']) ?>
                                        <label class="custom-control-label" for="customSwitch3">Ya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Catatan</label>
                        <div class="col-sm-9">
                            <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control pull-left rounded-0', 'placeholder' => 'Isikan catatan ...', 'rows' => '8', 'value' => (!empty($SQLRabDetRw->keterangan) ? $SQLRabDetRw->keterangan : '')]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-6">
                    <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                </div>
                <div class="col-lg-6 text-right">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>                            
        </div>
    </div>
    <?php echo form_close() ?>
    <!-- /.card -->
<?php } ?>

<!-- Item box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">[PO] DATA ITEM <i><small><?php echo (!empty($SQLPORw->supplier) ? '- '.$SQLPORw->supplier : '') ?></i></small></h3>
    </div>
    <div class="card-body">                                
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-left">Item</th>
                    <th class="text-center">Jml</th>
                    <th class="text-center">PO</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr>                                    
            </thead>
            <tbody>
                <?php if (!empty($SQLPenjDet)) { ?>
                    <?php
                    $no     = 1;
                    $subt   = 0;
                    ?>
                    <?php foreach ($SQLPenjDet as $det) { ?>
                        <tr>
                            <td class="text-left" style="width: 250px;">
                                <small><?php echo tgl_indo5($det->tgl_simpan); ?></small><br/>
                                <?php echo $det->item; ?><br/>
                                <small><i><?php echo $det->keterangan; ?></i></small><br/>
                                <small><?php echo $det->item_link; ?></small><br/>
                            </td>
                            <td class="text-center text-middle" style="width: 70px;"><?php echo (int) $det->jml; ?></td>
                            <td class="text-center text-middle" style="width: 70px;"><?php echo (int) $det->jml_po; ?></td>
                            <td class="text-right text-middle" style="width: 100px;"><?php echo format_angka($det->harga); ?></td>
                            <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->subtotal); ?></td>
                            <td class="text-right text-middle" style="width: 75px;">
                                <?php if($det->jml > $det->jml_po){ ?>
                                        <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?act=po_input_item&id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_po=' . $request->getVar('id_po') . '&id_item=' . $det->id_item . '&id_item_det=' . $det->id), '<i class="fa fa-check"></i> Pilih', 'class="btn btn-success btn-flat btn-xs" style="width: 60px;"') ?>
                                <?php } ?>
                            </td>
                        </tr>  
                        <?php $no++; ?>
                    <?php } ?>                    
                </tbody>
            <?php } ?>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
            </div>
            <div class="col-lg-6 text-right">

            </div>
        </div>                            
    </div>
</div>
<!-- /.card -->