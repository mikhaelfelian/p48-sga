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
class trPembelian extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_trans_beli';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id_supplier','id_user','id_penerima','id_perusahaan','id_po','tgl_bayar','tgl_masuk','tgl_keluar','no_nota','no_po','supplier','jml_total','disk1','disk2','disk3','jml_potongan','jml_retur','jml_diskon','jml_biaya','jml_subtotal','jml_dpp','ppn','jml_ppn','jml_gtotal','jml_bayar','jml_kembali','jml_kurang','status','status_bayar','status_nota','status_ppn','status_retur','status_penerimaan','metode_bayar','status_hps'];
    
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
