<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of trPODet
 *
 * @author mike
 */
class trPODet extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_trans_beli_po_det';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id_user','id_pembelian','id_item','id_satuan','kode','item','jml','jml_satuan','satuan','keterangan','keterangan_itm','status'];
    
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
