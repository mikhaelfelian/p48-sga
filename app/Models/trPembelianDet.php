<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of KategoriModel
 *
 * @author mike
 */
class trPembelianDet extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_trans_beli_det';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id_user','id_pembelian','id_item','id_satuan','tgl_terima','kode','item', 'item_sn','jml','jml_satuan','jml_diterima','satuan','keterangan','harga','disk1','disk2','disk3','diskon','potongan','subtotal','ppn','status_ppn','sp'];
    
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
