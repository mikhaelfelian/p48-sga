<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <?php
    switch ($PenggunaGrup->name) {
        case 'root': ?>
            <li class="nav-header">DATA OMSET</li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/omset/data_rab.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-file-invoice"></i>
                    <p>Data RAB</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/omset/data_penjualan.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>Data Penjualan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/omset/data_pembelian.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    <p>Data Pembelian</p>
                </a>
            </li>
            <li class="nav-header">DATA KEUANGAN</li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/finance/data_modal.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>Data Modal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/finance/data_untung_rugi.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>Untung Rugi</p>
                </a>
            </li>
            <li class="nav-header">DATA GUDANG</li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/gudang/data_stock.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-boxes-stacked"></i>
                    <p>Data Stock</p>
                </a>
            </li>
            <li class="nav-header">DATA RESUME</li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/resume/data_karyawan.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>Data Karywan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/resume/data_supplier.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>Data Supplier</p>
                </a>
            </li>
        <?php
            break;

            case 'owner': ?>
                <li class="nav-header">DATA OMSET</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/omset/data_rab.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Data RAB</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/omset/data_penjualan.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Data Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/omset/data_pembelian.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>Data Pembelian</p>
                    </a>
                </li>
                <li class="nav-header">DATA KEUANGAN</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/finance/data_modal.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Data Modal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/finance/data_untung_rugi.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Untung Rugi</p>
                    </a>
                </li>
                <li class="nav-header">DATA GUDANG</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/gudang/data_stock.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-boxes-stacked"></i>
                        <p>Data Stock</p>
                    </a>
                </li>
                <li class="nav-header">DATA RESUME</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/resume/data_karyawan.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Data Karywan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('laporan/resume/data_supplier.php') ?>" class="nav-link">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>Data Supplier</p>
                    </a>
                </li>
            <?php
                break;

        case 'admin':
        ?>
            <li class="nav-header">DATA KEUANGAN</li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/finance/data_modal.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>Data Modal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/finance/data_untung_rugi.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>Untung Rugi</p>
                </a>
            </li>
        <?php
            break;

        case 'gudang':
        ?>
            <li class="nav-header">DATA GUDANG</li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/gudang/data_stock.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-boxes-stacked"></i>
                    <p>Data Stock</p>
                </a>
            </li>
        <?php
            break;

        case 'purchasing':
        ?>
            <li class="nav-header">DATA OMSET</li>
            <li class="nav-item">
                <a href="<?php echo base_url('laporan/omset/data_pembelian.php') ?>" class="nav-link">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    <p>Data Pembelian</p>
                </a>
            </li>
    <?php
    } ?>
</ul>