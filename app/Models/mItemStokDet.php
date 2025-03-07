<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of mItemStokDet
 *
 * @author mike
 */
class mItemStokDet extends Model {
    protected $table                = 'tbl_m_item_stok_det';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_user','id_gudang','id_pembelian','id_pembelian_det','id_item',
        'id_item_stok','id_satuan','kode','jml',
        'jml_satuan','status'
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
