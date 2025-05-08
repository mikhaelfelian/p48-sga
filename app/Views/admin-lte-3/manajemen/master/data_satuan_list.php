<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Satuan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item active">Satuan</li>
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
                            <h3 class="card-title">Data Satuan</h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Satuan</th>
                                        <th>Satuan Besar</th>
                                        <th>Jml</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('master/set_satuan_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'satuan', 'name' => 'satuan', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan satuan ...']) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'satuanBesar', 'name' => 'satuanBesar', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan satuan ...']) ?>
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
                                    if (!empty($SQLSatuan)) {
                                        $no = $Halaman;
                                        foreach ($SQLSatuan as $satuan) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;"><?php echo $satuan->satuanTerkecil ?></td>
                                                <td style="width: 150px;"><?php echo $satuan->satuanBesar ?></td>
                                                <td style="width: 50px;"><?php echo (float)$satuan->jml ?></td>
                                                <td style="width: 150px;">
                                                    <?php // if (akses::hakSA() == TRUE || akses::hakOwner() == TRUE || akses::hakAdminM() == TRUE) { ?>
                                                    <?php // echo nbs() ?>
                                                    <?php echo anchor(base_url('master/data_satuan_tambah.php?id='.$satuan->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                    &nbsp;
                                                    <?php if(!hakAdminM()) : ?>
                                                    <?php echo anchor(base_url('master/set_satuan_hapus.php?id='.$satuan->id.(isset($_GET['page']) ? '&page='.$request->getVar('page') : '')), '<i class="fas fa-trash"></i> Hapus', 'onclick="return confirm(\'Hapus [' . $satuan->satuanTerkecil . '] ? \')" class="btn btn-danger btn-flat btn-xs" style="width: 55px;"') ?>
                                                    <?php endif ?>
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