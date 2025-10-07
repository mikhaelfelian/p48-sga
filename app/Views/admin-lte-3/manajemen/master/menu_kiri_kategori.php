<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">DATA KATEGORI</li>
    <?php if (hakSDM() != TRUE && !hakAdminPO() && !hakAdminOffice() && !hakAdminECatalog()) { ?>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_kategori_tambah.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>
                    Tambah
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_kategori_import.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-import"></i>
                <p>
                    Import
                </p>
            </a>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a href="<?php echo base_url('master/data_kategori.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Data Kategori
            </p>
        </a>
    </li>
</ul>