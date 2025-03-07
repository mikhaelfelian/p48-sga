<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of mItemStok
 *
 * @author mike
 */
class mItemStok extends Model {
    protected $table                = 'tbl_m_item_stok';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_item','id_satuan','id_gudang','id_user','jml','jml_satuan','satuan','keterangan','status'
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
