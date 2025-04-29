<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Purchase Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Purchase Invoice</li>
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
                                        <th>No. PI</th>
                                        <th>Supplier</th>
                                        <th>Tgl Tempo</th>
                                        <th class="text-right">Nominal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // echo form_open(base_url('master/set_item_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
                                        </th>
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
                                    if (!empty($SQLBeli)) {
                                        $no = $Halaman;
                                        foreach ($SQLBeli as $det) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('pembelian/faktur/data_pembelian_det.php?id='.$det->id), $det->no_nota, 'class="text-default"') ?><br/>
                                                    <span class="mailbox-read-time float-left"><?php echo tgl_indo5($det->tgl_simpan) ?></span>
                                                </td>
                                                <td style="width: 450px;">
                                                    <b><?php echo $det->supplier ?></b><br/>
                                                    <small><i><?php echo $det->npwp; ?></i></small><br/>
                                                    <small><i><?php echo $det->alamat; ?></i></small><br/>
                                                    <small><i><b><?php echo $det->no_telp.(!empty($det->cp) ? ' '.$det->cp : ''); ?></b></i></small>
                                                </td>
                                                <td style="width: 100px;"><?php echo tgl_indo2($det->tgl_keluar) ?></td>
                                                <td class="text-right" style="width: 150px;"><?php echo format_angka($det->jml_gtotal) ?></td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('pembelian/faktur/data_pembayaran_tambah.php?id='.$det->id), '<i class="fa fa-shopping-cart"></i> Bayar', 'class="btn btn-warning btn-flat btn-xs" style="width: 65px;"') ?>                                                   
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
        <?php echo session()->getFlashdata('pembelian_toast'); ?>
    });
</script>