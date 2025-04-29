<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('transaksi') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Data Penjualan</li>
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
                    <?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
                    <?php echo form_open(base_url('transaksi/set_trans_simpan.php'), 'autocomplete="off"') ?>
                    <input type="hidden" id="id_pelanggan" name="id_pelanggan">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form Penjualan</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['tgl_masuk']) ? ' text-danger' : '') ?>">
                                        <label for="inputEmail3" class="control-label">Tanggal*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['tgl_masuk']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['pelanggan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Kepada*</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_input(['id' => 'pelanggan', 'name' => 'pelanggan', 'class' => 'form-control rounded-0 text-middle' . (!empty($psnGagal['pelanggan']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Pelanggan ...', 'value' => '']) ?>
                                            <div class="input-group-append">
                                                <span class="input-group-text rounded-0"><?php echo anchor(base_url('master/data_pelanggan_tambah.php?route=transaksi/data_penjualan_tambah.php'), '<i class="fas fa-plus"></i>') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Sales</label>
                                        <select name="sales" class="form-control rounded-0">
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($SQLUsers as $user) { ?>
                                                <option value="<?php echo $user->id ?>"<?php echo ($user->id == $Pengguna->id ? ' selected' : '') ?>><?php echo strtoupper($user->first_name) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group<?php echo (!empty($psnGagal['tipe']) ? ' text-danger' : '') ?>">
                                        <label class="control-label">Tipe*</label>
                                        <select name="tipe" class="form-control rounded-0<?php echo (!empty($psnGagal['tipe']) ? ' is-invalid' : '') ?>">
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($SQLTipe as $tipe) { ?>
                                                <option value="<?php echo $tipe->id ?>"><?php echo strtoupper($tipe->tipe) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group <?php echo (!empty($psnGagal['perusahaan']) ? 'text-danger' : '') ?>">
                                        <label class="control-label">Perusahaan*</label>
                                        <select name="perusahaan" class="form-control rounded-0<?php echo (!empty($psnGagal['perusahaan']) ? ' is-invalid' : '') ?>">
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($SQLProfile as $profile) { ?>
                                                <option value="<?php echo $profile->id ?>"><?php echo strtoupper($profile->nama) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group<?php echo (!empty($psnGagal['no_kontrak']) ? 'text-danger' : '') ?>">
                                        <label for="inputEmail3" class="control-label">No. Kontrak</label>
                                        <?php echo form_input(['id' => 'no_kontrak', 'name' => 'no_kontrak', 'class' => 'form-control rounded-0 text-left' . (!empty($psnGagal['no_kontrak']) ? ' is-invalid' : ''), 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan No Kontrak ...']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="reset" class="btn btn-danger btn-flat"><i class="fa fa-remove"></i> Batal</button>
                                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        $("input[id=pagu],input[id=hps]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
        $("#tgl").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });

        // Data Pelanggan
        $('#pelanggan').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo base_url('public/json_pelanggan.php') ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                var $itemrow = $(this).closest('tr');
                //Populate the input fields from the returned values
                $itemrow.find('#id_pelanggan').val(ui.item.id);
                $('#id_pelanggan').val(ui.item.id);
                $('#pelanggan').val(ui.item.nama);

                // Give focus to the next input field to recieve input from user
                $('#pelanggan').focus();
                return false;
            }

            // Format the list menu output of the autocomplete
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.nama + "</a>")
                    .appendTo(ul);
        };

<?php echo session()->getFlashdata('transaksi_toast'); ?>
    });
</script>