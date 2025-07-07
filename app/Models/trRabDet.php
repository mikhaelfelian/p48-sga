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
class trRabDet extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_trans_rab_det';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_rab','id_user','id_item','id_item_kat','id_satuan','tgl_masuk',
        'kode','item','item_link','item_sn','jml','jml_satuan','jml_po','satuan','harga','harga_dpp','harga_ppn','harga_pph','subtotal',
        'profit','harga_hpp','harga_hpp_dpp','harga_hpp_ppn','harga_hpp_tot','keterangan',
        'status_ppn','status','status_biaya'
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
   
    
    # Mencatat log insert dari RAB Item
    public function simpanLog(array $row){
        $Log = new trRabLog();        
        $data = [
            'id_rab'    => $row['data']['id_rab'],
            'id_user'   => $row['data']['id_user'],
            'log'       => json_encode($row['data']),
            'status'    => '1'
        ];
        
        $Log->save($data);
    }
    
    # Mencatat log update dari RAB Item
    public function updateLog(array $row){
        $db         = \Config\Database::connect();
        $ionAuth    = new \IonAuth\Libraries\IonAuth();
        $ID         = $ionAuth->user()->row();
        $builder    = $db->table($this->table);
        $sql_rab    = $builder->where('id', $row['id'])->get()->getRow();
        $status     = (!empty($row['data']['status_hps']) ? '3' : '2');
                     
        $Log = new trRabLog();        
        $data = [
            'id_rab'    => $sql_rab->id_rab,
            'id_user'   => $ID->id,
            'log'       => json_encode($row['data']),
            'status'    => $status
        ];
        
        $Log->save($data);
    }
    
    # Mengelompokkan item berdasarkan tipe inputan
    public function itemData($id = null){
        $RabDet         = new \App\Models\trRabDet();
        $sql_itm_det    = $RabDet->asObject()->groupBy('status')->where('id_rab', $id)->where('status', '1')->find();
        
        # Tampilkan data yang udah di kelompokkan
        foreach ($sql_itm_det as $rab){
            $sql_rab = $RabDet->asObject()->where('id_rab', $rab->id_rab)->where('status', $rab->status)->find();
            
            # Masukkan data kedalam array
            $data[] = [
                'tipe' => ($rab->status == '1' ? 'ITEM' : 'BIAYA'),
                'data'  => $sql_rab
            ];
        }
        
        $items = (!empty($data) ? json_encode($data) : '');
        
        return $items;
    }
}
