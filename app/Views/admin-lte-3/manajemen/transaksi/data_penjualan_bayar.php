<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Pembayaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Form Pembayaran</li>
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
                    <!-- CARD ITEM -->
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $SQLPenj->p_nama; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>DATA ITEM</h5>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="bg-yellow">
                                                        <th class="text-left" colspan="2">Item</th>
                                                        <th class="text-center">Jml</th>
                                                        <th class="text-right">Harga</th>
                                                        <th class="text-right">Subtotal</th>
                                                    </tr>                                    
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; $sub = 0; $gtotal = 0; ?>
                                                    <?php foreach ($SQLPenjDet as $det) { ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $no . '.'; ?></td>
                                                                <td class="text-left">
                                                                    <?php echo $det->item; ?>
                                                                    <?php echo br(); ?>
                                                                    <small><i><?php echo tgl_indo5($det->tgl_simpan); ?></i></small>
                                                                    
                                                                    <?php if (!empty($det->keterangan)) { ?>
                                                                        <!--Iki nggo nampilke catatan ndes-->
                                                                        <?php echo br(); ?>
                                                                        <small><i><?php echo $det->keterangan ?></i></small>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="text-center"><?php echo (float) $det->jml; ?></td>
                                                                <td class="text-right">
                                                                    <?php echo format_angka($det->harga); ?>
                                                                </td>
                                                                <td class="text-right"><?php echo format_angka($det->subtotal); ?></td>
                                                            </tr>
                                                            
                                                            <?php $no++; $sub += $det->harga; $gtotal += $det->subtotal; ?>
                                                            <?php } ?>
                                                        <tr>
                                                            <td class="text-right text-bold" colspan="4">Subtotal</td>
                                                            <td class="text-right text-bold"><?php  echo format_angka($sub); ?></td>
                                                        </tr>
                                                    <tr>
                                                        <td class="text-right text-bold" colspan="4">Grand Total</td>
                                                        <td class="text-right text-bold"><?php  echo format_angka($gtotal); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- CARD PEMBAYARAN -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">History Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-yellow">
                                                <th class="text-left">No</th>
                                                <th class="text-left">Tanggal</th>
                                                <th class="text-center">Nominal</th>
                                                <th class="text-left">Metode</th>
                                                <th class="text-left">Nota</th>
                                                <th class="text-left">Bukti</th>
                                                <th class="text-left">Keterangan</th>
                                            </tr>                                    
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; $sub = 0; ?>
                                            <?php foreach ($SQLPenjPlat as $det) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no . '.'; ?></td>
                                                <td class="text-left">
                                                    <?php echo tgl_indo5($det->tgl_simpan); ?></i></small>
                                                </td>
                                                <td class="text-center"><?php echo format_angka($det->nominal); ?></td>
                                                <td class="text-left"><?php echo $det->platform; ?></td>
                                                <td class="text-left"><?php echo $det->no_nota; ?></td>
                                                <td class="text-left">
                                                    <?php if (!empty($det->file)): ?>
                                                        <img src="<?php echo base_url($det->file); ?>" 
                                                            alt="Gambar Nota" 
                                                            class="img-fluid" 
                                                            style="max-height: 250px;">
                                                    <?php else: ?>
                                                        <span>Tidak ada gambar</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-left"><?php echo $det->keterangan;?></td>
                                            </tr>
                                            
                                            <?php $no++; $sub += $det->nominal; ?>
                                            <?php } ?>
                                            <tr>
                                                <td class="text-right text-bold" colspan="2">Subtotal : </td>
                                                <td class="text-left text-bold" colspan="5"><?php echo format_angka($sub); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-4">
                    <?php echo form_open_multipart(base_url('transaksi/set_trans_bayar.php'), 'autocomplete="off"') ?>
                    <?php echo form_hidden('id', $SQLPenj->id); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group<?php echo (!empty($psnGagal['tgl_bayar']) ? ' text-danger' : '') ?>">
                                <label for="inputEmail3">TANGGAL</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <?php echo form_input(['id' => 'tgl_bayar', 'name' => 'tgl_bayar', 'class' => 'form-control pull-right rounded-0', 'placeholder' => 'Harga ...', 'value' => date('d/m/Y')]) ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo (!empty($psnGagal['metode']) ? ' text-danger' : '') ?>">
                                <label for="inputEmail3">METODE PEMBAYARAN</label>
                                <select name="metode" class="form-control select2bs4  <?php echo (!empty($psnGagal['metode']) ? 'is-invalid' : '') ?>">
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($SQLPlat as $platform) { ?>
                                        <option value="<?php echo $platform->id ?>">
                                            <?php echo (!empty($platform->kode) ? '[' . $platform->kode . '] ' : '') . $platform->platform ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan Pembayaran</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                                    </div>
                                    <?php echo form_textarea([
                                        'id' => 'keterangan',
                                        'name' => 'keterangan',
                                        'class' => 'form-control pull-right rounded-0',
                                        'placeholder' => 'Tulis keterangan pembayaran di sini...',
                                        'rows' => 3,
                                    ]); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputEmail3">GRAND TOTAL</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <?php echo form_input(['id' => 'jml_gtotal', 'name' => 'jml_gtotal', 'class' => 'form-control pull-right rounded-0', 'placeholder' => 'Harga ...', 'value' => (!empty($SQLPenj) ? $SQLPenj->jml_gtotal : 0), 'readonly' => 'TRUE']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3">TERBAYAR</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <?php echo form_input(['id' => 'jml_bayar', 'name' => 'jml_bayar', 'class' => 'form-control pull-right rounded-0', 'placeholder' => 'Dibayar ...', 'value' => (!empty($SQLPenj) ? $SQLPenj->jml_bayar : 0), 'readonly' => 'TRUE']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3">KEKURANGAN</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <?php echo form_input(['id' => 'jml_kurang', 'name' => 'jml_kurang', 'class' => 'form-control pull-right rounded-0', 'placeholder' => 'Kurang ...', 'value' => (!empty($SQLPenj) ? ($SQLPenj->jml_gtotal - $SQLPenj->jml_bayar) : 0), 'readonly' => 'TRUE']) ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo (!empty($psnGagal['jml_bayar']) ? ' text-danger' : '') ?>">
                                <label for="inputEmail3">PEMBAYARAN</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <?php echo form_input(['id' => 'jml_bayar', 'name' => 'jml_bayar', 'class' => 'form-control pull-right rounded-0'.(!empty($psnGagal['jml_bayar']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan jumlah pembayaran ...']) ?>
                                </div>
                            </div>
                            <div class="form-group row<?php echo (!empty($psnGagal['fupload']) ? ' text-danger' : '') ?>" id="tp_berkas">
                                <label for="label">Unggah Bukti Bayar*</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="fupload" class="form-control-file<?php echo (!empty($psnGagal['fupload']) ? ' is-invalid' : '') ?>" accept=".jpg,.jpeg,.png,.pdf">
                                    <small class="form-text text-muted">* File yang diijinkan: jpg | png | pdf | jpeg (Maks. 5MB)</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right rounded-0"><i class="fa fa-shopping-cart"></i> Bayar</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Page script -->
<script type="text/javascript">
    $(function () {
        $("input[id=jml_gtotal],input[id=jml_bayar],input[id=jml_kurang]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
        
        $("#tgl_bayar").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });
        
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
</script>