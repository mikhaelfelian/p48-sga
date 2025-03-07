<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of trRabModel
 *
 * @author mike
 */
class trRab extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_trans_rab';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_user','id_sales','id_pelanggan',
        'id_perusahaan', 'id_tipe','tgl_masuk','tipe','no_rab','no_kontrak',
        'no_paket','keterangan',
        'jml_hps','jml_pagu','jml_total','jml_biaya','ppn',
        'jml_ppn','pph','jml_pph','jml_gtotal','jml_hpp','jml_hpp_ppn','jml_profit','status','status_ppn','status_hps'
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
    protected $afterInsert          = ['simpanLog'];
    protected $afterUpdate          = ['updateLog'];
   
    
    # Mencatat log insert dari RAB
    public function simpanLog(array $row){
        $Log = new trRabLog();
        
        $data = [
            'id_rab'    => $row['id'],
            'id_user'   => $row['data']['id_user'],
            'log'       => json_encode($row['data']),
            'status'    => '1'
        ];
        
        $Log->save($data);
    }
    
    # Mencatat log update dari RAB
    public function updateLog(array $row){
        $db         = \Config\Database::connect();
        $ionAuth    = new \IonAuth\Libraries\IonAuth();
        $ID         = $ionAuth->user()->row();
        $builder    = $db->table($this->table);
        $sql_rab    = $builder->where('id', $row['id'])->get()->getRow();
        $status     = (!empty($row['data']['status_hps']) ? '3' : '2');
                     
        $Log = new trRabLog();        
        $data = [
            'id_rab'    => $row['id'],
            'id_user'   => $ID->id,
            'log'       => json_encode($row['data']),
            'status'    => $status
        ];
        
        $Log->save($data);
    }
}
