<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">DATA PENERIMAAN</li>
    <li class="nav-item">
        <a href="<?php echo base_url('gudang/penerimaan/data_beli.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>Stok Masuk</p>
        </a>
    </li>
    <li class="nav-header">INVENTORI</li>
    <li class="nav-item">
        <a href="<?php echo base_url('gudang/stok/data_item.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-box-open"></i>
            <p>Stok</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url('gudang/mutasi/data_mutasi.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-truck"></i>
            <p>Mutasi Stok</p>
        </a>
    </li>
    <li class="nav-header">DATA KODE SN</li>
    <li class="nav-item">
        <a href="<?php echo base_url('gudang/stok/data_sn.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-cubes"></i>
            <p>KODE SN</p>
        </a>
    </li>
    <!--
    <li class="nav-header">PENGEMBALIAN</li>
    <li class="nav-item">
        <a href="<?php // echo base_url('gudang/pengiriman/data_kirim.php') ?>" class="nav-link">
            <i class="nav-icon fas fa-undo"></i>
            <p>Retur</p>
        </a>
    </li>
    -->
</ul>