<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Employee Leave/Time-off Model
 * 
 * This model handles employee leave/time-off data.
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-13
 */
class mKaryawanCuti extends Model
{
    protected $table         = 'tbl_m_karyawan_cuti';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $returnType    = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_karyawan', 
        'id_user', 
        'tgl_simpan', 
        'tgl_modif', 
        'tgl_masuk', 
        'tgl_keluar', 
        'kode', 
        'keterangan', 
        'status'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
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
     * @return bool Success status
     */
    public function approveRequest($id)
    {
        return $this->update($id, [
            'status' => '1',
            'tgl_modif' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reject a leave/time-off request
     * 
     * @param int $id Leave/time-off record ID
     * @return bool Success status
     */
    public function rejectRequest($id)
    {
        return $this->update($id, [
            'status' => '2',
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
} 