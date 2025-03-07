<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of KategoriModel
 *
 * @author mike
 */
class trPesananDet extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_trans_pesanan_det';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id','id_pesanan','id_item','id_satuan','id_satuan_pesanan','id_user_sales',
        'id_user_pm','tgl_simpan','tgl_modif','tgl_masuk_pm','tgl_keluar_pm','kode','item','pesanan','jml','jml_pesanan','pagu','harga','keterangan','status'
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
