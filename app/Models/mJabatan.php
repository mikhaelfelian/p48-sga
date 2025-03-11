<?php
/**
 * mJabatan Model
 * 
 * This model handles operations related to the tbl_m_jabatan table
 * which stores position/job title data.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-02-21
 */

namespace App\Models;
use CodeIgniter\Model;

/**
 * mJabatan class
 * 
 * Model for managing job position data
 */
class mJabatan extends Model {
    /**
     * Table name
     *
     * @var string
     */
    protected $table                = 'tbl_m_jabatan';
    
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
        'id_user', 
        'tgl_simpan', 
        'kode', 
        'jabatan'
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
        'kode' => 'required|max_length[50]',
        'jabatan' => 'required|max_length[100]'
    ];
    
    /**
     * Validation messages
     *
     * @var array
     */
    protected $validationMessages   = [
        'kode' => [
            'required' => 'Kode jabatan harus diisi',
            'max_length' => 'Kode jabatan maksimal 50 karakter'
        ],
        'jabatan' => [
            'required' => 'Nama jabatan harus diisi',
            'max_length' => 'Nama jabatan maksimal 100 karakter'
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
     * Get all job positions
     * 
     * @return array List of job positions
     */
    public function getJabatan()
    {
        return $this->orderBy('jabatan', 'ASC')->findAll();
    }
    
    /**
     * Get job position by ID
     * 
     * @param int $id Job position ID
     * @return array|null Job position data
     */
    public function getJabatanById($id)
    {
        return $this->find($id);
    }
    
    /**
     * Get job position by code
     * 
     * @param string $kode Job position code
     * @return array|null Job position data
     */
    public function getJabatanByKode($kode)
    {
        return $this->where('kode', $kode)->first();
    }
    
    /**
     * Search job positions by name
     * 
     * @param string $keyword Search keyword
     * @return array List of matching job positions
     */
    public function searchJabatan($keyword)
    {
        return $this->like('jabatan', $keyword)
                    ->orLike('kode', $keyword)
                    ->orderBy('jabatan', 'ASC')
                    ->findAll();
    }
} 