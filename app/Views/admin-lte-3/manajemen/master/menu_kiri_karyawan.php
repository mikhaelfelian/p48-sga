<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">DATA KARYAWAN</li>
    <?php if(hakSDM() != TRUE && !hakAdminPO() && !hakAdminOffice() && !hakAdminECatalog()){ ?>
        <!-- SELAIN SDM BOLEH TAMBAH DATA -->
    <li class="nav-item">
        <a href="<?php echo base_url('master/karyawan_tambah.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-plus"></i>
            <p>
                Tambah
            </p>
        </a>
    </li>
    <?php } ?>
    <li class="nav-item">
        <a href="<?php echo base_url('master/karyawan_list.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Data Karyawan
            </p>
        </a>
    </li>
</ul>