<?php
/**
 * Employee Leave/Time-off Data View
 * 
 * This view displays employee leave/time-off data in a table format.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-14
 */
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengajuan Cuti</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengajuan Cuti</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Data Pengajuan Cuti</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('sdm/cuti/tambah'); ?>" class="btn btn-primary btn-sm rounded-0">
                                    <i class="fas fa-plus"></i> Tambah Pengajuan
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Filter Section -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <?= form_open('', ['method' => 'get', 'class' => 'form-inline']); ?>
                                    <div class="input-group rounded-0">
                                        <?= form_input('filter_nama', $this->input->getVar('filter_nama'), 'class="form-control rounded-0" placeholder="Isikan Nama Karyawan ..."'); ?>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary rounded-0"><i class="fas fa-search"></i> Filter</button>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                                <div class="col-md-6">
                                    <select name="filter_status" class="form-control rounded-0 float-right" style="width: 200px;" onchange="this.form.submit()">
                                        <option value="-">- [Pilih Status] -</option>
                                        <option value="0" <?= ($this->input->getVar('filter_status') == '0') ? 'selected' : ''; ?>>Menunggu</option>
                                        <option value="1" <?= ($this->input->getVar('filter_status') == '1') ? 'selected' : ''; ?>>Disetujui</option>
                                        <option value="2" <?= ($this->input->getVar('filter_status') == '2') ? 'selected' : ''; ?>>Ditolak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="10%">Tanggal</th>
                                            <th width="20%">Karyawan</th>
                                            <th width="10%">Tgl Cuti</th>
                                            <th width="10%">Tgl Masuk</th>
                                            <th width="25%">Keterangan</th>
                                            <th width="20%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($SQLCuti) && !empty($SQLCuti)): ?>
                                            <?php $no = $Halaman; foreach ($SQLCuti as $cuti): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= date('d-m-Y', strtotime($cuti['tgl_simpan'])) ?></td>
                                                    <td>
                                                        <strong><?= $cuti['nama_karyawan'] ?? 'N/A' ?></strong>
                                                        <?php if (!empty($cuti['kode_karyawan'])): ?>
                                                            <br><small><?= $cuti['kode_karyawan'] ?></small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= date('d-m-Y', strtotime($cuti['tgl_keluar'])) ?></td>
                                                    <td><?= date('d-m-Y', strtotime($cuti['tgl_masuk'])) ?></td>
                                                    <td><?= $cuti['keterangan'] ?? '-' ?></td>
                                                    <td class="text-center">
                                                        <div class="mb-1"><?= status_cuti($cuti['status']) ?></div>
                                                        <a href="<?= base_url('sdm/cuti/detail/' . $cuti['id']) ?>" class="btn btn-info btn-sm rounded-0 mb-1">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                        <a href="<?= base_url('sdm/cuti/cetak/' . $cuti['id']) ?>" class="btn btn-success btn-sm rounded-0 mb-1">
                                                            <i class="fas fa-print"></i> Cetak
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data pengajuan cuti</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="mt-3">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php if (isset($CurrentPage) && isset($TotalPages) && $TotalPages > 1): ?>
                                            <li class="page-item <?= ($CurrentPage == 1) ? 'disabled' : '' ?>">
                                                <a class="page-link rounded-0" href="<?= base_url('sdm/cuti/data_cuti?page=' . ($CurrentPage - 1)) ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php for ($i = 1; $i <= $TotalPages; $i++): ?>
                                                <li class="page-item <?= ($i == $CurrentPage) ? 'active' : '' ?>">
                                                    <a class="page-link rounded-0" href="<?= base_url('sdm/cuti/data_cuti?page=' . $i) ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item <?= ($CurrentPage == $TotalPages) ? 'disabled' : '' ?>">
                                                <a class="page-link rounded-0" href="<?= base_url('sdm/cuti/data_cuti?page=' . ($CurrentPage + 1)) ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper --> 