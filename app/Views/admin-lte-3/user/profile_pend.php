<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pendidikan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard.php') ?>">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('profile/' . $SQLKary->id) ?>">Profile</a></li>
                        <li class="breadcrumb-item active">Data Pendidikan</li>
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
                    <?= form_open_multipart(base_url('profile/sdm/data_pendidikan_simpan.php'), ['method' => 'post']) ?>
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">BERKAS PENDIDIKAN - <?= strtoupper($SQLKary->nama ?? '') ?></h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($SQLKary->id)): ?>
                                <input type="hidden" name="id_karyawan" value="<?= $SQLKary->id ?? '' ?>">
                                    <input type="hidden" name="id" value="<?= $SQLPend->id ?? '' ?>">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pendidikan">Pendidikan <span
                                                        class="text-danger">*</span></label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['pendidikan']) ? ' is-invalid' : ''),
                                                    'id' => 'pendidikan',
                                                    'name' => 'pendidikan',
                                                    'placeholder' => 'Isikan S1/D3/D1/SMK - Sederajat ...',
                                                    'value' => $SQLPend->pendidikan ?? old('pendidikan'),
                                                    'required' => true
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['pendidikan'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['pendidikan'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="jurusan">Jurusan <span class="text-danger">*</span></label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['jurusan']) ? ' is-invalid' : ''),
                                                    'id' => 'jurusan',
                                                    'name' => 'jurusan',
                                                    'placeholder' => 'Isikan Jurusan yang di tempuh ...',
                                                    'value' => $SQLPend->jurusan ?? old('jurusan'),
                                                    'required' => true
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['jurusan'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['jurusan'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="instansi">Instansi <span class="text-danger">*</span></label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['instansi']) ? ' is-invalid' : ''),
                                                    'id' => 'instansi',
                                                    'name' => 'instansi',
                                                    'placeholder' => 'Isikan Institusi Pendidikan ...',
                                                    'value' => $SQLPend->instansi ?? old('instansi'),
                                                    'required' => true
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['instansi'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['instansi'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <?= form_textarea([
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['keterangan']) ? ' is-invalid' : ''),
                                                    'id' => 'keterangan',
                                                    'name' => 'keterangan',
                                                    'placeholder' => 'Isikan Keterangan ...',
                                                    'value' => $SQLPend->keterangan ?? old('keterangan'),
                                                    'rows' => 4
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['keterangan'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['keterangan'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_dok">No. Dokumen <span class="text-danger">*</span></label>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['no_dok']) ? ' is-invalid' : ''),
                                                    'id' => 'no_dok',
                                                    'name' => 'no_dok',
                                                    'placeholder' => 'Isikan No. Dokumen (ijazah/ijin) ...',
                                                    'value' => $SQLPend->no_dok ?? old('no_dok'),
                                                    'required' => true
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['no_dok'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['no_dok'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="thn_masuk">Tahun Masuk <span
                                                        class="text-danger">*</span></label>
                                                <?= form_input([
                                                    'type' => 'number',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['thn_masuk']) ? ' is-invalid' : ''),
                                                    'id' => 'thn_masuk',
                                                    'name' => 'thn_masuk',
                                                    'placeholder' => 'Isikan Tahun',
                                                    'value' => $SQLPend->thn_masuk ?? old('thn_masuk'),
                                                    'min' => '1900',
                                                    'max' => date('Y'),
                                                    'step' => '1',
                                                    'required' => true
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['thn_masuk'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['thn_masuk'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="thn_keluar">Tahun Lulus</label>
                                                <?= form_input([
                                                    'type' => 'number',
                                                    'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['thn_keluar']) ? ' is-invalid' : ''),
                                                    'id' => 'thn_keluar',
                                                    'name' => 'thn_keluar',
                                                    'placeholder' => 'Isikan Tahun',
                                                    'min' => '1900',
                                                    'max' => date('Y') + 10,
                                                    'step' => '1',
                                                    'value' => $SQLPend->thn_keluar ?? old('thn_keluar')
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['thn_keluar'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['thn_keluar'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Status Lulus</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status_lulus"
                                                        id="status_lulus_0" value="0" <?= (isset($SQLPend->status_lulus) && $SQLPend->status_lulus == '0') || old('status_lulus') == '0' || empty($SQLPend->status_lulus) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="status_lulus_0">
                                                        Belum
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status_lulus"
                                                        id="status_lulus_1" value="1" <?= (isset($SQLPend->status_lulus) && $SQLPend->status_lulus == '1') || old('status_lulus') == '1' ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="status_lulus_1">
                                                        Sudah
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="file_berkas">Unggah Berkas <span
                                                        class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input <?= isset(session()->getFlashdata('errors')['file_berkas']) ? 'is-invalid' : '' ?>"
                                                        id="file_berkas" name="file_berkas">
                                                    <label class="custom-file-label" for="file_berkas">Choose File</label>
                                                    <?php if (isset(session()->getFlashdata('errors')['file_berkas'])): ?>
                                                        <div class="invalid-feedback">
                                                            <?= session()->getFlashdata('errors')['file_berkas'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <small class="text-muted">* File yang diijinkan:
                                                    jpg|png|pdf|jpeg|tif</small>
                                                <?php if (isset($SQLPend->file_name) && !empty($SQLPend->file_name)): ?>
                                                    <p class="mt-2">File saat ini: <?= $SQLPend->file_name ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-left">
                            <a href="<?= base_url('profile') ?>"
                                class="btn btn-secondary mr-2 rounded-0"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary float-right rounded-0"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <?= form_close() ?>

                    <!-- Data Table -->
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-graduation-cap mr-2"></i>Daftar Riwayat Pendidikan</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Pendidikan</th>
                                            <th>Jurusan</th>
                                            <th>Instansi</th>
                                            <th>Tahun</th>
                                            <th>Status</th>
                                            <th>Dokumen</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($SQLPendList) && count($SQLPendList) > 0): ?>
                                            <?php $no = 1;
                                            foreach ($SQLPendList as $row): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row->pendidikan ?></td>
                                                    <td>
                                                        <?= $row->jurusan ?>
                                                            <?= $row->keterangan ?>
                                                            <?php if(isset($row->no_dok) && !empty($row->no_dok)): ?>
                                                                <?=br(); ?>
                                                                <small class="text-muted"><b>No. Dok :</b> <?= $row->no_dok ?></small>
                                                            <?php endif; ?>
                                                    </td>
                                                    <td><?= $row->instansi ?></td>
                                                    <td><?= $row->thn_masuk ?> - <?= $row->thn_keluar ?? 'Sekarang' ?></td>
                                                    <td>
                                                        <?php if ($row->status_lulus == '1'): ?>
                                                            <span class="badge badge-success">Lulus</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-warning">Belum Lulus</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($row->file_name)): ?>
                                                            <?php 
                                                            // Use the trSdmCuti model for file handling
                                                            $fileModel = new \App\Models\trSdmCuti();
                                                            $isImage = $fileModel->isImage($row->file_ext, $row->file_type);
                                                            $file_url = $fileModel->getFileUrl($row->file_name);
                                                            
                                                            if (!empty($file_url)):
                                                                if (!$isImage): ?>
                                                                    <a href="<?= $file_url ?>"
                                                                       target="_blank"
                                                                       class="btn btn-sm btn-info">
                                                                        <i class="fas fa-file-<?= ($row->file_ext == 'pdf') ? 'pdf' : 'alt' ?>"></i> Lihat Dokumen
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a href="<?= $file_url ?>"
                                                                       data-toggle="lightbox"
                                                                       data-title="Dokumen Pendidikan - <?= htmlspecialchars($row->pendidikan ?? '') ?>"
                                                                       data-gallery="pendidikan-gallery" 
                                                                       class="btn btn-sm btn-info">
                                                                        <i class="fas fa-eye"></i> Lihat
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="badge badge-secondary">Tidak ada</span>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary">Tidak ada</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('profile/sdm/data_pendidikan_edit/' . $row->id) ?>"
                                                            class="btn btn-sm btn-warning rounded-0">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <?php if(!hakAdminM()) : ?>
                                                        <a href="<?= base_url('profile/sdm/data_pendidikan_hapus/' . $row->id) ?>"
                                                            class="btn btn-sm btn-danger rounded-0"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Data tidak tersedia</td>
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
        // Initialize year picker
        $('.year-picker').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });

        // Custom file input handling
        $('.custom-file-input').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Custom Ekko Lightbox initialization function to address the 'Cannot read properties of null (reading 'on')' error
        function safeInitLightbox(element) {
            var href = $(element).attr('href');
            
            // Verify href is valid
            if (!href || href === '#' || href === 'javascript:void(0)') {
                console.warn('Invalid lightbox target:', href);
                return false;
            }
            
            try {
                // Use the jQuery plugin method instead of direct constructor
                $(element).ekkoLightbox({
                    alwaysShowClose: true,
                    showArrows: false,
                    wrapping: false,
                    onShow: function() {
                        console.log('Lightbox shown successfully');
                    },
                    onHidden: function() {
                        console.log('Lightbox hidden successfully');
                    }
                });
                return true;
            } catch (error) {
                console.error('Error initializing lightbox:', error);
                return false;
            }
        }

        // Initialize Ekko Lightbox with enhanced error handling
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            
            // Store the href for fallback
            var href = $(this).attr('href');
            
            try {
                // First try our custom safe initialization
                if (!safeInitLightbox(this)) {
                    // If that fails, try the standard initialization with a delay
                    setTimeout(function() {
                        try {
                            $(event.currentTarget).ekkoLightbox({
                                alwaysShowClose: true,
                                showArrows: false,
                                wrapping: false
                            });
                        } catch (innerError) {
                            console.error('Lightbox initialization error:', innerError);
                            window.open(href, '_blank');
                        }
                    }, 50);
                }
            } catch (error) {
                console.error('Lightbox error:', error);
                // Fallback: open in new tab if lightbox fails
                window.open(href, '_blank');
            }
        });
    });
</script>

<!-- Custom Lightbox Styles -->
<style>
    .custom-lightbox .modal-content {
        background-color: transparent;
        border: none;
        box-shadow: none;
    }

    .custom-lightbox .modal-header {
        border-bottom: none;
        padding: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 5px 5px 0 0;
    }

    .custom-lightbox .modal-title {
        color: white;
        font-weight: bold;
    }

    .custom-lightbox .modal-footer {
        border-top: none;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 0 0 5px 5px;
    }

    .custom-lightbox .ekko-lightbox-nav-overlay a {
        color: white;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    }

    .custom-lightbox .ekko-lightbox-container iframe {
        width: 100%;
        border: none;
        background-color: white;
    }

    .ekko-lightbox-container {
        position: relative;
        max-height: 80vh;
        overflow: auto;
    }

    .ekko-lightbox-nav-overlay {
        z-index: 100;
    }

    .ekko-lightbox .close {
        color: white;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        opacity: 0.8;
    }

    .ekko-lightbox .close:hover {
        opacity: 1;
    }

    /* Hide loading indicators */
    .ekko-lightbox .modal-loading {
        display: none !important;
    }

    .ekko-lightbox-loader {
        display: none !important;
    }

    /* Accessibility improvements */
    .ekko-lightbox:focus {
        outline: none;
    }

    .ekko-lightbox .modal-dialog {
        outline: none;
    }

    .ekko-lightbox button.close:focus {
        outline: 2px solid #007bff;
        opacity: 1;
    }

    /* Make the modal focusable */
    .ekko-lightbox[tabindex="-1"]:focus {
        outline: none;
    }

    /* Ensure proper focus visibility for keyboard users */
    .btn:focus,
    a:focus {
        outline: 2px solid #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>