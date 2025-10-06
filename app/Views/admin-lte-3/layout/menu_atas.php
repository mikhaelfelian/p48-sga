<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    <?php
    switch ($PenggunaGrup->name) {
        case 'root':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('master') ?>" class="nav-link">Master</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Pembelian</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Pengaturan</a>
            </li>
            <?php
            break;

        case 'owner':
        case 'adminm':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('master') ?>" class="nav-link">Master</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('pembelian') ?>" class="nav-link">Pembelian</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('gudang') ?>" class="nav-link">Gudang</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('sdm') ?>" class="nav-link">SDM</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('laporan') ?>" class="nav-link">Laporan</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('pengaturan') ?>" class="nav-link">Pengaturan</a>
            </li>
            <?php
            break;

        case 'sales':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('master') ?>" class="nav-link">Master</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <?php
            break;

        case 'admin':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('master') ?>" class="nav-link">Master</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('pembelian') ?>" class="nav-link">Pembelian</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('laporan') ?>" class="nav-link">Laporan</a>
            </li>
            <?php
            break;

        case 'gudang':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('gudang') ?>" class="nav-link">Gudang</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <!-- <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('pembelian') ?>" class="nav-link">Pembelian</a>
            </li> -->
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('laporan') ?>" class="nav-link">Laporan</a>
            </li>
            <?php
            break;
            
        case 'purchasing':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('pembelian') ?>" class="nav-link">Pembelian</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('laporan') ?>" class="nav-link">Laporan</a>
            </li>
            <?php
            break;

        case 'teknisi':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <?php
            break;

        case 'accounting':
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('transaksi') ?>" class="nav-link">Penjualan</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('pembelian') ?>" class="nav-link">Pembelian</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo base_url('laporan') ?>" class="nav-link">Laporan</a>
            </li>
            <?php
            break;

    }
    ?>

    <!--MENU UNTUK PONSEL-->
    <li class="nav-item d-lg-none dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            switch ($PenggunaGrup->name) {
                case 'root':
                    ?>
                    <a href="<?php echo base_url('master') ?>" class="dropdown-item">Master</a>
                    <a href="<?php echo base_url('transaksi') ?>" class="dropdown-item">Penjualan</a>
                    <a href="<?php echo base_url('pembelian') ?>" class="dropdown-item">Pembelian</a>
                    <a href="<?php echo base_url('gudang') ?>" class="dropdown-item">Gudang</a>
                    <a href="<?php echo base_url('pengaturan') ?>" class="dropdown-item">Pengaturan</a>
                    <?php
                    break;

                case 'owner':
                    ?>
                    <a href="<?php echo base_url('master') ?>" class="dropdown-item">Master</a>
                    <a href="<?php echo base_url('transaksi') ?>" class="dropdown-item">Penjualan</a>
                    <a href="<?php echo base_url('pembelian') ?>" class="dropdown-item">Pembelian</a>
                    <a href="<?php echo base_url('gudang') ?>" class="dropdown-item">Gudang</a>
                    <a href="<?php echo base_url('pengaturan') ?>" class="dropdown-item">Pengaturan</a>
                    <?php
                    break;

                case 'sales':
                    ?>
                    <a href="<?php echo base_url('master') ?>" class="dropdown-item">Master</a>
                    <a href="<?php echo base_url('transaksi') ?>" class="dropdown-item">Penjualan</a>
                    <?php
                    break;

                case 'admin':
                    ?>
                    <a href="<?php echo base_url('master') ?>" class="dropdown-item">Master</a>
                    <a href="<?php echo base_url('transaksi') ?>" class="dropdown-item">Penjualan</a>
                    <a href="<?php echo base_url('pembelian') ?>" class="dropdown-item">Pembelian</a>
                    <?php
                    break;

                case 'gudang':
                    ?>
                    <a href="<?php echo base_url('gudang') ?>" class="dropdown-item">Gudang</a>
                    <a href="<?php echo base_url('laporan') ?>" class="dropdown-item">Laporan</a>
                    <?php
                    break;
            }
            ?>
        </div>
    </li>
    <!--AKHIR MODUL MENU PONSEL-->
</ul>