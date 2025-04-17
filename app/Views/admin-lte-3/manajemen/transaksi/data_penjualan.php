<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Penjualan</li>
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
                                    <?php echo form_open(base_url('transaksi/data_penjualan.php'), ['method' => 'GET']) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'no_nota', 'name' => 'no_nota', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'No. Nota...', 'value' => $request->getGet('no_nota')]) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'pelanggan', 'name' => 'pelanggan', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Customer...', 'value' => $request->getGet('pelanggan')]) ?>
                                        </th>
                                        <th>
                                            <?php 
                                            $status_options = [
                                                '' => 'Semua',
                                                '1' => 'Lunas',
                                                '0' => 'Belum'
                                            ];
                                            echo form_dropdown('status_bayar', $status_options, $request->getGet('status_bayar'), 'class="form-control input-sm rounded-0"');
                                            ?>
                                        </th>
                                        <th>
                                            <button type="submit" class="btn btn-primary btn-flat" style="width: 120px;">
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
                                                    <?php echo status_penj($det->status) ?>
                                                </td>
                                                <td style="width: 450px;">
                                                    <?php echo $det->p_nama ?>
                                                    <?php echo br().$det->p_alamat ?>                                                  
                                                    <?php echo br().status_penj_rab($det->id_rab) ?>
                                                </td>
                                                <td style="width: 50px;"><?php // echo $det->keterangan  ?></td>
                                                <td style="width: 150px;">
                                                    <a class="btn btn-primary btn-sm" href="<?php echo base_url('transaksi/data_penjualan_aksi.php?id='.$det->id) ?>">
                                                        <i class="fas fa-folder"></i> 
                                                        Aksi
                                                        &raquo;
                                                    </a>
                                                    <?php echo br().status_bayar($det->status_bayar) ?>                                               
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