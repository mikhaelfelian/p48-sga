<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of trMutasi
 * Model untuk transaksi keluar masuk gudang
 * @author mike
 */
class trMutasi extends Model {
    protected $table                = 'tbl_trans_mutasi';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id','id_user','id_user_terima','id_gd_asal','id_gd_tujuan','id_sales',
        'id_pelanggan','id_perusahaan','id_penjualan','tgl_masuk','tgl_keluar','no_nota',
        'keterangan','tipe','status','status_terima', 'no_pengiriman'
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
