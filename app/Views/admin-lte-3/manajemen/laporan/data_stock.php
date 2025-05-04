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
                    <h1 class="m-0">Data Stok</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('master') ?>">Master Data</a></li>
                        <li class="breadcrumb-item active">Data Stok</li>
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
                                <a href="<?php echo base_url('laporan/export_stock?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </a>
                                <a href="<?php echo base_url('laporan/pdf_stock?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Kategori</th>
                                        <th>Item</th>
                                        <th>Stok</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(current_url(), ['method' => 'get']); ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <select name="filter_kategory" class="form-control rounded-0">
                                                <option value="">- Semua -</option>
                                                <?php foreach ($SQLKategori as $kat) { ?>
                                                    <option value="<?php echo $kat['id'] ?>" <?php echo (request()->getVar('filter_kategory') == $kat['id'] ? 'selected' : '') ?>><?php echo strtoupper($kat['kategori']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'filter_item', 'name' => 'filter_item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan item ...']) ?>
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
                                        $no = $Halaman;
                                        foreach ($SQLItem as $item) {
                                    ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;"><?php echo strtoupper($item->kategori) ?></td>
                                                <td style="width: 450px;">
                                                    <i><b><?php echo $item->kode ?></b></i>
                                                    <br /><?php echo (!empty($item->merk) ? $item->merk . ' ' : '') . ucwords($item->item) ?>
                                                    <br /><small><?php echo $item->keterangan ?></small>
                                                </td>
                                                <td style="width: 50px;"><?php echo format_angka($item->jml, 0) ?></td>
                                                <td style="width: 150px;">
                                                    <?php echo anchor(base_url('gudang/stok/data_item_det.php?id=' . $item->id), '<i class="fa fa-box-open"></i> Lihat', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
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
    $(function() {
        <?php echo session()->getFlashdata('master_toast'); ?>
    });
</script>