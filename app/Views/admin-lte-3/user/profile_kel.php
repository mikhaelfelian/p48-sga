<div class="content-wrapper">
    <!-- Ekko Lightbox CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    
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
            border-radius: 0;
        }
        
        .custom-lightbox .modal-title {
            color: white;
            font-weight: bold;
        }
        
        .custom-lightbox .modal-footer {
            border-top: none;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 0;
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
                        <li class="breadcrumb-item"><a href="<?= base_url('profile/' . $SQLKary->id) ?>">Profile</a>
                        </li>
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
                    <?= form_open_multipart(base_url('profile/simpan_data_kel.php'), ['method' => 'post']) ?>
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Data Keluarga Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <?php if (isset($SQLKary->id)): ?>
                                <input type="hidden" name="id_karyawan" value="<?= $SQLKary->id ?? '' ?>">
                                <input type="hidden" name="id_user" value="<?= $SQLKary->id_user ?? '' ?>">
                                <input type="hidden" name="id" value="<?= $SQLKelRw->id ?? '' ?>">

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
                                                'value' => $SQLKelRw->nm_ayah ?? old('nm_ayah'),
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
                                                    <span class="input-group-text rounded-0"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control datepicker rounded-0' . (isset(session()->getFlashdata('errors')['tgl_lhr_ayah']) ? ' is-invalid' : ''),
                                                    'id' => 'tgl_lhr_ayah',
                                                    'name' => 'tgl_lhr_ayah',
                                                    'placeholder' => 'Inputkan Tgl Lahir Ayah ...',
                                                    'value' => $SQLKelRw->tgl_lhr_ayah ?? old('tgl_lhr_ayah')
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
                                                <option value="1" <?= (isset($SQLKelRw->status_kawin) && $SQLKelRw->status_kawin == '1') ? 'selected' : '' ?>>Menikah</option>
                                                <option value="2" <?= (isset($SQLKelRw->status_kawin) && $SQLKelRw->status_kawin == '2') ? 'selected' : '' ?>>Belum Menikah</option>
                                                <option value="3" <?= (isset($SQLKelRw->status_kawin) && $SQLKelRw->status_kawin == '3') ? 'selected' : '' ?>>Cerai</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="jns_pasangan">Pasangan</label>
                                            <select class="form-control rounded-0" id="jns_pasangan" name="jns_pasangan">
                                                <option value="">- Pilih -</option>
                                                <option value="1" <?= (isset($SQLKelRw->jns_pasangan) && $SQLKelRw->jns_pasangan == '1') ? 'selected' : '' ?>>Suami</option>
                                                <option value="2" <?= (isset($SQLKelRw->jns_pasangan) && $SQLKelRw->jns_pasangan == '2') ? 'selected' : '' ?>>Istri</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="file_kk">Unggah Berkas KK<span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input <?= isset(session()->getFlashdata('errors')['file_kk']) ? 'is-invalid' : '' ?>"
                                                    id="file_kk" name="file_kk">
                                                <label class="custom-file-label" for="file_kk">Choose File</label>
                                                <?php if (isset(session()->getFlashdata('errors')['file_kk'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['file_kk'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <small class="text-muted">* File yang diijinkan :
                                                jpg|png|pdf|jpeg|tif</small><br>
                                            <small class="text-muted">* Dokumen yg diunggah : KK</small>
                                            <?php if (isset($SQLKelRw->file_name) && !empty($SQLKelRw->file_name)): ?>
                                                <p class="mt-2">File saat ini: <?= $SQLKelRw->file_name ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="file_ktp">Unggah Berkas KTP<span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input <?= isset(session()->getFlashdata('errors')['file_ktp']) ? 'is-invalid' : '' ?>"
                                                    id="file_ktp" name="file_ktp">
                                                <label class="custom-file-label" for="file_ktp">Choose File</label>
                                                <?php if (isset(session()->getFlashdata('errors')['file_ktp'])): ?>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['file_ktp'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <small class="text-muted">* File yang diijinkan :
                                                jpg|png|pdf|jpeg|tif</small><br>
                                            <small class="text-muted">* Dokumen yg diunggah : KTP</small>
                                            <?php if (isset($SQLKelRw->file_ktp) && !empty($SQLKelRw->file_ktp)): ?>
                                                <p class="mt-2">File saat ini: <?= $SQLKelRw->file_ktp ?></p>
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
                                                'value' => $SQLKelRw->nm_ibu ?? old('nm_ibu'),
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
                                                    <span class="input-group-text rounded-0"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control datepicker rounded-0' . (isset(session()->getFlashdata('errors')['tgl_lhr_ibu']) ? ' is-invalid' : ''),
                                                    'id' => 'tgl_lhr_ibu',
                                                    'name' => 'tgl_lhr_ibu',
                                                    'placeholder' => 'Inputkan Tgl Lahir Ibu ...',
                                                    'value' => $SQLKelRw->tgl_lhr_ibu ?? old('tgl_lhr_ibu')
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
                                                'value' => $SQLKelRw->nm_pasangan ?? ''
                                            ]) ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_lhr_psg">Tgl Lahir</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text rounded-0"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control datepicker rounded-0',
                                                    'id' => 'tgl_lhr_psg',
                                                    'name' => 'tgl_lhr_psg',
                                                    'placeholder' => 'Inputkan Tgl Lahir Pasangan ...',
                                                    'value' => $SQLKelRw->tgl_lhr_psg ?? ''
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
                                                'value' => $SQLKelRw->nm_anak ?? ''
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-left">
                            <a href="<?= base_url('profile/' . $SQLKary->id) ?>" class="btn btn-secondary rounded-0"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary rounded-0 float-right"><i
                                    class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-users"></i> Data Keluarga</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Karyawan</th>
                                        <th>KTP</th>
                                        <th>KK</th>
                                        <th width="10%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($SQLKel)): ?>
                                        <?php $no = 1; foreach ($SQLKel as $row): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>
                                                    <?php echo $row->nama.br(); ?>
                                                    <strong>Ayah:</strong> <?= $row->nm_ayah ?><br>
                                                    <strong>Ibu:</strong> <?= $row->nm_ibu ?><br>
                                                    <?php if (!empty($row->nm_pasangan)): ?>
                                                        <strong>Pasangan:</strong> <?= $row->nm_pasangan ?> 
                                                        (<?= ($row->jns_pasangan == '1') ? 'Suami' : (($row->jns_pasangan == '2') ? 'Istri' : '-') ?>)<br>
                                                    <?php endif; ?>
                                                    <?php if (!empty($row->nm_anak)): ?>
                                                        <strong>Anak:</strong> <?= nl2br($row->nm_anak) ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($row->file_name_ktp)): ?>
                                                        <?php 
                                                        $file_path = $row->file_name_ktp;
                                                        $file_ext = strtolower($row->file_ext_ktp ?? pathinfo($row->file_name_ktp, PATHINFO_EXTENSION));
                                                        $is_image = in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif']);
                                                        ?>
                                                        <a href="<?= base_url($file_path) ?>" 
                                                           data-toggle="lightbox" 
                                                           data-title="KTP - <?= $row->nm_ayah ?>"
                                                           data-gallery="ktp-gallery"
                                                           <?php if (!$is_image): ?>
                                                           data-type="iframe"
                                                           <?php endif; ?>
                                                           class="btn btn-sm btn-info rounded-0">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary rounded-0">Tidak ada</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($row->file_name)): ?>
                                                        <?php 
                                                        $file_path = $row->file_name;
                                                        $file_ext = strtolower($row->file_ext ?? pathinfo($row->file_name, PATHINFO_EXTENSION));
                                                        $is_image = in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif']);
                                                        ?>
                                                        <a href="<?= base_url($file_path) ?>" 
                                                           data-toggle="lightbox" 
                                                           data-title="Kartu Keluarga - <?= $row->nm_ayah ?>"
                                                           data-gallery="kk-gallery"
                                                           <?php if (!$is_image): ?>
                                                           data-type="iframe"
                                                           <?php endif; ?>
                                                           class="btn btn-sm btn-info rounded-0">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary rounded-0">Tidak ada</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('profile/sdm/data_keluarga_edit/'.$row->id) ?>" class="btn btn-sm btn-warning rounded-0">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url('profile/sdm/data_keluarga_hapus/'.$row->id) ?>" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Data tidak tersedia</td>
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

<script>
    $(document).ready(function () {
        // Initialize datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        // Custom file input handling
        $('.custom-file-input').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Show/hide pasangan fields based on status_kawin
        $('#status_kawin').change(function () {
            if ($(this).val() == '1' || $(this).val() == '3') {
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

        // Initialize Ekko Lightbox
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true,
                showArrows: false,
                wrapping: false,
                loadingMessage: '',
                onContentLoaded: function() {
                    // Adjust iframe height for PDF files
                    var $iframe = $('.ekko-lightbox-container iframe');
                    if ($iframe.length > 0) {
                        $iframe.css('height', '80vh');
                    }
                    
                    // Remove any loading elements
                    $('.ekko-lightbox-loader, .modal-loading').remove();
                },
                onShow: function() {
                    // Add custom class for styling
                    $('.ekko-lightbox').addClass('custom-lightbox');
                    
                    // Fix accessibility issues
                    setTimeout(function() {
                        // Remove aria-hidden from the modal
                        $('.ekko-lightbox').removeAttr('aria-hidden');
                        
                        // Set proper focus management
                        $('.ekko-lightbox').attr({
                            'role': 'dialog',
                            'aria-modal': 'true',
                            'aria-labelledby': 'lightbox-title',
                            'tabindex': '0'  // Make the modal focusable
                        });
                        
                        // Add ID to the title for aria-labelledby reference
                        $('.modal-title').attr('id', 'lightbox-title');
                        
                        // Make sure close button is accessible
                        $('.ekko-lightbox button.close').attr({
                            'aria-label': 'Close',
                            'tabindex': '0'
                        });
                        
                        // Set focus to the modal
                        $('.ekko-lightbox').focus();
                        
                        // Add keyboard navigation for the lightbox
                        $('.ekko-lightbox').on('keydown', function(e) {
                            // ESC key closes the lightbox
                            if (e.keyCode === 27) {
                                $('.ekko-lightbox button.close').click();
                            }
                            
                            // TAB key should be trapped within the modal
                            if (e.keyCode === 9) {
                                // Find all focusable elements
                                var focusableElements = $('.ekko-lightbox').find('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                                var firstElement = focusableElements.first();
                                var lastElement = focusableElements.last();
                                
                                // If shift+tab and focus is on first element, move to last
                                if (e.shiftKey && document.activeElement === firstElement[0]) {
                                    e.preventDefault();
                                    lastElement.focus();
                                }
                                // If tab and focus is on last element, move to first
                                else if (!e.shiftKey && document.activeElement === lastElement[0]) {
                                    e.preventDefault();
                                    firstElement.focus();
                                }
                            }
                        });
                    }, 300);
                }
            });
        });
    });
</script>