<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">Penjualan</li>
    <!-- SELAIN GUDANG BISA TAMBAH -->
    <?php if (hakGudang() != TRUE): ?>
        <li class="nav-item">
            <a href="<?php echo base_url('transaksi/data_penjualan_tambah.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Tambah</p>
            </a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a href="<?php echo base_url('transaksi/data_penjualan.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>Data Penjualan</p>
        </a>
    </li>
</ul>