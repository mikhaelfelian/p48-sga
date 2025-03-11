<?php

/*
 * Model for tbl_m_karyawan_pend table
 * Handles employee education history data
 */

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of mKaryawanPend
 * Model for managing employee education history data
 */
class mKaryawanPend extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_m_karyawan_pend';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_karyawan', 
        'id_user', 
        'tgl_simpan', 
        'no_dok', 
        'pendidikan', 
        'jurusan', 
        'instansi', 
        'keterangan', 
        'thn_masuk', 
        'thn_keluar', 
        'file_name', 
        'file_ext', 
        'file_type', 
        'file_base64',
        'status_lulus'
    ];
    
    # Tanggal
    protected $useTimestamps        = false; // Not using CI's built-in timestamps since tgl_simpan is manually managed
    protected $dateFormat           = 'datetime';
    
    # Validasi
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
    
    /**
     * Get education history data for a specific employee
     * 
     * @param int $id_karyawan Employee ID
     * @return array Education history data
     */
    public function getPendidikan($id_karyawan)
    {
        return $this->where('id_karyawan', $id_karyawan)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }
    
    /**
     * Get education history data by ID
     * 
     * @param int $id Education history ID
     * @return object|null Education history data
     */
    public function getPendidikanById($id)
    {
        return $this->asObject()
                    ->where('id', $id)
                    ->first();
    }
} 