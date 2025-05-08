<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<?php if ($SQLRab->status < '6') { ?>
    <!-- Item box -->
    <?php echo form_open(base_url('transaksi/rab/set_trans_po.php'), 'autocomplete="off"') ?>
    <?php echo form_hidden('id_po', (!empty($SQLPORw) ? $SQLPORw->id : '')); ?>
    <?php echo form_hidden('id_rab', $SQLRab->id); ?>
    <?php echo form_hidden('status', $request->getVar('status')); ?>
    <input type="hidden" id="id_supplier" name="id_supplier"<?php echo (!empty($SQLPORw) ? 'value="' . $SQLPORw->id_supplier . '"' : '') ?>>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DATA PURCHASE ORDER</h3>
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($psnGagal['supplier']) ? 'text-danger' : '') ?>">
                        <label class="control-label">Supplier*</label>
                        <?php echo form_input(['id' => 'supplier', 'name' => 'supplier', 'class' => 'form-control rounded-0 text-middle' . (!empty($psnGagal['supplier']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Supplier ...', 'value' => (!empty($SQLPORw) ? $SQLPORw->supplier : '')]) ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group<?php echo (!empty($psnGagal['tgl_masuk']) ? ' text-danger' : '') ?>">
                                <label for="inputEmail3" class="control-label">Tanggal PO*</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['tgl_masuk']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...', 'value' => (!empty($SQLPORw) ? tgl_indo2($SQLPORw->tgl_masuk) : '')]) ?>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                    <div class="form-group <?php echo (!empty($psnGagal['perusahaan']) ? 'text-danger' : '') ?>">
                        <label class="control-label">Perusahaan*</label>
                        <select name="perusahaan" class="form-control rounded-0<?php echo (!empty($psnGagal['perusahaan']) ? ' is-invalid' : '') ?>">
                            <option value="">- Pilih -</option>
                            <?php foreach ($SQLProfile as $profile) { ?>
                                <option value="<?php echo $profile->id ?>"<?php echo (!empty($SQLPORw) ? ($profile->id == $SQLPORw->id_perusahaan ? ' selected' : '') : '') ?>><?php echo strtoupper($profile->nama) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Catatan</label>
                        <div class="input-group mb-3">
                            <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control rounded-0', 'placeholder' => 'Isikan catatan pesanan ...', 'value' => (!empty($SQLPORw) ? $SQLPORw->keterangan : '')]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-6">
                    <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                </div>
                <div class="col-lg-6 text-right">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-shopping-cart"></i> Set PO</button>
                </div>
            </div>                            
        </div>
    </div>
    <?php echo form_close() ?>
    <!-- /.card -->
<?php } ?>

<!-- Item box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DATA PURCHASE ORDER</h3>
    </div>
    <div class="card-body">                                
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">No.</th>
                    <th class="text-left">Tgl</th>
                    <th class="text-left">Supplier</th>
                    <th class="text-center"></th>
                </tr>                                    
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($SQLPO as $det) { ?>
                    <tr>
                        <td class="text-center" style="width: 100px;">
                            <?php if (isset($_GET['status'])) { ?>
                                <?php if ($SQLRab->status == 4) { ?>
                                    <?php if ($det->id_user == $Pengguna->id) { ?>
                                        <?php if ($det->status_fkt == 0) { ?>
                                            <?php if(!hakAdminM()) : ?>
                                            <a href="<?php echo base_url('transaksi/rab/hapus_po.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_po=' . $det->id) ?>" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Hapus [<?php echo $det->no_po; ?>] ?')"><i class="fa fa-trash"></i></a>
                                            <?php endif; ?>
                                            <a href="<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_po=' . $det->id) ?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-edit"></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <small><?php echo status_po_fkt($det->status_fkt);    ?></small>
                        </td>
                        <td class="text-center" style="width: 50px;"><?php echo $no; ?></td>
                        <td class="text-left" style="width: 100px;"><?php echo tgl_indo($det->tgl_masuk); ?></td>
                        <td class="text-left" style="width: 400px;">
                            <small><?php echo $det->no_po; ?></small>
                            <?php echo br(); ?>
                            <?php echo $det->supplier; ?>
                            <?php echo br(); ?>
                            <small><?php echo $det->alamat; ?></small>
                        </td>
                        <td>
                            <?php if ($SQLRab->status < '6') { ?>
                                <?php if ($det->status_fkt == 0) { ?>
                                    <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?act=po_input&id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_po=' . $det->id), 'Input &raquo;', 'class="btn btn-primary btn-flat btn-xs" style="width: 60px;"') ?>
                                <?php } ?>
                            <?php } ?>
                            <?php echo anchor(base_url('pembelian/pesanan/data_pesanan_det.php?id=' . $det->id), 'Lihat &raquo;', 'class="btn btn-info btn-flat btn-xs" style="width: 60px;" target="_blank"') ?>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <?php if ($SQLRab->status == '6') { ?>
                    <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                <?php } ?>
            </div>
            <div class="col-lg-6 text-right">

            </div>
        </div>                            
    </div>
</div>
<!-- /.card -->