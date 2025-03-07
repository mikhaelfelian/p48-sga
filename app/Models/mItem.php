<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of KategoriModel
 *
 * @author mike
 */
class mItem extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_m_item';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_satuan','id_kategori','id_merk','id_user','kode','barcode',
        'item','jml','harga_beli','harga_jual', 'keterangan','status_stok','status'
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
