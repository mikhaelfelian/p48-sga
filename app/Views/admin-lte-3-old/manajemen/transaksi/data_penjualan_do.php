<?php $request = \Config\Services::request(); ?>
<?php $psnGagal = session()->getFlashdata('psn_gagal'); ?>
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
                <div class="col-lg-8">
                    <?php
                        if(isset($_GET['act'])){
                            switch($_GET['act']){                                    
                                case 'do_input':
                                    echo view($ThemePath.'/manajemen/transaksi/data_penjualan_do_input');
                                    break;
                                
                                case 'do_input_item':
                                    echo view($ThemePath.'/manajemen/transaksi/data_penjualan_do_input_item');
                                    break;
                            }
                        }else{
                            echo view($ThemePath.'/manajemen/transaksi/data_penjualan_do_surat');
                        }
                    ?>
                </div>
                <div class="col-lg-4">
                    <?php echo view($konten_kanan) ?>                    
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(function () {
        $("input[id=harga],input[id=jml],input[id=hpp]").autoNumeric({aSep: '.', aDec: ',', aPad: false});
        <?php echo session()->getFlashdata('gudang_toast'); ?>
        <?php echo session()->getFlashdata('transaksi_toast'); ?>
        
        $("#tgl").datepicker({
            dateFormat: 'dd/mm/yy',
            SetDate: new Date(),
            autoclose: true
        });

        // Data Item
        $('#no_po').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo base_url('transaksi/json_po.php') ?>",
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
                $itemrow.find('#id_po').val(ui.item.id);
                $('#id_po').val(ui.item.id);
                $('#no_po').val(ui.item.supplier);
                window.location.href = "<?php echo base_url('transaksi/rab/data_rab_aksi.php?id=' . $request->getVar('id') . '&status=' . $request->getVar('status')) ?>&id_item=" + ui.item.id;

                // Give focus to the next input field to recieve input from user
                $('#no_po').focus();
                return false;
            }

            // Format the list menu output of the autocomplete
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<a>[" + item.no_po + "] " + item.supplier + "</a>")
                    .appendTo(ul);
        };
    });
</script>