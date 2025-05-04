<?php $request  = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<table class="table table-striped"<?php echo (isset($_GET['status']) ? ($_GET['status'] != '2' ? ' style="width: 1366px;"' : '') : '') ?>>
    <thead>
        <tr>
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
            <!--ITEM AKAN TAMPIL DISINI-->
            <?php
                $no     = 1;
                $subt   = 0;
            ?>
            <tr>
                <td class="text-left text-bold" colspan="4"><i>ITEM</i></td>
            </tr>
            <?php foreach ($SQLRabDet[0]->data as $det) { ?>
                <tr>
                    <td class="text-left" style="width: 250px;">
                        <small><?php echo tgl_indo5($det->tgl_simpan); ?></small><br/>
                        <?php echo $det->item . br(); ?>
                        <?php if (!empty($det->keterangan)) { ?>
                            <small><i><?php echo $det->keterangan; ?></i></small><br/> 
                        <?php } ?>
                        <?php echo status_ppn($det->status_ppn) ?>
                    </td>
                    <td class="text-center text-middle" style="width: 70px;"><?php echo (int) $det->jml; ?></td>
                    <td class="text-right text-middle" style="width: 100px;"><?php echo format_angka($det->harga); ?></td>
                    <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->subtotal); ?></td>
                </tr>
                <?php $no++; ?>
            <?php } ?>
        <?php } ?>

        <?php if (!empty($SQLRabDetBi)) { ?>
            <!--BIAYA AKAN TAMPIL DISINI-->
            <tr>
                <td class="text-left text-bold" colspan="4"><i>BIAYA</i></td>
            </tr>
            <?php foreach ($SQLRabDetBi as $det) { ?>
                <tr>
                    <td class="text-left" style="width: 250px;">
                        <small><?php echo tgl_indo5($det->tgl_simpan); ?></small><br/>
                        <?php echo $det->item . br(); ?>
                        <?php if (!empty($det->keterangan)) { ?>
                            <small><i><?php echo $det->keterangan; ?></i></small><br/> 
                        <?php } ?>
                        <?php echo status_ppn($det->status_ppn) ?>
                    </td>
                    <td class="text-center text-middle" style="width: 70px;"><?php echo (int) $det->jml; ?></td>
                    <td class="text-right text-middle" style="width: 100px;"><?php echo format_angka($det->harga); ?></td>
                    <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->subtotal); ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
    <?php
        $gtotal     = $SQLRab->jml_gtotal + $SQLRab->jml_biaya;
        $netto      = $SQLRab->jml_total - $SQLRab->jml_pph;
        $lk         = $netto - $SQLRab->jml_hpp;
    ?>
    <tr>
        <th colspan="3" class="text-right"><?php echo ($SQLRab->status == '4' ? 'NILAI KONTRAK' : 'HARGA PENAWARAN'); ?></th>
        <th class="text-right"><?php echo format_angka($gtotal); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">PPN</th>
        <th class="text-right"><?php echo format_angka($SQLRab->jml_ppn); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">DPP</th>
        <th class="text-right"><?php echo format_angka($SQLRab->jml_total); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">PPh</th>
        <th class="text-right"><?php echo format_angka($SQLRab->jml_pph); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">Netto</th>
        <th class="text-right"><?php echo format_angka($netto); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">Laba</th>
        <th class="text-right"><?php echo format_angka($lk); ?></th>
    </tr>
    <?php if (!empty($SQLRabDetBi)) { ?>
        <?php foreach ($SQLRabDetBi as $biaya) { ?>
            <tr>
                <th colspan="3" class="text-right"><?php echo ucwords(strtolower($biaya->item)) ?></th>
                <th class="text-right"><?php echo format_angka($biaya->subtotal); ?></th>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <th colspan="3" class="text-right">Biaya</th>
            <th class="text-right"><?php echo format_angka($SQLRab->jml_biaya); ?></th>
        </tr>
    <?php } ?>
    <tr>
        <th colspan="3" class="text-right">PPn dari HPP</th>
        <th class="text-right"><?php echo format_angka($SQLRab->jml_hpp_ppn); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">Laba</th>
        <th class="text-right"><?php echo format_angka($SQLRab->jml_profit); ?></th>
    </tr>
</table>