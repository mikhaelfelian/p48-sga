<?php $request = \Config\Services::request(); ?>

<a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . '&status=1') ?>">
    <i class="fas fa-boxes"></i> Item
</a>
<a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . '&status=2') ?>">
    <i class="fas fa-dollar"></i> Biaya
</a>
<?php if ($SQLRab->status == '4' OR $SQLRab->status == '6') { ?>
    <a class="btn btn-app bg-info" href="<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . '&status=3') ?>">
        <i class="fas fa-file-invoice"></i> PO
    </a>
<?php } ?>

<?php if (hakSA() == TRUE OR hakOwner() == TRUE) { ?>
    <?php if ($SQLRab->status == 0) { ?>
        <a class="btn btn-app bg-danger" href="<?php echo base_url('transaksi/rab/hapus.php?id=' . $request->getVar('id')) ?>" onclick="return confirm('Hapus [<?php echo $SQLPlgnRw->nama ?>] ?')">
            <i class="fas fa-trash"></i> Hapus
        </a>
    <?php } ?>
<?php } else { ?>
    <?php if ($SQLRab->status == '0') { ?>
        <?php if ($SQLRab->id_user == $Pengguna->id) { ?>
            <a class="btn btn-app bg-danger" href="<?php echo base_url('transaksi/rab/hapus.php?id=' . $request->getVar('id')) ?>" onclick="return confirm('Hapus [<?php echo $SQLPlgnRw->nama ?>] ?')">
                <i class="fas fa-trash"></i> Hapus
            </a>
        <?php } ?>
    <?php } ?>
<?php } ?>
<hr/>