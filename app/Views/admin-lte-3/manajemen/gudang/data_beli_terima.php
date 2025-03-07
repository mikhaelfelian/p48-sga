<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pembelian') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Purchase Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php if (!empty($SQLItem)) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Form Faktur Pembelian</h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (!empty($SQLBeli)) { ?>
                                            <?php // echo form_open(base_url('pembelian/faktur/cart_simpan.php'), 'autocomplete="off"') ?>
                                            <?php
                                            echo form_hidden('id_beli', $request->getVar('id'));
                                            echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : ''));

                                            if (!empty($SQLBeliDetRw)) {
                                                echo form_hidden('id_beli_det', $request->getVar('id_item_det'));
                                            }
                                            ?>
                                            <div class="form-group<?php echo (!empty($psnGagal['item']) ? ' text-danger' : '') ?>">
                                                <label for="inputEmail3" class="control-label">Item</label>
                                                <?php echo form_input(['id' => 'item', 'name' => 'item', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['item']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan Item ...', 'value' => (!empty($SQLItem->item) ? $SQLItem->item : '')]) ?>
                                            </div>
                                            <?php if (!empty($SQLItem)) { ?>
                                                <div class="form-group<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                                    <label for="inputEmail3" class="control-label">SKU</label>
                                                    <?php echo form_input(['id' => 'kode', 'name' => 'kode', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SKU ...', 'value' => $SQLItem->kode, 'readonly' => 'true']) ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group<?php echo (!empty($psnGagal['jml']) ? ' text-danger' : '') ?>">
                                                            <label for="inputEmail3" class="control-label">Jml</label>
                                                            <?php echo form_input(['id' => 'jml', 'name' => 'jml', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['jml']) ? ' is-invalid' : ''), 'placeholder' => 'Jml ...', 'value' => (!empty($SQLBeliDetRw) ? $SQLBeliDetRw->jml : ''), 'readonly' => 'TRUE']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="inputEmail3" class="control-label">Satuan</label>
                                                        <select name="satuan" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>" readonly="TRUE">
                                                            <option value="">- Pilih -</option>
                                                            <?php foreach ($SQLSatuan as $satuan) { ?>
                                                                <option value="<?php echo $satuan->id ?>"<?php echo (!empty($SQLBeliDetRw) ? ($satuan->id == $SQLBeliDetRw->id_satuan ? ' selected' : '') : '') ?>><?php echo strtoupper($satuan->satuanBesar) . ($satuan->jml > 1 ? ' (' . $satuan->jml . ' ' . $satuan->satuanTerkecil . ')' : '') ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('gudang/penerimaan/data_beli.php') ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <!--<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>-->
                                                </div>
                                            </div>
                                            <?php // echo form_close() ?>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if (!empty($SQLBeli)) { ?>
                                            <?php // echo form_open(base_url('pembelian/faktur/cart_simpan.php'), 'autocomplete="off"') ?>
                                            <?php
                                            echo form_hidden('id_beli', $request->getVar('id'));
                                            echo form_hidden('id_item', (!empty($SQLItem) ? $SQLItem->id : ''));

                                            if (!empty($SQLBeliDetRw)) {
                                                echo form_hidden('id_beli_det', $request->getVar('id_item_det'));
                                            }
                                            ?>
                                            <?php if (!empty($SQLItem)) { ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group<?php echo (!empty($psnGagal['kode']) ? ' text-danger' : '') ?>">
                                                            <label for="inputEmail3" class="control-label">SN</label>
                                                            <?php echo form_input(['id' => 'kode_sn', 'name' => 'kode_sn', 'class' => 'form-control pull-right rounded-0' . (!empty($psnGagal['kode']) ? ' is-invalid' : ''), 'placeholder' => 'Isikan SN ...']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="inputEmail3" class="control-label">Gudang</label>
                                                        <select name="gudang" class="form-control rounded-0<?php echo (!empty($psnGagal['satuan']) ? ' is-invalid' : '') ?>">
                                                            <option value="">- Pilih -</option>
                                                            <?php foreach ($SQLGudang as $gudang) { ?>
                                                                <option value="<?php echo $gudang->id ?>"<?php // echo (!empty($SQLBeliDetRw) ? ($satuan->id == $SQLBeliDetRw->id_satuan ? ' selected' : '') : '')          ?>><?php echo strtoupper($gudang->gudang) ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-6">

                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Terima</button>
                                                </div>
                                            </div>
                                            <?php // echo form_close() ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (!empty($SQLBeli)) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Item box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA ITEM</h3>
                            </div>
                            <div class="card-body">                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Nama Supplier</th>
                                                <th>:</th>
                                                <td><?php echo strtoupper($SQLBeli->supplier) ?></td>

                                                <th>Tgl Pembelian</th>
                                                <th>:</th>
                                                <td><?php echo tgl_indo2($SQLBeli->tgl_masuk) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kode Supplier</th>
                                                <th>:</th>
                                                <td><?php echo ucwords($SQLBeli->kode) ?></td>

                                                <th>Tgl Jatuh Tempo</th>
                                                <th>:</th>
                                                <td><?php echo tgl_indo2($SQLBeli->tgl_keluar) ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. Purchase Order</th>
                                                <th>:</th>
                                                <td><?php echo strtoupper($SQLBeli->no_po) ?></td>

                                                <th>Status PPN</th>
                                                <th>:</th>
                                                <td><?php echo status_ppn($SQLBeli->status_ppn) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-left">Item</th>
                                                    <th class="text-center">Jml</th>
                                                    <th class="text-center">Diterima</th>
                                                    <th class="text-right"></th>
                                                </tr>                                    
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($SQLBeliDet)) {
                                                    $no = 1;
                                                    $subtotal = 0;
                                                    $jml = 0;
                                                    $jml_terima = 0;
                                                    foreach ($SQLBeliDet as $det) {
                                                        $jml = $jml + $det->jml;
                                                        $jml_terima = $jml_terima + $det->jml_diterima;
                                                        ?>
                                                        <tr>
                                                            <td class="text-center" style="width: 50px;"><?php echo $no; ?></td>
                                                            <td class="text-left" style="width: 450px;">
                                                                <small><?php echo (!empty($det->kode) ? $det->kode : ''); ?></small><br/>
                                                                <?php echo $det->item; ?>
                                                            </td>
                                                            <td class="text-center" style="width: 80px;"><?php echo (float) $det->jml; ?></td>
                                                            <td class="text-center" style="width: 80px;"><?php echo (float) $det->jml_diterima; ?></td>
                                                            <td class="text-left" style="width: 100px;">
                                                                <?php
                                                                if ($SQLBeli->status_penerimaan != 3) {
                                                                    echo anchor(base_url('gudang/penerimaan/data_beli_terima_item.php?id=' . $request->getVar('id') . '&id_item=' . $det->id_item . '&id_item_det=' . $det->id), '<i class="fa fa-check"></i> Terima', 'class="btn btn-primary btn-flat btn-xs" style="width: 65px;"');
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url(!empty($_GET['route']) ? $this->input->get('route') : 'gudang/penerimaan/data_beli.php') ?>'"><i class="fas fa-arrow-left"></i> Kembali</button>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <?php
                                        if (!empty($SQLBeliDet)) {
                                            if ($jml != $jml_terima) {
                                                if ($SQLBeli->status_penerimaan != 3) {
                                                    ?>
                                                    <?php echo form_open(base_url('gudang/penerimaan/set_terima_proses.php'), 'autocomplete="off"') ?>
                                                    <?php echo form_hidden('id', $SQLBeli->id) ?>
                                                    <?php echo form_hidden('status_penerimaan', '3') ?>

                                                    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan &raquo;</button>
                                                    <?php echo form_close() ?>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        <?php echo session()->getFlashdata('gudang_toast'); ?>
    });
</script>