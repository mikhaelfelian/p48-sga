<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<!-- Item box -->
<?php echo form_open(base_url('gudang/pengiriman/set_trans_simpan.php'), 'autocomplete="off"') ?>
<?php echo form_hidden('id', (!empty($SQLMutasiRw) ? $SQLMutasiRw->id : '')); ?>
<?php echo form_hidden('id_penjualan', $SQLPenj->id); ?>
<?php echo form_hidden('status', $request->getVar('status')); ?>
<?php echo form_hidden('tipe', '4') ?>
<?php echo form_hidden('route', 'transaksi/data_penjualan_aksi.php?id=' . $SQLPenj->id . '&status=' . $request->getVar('status')); ?>
<input type="hidden" id="id_supplier" name="id_supplier"<?php echo (!empty($SQLPORw) ? 'value="' . $SQLPORw->id_supplier . '"' : '') ?>>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DATA PENGIRIMAN</h3>
    </div>
    <div class="card-body table-responsive">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group<?php echo (!empty($psnGagal['tgl_masuk']) ? ' text-danger' : '') ?>">
                            <label for="inputEmail3" class="control-label">Tanggal Kirim*</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['tgl_masuk']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...', 'value' => (!empty($SQLMutasiRw) ? tgl_indo2($SQLMutasiRw->tgl_masuk) : '')]) ?>
                            </div>
                        </div>                                        
                    </div>
                </div>
                <div class="form-group <?php echo (!empty($psnGagal['perusahaan']) ? 'text-danger' : '') ?>">
                    <label class="control-label">Pengirim*</label>
                    <select name="perusahaan" class="form-control rounded-0<?php echo (!empty($psnGagal['perusahaan']) ? ' is-invalid' : '') ?>">
                        <option value="">- Pilih -</option>
                        <?php foreach ($SQLProfile as $profile) { ?>
                            <option value="<?php echo $profile->id ?>"<?php echo (!empty($SQLMutasiRw) ? ($profile->id == $SQLMutasiRw->id_perusahaan ? ' selected' : '') : '') ?>><?php echo strtoupper($profile->nama) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group <?php echo (!empty($psnGagal['no_pengiriman']) ? 'text-danger' : '') ?>">
                    <label class="control-label">No Pengiriman*</label>
                    <?php echo form_input(['id' => 'no_pengiriman', 'name' => 'no_pengiriman', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['no_pengiriman']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan No Pengiriman ...', 'value' => (!empty($SQLMutasiRw->no_pengiriman) ? $SQLMutasiRw->no_pengiriman : '')]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Catatan</label>
                    <div class="input-group mb-3">
                        <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control rounded-0', 'placeholder' => 'Isikan catatan pesanan ...', 'value' => (!empty($SQLMutasiRw) ? $SQLMutasiRw->keterangan : '')]) ?>
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
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-paper-plane"></i> Set Kirim</button>
            </div>
        </div>                            
    </div>
</div>
<?php echo form_close() ?>
<!-- /.card -->

<?php echo view($ThemePath.'/manajemen/transaksi/data_penjualan_do_list'); ?>