<?php $request = \Config\Services::request(); ?>
<div class="card card-success card-outline rounded-0">
    <div class="card-body box-profile">
        <div class="post">
            <ul class="list-group list-group-unbordered mb-3">
                <?php if(!empty($SQLPenj->id_rab)){ ?>
                    <li class="list-group-item">
                        <b>No. RAB</b><br>
                        <span class="float-left"><small><?php echo anchor(base_url('transaksi/rab/data_rab_aksi.php?id=' . $SQLPenj->id_rab), $SQLPenj->no_rab) ?></small></span>
                    </li>
                <?php } ?>
                <li class="list-group-item">
                    <b>No. Kontrak</b><br>
                    <span class="float-left"><small><?php echo $SQLPenj->no_kontrak ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>No. Nota</b><br>
                    <span class="float-left"><small><?php echo $SQLPenj->no_nota ?></small></span>
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
                    <span class="float-left"><small><?php echo tgl_indo($SQLPenj->tgl_masuk) ?></small></span>
                </li>
                <li class="list-group-item">
                    <b>Status</b><br>
                    <span class="float-left"><small><?php echo status_penj($SQLPenj->status) ?></small></span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?php
        switch ($SQLPenj->status) {
            case '0':
                ?>
                <div class="row">
                    <?php if(!empty($SQLPenj->id_rab)){ ?>
                    <div class="col-md-3">
                        <?php echo form_open(base_url('transaksi/set_trans_proses.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id', $SQLPenj->id); ?>
                        <?php echo form_hidden('jml_gtotal', 0); ?>
                        <?php echo form_hidden('pesan', 'toastr.error("Transaksi berhasil dibatalkan !!");'); ?>
                        <?php echo form_hidden('status', '0'); ?>
                        <?php echo form_hidden('route', 'transaksi/rab/data_rab.php'); ?>

                        <button type="submit" class="btn btn-app bg-danger" onclick="return confirm('Batalkan ?')">
                            <i class="fa-solid fa-arrows-rotate"></i><br/>
                            Batal Posting
                        </button>
                        <?php echo form_close(); ?>
                    </div>
                    <?php } ?>
                    <div class="col-md-3">
                        <?php echo form_open(base_url('transaksi/set_trans_proses.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id', $SQLPenj->id); ?>
                        <?php echo form_hidden('jml_gtotal', (float) $SQLPenjDetSum->subtotal); ?>
                        <?php echo form_hidden('pesan', 'toastr.success("Transaksi berhasil diproses !!");'); ?>
                        <?php echo form_hidden('status', '1'); ?>
                        <?php echo form_hidden('route', 'transaksi/data_penjualan.php'); ?>

                        <button type="submit" class="btn btn-app bg-info">
                            <i class="fa-solid fa-arrows-rotate"></i><br/>
                            Proses
                        </button>
                        <br/>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php
                break;

            case '1':
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo form_open(base_url('transaksi/set_trans_proses.php'), 'autocomplete="off"') ?>
                        <?php echo form_hidden('id', $SQLPenj->id); ?>
                        <?php echo form_hidden('jml_gtotal', 0); ?>
                        <?php echo form_hidden('pesan', 'toastr.error("Transaksi berhasil dibatalkan !!");'); ?>
                        <?php echo form_hidden('status', '0'); ?>
                        <?php echo form_hidden('route', 'transaksi/data_penjualan.php'); ?>

                        <button type="submit" class="btn btn-app bg-danger" onclick="return confirm('Batalkan ?')">
                            <i class="fa-solid fa-arrows-rotate"></i><br/>
                            Batal Proses
                        </button>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/pdf_penj_kwi.php?id=' . $request->getVar('id')) ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            Kwitansi
                        </button>                            
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-app bg-info" onclick="window.location.href = '<?php echo base_url('transaksi/pdf_penj_inv.php?id=' . $request->getVar('id')) ?>'">
                            <i class="fa-solid fa-print"></i><br/>
                            Invoice
                        </button>                            
                    </div>
                </div>
                <?php
                break;
        }
        ?>
    </div>
</div>