<?php

namespace App\Controllers;

/**
 * Description of Login
 *
 * @author mike
 */
class Login extends BaseController {

    protected $configIonAuth;
    protected $ionAuth;
    protected $session;
    protected $validation;

    public function __construct() {
        $this->publics = getenv('app.publics') ?: base_url('public');
    }

    public function index() {
        if (!$this->ionAuth->loggedIn()){
            $data  = [
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
            ];
            
            return view($this->ThemePath.'/user/login', $data);
        }else{
            return redirect()->to(base_url('dashboard.php'));
        }
    }

    public function cek_login() {
        # Load helper validasi
        $validasi   = \Config\Services::validation();
        $recaptcha  = \Config\Services::recaptcha2();
        
        $user       = $this->input->getVar('user');
        $pass       = $this->input->getVar('pass');
        $inga       = $this->input->getVar('ingat');
        $capt       = $this->input->getVar('reCaptcha2');
        
        # Aturan validasi form tulis disini
        $aturan = [
            'user'  => [
                'rules'     => 'required|min_length[3]',
                'errors'    => [
                    'required'      => 'ID Pengguna tidak boleh kosong',
                    'min_length'    => 'Kolom {field} minimal 3 huruf',
                ]
            ],
            'pass'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Kata sandi tidak boleh kosong',
                ]
            ]
        ];
        
        # Simpan config validasi
        $validasi->setRules($aturan);
        
        # Jalankan validasi
        if(!$this->validate($aturan)){
            $psn_gagal = [
                'user'  => $validasi->getError('user'),
                'pass'  => $validasi->getError('pass'),
            ];
            
            $this->session->setFlashdata('psn_gagal', $psn_gagal);
            
            return redirect('/');
        }else{
            $is_valid = $recaptcha->verify($capt);
            
            # Pastikan manusia yang klik captcha bukan anak tuyul
            if($is_valid->isSuccess() == 1){
                $inget_ya   = ($inga == '1' ? 'TRUE' : 'FALSE');
                $login      = $this->ionAuth->login($user, $pass, $inget_ya);
                                
                # Cek loginnya, jika bener lanjut
                if($login == FALSE){
                    $this->session->setFlashdata('login_toast', 'toastr.error("ID atau Kata sandi tidak valid !!");');
                    return redirect()->to(base_url('/'));
                }else{
                    return redirect()->to(base_url('dashboard.php'));
                }
            }else{
                $this->session->setFlashdata('login_toast', 'toastr.error("Captcha tidak valid !!");');
                return redirect()->to(base_url('/'));
            }
        }
    }
    
    public function logout() {
        $this->ionAuth->logout();
        
        $this->session->setFlashdata('login_toast', 'toastr.error("Anda berhasil keluar !!");');
        return redirect()->to(base_url());
    }

}
