<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">PENJUALAN</li>
    <?php if (hakOwner() == TRUE OR hakAdmin() == TRUE OR hakSales() == TRUE OR hakPurchasing() == TRUE OR hakAccounting() == TRUE OR hakAdminPO() == TRUE): ?>
        <li class="nav-item">
            <a href="<?php echo base_url('transaksi/rab/data_rab.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>
                RAB Penjualan
                <i class="right fas fa-angle-right"></i>
            </p>
        </a>
    </li>
    <?php endif; ?>
    <?php if (hakOwner() == TRUE OR hakAdmin() == TRUE OR hakSales() == TRUE OR hakPurchasing() == TRUE OR hakTeknisi() == TRUE OR hakAccounting() == TRUE OR hakGudang() == TRUE OR hakAdminPO() == TRUE): ?>
        <li class="nav-item">
            <a href="<?php echo base_url('transaksi/data_penjualan.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                    Penjualan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
    <?php endif; ?>
    <?php if (hakOwner() == TRUE OR hakAdmin() == TRUE OR hakAccounting() == TRUE OR hakAdminPO() == TRUE): ?>
        <li class="nav-item">
            <a href="<?php echo base_url('transaksi/data_pembayaran.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>
                    Pembayaran
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
    <?php endif; ?>
    <?php if (hakOwner() == TRUE OR hakAdmin() == TRUE OR hakAccounting() == TRUE OR hakAdminPO() == TRUE): ?>
        <li class="nav-item">
            <a href="<?php echo base_url('transaksi/struk.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>
                    Buat Struk
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
    <?php endif; ?>
</ul>