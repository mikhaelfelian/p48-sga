<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Model for handling purchase plate transactions
 * 
 * This model manages the tbl_trans_jual_plat table which stores
 * plate-related purchase transaction data.
 * 
 * @author mike
 * @date 2024-03-13
 */
class trPenjPlat extends Model {
    protected $table                = 'tbl_trans_jual_plat';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_penjualan', 'id_platform', 'tgl_simpan', 'no_nota',
        'platform', 'keterangan', 'file', 'nominal'
    ];

}