<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pembayaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Pembayaran</li>
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
                            <h3 class="card-title">Data Penjualan</h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>No. Nota</th>
                                        <th>Customer</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('transaksi/set_trans_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'no_nota', 'name' => 'no_nota', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'pelanggan', 'name' => 'item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
                                        </th>
                                        <th></th>
                                        <th>
                                            <button class="btn btn-primary btn-flat" style="width: 120px;">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </th>
                                    </tr>
                                    <?php echo form_close(); ?>
                                    <?php
                                    if (!empty($SQLPenj)) {
                                        $no = $Halaman;
                                        foreach ($SQLPenj as $det) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <?php echo $det->no_nota ?><br/>
                                                    <small><?php echo tgl_indo5($det->tgl_simpan) ?></small><br/>
                                                    <?php echo status_rab($det->status) ?><br/>
                                                </td>
                                                <td style="width: 450px;">
                                                    <?php echo $det->p_nama ?><br/>
                                                    <?php echo $det->p_alamat ?><br/>
                                                </td>
                                                <td style="width: 50px;"><?php // echo $det->keterangan  ?></td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('transaksi/data_pembayaran_tambah.php?id='.$det->id), '<i class="fa fa-shopping-cart"></i> Bayar &raquo;', 'class="btn btn-warning btn-flat btn-xs" style="width: 75px;"') ?>                                                   
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
<script type="text/javascript">
    $(function () {
        <?php echo session()->getFlashdata('transaksi_toast'); ?>
    });
</script>