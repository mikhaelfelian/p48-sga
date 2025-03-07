<?php $request = \Config\Services::request(); ?>
<a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=1') ?>">
    <i class="fas fa-boxes"></i> Item
</a>
<a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=2') ?>">
    <i class="fas fa-dollar"></i> Biaya
</a>
<a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=3') ?>">
    <i class="fas fa-file-invoice"></i> PO
</a>
<?php if($SQLPenj->status > 0){ ?>
    <a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=4') ?>">
        <i class="fas fa-truck-fast"></i> Pengiriman
    </a>
    <a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=5') ?>">
        <i class="fas fa-file-upload"></i> Unggah
    </a>
<?php } ?>
<hr/>