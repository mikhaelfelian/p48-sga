<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Keluarga</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard.php') ?>">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('profile/' . $SQLKary->id) ?>">Profile</a></li>
                        <li class="breadcrumb-item active">Data Keluarga</li>
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
                <div class="col-md-10">
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Data Keluarga Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('pesan')): ?>
                                <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                                    <?= session()->getFlashdata('pesan') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (session()->getFlashdata('errors')): ?>
                                <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Terjadi Kesalahan!</h5>
                                    <ul>
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($SQLKary->id)): ?>
                                <form action="<?= base_url('profile/simpan_data_kel.php/'.$SQLKary->id) ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_karyawan" value="<?= $SQLKary->id ?? '' ?>">
                                    <input type="hidden" name="id" value="<?= $SQLKel->id ?? '' ?>">

                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nm_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['nm_ayah']) ? ' is-invalid' : ''),
                                                    'id' => 'nm_ayah',
                                                    'name' => 'nm_ayah',
                                                    'placeholder' => 'Isikan Nama Ayah ...',
                                                    'value' => $SQLKel->nm_ayah ?? old('nm_ayah'),
                                                    'required' => true
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['nm_ayah'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['nm_ayah'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="tgl_lhr_ayah">Tgl Lahir</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text rounded-0"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <?= form_input([
                                                        'type' => 'text',
                                                        'class' => 'form-control datepicker rounded-0' . (isset(session()->getFlashdata('errors')['tgl_lhr_ayah']) ? ' is-invalid' : ''),
                                                        'id' => 'tgl_lhr_ayah',
                                                        'name' => 'tgl_lhr_ayah',
                                                        'placeholder' => 'Inputkan Tgl Lahir Ayah ...',
                                                        'value' => $SQLKel->tgl_lhr_ayah ?? old('tgl_lhr_ayah')
                                                    ]) ?>
                                                    <?php if (isset(session()->getFlashdata('errors')['tgl_lhr_ayah'])): ?>
                                                        <div class="invalid-feedback">
                                                            <?= session()->getFlashdata('errors')['tgl_lhr_ayah'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="status_kawin">Pernikahan</label>
                                                <select class="form-control rounded-0" id="status_kawin" name="status_kawin">
                                                    <option value="">- Pilih -</option>
                                                    <option value="1" <?= (isset($SQLKel->status_kawin) && $SQLKel->status_kawin == '1') ? 'selected' : '' ?>>Menikah</option>
                                                    <option value="2" <?= (isset($SQLKel->status_kawin) && $SQLKel->status_kawin == '2') ? 'selected' : '' ?>>Belum Menikah</option>
                                                    <option value="3" <?= (isset($SQLKel->status_kawin) && $SQLKel->status_kawin == '3') ? 'selected' : '' ?>>Cerai</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="jns_pasangan">Pasangan</label>
                                                <select class="form-control rounded-0" id="jns_pasangan" name="jns_pasangan">
                                                    <option value="">- Pilih -</option>
                                                    <option value="1" <?= (isset($SQLKel->jns_pasangan) && $SQLKel->jns_pasangan == '1') ? 'selected' : '' ?>>Suami</option>
                                                    <option value="2" <?= (isset($SQLKel->jns_pasangan) && $SQLKel->jns_pasangan == '2') ? 'selected' : '' ?>>Istri</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="file_kk">Unggah Berkas KK<span class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input <?= isset(session()->getFlashdata('errors')['file_kk']) ? 'is-invalid' : '' ?>" id="file_kk" name="file_kk">
                                                    <label class="custom-file-label" for="file_kk">Choose File</label>
                                                    <?php if (isset(session()->getFlashdata('errors')['file_kk'])): ?>
                                                        <div class="invalid-feedback">
                                                            <?= session()->getFlashdata('errors')['file_kk'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <small class="text-muted">* File yang diijinkan : jpg|png|pdf|jpeg|tif</small><br>
                                                <small class="text-muted">* Dokumen yg diunggah : KK</small>
                                                <?php if(isset($SQLKel->file_name) && !empty($SQLKel->file_name)): ?>
                                                    <p class="mt-2">File saat ini: <?= $SQLKel->file_name ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nm_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['nm_ibu']) ? ' is-invalid' : ''),
                                                    'id' => 'nm_ibu',
                                                    'name' => 'nm_ibu',
                                                    'placeholder' => 'Isikan Nama Ibu Kandung ...',
                                                    'value' => $SQLKel->nm_ibu ?? old('nm_ibu'),
                                                    'required' => true
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['nm_ibu'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['nm_ibu'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="tgl_lhr_ibu">Tgl Lahir</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text rounded-0"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <?= form_input([
                                                        'type' => 'text',
                                                        'class' => 'form-control datepicker rounded-0' . (isset(session()->getFlashdata('errors')['tgl_lhr_ibu']) ? ' is-invalid' : ''),
                                                        'id' => 'tgl_lhr_ibu',
                                                        'name' => 'tgl_lhr_ibu',
                                                        'placeholder' => 'Inputkan Tgl Lahir Ibu ...',
                                                        'value' => $SQLKel->tgl_lhr_ibu ?? old('tgl_lhr_ibu')
                                                    ]) ?>
                                                    <?php if (isset(session()->getFlashdata('errors')['tgl_lhr_ibu'])): ?>
                                                        <div class="invalid-feedback">
                                                            <?= session()->getFlashdata('errors')['tgl_lhr_ibu'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="nm_pasangan">Nama Pasangan</label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0',
                                                    'id' => 'nm_pasangan',
                                                    'name' => 'nm_pasangan',
                                                    'placeholder' => 'Isikan Nama Pasangan ...',
                                                    'value' => $SQLKel->nm_pasangan ?? ''
                                                ]) ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="tgl_lhr_psg">Tgl Lahir</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text rounded-0"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <?= form_input([
                                                        'type' => 'text',
                                                        'class' => 'form-control datepicker rounded-0',
                                                        'id' => 'tgl_lhr_psg',
                                                        'name' => 'tgl_lhr_psg',
                                                        'placeholder' => 'Inputkan Tgl Lahir Pasangan ...',
                                                        'value' => $SQLKel->tgl_lhr_psg ?? ''
                                                    ]) ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="nm_anak">Nama Anak</label>
                                                <?= form_textarea([
                                                    'class' => 'form-control rounded-0',
                                                    'id' => 'nm_anak',
                                                    'name' => 'nm_anak',
                                                    'rows' => 4,
                                                    'placeholder' => '* Bisa dipisah menggunakan enter',
                                                    'value' => $SQLKel->nm_anak ?? ''
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-left">
                            <a href="<?= base_url('profile/' . $SQLKary->id) ?>" class="btn btn-secondary rounded-0"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary rounded-0 float-right"><i
                                    class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
    
    // Custom file input handling
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    
    // Show/hide pasangan fields based on status_kawin
    $('#status_kawin').change(function() {
        if($(this).val() == '1' || $(this).val() == '3') {
            $('#jns_pasangan').closest('.form-group').show();
            $('#nm_pasangan').closest('.form-group').show();
            $('#tgl_lhr_psg').closest('.form-group').show();
            $('#nm_anak').closest('.form-group').show();
        } else {
            $('#jns_pasangan').closest('.form-group').hide();
            $('#nm_pasangan').closest('.form-group').hide();
            $('#tgl_lhr_psg').closest('.form-group').hide();
            $('#nm_anak').closest('.form-group').hide();
        }
    });
    
    // Trigger change on page load
    $('#status_kawin').trigger('change');
});
</script>