<?php 
$request = \Config\Services::request();
model('trPO');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengiriman</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('gudang') ?>">Gudang</a></li>
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
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>No. DO</th>
                                        <th>Kepada</th>
                                        <th>Tanggal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // echo form_open(base_url('gudang/mutasi/set_mutasi_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <button class="btn btn-primary btn-flat" style="width: 120px;">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </th>
                                    </tr>
                                    <?php // echo form_close(); ?>
                                    <?php
                                    if (!empty($SQLMutasi)) {
                                        $no = $Halaman;
                                        foreach ($SQLMutasi as $det) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('gudang/pengiriman/data_kirim_det.php?id='.$det->id), $det->no_mutasi, 'class="text-default"') ?><br/>
                                                    <span class="mailbox-read-time float-left"><?php echo tgl_indo5($det->tgl_simpan) ?></span>
                                                    <span class="mailbox-read-time float-left"><i><small><?php echo $det->user ?></small></i></span>
                                                </td>
                                                <td style="width: 450px;">
                                                    <b><?php echo $det->p_nama ?></b><br/>
                                                    <small><i><?php echo $det->no_nota.' / '.$det->sales; ?></i></small><br/>
                                                    <small><?php echo $det->c_nama; ?></small>
                                                </td>
                                                <td style="width: 100px;">
                                                    <?php echo tgl_indo2($det->tgl_masuk) ?>
                                                </td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('gudang/pengiriman/data_kirim_tambah.php?id='.$det->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-primary btn-flat btn-xs" style="width: 65px;"') ?>                                                   
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- Toastr -->
<link rel="stylesheet" href="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.css') ?>">
<script src="<?php echo base_url('assets/theme/' . $ThemePath . '/plugins/toastr/toastr.min.js') ?>"></script>

<script type="text/javascript">
    $(function () {
        // Cari data penjualan
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
        
        <?php echo session()->getFlashdata('gudang_toast'); ?>
    });
</script>