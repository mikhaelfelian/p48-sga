<?php $request = \Config\Services::request(); ?>
<?php 
$request    = \Config\Services::request();
$url        = new \CodeIgniter\HTTP\URI(current_url(true));
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Merk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item active">Merk</li>
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
                            <h3 class="card-title">Data Merk</h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $uri        = substr($url->getSegment(2), 5, -4);
                                $kode        = $request->getVar('filter_kode');
                                $merk        = $request->getVar('filter_merk');
                                
                                $uri_xls    = base_url('master/xls_'.$uri.'.php?'.(!empty($kode) ? 'filter_kode='.$kode.'&' : '').(!empty($merk) ? 'filter_merk='.$merk : ''));
                            ?>
                            <button class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo $uri_xls ?>'"><i class="fas fa-file-excel"></i> Data MERK</button>
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kode</th>
                                        <th>Merk</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('master/set_merk_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan kode ...']) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'merk', 'name' => 'merk', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan keterangan ...']) ?>
                                        </th>
                                        <th>
                                            <button class="btn btn-primary btn-flat" style="width: 120px;">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </th>
                                    </tr>
                                    <?php echo form_close(); ?>
                                    <?php
                                    if (!empty($SQLMerk)) {
                                        $no = $Halaman;
                                        foreach ($SQLMerk as $merk) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 250px;"><?php echo $merk->kode ?></td>
                                                <td style="width: 450px;"><?php echo $merk->merk ?></td>
                                                <td style="width: 150px;">
                                                    <?php if(!hakAdminPO()) : ?>
                                                    <?php // if (akses::hakSA() == TRUE || akses::hakOwner() == TRUE || akses::hakAdminM() == TRUE) { ?>
                                                    <?php // echo nbs() ?>
                                                    <?php echo anchor(base_url('master/data_merk_tambah.php?id='.$merk->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                    &nbsp;
                                                    <?php if(!hakAdminM()) : ?>
                                                    <?php echo anchor(base_url('master/data_merk_hapus.php?id='.$merk->id.(isset($_GET['page']) ? '&page='.$request->getVar('page') : '')), '<i class="fas fa-trash"></i> Hapus', 'onclick="return confirm(\'Hapus [' . $merk->merk . '] ? \')" class="btn btn-danger btn-flat btn-xs" style="width: 55px;"') ?>
                                                    <?php endif ?>
                                                    <?php // } ?>
                                                    <?php endif; ?>
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