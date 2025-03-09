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
                    $path       = FCPATH.'/';
                    $dir        = 'file/profile/userid_'.$IDUser.'/';
                    $filename   = 'profile_'.strtolower(str_replace(' ', '', $IDUser.$user)).'.'.$fupl->getClientExtension();
                    $fullname   = $dir.$filename;

                    # Check if directory exists, if not create it
                    if (!is_dir($path.$dir)) {
                        mkdir($path.$dir, 0777, true);
                    }

                    # Jika valid lanjut upload file logo
                    if ($fupl->isValid() && !$fupl->hasMoved()) {
                        $fupl->move($path.$dir, $filename, true);
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
                            'file_name'     => (!empty($fupl->getClientExtension()) ? $fullname : $this->ionAuth->user($sql_cek->id_user)->row()->file_name)
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
                            'file_name'     => (!empty($fupl->getClientExtension()) ? $fullname : $this->ionAuth->user($sql_cek->id_user)->row()->file_name)
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

    public function data_keluarga($id) {
        if (!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
        
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();

        $Karyawan   = new \App\Models\mKaryawan();
        $Keluarga   = new \App\Models\mKaryawanKel();
        
        // Get employee data
        $sql_kary   = $Karyawan->asObject()->where('id', $id)->first();
        
        // If employee not found, redirect to profile
        if (!$sql_kary) {
            $this->session->setFlashdata('error', 'Data karyawan tidak ditemukan');
            return redirect()->to(base_url("profile/{$ID->id}"));
        }
        
        // Get family data
        $sql_kel    = $Keluarga->asObject()->where('id_karyawan', $id)->findAll();
                                
        $data  = [
            'SQLKary'       => $sql_kary,
            'SQLKel'        => $sql_kel,
            'MenuAktif'     => 'active',
            'MenuOpen'      => 'menu-open',
            'AksesGrup'     => $AksesGrup,
            'Pengguna'      => $ID,
            'PenggunaGrup'  => $IDGrup,
            'Pengaturan'    => $this->Setting,
            'ThemePath'     => $this->ThemePath,
            'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
            'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
            'konten'        => $this->ThemePath.'/user/profile_kel',
        ];
        
        return view($this->ThemePath.'/index', $data); 
    }
    
    /**
     * Save employee family data
     * 
     * @param int $id Employee ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function simpan_data_kel()
    {        
        // Get current user data
        $id        = $this->request->getPost('id');
        $id_kary   = $this->request->getPost('id_karyawan');
        $IDUser    = $this->request->getPost('id_user');
        $user      = $this->ionAuth->user($IDUser)->row()->username;
        
        // Load models
        $karyawanModel = new \App\Models\mKaryawan();
        $keluargaModel = new \App\Models\mKaryawanKel();
        
        // Set validation rules
        $validationRules = [
            'nm_ayah' => [
                'rules' => 'required|min_length[3]|max_length[160]',
                'errors' => [
                    'required' => 'Nama Ayah harus diisi',
                    'min_length' => 'Nama Ayah minimal 3 karakter',
                    'max_length' => 'Nama Ayah maksimal 160 karakter'
                ]
            ],
            'nm_ibu' => [
                'rules' => 'required|min_length[3]|max_length[160]',
                'errors' => [
                    'required' => 'Nama Ibu harus diisi',
                    'min_length' => 'Nama Ibu minimal 3 karakter',
                    'max_length' => 'Nama Ibu maksimal 160 karakter'
                ]
            ],
            'tgl_lhr_ayah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir ayah harus diisi'
                ]
            ],
            'tgl_lhr_ibu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir ibu harus diisi'
                ]
            ],
            'file_kk' => [
                'rules' => 'permit_empty|uploaded[file_kk,0]|max_size[file_kk,2048]|mime_in[file_kk,image/jpg,image/jpeg,image/png,application/pdf]|ext_in[file_kk,jpg,jpeg,png,pdf,tif]',
                'errors' => [
                    'max_size' => 'Ukuran file KK maksimal 2MB',
                    'mime_in' => 'Format file KK tidak valid (jpg/jpeg/png/pdf/tif)',
                    'ext_in' => 'Ekstensi file KK tidak valid (jpg/jpeg/png/pdf/tif)'
                ]
            ],
            'file_ktp' => [
                'rules' => 'permit_empty|uploaded[file_ktp,0]|max_size[file_ktp,2048]|mime_in[file_ktp,image/jpg,image/jpeg,image/png,application/pdf]|ext_in[file_ktp,jpg,jpeg,png,pdf,tif]',
                'errors' => [
                    'max_size' => 'Ukuran file KTP maksimal 2MB',
                    'mime_in' => 'Format file KTP tidak valid (jpg/jpeg/png/pdf/tif)',
                    'ext_in' => 'Ekstensi file KTP tidak valid (jpg/jpeg/png/pdf/tif)'
                ]
            ]
        ];
        
        // Run validation
        if (!$this->validate($validationRules)) {
            // Validation failed, return to form with errors
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            // return redirect()->to(base_url("profile/sdm/data_keluarga/{$id}"));

            echo base_url("profile/sdm/data_keluarga/{$id}");
        }

        // Get employee data
        $SQLKary = $karyawanModel->asObject()->where('id', $id_kary)->first();
        $SQLKel  = $keluargaModel->asObject()->where('id', $id)->orderBy('id', 'DESC')->first();
        
        // Get form data
        $data = [
            'id'            => $id,
            'id_karyawan'   => $id_kary,
            'id_user'       => $this->ionAuth->user()->row()->id,
            'tgl_simpan'    => date('Y-m-d H:i:s'),
            'nm_ayah'       => $this->request->getPost('nm_ayah'),
            'nm_ibu'        => $this->request->getPost('nm_ibu'), 
            'nm_pasangan'   => $this->request->getPost('nm_pasangan'),
            'nm_anak'       => $this->request->getPost('nm_anak'),
            'tgl_lhr_ayah'  => $this->request->getPost('tgl_lhr_ayah'),
            'tgl_lhr_ibu'   => $this->request->getPost('tgl_lhr_ibu'),
            'tgl_lhr_psg'   => $this->request->getPost('tgl_lhr_psg'),
            'jns_pasangan'  => $this->request->getPost('jns_pasangan'),
            'status_kawin'  => $this->request->getPost('status_kawin')
        ];
        
        // Check if record ID exists (update case)
        $record_id  = $this->request->getPost('id');
        
        // Handle file upload for KK
        $file_kk    = $this->request->getFile('file_kk');

        $path       = FCPATH.'/';
        $dir        = 'file/profile/userid_'.$IDUser.'/';

        if ($file_kk && $file_kk->isValid() && !$file_kk->hasMoved()) {
            // Generate filename using user info
            $filename_kk = 'kk_'.strtolower(str_replace(' ', '', $IDUser.$user)).'.'.$file_kk->getClientExtension();
            $fullname_kk = $dir.$filename_kk;
            
            // Create directory if it doesn't exist
            if (!is_dir($path.$dir)) {
                mkdir($path.$dir, 0777, true);
            }
            
            // Move the file to the upload directory
            $file_kk->move($path.$dir, $filename_kk, true);
            
            // Update data array with file information
            $data['file_name'] = $fullname_kk;
            $data['file_ext'] = $file_kk->getClientExtension();
            $data['file_type'] = $file_kk->getClientMimeType();
        }
        
        // Handle file upload for KTP
        $file_ktp = $this->request->getFile('file_ktp');
        if ($file_ktp && $file_ktp->isValid() && !$file_ktp->hasMoved()) {
            // Generate filename using user info
            $filename_ktp = 'ktp_'.strtolower(str_replace(' ', '', $IDUser.$user)).'.'.$file_ktp->getClientExtension();
            $fullname_ktp = $dir.$filename_ktp;
            
            // Create directory if it doesn't exist
            if (!is_dir($path.$dir)) {
                mkdir($path.$dir, 0777, true);
            }
            
            // Move the file to the upload directory  
            $file_ktp->move($path.$dir, $filename_ktp, true);
            
            // Update data array with file information
            $data['file_name_ktp'] = $fullname_ktp;
            $data['file_ext_ktp'] = $file_ktp->getClientExtension();
            $data['file_type_ktp'] = $file_ktp->getClientMimeType();
        }
        
        try {
            $keluargaModel->save($data);
            $this->session->setFlashdata('pesan', 'Data keluarga berhasil disimpan');
            
            return redirect()->to(base_url("profile/sdm/data_keluarga/{$id_kary}"));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->to(base_url("profile/sdm/data_keluarga/{$id}"));
        }
    }

    /**
     * Edit employee family data
     * 
     * @param int $id Family data ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function edit_data_keluarga($id)
    {
        if (!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
        
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();

        $Keluarga   = new \App\Models\mKaryawanKel();
        $Karyawan   = new \App\Models\mKaryawan();
        
        // Get family data
        $sql_kel    = $Keluarga->asObject()->where('id', $id)->first();
        
        // If family data not found, redirect to profile
        if (!$sql_kel) {
            $this->session->setFlashdata('error', 'Data keluarga tidak ditemukan');
            return redirect()->to(base_url("profile/{$ID->id}"));
        }
        
        // Get employee data
        $sql_kary   = $Karyawan->asObject()->where('id', $sql_kel->id_karyawan)->first();
        
        $data  = [
            'SQLKary'       => $sql_kary,
            'SQLKel'        => $sql_kel,
            'MenuAktif'     => 'active',
            'MenuOpen'      => 'menu-open',
            'AksesGrup'     => $AksesGrup,
            'Pengguna'      => $ID,
            'PenggunaGrup'  => $IDGrup,
            'Pengaturan'    => $this->Setting,
            'ThemePath'     => $this->ThemePath,
            'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
            'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
            'konten'        => $this->ThemePath.'/user/profile_kel',
        ];
        
        return view($this->ThemePath.'/index', $data);
    }
    
    /**
     * Delete employee family data
     * 
     * @param int $id Family data ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function hapus_data_keluarga($id)
    {
        if (!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
        
        $Keluarga   = new \App\Models\mKaryawanKel();
        
        // Get family data
        $sql_kel    = $Keluarga->asObject()->where('id', $id)->first();
        
        // If family data not found, redirect to profile
        if (!$sql_kel) {
            $this->session->setFlashdata('error', 'Data keluarga tidak ditemukan');
            return redirect()->to(base_url("profile/{$this->ionAuth->user()->row()->id}"));
        }
        
        $id_karyawan = $sql_kel->id_karyawan;
        
        try {
            // Delete file if exists
            if (!empty($sql_kel->file_name)) {
                $file_path = ROOTPATH . 'public/file/keluarga/' . $sql_kel->file_name;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            // Delete KTP file if exists
            if (!empty($sql_kel->file_name_ktp)) {
                $file_path = ROOTPATH . 'public/file/keluarga/' . $sql_kel->file_name_ktp;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            // Delete record
            $Keluarga->delete($id);
            
            $this->session->setFlashdata('pesan', 'Data keluarga berhasil dihapus');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
        return redirect()->to(base_url("profile/sdm/data_keluarga/{$id_karyawan}"));
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
            $file_path = FCPATH . $user->file_name;
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