<?php
/**
 * Employee Data View
 * 
 * This view displays employee data in a table format.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-13
 */
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Karyawan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('sdm'); ?>">SDM</a></li>
                        <li class="breadcrumb-item active">Data Karyawan</li>
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
                            <h3 class="card-title">Daftar Karyawan</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('sdm/data_karyawan_tambah'); ?>" class="btn btn-primary btn-sm rounded-0">
                                    <i class="fas fa-plus"></i> Tambah Karyawan
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">Kode</th>
                                            <th width="25%">Karyawan</th>
                                            <th width="20%">Kontak</th>
                                            <th width="15%">Status</th>
                                            <th width="10%">PTKP</th>
                                            <th width="15%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($SQLKaryawan) && !empty($SQLKaryawan)): ?>
                                            <?php $no = $Halaman; foreach ($SQLKaryawan as $karyawan): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>
                                                        <?= $karyawan->kode ?? '-' ?>
                                                        <span class="mailbox-read-time float-left"><?= tgl_indo9($karyawan->tgl_simpan) ?></span>
                                                    </td>
                                                    <td>
                                                        <strong><?= $karyawan->nama ?? '' ?> <?= $karyawan->nama_blk ?? '' ?></strong><br>
                                                        <small><i><?= $karyawan->nik ?? '-' ?></i></small><br/>
                                                        <small><i><?= $karyawan->alamat ?? '-' ?></i></small>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($karyawan->no_hp) && $karyawan->no_hp != '-'): ?>
                                                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $karyawan->no_hp) ?>" target="_blank" class="btn btn-success btn-sm btn-block">
                                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?= status_karyawan($karyawan->status, false) ?>
                                                    </td>
                                                    <td>
                                                        <?= $karyawan->ptkp ?? '-' ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('sdm/data_karyawan/detail/' . $karyawan->id) ?>" class="btn btn-info btn-sm mb-1 rounded-0">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="<?= base_url('sdm/data_karyawan/edit/' . $karyawan->id) ?>" class="btn btn-primary btn-sm mb-1 rounded-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data karyawan</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="mt-3">
                                <?= $Pagination ?? '' ?>
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