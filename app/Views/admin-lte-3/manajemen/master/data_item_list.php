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
                    <h1 class="m-0">Data Item</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item active">Data Item</li>
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
                            <?php
                                $uri        = substr($url->getSegment(2), 5, -4);
                                $itm        = $request->getVar('filter_item');
                                $kat        = $request->getVar('filter_kat');
                                
                                $uri_xls    = base_url('master/xls_'.$uri.'.php?'.(!empty($itm) ? 'filter_item='.$itm.'&' : '').(!empty($kat) ? 'filter_kat='.$kat : ''));
                            ?>
                            <button class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo $uri_xls ?>'"><i class="fas fa-file-excel"></i> Data Item</button>
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kategori</th>
                                        <th>Item</th>
                                        <th>Harga</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('master/set_item_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php // echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
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
                                    if (!empty($SQLItem)) {
                                        $page = (int)($request->getVar('page') ?? 1); // ambil nomor halaman dari request
                                        $perPage = $PerPage; // sesuaikan jumlah per halaman
                                        $start = ($page - 1) * $perPage;
                                        foreach ($SQLItem as $index => $item) {
                                            $no = $start + $index + 1;

                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;"><?php echo strtoupper($item->kategori) ?></td>
                                                <td style="width: 450px;">
                                                    <i><b>Kode : <?php echo $item->kode ?></b></i>
                                                    <br/><b>Merk : </b><?php echo (!empty($item->merk) ? $item->merk.' ' : '') ?>
                                                    <br/><b>Item : </b><?=ucwords($item->item);?>
                                                    <br/><small><?php echo $item->keterangan ?></small>
                                                </td>
                                                <td style="width: 150px;">
                                                    <small>Harga Beli : Rp. <?php echo format_angka($item->harga_beli, 0) ?></small>
                                                    <br>
                                                    <small>Harga Jual : Rp. <?php echo format_angka($item->harga_jual, 0) ?></small>
                                                </td>
                                                <td style="width: 150px;">
                                                    <?php if(!hakAdminPO()) : ?>
                                                    <?php // if (akses::hakSA() == TRUE || akses::hakOwner() == TRUE || akses::hakAdminM() == TRUE) { ?>
                                                    <?php // echo nbs() ?>
                                                    <?php echo anchor(base_url('master/data_item_tambah.php?id='.$item->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                    &nbsp;
                                                    <?php if(!hakAdminM()) : ?>
                                                    <?php echo anchor(base_url('master/set_item_hapus.php?id='.$item->id.(isset($_GET['page']) ? '&page='.$request->getVar('page') : '')), '<i class="fas fa-trash"></i> Hapus', 'onclick="return confirm(\'Hapus [' . (!empty($item->merk) ? $item->merk.' ' : '').ucwords($item->item) . '] ? \')" class="btn btn-danger btn-flat btn-xs" style="width: 55px;"') ?>
                                                    <?php endif; ?>
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