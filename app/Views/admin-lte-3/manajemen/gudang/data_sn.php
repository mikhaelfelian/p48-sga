<?php 
$request = \Config\Services::request();
model('trPO');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data KODE SN</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Kode SN</li>
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
                            <h3 class="card-title">Data Kode SN</h3>
                            <div class="card-tools">
                                <a href="<?php echo base_url('gudang/stok/xls_sn.php?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </a>
                                <a href="<?php echo base_url('gudang/stok/pdf_sn.php?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <?php                                
                                $kode       = $request->getVar('filter_kode');
                                $item       = $request->getVar('filter_item');
                                $status     = $request->getVar('filter_status');
                                $keluar     = $request->getVar('filter_keluar');
    
                                
                                $uri_xls    = base_url('gudang/stok/xls_sn.php?'.(!empty($kode) ? 'filter_kode='.$kode.'&' : '').(!empty($item) ? 'filter_item='.$item.'&' : '').(!empty($status) ? 'filter_status='.$status : '').(!empty($keluar) ? 'filter_keluar='.$keluar.'&' : ''));
                            ?>
                            <button class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo $uri_xls ?>'"><i class="fas fa-file-excel"></i> Export Excel</button> -->
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Serial Number</th>
                                        <th>Item</th>
                                        <th>Gudang</th>
                                        <th>Status</th>
                                        <th>Asal Keluar</th>
                                        <th>Asal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('gudang/stok/set_sn_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'filter_kode', 'name' => 'filter_kode', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan Serial Number ...', 'value' => request()->getVar('filter_kode')])?>
                                        </th>
                                        <th>
                                            <?php echo form_input(['id' => 'filter_item', 'name' => 'filter_item', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan Item ...', 'value' => request()->getVar('filter_item')]) ?>

                                        </th>
                                        <th></th>
                                        <th>
                                            <select name="filter_status" class="form-control rounded-0">
                                                <option value="">- Semua -</option>
                                                <option value="tersedia" <?php echo (request()->getVar('filter_status') == 'tersedia' ? 'selected' : '') ?>>Tersedia</option>
                                                <option value="terpakai" <?php echo (request()->getVar('filter_status') == 'terpakai' ? 'selected' : '') ?>>Tidak Tersedia</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="filter_keluar" class="form-control rounded-0">
                                                <option value="">- Semua -</option>
                                                <option value="penjualan" <?php echo (request()->getVar('filter_keluar') == 'penjualan' ? 'selected' : '') ?>>Penjualan</option>
                                                <option value="mutasi" <?php echo (request()->getVar('filter_keluar') == 'mutasi' ? 'selected' : '') ?>>Mutasi</option>
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
                                    if (!empty($SQLItemDet)) {
                                        $no = $Halaman;
                                        foreach ($SQLItemDet as $det) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 150px;">
                                                    <b><?php echo $det->kode; ?></b>
                                                </td>
                                                <td style="width: 450px;">
                                                    <b><?php echo $det->item ?></b><br/>
                                                    <small><i><?php echo $det->item_kode; ?></i></small><br/>
                                                </td>
                                                <td style="width: 150px;">
                                                    <b><?php echo $det->gudang ?></b><br/>
                                                    <small><i><?php echo $det->gudang_kode; ?></i></small><br/>
                                                </td>
                                                <td style="width: 150px;">
                                                    <?= $det->status == 1 ? '<small class="badge badge-success">Tersedia</small>' : '<small class="badge badge-warning">Tidak Tersedia</small>'?>
                                                </td>
                                                <td style="width: 280px;">
                                                    <?php if (!empty($det->id_penjualan)) : ?>
                                                        <span class="badge badge-info">Keluar via Penjualan</span><br/>
                                                        <small>No Nota: <b><?= $det->no_nota_jual ?></b></small><br/>
                                                        <small>Pelanggan: <b><?= $det->kode_pelanggan_jual ?> - <?= $det->nama_pelanggan_jual ?></b></small>
                                                    
                                                    <?php elseif (!empty($det->id_mutasi)) : ?>
                                                        <span class="badge badge-warning">Keluar via Mutasi</span><br/>
                                                        <small>No Nota: <b><?= $det->no_nota_mutasi ?></b></small><br/>
                                                        <small>Pelanggan: <b><?= $det->kode_pelanggan_mutasi ?> - <?= $det->nama_pelanggan_mutasi ?></b></small>
                                                    
                                                    <?php else : ?>
                                                        <span class="text-muted">Belum keluar</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="width: 280px;">
                                                    <?php if (!empty($det->id_supplier)) : ?>
                                                        <span class="badge badge-primary">Asal Barang</span><br/>
                                                        <small>Nota Beli: <b><?= $det->no_nota_beli ?></b></small><br/>
                                                        <small>Supplier: <b><?= $det->kode_supplier ?> - <?= $det->nama_supplier ?></b></small>
                                                    
                                                    <?php else : ?>
                                                        <span class="text-muted">Tidak Diketahui</span>
                                                    <?php endif; ?>
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