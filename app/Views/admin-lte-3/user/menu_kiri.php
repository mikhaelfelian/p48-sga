<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">DATA PRIBADI</li>

    <?php if (hakSA() == TRUE or hakOwner() == TRUE or hakAdminM() or hakAdmin() == TRUE) { ?>
        <li class="nav-item">
            <a href="<?php echo base_url('profile/sdm/data_keluarga') ?>" class="nav-link">
                <i class="nav-icon fa-solid fa-house-user"></i>
                <p>
                    Data Keluarga
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('profile/sdm/data_pendidikan') ?>" class="nav-link">
                <i class="nav-icon fas fa-solid fa-graduation-cap"></i>
                <p>
                    Data Pendidikan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('profile/sdm/data_pegawai') ?>" class="nav-link">
                <i class="nav-icon fas fa-solid fa-id-card"></i>
                <p>
                    Data Kepegawaian
                </p>
            </a>
        </li>
    <?php } ?>
</ul>