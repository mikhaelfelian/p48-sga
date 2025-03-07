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
                        <li class="breadcrumb-item active">Data Mutasi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php if(!empty($SQLMutasi)){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA PENGIRIMAN</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-left" style="width: 100px;">No. TRX</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left"><?php echo $SQLMutasi->no_nota ?></td>

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
                                        <th class="text-left" style="width: 100px;">Gd. Asal</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left"><?php echo $SQLMutasi->gd_asal ?></td>

                                        <th class="text-left" style="width: 120px;">Gd. Tujuan</th>
                                        <th class="text-center" style="width: 2px;">:</th>
                                        <td class="text-left"></td>
                                    </tr>
                                    <?php if($SQLMutasi->tipe == '3'){ ?>
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
                                            <th>No</th>
                                            <th>SN</th>
                                            <th>Item</th>
                                            <th>Jml</th>
                                            <th>Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($SQLMutasiDet as $det){ ?>
                                            <tr>
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
                                        <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href='<?php echo base_url('gudang/pengiriman/data_kirim.php'); ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href='<?php echo base_url('gudang/mutasi/pdf_mutasi_do.php?id='.$request->getVar('id')); ?>'"><i class="fas fa-print"></i> Cetak &raquo;</button>
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
        $("#3").hide().find('input').prop('disabled', true);

        $("input[id=pagu],input[id=hps]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
        $("#tgl").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });

        // Data Pelanggan
        $('#pelanggan').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo base_url('gudang/json_pelanggan.php') ?>",
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

        $('#tipe_mutasi').on('change', function () {
            var tipe_mts = $(this).val();

            $("div.divTipe").hide();
            $("#" + tipe_mts).show().find('input').prop('disabled', false);
        });

<?php if (!empty($SQLMutasi)) { ?>
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