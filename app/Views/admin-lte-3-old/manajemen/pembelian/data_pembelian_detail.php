<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Faktur Pembelian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pembelian') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Pembelian</li>
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
                            <h3 class="card-title"><?php echo $SQLBeli->c_nama ?></h3>
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
                                            <td><?php echo (!empty($SQLPsn) ? $SQLPsn->no_po : '') ?></td>

                                            <th>Supplier</th>
                                            <th>:</th>
                                            <td><?php echo '[' . $SQLBeli->kode . '] ' . $SQLBeli->supplier ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Faktur</th>
                                            <th>:</th>
                                            <td><?php echo $SQLBeli->no_nota ?></td>

                                            <th>Alamat</th>
                                            <th>:</th>
                                            <td><?php echo $SQLBeli->alamat ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tgl Faktur</th>
                                            <th>:</th>
                                            <td><?php echo tgl_indo2($SQLBeli->tgl_masuk) ?></td>

                                            <th>Jatuh Tempo</th>
                                            <th>:</th>
                                            <td><?php echo tgl_indo2($SQLBeli->tgl_keluar) ?></td>
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
                                                <th class="text-center" style="width: 150px;">Harga</th>
                                                <th class="text-center" style="width: 150px;">Total</th>
                                                <th class="text-left" style="width: 200px;">Keterangan</th>
                                            </tr>                                    
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($SQLBeliDet)) { ?>
                                                <?php $no = 1 ?>
                                                <?php foreach ($SQLBeliDet as $det) { ?>
                                                    <tr>
                                                        <td class="text-center" style="width: 55px;"><?php echo $no; ?></td>
                                                        <td class="text-left" style="width: 350px;"><?php echo $det->item; ?></td>
                                                        <td class="text-center" style="width: 150px;"><?php echo $det->jml . ' ' . $det->satuan ?></td>
                                                        <td class="text-center" style="width: 150px;"><?php echo format_angka($det->harga) ?></td>
                                                        <td class="text-center" style="width: 150px;"><?php echo format_angka($det->subtotal) ?></td>
                                                        <td class="text-right" style="width: 200px;"><?php echo $det->keterangan; ?></td>
                                                    </tr>
                                                    <?php $no++; ?>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                                    <td class="text-center"><?php echo format_angka($SQLBeli->jml_total) ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-right"><strong>Diskon:</strong></td>
                                                    <td class="text-center"><?php echo format_angka($SQLBeli->jml_diskon) ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                                                    <td class="text-center"><strong><?php echo format_angka($SQLBeli->jml_gtotal) ?></strong></td>
                                                    <td></td>
                                                </tr>
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
                                    <?php if(!empty($SQLPsn)){ ?>
                                        <button type="button" class="btn btn-success btn-flat" onclick="window.location.href = '<?php echo base_url('pembelian/pesanan/data_pesanan_det.php?id=' . (!empty($SQLPsn->id) ? $SQLPsn->id : '')) ?>'"><i class="fa fa-shopping-cart"></i> Lihat PO</button>
                                    <?php } ?>
                                    <!--<button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php // echo base_url('pembelian/faktur/pdf_pembelian.php?id=' . $request->getVar('id')) ?>'"><i class="fas fa-file-pdf"></i> Cetak</button>-->
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