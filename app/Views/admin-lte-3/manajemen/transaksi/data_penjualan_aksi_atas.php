<?php $request = \Config\Services::request(); ?>
<?php if (hakOwner() == TRUE or hakAdmin() == TRUE or hakSales() == TRUE or hakTeknisi() == TRUE) { ?>
    <a class="btn btn-app bg-info"
        href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=1') ?>">
        <i class="fas fa-boxes"></i> Item
    </a>
<?php } ?>
<?php if (hakOwner() == TRUE or hakAdmin() == TRUE) { ?>
    <a class="btn btn-app bg-info"
        href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=2') ?>">
        <i class="fas fa-dollar"></i> Biaya
    </a>
<?php } ?>
<?php if (hakOwner() == TRUE or hakAdmin() == TRUE OR hakPurchasing() == TRUE) { ?>
    <a class="btn btn-app bg-info"
        href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=3') ?>">
        <i class="fas fa-file-invoice"></i> PO
    </a>
<?php } ?>
<?php if ($SQLPenj->status > 0) { ?>
    <?php if (hakOwner() == TRUE or hakGudang() == TRUE) { ?>
        <a class="btn btn-app bg-info"
            href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=4') ?>">
            <i class="fas fa-truck-fast"></i> Pengiriman
        </a>
    <?php } ?>
    <?php if (hakOwner() == TRUE or hakAdmin() == TRUE OR hakTeknisi() == TRUE) { ?>
        <a class="btn btn-app bg-info"
            href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=5') ?>">
            <i class="fas fa-file-upload"></i> Unggah
        </a>
    <?php } ?>
<?php } ?>
<hr />