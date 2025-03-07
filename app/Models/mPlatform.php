<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of mPlatform
 *
 * @author mike
 */
class mPlatform extends Model {
    protected $table                = 'tbl_m_platform';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id_user','kode','platform', 'keterangan', 'status'];
    
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
