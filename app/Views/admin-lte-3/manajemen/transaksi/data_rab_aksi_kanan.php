<?php $request = \Config\Services::request(); ?>
<div class="card card-success card-outline rounded-0">
    <div class="card-body box-profile">
        <div class="post">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>No. RAB</b><br>
                    <span class="float-left"><small><?php echo $SQLRab->no_rab ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Tipe</b><br>
                    <?php
                    if (isset($_GET['act'])) {
                        if ($_GET['act'] == 'rab_tipe') {
                            echo form_open(base_url('transaksi/rab/set_trans_update.php'), 'autocomplete="off"');
                            echo form_hidden('id', $SQLRab->id);
                            echo form_hidden('id_pelanggan', $SQLRab->id_pelanggan);
                            echo form_hidden('perusahaan', $SQLRab->id_perusahaan);
                            echo form_hidden('sales', $SQLRab->id_sales);
                            echo form_hidden('status', $SQLRab->status);
                            ?>
                            <span class="float-left">
                                <select name="tipe" class="form-control rounded-0<?php echo (!empty($psnGagal['tipe']) ? ' is-invalid' : '') ?>">
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($SQLTipe as $tipe) { ?>
                                        <option value="<?php echo $tipe->id ?>"<?php echo ($tipe->id == $SQLRab->id_tipe ? ' selected' : '') ?>><?php echo strtoupper($tipe->tipe) ?></option>
                                    <?php } ?>
                                </select>
                            </span>
                            <?php echo nbs(2) ?>
                            <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-save"></i></button>
                            <?php
                            echo form_close();
                        } else {
                            ?>
                            <span class="float-left">
                                <small><?php echo $SQLRab->tipe ?></small>
                                <?php if ($SQLRab->status == '0') { ?>
                                    <?php echo nbs() ?>
                                    <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_tipe'), '<i class="fa fa-edit"></i>') ?>
                                <?php } ?>
                            </span>
                            <?php
                        }
                    } else {
                        ?>
                        <span class="float-left">
                            <small><?php echo $SQLRab->tipe ?></small>
                            <?php if ($SQLRab->status == '0') { ?>
                                <?php echo nbs() ?>
                                <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_tipe'), '<i class="fa fa-edit"></i>') ?>
                            <?php } ?>
                        </span>
                        <?php
                    }
                    ?>
                </li>
                <li class="list-group-item">
                    <b>Perusahaan</b><br>
                    <?php
                    if (isset($_GET['act'])) {
                        if ($_GET['act'] == 'rab_pers') {
                            echo form_open(base_url('transaksi/rab/set_trans_update.php'), 'autocomplete="off"');
                            echo form_hidden('id', $SQLRab->id);
                            echo form_hidden('id_pelanggan', $SQLRab->id_pelanggan);
                            echo form_hidden('sales', $SQLRab->id_sales);
                            echo form_hidden('tipe', $SQLRab->id_tipe);
                            echo form_hidden('status', $SQLRab->status);
                            ?>
                            <span class="float-left">
                                <select name="perusahaan" class="form-control rounded-0">
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($SQLProfile as $profile) { ?>
                                        <option value="<?php echo $profile->id ?>"<?php echo ($profile->id == $SQLRab->id_perusahaan ? ' selected' : '') ?>><?php echo strtoupper($profile->nama) ?></option>
                                    <?php } ?>
                                </select>
                            </span>
                            <?php echo nbs(2) ?>
                            <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-save"></i></button>
                            <?php
                            echo form_close();
                        } else {
                            ?>
                            <span class="float-left">
                                <small><?php echo strtoupper($SQLRab->c_nama) ?></small>
                                <?php if ($SQLRab->status == '0') { ?>
                                    <?php echo nbs() ?>
                                    <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_pers'), '<i class="fa fa-edit"></i>') ?>
                                <?php } ?>
                            </span>
                            <?php
                        }
                    } else {
                        ?>
                        <span class="float-left">
                            <small><?php echo strtoupper($SQLRab->c_nama) ?></small>
                            <?php if ($SQLRab->status == '0') { ?>
                                <?php echo nbs() ?>
                                <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_pers'), '<i class="fa fa-edit"></i>') ?>
                            <?php } ?>
                        </span>
                        <?php
                    }
                    ?>
                </li>
                <li class="list-group-item">
                    <b>Sales</b><br>
                    <?php
                    if (isset($_GET['act'])) {
                        if ($_GET['act'] == 'rab_sales') {
                            echo form_open(base_url('transaksi/rab/set_trans_update.php'), 'autocomplete="off"');
                            echo form_hidden('id', $SQLRab->id);
                            echo form_hidden('id_pelanggan', $SQLRab->id_pelanggan);
                            echo form_hidden('perusahaan', $SQLRab->id_perusahaan);
                            echo form_hidden('tipe', $SQLRab->id_tipe);
                            echo form_hidden('status', $SQLRab->status);
                            ?>
                            <span class="float-left">
                                <select name="sales" class="form-control rounded-0">
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($SQLUsers as $user) { ?>
                                        <option value="<?php echo $user->id ?>"<?php echo ($user->id == $Pengguna->id ? ' selected' : '') ?>><?php echo strtoupper($user->first_name) ?></option>
                                    <?php } ?>
                                </select>
                            </span>
                            <?php echo nbs(2) ?>
                            <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-save"></i></button>
                            <?php
                            echo form_close();
                        } else {
                            ?>
                            <span class="float-left">
                                <small><?php echo strtoupper($SQLRab->sales) ?></small>
                                <?php if ($SQLRab->status == '0') { ?>
                                    <?php echo nbs() ?>
                                    <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_sales'), '<i class="fa fa-edit"></i>') ?>
                                <?php } ?>
                            </span>
                            <?php
                        }
                    } else {
                        ?>
                        <span class="float-left">
                            <small><?php echo strtoupper($SQLRab->sales) ?></small>
                            <?php if ($SQLRab->status == '0') { ?>
                                <?php echo nbs() ?>
                                <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_sales'), '<i class="fa fa-edit"></i>') ?>
                            <?php } ?>
                        </span>
                        <?php
                    }
                    ?>
                </li>
                <li class="list-group-item">
                    <b>Tanggal RAB</b><br>
                    <span class="float-left"><small><?php echo tgl_indo($SQLRab->tgl_masuk) ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Customer</b><br>
                    <?php
                    if (isset($_GET['act'])) {
                        if ($_GET['act'] == 'rab_plgn') {
                            echo form_open(base_url('transaksi/rab/set_trans_update.php'), 'autocomplete="off"');
                            echo form_hidden('id', $SQLRab->id);
                            echo form_hidden('perusahaan', $SQLRab->id_perusahaan);
                            echo form_hidden('sales', $SQLRab->id_sales);
                            echo form_hidden('tipe', $SQLRab->id_tipe);
                            echo form_hidden('status', $SQLRab->status);
                            ?>
                            <span class="float-left">
                                <select name="id_pelanggan" class="form-control rounded-0 select2bs4" style="width: 225px;">
                                    <option value="">- Pilih -</option>
                                    <?php foreach ($SQLPlgn as $plgn) { ?>
                                        <option value="<?php echo $plgn->id ?>"<?php echo ($plgn->id == $SQLRab->id_pelanggan ? ' selected' : '') ?>><?php echo strtoupper($plgn->nama) ?></option>
                                    <?php } ?>
                                </select>
                            </span>
                            <?php echo nbs(2) ?>
                            <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-save"></i></button>
                            <?php
                            echo form_close();
                        } else {
                            ?>
                            <span class="float-left">
                                <small><?php echo strtoupper($SQLRab->p_nama) ?></small>
                                <?php if ($SQLRab->status == '0') { ?>
                                    <?php echo nbs() ?>
                                    <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_sales'), '<i class="fa fa-edit"></i>') ?>
                                <?php } ?>
                            </span>
                            <?php foreach ($SQLPlgnCP as $cp) { ?>
                                <span class="float-left"><small><?php echo nbs(2) . '- ' . strtoupper($cp->nama) . (!empty($cp->no_hp) ? ' / ' . $cp->no_hp : '') . (!empty($cp->jabatan) ? ' / ' . $cp->jabatan : '') ?></small></span>
                            <?php } ?>
                            <?php
                        }
                    } else {
                        ?>
                        <span class="float-left">
                            <small><?php echo strtoupper($SQLRab->p_nama) ?></small>
                            <?php if ($SQLRab->status == '0') { ?>
                                <?php echo nbs() ?>
                                <?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . (isset($_GET['status']) ? '&status=' . $request->getVar('status') : '') . '&act=rab_plgn'), '<i class="fa fa-edit"></i>') ?>
                            <?php } ?>
                        </span>
                        <?php foreach ($SQLPlgnCP as $cp) { ?>
                            <span class="float-left"><small><?php echo nbs(2) . '- ' . strtoupper($cp->nama) . (!empty($cp->no_hp) ? ' / ' . $cp->no_hp : '') . (!empty($cp->jabatan) ? ' / ' . $cp->jabatan : '') ?></small></span>
                        <?php } ?>
                        <?php
                    }
                    ?>
                </li>
                <li class="list-group-item">
                    <b>Pembuat</b><br>
                    <span class="float-left"><small><?php echo strtoupper($SQLRab->username) ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Tanggal Sistem</b><br>
                    <span class="float-left"><small><?php echo tgl_indo4($SQLRab->tgl_simpan) ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Status</b><br>
                    <span class="float-left"><?php echo status_rab($SQLRab->status) ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php echo (!empty($konten_kanan_prn) ? view($konten_kanan_prn) : '') ?>