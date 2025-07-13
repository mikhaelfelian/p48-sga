<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of trMutasiStok
 *
 * @author mike
 */
class trMutasiStok extends Model
{
    protected $table                = 'tbl_trans_mutasi_stok';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id',
        'id_user',
        'id_mutasi',
        'id_mutasi_det',
        'id_item',
        'id_item_stok_det',
        'id_gd_asal',
        'id_gd_tujuan',
        'tgl_simpan',
        'tgl_masuk',
        'item',
        'stok_awal',
        'jml',
        'stok_akhir',
        'keterangan'
    ];
}
