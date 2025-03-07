<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pembelian') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Purchase Invoice</li>
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
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Purchase Invoice</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
                                    <?php echo form_open(base_url('pembelian/faktur/set_trans_simpan.php'), 'autocomplete="off"') ?>
                                    <?php echo form_hidden('id', (isset($_GET['id']) ? $request->getVar('id') : '0')) ?>
                                    <?php echo form_hidden('id_po', (isset($_GET['id_po']) ? $request->getVar('id_po') : '')) ?>
                                    <input type="hidden" id="id_supplier" name="id_supplier"
                                        value="<?php echo (!empty($SQLSupp) ? $SQLSupp->id : '') ?>">

                                    <div
                                        class="form-group <?php echo (!empty($psnGagal['supplier']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Supplier*</label>
                                        <?php echo form_input(['id' => 'supplier', 'name' => 'supplier', 'class' => 'form-control rounded-0 text-middle' . (!empty($psnGagal['supplier']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Supplier ...', 'value' => (!empty($SQLSupp) ? $SQLSupp->nama : '')]) ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div
                                                class="form-group<?php echo (!empty($psnGagal['tgl_masuk']) ? ' text-danger' : '') ?>">
                                                <label for="inputEmail3" class="control-label">Tgl PI*</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <?php echo form_input(['id' => '', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['tgl_masuk']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...', 'value' => (!empty($SQLBeli) ? tgl_indo2($SQLBeli->tgl_masuk) : '')]) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group<?php echo (!empty($psnGagal['tgl_keluar']) ? ' text-danger' : '') ?>">
                                                <label for="inputEmail3" class="control-label">Tgl Tempo</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <?php echo form_input(['id' => '', 'name' => 'tgl_keluar', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['tgl_keluar']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...', 'value' => (!empty($SQLBeli) ? tgl_indo2($SQLBeli->tgl_keluar) : '')]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="form-group <?php echo (!empty($psnGagal['no_nota']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">No Purchase Invoice*</label>
                                        <?php echo form_input(['id' => 'no_nota', 'name' => 'no_nota', 'class' => 'form-control rounded-0 text-middle' . (!empty($psnGagal['no_nota']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan No Purchase Invoice ...', 'value' => (!empty($SQLBeli) ? $SQLBeli->no_nota : '')]) ?>
                                    </div>
                                    <div
                                        class="form-group <?php echo (!empty($psnGagal['perusahaan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Perusahaan*</label>
                                        <select name="perusahaan"
                                            class="form-control rounded-0<?php echo (!empty($psnGagal['perusahaan']) ? ' is-invalid' : '') ?>">
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($SQLProfile as $profile) { ?>
                                                <option value="<?php echo $profile->id ?>" <?php echo (!empty($SQLSupp) ? ($profile->id == $SQLSupp->id ? ' selected' : '') : '') ?>>
                                                    <?php echo strtoupper($profile->nama) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status PPn</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_radio(['id' => 'status_ppn', 'name' => 'status_ppn', 'value' => '0', 'checked' => (!empty($SQLBeli) ? ($SQLBeli->status_ppn == '0' ? TRUE : FALSE) : FALSE)]); ?>
                                            &nbsp; Non PPN &nbsp;&nbsp;
                                            <?php echo form_radio(['id' => 'status_ppn', 'name' => 'status_ppn', 'value' => '2', 'checked' => (!empty($SQLBeli) ? ($SQLBeli->status_ppn == '2' ? TRUE : FALSE) : FALSE)]); ?>
                                            &nbsp; Include PPN &nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-danger btn-flat"
                                                onclick="window.location.href = '<?php echo base_url('pembelian/pesanan/set_pesanan_batal.php?id=') ?>'"><i
                                                    class="fa fa-remove"></i> Batal</button>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-primary btn-flat"><i
                                                    class="fa fa-shopping-cart"></i> Set Beli</button>
                                        </div>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>
                                <div class="col-md-6">
                                    <?php if (!empty($SQLBeli)) { ?>
                                        <?php echo form_open(base_url('pembelian/faktur/cart_simpan.php'), 'autocomplete="off"') ?>
                                        <?php
                                        echo form_hidden('id_beli', $request->getVar('id'));
                                        echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : ''));

                                        if (!empty($SQLBeliDetRw)) {
                                            echo form_hidden('id_beli_det', $request->getVar('id_item_det'));
                                        }
                                        ?>

                                        <div
                                            class="form-group<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                            <label for="inputEmail3" class="control-label">Item</label>
                                            <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Item ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : '')]) ?>
                                        </div>
                                        <?php if (!empty($SQLItem)) { ?>
                                            <div
                                                class="form-group<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                                <label for="inputEmail3" class="control-label">SKU</label>
                                                <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => $SQLItem->kode, 'readonly' => 'true']) ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div
                                                        class="form-group<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Jml</label>
                                                        <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Jml ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->jml : '')]) ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="inputEmail3" class="control-label">Satuan</label>
                                                    <select name="satuan"
                                                        class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                                        <option value="">- Pilih -</option>
                                                        <?php foreach ($SQLSatuan as $satuan) { ?>
                                                            <option value="<?php echo $satuan->id ?>" <?php echo (!empty($SQLBeliDetRw) ? ($satuan->id == $SQLBeliDetRw->id_satuan ? ' selected' : '') : '') ?>>
                                                                <?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div
                                                        class="form-group <?php echo (!empty($psnGagal['harga']) ? 'text-danger' : '') ?>">
                                                        <label class="control-label">Harga</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp.</span>
                                                            </div>
                                                            <?php echo form_input(['id' => 'harga', 'name' => 'harga', 'class' => 'form-control rounded-0 pull-right' . (!empty($psnGagal['harga']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Harga Beli ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->harga : '0')]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div
                                                        class="form-group<?php echo (!empty($psnGagal['disk1']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Disk 1</label>
                                                        <?php echo form_input(['id' => 'disk1', 'name' => 'disk1', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['disk1']) ? ' is-invalid' : ''), 'placeholder' => 'Disk 1 ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->disk1 : '0')]) ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div
                                                        class="form-group<?php echo (!empty($psnGagal['disk2']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Disk 1</label>
                                                        <?php echo form_input(['id' => 'disk2', 'name' => 'disk2', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['disk2']) ? ' is-invalid' : ''), 'placeholder' => 'Disk 2 ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->disk2 : '0')]) ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div
                                                        class="form-group<?php echo (!empty($psnGagal['disk2']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Disk 3</label>
                                                        <?php echo form_input(['id' => 'disk3', 'name' => 'disk3', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['disk3']) ? ' is-invalid' : ''), 'placeholder' => 'Disk 3 ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->disk3 : '0')]) ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div
                                                        class="form-group <?php echo (!empty($psnGagal['potongan']) ? 'text-danger' : '') ?>">
                                                        <label class="control-label">Potongan</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp.</span>
                                                            </div>
                                                            <?php echo form_input(['id' => 'potongan', 'name' => 'potongan', 'class' => 'form-control rounded-0 pull-right' . (!empty($psnGagal['potongan']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Potongan ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->potongan : '')]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-primary btn-flat"><i
                                                        class="fa fa-save"></i> Simpan</button>
                                            </div>
                                        </div>
                                        <?php echo form_close() ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($SQLBeli)) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open(base_url('pembelian/faktur/set_trans_proses.php'), 'autocomplete="off"') ?>
                        <!-- Item box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA ITEM</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Nama Supplier</th>
                                                <th>:</th>
                                                <td><?php echo strtoupper($SQLBeli->supplier) ?></td>

                                                <th>Tgl Pembelian</th>
                                                <th>:</th>
                                                <td><?php echo tgl_indo2($SQLBeli->tgl_masuk) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kode Supplier</th>
                                                <th>:</th>
                                                <td><?php echo ucwords($SQLBeli->kode) ?></td>

                                                <th>Tgl Jatuh Tempo</th>
                                                <th>:</th>
                                                <td><?php echo tgl_indo2($SQLBeli->tgl_keluar) ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. Purchase Order</th>
                                                <th>:</th>
                                                <td><?php echo strtoupper($SQLBeli->no_po) ?></td>

                                                <th>Status PPN</th>
                                                <th>:</th>
                                                <td><?php echo status_ppn($SQLBeli->status_ppn) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">No</th>
                                                    <th class="text-left">Item</th>
                                                    <th class="text-center">Jml</th>
                                                    <th class="text-right">Harga</th>
                                                    <th class="text-right">Diskon</th>
                                                    <th class="text-right">Potongan</th>
                                                    <th class="text-right">Subtotal</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($SQLBeliDet)) { ?>
                                                    <?php $no = 1;
                                                    $subtotal = 0; ?>
                                                    <?php foreach ($SQLBeliDet as $det) { ?>
                                                        <?php $subtotal = $subtotal + $det->subtotal; ?>
                                                        <tr>
                                                            <td class="text-right" style="width: 50px;">
                                                                <?php echo anchor(base_url('pembelian/faktur/cart_hapus.php?id=' . $det->id_pembelian . '&id_item=' . $det->id), '<i class="fas fa-trash"></i>', 'class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Hapus [' . $det->item . '] ?\')"') ?>
                                                            </td>
                                                            <td class="text-center"><?php echo $no; ?></td>
                                                            <td class="text-left" style="width: 350px;">
                                                                <small><?php echo (!empty($det->kode) ? $det->kode : ''); ?></small><br />
                                                                <?php echo $det->item; ?>
                                                            </td>
                                                            <td class="text-center" style="width: 100px;">
                                                                <?php echo (float) $det->jml; ?>
                                                            </td>
                                                            <td class="text-right" style="width: 150px;">
                                                                <?php echo format_angka($det->harga); ?>
                                                            </td>
                                                            <td class="text-right" style="width: 200px;">
                                                                <?php echo ($det->disk1 != '0' ? (float) $det->disk1 : '') . ($det->disk2 != '0' ? ' + ' . (float) $det->disk2 : '') . ($det->disk3 != '0' ? ' + ' . (float) $det->disk3 : ''); ?>
                                                            </td>
                                                            <td class="text-right" style="width: 150px;">
                                                                <?php echo format_angka($det->potongan); ?>
                                                            </td>
                                                            <td class="text-right" style="width: 200px;">
                                                                <?php echo format_angka($det->subtotal); ?>
                                                            </td>
                                                            <td class="text-left" style="width: 70px;">
                                                                <?php echo anchor(base_url('pembelian/faktur/data_pembelian_tambah.php?id=' . $request->getVar('id') . '&id_item=' . $det->id_item . '&id_item_det=' . $det->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                            </td>
                                                        </tr>
                                                        <?php $no++; ?>
                                                    <?php } ?>
                                                    <tr>
                                                        <th class="text-right" colspan="7">Total</th>
                                                        <th class="text-right"><?php echo format_angka($subtotal); ?></th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right" colspan="7">Discount</th>
                                                        <th class="text-right">
                                                            <?php echo form_input(['name' => 'discount', 'class' => 'form-control rounded-0 text-right', 'placeholder' => '0']); ?>
                                                        </th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <th class="text-center" colspan="8">Tidak Ada Data</th>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <?php if (!empty($SQLBeliDet)) { ?>
                                            <?php echo form_hidden('id', $SQLBeli->id) ?>
                                            <?php echo form_hidden('status', '1') ?>

                                            <button type="submit" class="btn btn-success btn-flat"><i
                                                    class="fas fa-arrow-right"></i> Proses &raquo;</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                        <?php echo form_close() ?>
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
        $('input[id=harga],input[id=jml],input[id=disk1],input[id=disk2],input[id=disk3],input[id=harga],input[id=potongan]').autoNumeric({ aSep: '.', aDec: ',', aPad: false });
        $("input[name=tgl_masuk]").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });
        $("input[name=tgl_keluar]").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });
        <?php echo session()->getFlashdata('pembelian_toast'); ?>

        // Data Supplier
        $('#supplier').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo base_url('pembelian/json_supplier.php') ?>",
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
                $itemrow.find('#id_supplier').val(ui.item.id);
                $('#id_supplier').val(ui.item.id);
                $('#supplier').val(ui.item.nama);

                // Give focus to the next input field to recieve input from user
                $('#supplier').focus();
                return false;
            }

            // Format the list menu output of the autocomplete
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append("<a>" + item.nama + "</a>")
                .appendTo(ul);
        };

        <?php if (!empty($SQLBeli)) { ?>
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
                    window.location.href = "<?php echo base_url('pembelian/faktur/data_pembelian_tambah.php?id=' . $request->getVar('id')) ?>&id_item=" + ui.item.id;

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