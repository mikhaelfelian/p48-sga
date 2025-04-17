<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

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
                        <li class="breadcrumb-item"><a href="<?php echo base_url('laporan') ?>">Laporan</a></li>
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
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Laporan</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <?php echo form_open(current_url(), ['method' => 'get']); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['perusahaan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Perusahaan*</label>
                                        <select name="filter_perusahaan" class="form-control rounded-0<?php echo (!empty($psnGagal['perusahaan']) ? ' is-invalid' : '') ?>" value="<?php echo request()->getVar('filter_perusahaan') ?>">
                                            <option value="">- Pilih Perusahaan -</option>
                                            <?php foreach ($SQLProfile as $profile) { ?>
                                                <option value="<?php echo $profile->id ?>" <?php echo (request()->getVar('filter_perusahaan') == $profile->id ? 'selected' : '') ?>><?php echo strtoupper($profile->nama) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(array('id' => 'tgl', 'name' => 'filter_tgl', 'class' => 'form-control text-middle rounded-0', 'style' => 'vertical-align: middle;', 'placeholder' => '02/15/2022 ...', 'value' => request()->getVar('filter_tgl'))) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Rentang</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(array('id' => 'tgl_rentang', 'name' => 'filter_tgl_rentang', 'class' => 'form-control text-middle rounded-0', 'style' => 'vertical-align: middle;', 'placeholder' => '02/15/2022 - 02/15/2022 ...', 'value' => request()->getVar('filter_tgl_rentang'))) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Sales</label>
                                        <select name="filter_sales" class="form-control rounded-0">
                                            <option value="">- Semua -</option>
                                            <?php foreach ($SQLUsers as $user) { ?>
                                                <option value="<?php echo $user->id ?>" <?php echo (request()->getVar('filter_sales') == $user->id ? 'selected' : '') ?>><?php echo strtoupper($user->first_name) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Cari</button>
                                </div>
                            </div> 
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Penjualan</h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                                <a href="<?php echo base_url('laporan/export_penjualan?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>No. Nota</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($SQLPenjualan)) {
                                        $no = $Halaman;
                                        foreach ($SQLPenjualan as $det) {
                                            $user = $ionAuth->user($det->id_user)->row();
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('transaksi/penjualan/data_penjualan_det.php?id=' . $det->id), $det->no_nota) ?><br/>
                                                    <small><?php echo tgl_indo5($det->tgl_simpan) ?></small><br/>
                                                    <small><i><?php echo strtolower($user->username) ?></i></small><br/>
                                                </td>
                                                <td style="width: 450px;">
                                                    <?php echo $det->p_nama ?><br/>
                                                    <?php echo $det->p_alamat ?><br/>
                                                    <?php if ($det->jml_gtotal > 0) { ?>
                                                        <small><i><b>Rp. <?php echo format_angka($det->jml_gtotal); ?></b></i></small>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-right">
                                                    Rp. <?php echo format_angka($det->jml_gtotal); ?>
                                                </td>
                                                <td>
                                                    <?php echo status_penj($det->status) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $sales = $ionAuth->user($det->id_sales)->row();
                                                    echo $sales->first_name . ' ' . $sales->last_name;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data penjualan</td>
                                        </tr>
                                        <?php
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
        $('#tgl_rentang').daterangepicker({
            locale: {
                format: 'MM/DD/YYYY'
            }
        });
        
        <?php echo session()->getFlashdata('laporan_toast'); ?>
    });
</script> 