<?php
/**
 * Employee Leave/Time-off View
 * 
 * This view displays and manages employee leave/time-off data.
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
                    <h1 class="m-0">Data Cuti</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('profile/' . $SQLKary->id) ?>">Profile</a>
                        </li>
                        <li class="breadcrumb-item active">Data Cuti</li>
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
                <div class="col-md-<?php echo (isset($SQLCuti) && !empty($SQLCuti->file_name)) ? '8' : '12' ?>">
                    <?= form_open_multipart('profile/sdm/data_cuti_simpan.php', ['method' => 'post', 'id' => 'form-cuti', 'class' => 'needs-validation']) ?>
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header rounded-0">
                            <h3 class="card-title">PENGAJUAN CUTI - <?= strtoupper($SQLKary->nama ?? '') ?></h3>
                        </div>
                        <div class="card-body rounded-0">
                            <?php if (isset($SQLKary->id)): ?>
                                <input type="hidden" name="id_karyawan" value="<?= $SQLKary->id ?? '' ?>">
                                <input type="hidden" name="id" value="<?= $SQLCuti->id ?? '' ?>">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan<span class="text-danger">*</span></label>
                                            <?= form_textarea([
                                                'class' => 'form-control rounded-0' . (isset(session()->getFlashdata('errors')['keterangan']) ? ' is-invalid' : ''),
                                                'id' => 'keterangan',
                                                'name' => 'keterangan',
                                                'placeholder' => 'Isikan Alasan Cuti ...',
                                                'value' => $SQLCuti->keterangan ?? old('keterangan'),
                                                'rows' => 5
                                            ]) ?>
                                            <?php if (isset(session()->getFlashdata('errors')['keterangan'])): ?>
                                                <div class="invalid-feedback rounded-0">
                                                    <?= session()->getFlashdata('errors')['keterangan'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal_rentang">Tanggal Cuti<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text rounded-0"><i
                                                            class="fas fa-calendar"></i></span>
                                                </div>
                                                <?= form_input([
                                                    'type' => 'text',
                                                    'class' => 'form-control rounded-0 daterange' . (isset(session()->getFlashdata('errors')['tanggal_rentang']) ? ' is-invalid' : ''),
                                                    'id' => 'tgl_cuti',
                                                    'name' => 'tgl_cuti',
                                                    'placeholder' => 'DD/MM/YYYY - DD/MM/YYYY',
                                                    'value' => (isset($SQLCuti) && !is_array($SQLCuti) && isset($SQLCuti->tgl_masuk) && isset($SQLCuti->tgl_keluar))
                                                        ? date('d/m/Y', strtotime($SQLCuti->tgl_masuk)) . ' - ' . date('d/m/Y', strtotime($SQLCuti->tgl_keluar))
                                                        : old('tanggal_rentang')
                                                ]) ?>
                                                <?php if (isset(session()->getFlashdata('errors')['tanggal_rentang'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['tanggal_rentang'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <input type="hidden" name="tgl_masuk" id="tgl_masuk"
                                                value="<?= $SQLCuti->tgl_masuk ?? old('tgl_masuk') ?>">
                                            <input type="hidden" name="tgl_keluar" id="tgl_keluar"
                                                value="<?= $SQLCuti->tgl_keluar ?? old('tgl_keluar') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="file_berkas">Unggah Berkas</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input rounded-0 <?= isset(session()->getFlashdata('errors')['file_berkas']) ? 'is-invalid' : '' ?>"
                                                    id="file_berkas" name="file_berkas">
                                                <label class="custom-file-label rounded-0" for="file_berkas">Choose
                                                    File</label>
                                                <?php if (isset(session()->getFlashdata('errors')['file_berkas'])): ?>
                                                    <div class="invalid-feedback rounded-0">
                                                        <?= session()->getFlashdata('errors')['file_berkas'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <small class="text-muted">* File yang diijinkan: jpg|png|pdf|jpeg</small><br>
                                            <small class="text-muted">* Bisa di unggah foto surat dokter, undangan,
                                                dll</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipe">Tipe Cuti<span class="text-danger">*</span></label>
                                            <select name="tipe" id="tipe"
                                                class="form-control rounded-0 <?= isset(session()->getFlashdata('errors')['tipe']) ? 'is-invalid' : '' ?>">
                                                <option value="">- Tipe -</option>
                                                <option value="1" <?= (isset($SQLCuti->tipe) && $SQLCuti->tipe == '1') || old('tipe') == '1' ? 'selected' : '' ?>>Cuti Tahunan</option>
                                                <option value="2" <?= (isset($SQLCuti->tipe) && $SQLCuti->tipe == '2') || old('tipe') == '2' ? 'selected' : '' ?>>Cuti Sakit</option>
                                                <option value="3" <?= (isset($SQLCuti->tipe) && $SQLCuti->tipe == '3') || old('tipe') == '3' ? 'selected' : '' ?>>Cuti Melahirkan</option>
                                                <option value="4" <?= (isset($SQLCuti->tipe) && $SQLCuti->tipe == '4') || old('tipe') == '4' ? 'selected' : '' ?>>Cuti Penting</option>
                                                <option value="5" <?= (isset($SQLCuti->tipe) && $SQLCuti->tipe == '5') || old('tipe') == '5' ? 'selected' : '' ?>>Izin</option>
                                            </select>
                                            <?php if (isset(session()->getFlashdata('errors')['tipe'])): ?>
                                                <div class="invalid-feedback rounded-0">
                                                    <?= session()->getFlashdata('errors')['tipe'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-left">
                            <a href="<?= base_url('profile') ?>" class="btn btn-secondary mr-2 rounded-0"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" form="form-cuti" class="btn btn-primary float-right rounded-0"><i
                                    class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>

                <?php if (isset($SQLCuti) && !empty($SQLCuti->file_name)): ?>
                    <div class="col-lg-4">
                        <div class="card card-primary card-outline rounded-0">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-paperclip"></i> Informasi Cuti & Lampiran</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    $cutiModel = new \App\Models\trSdmCuti();
                                    $isImage = $cutiModel->isImage($SQLCuti->file_ext, $SQLCuti->file_type);
                                    $file_url = $cutiModel->getFileUrl($SQLCuti->file_name);
                                    
                                    // Ensure the file URL is valid
                                    if (!empty($file_url)):
                                    ?>
                                        <?php if ($isImage): ?>
                                            <a href="<?= $file_url ?>" 
                                               data-toggle="lightbox" 
                                               data-title="<?= htmlspecialchars($SQLCuti->keterangan ?? 'Berkas Cuti') ?>"
                                               data-gallery="gallery">
                                                <img src="<?= $file_url ?>" 
                                                     alt="Berkas Cuti" 
                                                     class="img-thumbnail rounded-0"
                                                     style="max-height: 250px;">
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= $file_url ?>" 
                                               target="_blank" 
                                               class="btn btn-sm btn-info rounded-0">
                                                <i class="fas fa-file-<?= ($SQLCuti->file_ext == 'pdf') ? 'pdf' : 'alt' ?>"></i> Lihat Berkas
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline rounded-0">
                        <div class="card-header rounded-0">
                            <h3 class="card-title"><i class="fas fa-history"></i> Riwayat Pengajuan Cuti</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">Tgl Pengajuan</th>
                                            <th width="30%">Alasan Cuti</th>
                                            <th width="15%">Mulai Cuti</th>
                                            <th width="15%">Selesai Cuti</th>
                                            <th width="10%" class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($SQLCutiList) && !empty($SQLCutiList)): ?>
                                            <?php $no = 1;
                                            foreach ($SQLCutiList as $cuti): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= tgl_indo8($cuti->tgl_simpan) ?></td>
                                                    <td>
                                                        <?= $cuti->keterangan ?>
                                                        <?= br() . status_cuti($cuti->status) ?>
                                                        <?php if (!empty($cuti->file_name)): ?>
                                                            <br />
                                                            <?php
                                                            $cutiModel = new \App\Models\trSdmCuti();
                                                            $isImage = $cutiModel->isImage($cuti->file_ext, $cuti->file_type);
                                                            $fileUrl = $cutiModel->getFileUrl($cuti->file_name);
                                                            
                                                            // Ensure the file URL is valid
                                                            if (!empty($fileUrl)):
                                                            ?>
                                                                <?php if ($isImage): ?>
                                                                    <a href="<?= $fileUrl ?>" 
                                                                       data-toggle="lightbox" 
                                                                       data-title="<?= htmlspecialchars($cuti->keterangan ?? 'Berkas Cuti') ?>"
                                                                       class="btn btn-sm btn-info rounded-0 mb-1">
                                                                        <i class="fas fa-paperclip"></i> Lihat
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a href="<?= $fileUrl ?>" 
                                                                       target="_blank"
                                                                       class="btn btn-sm btn-info rounded-0 mb-1">
                                                                        <i class="fas fa-paperclip"></i> Lampiran
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= tgl_indo8($cuti->tgl_masuk) ?></td>
                                                    <td><?= tgl_indo8($cuti->tgl_keluar) ?></td>
                                                    <td class="text-center">
                                                        <?php if(!hakAdminM()) : ?>
                                                        <a href="<?= base_url('profile/sdm/data_cuti_hapus/' . ($cuti->id ?? '')) ?>"
                                                            class="btn btn-sm btn-danger rounded-0 mb-1"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan cuti ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <?php endif; ?>
                                                        <a href="<?= base_url('profile/sdm/data_cuti_edit/' . ($cuti->id ?? '')) ?>"
                                                            class="btn btn-sm btn-primary rounded-0 mb-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php elseif (isset($SQLCuti) && !empty($SQLCuti) && is_array($SQLCuti)): ?>
                                            <?php $no = 1;
                                            foreach ($SQLCuti as $cuti): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= tgl_indo8($cuti->tgl_simpan) ?></td>
                                                    <td>
                                                        <?= $cuti->keterangan ?>
                                                        <?= br() . status_cuti($cuti->status) ?>

                                                        <?php if (!empty($cuti->file_name)): ?>
                                                            <br />
                                                            <?php
                                                            $cutiModel = new \App\Models\trSdmCuti();
                                                            $isImage = $cutiModel->isImage($cuti->file_ext, $cuti->file_type);
                                                            $fileUrl = $cutiModel->getFileUrl($cuti->file_name);
                                                            
                                                            // Ensure the file URL is valid
                                                            if (!empty($fileUrl)):
                                                            ?>
                                                                <?php if ($isImage): ?>
                                                                    <a href="<?= $fileUrl ?>" 
                                                                       data-toggle="lightbox" 
                                                                       data-title="<?= htmlspecialchars($cuti->keterangan ?? 'Berkas Cuti') ?>"
                                                                       class="btn btn-sm btn-info rounded-0 mb-1">
                                                                        <i class="fas fa-paperclip"></i> Lihat
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a href="<?= $fileUrl ?>" 
                                                                       target="_blank"
                                                                       class="btn btn-sm btn-info rounded-0 mb-1">
                                                                        <i class="fas fa-paperclip"></i> Lampiran
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= tgl_indo8($cuti->tgl_masuk) ?></td>
                                                    <td><?= tgl_indo8($cuti->tgl_keluar) ?></td>
                                                    <td class="text-center">
                                                        <?php if ($cuti->status == 0): ?>
                                                            <?php if(!hakAdminM()) : ?>
                                                            <a href="<?= base_url('profile/sdm/data_cuti_hapus/' . ($cuti->id ?? '')) ?>"
                                                                class="btn btn-sm btn-danger rounded-0 mb-1"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan cuti ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <?php endif; ?>
                                                            <a href="<?= base_url('profile/sdm/data_cuti_edit/' . ($cuti->id ?? '')) ?>"
                                                                class="btn btn-sm btn-primary rounded-0 mb-1">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data cuti</td>
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
        // For new records, use default dates
        $('.daterange').daterangepicker({
            locale: {
                format: 'MM/DD/YYYY'
            }
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
        $(document).on('click', '[data-toggle="lightbox"]', function (e) {
            e.preventDefault();
            
            // Store the href for fallback
            var href = $(this).attr('href');
            
            try {
                // First try our custom safe initialization
                if (!safeInitLightbox(this)) {
                    // If that fails, try the standard initialization with a delay
                    setTimeout(function() {
                        try {
                            $(e.currentTarget).ekkoLightbox({
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