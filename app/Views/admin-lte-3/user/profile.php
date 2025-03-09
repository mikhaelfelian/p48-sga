<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?php echo base_url((!empty($Pengguna->file_name) ? $Pengguna->file_name : 'assets/theme/admin-lte-3/dist/img/user2-160x160.jpg')) ?>"
                                    alt="<?php echo $Pengguna->first_name ?> profile picture"
                                    style="width: 100px; height: 100px;">
                                <?php if (!empty($Pengguna->file_name)): ?>
                                    <div class="mt-2">
                                        <a href="<?php echo base_url('profile/hapus_foto/' . $Pengguna->id) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?')">
                                            <i class="fas fa-trash"></i> Hapus Foto
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="profile-username text-center"><?php echo strtoupper($Pengguna->first_name) ?>
                            </h3>
                            <p class="text-muted text-center"><?php echo ucwords($PenggunaGrup->name) ?></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nama Lengkap</b> <a
                                        class="float-right"><?php echo strtoupper($Pengguna->first_name) ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Username</b> <a
                                        class="float-right"><?php echo strtolower($Pengguna->username) ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <?php echo form_open_multipart(base_url('profile/profile_set_update.php'), 'autocomplete="off"'); ?>

                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">&nbsp;&nbsp;Profile Karyawan</li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php if (!empty($SQLKary->id)) { ?>
                                <?php echo form_hidden('id', (!empty($SQLKary->id) ? $SQLKary->id : '')) ?>
                                <?php echo form_hidden('id_user', (!empty($SQLKary->id_user) ? $SQLKary->id_user : '')) ?>
                                <?php echo form_hidden('grup', (!empty($SQLKary->id_user) ? $SQLKary->id_user : '')) ?>
                                <div class="form-group <?php echo (!empty($psnGagal['kode']) ? 'has-error' : '') ?>">
                                    <label class="control-label">Kode</label>
                                    <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kode ...', 'value' => (!empty($SQLKary->kode) ? $SQLKary->kode : ''), 'readonly' => 'true']) ?>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group <?php echo (!empty($psnGagal['nik']) ? 'has-error' : '') ?>">
                                        <label class="control-label">NIK*</label>
                                        <?php echo form_input(['id' => 'nik', 'name' => 'nik', 'class' => 'form-control rounded-0' . (!empty($psnGagal['nik']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nik lengkap ...', 'value' => (!empty($SQLKary->nik) ? $SQLKary->nik : '')]) ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-9">
                                            <div
                                                class="form-group <?php echo (!empty($psnGagal['nama']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Nama Lengkap*</label>
                                                <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control rounded-0' . (!empty($psnGagal['nama']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nama lengkap karyawan ...', 'value' => (!empty($SQLKary->nama) ? $SQLKary->nama : '')]) ?>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div
                                                class="form-group <?php echo (!empty($psnGagal['nama_blk']) ? 'has-error' : '') ?>">
                                                <label class="control-label">Gelar</label>
                                                <?php echo form_input(['id' => 'nama_blk', 'name' => 'nama_blk', 'class' => 'form-control rounded-0' . (!empty($psnGagal['nama']) ? ' is-invalid' : ''), 'placeholder' => 'Gelar ...', 'value' => (!empty($SQLKary->nama_blk) ? $SQLKary->nama_blk : '')]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="form-group<?php echo (!empty($psnGagal['jns_klm']) ? ' has-error' : '') ?>">
                                        <label class="control-label">Jenis Kelamin*</label>
                                        <select name="jns_klm"
                                            class="form-control rounded-0<?php echo (!empty($psnGagal['jns_klm']) ? ' is-invalid' : '') ?>">
                                            <option value="">- Pilih -</option>
                                            <option value="L" <?php echo (!empty($SQLKary->jns_klm) ? ($SQLKary->jns_klm == 'L' ? 'selected' : '') : '') ?>>Laki - laki</option>
                                            <option value="P" <?php echo (!empty($SQLKary->jns_klm) ? ($SQLKary->jns_klm == 'P' ? 'selected' : '') : '') ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div
                                        class="form-group<?php echo (!empty($psnGagal['no_hp']) ? ' has-error' : '') ?>">
                                        <label class="control-label">No. HP</label>
                                        <?php echo form_input(['id' => 'no_hp', 'name' => 'no_hp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_hp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nomor HP ...', 'value' => (!empty($SQLKary->no_hp) ? $SQLKary->no_hp : '')]) ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div
                                        class="form-group <?php echo (!empty($psnGagal['alamat']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Alamat*</label>
                                        <?php echo form_textarea(['id' => 'alamat', 'name' => 'alamat', 'class' => 'form-control rounded-0' . (!empty($psnGagal['alamat']) ? ' is-invalid' : ''), 'style' => 'height: 124px;', 'placeholder' => 'Mohon diisi alamat lengkap sesuai identitas ...', 'value' => (!empty($SQLKary->alamat) ? $SQLKary->alamat : '')]) ?>
                                    </div>
                                    <div
                                        class="form-group <?php echo (!empty($psnGagal['alamat_dom']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Alamat Domisili</label>
                                        <?php echo form_textarea(['id' => 'alamat_dom', 'name' => 'alamat_dom', 'class' => 'form-control rounded-0' . (!empty($psnGagal['alamat_dom']) ? ' is-invalid' : ''), 'style' => 'height: 124px;', 'placeholder' => 'Mohon diisi alamat lengkap sesuai domisili ...', 'value' => (!empty($SQLKary->alamat_dom) ? $SQLKary->alamat_dom : '')]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div
                                        class="form-group <?php echo (!empty($psnGagal['tmp_lahir']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Tempat Lahir</label>
                                        <?php echo form_input(['id' => 'tmp_lahir', 'name' => 'tmp_lahir', 'class' => 'form-control rounded-0' . (!empty($psnGagal['tmp_lahir']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan tempat lahir ...', 'value' => (!empty($SQLKary->tmp_lahir) ? $SQLKary->tmp_lahir : '')]) ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Foto Profile</label>
                                        <?php echo form_upload(['id' => 'fupload', 'name' => 'fupload', 'class' => 'form-control rounded-0']); ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group ">
                                        <label class="control-label">Tgl Lahir</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(['id' => 'tgl_lahir', 'name' => 'tgl_lahir', 'class' => 'form-control rounded-0' . (!empty($psnGagal['tgl_lahir']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan tanggal lahir ...', 'readonly' => 'true', 'value' => (!empty($SQLKary->tgl_lahir) ? tgl_indo2($SQLKary->tgl_lahir) : '')]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-4">
                                    <div
                                        class="form-group<?php echo (!empty($psnGagal['user']) ? ' has-error' : '') ?>">
                                        <label class="control-label">Username</label>
                                        <?php echo form_input(['id' => 'user', 'name' => 'user', 'class' => 'form-control rounded-0' . (!empty($psnGagal['user']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan username ...', 'value' => (!empty($Pengguna->username) ? $Pengguna->username : '')]) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group<?php echo (!empty($psnGagal['pass']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Kata Sandi</label>
                                        <?php echo form_password(['id' => 'pass', 'name' => 'pass', 'class' => 'form-control rounded-0' . (!empty($psnGagal['pass']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kata sandi ...']) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="control-label">Ulang Kata Sandi*</label>
                                        <?php echo form_password(['id' => 'pass2', 'name' => 'pass2', 'class' => 'form-control rounded-0' . (!empty($psnGagal['pass2']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan ulang kata sandi ...']) ?>
                                        <?php echo (!empty($psnGagal['pass2']) ? '<small><i class="text-danger">' . $psnGagal['pass2'] . '</i></small>' : '') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--<button type="button" onclick="window.location.href = ''" class="btn btn-primary btn-flat">&laquo; Kembali</button>-->
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i>
                                        Simpan</button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- Page script -->
<script type="text/javascript">
    $(function () {
        $("#tgl_lahir").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1920:<?php echo date('Y') ?>',
            autoclose: true
        });
        <?php echo session()->getFlashdata('pengaturan_toast'); ?>

        <?php if (session()->getFlashdata('message')): ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('message_type') ?? 'success' ?>',
                title: '<?= session()->getFlashdata('message_type') == 'success' ? 'Berhasil!' : 'Gagal!' ?>',
                text: '<?= session()->getFlashdata('message') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>
    });

    function confirmDelete() {
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin menghapus foto profil?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('profile/hapus_foto') ?>';
            }
        });
    }
</script>