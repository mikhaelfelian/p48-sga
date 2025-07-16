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
                    <h1 class="m-0">Data Karyawan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
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
                            <h3 class="card-title">Data Karyawan</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $uri        = substr($url->getSegment(2), 5, -4);
                                $kode        = $request->getVar('filter_kode');
                                $nama        = $request->getVar('filter_nama');
                                
                                $uri_xls    = base_url('master/xls_karyawan.php?'.(!empty($kode) ? 'filter_kode='.$kode.'&' : '').(!empty($nama) ? 'filter_nama='.$nama : ''));
                            ?>
                            <button class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo $uri_xls ?>'"><i class="fas fa-file-excel"></i> Data Karyawan</button>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('master/karyawan_set_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan kode ...']) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan nama ...']) ?>
                                        </th>
                                        <td></td>
                                        <th>
                                            <button class="btn btn-primary btn-flat" style="width: 120px;">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </th>
                                    </tr>
                                    <?php echo form_close(); ?>
                                    <?php
                                    if (!empty($SQLKary)) {
                                        $no = $Halaman;
                                        foreach ($SQLKary as $karyawan) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 250px;"><?php echo $karyawan->kode ?></td>
                                                <td style="width: 450px;"><?php echo format_nama($karyawan->nama) ?></td>
                                                <td style="width: 450px;"><?php echo $karyawan->alamat ?></td>
                                                <td style="width: 150px;">
                                                    <?php // if (akses::hakSA() == TRUE || akses::hakOwner() == TRUE || akses::hakAdminM() == TRUE) { ?>
                                                    <?php // echo nbs() ?>
                                                    <?php echo anchor(base_url('master/karyawan_tambah.php?id='.$karyawan->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                    &nbsp;
                                                    <?php if(!hakAdminM()) : ?>
                                                    <?php echo anchor(base_url('master/karyawan_set_hapus.php?id='.$karyawan->id_user.(isset($_GET['page']) ? '&page='.$request->getVar('page') : '')), '<i class="fas fa-trash"></i> Hapus', 'onclick="return confirm(\'Hapus [' . $karyawan->nama . '] ? \')" class="btn btn-danger btn-flat btn-xs" style="width: 55px;"') ?>
                                                    <?php endif; ?>
                                                    <?php // } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- FOOTER TABLE - PAGINATION -->
                            <div class="d-flex justify-content-end mt-3">
                            <?php echo (!empty($Pagination) ? $Pagination : ''); ?>
                        </div>
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