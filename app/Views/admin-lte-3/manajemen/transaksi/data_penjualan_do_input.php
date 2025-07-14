<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<div class="row">
    <div class="col-md-12">
        <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
        <?php echo form_open(base_url('transaksi/cart_simpan_do.php'), 'autocomplete="off"') ?>
        <?php echo form_hidden('id', (!empty($_GET['id']) ? $request->getVar('id') : '')) ?>
        <?php echo form_hidden('id_mutasi', (!empty($SQLMutasiRw) ? $SQLMutasiRw->id : '')) ?>
        <?php echo form_hidden('id_mutasi_det', (!empty($SQLMutasiDetRw) ? $SQLMutasiDetRw->id : '')) ?>
        <?php echo form_hidden('id_penjualan_det', (!empty($_GET['id_penj_det']) ? $request->getVar('id_penj_det') : '')) ?>
        <?php echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : '')) ?>
        <?php echo form_hidden('status', (!empty($_GET['status']) ? $request->getVar('status') : '')) ?>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">[INPUT] DATA PENGIRIMAN <small><i><?php echo $SQLMutasiRw->no_mutasi ?></i></small></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Item</th>
                                            <th class="text-center">Jml</th>
                                            <th class="text-left"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($SQLPenjDet as $det) { ?>
                                            <tr>
                                                <td class="text-left" style="width: 350px;">
                                                    <small><?php echo $det->item; ?></small>
                                                </td>
                                                <td class="text-center" style="width: 50px;"><?php echo $det->jml; ?></td>
                                                <td style="width: 80px;">
                                                    <?php echo anchor(base_url('transaksi/data_penjualan_aksi.php?act=do_input&id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_do=' . $request->getVar('id_do') . '&id_item=' . $det->id_item . '&id_penj_det=' . $det->id), 'Input &raquo;', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($SQLItem)) { ?>
                                    <div class="form-group <?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                        <label for="inputEmail3" class="">ITEM</label>
                                        <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => $SQLItem->item, 'readonly' => 'true']) ?>
                                    </div>
                                    <label for="inputEmail3">Jml*</label>
                                    <div class="form-group row<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                                        <div class="col-sm-6">
                                            <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Jml ...', 'value' => (!empty($SQLMutasiDetRw->jml) ? $SQLMutasiDetRw->jml : '')]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                                <option value="">- Satuan -</option>
                                                <?php foreach ($SQLSatuan as $satuan) { ?>
                                                    <option value="<?php echo $satuan->id ?>" <?php echo (!empty($SQLMutasiDetRw) ? ($SQLMutasiDetRw->id_satuan == $satuan->id ? ' selected' : '') : '') ?>><?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <label class="col-sm-3 col-form-label">PILIH SN*</label>
                                    <div class="form-group row<?php echo (!empty($psnGagal['kode_sn[]']) ? ' text-danger' : '') ?>">
                                        <div class="col-sm-12">
                                            <select name="kode_sn[]" class="form-control select2<?php echo (!empty($psnGagal['kode_sn']) ? ' is-invalid' : '') ?>" multiple="multiple" data-placeholder="- PILIH KODE SN -" style="width: 100%;" required>
                                                <?php foreach ($SQLItemStokDet as $det) { ?>
                                                    <option value="<?php echo $det->id ?>"><?php echo $det->kode; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['sn']) ? ' text-danger' : '') ?>">
                                        <label for="inputEmail3">Catatan</label>
                                        <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['sn']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SN, pisahkan dengan koma atau titik koma  ...', 'value' => (!empty($SQLMutasiDetRw) ? $SQLMutasiDetRw->keterangan : ''), 'rows' => '5']) ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <?php if (!empty($SQLItem)) { ?>
                            <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?act=' . $request->getVar('act') . '&id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_do=' . $request->getVar('id_do')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                        <?php } ?>
                    </div>
                    <div class="col-lg-6 text-right">
                        <?php if (!empty($SQLItem)) { ?>
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>

<?php echo view($ThemePath . '/manajemen/transaksi/data_penjualan_do_list_item'); ?>
<script type="text/javascript">
    $(function() {
        $('.select2').select2(); // Inisialisasi Select2 untuk elemen dengan class select2
    })
</script>