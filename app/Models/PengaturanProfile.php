<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of Pengaturan
 *
 * @author mike
 */
class PengaturanProfile extends Model {
    protected $table            = 'tbl_pengaturan_profile';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id_user', 'id_pengaturan', 'npwp', 'nama', 
        'no_telp', 'no_fax', 'alamat', 'kota', 'email', 'kbli', 'logo', 
        'logo_kop', 'logo_wm', 'keterangan','direktur','status'
        ];

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
