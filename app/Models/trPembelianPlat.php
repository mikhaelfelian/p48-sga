<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Model for handling purchase plate transactions
 * 
 * This model manages the tbl_trans_beli_plat table which stores
 * plate-related purchase transaction data.
 * 
 * @author mike
 * @date 2024-03-13
 */
class trPembelianPlat extends Model {
    protected $table                = 'tbl_trans_beli_plat';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_pembelian', 'id_platform', 'tgl_simpan', 'no_nota',
        'platform', 'keterangan', 'nominal', 'file', 'file2', 'jml_potongan', 'keterangan_potongan'
    ];
    
    # Tanggal
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'tgl_simpan';
    protected $updatedField         = 'tgl_modif';
}