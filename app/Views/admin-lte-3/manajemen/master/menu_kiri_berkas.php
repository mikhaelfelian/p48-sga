<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">DATA TIPE DOKUMEN</li>
    <?php if (hakSDM() != TRUE && !hakAdminPO() && !hakAdminOffice()) { ?>
        <li class="nav-item">
            <a href="<?php echo base_url('master/data_berkas_tambah.php') ?>" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>
                    Tambah
                </p>
            </a>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a href="<?php echo base_url('master/data_berkas.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Data Tipe Dokumen
            </p>
        </a>
    </li>
</ul>