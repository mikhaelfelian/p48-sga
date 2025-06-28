<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Penjualan</li>
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
                <div class="col-lg-8">
                    <!-- Form Item box -->
                    <?php echo form_open_multipart(base_url('transaksi/cart_upload.php'), 'autocomplete="off" method="post" enctype="multipart/form-data"') ?>
                    <?php echo form_hidden('id_penjualan', (!empty($SQLPenj) ? $SQLPenj->id : '')) ?>
                    <?php echo form_hidden('status', $request->getVar('status')) ?>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">UNGGAH BERKAS</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row<?php echo (!empty($psnGagal['judul']) ? ' text-danger' : '') ?>">
                                        <label for="label" class="col-sm-4 col-form-label">Nama Berkas*</label>
                                        <div class="col-sm-8">
                                            <?php echo form_input(['id' => 'judul', 'name' => 'judul', 'class' => 'form-control rounded-0' . (!empty($psnGagal['judul']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Judul Berkas ...']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group row<?php echo (!empty($psnGagal['keterangan']) ? ' text-danger' : '') ?>">
                                        <label for="label" class="col-sm-4 col-form-label">Keterangan</label>
                                        <div class="col-sm-8">
                                            <?php echo form_textarea(['id' => 'ket', 'name' => 'ket', 'class' => 'form-control rounded-0', 'style' => 'height: 183px;', 'placeholder' => 'Isikan Keterangan ...']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group row<?php echo (!empty($psnGagal['tipe']) ? ' text-danger' : '') ?>" id="tp_berkas">
                                        <label for="label" class="col-sm-4 col-form-label">Tipe*</label>
                                        <div class="col-sm-8">
                                            <select name="tipe" class="form-control rounded-0<?php echo (!empty($psnGagal['tipe']) ? ' is-invalid' : ''); ?>">
                                                <option value="">- Pilih -</option>
                                                <?php foreach ($SQLTipeFile as $tipe) { ?>
                                                    <option value="<?php echo $tipe->id ?>"><?php echo $tipe->tipe ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row<?php echo (!empty($psnGagal['fupload']) ? ' text-danger' : '') ?>" id="tp_berkas">
                                        <label for="label" class="col-sm-4 col-form-label">Unggah Berkas*</label>
                                        <div class="col-sm-8">
                                            <div class="dropzone" id="myDropzone"></div>
                                            <small class="form-text text-muted">* File yang diijinkan: jpg | png | pdf | jpeg (Maks. 5MB)</small>
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group row<?php echo (!empty($psnGagal['fupload']) ? ' text-danger' : '') ?>" id="tp_berkas">
                                        <label for="label" class="col-sm-4 col-form-label">Unggah Berkas*</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="fupload" class="form-control-file<?php echo (!empty($psnGagal['fupload']) ? ' is-invalid' : '') ?>" accept=".jpg,.jpeg,.png,.pdf" required>
                                            <small class="form-text text-muted">* File yang diijinkan: jpg | png | pdf | jpeg (Maks. 5MB)</small>
                                        </div>
                                    </div> -->
                                    <div class="form-group row" id="tp_berkas">
                                        <label for="fileInput" class="col-sm-4 col-form-label">Unggah Berkas*</label>
                                        <div class="col-sm-8">
                                            <div class="drop-zone" id="dropZone" role="button" tabindex="0">
                                                <div class="drop-zone__prompt">
                                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                                    <span>Seret dan lepas file di sini atau klik untuk mengunggah</span>
                                                </div>
                                                <input type="file" name="fupload" id="fileInput"
                                                    class="drop-zone__input" accept=".jpg,.png,.pdf,.jpeg,.jfif"
                                                    style="display: none;">
                                                <div class="drop-zone__thumb" id="dropZoneThumb" style="display: none;">
                                                    <div class="drop-zone__thumb-close" title="Hapus file">&times;</div>
                                                    <div class="drop-zone__thumb-info"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="uploaded_file" id="uploaded_file_name">
                                            <div class="upload-status mt-2" style="display: none;">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%">
                                                    </div>
                                                </div>
                                                <!-- <small class="text-muted upload-message"></small> -->
                                            </div>
                                            <small class="text-muted">* File yang diijinkan: jpg|png|pdf|jpeg|jfif
                                                (Maks. 5MB)</small>
                                        </div>
                                    </div>

                                </div>
                            </div>  
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <?php echo form_close() ?>

                    <!-- Item box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DATA BERKAS UNGGAH</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">No</th>
                                        <th class="text-left">Juduk</th>
                                        <th class="text-center">Berkas</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <?php if (!empty($SQLPenjFile)) { ?>
                                        <?php $no = 1;
                                        $subt = 0; ?>
                                        <?php foreach ($SQLPenjFile as $det) { ?>
                                            <?php
                                            $is_image = substr($det->file_type, 0, 5);
                                            $detname = base_url($det->file_name);
                                            ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php if (isset($_GET['status'])) { ?>
                                                        <?php if(!hakAdminM()) : ?>
                                                        <a href="<?php echo base_url('transaksi/cart_hapus_file.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_item=' . $det->id) ?>" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Hapus [<?php echo $det->file_name; ?>] ?')"><i class="fa fa-trash"></i></a>
                                                        <?php endif; ?>
                                                        <?php } ?>
                                                </td>
                                                <td class="text-center"><?php echo $no; ?></td>
                                                <td class="text-left">
                                                    <small><?php echo tgl_indo5($det->tgl_simpan); ?></small><br/>
        <?php echo $det->judul; ?><br/>
                                                    <small><i><?php echo $det->keterangan; ?></i></small>
                                                </td>
                                                <td class="text-center text-middle">
        <?php if ($is_image == 'image') { ?>
                                                        <a href="<?php echo $detname ?>" data-toggle="lightbox" data-title="<?php echo strtolower($det->judul) ?>">
                                                            <i class="fas fa-paperclip"></i> <?php echo $det->judul ?>
                                                        </a>
        <?php } else { ?>
                                                        <a href="<?php echo $detname ?>" target="_blank">
                                                            <i class="fas fa-paperclip"></i> <?php echo $det->judul ?>
                                                        </a>
        <?php } ?>
                                                </td>
                                            </tr>  
                                            <?php $no++; ?>
                                        <?php } ?>
<?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6 text-right">

                                </div>
                            </div>                            
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-4">
<?php echo view($konten_kanan) ?>                    
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- Ekko Lightbox -->
<script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>
<!-- Dropzone JS -->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<style>
    .drop-zone {
        max-width: 100%;
        height: 200px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-weight: 500;
        font-size: 1.2rem;
        cursor: pointer;
        color: #777;
        border: 2px dashed #009578;
        border-radius: 10px;
        position: relative;
        transition: all 0.3s ease;
    }

    .drop-zone--over {
        border-style: solid;
        background-color: rgba(0, 149, 120, 0.1);
    }

    .drop-zone__thumb {
        width: 100%;
        height: 100%;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .drop-zone__thumb-close {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        text-align: center;
        line-height: 24px;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
    }

    .drop-zone__thumb-close:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: scale(1.1);
    }

    .drop-zone__thumb-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px;
        font-size: 12px;
        word-break: break-all;
    }

    .file-preview-container {
        padding: 20px;
        border-radius: 8px;
    }

    .drop-zone__prompt {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .drop-zone__prompt i {
        transition: transform 0.3s ease;
    }

    .drop-zone:hover .drop-zone__prompt i {
        transform: translateY(-5px);
    }

    .progress {
        height: 20px;
        margin-bottom: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
        overflow: hidden;
    }

    .progress-bar {
        background-color: #28a745;
        color: white;
        text-align: center;
        line-height: 20px;
        transition: width .6s ease;
    }

    .upload-message {
        margin-top: 5px;
        display: block;
    }

    .file-details {
        padding: 8px;
        background-color: #f8f9fa;
        border-radius: 4px;
        margin-top: 8px;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-10px);
        }

        75% {
            transform: translateX(10px);
        }
    }

    .drop-zone--error {
        border-color: #dc3545 !important;
        animation: shake 0.5s;
    }
</style>
<!-- Page script -->
<script type="text/javascript">
    $(function () {
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
                                alwaysShowClose: true
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
        // Initialize Dropzone
        // Dropzone.autoDiscover = false;
        // var myDropzone = new Dropzone("#myDropzone", {
        //     url: "<?php echo base_url('transaksi/penjualan/upload_file') ?>",
        //     paramName: "fupload",
        //     maxFilesize: 5, // MB
        //     acceptedFiles: ".jpg,.jpeg,.png,.pdf",
        //     addRemoveLinks: true,
        //     dictDefaultMessage: "Seret dan lepas file di sini atau klik untuk mengunggah",
        //     dictRemoveFile: "Hapus file",
        //     dictFileTooBig: "File terlalu besar ({{filesize}}MB). Maksimal ukuran file: {{maxFilesize}}MB.",
        //     dictInvalidFileType: "Tipe file tidak diizinkan. Hanya jpg, jpeg, png, dan pdf yang diizinkan.",
        //     init: function() {
        //         this.on("success", function(file, response) {
        //             if (response.success) {
        //                 toastr.success(response.message);
        //             } else {
        //                 toastr.error(response.message);
        //                 this.removeFile(file);
        //             }
        //         });
        //         this.on("error", function(file, message) {
        //             toastr.error(message);
        //             this.removeFile(file);
        //         });
        //     }
        // });
        <?php echo session()->getFlashdata('transaksi_toast'); ?>
    });
</script>

<script>
    $(document).ready(function () {
        const dropZone = $('#dropZone');
        const fileInput = $('#fileInput');
        let selectedFile = null;
        let isHandlingClick = false;

        // Click handler for drop zone
        dropZone.on('click', function (e) {
            if ($(e.target).hasClass('drop-zone__thumb-close') || isHandlingClick) {
                return;
            }

            isHandlingClick = true;
            fileInput.trigger('click');
            setTimeout(() => {
                isHandlingClick = false;
            }, 100);
        });

        // File input change handler
        fileInput.on('change', function (e) {
            if (this.files.length) {
                handleFiles(this.files);
            }
        });

        // Drag and drop handlers
        dropZone.on('dragover', function (e) {
            e.preventDefault();
            dropZone.addClass('drop-zone--over');
        });

        dropZone.on('dragleave dragend', function (e) {
            dropZone.removeClass('drop-zone--over');
        });

        dropZone.on('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();

            dropZone.removeClass('drop-zone--over');

            const files = e.originalEvent.dataTransfer.files;
            if (files.length) {
                handleFiles(files);
            }
        });

        // Close button handler
        $('.drop-zone__thumb-close').on('click', function (e) {
            e.stopPropagation();
            clearFile();
        });

        // Update form submission handler
        $('form').on('submit', function (e) {
            e.preventDefault();

            // Check if file is selected either through input or drag & drop
            const fileInput = $('#fileInput')[0];
            if (!fileInput.files.length && !selectedFile) {
                $('#dropZone').addClass('drop-zone--error');
                toastr.error('Pilih file terlebih dahulu!');
                setTimeout(() => {
                    $('#dropZone').removeClass('drop-zone--error');
                }, 2000);
                return false;
            }

            // Validate other form fields
            if (!validateForm()) {
                return false;
            }

            // If all validations pass, proceed with upload
            uploadFileWithForm();
            return false;
        });
    });

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];

            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'application/pdf', 'image/jfif'];
            if (!validTypes.includes(file.type)) {
                showError('Tipe file tidak diizinkan. Gunakan format: jpg, png, pdf, jpeg, atau jfif');
                selectedFile = null;
                clearFile();
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                showError('Ukuran file terlalu besar. Maksimal 5MB');
                selectedFile = null;
                clearFile();
                return;
            }

            // Store the file and update UI
            selectedFile = file;
            $('#dropZone').removeClass('drop-zone--error');
            updateThumbnail(file);
            showFileDetails(file);
        }
    }

    function updateThumbnail(file) {
        const thumbElement = $('#dropZoneThumb');
        const promptElement = $('.drop-zone__prompt');

        thumbElement.show();
        promptElement.hide();

        // Clear previous content
        thumbElement.empty().append('<div class="drop-zone__thumb-close" title="Hapus file">&times;</div>');

        if (file.type.startsWith('image/')) {
            // For images
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbElement.css({
                    'background-image': `url('${reader.result}')`,
                    'background-size': 'cover',
                    'background-position': 'center'
                });
            };
        } else {
            // For PDFs - use Font Awesome icon
            const iconContainer = $('<div>', {
                class: 'file-preview-container',
                css: {
                    'width': '100%',
                    'height': '100%',
                    'display': 'flex',
                    'align-items': 'center',
                    'justify-content': 'center',
                    'flex-direction': 'column',
                    'background-color': '#f8f9fa'
                }
            });

            const icon = $('<i>', {
                class: 'fas fa-file-pdf fa-3x text-danger mb-2'
            });

            const fileName = $('<div>', {
                class: 'text-muted small',
                text: file.name,
                css: {
                    'max-width': '90%',
                    'overflow': 'hidden',
                    'text-overflow': 'ellipsis',
                    'white-space': 'nowrap'
                }
            });

            iconContainer.append(icon, fileName);
            thumbElement.append(iconContainer);
            thumbElement.css('background-image', 'none');
        }

        // Add file info at bottom
        const thumbInfo = $('<div>', {
            class: 'drop-zone__thumb-info',
            text: `${file.name} (${formatFileSize(file.size)})`
        });
        thumbElement.append(thumbInfo);
    }

    function showFileDetails(file) {
        const uploadStatus = $('.upload-status');
        const uploadMessage = $('.upload-message');

        uploadStatus.show();
        uploadMessage.removeClass('text-danger text-success')
            .addClass('text-info')
            .html(`
            <div class="file-details">
                <strong>File:</strong> ${file.name}<br>
                <strong>Ukuran:</strong> ${formatFileSize(file.size)}<br>
                <strong>Tipe:</strong> ${file.type}
            </div>
        `);
    }

    function showError(message) {
        const uploadStatus = $('.upload-status');
        const uploadMessage = $('.upload-message');

        uploadStatus.show();
        uploadMessage.removeClass('text-success text-info')
            .addClass('text-danger')
            .text(message);

        toastr.error(message);
    }

    function clearFile() {
        $('#fileInput').val('');
        selectedFile = null;
        const thumbElement = $('#dropZoneThumb');
        thumbElement.hide().css('background-image', 'none').empty();
        $('.drop-zone__prompt').show();
        $('.upload-status').hide();
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>

<!-- Add form validation function -->
<script>
    function validateForm() {
        let isValid = true;

        // Only check required fields
        $('input[required], select[required], textarea[required]').each(function () {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
                toastr.error(`Field ${$(this).attr('name')} harus diisi`);
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        return isValid;
    }

    function uploadFileWithForm() {
        const formData = new FormData($('form')[0]);
        formData.set('fupload', selectedFile);

        const progressBar = $('.progress-bar');
        const uploadMessage = $('.upload-message');
        const submitBtn = $('button[type="submit"]');

        submitBtn.prop('disabled', true);

        $('.upload-status').show();
        progressBar.css('width', '0%');
        uploadMessage.removeClass('text-danger text-success')
            .addClass('text-info')
            .text('Mengunggah...');

        $.ajax({
            url: $('form').attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                const xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        const percent = Math.round((e.loaded / e.total) * 100);
                        progressBar.css('width', percent + '%');
                        progressBar.text(percent + '%');
                    }
                });
                return xhr;
            },
            success: function (response) {
                submitBtn.prop('disabled', false);
                try {
                    // Show success message
                    toastr.success('Data berhasil disimpan!');

                    // Clear form
                    clearForm();

                    // Reload just the data table div
                    $('#dataBerkasTable').load(window.location.href + ' #dataBerkasTable > *', function () {
                        // Reinitialize lightbox after content load
                        $('[data-toggle="lightbox"]').off('click').on('click', function (e) {
                            e.preventDefault();
                            $(this).ekkoLightbox({
                                alwaysShowClose: true
                            });
                        });
                    });
                } catch (e) {
                    console.error('Error processing response:', e);
                    showError('Terjadi kesalahan saat memproses response server');
                }
            },
            error: function (xhr, status, error) {
                submitBtn.prop('disabled', false);
                console.error('Upload error:', error);
                showError('Gagal mengunggah file: ' + error);
            }
        });
    }

    function clearForm() {
        clearFile();
        $('input[name="judul"]').val('');
        $('textarea[name="ket"]').val('');
        $('.is-invalid').removeClass('is-invalid');
        $('.drop-zone--error').removeClass('drop-zone--error');
    }
</script>