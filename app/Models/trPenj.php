<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of KategoriModel
 *
 * @author mike
 */
class trPenj extends Model {
    protected $table                = 'tbl_trans_jual';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_user','id_sales','id_pelanggan','id_perusahaan','id_platform',
        'id_tipe','id_rab','id_platform','kode_fp','no_nota','no_kontrak','no_paket','tgl_bayar',
        'tgl_masuk','tgl_keluar','platform','jml_hps','jml_pagu','jml_total','jml_biaya','ppn',
        'jml_ppn','pph','jml_pph','jml_gtotal', 'jml_bayar', 'jml_kurang','jml_hpp','jml_hpp_ppn','jml_profit','status','status_ppn','status_hps','keterangan',
        'metode_bayar','status','status_nota','status_ppn','status_hps','status_bayar'
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

    
    protected $allowCallbacks       = true;
//    protected $afterInsert          = ['simpanLog'];
    protected $afterUpdate          = ['updateLog'];
   
    
    # Mencatat log insert dari Penjualan
    public function simpanLog(array $row){
        $db         = \Config\Database::connect();
        $ionAuth    = new \IonAuth\Libraries\IonAuth();
        $ID         = $ionAuth->user()->row();
        
        $Log = new trPenjLog();        
        $data = [
            'id_penjualan'  => $ID->id,
            'id_user'       => $row['data']['id_user'],
            'log'           => json_encode($row['data']),
            'status'        => '1'
        ];
        
        $Log->save($data);
    }
    
    # Mencatat log update dari Penjualan
    public function updateLog(array $row){
        $db         = \Config\Database::connect();
        $ionAuth    = new \IonAuth\Libraries\IonAuth();
        $ID         = $ionAuth->user()->row();
        $status     = (!empty($row['data']['status_hps']) ? '3' : '2');
                     
        $Log = new trPenjLog();
        $data = [
            'id_penjualan'  => $row['id'],
            'id_user'       => $ID->id,
            'log'           => json_encode($row['data']),
            'status'        => $status
        ];
        
        $Log->save($data);
    }
}
