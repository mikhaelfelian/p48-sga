<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

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
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Laporan</a></li>
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
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Laporan</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo (!empty($psnGagal['perusahaan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Perusahaan*</label>
                                        <select name="perusahaan" class="form-control rounded-0<?php echo (!empty($psnGagal['perusahaan']) ? ' is-invalid' : '') ?>">
                                            <option value="">- Pilih Perusahaan -</option>
                                            <?php foreach ($SQLProfile as $profile) { ?>
                                                <option value="<?php echo $profile->id ?>"><?php echo strtoupper($profile->nama) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['tipe']) ? ' text-danger' : '') ?>">
                                        <label class="control-label">Tipe RAB*</label>
                                        <select name="tipe" class="form-control rounded-0<?php echo (!empty($psnGagal['tipe']) ? ' is-invalid' : '') ?>">
                                            <option value="">- Tipe RAB -</option>
                                            <?php foreach ($SQLTipe as $tipe) { ?>
                                                <option value="<?php echo $tipe->id ?>"><?php echo strtoupper($tipe->tipe) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(array('id' => 'tgl', 'name' => 'tgl', 'class' => 'form-control text-middle rounded-0' . (!empty($hasError['pasien']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => '02/15/2022 ...', 'value' => (isset($_GET['tgl']) ? $this->tanggalan->tgl_indo($_GET['tgl']) : ''))) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Rentang</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(array('id' => 'tgl_rentang', 'name' => 'tgl_rentang', 'class' => 'form-control text-middle rounded-0' . (!empty($hasError['pasien']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => '02/15/2022 - 02/15/2022 ...', 'value' => (isset($_GET['tgl_awal']) ? $this->tanggalan->tgl_indo2($_GET['tgl_awal']) : ''))) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select name="status" class="form-control rounded-0">
                                            <option value="">- Semua -</option>
                                            <option value="">ACC</option>
                                            <option value="">TIDAK ACC</option>
                                            <option value="">MENANG</option>
                                            <option value="">KALAH</option>
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Sales</label>
                                        <select name="sales" class="form-control rounded-0">
                                            <option value="">- Semua -</option>
                                            <?php foreach ($SQLUsers as $user) { ?>
                                                <option value="<?php echo $user->id ?>"<?php echo ($user->id == $Pengguna->id ? ' selected' : '') ?>><?php echo strtoupper($user->first_name) ?></option>
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
                    </div>
                </div>
            </div>
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
                                        <th class="text-center">No.</th>
                                        <th>Kode</th>
                                        <th>Customer</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($SQLRab)) {
                                        $no = $Halaman;
                                        foreach ($SQLRab as $det) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('transaksi/rab/data_rab_det.php?id=' . $det->id), $det->no_rab) ?><br/>
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
        $('#tgl_rentang').daterangepicker({
            locale: {
                format: 'MM/DD/YYYY'
            }
        });
        
        <?php echo session()->getFlashdata('laporan_toast'); ?>
    });
</script>