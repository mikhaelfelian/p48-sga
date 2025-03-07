<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of mPelangganCp
 *
 * @author mike
 */
class mPelangganCp extends Model {
    protected $table                = 'tbl_m_pelanggan_cp';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id_user','id_pelanggan','nama', 'no_hp', 'jabatan', 'status'];
    
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
