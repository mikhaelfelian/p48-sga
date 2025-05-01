<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<!-- Item box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DATA PENGIRIMAN ITEM</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-left">SKU</th>
                    <th class="text-left">Item</th>
                    <th class="text-center">Jml</th>
                    <th class="text-left">Satuan</th>
                    <th class="text-left"></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($SQLMutasiDet as $det) { ?>
                    <tr>
                        <td class="text-center" style="width: 50px;"><?php echo $no; ?></td>
                        <td class="text-left" style="width: 100px;"><?php echo $det->kode; ?></td>
                        <td class="text-left" style="width: 350px;">
                            <small><?php echo $det->item; ?></small>
                            <?php echo br(); ?>
                            <small><i><?php echo nl2br($det->keterangan); ?></i></small>
                        </td>
                        <td class="text-center" style="width: 50px;"><?php echo $det->jml; ?></td>
                        <td class="text-left" style="width: 50px;"><?php echo $det->satuan; ?></td>
                        <td style="width: 80px;">
                            <?php echo anchor(base_url('transaksi/data_penjualan_aksi.php?act=do_input&id='.$request->getVar('id').'&status=' . $request->getVar('status').'&id_do=' . $request->getVar('id_do').'&id_item='.$det->id_item.'&id_item_det='.$det->id), 'Input &raquo;', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <!--<button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>-->
            </div>
            <div class="col-lg-6 text-right">

            </div>
        </div>                            
    </div>
</div>
<!-- /.card -->