<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of trPenjLog
 *
 * @author mike
 */
class trPenjLog extends Model {
    protected $table                = 'tbl_trans_jual_log';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id_penjualan','id_user','log','status'];
    
    # Tanggal
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'tgl_simpan';
    protected $updatedField         = 'tgl_modif';
    
    # Validasi
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
