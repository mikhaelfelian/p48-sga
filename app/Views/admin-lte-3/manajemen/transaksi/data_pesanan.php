<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pesanan</h1>
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
                            <h3 class="card-title">Data Pesanan</h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kode</th>
                                        <th>Customer</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // echo form_open(base_url('master/set_item_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php // echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
                                        </th>
                                        <th>
                                            <?php // echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
                                        </th>
                                        <th></th>
                                        <th>
                                            <button class="btn btn-primary btn-flat" style="width: 120px;">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </th>
                                    </tr>
                                    <?php // echo form_close(); ?>
                                    <?php
                                    if (!empty($SQLPsn)) {
                                        $no = $Halaman;
                                        foreach ($SQLPsn as $pesanan) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <?php echo $pesanan->no_nota ?><br/>
                                                    <small><?php echo tgl_indo5($pesanan->tgl_simpan) ?></small>
                                                </td>
                                                <td style="width: 450px;">
                                                    <?php echo $pesanan->pelanggan ?>
                                                </td>
                                                <td style="width: 50px;"><?php echo $pesanan->keterangan ?></td>
                                                <td style="width: 150px;">
                                                    <?php if ($pesanan->status == '1') { ?>
                                                        <?php echo anchor(base_url('transaksi/pesanan/data_pesanan_jawab.php?id='.$pesanan->id), '<i class="fa fa-reply"></i> Jawab PM', 'class="btn btn-info btn-flat btn-xs" style="width: 75px;"') ?>
                                                    <?php }else{ ?>
                                                        <?php echo anchor(base_url('transaksi/pesanan/data_pesanan_tambah.php?id='.$pesanan->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                    <?php } ?>
                                                    <?php // echo nbs() ?>
                                                    
                                                    &nbsp;
                                                    <?php // echo anchor(base_url('master/set_item_hapus.php?id='.$pesanan->id.(isset($_GET['page']) ? '&page='.$request->getVar('page') : '')), '<i class="fas fa-trash"></i> Hapus', 'onclick="return confirm(\'Hapus [' . (!empty($pesanan->merk) ? $pesanan->merk.' ' : '').ucwords($pesanan->item) . '] ? \')" class="btn btn-danger btn-flat btn-xs" style="width: 55px;"') ?>
                                                    <?php // } ?>
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
        <?php echo session()->getFlashdata('master_toast'); ?>
    });
</script>