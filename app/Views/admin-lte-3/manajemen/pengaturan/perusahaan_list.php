<?php $request = \Config\Services::request(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pengaturan') ?>">Pengaturan</a></li>
                        <li class="breadcrumb-item active">Data Perusahaan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Perusahaan</h3>
                            <div class="card-tools">
                                <?php echo (!empty($Pagination) ? $Pagination : '') ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary btn-flat" onclick="window.location.href = '<?php echo base_url('pengaturan/perusahaan_tambah.php') ?>'"><i class="fas fa-plus"></i> Tambah</button>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Perusahaan</th>
                                        <th>Kontak</th>
                                        <th>Kop</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(base_url('pengaturan/perusahaan_set_cari.php')) ?>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>
                                            <?php echo form_input(['id' => 'nama', 'name' => 'nama', 'class' => 'form-control input-sm rounded-0', 'placeholder' => 'Isikan nama perusahaan ...']) ?>
                                        </th>
                                        <th></th>
                                        <td></td>
                                        <th>
                                            <button class="btn btn-primary btn-flat" style="width: 120px;">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </th>
                                    </tr>
                                    <?php echo form_close(); ?>
                                    <?php
                                    if (!empty($SQLCompany)) {
                                        $no = $Halaman;
                                        foreach ($SQLCompany as $profile) {
                                            ?>
                                            <tr>
                                                <td style="width: 25px;" class="text-center"><?php echo $no++ ?>.</td>
                                                <td style="width: 450px;">
                                                    <?php echo (!empty($profile->npwp) ? '<small><i>' . $profile->npwp . '</i></small><br/>' : '') ?>
                                                    <?php echo $profile->nama ?><br/>
                                                    <?php echo (!empty($profile->alamat) ? $profile->alamat . '<br/>' : '') ?>
                                                </td>
                                                <td style="width: 100px;"><?php echo $profile->no_telp ?></td>
                                                <td style="width: 250px;"><?php echo $profile->no_telp ?></td>
                                                <td style="width: 150px;">
                                                    <?php // if (akses::hakSA() == TRUE || akses::hakOwner() == TRUE || akses::hakAdminM() == TRUE) { ?>
                                                    <?php // echo nbs() ?>
                                                    <?php echo anchor(base_url('pengaturan/perusahaan_tambah.php?id=' . $profile->id), '<i class="fa fa-edit"></i> Ubah', 'class="btn btn-info btn-flat btn-xs" style="width: 55px;"') ?>
                                                    &nbsp;
                                                        <?php if(!hakAdminM()) : ?>
                                                        <?php echo anchor(base_url('pengaturan/perusahaan_set_hapus.php?id=' . $profile->id . (isset($_GET['page']) ? '&page=' . $request->getVar('page') : '')), '<i class="fas fa-trash"></i> Hapus', 'onclick="return confirm(\'Hapus [' . $profile->nama . '] ? \')" class="btn btn-danger btn-flat btn-xs" style="width: 55px;"') ?>
                                                        <?php endif; ?>
                                                    <?php // } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        <?php echo session()->getFlashdata('pengaturan_toast'); ?>
    });
</script>