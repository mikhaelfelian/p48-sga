<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">MASTER DATA</li>
    
    <?php if (hakSA() == TRUE OR hakOwner() == TRUE OR hakAdminM() OR hakAdmin() == TRUE) { ?>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_kategori.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                    Data Kategori
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_merk.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                    Data Merk
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_satuan.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                    Data Satuan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_item.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>
                    Data Item
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_berkas.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                    Data Tipe Dokumen
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_pelanggan.php') ?>" class="nav-link">
                <i class="nav-icon fa-brands fa-opencart"></i>
                <p>
                    Data Pelanggan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_supplier.php') ?>" class="nav-link">
                <i class="nav-icon fa-solid fa-truck-fast"></i>
                <p>
                    Data Supplier
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/karyawan_list.php') ?>" class="nav-link">
                <i class="nav-icon fa-solid fa-users"></i>
                <p>
                    Data Karyawan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
    <?php }elseif (hakSales() == TRUE OR hakGudang() == TRUE) { ?>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_kategori.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                    Data Kategori
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_merk.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                    Data Merk
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_satuan.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                    Data Satuan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_item.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>
                    Data Item
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_pelanggan.php') ?>" class="nav-link">
                <i class="nav-icon fa-brands fa-opencart"></i>
                <p>
                    Data Pelanggan
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
    <?php } ?>
</ul>