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
class mKaryawan extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_m_karyawan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['id_user', 'id_user_group','id_perusahaan', 'kode', 'nik', 'tgl_lahir', 'tmp_lahir', 'nama', 'nama_blk', 'alamat', 'alamat_dom', 'jabatan', 'kota', 'jns_klm', 'no_hp', 'no_rmh', 'file_name', 'file_ext', 'file_type', 'status'];
    
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
    
    /**
     * Count all employees
     * 
     * @return int Total number of employees
     */
    public function countAllEmployees()
    {
        return $this->countAllResults();
    }
    
    /**
     * Count active employees
     * 
     * @return int Total number of active employees
     */
    public function countActiveEmployees()
    {
        return $this->where('status', '1')->countAllResults();
    }
    
    /**
     * Count contract employees
     * 
     * @return int Total number of contract employees
     */
    public function countContractEmployees()
    {
        return $this->where('status', '2')->countAllResults();
    }
    
    /**
     * Count inactive employees
     * 
     * @return int Total number of inactive employees
     */
    public function countInactiveEmployees()
    {
        return $this->where('status', '0')->countAllResults();
    }
}
