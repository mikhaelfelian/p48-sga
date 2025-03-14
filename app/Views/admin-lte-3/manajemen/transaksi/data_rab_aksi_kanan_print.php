<?php $request = \Config\Services::request(); ?>
<div class="card">
    <div class="card-body">
        <?php
        switch ($SQLRab->status) {

            # Posisi status draft menuju ke submited / proses
            case '0':
                ?>
                <?php if (!empty($SQLRabDet)) { ?>
                    <?php // if ($SQLRab->id_user == $Pengguna->id) { ?>
                    <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                    <?php echo form_hidden('id', $SQLRab->id); ?>
                    <?php echo form_hidden('jml_gtotal', (float) $SQLRabDetSum->subtotal); ?>
                    <?php echo form_hidden('pesan', 'toastr.success("Transaksi berhasil diproses !!");'); ?>
                    <?php echo form_hidden('user', $Pengguna->id); ?>
                    <?php echo form_hidden('status', '1'); ?>
                    <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                    <button type="submit" class="btn btn-app bg-info">
                        <i class="fa-solid fa-arrows-rotate"></i><br/>
                        Proses
                    </button>
                    <br/>
                    <?php echo form_close(); ?>
                    <?php // } ?>
                <?php } ?>
                <?php
                break;

            # Status posisi submit menunggu acc pimpinan
            # Jika di tolak harus ada reason / note
            # Jika di terima maka bisa lanjut ke set Menang / Kalah
            case '1':
                ?>
                <div class="row">
                    <?php if ($SQLRab->id_user == $Pengguna->id) { ?>
                        <div class="col-md-3">
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.warning("Transaksi dikembalikan ke draft !!");'); ?>
                            <?php echo form_hidden('status', '0'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-danger" onclick="return confirm('Batalkan ?')">
                                <i class="fa-solid fa-arrows-rotate"></i><br/>
                                Batal Proses
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                    <?php } ?>
                    <div class="col-md-3">
                        <?php if (hakSA() == TRUE OR hakOwner() == TRUE OR hakAdminM() == TRUE OR hakAdmin() == TRUE) { ?>
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.success("Transaksi sudah di ACC !!");'); ?>
                            <?php echo form_hidden('status', '2'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-success">
                                <i class="fa-solid fa-check"></i><br/>
                                Terima
                            </button>
                            <?php echo form_close(); ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-3">
                        <?php if (hakSA() == TRUE OR hakOwner() == TRUE OR hakAdminM() == TRUE OR hakAdmin() == TRUE) { ?>
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.error("Transaksi sudah tolak !!");'); ?>
                            <?php echo form_hidden('status', '3'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-warning" onclick="return confirm('Tolak ?')">
                                <i class="fa-solid fa-remove"></i><br/>
                                Tolak
                            </button>
                            <?php echo form_close(); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab.php?id=' . $request->getVar('id') . '&status=1') ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            Internal
                        </button>                            
                    </div>                        
                    <?php if ($SQLRab->status > 1) { ?>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab_pen.php?id=' . $request->getVar('id')) ?>'">
                                <i class="fa-solid fa-print"></i><br/>
                                PDF
                            </button>                          
                        </div>
                    <?php } ?>
                </div>
                <?php
                break;

            # Jika status = 2, maka tampilkan tombol win / lose
            case '2':
                ?>
                <div class="row">
                    <?php if (hakSA() == TRUE OR hakOwner() == TRUE OR hakAdminM() == TRUE OR hakAdmin() == TRUE) { ?>
                        <div class="col-md-3">
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.info("Transaksi sudah di set menang !!");'); ?>
                            <?php echo form_hidden('status', '4'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-warning">
                                <i class="fa-solid fa-check-circle"></i><br/>
                                Menang
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.info("Transaksi sudah di set kalah !!");'); ?>
                            <?php echo form_hidden('status', '5'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-warning" onclick="return confirm('Set Kalah ?')">
                                <i class="fa-solid fa-hand-peace"></i><br/>
                                Kalah
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                    <?php } elseif (hakSales() == TRUE) { ?>
                        <div class="col-md-3">
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.info("Transaksi sudah di set menang !!");'); ?>
                            <?php echo form_hidden('status', '4'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-warning">
                                <i class="fa-solid fa-check-circle"></i><br/>
                                Menang
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.info("Transaksi sudah di set kalah !!");'); ?>
                            <?php echo form_hidden('status', '5'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-warning" onclick="return confirm('Set Kalah ?')">
                                <i class="fa-solid fa-hand-peace"></i><br/>
                                Kalah
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab.php?id=' . $request->getVar('id') . '&status=1') ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            Internal
                        </button>                            
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab_pen.php?id=' . $request->getVar('id')) ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            PDF
                        </button>                            
                    </div>
                </div>
                <?php
                break;

            # Jika status = 3 atau di tolak, untuk superadmin bisa set to draft
            # Sales tidak bisa ngapa2in
            case '3':
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id', $SQLRab->id); ?>
                        <?php echo form_hidden('jml_gtotal', 0); ?>
                        <?php echo form_hidden('user', $Pengguna->id); ?>
                        <?php echo form_hidden('pesan', 'toastr.warning("Transaksi dikembalikan ke draft !!");'); ?>
                        <?php echo form_hidden('status', '0'); ?>
                        <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                        <button type="submit" class="btn btn-app bg-secondary" onclick="return confirm('Set ke draft ?')">
                            <i class="fa-solid fa-undo"></i><br/>
                            Set ke DRAFT
                        </button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab.php?id=' . $request->getVar('id') . '&status=1') ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            Internal
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab_pen.php?id=' . $request->getVar('id')) ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            PDF
                        </button>
                    </div>
                </div>
                <?php
                break;

            # Jika status = 4 atau di set menang, untuk superadmin bisa set to draft
            # Sales bisa set posting ke penjualan 
            case '4':
                ?>
                <div class="row">
                    <?php if (hakSA() == TRUE OR hakOwner() == TRUE OR hakAdminM() == TRUE OR hakAdmin() == TRUE) { ?>
                        <div class="col-md-3">
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.warning("Transaksi dikembalikan ke draft !!");'); ?>
                            <?php echo form_hidden('status', '0'); ?>
                            <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                            <button type="submit" class="btn btn-app bg-secondary" onclick="return confirm('Set ke draft ?')">
                                <i class="fa-solid fa-undo"></i><br/>
                                Set ke DRAFT
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                            <?php echo form_hidden('id', $SQLRab->id); ?>
                            <?php echo form_hidden('jml_gtotal', 0); ?>
                            <?php echo form_hidden('user', $Pengguna->id); ?>
                            <?php echo form_hidden('pesan', 'toastr.success("Transaksi berhasil diposting !!");'); ?>
                            <?php echo form_hidden('status', '6'); ?>
                            <?php echo form_hidden('route', 'transaksi/data_penjualan.php'); ?>

                            <button type="submit" class="btn btn-app bg-primary" onclick="return confirm('Posting ke penjualan ?')">
                                <i class="fa-solid fa-arrows-rotate"></i><br/>
                                POSTING
                            </button>
                            <?php echo form_close(); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab_pen.php?id=' . $request->getVar('id')) ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            PDF
                        </button>
                    </div>
                </div>
                <?php
                break;

            # Jika status = 5 atau di kalah, untuk superadmin bisa set to draft
            # Sales tidak bisa ngapa2in
            case '5':
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo form_open(base_url('transaksi/rab/set_trans_proses.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id', $SQLRab->id); ?>
                        <?php echo form_hidden('jml_gtotal', 0); ?>
                        <?php echo form_hidden('user', $Pengguna->id); ?>
                        <?php echo form_hidden('pesan', 'toastr.warning("Transaksi dikembalikan ke draft !!");'); ?>
                        <?php echo form_hidden('status', '0'); ?>
                        <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                        <button type="submit" class="btn btn-app bg-secondary" onclick="return confirm('Set ke draft ?')">
                            <i class="fa-solid fa-undo"></i><br/>
                            Set ke DRAFT
                        </button>
                        <br/>
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab_pen.php?id=' . $request->getVar('id')) ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            PDF
                        </button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php
                break;

            case '6':
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab.php?id=' . $request->getVar('id') . '&status=1') ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            Internal
                        </button>                            
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/rab/pdf_rab_pen.php?id=' . $request->getVar('id')) ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            PDF
                        </button>                            
                    </div>
                </div>
                <?php
                break;
        }
        ?>
    </div>
</div>