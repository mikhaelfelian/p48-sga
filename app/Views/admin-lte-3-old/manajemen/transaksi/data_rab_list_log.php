<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
<?php helper('general'); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-left">Tanggal</th>
            <th class="text-left">Log</th>
        </tr>                                    
    </thead>
    <tbody>
        <?php if (!empty($SQLRabLog)) { ?>
            <?php $no = 1; $subt = 0; ?>
            <?php foreach ($SQLRabLog as $det) { ?>
            <?php $log = json_decode($det->log) ?>
                <tr>
                    <td class="text-center" style="width: 50px;"><?php echo $no; ?></td>
                    <td class="text-left" style="width: 120px;">
                        <small><?php echo tgl_indo5($det->tgl_simpan); ?></small>
                        <?php echo br(); ?>
                        <small><i><?php echo $det->user; ?></i></small>
                    </td>
                    <td class="text-left text-middle">
                        <small>
                        <?php
                            if(!empty($log->id_rab)){
                                if($det->status == '1'){
//                                    if($log->status == '1'){
                                        echo '<b>'.$log->item.' : </b>'.format_angka($log->harga).' ==> berhasil disimpan';
//                                    }else{
//                                        echo 'Item Biaya diinput';
//                                    }
                                }else{
                                    echo 'ITEM :';
                                    echo '<ul>';
                                    echo '<li><b>Item : </b>'.$log->item.' ==> berhasil diupdate</li>';
                                    echo '<li><b>Harga : </b>'.format_angka($log->harga).' ==> berhasil diupdate</li>';
                                    echo '<li><b>Jml : </b>'.format_angka($log->jml).' ==> berhasil diupdate</li>';
                                    echo '</ul>';
                                }
                            }else{
                                if($det->status == '1'){
                                    echo 'RAB dibuat';
                                } else {
                                    $count = count((array)$log);
                                    if($count == '3'){
                                        echo 'RAB :';
                                        echo '<ul>';
                                        echo '<li><b>Status : </b>'.status_rab($log->status).' ==> berhasil diupdate</li>';
                                        echo '</ul>';
                                    }else{
                                        echo 'RAB berhasil diubah';
                                    }
                                }
                            }
                        ?>                            
                        </small>
                    </td>
                </tr>  
                <?php $no++; ?>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>