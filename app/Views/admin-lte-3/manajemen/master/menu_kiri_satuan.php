<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">DATA SATUAN</li>
    <?php if (hakSDM() != TRUE && !hakAdminPO() && !hakAdminOffice()) { ?>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_satuan_tambah.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>
                    Tambah
                </p>
            </a>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a href="<?php echo base_url('master/data_satuan.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Data Satuan
            </p>
        </a>
    </li>
</ul>