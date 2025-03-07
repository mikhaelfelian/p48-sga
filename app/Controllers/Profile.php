<?php

namespace App\Controllers;

use App\Models\PengaturanProfile;

/**
 * Description of Profile
 *
 * @author mike
 */
class Profile extends BaseController {
    //put your code here
    public function __construct() {
        
    }

    public function index($id){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $kat        = $this->input->getVar('filter_kat');
            $ket        = $this->input->getVar('filter_ket');
            $hlmn       = $this->input->getVar('page');

            $Kategori   = new \App\Models\mKategori();
            $Karyawan   = new \App\Models\mKaryawan();
            $sql_kat    = $Kategori->asObject()->orderBy('id', 'DESC'); //->like('kategori', (!empty($kat) ? $kat : ''))->like('keterangan', (!empty($ket) ? $ket : ''));
            $sql_kary   = $Karyawan->asObject()->where('id_user', $ID->id)->first();
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLKary'       => $sql_kary,
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
                'konten'        => $this->ThemePath.'/user/profile',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function profile_set_update() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $IDKary     = $this->input->getVar('id');
            $IDUser     = $this->input->getVar('id_user');
            $nik        = $this->input->getVar('nik');
            $nama       = $this->input->getVar('nama');
            $nama2      = $this->input->getVar('nama_blk');
            $jns_klm    = $this->input->getVar('jns_klm');
            $hp         = $this->input->getVar('no_hp');
            $almt       = $this->input->getVar('alamat');
            $almt2      = $this->input->getVar('alamat_dom');
            $tmp_lhr    = $this->input->getVar('tmp_lahir');
            $tgl_lhr    = $this->input->getVar('tgl_lahir');
            $fupl       = $this->request->getFile('fupload');
            $user       = $this->input->getVar('user');
            $pass1      = $this->input->getVar('pass');
            $pass2      = $this->input->getVar('pass2');
            $grup       = $this->input->getVar('grup');

            $Kry        = new \App\Models\mKaryawan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'nik'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'NIK tidak boleh kosong',
                    ]
                ],
                'nama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Nama tidak boleh kosong',
                    ]
                ],
                'alamat'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Alamat supplier tidak boleh kosong',
                    ]
                ],
                'jns_klm'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Jenis kelamin tidak boleh kosong',
                    ]
                ],
                'pass2'  => [
                    'rules'     => 'matches[pass]',
                    'errors'    => [
                        'matches'      => 'Kata sandi tidak sama',
                    ]
                ],
                'grup'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Grup tidak boleh kosong',
                    ]
                ],
                'fupload' => [
                    'rules'     => 'is_image[fupload]|max_size[fupload,2048]',
                    'errors'    => [
//                        'uploaded' => 'Berkas unggah tidak tersedia',
                        'is_image' => 'Berkas harus berupa gambar',
                        'max_size' => 'Berkas harus berukuran maksimal 2MB',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id'        => $validasi->getError('nama'),
                    'nik'       => $validasi->getError('nik'),
                    'nama'      => $validasi->getError('nama'),
                    'alamat'    => $validasi->getError('alamat'),
                    'jns_klm'   => $validasi->getError('jns_klm'),
                    'pass2'     => $validasi->getError('pass2'),
                    'grup'      => $validasi->getError('grup'),
                    'fupload'   => $validasi->getError('fupload'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);
                
                if(!empty($validasi->getError('pass2'))){
                    $this->session->setFlashdata('pengaturan_toast', 'toastr.error("'.$validasi->getError('pass2').'");');
                }

                return redirect()->to(base_url('profile/'.$IDKary));
            }else{
                $sql_cek    = $Kry->asObject()->where('id', $IDKary)->first();
                
                # Cek username existing
                if($this->ionAuth->usernameCheck($user) AND $ID->username != $user){
                    $this->session->setFlashdata('pengaturan_toast', 'toastr.error("Username sudah digunakan, silahkan ulangi !");');
                    return redirect()->to(base_url('profile/'.$IDKary));
                }else{                
                    # Muat library untuk unggah file
                    # $path untuk mengatur lokasi unggah file
                    $path       = FCPATH.'file/profile/';
                    $filename   = 'profile_'.strtolower(str_replace(' ', '', $IDUser.$user)).'.'.$fupl->getClientExtension();

                    # Jika valid lanjut upload file logo
                    if ($fupl->isValid() && !$fupl->hasMoved()) {
                        $fupl->move($path, $filename, true);
                    }
                    
                    # Cek file
                    $file  = new \CodeIgniter\Files\File($path.$filename);
                
                    if(!empty($pass2)){
                        $data_user = [
                            'username'      => $user,
                            'first_name'    => $nama,
                            'last_name'     => $nama2,
                            'birthdate'     => tgl_indo_sys($tgl_lhr),
                            'password'      => $pass2,
                            'file_name'     => (!empty($fupl->getClientExtension()) ? $filename : $this->ionAuth->user($sql_cek->id_user)->row()->file_name)
                        ];

                        $this->ionAuth->update($IDUser, $data_user);
                        $this->ionAuth->removeFromGroup($sql_cek->id_user_group, $IDUser);
                        $this->ionAuth->addToGroup($grup, $IDUser);                    
                    }else{
                        $data_user = [
                            'username'      => $user,
                            'first_name'    => $nama,
                            'last_name'     => $nama2,
                            'birthdate'     => tgl_indo_sys($tgl_lhr),
                            'file_name'     => (!empty($fupl->getClientExtension()) ? $filename : $this->ionAuth->user($sql_cek->id_user)->row()->file_name)
                        ];

                        $this->ionAuth->update($IDUser, $data_user);
                        $this->ionAuth->removeFromGroup($sql_cek->id_user_group, $IDUser);
                        $this->ionAuth->addToGroup($grup, $IDUser);
                    }                    
                }
                
                $data = [
                    'id'            => $IDKary,
                    'id_user_group' => $grup,
                    'nik'           => $nik,
                    'nama'          => $nama,
                    'nama_blk'      => $nama2,
                    'jns_klm'       => $jns_klm,
                    'no_hp'         => $hp,
                    'alamat'        => $almt,
                    'alamat_dom'    => $almt2,
                    'tmp_lahir'     => $tmp_lhr,
                    'tgl_lahir'     => tgl_indo_sys($tgl_lhr),
                ];

                $Kry->save($data);
                $last_id = $IDKary;

                if($last_id > 0){
                    $this->session->setFlashdata('pengaturan_toast', 'toastr.success("Profile pengguna berhasil disimpan !!");');
                }

                return redirect()->to(base_url('profile/'.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }  

    public function data_keluarga() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $hlmn       = $this->input->getVar('page');

            $Keluarga   = new \App\Models\mKeluarga();
            $sql_kel    = $Keluarga->asObject()->where('id_user', $ID->id)->orderBy('id', 'DESC')->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLKeluarga'   => $sql_kel->paginate($jml_limit),
                'Pagination'    => $Keluarga->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/profile/menu_kiri',
                'konten'        => $this->ThemePath.'/profile/data_keluarga',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function hapus_foto($id = null)
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/');
        }

        // Get current user ID if no ID provided
        $IDUser = ($id === null) ? $this->ionAuth->user()->row()->id : $id;
        
        // Get user data
        $user = $this->ionAuth->user($IDUser)->row();
        
        if (!empty($user->file_name)) {
            // Delete physical file
            $file_path = FCPATH . 'file/profile/' . $user->file_name;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            
            // Update user data
            $data_user = [
                'file_name' => null
            ];
            
            if ($this->ionAuth->update($IDUser, $data_user)) {
                $this->session->setFlashdata('message', 'Foto profil berhasil dihapus');
                $this->session->setFlashdata('message_type', 'success');
            } else {
                $this->session->setFlashdata('message', 'Gagal menghapus foto profil');
                $this->session->setFlashdata('message_type', 'error');
            }
        }
        
        return redirect()->to('profile/'.$IDUser);
    }
} 