<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Pesanan</li>
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
                            <h3 class="card-title">Form Pesanan</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
                                    <?php echo form_open(base_url('transaksi/pesanan/set_trans_simpan.php'), 'autocomplete="off"') ?>
                                    <input type="hidden" id="id_pelanggan" name="id_pelanggan">

                                    <div class="form-group <?php echo (!empty($psnGagal['id_pelanggan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Pelanggan*</label>
                                        <?php echo form_input(['id'=>'pelanggan', 'name'=>'pelanggan', 'class'=>'form-control rounded-0 text-middle' . (!empty($psnGagal['id_pelanggan']) ? ' is-invalid' : ''), 'style'=>'vertical-align: middle;', 'placeholder'=>'Isikan Pelanggan ...', 'value'=>'']) ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Catatan</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_textarea(['id'=>'keterangan', 'name'=>'keterangan', 'class'=>'form-control rounded-0', 'placeholder'=>'Isikan catatan pesanan ...']) ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-danger btn-flat" onclick="window.location.href = '<?php echo base_url('transaksi/pesanan/set_pesanan_batal.php?id=') ?>'"><i class="fa fa-remove"></i> Batal</button>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-shopping-cart"></i> Set Pesanan</button>
                                        </div>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>
                                <div class="col-md-6">
                                    <?php if (!empty($SQLPsn)) { ?>
                                        <?php echo form_open(base_url('transaksi/pesanan/cart_simpan.php'), 'autocomplete="off"') ?>
                                        <?php // echo form_open(base_url('transaksi/pesanan/cart_'.(!empty($SQLPsnDetRw) ? 'update' : 'simpan').'.php'), 'autocomplete="off"') ?>
                                        <?php 
                                            echo form_hidden('id_pesanan', $request->getVar('id'));                                            
                                            if(!empty($SQLPsnDetRw)){
                                                echo form_hidden('id_pesanan_det', $request->getVar('id_item'));
                                            }
                                        ?>
                                    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group <?php echo (!empty($psnGagal['item']) ? 'text-danger' : '') ?>">
                                                    <label class="control-label">Item*</label>
                                                    <?php echo form_input(['id'=>'item', 'name'=>'item', 'class'=>'form-control rounded-0 text-middle' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'style'=>'vertical-align: middle;', 'placeholder'=>'Isikan Item ...', 'value'=>(!empty($SQLPsnDetRw->pesanan) ? $SQLPsnDetRw->pesanan : '')]) ?>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group <?php echo (!empty($psnGagal['jml']) ? 'text-danger' : '') ?>">
                                                    <label class="control-label">Jml*</label>
                                                    <?php echo form_input(['id'=>'jml', 'name'=>'jml', 'class'=>'form-control rounded-0 pull-right' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder'=>'Isikan Jml ...', 'value'=>(!empty($SQLPsnDetRw->jml_pesanan) ? $SQLPsnDetRw->jml_pesanan : '')]) ?>
                                                </div>                                            
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group <?php echo (!empty($psnGagal['satuan']) ? 'text-danger' : '') ?>">
                                                    <label class="control-label">Satuan*</label>
                                                    <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                                        <option value="">- Pilih -</option>
                                                        <?php foreach ($SQLSatuan as $satuan) { ?>
                                                            <option value="<?php echo $satuan->id ?>"<?php echo (!empty($SQLPsnDetRw->id_satuan_pesanan) ? ($satuan->id == $SQLPsnDetRw->id_satuan_pesanan ? ' selected' : '') : '') ?>><?php echo strtoupper($satuan->satuanBesar) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>                                           
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group <?php echo (!empty($psnGagal['pagu']) ? 'text-danger' : '') ?>">
                                                    <label class="control-label">Pagu per unit</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <?php echo form_input(['id'=>'pagu', 'name'=>'pagu', 'class'=>'form-control rounded-0 pull-right' . (!empty($psnGagal['pagu']) ? ' is-invalid' : ''), 'placeholder'=>'Isikan Pagu Anggaran ...', 'value'=>(!empty($SQLPsnDetRw->pagu) ? $SQLPsnDetRw->pagu : '')]) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-shopping-cart"></i> Simpan</button>
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
            <div class="row">
                <?php if (!empty($SQLPsn)) { ?>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Data Item Pesanan</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-right">

                                    </ul>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                                <tr>
                                                    <th>Nama Pelanggan</th>
                                                    <th>:</th>
                                                    <td><?php echo ucwords($SQLPlgn->nama) ?></td>

                                                    <th>Tgl Pesanan</th>
                                                    <th>:</th>
                                                    <td><?php echo tgl_indo5($SQLPsn->tgl_simpan) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No. Pesanan</th>
                                                    <th>:</th>
                                                    <td><?php echo strtoupper($SQLPsn->no_nota) ?></td>

                                                    <th></th>
                                                    <th></th>
                                                    <td></td>
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
                                                    <th class="text-left">Pesanan</th>
                                                    <th class="text-center">Jml</th>
                                                    <th class="text-right">Pagu</th>
                                                    <th class="text-right"></th>
                                                </tr>                                    
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($SQLPsnDet)) { ?>
                                                    <?php $no = 1; $subtotal = 0; ?>
                                                    <?php foreach ($SQLPsnDet as $cart) { ?>
                                                    <?php $subtotal = $subtotal + ($cart->pagu * $cart->jml_pesanan); ?>
                                                        <tr>
                                                            <td class="text-right" style="width: 50px;">
                                                                <?php 
                                                                    if($SQLPsn->status == 0){
                                                                        echo anchor(base_url('transaksi/pesanan/cart_hapus.php?id='.$cart->id_pesanan.'&id_item='.$cart->id), '<i class="fas fa-trash"></i>', 'class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Hapus [' . $cart->pesanan . '] ?\')"');
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="text-center"><?php echo $no; ?></td>
                                                            <td class="text-left">
                                                                <?php echo $cart->pesanan; ?>
                                                            </td>
                                                            <td class="text-center"><?php echo (float)$cart->jml_pesanan; ?></td>
                                                            <td class="text-right"><?php echo format_angka($cart->pagu); ?></td>
                                                            <td class="text-left"><?php echo anchor(base_url('transaksi/pesanan/data_pesanan_tambah.php?id='.$request->getVar('id').'&id_item='.$cart->id.'&id_satuan='.$cart->id_satuan.'&pagu='.(float)$cart->pagu.'&qty='.(float)$cart->jml_pesanan), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?></td>
                                                        </tr>
                                                        <?php $no++; ?>
                                                    <?php } ?>
                                                    <tr>
                                                        <th class="text-right" colspan="4">Total</th>
                                                        <th class="text-right"><?php echo format_angka($subtotal); ?></th>
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
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 text-right">
                                        <?php if (!empty($SQLPsnDet)) { ?>
                                            <?php echo form_open(base_url('transaksi/pesanan/set_trans_proses.php'), 'autocomplete="off"') ?>
                                            <?php echo form_hidden('id_pesanan', $SQLPsn->id) ?>
                                            <?php echo form_hidden('status', '1') ?>

                                            <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-arrow-right"></i> Kirim ke PM &raquo;</button>
                                            <?php echo form_close() ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        $('input[id=pagu]').autoNumeric({aSep: '.', aDec: ',', aPad: false});

        // Data Pelanggan
        $('#pelanggan').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo base_url('transaksi/json_pelanggan.php') ?>",
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
                $itemrow.find('#id_pelanggan').val(ui.item.id);
                $('#id_pelanggan').val(ui.item.id);
                $('#pelanggan').val(ui.item.nama);

                // Give focus to the next input field to recieve input from user
                $('#pelanggan').focus();
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
    //            // Data Item
    //            $('#item').autocomplete({
    //                source: function (request, response) {
    //                    $.ajax({
    //                        url: "<?php // echo base_url('transaksi/json_item.php')  ?>",
    //                        dataType: "json",
    //                        data: {
    //                            term: request.term
    //                        },
    //                        success: function (data) {
    //                            response(data);
    //                        }
    //                    });
    //                },
    //                minLength: 1,
    //                select: function (event, ui) {
    //                    var $itemrow = $(this).closest('tr');
    //                    //Populate the input fields from the returned values
    //                    $itemrow.find('#id_item').val(ui.item.id);
    //                    $('#id_item').val(ui.item.id);
    //                    $('#item').val(ui.item.nama);
    //                    window.location.href = "<?php // echo base_url('transaksi/pesanan/data_pesanan_tambah.php?id=' . $request->getVar('id'))  ?>&id_item=" + ui.item.id;
    //
    //                    // Give focus to the next input field to recieve input from user
    //                    $('#item').focus();
    //                    return false;
    //                }
    //
    //                // Format the list menu output of the autocomplete
    //            }).data("ui-autocomplete")._renderItem = function (ul, item) {
    //                return $("<li></li>")
    //                        .data("item.autocomplete", item)
    //                        .append("<a>" + item.nama + "</a>")
    //                        .appendTo(ul);
    //            };
<?php } ?>

<?php echo session()->getFlashdata('transaksi_toast'); ?>
    });
</script>