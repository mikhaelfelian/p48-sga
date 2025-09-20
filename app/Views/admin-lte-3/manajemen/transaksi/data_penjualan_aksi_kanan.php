<?php $request = \Config\Services::request(); ?>
<div class="card card-success card-outline rounded-0">
    <div class="card-body box-profile">
        <div class="post">
            <ul class="list-group list-group-unbordered mb-3">
                <?php if(!empty($SQLPenj->id_rab)){ ?>
                    <li class="list-group-item">
                        <b>No. RAB </b><br>
                        <span class="float-left"><small><?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $SQLPenj->id_rab), $SQLPenj->no_rab) ?></small></span>
                    </li>
                <?php } ?>
                <li class="list-group-item">
                    <b>No. Kontrak</b><br>
                    <?php
                    // Ambil semua parameter yang ada di URL
                    $queryParams = $_GET;
                    
                    if (isset($_GET['act']) && $_GET['act'] == 'no_kontrak') {
                        // Membangun URL redirect secara manual agar hanya membawa parameter 'id'
                        $redirectUrl = $_SERVER['PHP_SELF'] . '?id=' . $request->getVar('id');

                        echo form_open(base_url('transaksi/set_trans_update.php'), 'autocomplete="off"');
                        echo form_hidden('id', $SQLPenj->id);
                        echo form_hidden('no_nota', (!empty($SQLPenj) && $SQLPenj->no_nota) ? $SQLPenj->no_nota : '');
                        echo form_hidden('redirect_url', $redirectUrl); // Menggunakan URL yang sudah dimodifikasi
                        ?>
                        <span class="float-left">
                            <input type="text" name="no_kontrak" id="no_kontrak" class="form-control pull-right rounded-0" placeholder="Isikan No Kontrak ..." value="<?php echo (!empty($SQLPenj) && $SQLPenj->no_kontrak) ? $SQLPenj->no_kontrak :'' ?>">
                        </span>
                        <?php echo nbs(2) ?>
                        <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-save"></i></button>
                        <?php
                            echo form_close();
                    } else {
                        // Tambahkan parameter 'act' ke query string saat ini
                        $queryParams['act'] = 'no_kontrak';
                        $url = $_SERVER['PHP_SELF'] . '?' . http_build_query($queryParams);
                    ?>
                        <span class="float-left">
                            <small><?php echo $SQLPenj->no_kontrak ?></small>
                            <?php echo nbs() ?>
                            <?php echo anchor($url, '<i class="fa fa-edit"></i>') ?>
                        </span>
                    <?php }?>
                </li>
                <li class="list-group-item">
                    <b>No. Nota</b><br>
                    <?php
                    // Ambil semua parameter yang ada di URL
                    $queryParams = $_GET;
                        
                    if (isset($_GET['act']) && $_GET['act'] == 'no_nota') {
                        // Membangun URL redirect secara manual agar hanya membawa parameter 'id'
                        $redirectUrl = $_SERVER['PHP_SELF'] . '?id=' . $request->getVar('id');

                        echo form_open(base_url('transaksi/set_trans_update.php'), 'autocomplete="off"');
                        echo form_hidden('id', $SQLPenj->id);
                        echo form_hidden('no_kontrak', (!empty($SQLPenj) && $SQLPenj->no_kontrak) ? $SQLPenj->no_kontrak : '');
                        echo form_hidden('redirect_url', $redirectUrl); // Menggunakan URL yang sudah dimodifikasi
                        ?>
                        <span class="float-left">
                            <input type="text" name="no_nota" id="no_nota" class="form-control pull-right rounded-0" placeholder="Isikan No Nota ..." value="<?php echo (!empty($SQLPenj) && $SQLPenj->no_kontrak) ?  $SQLPenj->no_nota : '' ?>">
                        </span>
                        <?php echo nbs(2) ?>
                        <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-save"></i></button>
                        <?php
                            echo form_close();
                    } else {
                        // Tambahkan parameter 'act' ke query string saat ini
                        $queryParams['act'] = 'no_nota';
                        $url = $_SERVER['PHP_SELF'] . '?' . http_build_query($queryParams);
                    ?>
                        <span class="float-left">
                            <small><?php echo $SQLPenj->no_nota ?></small>
                            <?php echo nbs() ?>
                            <?php echo anchor($url, '<i class="fa fa-edit"></i>') ?>
                        </span>
                    <?php }?>
                </li>
                <li class="list-group-item">
                    <b>Tipe</b><br>
                    <span class="float-left"><small><?php echo $SQLPenj->tipe ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Sales</b><br>
                    <span class="float-left"><small><?php echo strtoupper($Pengguna->first_name) ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Tgl Simpan</b><br>
                    <span class="float-left"><small><?php echo tgl_indo5($SQLPenj->tgl_simpan) ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Tgl Nota</b><br>
                    <?php
                     // Ambil semua parameter yang ada di URL
                    $queryParams = $_GET;
                    
                    if (isset($_GET['act']) && $_GET['act'] == 'tgl_masuk') {
                        // Membangun URL redirect secara manual agar hanya membawa parameter 'id'
                        $redirectUrl = $_SERVER['PHP_SELF'] . '?id=' . $request->getVar('id');

                        echo form_open(base_url('transaksi/set_trans_update.php'), 'autocomplete="off"');
                        echo form_hidden('id', $SQLPenj->id);
                        echo form_hidden('no_kontrak', (!empty($SQLPenj) && $SQLPenj->no_kontrak) ? $SQLPenj->no_kontrak : '');
                        echo form_hidden('no_nota', (!empty($SQLPenj) && $SQLPenj->no_nota) ? $SQLPenj->no_nota : '');
                        echo form_hidden('redirect_url', $redirectUrl); // Menggunakan URL yang sudah dimodifikasi
                        ?>
                        <span class="float-left">
                            <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left', 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...', 'value' => ((!empty($SQLPenj) && $SQLPenj->tgl_masuk) ? tgl_indo2($SQLPenj->tgl_masuk) : '')]) ?>
                        </span>
                        <?php echo nbs(2) ?>
                        <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-save"></i></button>
                        <?php
                            echo form_close();
                    } else { 
                        // Tambahkan parameter 'act' ke query string saat ini
                        $queryParams['act'] = 'tgl_masuk';
                        $url = $_SERVER['PHP_SELF'] . '?' . http_build_query($queryParams);
                    ?>
                        <span class="float-left">
                            <small><?php echo tgl_indo($SQLPenj->tgl_masuk) ?></small>
                            <?php echo nbs() ?>
                            <?php echo anchor($url, '<i class="fa fa-edit"></i>') ?>
                        </span>
                    <?php }?>


                </li>
                <li class="list-group-item">
                    <b>Status</b><br>
                    <span class="float-left"><small><?php echo status_penj($SQLPenj->status) ?></small></span>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php echo (!empty($konten_kanan_prn) ? view($konten_kanan_prn) : '') ?>