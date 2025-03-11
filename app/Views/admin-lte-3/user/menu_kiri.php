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
    <?php } ?>
</ul>