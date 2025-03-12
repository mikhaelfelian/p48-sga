<?php
/**
 * mKaryawanPeg Model
 * 
 * This model handles operations related to the tbl_m_karyawan_peg table
 * which stores employee employment data.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-12
 */

namespace App\Models;
use CodeIgniter\Model;

/**
 * mKaryawanPeg class
 * 
 * Model for managing employee employment data
 */
class mKaryawanPeg extends Model {
    /**
     * Table name
     *
     * @var string
     */
    protected $table                = 'tbl_m_karyawan_peg';
    
    /**
     * Primary key field
     *
     * @var string
     */
    protected $primaryKey           = 'id';
    
    /**
     * Use auto increment for primary key
     *
     * @var bool
     */
    protected $useAutoIncrement     = true;
    
    /**
     * Return type for find* methods
     *
     * @var string
     */
    protected $returnType           = 'array';
    
    /**
     * Fields that can be set during insert/update
     *
     * @var array
     */
    protected $allowedFields        = [
        'id_karyawan',
        'id_user',
        'id_dept',
        'id_jabatan',
        'tgl_simpan',
        'tgl_modif',
        'tgl_masuk',
        'tgl_keluar',
        'kode',
        'no_bpjs_tk',
        'no_bpjs_ks',
        'no_npwp',
        'no_ptkp',
        'no_rek',
        'keterangan',
        'tipe',
        'status'
    ];
    
    /**
     * Use timestamps
     *
     * @var bool
     */
    protected $useTimestamps        = false;
    
    /**
     * Date format
     *
     * @var string
     */
    protected $dateFormat           = 'datetime';
    
    /**
     * Validation rules
     *
     * @var array
     */
    protected $validationRules      = [
        'id_karyawan' => 'required|numeric',
        'id_dept' => 'permit_empty|numeric',
        'id_jabatan' => 'permit_empty|numeric',
        'tgl_masuk' => 'permit_empty|valid_date[Y-m-d]',
        'tgl_keluar' => 'permit_empty|valid_date[Y-m-d]',
        'kode' => 'permit_empty|max_length[160]',
        'no_bpjs_tk' => 'permit_empty|max_length[50]',
        'no_bpjs_ks' => 'permit_empty|max_length[50]',
        'no_npwp' => 'permit_empty|max_length[50]',
        'no_ptkp' => 'permit_empty|max_length[5]',
        'no_rek' => 'permit_empty|max_length[50]',
        'tipe' => 'permit_empty|numeric'
    ];
    
    /**
     * Validation messages
     *
     * @var array
     */
    protected $validationMessages   = [
        'id_karyawan' => [
            'required' => 'ID Karyawan harus diisi',
            'numeric' => 'ID Karyawan harus berupa angka'
        ],
        'id_dept' => [
            'numeric' => 'ID Departemen harus berupa angka'
        ],
        'id_jabatan' => [
            'numeric' => 'ID Jabatan harus berupa angka'
        ],
        'tgl_masuk' => [
            'valid_date' => 'Format Tanggal Masuk tidak valid'
        ],
        'tgl_keluar' => [
            'valid_date' => 'Format Tanggal Keluar tidak valid'
        ],
        'kode' => [
            'max_length' => 'Kode maksimal 160 karakter'
        ],
        'no_bpjs_tk' => [
            'max_length' => 'Nomor BPJS TK maksimal 50 karakter'
        ],
        'no_bpjs_ks' => [
            'max_length' => 'Nomor BPJS KS maksimal 50 karakter'
        ],
        'no_npwp' => [
            'max_length' => 'Nomor NPWP maksimal 50 karakter'
        ],
        'no_ptkp' => [
            'max_length' => 'Nomor PTKP maksimal 5 karakter'
        ],
        'no_rek' => [
            'max_length' => 'Nomor Rekening maksimal 50 karakter'
        ],
        'tipe' => [
            'numeric' => 'Tipe harus berupa angka'
        ]
    ];
    
    /**
     * Skip validation
     *
     * @var bool
     */
    protected $skipValidation       = false;
    
    /**
     * Clean validation rules
     *
     * @var bool
     */
    protected $cleanValidationRules = true;
    
    /**
     * Get employee employment data by employee ID
     * 
     * @param int $id_karyawan Employee ID
     * @return array|null Employee employment data
     */
    public function getKaryawanPeg($id_karyawan)
    {
        return $this->where('id_karyawan', $id_karyawan)->first();
    }
    
