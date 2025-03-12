<?php
/**
 * Employee Employment Data View
 * 
 * This view displays and manages employee employment data.
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
                    <h1 class="m-0">Data Kepegawaian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('profile/' . $SQLKary->id) ?>">Profile</a></li>
                        <li class="breadcrumb-item active">Data Kepegawaian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
               <!--
                <div class="row">
                <div class="col-md-10">
                 <?= form_open('profile/sdm/data_pegawai_simpan.php', ['method' => 'post', 'id' => 'form-pegawai', 'class' => 'needs-validation']) ?>
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header rounded-0">
                            <h3 class="card-title">DATA KEPEGAWAIAN - <?= strtoupper($SQLKary->nama ?? '') ?></h3>
                        </div>
                        <div class="card-body rounded-0">
                            <?php if (isset($SQLKary->id)): ?>
                                <input type="hidden" name="id_karyawan" value="<?= $SQLKary->id ?? '' ?>">
                                <input type="hidden" name="id" value="<?= $SQLPeg->id ?? '' ?>">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kode">Kode Pegawai</label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['kode']) ? ' is-invalid' : ''),
                                                    'id' => 'kode',
                                                    'name' => 'kode',
                                                    'placeholder' => 'Isikan Kode Pegawai...',
                                                    'value' => $SQLPeg->kode ?? old('kode')
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['kode'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['kode'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="id_dept">Departemen <span class="text-danger">*</span></label>
                                                <select name="id_dept" id="id_dept"
                                                    class="form-control rounded-0 select2 <?= isset(session()->getFlashdata('errors')['id_dept']) ? 'is-invalid' : '' ?>">
                                                    <option value="">-- Pilih Departemen --</option>
                                                    <?php if (isset($SQLDept) && is_array($SQLDept)): ?>
                                                        <?php foreach ($SQLDept as $dept): ?>
                                                            <option value="<?= $dept->id ?>" <?= (isset($SQLPeg->id_dept) && $SQLPeg->id_dept == $dept->id) || old('id_dept') == $dept->id ? 'selected' : '' ?>>
                                                                <?= $dept->dept ?> (<?= $dept->kode ?>)
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if (isset(session()->getFlashdata('errors')['id_dept'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['id_dept'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="id_jabatan">Jabatan <span class="text-danger">*</span></label>
                                                <select name="id_jabatan" id="id_jabatan"
                                                    class="form-control rounded-0 select2 <?= isset(session()->getFlashdata('errors')['id_jabatan']) ? 'is-invalid' : '' ?>">
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    <?php if (isset($SQLJabatan) && is_array($SQLJabatan)): ?>
                                                        <?php foreach ($SQLJabatan as $jabatan): ?>
                                                            <option value="<?= $jabatan->id ?>" <?= (isset($SQLPeg->id_jabatan) && $SQLPeg->id_jabatan == $jabatan->id) || old('id_jabatan') == $jabatan->id ? 'selected' : '' ?>>
                                                                <?= $jabatan->jabatan ?> (<?= $jabatan->kode ?>)
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if (isset(session()->getFlashdata('errors')['id_jabatan'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['id_jabatan'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="tipe">Status Kepegawaian</label>
                                                <select name="tipe" id="tipe"
                                                    class="form-control rounded-0 <?= isset(session()->getFlashdata('errors')['tipe']) ? 'is-invalid' : '' ?>">
                                                    <option value="0" <?= (isset($SQLPeg->tipe) && $SQLPeg->tipe == '0') || old('tipe') == '0' ? 'selected' : '' ?>>Karyawan Tetap</option>
                                                    <option value="1" <?= (isset($SQLPeg->tipe) && $SQLPeg->tipe == '1') || old('tipe') == '1' ? 'selected' : '' ?>>Karyawan Kontrak</option>
                                                    <option value="2" <?= (isset($SQLPeg->tipe) && $SQLPeg->tipe == '2') || old('tipe') == '2' ? 'selected' : '' ?>>Karyawan Magang</option>
                                                    <option value="3" <?= (isset($SQLPeg->tipe) && $SQLPeg->tipe == '3') || old('tipe') == '3' ? 'selected' : '' ?>>Karyawan Outsourcing</option>
                                                </select>
                                                <?php if (isset(session()->getFlashdata('errors')['tipe'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['tipe'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tgl_masuk">Tanggal Masuk</label>
                                                        <div class="input-group date">
                                                            <?= form_input([
                                                                'type' => 'text',
                                                                'class' => 'form-control rounded-0 datepicker' . (isset(session()->getFlashdata('errors')['tgl_masuk']) ? ' is-invalid' : ''),
                                                                'id' => 'tgl_masuk',
                                                                'name' => 'tgl_masuk',
                                                                'placeholder' => 'YYYY-MM-DD',
                                                                'value' => tgl_indo7($SQLPeg->tgl_masuk) ?? old('tgl_masuk')
                                                            ]) ?>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text rounded-0"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <?php if (isset(session()->getFlashdata('errors')['tgl_masuk'])): ?>
                                                                <div class="invalid-feedback">
                                                                    <?= session()->getFlashdata('errors')['tgl_masuk'] ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tgl_keluar">Tanggal Keluar</label>
                                                        <div class="input-group date">
                                                            <?= form_input([
                                                                'type' => 'text',
                                                                'class' => 'form-control rounded-0 datepicker' . (isset(session()->getFlashdata('errors')['tgl_keluar']) ? ' is-invalid' : ''),
                                                                'id' => 'tgl_keluar',
                                                                'name' => 'tgl_keluar',
                                                                'placeholder' => 'YYYY-MM-DD',
                                                                'value' => tgl_indo7($SQLPeg->tgl_keluar) ?? old('tgl_keluar')
                                                            ]) ?>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text rounded-0"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <?php if (isset(session()->getFlashdata('errors')['tgl_keluar'])): ?>
                                                                <div class="invalid-feedback">
                                                                    <?= session()->getFlashdata('errors')['tgl_keluar'] ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_bpjs_tk">Nomor BPJS Ketenagakerjaan</label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['no_bpjs_tk']) ? ' is-invalid' : ''),
                                                    'id' => 'no_bpjs_tk',
                                                    'name' => 'no_bpjs_tk',
                                                    'placeholder' => 'Isikan Nomor BPJS Ketenagakerjaan...',
                                                    'value' => $SQLPeg->no_bpjs_tk ?? old('no_bpjs_tk')
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['no_bpjs_tk'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['no_bpjs_tk'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="no_bpjs_ks">Nomor BPJS Kesehatan</label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['no_bpjs_ks']) ? ' is-invalid' : ''),
                                                    'id' => 'no_bpjs_ks',
                                                    'name' => 'no_bpjs_ks',
                                                    'placeholder' => 'Isikan Nomor BPJS Kesehatan...',
                                                    'value' => $SQLPeg->no_bpjs_ks ?? old('no_bpjs_ks')
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['no_bpjs_ks'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['no_bpjs_ks'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="no_npwp">Nomor NPWP</label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['no_npwp']) ? ' is-invalid' : ''),
                                                    'id' => 'no_npwp',
                                                    'name' => 'no_npwp',
                                                    'placeholder' => 'Isikan Nomor NPWP...',
                                                    'value' => $SQLPeg->no_npwp ?? old('no_npwp')
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['no_npwp'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['no_npwp'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="no_ptkp">Status PTKP</label>
                                                <select name="no_ptkp" id="no_ptkp"
                                                    class="form-control rounded-0 <?= isset(session()->getFlashdata('errors')['no_ptkp']) ? 'is-invalid' : '' ?>">
                                                    <option value="">-- Pilih Status PTKP --</option>
                                                    <option value="TK/0" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'TK/0') || old('no_ptkp') == 'TK/0' ? 'selected' : '' ?>>TK/0 - Tidak Kawin, Tanpa Tanggungan</option>
                                                    <option value="TK/1" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'TK/1') || old('no_ptkp') == 'TK/1' ? 'selected' : '' ?>>TK/1 - Tidak Kawin, 1 Tanggungan</option>
                                                    <option value="TK/2" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'TK/2') || old('no_ptkp') == 'TK/2' ? 'selected' : '' ?>>TK/2 - Tidak Kawin, 2 Tanggungan</option>
                                                    <option value="TK/3" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'TK/3') || old('no_ptkp') == 'TK/3' ? 'selected' : '' ?>>TK/3 - Tidak Kawin, 3 Tanggungan</option>
                                                    <option value="K/0" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'K/0') || old('no_ptkp') == 'K/0' ? 'selected' : '' ?>>K/0 - Kawin, Tanpa Tanggungan</option>
                                                    <option value="K/1" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'K/1') || old('no_ptkp') == 'K/1' ? 'selected' : '' ?>>K/1 - Kawin, 1 Tanggungan</option>
                                                    <option value="K/2" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'K/2') || old('no_ptkp') == 'K/2' ? 'selected' : '' ?>>K/2 - Kawin, 2 Tanggungan</option>
                                                    <option value="K/3" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'K/3') || old('no_ptkp') == 'K/3' ? 'selected' : '' ?>>K/3 - Kawin, 3 Tanggungan</option>
                                                    <option value="K/I/0" <?= (isset($SQLPeg->no_ptkp) && $SQLPeg->no_ptkp == 'K/I/0') || old('no_ptkp') == 'K/I/0' ? 'selected' : '' ?>>K/I/0 - Kawin, Penghasilan Istri Digabung, Tanpa Tanggungan
                                                    </option>
                                                </select>
                                                <?php if (isset(session()->getFlashdata('errors')['no_ptkp'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['no_ptkp'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="no_rek">Nomor Rekening</label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['no_rek']) ? ' is-invalid' : ''),
                                                    'id' => 'no_rek',
                                                    'name' => 'no_rek',
                                                    'placeholder' => 'Isikan Nomor Rekening...',
                                                    'value' => $SQLPeg->no_rek ?? old('no_rek')
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['no_rek'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['no_rek'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <?= form_textarea([
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['keterangan']) ? ' is-invalid' : ''),
                                                    'id' => 'keterangan',
                                                    'name' => 'keterangan',
                                                    'placeholder' => 'Isikan Keterangan...',
                                                    'value' => $SQLPeg->keterangan ?? old('keterangan'),
                                                    'rows' => 4
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['keterangan'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['keterangan'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-left">
                            <a href="<?= base_url('profile') ?>"
                                class="btn btn-secondary mr-2 rounded-0"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" form="form-pegawai" class="btn btn-primary float-right rounded-0"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
                                                -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-id-card"></i> Data Kepegawaian</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">ID Karyawan</th>
                                            <th width="20%">Divisi</th>
                                            <th width="20%">Jabatan</th>
                                            <th width="15%">Status PTKP</th>
                                            <th width="15%">Status Kary</th>
                                            <th width="10%" class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($SQLPeg) && !empty($SQLPeg)): ?>
                                            <tr>
                                                <td>1</td>
                                                <td><?= $SQLPeg->kode ?? '-' ?></td>
                                                <td>
                                                    <?php 
                                                        $dept_name = '-';
                                                        if (isset($SQLDept) && is_array($SQLDept) && isset($SQLPeg->id_dept)) {
                                                            foreach ($SQLDept as $dept) {
                                                                if ($dept->id == $SQLPeg->id_dept) {
                                                                    $dept_name = $dept->dept;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        echo strtoupper($dept_name);
                                                    ?>
                                                    <div class="small text-muted">
                                                        Tgl Bergabung: <?= $SQLPeg->tgl_masuk ? date('d-m-Y', strtotime($SQLPeg->tgl_masuk)) : '-' ?>
                                                    </div>
                                                    <div class="small text-muted">
                                                        Tgl Selesai: <?= $SQLPeg->tgl_keluar ? date('d-m-Y', strtotime($SQLPeg->tgl_keluar)) : '-' ?>
                                                    </div>
                                                    <?php
                                                        // Calculate years of service
                                                        $years = '-';
                                                        if (!empty($SQLPeg->tgl_masuk)) {
                                                            $start_date = new DateTime($SQLPeg->tgl_masuk);
                                                            $end_date = !empty($SQLPeg->tgl_keluar) ? new DateTime($SQLPeg->tgl_keluar) : new DateTime();
                                                            $interval = $start_date->diff($end_date);
                                                            $years = $interval->y . ' Tahun';
                                                        }
                                                    ?>
                                                    <div class="small text-muted"><?= $years ?></div>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $jabatan_name = '-';
                                                        if (isset($SQLJabatan) && is_array($SQLJabatan) && isset($SQLPeg->id_jabatan)) {
                                                            foreach ($SQLJabatan as $jabatan) {
                                                                if ($jabatan->id == $SQLPeg->id_jabatan) {
                                                                    $jabatan_name = $jabatan->jabatan;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        echo strtoupper($jabatan_name);
                                                    ?>
                                                </td>
                                                <td><?= $SQLPeg->no_ptkp ?? '-' ?></td>
                                                <td>
                                                    <?php
                                                        echo status_pegawai($SQLPeg->tipe ?? null);
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <!-- <a href="<?= base_url('profile/sdm/data_pegawai_hapus/' . ($SQLPeg->id ?? '')) ?>" 
                                                       class="btn btn-sm btn-danger rounded-0" 
                                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="<?= base_url('profile/sdm/data_pegawai/' . ($SQLKary->id ?? '')) ?>" 
                                                       class="btn btn-sm btn-primary rounded-0">
                                                        <i class="fas fa-edit"></i>
                                                    </a> -->
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data kepegawaian</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        // Initialize datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
            language: 'id'
        });

        // Format NPWP input
        $('#no_npwp').on('input', function () {
            var npwp = $(this).val().replace(/[^\d]/g, '');
            if (npwp.length > 0) {
                npwp = npwp.match(/.{1,2}/g).join('.');
                if (npwp.length > 6) {
                    npwp = npwp.substring(0, 6) + '.' + npwp.substring(6);
                }
                if (npwp.length > 12) {
                    npwp = npwp.substring(0, 12) + '-' + npwp.substring(12);
                }
                if (npwp.length > 16) {
                    npwp = npwp.substring(0, 16) + '.' + npwp.substring(16);
                }
            }
            $(this).val(npwp);
        });
    });
</script>