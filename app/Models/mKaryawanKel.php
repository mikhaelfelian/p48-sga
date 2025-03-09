<?php

/*
 * Model for tbl_m_karyawan_kel table
 * Handles family information for employees
 */

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of mKaryawanKel
 * Model for managing employee family data
 */
class mKaryawanKel extends Model {
    public $nm_tabel;
    protected $table                = 'tbl_m_karyawan_kel';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = [
        'id_karyawan', 
        'id_user', 
        'tgl_simpan', 
        'nm_ayah', 
        'nm_ibu', 
        'nm_pasangan', 
        'nm_anak', 
        'tgl_lhr_ayah', 
        'tgl_lhr_ibu', 
        'tgl_lhr_psg', 
        'jns_pasangan', 
        'file_name', 
        'file_name_ktp', 
        'file_ext', 
        'file_ext_ktp', 
        'file_type', 
        'file_type_ktp', 
        'status_kawin'
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
     * Get employee family data with employee details
     * @return array Employee family data with joined employee information
     */
    public function getKeluarga()
    {
        $builder = $this->db->table($this->table);
        $builder->select('tbl_m_karyawan_kel.*, tbl_m_karyawan.id, tbl_m_karyawan.nama');
        $builder->join('tbl_m_karyawan', 'tbl_m_karyawan.id = tbl_m_karyawan_kel.id_karyawan');
        return $builder->get()->getResult();
    }
} 