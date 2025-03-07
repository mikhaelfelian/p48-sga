<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data RAB</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Rab</li>
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
                            <h3 class="card-title">Data Item</h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">No.</th>
                                        <th>Kode</th>
                                        <th>Customer</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('transaksi/rab/set_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'no_rab', 'name' => 'no_rab', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan no rab ...']) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan pelanggan ...']) ?>
                                        </th>
                                        <th>
                                            <select name="tipe" class="form-control rounded-0">
                                                <option value="">- [Tipe Pengadaan] -</option>
                                                <?php foreach ($SQLTipe as $tipe) { ?>
                                                    <option value="<?php echo $tipe->id ?>"><?php echo $tipe->tipe ?></option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                        <th>
                                            <button class="btn btn-primary btn-flat" style="width: 120px;">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </th>
                                    </tr>
                                    <?php echo form_close(); ?>
                                    <?php
                                    if (!empty($SQLRab)) {
                                        $no = $Halaman;
                                        foreach ($SQLRab as $det) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center">
                                                    <?php
                                                    if (hakSA() == TRUE OR hakOwner() == TRUE) {
                                                        if ($det->status == '0') {
                                                            echo anchor(base_url('transaksi/rab/hapus.php?id=' . $det->id), '<i class="fas fa-trash"></i>', 'class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus [' . $det->no_rab . '] ?\')"');
                                                        }
                                                    } else {
                                                        if ($det->status == '0') {
                                                            if ($det->id_user == $Pengguna->id) {
                                                                echo anchor(base_url('transaksi/rab/hapus.php?id=' . $det->id), '<i class="fas fa-trash"></i>', 'class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus [' . $det->no_rab . '] ?\')"');
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('transaksi/rab/data_rab_det.php?id='.$det->id), $det->no_rab) ?><br/>
                                                    <small><?php echo tgl_indo5($det->tgl_simpan) ?></small><br/>
                                                    <small><b><?php echo $det->tipe ?></b></small><br/>
                                                    <?php echo status_rab($det->status) ?><br/>
                                                    <small><i><?php echo strtolower($det->username) ?></i></small><br/>
                                                </td>
                                                <td style="width: 450px;" colspan="2">
                                                    <?php echo $det->p_nama ?><br/>
                                                    <?php echo $det->p_alamat ?><br/>
                                                    <?php if ($det->jml_gtotal > 0) { ?>
                                                        <small><i><b>Rp. <?php echo format_angka($det->jml_gtotal); ?></b></i></small>
                                                    <?php } ?>
                                                    <?php if (!empty($det->c_nama)) { ?>
                                                        <?php echo br(); ?>
                                                        <small><b>[<?php echo $det->c_nama; ?>]</b></small>
                                                    <?php } ?>
                                                </td>
                                                <td style="width: 150px;">
                                                    <a class="btn btn-primary btn-sm" href="<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $det->id) ?>">
                                                        <i class="fas fa-folder"></i> 
                                                        Aksi
                                                        &raquo;
                                                    </a>
                                                    <?php if ($det->status == '1') { ?>
                                                        <?php // echo anchor(base_url('transaksi/pesanan/data_pesanan_jawab.php?id='.$det->id), '<i class="fa fa-reply"></i> Jawab PM', 'class="btn btn-info btn-flat btn-xs" style="width: 75px;"') ?>
                                                    <?php } else { ?>
                                                        <?php // echo anchor(base_url('transaksi/pesanan/data_pesanan_tambah.php?id='.$det->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                    <?php } ?>                                                    
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