<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pembelian') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Purchase Order</li>
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
                            <h3 class="card-title">Form Purchase Order</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>No. Purchase Order</th>
                                            <th>:</th>
                                            <td><?php echo $SQLPsn->no_po ?></td>

                                            <th>Supplier</th>
                                            <th>:</th>
                                            <td><?php echo '[' . $SQLPsn->kode . '] ' . $SQLPsn->supplier ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tgl</th>
                                            <th>:</th>
                                            <td><?php echo tgl_indo2($SQLPsn->tgl_masuk) ?></td>

                                            <th></th>
                                            <th></th>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 50px;">No</th>
                                                <th class="text-left" style="width: 100px;">Item</th>
                                                <th class="text-center" style="width: 150px;">Jml</th>
                                                <th class="text-left">Keterangan</th>
                                            </tr>                                    
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($SQLPsnDet)) { ?>
                                                <?php $no = 1 ?>
                                                <?php foreach ($SQLPsnDet as $det) { ?>
                                                    <tr>
                                                        <td class="text-center" style="width: 55px;"><?php echo $no; ?></td>
                                                        <td class="text-left" style="width: 350px;">
                                                            <?php echo (!empty($det->kode) ? '[' . $det->kode . '] ' : '') . $det->item; ?>
                                                            <?php if(!empty($det->keterangan_itm)){ ?>
                                                                <small><?php echo $det->keterangan_itm; ?></small>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="text-center" style="width: 150px;"><?php echo $det->jml . ' ' . $det->satuan ?></td>
                                                        <td class="text-left" style="width: 150px;"><?php echo $det->keterangan ?></td>
                                                    </tr>
                                                    <?php $no++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <th class="text-center" colspan="8">Tidak Ada Data</th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6 text-right">
                                    <?php if($SQLPsn->status_fkt == 0){ ?>
                                        <button type="button" class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo base_url('pembelian/faktur/data_pembelian_tambah.php?id_po=' . $SQLPsn->id . '&id_supplier=' . $SQLPsn->id_supplier) ?>'"><i class="fa fa-shopping-cart"></i> Buat PI</button>
                                    <?php }else{ ?>
                                        <button type="button" class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo base_url('pembelian/faktur/data_pembelian_det.php?id=' . (!empty($SQLBeli->id) ? $SQLBeli->id : '')) ?>'"><i class="fa fa-shopping-cart"></i> Lihat PI</button>
                                    <?php } ?>
                                    
                                    <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('pembelian/pesanan/pdf_pesanan.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-file-pdf"></i> Cetak PO</button>
                                </div>
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
<script type="text/javascript">
    $(function () {
<?php echo session()->getFlashdata('pembelian_toast'); ?>
    });
</script>