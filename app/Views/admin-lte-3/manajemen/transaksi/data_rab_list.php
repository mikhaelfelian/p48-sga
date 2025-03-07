<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<table class="table table-striped"<?php echo (isset($_GET['status']) ? ($_GET['status'] != '2' ? ' style="width: 1366px;"' : '') : '') ?>>
    <thead>
        <tr>
            <th class="text-center"></th>
            <th class="text-left">Item</th>
            <th class="text-center">Jml</th>
            <th class="text-right">Harga</th>
            <th class="text-right">Subtotal</th>
            <?php if (isset($_GET['status'])) { ?>
                <?php if ($_GET['status'] != '2') { ?>
                    <th class="text-right">Profit</th>
                    <th class="text-right">HPP</th>
                    <th class="text-right">PPN dari HPP</th>
                    <th class="text-right">Total</th>
                <?php } ?>
            <?php } ?>
        </tr>                                    
    </thead>
    <tbody>
        <?php if (!empty($SQLRabDet)) { ?>
            <?php $no = 1;
            $subt = 0; ?>
            <?php foreach ($SQLRabDet as $det) { ?>
        <?php $subt = $subt + $det->subtotal ?>
                <tr>
                    <td class="text-center" style="width: 75px;">
                        <?php if (isset($_GET['status'])) { ?>
                            <?php if ($SQLRab->status == 0) { ?>
                                <?php if ($det->id_user == $Pengguna->id) { ?>
                                    <a href="<?php echo base_url('transaksi/rab/cart_hapus.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_item=' . $det->id) ?>" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Hapus [<?php echo $det->item; ?>] ?')"><i class="fa fa-trash"></i></a>
                                    <a href="<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status') . '&id_item=' . $det->id_item . '&id_item_det=' . $det->id) ?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-edit"></i></a>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    <td class="text-left" style="width: 250px;">                        
                        <?php echo status_ppn($det->status_ppn).br() ?>
                        <small><?php echo tgl_indo5($det->tgl_simpan); ?></small><br/>
                        <?php echo $det->item; ?><br/>
                        <small><i><?php echo $det->keterangan; ?></i></small><br/>
                        <?php if($det->status == '2'){ ?>
                            <small><?php echo status_biaya($det->status_biaya) ?></small>
                        <?php }else{ ?>
                            <small><?php echo $det->item_link; ?></small><br/>
                        <?php } ?>
                    </td>
                    <td class="text-center text-middle" style="width: 70px;"><?php echo (int) $det->jml; ?></td>
                    <td class="text-right text-middle" style="width: 100px;"><?php echo format_angka($det->harga); ?></td>
                    <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->subtotal); ?></td>
                    <?php if (isset($_GET['status'])) { ?>
                        <?php if ($_GET['status'] != '2') { ?>
                            <?php // if ($det->status_ppn == '1') { ?>
                                <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->profit); ?></td>
                                <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->harga_hpp); ?></td>
                                <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->harga_hpp_ppn); ?></td>
                                <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->harga_hpp_tot); ?></td>
                            <?php // }else{ ?>
                                <!--<td class="text-right text-middle" style="width: 150px;" colspan="4"></td>-->
                            <?php // } ?>
                        <?php } ?>
                <?php } ?>
                </tr>  
                <?php $no++; ?>
        <?php } ?>                    
        </tbody>
        <?php if (isset($_GET['status'])) { ?>
            <?php if ($_GET['status'] != '2') { ?>
                <?php
                    $netto  = $SQLRab->jml_total - $SQLRab->jml_pph;
                    $lk     = $netto - $SQLRab->jml_hpp;
                ?>
                <tr>
                    <th colspan="4" class="text-right">HPS</th>
                    <th class="text-right"><?php echo format_angka($SQLRab->jml_gtotal); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">PPN</th>
                    <th class="text-right"><?php echo format_angka($SQLRab->jml_ppn); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">DPP</th>
                    <th class="text-right"><?php echo format_angka($SQLRab->jml_total); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">PPh</th>
                    <th class="text-right"><?php echo format_angka($SQLRab->jml_pph); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Netto</th>
                    <th class="text-right"><?php echo format_angka($netto); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Laba</th>
                    <th class="text-right"><?php echo format_angka($lk); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Biaya</th>
                    <th class="text-right"><?php echo format_angka($SQLRab->jml_biaya); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">PPn dari HPP</th>
                    <th class="text-right"><?php echo format_angka($SQLRab->jml_hpp_ppn); ?></th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Laba</th>
                    <th class="text-right"><?php echo format_angka($SQLRab->jml_profit); ?></th>
                    <th colspan="4"></th>
                </tr>
        <?php } ?>
    <?php } ?>
<?php } ?>
</table>