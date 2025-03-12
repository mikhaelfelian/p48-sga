<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Kepegawaian Section -->
        <li class="nav-header">KEPEGAWAIAN</li>
        <li class="nav-item">
            <a href="<?= base_url('sdm/data_karyawan'); ?>"
                class="nav-link <?= (strpos(current_url(), '/sdm/data_karyawan') !== false ? 'active' : ''); ?>">
                <i class="fas fa-users nav-icon"></i>
                <p>Data Karyawan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('sdm/pengajuan_cuti.php'); ?>"
                class="nav-link <?= (strpos(current_url(), '/sdm/pengajuan_cuti') !== false ? 'active' : ''); ?>">
                <i class="far fa-calendar-alt nav-icon"></i>
                <p>Pengajuan Cuti <span class="badge badge-info right">6</span></p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('sdm/pengajuan_ijin.php'); ?>"
                class="nav-link <?= (strpos(current_url(), '/sdm/pengajuan_ijin') !== false ? 'active' : ''); ?>">
                <i class="far fa-calendar-check nav-icon"></i>
                <p>Pengajuan Ijin <span class="badge badge-info right">2</span></p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('sdm/surat_keterangan.php'); ?>"
                class="nav-link <?= (strpos(current_url(), '/sdm/surat_keterangan') !== false ? 'active' : ''); ?>">
                <i class="far fa-envelope nav-icon"></i>
                <p>Data Surat Keterangan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('sdm/surat_penugasan.php'); ?>"
                class="nav-link <?= (strpos(current_url(), '/sdm/surat_penugasan') !== false ? 'active' : ''); ?>">
                <i class="far fa-file-alt nav-icon"></i>
                <p>Data Surat Penugasan</p>
            </a>
        </li>
    </ul>
</nav>