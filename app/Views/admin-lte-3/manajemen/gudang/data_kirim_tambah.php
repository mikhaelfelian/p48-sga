<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengiriman</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Pengiriman</li>
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
                <div class="col-md-6">
                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
                    <?php echo form_open(base_url('gudang/pengiriman/set_trans_simpan.php'), 'autocomplete="off"') ?>
                    <?php echo form_hidden('id', (!empty($SQLMutasi) ? $SQLMutasi->id : '')) ?>
                    <?php echo form_hidden('tipe', '4') ?>
                    <input type="hidden" id="id_penjualan" name="id_penjualan" value="<?php echo (!empty($SQLMutasi) ? $SQLMutasi->id_penjualan : ''); ?>">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Pengiriman</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group<?php echo (!empty($psnGagal['tgl_masuk']) ? ' text-danger' : '') ?>">
                                        <label for="inputEmail3" class="control-label">Tanggal*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['tgl_masuk']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...', 'value' => (!empty($SQLMutasi) ? tgl_indo2($SQLMutasi->tgl_masuk) : '')]) ?>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['no_nota']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">No. Nota*</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_input(['id' => 'no_nota', 'name' => 'no_nota', 'class' => 'form-control rounded-0 text-middle' . (!empty($psnGagal['pelanggan']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Data Penjualan ...', 'value' => (!empty($SQLMutasi) ? '[' . $SQLMutasi->no_nota . '] - ' . $SQLMutasi->p_nama : '')]) ?>
                                            <div class="input-group-append">
                                                <span class="input-group-text rounded-0"><?php // echo anchor('#', '<i class="fas fa-search"></i>')  ?><i class="fas fa-search"></i></span>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['pelanggan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Catatan</label>
                                        <?php echo form_textarea(['id' => 'ket', 'name' => 'keterangan', 'class' => 'form-control rounded-0', 'placeholder' => 'Inputkan catatan / keterangan ...', 'value' => (!empty($SQLMutasi) ? $SQLMutasi->keterangan : '')]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="reset" class="btn btn-danger btn-flat"><i class="fa fa-remove"></i> Batal</button>
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <div class="col-md-6">
                    <?php if (!empty($SQLMutasi)) { ?>
                        <?php echo form_open(base_url('gudang/pengiriman/cart_simpan.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id_mutasi', (!empty($SQLMutasi) ? $SQLMutasi->id : '')) ?>
                        <?php echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : '')) ?>
                        <?php echo form_hidden('id_penj_det', (!empty($_GET['id_penj_det']) ? $_GET['id_penj_det'] : '')) ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">INPUT ITEM</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                if (isset($_GET['page'])) {
                                                    switch ($_GET['page']) {
                                                        case 'item_input':
                                                            ?>
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-left">Item</th>
                                                                        <th class="text-left" colspan="2">Jml</th>
                                                                        <th class="text-left"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($SQLPenjDet as $penj) { ?>
                                                                        <tr>
                                                                            <td class="text-left"><?php echo $penj->item ?></td>
                                                                            <td class="text-left"><?php echo $penj->jml ?></td>
                                                                            <td class="text-right"><?php echo $penj->satuan ?></td>
                                                                            <td class="text-right"><?php echo anchor(base_url('gudang/pengiriman/data_kirim_tambah.php?id=' . $request->getVar('id') . '&id_item=' . $penj->id_item . '&id_penj_det=' . $penj->id), '<i class="fa fa-check"></i> Pilih', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                            break;
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="form-group row<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Item</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group mb-3">
                                                                <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Cari Item yang akan dikirim ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : '')]) ?>                                                       
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><?php echo anchor(base_url('gudang/pengiriman/data_kirim_tambah.php?page=item_input&id=' . $request->getVar('id') . (!empty($SQLMutasi) ? '&id_penjualan=' . $SQLMutasi->id_penjualan : '')), '<i class="fa fa-search"></i>') ?></span>
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
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jml*</label>
                                                            <div class="col-sm-4">
                                                                <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Jml ...', 'value' => (!empty($SQLRabDetRw->jml) ? $SQLRabDetRw->jml : '')]) ?>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                                                    <option value="">- Satuan -</option>
                                                                    <?php foreach ($SQLSatuan as $satuan) { ?>
                                                                        <option value="<?php echo $satuan->id ?>"<?php echo (!empty($SQLRabDetRw) ? ($SQLRabDetRw->id_satuan == $satuan->id ? ' selected' : '') : '') ?>><?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row<?php echo (!empty($psnGagal['sn']) ? ' text-danger' : '') ?>">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">S/N atau Kode*</label>
                                                            <div class="col-sm-9">
                                                                <?php echo form_input(['id' => 'sn', 'name' => 'sn', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['sn']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan S/N atau Kode Item ...']) ?>                                                       
                                                            </div>
                                                        </div>
                                                        <div class="form-group row<?php echo (!empty($psnGagal['sn']) ? ' text-danger' : '') ?>">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Catatan</label>
                                                            <div class="col-sm-9">
                                                                <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['sn']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan catatan terkait mutasi / peminjaman barang dll ...', 'rows' => '5']) ?>                                                       
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <?php if (!empty($SQLItem)) { ?>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">

                                        </div>
                                        <div class="col-lg-6 text-right">                                        
                                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>                            
                                </div>
                            <?php } ?>
                        </div>
                        <?php echo form_close() ?>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty($SQLMutasi)) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA MUTASI</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-left" style="width: 100px;">No. TRX</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left"><?php echo $SQLMutasi->no_mutasi ?></td>

                                        <th class="text-left" style="width: 100px;">Tgl</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left"><?php echo tgl_indo($SQLMutasi->tgl_masuk) ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left" style="width: 100px;">Tipe</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left"><?php echo status_mutasi($SQLMutasi->tipe) ?></td>

                                        <th class="text-left" style="width: 100px;">Petugas</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left"><?php echo $SQLMutasi->user ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left" style="width: 100px;">Kepada</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left" colspan="4"><?php echo '[' . $SQLMutasi->no_nota . '] - ' . $SQLMutasi->p_nama ?></td>
                                    </tr>
                                    <?php if ($SQLMutasi->tipe == '3') { ?>
                                        <tr>
                                            <th class="text-left" style="width: 100px;">Kepada</th>
                                            <th class="text-center" style="width: 2px;">:</th>
                                            <td class="text-left" colspan="4"><?php echo $SQLMutasi->c_nama ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left" style="width: 100px;">Dari</th>
                                            <th class="text-center" style="width: 2px;">:</th>
                                            <td class="text-left" colspan="4"><?php echo $SQLMutasi->p_nama ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th class="text-left" style="width: 100px;">Catatan</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left" colspan="4"><?php echo $SQLMutasi->keterangan ?></td>
                                    </tr>
                                </table>
                                <hr/>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center">No</th>
                                            <th class="text-left">SN</th>
                                            <th class="text-left">Item</th>
                                            <th class="text-center">Jml</th>
                                            <th class="text-left">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($SQLMutasiDet as $det) { ?>
                                            <tr>
                                                <td class="text-center" style="width: 100px;">
                                                    <?php if ($SQLMutasi->status > 0) { ?>
                                                        <?php if(!hakAdminM()) : ?>
                                                        <a href="<?php echo base_url('gudang/mutasi/cart_hapus.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_item=' . $det->id) ?>" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Hapus [<?php echo $det->item; ?>] ?')"><i class="fa fa-trash"></i></a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo base_url('gudang/mutasi/data_mutasi_tambah.php?id=' . $request->getVar('id') . '&id_item=' . $det->id_item . '&id_item_det=' . $det->id) ?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-edit"></i></a>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center" style="width: 50px;"><?php echo $no; ?>.</td>
                                                <td class="text-left" style="width: 150px;"><?php echo $det->sn; ?></td>
                                                <td class="text-left" style="width: 350px;">
                                                    <small><?php echo $det->kode ?></small>
                                                    <?php echo br(); ?>
                                                    <?php echo $det->item; ?>
                                                </td>
                                                <td class="text-center" style="width: 100px;"><?php echo $det->jml ?></td>
                                                <td class="text-left" style="width: 100px;"><?php echo $det->satuan ?></td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">

                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 text-right">
                                        <?php if (!empty($SQLMutasi)) { ?>
                                            <?php echo form_open(base_url('gudang/pengiriman/set_trans_proses.php'), 'autocomplete="off"') ?>
                                            <?php echo form_hidden('id', (!empty($SQLMutasi) ? $SQLMutasi->id : '')) ?>
                                            <?php echo form_hidden('status', '1') ?>

                                            <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-arrow-right"></i> Proses &raquo;</button>
                                            <?php echo form_close() ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        $("input[id=pagu],input[id=hps]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
        $("#tgl").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });

        // Data Pelanggan
        $('#no_nota').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo base_url('public/json_penj.php') ?>",
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
                $itemrow.find('#id_penjualan').val(ui.item.id);
                $('#id_penjualan').val(ui.item.id);
                $('#no_nota').val(ui.item.nama);

                // Give focus to the next input field to recieve input from user
                $('#no_nota').focus();
                return false;
            }

            // Format the list menu output of the autocomplete
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.nama + "</a>")
                    .appendTo(ul);
        };

<?php if (!empty($SQLMutasi)) { ?>
            // Data Item
            $('#item').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('/json_item.php') ?>",
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
                    window.location.href = "<?php echo base_url('gudang/mutasi/data_mutasi_tambah.php?id=' . $request->getVar('id')) ?>&id_item=" + ui.item.id;

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

<?php echo session()->getFlashdata('gudang_toast'); ?>
    });
</script>