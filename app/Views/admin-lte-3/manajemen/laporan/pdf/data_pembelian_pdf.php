<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .header {
            text-align: center;
        }
        .header h1 {
            margin-bottom: 0;
        }
        .header p {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pembelian</h1>
        <p>Perusahaan: <?php echo $filterPerusahaan; ?> | Tanggal: <?php echo $filterTgl; ?> | Rentang Tanggal: <?php echo $filterTglRentang; ?> | Supplier: <?php echo $supplier; ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Supplier</th>
                <th>Total</th>
                <th>Status</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($SQLPembelian as $det): ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $det->no_nota; ?><br /><small><?php echo tgl_indo5($det->tgl_simpan); ?></small></td>
                <td><?php echo $det->supplier; ?><br /><?php echo $det->alamat; ?></td>
                <td class="text-right"><?php echo format_angka($det->jml_gtotal); ?></td>
                <td><?php echo status_penj($det->status); ?></td>
                <td><?php echo $det->user_name; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th class="text-right"><?php echo format_angka($total_biaya); ?></th>
                <th colspan="2" class="text-right">Total Data: <?php echo $total_data; ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
