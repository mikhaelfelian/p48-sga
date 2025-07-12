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
            <?php foreach ($SQLRabDet as $det) { ?>
                <?php if (isset($det->tipe)&& $det->tipe == 'ITEM') { ?>
                    <?php foreach ($det->data as $det) { ?>
                        <tr>
                            <td class="text-left" style="width: 250px;">
                                <?php echo $det->item . br(); ?>
                                <?php if (!empty($det->keterangan)) { ?>
                                    <small><i><?php echo $det->keterangan; ?></i></small><br/> 
                                <?php } ?>
                                <?php echo status_ppn($det->status_ppn); ?>
                            </td>
                            <td class="text-center text-middle" style="width: 70px;"><?php echo (int) $det->jml; ?></td>
                            <td class="text-right text-middle" style="width: 100px;"><?php echo format_angka($det->harga); ?></td>
                            <td class="text-right text-middle" style="width: 150px;"><?php echo format_angka($det->subtotal); ?></td>
                        </tr>
                        <?php $no++; ?>
                    <?php } ?>
                <?php } else {?>
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

        <?php if (!empty($SQLRabDetBi2)) { ?>
            <!--POTONGAN AKAN TAMPIL DISINI-->
            <tr>
                <td class="text-left text-bold" colspan="4"><i>POTONGAN</i></td>
            </tr>
            <?php foreach ($SQLRabDetBi2 as $det) { ?>
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

        // update
        $totalJual = $gtotal;
        $totalBeli = $SQLRabDetSum->harga_hpp_tot;
        
        $dppJual = $totalJual / 1.11;
        $dppBeli = $totalBeli / 1.11;
        
        $pph = $SQLRab->pph;
        $totPph = ($pph * $totalJual) / 100;


        $tipeNetto = "SWASTA";
        $netto = $totalJual; // tipe swasta netto == total jual
        if(in_array($SQLRab->id_tipe, [1,2,3,4])){
            $tipeNetto = "NON SWASTA";
            $pphJual = ($dppJual * $SQLRab->pph) / 100;
            $netto = $dppJual - $pphJual;
        }
        
        $ppnJual = ($dppJual * 11) / 100;
        $ppnBeli = ($dppBeli * 11) / 100;
        $selisihPajak = $ppnJual - $ppnBeli;

        $administrasi = (0.25 / 100) * $netto;

        $biaya1 = ($SQLRabDetSumBi2->subtotal ?? 0);
        $potonganPenj = ($SQLRabDetSumBi3->subtotal ?? 0);

        $laba = $netto - $selisihPajak - $administrasi - $biaya1 - $potonganPenj;

        $pphBadan = ($laba * 22) / 100;

        $labaSetelahPphBadan = $laba - $pphBadan;

        $potensiRest = $ppnJual;
        $labaFinal = $labaSetelahPphBadan + $potensiRest;
        
    ?>

    <!-- FLOW LAMA -->
    <!-- <tr>
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
    <tr>
        <th colspan="3" class="text-right">========================================================================</th>
    </tr> -->
    
    <!-- UPDATE TERBARU -->
    <tr>
        <th colspan="3" class="text-right">TOTAL PENJUALAN</th>
        <th class="text-right"><?php echo format_angka($totalJual); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">DPP JUAL</th>
        <th class="text-right"><?php echo format_angka($dppJual); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">DPP BELI</th>
        <th class="text-right"><?php echo format_angka($dppBeli); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">PPH (<?= $pph; ?> %)</th>
        <th class="text-right"><?php echo format_angka($totPph); ?></th>
    </tr>

    <tr>
        <th colspan="3" class="text-right">NETTO (<?= $tipeNetto;?>)</th>
        <th class="text-right"><?php echo format_angka($netto); ?></th>
    </tr>

    <tr>
        <th colspan="3" class="text-right">PPN BELI</th>
        <th class="text-right"><?php echo format_angka($ppnBeli); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">PPN JUAL</th>
        <th class="text-right"><?php echo format_angka($ppnJual); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">SELISIH PAJAK</th>
        <th class="text-right"><?php echo format_angka($selisihPajak); ?></th>
    </tr>

    <tr>
        <th colspan="3" class="text-right">ADMINISTRASI (<?= $tipeNetto; ?>)</th>
        <th class="text-right"><?php echo format_angka($administrasi); ?></th>
    </tr>

    <tr>
        <th colspan="3" class="text-right">BIAYA</th>
        <th class="text-right"><?php echo format_angka($biaya1); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">POTONGAN PENJUALAN</th>
        <th class="text-right"><?php echo format_angka($potonganPenj); ?></th>
    </tr>

    <tr>
        <th colspan="3" class="text-right">LABA (<?= $tipeNetto; ?>)</th>
        <th class="text-right"><?php echo format_angka($laba); ?></th>
    </tr>

    <tr>
        <th colspan="3" class="text-right">PPH BADAN (<?= $tipeNetto; ?>)</th>
        <th class="text-right"><?php echo format_angka($pphBadan); ?></th>
    </tr>

    <tr>
        <th colspan="3" class="text-right">LABA SETELAH PPH BADAN (<?= $tipeNetto; ?>)</th>
        <th class="text-right"><?php echo format_angka($labaSetelahPphBadan); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">POTENSI RESTITUSI</th>
        <th class="text-right"><?php echo format_angka($potensiRest); ?></th>
    </tr>
    <tr>
        <th colspan="3" class="text-right">LABA FINAL (<?= $tipeNetto; ?>)</th>
        <th class="text-right"><?php echo format_angka($labaFinal); ?></th>
    </tr>
    
</table>