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
class trPenjDet extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_trans_jual_det';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_penjualan','id_item','id_item_kat',
        'id_item_sat','tgl_masuk','no_nota',
        'kode','item','item_link','satuan','keterangan','harga','harga_dpp','harga_ppn','harga_pph','disk1','disk2','disk3','jml','jml_satuan','diskon','potongan','subtotal',
        'profit','harga_hpp','harga_hpp_ppn','harga_hpp_tot','status_ppn','status_biaya','status_hrg','status_brg','status'
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
