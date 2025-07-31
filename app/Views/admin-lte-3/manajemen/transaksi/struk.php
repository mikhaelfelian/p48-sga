<?php $request = \Config\Services::request(); ?>
<?php helper('general'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CETAK STRUK</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Struk</li>
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
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Form STRUK</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label">No Kuitansi*</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_input(['id' => 'kuitansi', 'name' => 'kuitansi', 'class' => 'form-control rounded-0 text-middle', 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Nomor Kwitansi ...', 'value' => '']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Tanggal*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <?php echo form_input(['id' => 'tgl', 'name' => 'tgl_masuk', 'class' => 'form-control rounded-0 text-left' , 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Tanggal (dd/mm/yyyy) atau (17/08/1945) ...']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Telah Terima Dari*</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_input(['id' => 'terima_dari', 'name' => 'terima_dari', 'class' => 'form-control rounded-0 text-middle', 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan diterima dari ...', 'value' => '']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Banyak Uang*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp. </span>
                                            </div>
                                            <?php echo form_input(['id' => 'nominal', 'name' => 'nominal', 'class' => 'form-control rounded-0 text-left', 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Nominal ...']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Untuk Pembayaran*</label>
                                        <div class="input-group mb-3">
                                            <?php echo form_input(['id' => 'keperluan', 'name' => 'keperluan', 'class' => 'form-control rounded-0 text-middle', 'style' => 'vertical-align: middle;', 'placeholder' => 'Isikan Keperluan Pembayaran ...', 'value' => '']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="reset" class="btn btn-danger btn-flat" onclick="window.location.href='<?php echo base_url('/transaksi')?>'"><i class="fa fa-remove"></i> Batal</button>
                                    <button type="button" id="cetakStruk" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Cetak Struk</button>
                                </div>
                            </div>                            
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
      $("input[id=nominal]").autoNumeric({aSep: '.', aDec: ',', aPad: false});

        $("#tgl").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });

        $("#cetakStruk").click(function(){
          console.log("OKE")
            const kuitansi = $('#kuitansi').val();
            const tgl = $('#tgl').val();
            const terima_dari = $('#terima_dari').val();
            const nominal = $('#nominal').val();
            const keperluan = $('#keperluan').val();

            // Encode agar aman di URL
            const queryString = $.param({
                kuitansi: kuitansi,
                tgl_masuk: tgl,
                terima_dari: terima_dari,
                nominal: nominal,
                keperluan: keperluan
            });

            // Redirect ke endpoint dengan query string
            window.open("<?php echo base_url('transaksi/pdf_struk.php') ?>?" + queryString, "_blank");
          })
    });
</script>