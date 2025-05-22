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
                                    <div class="form-group row<?php echo (!empty($psnGagal['fupload']) ? ' text-danger' : '') ?>" id="tp_berkas">
                                        <label for="label" class="col-sm-4 col-form-label">Unggah Berkas*</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="fupload" class="form-control-file<?php echo (!empty($psnGagal['fupload']) ? ' is-invalid' : '') ?>" accept=".jpg,.jpeg,.png,.pdf" required>
                                            <small class="form-text text-muted">* File yang diijinkan: jpg | png | pdf | jpeg (Maks. 5MB)</small>
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