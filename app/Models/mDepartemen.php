<?php
/**
 * mDepartemen Model
 * 
 * This model handles operations related to the tbl_m_departemen table
 * which stores department/division data.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-12
 */

namespace App\Models;
use CodeIgniter\Model;

/**
 * mDepartemen class
 * 
 * Model for managing department/division data
 */
class mDepartemen extends Model {
    /**
     * Table name
     *
     * @var string
     */
    protected $table                = 'tbl_m_departemen';
    
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
        'dept',
        'keterangan',
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
        'kode' => 'required|max_length[50]',
        'dept' => 'required|max_length[160]',
        'keterangan' => 'permit_empty|max_length[160]',
        'status' => 'permit_empty|in_list[0,1]'
    ];
    
    /**
     * Validation messages
     *
     * @var array
     */
    protected $validationMessages   = [
        'kode' => [
            'required' => 'Kode departemen harus diisi',
            'max_length' => 'Kode departemen maksimal 50 karakter'
        ],
        'dept' => [
            'required' => 'Nama departemen harus diisi',
            'max_length' => 'Nama departemen maksimal 160 karakter'
        ],
        'keterangan' => [
            'max_length' => 'Keterangan maksimal 160 karakter'
        ],
        'status' => [
            'in_list' => 'Status harus 0 atau 1'
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
     * Get all departments
     * 
     * @param bool $activeOnly Whether to return only active departments
     * @return array List of departments
     */
    public function getDepartemen($activeOnly = false)
    {
        $builder = $this->orderBy('dept', 'ASC');
        
        if ($activeOnly) {
            $builder->where('status', '1');
        }
        
        return $builder->findAll();
    }
    
    /**
     * Get department by ID
     * 
     * @param int $id Department ID
     * @return array|null Department data
     */
    public function getDepartemenById($id)
    {
        return $this->find($id);
    }
    
    /**
     * Get department by code
     * 
     * @param string $kode Department code
     * @return array|null Department data
     */
    public function getDepartemenByKode($kode)
    {
        return $this->where('kode', $kode)->first();
    }
    
    /**
     * Search departments by name or code
     * 
     * @param string $keyword Search keyword
     * @param bool $activeOnly Whether to search only active departments
     * @return array List of matching departments
     */
    public function searchDepartemen($keyword, $activeOnly = false)
    {
        $builder = $this->groupStart()
                        ->like('dept', $keyword)
                        ->orLike('kode', $keyword)
                        ->orLike('keterangan', $keyword)
                        ->groupEnd();
        
        if ($activeOnly) {
            $builder->where('status', '1');
        }
        
        return $builder->orderBy('dept', 'ASC')->findAll();
    }
    
    /**
     * Toggle department status
     * 
     * @param int $id Department ID
     * @return bool Success status
     */
    public function toggleStatus($id)
    {
        $dept = $this->find($id);
        
        if (!$dept) {
            return false;
        }
        
        $newStatus = ($dept['status'] == '1') ? '0' : '1';
        
        return $this->update($id, ['status' => $newStatus]);
    }
} 