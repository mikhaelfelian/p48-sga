<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of trJualKirimSn
 *
 * @author mike
 */
class trJualKirimSn extends Model
{
    protected $table                = 'tbl_trans_jual_kirim_sn';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id',
        'id_penjualan',
        'id_penjualan_det',
        'id_item',
        'id_user',
        'id_item_stok_det',
        'kode_sn',
        'keterangan',
        'status'
    ];
}
