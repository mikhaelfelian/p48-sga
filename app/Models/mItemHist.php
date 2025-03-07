<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of mItemHist
 *
 * @author mike
 */
class mItemHist extends Model {
    protected $table                = 'tbl_m_item_hist';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_item','id_gudang','id_perusahaan','id_user','id_pelanggan','id_supplier',
        'id_penjualan','id_pembelian','id_pembelian_det','id_so',
        'tgl_simpan','tgl_modif','tgl_masuk','no_nota','kode',
        'item','keterangan','sn','nominal','jml','jml_satuan','satuan','status','sp'
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
    
    # Menampilkan daftar item beserta harga dan kategori
    public function ItemList($jml_limit){
        $data = $this->builder()
             ->select(["{$this->table}.*", 'tbl_m_kategori.*', 'tbl_m_satuan.*'])
             ->join('tbl_m_kategori', "{$this->table}.id_kategori = tbl_m_kategori.id")
             ->join('tbl_m_satuan', "{$this->table}.id_satuan = tbl_m_satuan.id");
 
        return [
            'dftItem'   => $this->asObject()
                                ->paginate($jml_limit),
            'jmlBaris'  => $this->countAllResults(),
            'pager'     => $this->pager->links(),
        ];
    }
}