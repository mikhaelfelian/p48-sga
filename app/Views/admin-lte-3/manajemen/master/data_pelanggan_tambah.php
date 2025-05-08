<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master/data_pelanggan.php') ?>">Data Pelanggan</a></li>
                        <li class="breadcrumb-item active"><?php echo (!empty($SQLPelanggan->id) ? 'Ubah' : 'Tambah'); ?></li>
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
                <div class="col-md-6">
                    <?php echo form_open(base_url('master/set_pelanggan_' . (!empty($SQLPelanggan) ? 'update' : 'simpan') . '.php')); ?>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Pelanggan</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                            <?php if (!empty($SQLPelanggan->id)) { ?>
                                <?php echo form_hidden('id', (!empty($SQLPelanggan->id) ? $SQLPelanggan->id : '')) ?>
                                <div class="form-group <?php echo (!empty($psnGagal['kode']) ? 'has-error' : '') ?>">
                                    <label class="control-label">Kode</label>
                                    <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kode ...', 'value' => (!empty($SQLPelanggan->kode) ? $SQLPelanggan->kode : ''), 'readonly' => 'true']) ?>
                                </div>
                            <?php } ?>

                            <div class="form-group <?php echo (!empty($psnGagal['nama']) ? 'has-error' : '') ?>">
                                <label class="control-label">Nama*</label>
                                <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control rounded-0' . (!empty($psnGagal['nama']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nama pelanggan ...', 'value' => (!empty($SQLPelanggan->nama) ? $SQLPelanggan->nama : '')]) ?>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['no_telp']) ? 'has-error' : '') ?>">
                                <label class="control-label">No. Telp</label>
                                <?php echo form_input(['id' => 'no_telp', 'name' => 'no_telp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_telp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nomor telepon pelanggan ...', 'value' => (!empty($SQLPelanggan->no_telp) ? $SQLPelanggan->no_telp : '')]) ?>
                            </div>
                            <div class="form-group <?php echo (!empty($psnGagal['alamat']) ? 'has-error' : '') ?>">
                                <label class="control-label">Alamat*</label>
                                <?php echo form_textarea(['id' => 'alamat', 'name' => 'alamat', 'class' => 'form-control rounded-0' . (!empty($psnGagal['alamat']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan alamat pelanggan ...', 'value' => (!empty($SQLPelanggan->alamat) ? $SQLPelanggan->alamat : '')]) ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['kota']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Kota*</label>
                                        <?php echo form_input(['id' => 'kota', 'name' => 'kota', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kota']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan kota ...', 'value' => (!empty($SQLPelanggan->kota) ? $SQLPelanggan->kota : '')]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['provinsi']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Provinsi*</label>
                                        <?php echo form_input(['id' => 'provinsi', 'name' => 'provinsi', 'class' => 'form-control rounded-0' . (!empty($psnGagal['kota']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan provinsi ...', 'value' => (!empty($SQLPelanggan->provinsi) ? $SQLPelanggan->provinsi : '')]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['tipe']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Tipe*</label>
                                        <select name="tipe" class="form-control rounded-0<?php echo (!empty($psnGagal['tipe']) ? ' is-invalid' : '') ?>">
                                            <option value="">- [Pilih] -</option>
                                            <option value="1"<?php echo (!empty($SQLPelanggan->tipe) ? ($SQLPelanggan->tipe == 1 ? 'selected' : '') : '') ?>>Personal</option>
                                            <option value="2"<?php echo (!empty($SQLPelanggan->tipe) ? ($SQLPelanggan->tipe == 2 ? 'selected' : '') : '') ?>>Instansi</option>
                                            <option value="3"<?php echo (!empty($SQLPelanggan->tipe) ? ($SQLPelanggan->tipe == 3 ? 'selected' : '') : '') ?>>Swasta</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['status']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Status*</label>                                
                                        <div class="custom-control custom-radio">
                                            <?php echo form_radio(['id' => 'statusAktif', 'name' => 'status', 'class' => 'custom-control-input', 'checked' => (!empty($SQLPelanggan->status) ? ($SQLPelanggan->status == '1' ? TRUE : FALSE) : ''), 'value' => '1']); ?>
                                            <label for="statusAktif" class="custom-control-label">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <?php echo form_radio(['id' => 'statusNonAktif', 'name' => 'status', 'class' => 'custom-control-input custom-control-input-danger', 'checked' => (!empty($SQLPelanggan->status) ? ($SQLPelanggan->status == '0' ? TRUE : FALSE) : ''), 'value' => '0']); ?>
                                            <label for="statusNonAktif" class="custom-control-label">Non - Aktif</label>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" onclick="window.location.href = '<?php echo base_url('master/data_pelanggan.php') ?>'" class="btn btn-primary btn-flat">&laquo; Kembali</button>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <?php if (!empty($SQLPelanggan)) { ?>
                    <?php if ($SQLPelanggan->tipe > '1') { ?>
                        <div class="col-md-6">
                            <?php echo form_open(base_url('master/set_pelanggan_cp_simpan.php')); ?>
                            <?php echo form_hidden('id_pelanggan', $SQLPelanggan->id); ?>

                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Form Data Kontak</h3>
                                    <div class="card-tools"></div>
                                </div>
                                <div class="card-body">
                                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>

                                    <div class="form-group <?php echo (!empty($psnGagal['nama']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Nama*</label>
                                        <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control rounded-0' . (!empty($psnGagal['nama']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nama CP ...']) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['no_hp']) ? 'has-error' : '') ?>">
                                        <label class="control-label">No. HP</label>
                                        <?php echo form_input(['id' => 'no_hp', 'name' => 'no_hp', 'class' => 'form-control rounded-0' . (!empty($psnGagal['no_hp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan nomor telepon CP ...']) ?>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['jabatan']) ? 'has-error' : '') ?>">
                                        <label class="control-label">Jabatan*</label>
                                        <?php echo form_input(['id' => 'jabatan', 'name' => 'jabatan', 'class' => 'form-control rounded-0' . (!empty($psnGagal['jabatan']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Jabatan ...']) ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">

                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                            <?php echo form_close(); ?>

                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Form Data Kontak</h3>
                                    <div class="card-tools"></div>
                                </div>
                                <div class="card-body">
                                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Nama</th>
                                                <th>HP</th>
                                                <th>Jabatan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($SQLPelangganDet)) {
                                                $no = 1;
                                                foreach ($SQLPelangganDet as $item) {
                                                    ?>
                                                    <tr>
                                                        <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                        <td style="width: 150px;"><?php echo strtoupper($item->nama) ?></td>
                                                        <td style="width: 150px;"><?php echo strtoupper($item->no_hp) ?></td>
                                                        <td style="width: 150px;"><?php echo strtoupper($item->jabatan) ?></td>
                                                        <td style="width: 150px;">
                                                            <?php if(!hakAdminM()) : ?>
                                                            <?php echo anchor(base_url('master/set_pelanggan_hapus_cp.php?id=' . $item->id.'&id_plgn='.$request->getVar('id')), '<i class="fas fa-trash"></i> Hapus', 'onclick="return confirm(\'Hapus [' . (!empty($item->nama) ? $item->nama . ' ' : '') . '] ? \')" class="btn btn-danger btn-flat btn-xs" style="width: 55px;"') ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-6"></div>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- Page script -->
<!-- Toastr -->
<link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.css') ?>">
<script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.js') ?>"></script>

<script type="text/javascript">
    $(function () {
        <?php echo session()->getFlashdata('master_toast'); ?>
    });
</script>