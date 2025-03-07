<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of trMutasiDet
 *
 * @author mike
 */
class trMutasiDet extends Model {
    protected $table                = 'tbl_trans_mutasi_det';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id','id_mutasi','id_user','id_item','id_item_kat','id_satuan','id_penjualan_det','tgl_simpan',
        'tgl_terima','tgl_masuk','sn','kode','item','satuan','keterangan','jml',
        'jml_diterima','jml_satuan','status_brg','status_terima'
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