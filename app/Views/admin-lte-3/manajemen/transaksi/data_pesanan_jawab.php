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
                            <div class="card-body">
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
                                                            <td class="text-left"><?php echo anchor(base_url('transaksi/pesanan/data_pesanan_tambah.php?id='.$request->getVar('id').'&id_item='.$cart->id.'&id_satuan='.$cart->id_satuan.'&pagu='.(float)$cart->pagu.'&qty='.(float)$cart->jml_pesanan), '<i class="fa fa-edit"></i> Jawab', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?></td>
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
                                            <?php echo form_hidden('status', '2') ?>

                                            <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-arrow-right"></i> Kirim ke Sales &raquo;</button>
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