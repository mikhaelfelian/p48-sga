<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Employee Leave/Time-off Model
 * 
 * This model handles employee leave/time-off requests data from the tbl_sdm_cuti table.
 * It provides methods for retrieving, creating, updating, and managing leave requests.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-14
 */
class trSdmCuti extends Model
{
    protected $table            = 'tbl_sdm_cuti';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'id_karyawan', 'id_user', 'id_manajemen', 'id_kategori',
        'tgl_simpan', 'tgl_modif', 'tgl_masuk', 'tgl_keluar',
        'keterangan', 'no_surat', 'ttd', 'file_name', 'file_type', 
        'file_ext', 'catatan', 'status'
    ];

    // Dates
    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'tgl_simpan';
    protected $updatedField     = 'tgl_modif';
    protected $deletedField     = '';

    // Validation
    protected $validationRules  = [];
    protected $validationMessages = [];
    protected $skipValidation   = false;
    protected $cleanValidationRules = true;

    /**
     * Get leave requests for a specific employee
     * 
     * @param int $id_karyawan Employee ID
     * @return array Leave requests
     */
    public function getCuti($id_karyawan = null)
    {
        if ($id_karyawan) {
            return $this->where('id_karyawan', $id_karyawan)
                        ->orderBy('tgl_simpan', 'DESC')
                        ->findAll();
        }
        
        return $this->orderBy('tgl_simpan', 'DESC')->findAll();
    }

    /**
     * Get a specific leave request by ID
     * 
     * @param int $id Leave request ID
     * @return array|null Leave request data
     */
    public function getCutiById($id)
    {
        return $this->find($id);
    }

    /**
     * Get all pending leave requests
     * 
     * @return array Pending leave requests
     */
    public function getPendingRequests()
    {
        return $this->where('status', '0')
                    ->orderBy('tgl_simpan', 'DESC')
                    ->findAll();
    }

    /**
     * Get all approved leave requests
     * 
     * @return array Approved leave requests
     */
    public function getApprovedRequests()
    {
        return $this->where('status', '1')
                    ->orderBy('tgl_simpan', 'DESC')
                    ->findAll();
    }

    /**
     * Get all rejected leave requests
     * 
     * @return array Rejected leave requests
     */
    public function getRejectedRequests()
    {
        return $this->where('status', '2')
                    ->orderBy('tgl_simpan', 'DESC')
                    ->findAll();
    }

    /**
     * Approve a leave request
     * 
     * @param int $id Leave request ID
     * @param int $id_manajemen Manager/HR ID who approved the request
     * @param string $catatan Notes/comments from the manager
     * @return bool Success status
     */
    public function approveRequest($id, $id_manajemen, $catatan = '')
    {
        return $this->update($id, [
            'status' => '1',
            'id_manajemen' => $id_manajemen,
            'catatan' => $catatan,
            'tgl_modif' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reject a leave request
     * 
     * @param int $id Leave request ID
     * @param int $id_manajemen Manager/HR ID who rejected the request
     * @param string $catatan Reason for rejection
     * @return bool Success status
     */
    public function rejectRequest($id, $id_manajemen, $catatan = '')
    {
        return $this->update($id, [
            'status' => '2',
            'id_manajemen' => $id_manajemen,
            'catatan' => $catatan,
            'tgl_modif' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Check if employee has overlapping leave requests
     * 
     * @param int $id_karyawan Employee ID
     * @param string $tgl_masuk Start date
     * @param string $tgl_keluar End date
     * @param int|null $exclude_id Exclude this request ID (for updates)
     * @return bool True if overlapping requests exist
     */
    public function hasOverlappingRequests($id_karyawan, $tgl_masuk, $tgl_keluar, $exclude_id = null)
    {
        $builder = $this->where('id_karyawan', $id_karyawan)
                        ->where('status', '1') // Only check approved requests
                        ->groupStart()
                            ->where("('$tgl_masuk' BETWEEN tgl_masuk AND tgl_keluar)")
                            ->orWhere("('$tgl_keluar' BETWEEN tgl_masuk AND tgl_keluar)")
                            ->orWhere("(tgl_masuk BETWEEN '$tgl_masuk' AND '$tgl_keluar')")
                            ->orWhere("(tgl_keluar BETWEEN '$tgl_masuk' AND '$tgl_keluar')")
                        ->groupEnd();
        
        if ($exclude_id) {
            $builder->where('id !=', $exclude_id);
        }
        
        return $builder->countAllResults() > 0;
    }

    /**
     * Get leave requests with employee and category information
     * 
     * @param array $filters Optional filters
     * @return array Leave requests with details
     */
    public function getCutiWithDetails($filters = [])
    {
        $builder = $this->db->table('tbl_sdm_cuti c')
            ->select('c.*, k.nama as nama_karyawan, k.kode as kode_karyawan, kat.kategori as nama_kategori')
            ->join('tbl_m_karyawan k', 'k.id = c.id_karyawan', 'left')
            ->join('tbl_m_kategori kat', 'kat.id = c.id_kategori', 'left');
        
        // Apply filters if provided
        if (!empty($filters)) {
            foreach ($filters as $field => $value) {
                if ($value !== null && $value !== '') {
                    $builder->where("c.$field", $value);
                }
            }
        }
        
        return $builder->orderBy('c.tgl_simpan', 'DESC')->get()->getResultArray();
    }

    /**
     * Generate a document number for leave requests
     * 
     * Format: CUTI/[CATEGORY_CODE]/[SEQUENTIAL_NUMBER]/[MONTH_ROMAN]/[YEAR]
     * 
     * @param int $id_kategori Leave category ID
     * @return string Formatted document number
     */
    public function generateDocumentNumber($id_kategori)
    {
        // Get category code
        $kategori = $this->db->table('tbl_m_kategori')
                            ->where('id', $id_kategori)
                            ->get()
                            ->getRowArray();
        
        $kode_kategori = $kategori['kode'] ?? 'XXX';
        
        // Get current year and month
        $year = date('Y');
        $month = date('n');
        $roman_month = $this->getRomanMonth($month);
        
        // Get sequential number
        $count = $this->db->table('tbl_sdm_cuti')
                        ->where('YEAR(tgl_simpan)', $year)
                        ->where('MONTH(tgl_simpan)', $month)
                        ->countAllResults();
        
        $sequential = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        
        // Format: CUTI/[CATEGORY_CODE]/[SEQUENTIAL_NUMBER]/[MONTH_ROMAN]/[YEAR]
        return "CUTI/{$kode_kategori}/{$sequential}/{$roman_month}/{$year}";
    }
    
    /**
     * Convert month number to Roman numeral
     * 
     * @param int $month Month number (1-12)
     * @return string Roman numeral
     */
    private function getRomanMonth($month)
    {
        $romans = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];
        
        return $romans[$month] ?? 'I';
    }

    /**
     * Handle file upload for leave requests
     * 
     * @param object $file Uploaded file object
     * @param int $id_user User ID
     * @return array|bool File data on success, false on failure
     */
    public function handleFileUpload($file, $id_user)
    {
        // Check if file exists and is valid
        if (!$file || !$file->isValid() || $file->getSize() <= 0) {
            log_message('error', 'File upload failed: No valid file provided');
            return false;
        }
        
        try {
            // Create directory if it doesn't exist
            $uploadPath = FCPATH . 'uploads/cuti/' . $id_user;
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Move the file
            if (!$file->move($uploadPath)) {
                log_message('error', 'File upload failed: ' . $file->getErrorString());
                return false;
            }
            
            // Return file data
            return [
                'file_name' => $file->getName(),
                'file_type' => $file->getClientMimeType(),
                'file_ext' => $file->getClientExtension()
            ];
        } catch (\Exception $e) {
            log_message('error', 'File upload exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if a file is an image based on its extension or MIME type
     * 
     * @param string $file_ext File extension
     * @param string $file_type File MIME type
     * @return bool True if the file is an image
     */
    public function isImage($file_ext = null, $file_type = null)
    {
        // List of common image extensions
        $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        
        // Check by extension
        if (!empty($file_ext) && in_array(strtolower($file_ext), $image_extensions)) {
            return true;
        }
        
        // Check by MIME type
        if (!empty($file_type) && strpos($file_type, 'image/') === 0) {
            return true;
        }
        
        return false;
    }

    /**
     * Get the URL for viewing a file
     * 
     * @param string $file_name File name/path
     * @return string URL to the file
     */
    public function getFileUrl($file_name)
    {
        if (empty($file_name)) {
            return '';
        }
        
        // If the file path already starts with http, return it as is
        if (strpos($file_name, 'http') === 0) {
            return $file_name;
        }
        
        // Otherwise, prepend the base URL
        return base_url($file_name);
    }
} 