<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pembelian') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Purchase Order</li>
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
                            <h3 class="card-title">Form Purchase Order</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
                                    <?php echo form_open(base_url('pembelian/pesanan/set_trans_simpan.php'), 'autocomplete="off"') ?>
                                    <input type="hidden" id="id_supplier" name="id_supplier">
                                    <input type="hidden" id="id_rab" name="id_rab">

                                    <div class="form-group <?php echo (!empty($psnGagal['supplier']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Supplier*</label>
                                        <?php echo form_input(['id' => 'supplier', 'name' => 'supplier', 'class' => 'form-control rounded-0 text-middle' . (!empty($psnGagal['supplier']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Supplier ...']) ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group<?php echo (!empty($psnGagal['tgl_masuk']) ? ' text-danger' : '') ?>">
                                                <label for="inputEmail3" class="control-label">Tanggal PO*</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['tgl_masuk']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...']) ?>
                                                </div>
                                            </div>                                        
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['perusahaan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Perusahaan*</label>
                                        <select name="perusahaan" class="form-control rounded-0<?php echo (!empty($psnGagal['perusahaan']) ? ' is-invalid' : '') ?>">
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($SQLProfile as $profile) { ?>
                                                <option value="<?php echo $profile->id ?>"><?php echo strtoupper($profile->nama) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Catatan</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_textarea(['id' => 'keterangan', 'name' => 'keterangan', 'class' => 'form-control rounded-0', 'placeholder' => 'Isikan catatan pesanan ...']) ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-danger btn-flat" onclick="window.location.href = '<?php echo base_url('pembelian/pesanan/set_pesanan_batal.php?id=') ?>'"><i class="fa fa-remove"></i> Batal</button>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-shopping-cart"></i> Set Pesanan</button>
                                        </div>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>
                                <div class="col-md-6">
                                    <?php if (!empty($SQLPsn)) { ?>
                                        <?php echo form_open(base_url('pembelian/pesanan/cart_simpan.php'), 'autocomplete="off"') ?>
                                        <?php
                                        echo form_hidden('id_pesanan', $request->getVar('id'));
                                        echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : ''));

                                        if (!empty($SQLPsnDetRw)) {
                                            echo form_hidden('id_pesanan_det', $request->getVar('id_item'));
                                        }
                                        ?>

                                        <div class="form-group<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                            <label for="inputEmail3" class="control-label">Item</label>
                                            <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Item ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : '')]) ?>
                                        </div>
                                        <?php if (!empty($SQLItem)) { ?>
                                            <div class="form-group<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                                <label for="inputEmail3" class="control-label">SKU</label>
                                                <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => $SQLItem->kode, 'readonly' => 'true']) ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                                                        <label for="inputEmail3" class="control-label">Jml</label>
                                                        <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Jml ...']) ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="inputEmail3" class="control-label">Satuan</label>
                                                    <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                                        <option value="">- Pilih -</option>
                                                        <?php foreach ($SQLSatuan as $satuan) { ?>
                                                            <option value="<?php echo $satuan->id ?>"><?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
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
            <?php if (!empty($SQLPsn)) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Item box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA ITEM</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">No. PO</label>
                                            <div class="col-sm-8">
                                                <?php echo form_input(['name' => 'no_po', 'class' => 'form-control rounded-0 pull-right', 'value' => $SQLPsn->no_po, 'readonly' => 'TRUE']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Supplier</label>
                                            <div class="col-sm-8">
                                                <?php echo form_input(['name' => 'supplier', 'class' => 'form-control rounded-0 pull-right', 'value' => $SQLSupp->nama, 'readonly' => 'TRUE']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <?php echo form_input(['name' => 'alamat', 'class' => 'form-control rounded-0 pull-right', 'value' => $SQLSupp->alamat, 'readonly' => 'TRUE']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Pengiriman</label>
                                            <div class="col-sm-8">
                                                <?php echo form_input(['name' => 'pengiriman', 'class' => 'form-control rounded-0 pull-right', 'value' => $SQLPsn->pengiriman, 'readonly' => 'TRUE']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Tgl PO</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <?php echo form_input(['name' => 'disk3', 'class' => 'form-control rounded-0 pull-right', 'value' => tgl_indo2($SQLPsn->tgl_masuk), 'readonly' => 'TRUE']) ?>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <th class="text-left">Keterangan</th>
                                                </tr>                                    
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($SQLPsnDet)) { ?>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($SQLPsnDet as $det) { ?>
                                                        <tr>
                                                            <td class="text-right" style="width: 50px;">
                                                                <?php if(!hakAdminM()) : ?>
                                                                <?php echo anchor(base_url('pembelian/pesanan/cart_hapus.php?id=' . $request->getVar('id') . '&id_item=' . $det->id), '<i class="fas fa-trash"></i>', 'class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Hapus [' . $det->item . '] ?\')"') ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-center" style="width: 100px;"><?php echo $no; ?></td>
                                                            <td class="text-left" style="width: 350px;"><?php echo $det->item; ?></td>
                                                            <td class="text-center" style="width: 150px;"><?php echo $det->jml . ' ' . $det->satuan ?></td>
                                                            <td class="text-right" style="width: 200px;"><?php echo $det->keterangan_itm; ?></td>
                                                        </tr>
                                                        <?php $no++; ?>
                                                    <?php } ?>
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
                                        <?php if (!empty($SQLPsnDet)) { ?>
                                            <?php echo form_open(base_url('pembelian/pesanan/set_trans_proses.php'), 'autocomplete="off"') ?>
                                            <?php echo form_hidden('id', $SQLPsn->id) ?>

                                            <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-arrow-right"></i> Proses &raquo;</button>
                                            <?php echo form_close() ?>
                                        <?php } ?>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <!-- /.card -->
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
        $('input[id=harga],input[id=jml]').autoNumeric({aSep: '.', aDec: ',', aPad: false});
        $("#tgl").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });
        <?php echo session()->getFlashdata('pembelian_toast'); ?>

        // Data Supplier
        $('#supplier').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo base_url('/json_supplier.php') ?>",
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

<?php if (!empty($SQLPsn)) { ?>
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
                    window.location.href = "<?php echo base_url('pembelian/pesanan/data_pesanan_tambah.php?id=' . $request->getVar('id')) ?>&id_item=" + ui.item.id;

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