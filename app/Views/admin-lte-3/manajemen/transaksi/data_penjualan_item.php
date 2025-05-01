<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

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
                    <?php if ($SQLPenj->id_rab == '0') { ?>
                        <!-- Form Item box -->
                        <?php echo form_open(base_url('transaksi/cart_simpan.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id_penj', (!empty($SQLPenj) ? $SQLPenj->id : '')) ?>
                        <?php echo form_hidden('id_penj_det', (!empty($SQLRabDetRw) ? $SQLRabDetRw->id : '')) ?>
                        <?php echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : '')) ?>
                        <?php echo form_hidden('status', $request->getVar('status')) ?>
                        <?php // echo form_hidden('status_ppn', '1') ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">INPUT ITEM</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Item</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group mb-3">
                                                            <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Item ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : '')]) ?>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text rounded-0"><?php echo anchor(base_url('master/data_item_tambah.php?id_rab=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&route=transaksi/rab/data_rab_aksi.php'), '<i class="fas fa-plus"></i>') ?></span>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                                <?php if (!empty($SQLItem)) { ?>
                                                    <div class="form-group row<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">SKU</label>
                                                        <div class="col-sm-9">
                                                            <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => $SQLItem->kode, 'readonly' => 'true']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jml</label>
                                                        <div class="col-sm-4">
                                                            <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Jml ...', 'value' => (!empty($SQLRabDetRw->jml) ? $SQLRabDetRw->jml : '')]) ?>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                                                <option value="">- Pilih -</option>
                                                                <?php foreach ($SQLSatuan as $satuan) { ?>
                                                                    <option value="<?php echo $satuan->id ?>"<?php echo (!empty($SQLItem) ? ($SQLItem->id_satuan == $satuan->id ? ' selected' : '') : '') ?>><?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row<?php echo (!empty($psnGagal['harga']) ? ' text-danger' : '') ?>">
                                                        <label class="col-sm-3 col-form-label">Harga</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Rp.</span>
                                                                </div>
                                                                <?php echo form_input(['id' => 'harga', 'name' => 'harga', 'class' => 'form-control rounded-0 pull-right' . (!empty($psnGagal['harga']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Harga Jual ...', 'value' => (!empty($SQLRabDetRw->harga) ? $SQLRabDetRw->harga : (!empty($SQLItem->harga_jual) ? $SQLItem->harga_jual : ''))]) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row<?php echo (!empty($psnGagal['hpp']) ? ' text-danger' : '') ?>">
                                                        <label class="col-sm-3 col-form-label">HPP</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Rp.</span>
                                                                </div>
                                                                <?php echo form_input(['id' => 'hpp', 'name' => 'hpp', 'class' => 'form-control rounded-0 pull-right' . (!empty($psnGagal['hpp']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan HPP ...', 'value' => (!empty($SQLRabDetRw->harga_hpp) ? $SQLRabDetRw->harga_hpp : (!empty($SQLItem->harga_beli) ? $SQLItem->harga_beli : ''))]) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group<?php echo (!empty($psnGagal['status_ppn']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Status PPN</label>
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                    <?php echo form_checkbox(['id' => 'customSwitch3', 'name' => 'status_ppn', 'value' => '1', 'class' => 'custom-control-input', 'checked' => (!empty($SQLRabDetRw) ? ($SQLRabDetRw->status_ppn == '1' ? true : false) : false)]) ?>
                                                                    <label class="custom-control-label" for="customSwitch3">Ya</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php if (!empty($SQLItem)) { ?>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Catatan</label>
                                                        <div class="col-sm-9">
                                                            <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control pull-left rounded-0', 'placeholder' => 'Isikan catatan / spek ...', 'rows' => '8', 'value' => (!empty($SQLRabDetRw->keterangan) ? $SQLRabDetRw->keterangan : '')]) ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row<?php echo (!empty($psnGagal['item_link']) ? ' text-danger' : '') ?>">
                                                        <label class="col-sm-3 col-form-label">Link</label>
                                                        <div class="col-sm-9">
                                                            <?php echo form_input(['id' => 'item_link', 'name' => 'item_link', 'class' => 'form-control rounded-0 pull-right' . (!empty($psnGagal['item_link']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Link ...', 'value' => (!empty($SQLRabDetRw->item_link) ? $SQLRabDetRw->item_link : '')]) ?>
                                                            <small>* <i>Isikan link produk yang tayang e-Kat, dll</i></small>
                                                        </div>
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
                                        <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    <?php } ?>

                    <!-- Item box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DATA ITEM</h3>
                        </div>
                        <div class="card-body">
                            <?php echo view($konten_list) ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php if (!empty($SQLPenj->id_rab)) { ?>
                                        <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                                    <?php } ?>
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
<script type="text/javascript">
    $(function () {
        $("input[id=harga],input[id=jml],input[id=hpp]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
<?php echo session()->getFlashdata('transaksi_toast'); ?>

<?php if (!empty($SQLPenj)) { ?>
            // Data Item
            $('#item').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('public/json_item.php') ?>",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function (event, ui) {
                    var $itemrow = $(this).closest('tr');
                    //Populate the input fields from the returned values
                    $itemrow.find('#id_item').val(ui.item.id);
                    $('#id_item').val(ui.item.id);
                    $('#item').val(ui.item.nama);
                    window.location.href = "<?php echo base_url('transaksi/data_penjualan_aksi.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status')) ?>&id_item=" + ui.item.id;

                    // Give focus to the next input field to recieve input from user
                    $('#item').focus();
                    return false;
                }

                // Format the list menu output of the autocomplete
            }).data("ui-autocomplete")._renderItem = function (ul, item) {
                return $("<li></li>")
                        .data("item.autocomplete", item)
                        .append("<a>" + item.nama + "</a>")
                        .appendTo(ul);
            };
<?php } ?>
    });
</script>