    /**
     * Get employee employment data by ID
     * 
     * @param int $id Employment data ID
     * @return array|null Employee employment data
     */
    public function getKaryawanPegById($id)
    {
        return $this->find($id);
    }
    
    /**
     * Get employee employment data with related information
     * 
     * @param int $id_karyawan Employee ID
     * @return array|null Employee employment data with department and position information
     */
    public function getKaryawanPegComplete($id_karyawan)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_m_karyawan_peg kp');
        $builder->select('kp.*, d.dept, d.kode as dept_kode, j.jabatan, j.kode as jabatan_kode');
        $builder->join('tbl_m_departemen d', 'd.id = kp.id_dept', 'left');
        $builder->join('tbl_m_jabatan j', 'j.id = kp.id_jabatan', 'left');
        $builder->where('kp.id_karyawan', $id_karyawan);
        
        return $builder->get()->getRowArray();
    }
    
    /**
     * Get employees by department
     * 
     * @param int $id_dept Department ID
     * @return array List of employees in the department
     */
    public function getKaryawanByDept($id_dept)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_m_karyawan_peg kp');
        $builder->select('kp.*, k.nama, k.nik, j.jabatan');
        $builder->join('tbl_m_karyawan k', 'k.id = kp.id_karyawan', 'inner');
        $builder->join('tbl_m_jabatan j', 'j.id = kp.id_jabatan', 'left');
        $builder->where('kp.id_dept', $id_dept);
        $builder->orderBy('k.nama', 'ASC');
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Get employees by position
     * 
     * @param int $id_jabatan Position ID
     * @return array List of employees in the position
     */
    public function getKaryawanByJabatan($id_jabatan)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_m_karyawan_peg kp');
        $builder->select('kp.*, k.nama, k.nik, d.dept');
        $builder->join('tbl_m_karyawan k', 'k.id = kp.id_karyawan', 'inner');
        $builder->join('tbl_m_departemen d', 'd.id = kp.id_dept', 'left');
        $builder->where('kp.id_jabatan', $id_jabatan);
        $builder->orderBy('k.nama', 'ASC');
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Get employees by employment type
     * 
     * @param int $tipe Employment type
     * @return array List of employees with the specified employment type
     */
    public function getKaryawanByTipe($tipe)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_m_karyawan_peg kp');
        $builder->select('kp.*, k.nama, k.nik, d.dept, j.jabatan');
        $builder->join('tbl_m_karyawan k', 'k.id = kp.id_karyawan', 'inner');
        $builder->join('tbl_m_departemen d', 'd.id = kp.id_dept', 'left');
        $builder->join('tbl_m_jabatan j', 'j.id = kp.id_jabatan', 'left');
        $builder->where('kp.tipe', $tipe);
        $builder->orderBy('k.nama', 'ASC');
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Search employees by various criteria
     * 
     * @param string $keyword Search keyword
     * @return array List of matching employees
     */
    public function searchKaryawanPeg($keyword)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_m_karyawan_peg kp');
        $builder->select('kp.*, k.nama, k.nik, d.dept, j.jabatan');
        $builder->join('tbl_m_karyawan k', 'k.id = kp.id_karyawan', 'inner');
        $builder->join('tbl_m_departemen d', 'd.id = kp.id_dept', 'left');
        $builder->join('tbl_m_jabatan j', 'j.id = kp.id_jabatan', 'left');
        $builder->groupStart()
            ->like('k.nama', $keyword)
            ->orLike('k.nik', $keyword)
            ->orLike('kp.kode', $keyword)
            ->orLike('kp.no_bpjs_tk', $keyword)
            ->orLike('kp.no_bpjs_ks', $keyword)
            ->orLike('kp.no_npwp', $keyword)
            ->orLike('d.dept', $keyword)
            ->orLike('j.jabatan', $keyword)
        ->groupEnd();
        $builder->orderBy('k.nama', 'ASC');
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Update employee employment data
     * 
     * @param int $id Employment data ID
     * @param array $data Data to update
     * @return bool Success status
     */
    public function updateKaryawanPeg($id, $data)
    {
        // Add modification timestamp
        $data['tgl_modif'] = date('Y-m-d H:i:s');
        
        return $this->update($id, $data);
    }
} 