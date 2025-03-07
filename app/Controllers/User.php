<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\IonAuth;
use App\Models\UserModel;
use CodeIgniter\Session\Session;
use CodeIgniter\Database\Database;

class User extends BaseController
{
    protected $ionAuth;
    protected $session;
    protected $db;

    public function __construct(IonAuth $ionAuth, Session $session, Database $db)
    {
        $this->ionAuth = $ionAuth;
        $this->session = $session;
        $this->db = $db;
    }

    public function hapus_foto()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/');
        }

        $user_id = $this->ionAuth->user()->row()->id;
        $user = $this->ionAuth->user($user_id)->row();
        
        if (!empty($user->file_name)) {
            $file_path = FCPATH . 'file/profile/' . $user->file_name;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            
            // Update database to remove file name
            $this->db->table('users')
                     ->where('id', $user_id)
                     ->update(['file_name' => null]);
                     
            $this->session->setFlashdata('message', 'Foto profil berhasil dihapus.');
        }
        
        return redirect()->to('user/profile');
    }
} 