<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center"></th>
            <th class="text-center">No</th>
            <th class="text-left">Item</th>
            <th class="text-center">Jml</th>
            <th class="text-right">Harga</th>
            <th class="text-right">Subtotal</th>
            <th class="text-center"></th>
        </tr>                                    
    </thead>
    <tbody>
        <?php if (!empty($SQLPenjDet)) { ?>
            <?php $no = 1; $subt = 0; ?>
            <?php foreach ($SQLPenjDet as $det) { ?>
            <?php $subt = $subt + $det->subtotal ?>
                <tr>
                    <td class="text-center">
                        <?php if(hakOwner() == TRUE){    ?>
                            <?php if(isset($_GET['status'])){ ?>
                                <?php // if($det->status == '2'){ ?>
                                <a href="<?php echo base_url('transaksi/cart_hapus.php?id='.$request->getVar('id').'&status='.$request->getVar('status').'&id_item='.$det->id) ?>" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('Hapus [<?php echo $det->item; ?>] ?')"><i class="fa fa-trash"></i></a>
                            <?php } ?>   
                        <?php } ?>   
                    </td>
                    <td class="text-center"><?php echo $no; ?></td>
                    <td class="text-left">
                        <small><?php echo tgl_indo5($det->tgl_simpan); ?></small><br/>
                        <?php echo $det->item; ?><br/>
                        <small><i><?php echo $det->keterangan; ?></i></small>
                    </td>
                    <td class="text-center text-middle"><?php echo (int) $det->jml; ?></td>
                    <td class="text-right text-middle"><?php echo format_angka($det->harga); ?></td>
                    <td class="text-right text-middle"><?php echo format_angka($det->subtotal); ?></td>
                    <td class="text-center"></td>
                </tr>  
                <?php $no++; ?>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>