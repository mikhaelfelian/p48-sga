<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<!-- Item box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DATA PENGIRIMAN</h3>
    </div>
    <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">No.</th>
                    <th class="text-left">Tgl</th>
                    <th class="text-left">Deskripsi</th>
                    <th class="text-center"></th>
                </tr>                                    
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($SQLMutasi as $det) { ?>
                    <tr>
                        <td class="text-center" style="width: 100px;">
                            <?php if(!hakAdminM()) : ?>
                            <a href="<?php echo base_url('transaksi/hapus_do.php?id=' . $det->id . '&status=' . $request->getVar('status') . '&id_penj=' . $request->getVar('id') . '&route=transaksi/data_penjualan_aksi.php') ?>" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Hapus [<?php echo $det->no_mutasi; ?>] ?')"><i class="fa fa-trash"></i></a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_do=' . $det->id) ?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-edit"></i></a>
                        </td>
                        <td class="text-center" style="width: 50px;"><?php echo $no; ?></td>
                        <td class="text-left" style="width: 100px;"><?php echo tgl_indo($det->tgl_masuk); ?></td>
                        <td class="text-left" style="width: 350px;">
                            <small><?php echo $det->no_mutasi; ?></small>
                            <?php echo br(); ?>
                            <small><i><?php echo $det->keterangan; ?></i></small>
                        </td>
                        <td style="width: 80px;">
                            <?php echo anchor(base_url('transaksi/data_penjualan_aksi.php?act=do_input&id='.$request->getVar('id').'&status=' . $request->getVar('status').'&id_do='.$det->id), 'Input &raquo;', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                            <?php echo anchor(base_url('gudang/mutasi/pdf_mutasi_do.php?id=' . $det->id), '<i class="fa fa-print"></i> Cetak', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;" target="_blank"') ?>
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