<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Employee Leave/Time-off Model (trSdmCuti)
 * 
 * This model handles employee leave/time-off data using the trSDMCuti table.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2023-06-23
 */
class trSdmCuti extends Model
{
    protected $table         = 'tbl_sdm_cuti';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $returnType    = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_karyawan', 
        'id_user', 
        'id_manajemen',
        'id_kategori',
        'tgl_simpan', 
        'tgl_modif', 
        'tgl_masuk', 
        'tgl_keluar', 
        'keterangan',
        'no_surat',
        'ttd',
        'file_name',
        'file_type',
        'file_ext',
        'catatan',
        'status'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_simpan';
    protected $updatedField  = 'tgl_modif';
    protected $deletedField  = '';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get employee leave/time-off data by employee ID
     * 
     * @param int $id_karyawan Employee ID
     * @return array Employee leave/time-off data
     */
    public function getCuti($id_karyawan)
    {
        return $this->where('id_karyawan', $id_karyawan)
                    ->orderBy('tgl_masuk', 'DESC')
                    ->findAll();
    }

    /**
     * Get employee leave/time-off data by ID
     * 
     * @param int $id Leave/time-off record ID
     * @return array|null Employee leave/time-off data
     */
    public function getCutiById($id)
    {
        return $this->find($id);
    }

    /**
     * Get pending leave/time-off requests
     * 
     * @return array Pending leave/time-off requests
     */
    public function getPendingRequests()
    {
        return $this->where('status', '0')
                    ->orderBy('tgl_simpan', 'DESC')
                    ->findAll();
    }

    /**
     * Get approved leave/time-off requests
     * 
     * @return array Approved leave/time-off requests
     */
    public function getApprovedRequests()
    {
        return $this->where('status', '1')
                    ->orderBy('tgl_simpan', 'DESC')
                    ->findAll();
    }

    /**
     * Get rejected leave/time-off requests
     * 
     * @return array Rejected leave/time-off requests
     */
    public function getRejectedRequests()
    {
        return $this->where('status', '2')
                    ->orderBy('tgl_simpan', 'DESC')
                    ->findAll();
    }

    /**
     * Approve a leave/time-off request
     * 
     * @param int $id Leave/time-off record ID
     * @param int $id_manajemen Manager/HR ID who approved the request
     * @param string $catatan Optional notes from management
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
     * Reject a leave/time-off request
     * 
     * @param int $id Leave/time-off record ID
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
     * Check if employee has overlapping leave/time-off requests
     * 
     * @param int $id_karyawan Employee ID
     * @param string $tgl_masuk Start date
     * @param string $tgl_keluar End date
     * @param int|null $exclude_id ID to exclude from check (for updates)
     * @return bool True if overlapping requests exist
     */
    public function hasOverlappingRequests($id_karyawan, $tgl_masuk, $tgl_keluar, $exclude_id = null)
    {
        $builder = $this->where('id_karyawan', $id_karyawan)
                        ->where('status !=', '2') // Not rejected
                        ->groupStart()
                            ->where("('$tgl_masuk' BETWEEN tgl_masuk AND tgl_keluar)")
                            ->orWhere("('$tgl_keluar' BETWEEN tgl_masuk AND tgl_keluar)")
                            ->orWhere("(tgl_masuk BETWEEN '$tgl_masuk' AND '$tgl_keluar')")
                            ->orWhere("(tgl_keluar BETWEEN '$tgl_masuk' AND '$tgl_keluar')")
                        ->groupEnd();
        
        // Exclude current record if updating
        if ($exclude_id) {
            $builder->where('id !=', $exclude_id);
        }
        
        return $builder->countAllResults() > 0;
    }

    /**
     * Get leave requests with employee and category information
     * 
     * @param array $filters Optional filters
     * @return array Leave requests with related information
     */
    public function getCutiWithDetails($filters = [])
    {
        $builder = $this->db->table($this->table . ' c')
            ->select('c.*, k.nama as nama_karyawan, k.nik, kat.nama as nama_kategori')
            ->join('tbl_m_karyawan k', 'k.id = c.id_karyawan', 'left')
            ->join('tbl_m_kategori kat', 'kat.id = c.id_kategori', 'left');
        
        // Apply filters if provided
        if (!empty($filters)) {
            foreach ($filters as $field => $value) {
                if ($value !== '') {
                    $builder->where("c.$field", $value);
                }
            }
        }
        
        return $builder->orderBy('c.tgl_simpan', 'DESC')->get()->getResultArray();
    }

    /**
     * Generate leave document number
     * 
     * @param int $id_kategori Category ID
     * @return string Generated document number
     */
    public function generateDocumentNumber($id_kategori)
    {
        $year = date('Y');
        $month = date('m');
        
        // Get category code
        $kategoriModel = new \App\Models\mKategori();
        $kategori = $kategoriModel->find($id_kategori);
        $kategoriCode = $kategori ? $kategori['kode'] : 'CT';
        
        // Count existing documents for this month and year
        $count = $this->where('YEAR(tgl_simpan)', $year)
                      ->where('MONTH(tgl_simpan)', $month)
                      ->countAllResults();
        
        // Format: CT/001/VI/2023
        $sequence = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $romanMonth = $this->getRomanMonth($month);
        
        return $kategoriCode . '/' . $sequence . '/' . $romanMonth . '/' . $year;
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
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        
        return $romans[(int)$month] ?? '';
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