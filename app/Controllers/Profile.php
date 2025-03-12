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

    public function index(){
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

    public function data_keluarga() {
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
        $sql_kary   = $Karyawan->asObject()->where('id', $ID->id)->first();
        
        // If employee not found, redirect to profile
        if (!$sql_kary) {
            $this->session->setFlashdata('error', 'Data karyawan tidak ditemukan');
            return redirect()->to(base_url("profile/{$ID->id}"));
        }
        
        // Get family data
        $sql_kel    = $Keluarga->getKeluarga();
                                
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
            ]
        ];
        
        // Run validation
        if (!$this->validate($validationRules)) {
            // Validation failed, return to form with errors
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url("profile/sdm/data_keluarga/{$id}"));
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
            'nm_ayah'        => $this->request->getPost('nm_ayah'),
            'nm_ibu'         => $this->request->getPost('nm_ibu'), 
            'nm_pasangan'    => $this->request->getPost('nm_pasangan'),
            'nm_anak'         => $this->request->getPost('nm_anak'),
            'tgl_lhr_ayah'   => !empty($this->request->getPost('tgl_lhr_ayah')) ? tgl_indo_sys($this->request->getPost('tgl_lhr_ayah')) : '0000-00-00',
            'tgl_lhr_ibu'    => !empty($this->request->getPost('tgl_lhr_ibu')) ? tgl_indo_sys($this->request->getPost('tgl_lhr_ibu')) : '0000-00-00',
            'tgl_lhr_psg'     => !empty($this->request->getPost('tgl_lhr_psg')) ? tgl_indo_sys($this->request->getPost('tgl_lhr_psg')) : '0000-00-00',
            'jns_pasangan'    => $this->request->getPost('jns_pasangan'),
            'status_kawin'     => $this->request->getPost('status_kawin')
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
            
            return redirect()->back()->with('success', 'Data keluarga berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Edit employee family data
     * 
     * @param int $id Family data ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function data_keluarga_edit($id)
    {   
        $id_kel     = $this->request->getVar('id');
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();

        $Keluarga   = new \App\Models\mKaryawanKel();
        $Karyawan   = new \App\Models\mKaryawan();
        
        // Get family data
        $sql_kel_row    = $Keluarga->asObject()->where('id', $id)->first();
        
        // If family data not found, redirect to profile
        if (!$sql_kel_row) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: Data keluarga tidak ditemukan');
        }
        
        // Get employee data
        $sql_kary   = $Karyawan->asObject()->where('id', $sql_kel_row->id_karyawan)->first();
        $sql_kel    = $Keluarga->getKeluarga();
        
        $data  = [
            'SQLKary'       => $sql_kary,
            'SQLKelRw'      => $sql_kel_row,
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
    public function data_keluarga_hapus($id)
    {        
        $Keluarga   = new \App\Models\mKaryawanKel();
        
        // Get family data
        $sql_kel    = $Keluarga->asObject()->where('id', $id)->first();
        
        // If family data not found, redirect to profile
        if (!$sql_kel) {
            return redirect()->back()->with('error', 'Data keluarga tidak ditemukan');
        }
        
        $id_karyawan = $sql_kel->id_karyawan;
        
        try {
            // Delete file if exists
            if (!empty($sql_kel->file_name)) {
                $file_path = ROOTPATH . 'public/' . $sql_kel->file_name;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            // Delete KTP file if exists
            if (!empty($sql_kel->file_name_ktp)) {
                $file_path = ROOTPATH . 'public/' . $sql_kel->file_name_ktp;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            // Delete record
            $Keluarga->delete($id);
            return redirect()->back()->with('success', 'Data keluarga berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display employee education data form and list
     * 
     * @param int $id_karyawan Optional employee ID
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function data_pendidikan($id_karyawan = null)
    {
        if (!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('error', 'Sesi berakhir, silahkan login kembali!');
            return redirect()->to(base_url());
        }
        
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();

        $Karyawan   = new \App\Models\mKaryawan();
        $Pendidikan = new \App\Models\mKaryawanPend();
        
        // If id_karyawan is not provided, use the current user's ID
        if (empty($id_karyawan)) {
            $id_karyawan = $ID->id;
        }
        
        // Get employee data
        $sql_kary = $Karyawan->asObject()->where('id', $id_karyawan)->first();
        
        // If employee not found, redirect to profile
        if (!$sql_kary) {
            $this->session->setFlashdata('error', 'Data karyawan tidak ditemukan');
            return redirect()->to(base_url("profile/{$ID->id}"));
        }
        
        // Get education data list
        $sql_pend_list = $Pendidikan->asObject()->getPendidikan($id_karyawan);
                                
        $data = [
            'SQLKary'       => $sql_kary,
            'SQLPend'       => null, // Empty for new data entry
            'SQLPendList'   => $sql_pend_list,
            'MenuAktif'     => 'active',
            'MenuOpen'      => 'menu-open',
            'AksesGrup'     => $AksesGrup,
            'Pengguna'      => $ID,
            'PenggunaGrup'  => $IDGrup,
            'Pengaturan'    => $this->Setting,
            'ThemePath'     => $this->ThemePath,
            'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
            'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
            'konten'        => $this->ThemePath.'/user/profile_pend',
        ];
        
        return view($this->ThemePath.'/index', $data); 
    }
    
    /**
     * Edit employee education data
     * 
     * @param int $id Education data ID
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function data_pendidikan_edit($id)
    {
        if (!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('error', 'Sesi berakhir, silahkan login kembali!');
            return redirect()->to(base_url());
        }
        
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();

        $Karyawan   = new \App\Models\mKaryawan();
        $Pendidikan = new \App\Models\mKaryawanPend();
        
        // Get education data by ID
        $sql_pend = $Pendidikan->getPendidikanById($id);
        
        // If education data not found, redirect with error
        if (!$sql_pend) {
            $this->session->setFlashdata('error', 'Data pendidikan tidak ditemukan');
            return redirect()->to(base_url("profile/sdm/data_pendidikan"));
        }
        
        // Get employee data
        $sql_kary = $Karyawan->asObject()->where('id', $sql_pend->id_karyawan)->first();
        
        // If employee not found, redirect with error
        if (!$sql_kary) {
            $this->session->setFlashdata('error', 'Data karyawan tidak ditemukan');
            return redirect()->to(base_url("profile/sdm/data_pendidikan"));
        }
        
        // Get education data list
        $sql_pend_list = $Pendidikan->asObject()->getPendidikan($sql_pend->id_karyawan);
                                
        $data = [
            'SQLKary'       => $sql_kary,
            'SQLPend'       => $sql_pend,
            'SQLPendList'   => $sql_pend_list,
            'MenuAktif'     => 'active',
            'MenuOpen'      => 'menu-open',
            'AksesGrup'     => $AksesGrup,
            'Pengguna'      => $ID,
            'PenggunaGrup'  => $IDGrup,
            'Pengaturan'    => $this->Setting,
            'ThemePath'     => $this->ThemePath,
            'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
            'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
            'konten'        => $this->ThemePath.'/user/profile_pend',
        ];
        
        return view($this->ThemePath.'/index', $data); 
    }
    
    /**
     * Save employee education data
     * 
     * @param int $id_karyawan Employee ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function data_pendidikan_simpan($id = null)
    {
        // Get current user data
        $id             = $this->request->getPost('id');
        $id_kary        = $this->request->getPost('id_karyawan');
        $IDUser         = $this->ionAuth->user()->row()->id;
        $user           = $this->ionAuth->user()->row()->username;
        
        // Get form data
        $pendidikan     = $this->request->getPost('pendidikan');
        $jurusan        = $this->request->getPost('jurusan');
        $instansi       = $this->request->getPost('instansi');
        $keterangan     = $this->request->getPost('keterangan');
        $no_dok         = $this->request->getPost('no_dok');
        $thn_masuk      = $this->request->getPost('thn_masuk');
        $thn_keluar     = $this->request->getPost('thn_keluar');
        $status_lulus   = $this->request->getPost('status_lulus');
        
        // Load models
        $karyawanModel = new \App\Models\mKaryawan();
        $pendidikanModel = new \App\Models\mKaryawanPend();
        
        // Set validation rules
        $validationRules = [
            'pendidikan' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Pendidikan harus diisi',
                    'min_length' => 'Pendidikan minimal 2 karakter',
                    'max_length' => 'Pendidikan maksimal 100 karakter'
                ]
            ],
            'jurusan' => [
                'rules' => 'required|min_length[3]|max_length[160]',
                'errors' => [
                    'required' => 'Jurusan harus diisi',
                    'min_length' => 'Jurusan minimal 3 karakter',
                    'max_length' => 'Jurusan maksimal 160 karakter'
                ]
            ],
            'instansi' => [
                'rules' => 'required|min_length[3]|max_length[160]',
                'errors' => [
                    'required' => 'Instansi harus diisi',
                    'min_length' => 'Instansi minimal 3 karakter',
                    'max_length' => 'Instansi maksimal 160 karakter'
                ]
            ],
            'no_dok' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nomor Dokumen harus diisi',
                    'min_length' => 'Nomor Dokumen minimal 3 karakter',
                    'max_length' => 'Nomor Dokumen maksimal 100 karakter'
                ]
            ],
            'thn_masuk' => [
                'rules' => 'required|numeric|min_length[4]|max_length[4]',
                'errors' => [
                    'required' => 'Tahun Masuk harus diisi',
                    'numeric' => 'Tahun Masuk harus berupa angka',
                    'min_length' => 'Tahun Masuk harus 4 digit',
                    'max_length' => 'Tahun Masuk harus 4 digit'
                ]
            ]
        ];
        
        // Add file validation rule if this is a new record or file is uploaded
        $file = $this->request->getFile('file_berkas');
        if (empty($id) || ($file && $file->getSize() > 0)) {
            $validationRules['file_berkas'] = [
                'rules' => 'uploaded[file_berkas]|max_size[file_berkas,2048]|mime_in[file_berkas,image/jpg,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => 'File berkas harus diunggah',
                    'max_size' => 'Ukuran file maksimal 2MB',
                    'mime_in' => 'Format file harus jpg, jpeg, png, atau pdf'
                ]
            ];
        }
        
        // Run validation
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Prepare data for saving
        $data = [
            'id'           => $id,
            'id_karyawan'  => $id_kary,
            'id_user'      => $IDUser,
            'tgl_simpan'   => date('Y-m-d H:i:s'),
            'pendidikan'   => $pendidikan,
            'jurusan'      => $jurusan,
            'instansi'     => $instansi,
            'keterangan'   => $keterangan,
            'no_dok'       => $no_dok,
            'thn_masuk'    => $thn_masuk,
            'thn_keluar'   => $thn_keluar,
            'status_lulus' => $status_lulus
        ];
        
        // Handle file upload
        if ($file && $file->getSize() > 0) {
            $path = ROOTPATH . 'public/';
            $dir = 'file/profile/userid_'.$IDUser.'/';
            $filename = 'pendidikan_' . date('YmdHis') . '_' . $file->getRandomName();
            
            // Create directory if it doesn't exist
            if (!is_dir($path.$dir)) {
                mkdir($path.$dir, 0777, true);
            }
            
            // Move file to directory
            if ($file->move($path.$dir, $filename)) {
                $data['file_name'] = $filename;
                $data['file_ext'] = $file->getExtension();
                $data['file_type'] = $file->getClientMimeType();
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file');
            }
        }
        
        // Save data
        try {
            $pendidikanModel->save($data);

            if (!empty($id)) {
                // Update existing record
                return redirect()->to(base_url('profile/sdm/data_pendidikan'))->with('success', 'Data pendidikan berhasil diperbarui');
            } else {
                // Insert new record
                return redirect()->to(base_url('profile/sdm/data_pendidikan'))->with('success', 'Data pendidikan berhasil disimpan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Delete employee education data
     * 
     * @param int $id Education data ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function data_pendidikan_hapus($id)
    {        
        // Load model
        $pendidikanModel = new \App\Models\mKaryawanPend();
        
        // Get education data
        $pendidikan = $pendidikanModel->asObject()->find($id);
        
        // If data not found, redirect with error
        if (!$pendidikan) {
            return redirect()->back()->with('error', 'Data pendidikan tidak ditemukan');
        }
        
        // Store employee ID for redirect
        $id_karyawan = $pendidikan->id_karyawan;
        
        try {
            // Delete file if exists
            if (!empty($pendidikan->file_name)) {
                $filePath = FCPATH . $pendidikan->file_name;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            
            // Delete record
            $pendidikanModel->delete($id);
            
            // Set success message and redirect
            return redirect()->back()->with('success', 'Data pendidikan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

    /**
     * Display employee employment data form and list
     * 
     * @param int $id_karyawan Optional employee ID
     * @return \CodeIgniter\HTTP\ResponseInterface
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_pegawai($id_karyawan = null)
    {
        if (!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('error', 'Sesi berakhir, silahkan login kembali!');
            return redirect()->to(base_url());
        }
        
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();

        $Karyawan   = new \App\Models\mKaryawan();
        $KaryawanPeg = new \App\Models\mKaryawanPeg();
        $Departemen = new \App\Models\mDepartemen();
        $Jabatan    = new \App\Models\mJabatan();
        
        // If id_karyawan is not provided, use the current user's ID
        if (empty($id_karyawan)) {
            $id_karyawan = $ID->id;
        }
        
        // Get employee data
        $sql_kary = $Karyawan->asObject()->where('id', $id_karyawan)->first();
        
        // If employee not found, redirect to profile
        if (!$sql_kary) {
            $this->session->setFlashdata('error', 'Data karyawan tidak ditemukan');
            return redirect()->to(base_url("profile/{$ID->id}"));
        }
        
        // Get employee employment data
        $sql_peg = $KaryawanPeg->asObject()->getKaryawanPeg($id_karyawan);
        
        // Get departments and positions for dropdown
        $sql_dept = $Departemen->asObject()->getDepartemen(true);
        $sql_jabatan = $Jabatan->asObject()->getJabatan();
                                
        $data = [
            'SQLKary'       => $sql_kary,
            'SQLPeg'        => $sql_peg,
            'SQLDept'       => $sql_dept,
            'SQLJabatan'    => $sql_jabatan,
            'MenuAktif'     => 'active',
            'MenuOpen'      => 'menu-open',
            'AksesGrup'     => $AksesGrup,
            'Pengguna'      => $ID,
            'PenggunaGrup'  => $IDGrup,
            'Pengaturan'    => $this->Setting,
            'ThemePath'     => $this->ThemePath,
            'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
            'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
            'konten'        => $this->ThemePath.'/user/profile_peg',
        ];
        
        return view($this->ThemePath.'/index', $data); 
    }
    
    /**
     * Save employee employment data
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_pegawai_simpan()
    {        
        // Get current user data
        $id          = $this->request->getPost('id');
        $id_karyawan = $this->request->getPost('id_karyawan');
        $id_dept     = $this->request->getPost('id_dept');
        $id_jabatan  = $this->request->getPost('id_jabatan');
        $tgl_masuk   = $this->request->getPost('tgl_masuk');
        $tgl_keluar  = $this->request->getPost('tgl_keluar');
        $kode        = $this->request->getPost('kode');
        $no_bpjs_tk  = $this->request->getPost('no_bpjs_tk');
        $no_bpjs_ks  = $this->request->getPost('no_bpjs_ks');
        $no_npwp     = $this->request->getPost('no_npwp');
        $no_ptkp     = $this->request->getPost('no_ptkp');
        $no_rek      = $this->request->getPost('no_rek');
        $keterangan  = $this->request->getPost('keterangan');
        $tipe        = $this->request->getPost('tipe');
        $IDUser      = $this->ionAuth->user()->row()->id;
        
        // Load models
        $karyawanModel = new \App\Models\mKaryawan();
        $pegawaiModel = new \App\Models\mKaryawanPeg();
        
        // Set validation rules
        $validationRules = [
            'kode' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Kode Pegawai harus diisi',
                    'max_length' => 'Kode Pegawai maksimal 50 karakter'
                ]
            ],
            'id_dept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Departemen harus dipilih'
                ]
            ],
            'id_jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan harus dipilih'
                ]
            ],
            'tgl_masuk' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tanggal mulai cuti harus diisi',
                    'valid_date' => 'Format tanggal mulai cuti tidak valid'
                ]
            ],
            'tgl_keluar' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tanggal selesai cuti harus diisi',
                    'valid_date' => 'Format tanggal selesai cuti tidak valid'
                ]
            ]
        ];
        
        // Run validation
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Prepare data for saving
        $data = [
            'id'          => $id,
            'id_karyawan' => $id_karyawan,
            'id_user'     => $IDUser,
            'id_dept'     => $id_dept,
            'id_jabatan'  => $id_jabatan,
            'tgl_masuk'   => !empty($tgl_masuk) ? tgl_indo_sys2($tgl_masuk) :   null,
            'tgl_keluar'  => !empty($tgl_keluar) ? tgl_indo_sys2($tgl_keluar) : null,
            'kode'        => $kode,
            'no_bpjs_tk'  => $no_bpjs_tk,
            'no_bpjs_ks'  => $no_bpjs_ks,
            'no_npwp'     => $no_npwp,
            'no_ptkp'     => $no_ptkp,
            'no_rek'      => $no_rek,
            'keterangan'  => $keterangan,
            'tipe'        => $tipe
        ];
        
        // Add timestamps
        if (empty($id)) {
            $data['tgl_simpan'] = date('Y-m-d H:i:s');
        } else {
            $data['tgl_modif'] = date('Y-m-d H:i:s');
            $data['id'] = $id; // Add ID for update
        }
        
        // Save data
        try {
            $pegawaiModel->save($data);
            
            if (empty($id)) {
                return redirect()->back()->with('success', 'Data pegawai berhasil disimpan');
            } else {
                return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pegawai: ' . $e->getMessage());
        }
    }
    
    /**
     * Delete employee employment data
     * 
     * @param int $id Employment data ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_pegawai_hapus($id)
    {        
        // Load model
        $pegawaiModel = new \App\Models\mKaryawanPeg();
        
        // Get employment data
        $pegawai = $pegawaiModel->find($id);
        
        // If data not found, redirect with error
        if (!$pegawai) {
            $this->session->setFlashdata('error', 'Data pegawai tidak ditemukan');
            return redirect()->to(base_url('profile/sdm/data_pegawai'));
        }
        
        // Store employee ID for redirect
        $id_karyawan = $pegawai['id_karyawan'];
        
        // Delete record
        if ($pegawaiModel->delete($id)) {
            $this->session->setFlashdata('pesan', 'Data pegawai berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Gagal menghapus data pegawai');
        }
        
        // Set success message and redirect
        return redirect()->to(base_url("profile/sdm/data_pegawai/{$id_karyawan}"));
    }

    /**
     * Display employee leave/time-off data
     * 
     * @param int $id_karyawan Employee ID
     * @return \CodeIgniter\HTTP\Response View response
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_cuti($id_karyawan = null)
    {             
        // Get user and group information
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();
        
        // Load models
        $Karyawan    = new \App\Models\mKaryawan();
        $KaryawanPeg = new \App\Models\mKaryawanPeg();
        $Departemen  = new \App\Models\mDepartemen();
        $Jabatan     = new \App\Models\mJabatan();
        $CutiModel   = new \App\Models\trSdmCuti();
        
        // If id_karyawan is not provided, use the current user's ID
        if (empty($id_karyawan)) {
            $id_karyawan = $ID->id;
        }
        
        // Get employee data
        $sql_kary = $Karyawan->asObject()->where('id', $id_karyawan)->first();
        
        // If employee not found, redirect to profile
        if (!$sql_kary) {
            $this->session->setFlashdata('error', 'Data karyawan tidak ditemukan');
            return redirect()->to(base_url("profile/{$ID->id}"));
        }
        
        // Get employee employment data
        $sql_peg = $KaryawanPeg->asObject()->getKaryawanPeg($id_karyawan);
        
        // Get departments and positions for dropdown
        $sql_dept = $Departemen->asObject()->getDepartemen(true);
        $sql_jabatan = $Jabatan->asObject()->getJabatan();
        
        // Get employee leave data
        $SQLCuti = $CutiModel->asObject()->getCuti($id_karyawan);
        
        $data = [
            'SQLKary'       => $sql_kary,
            'SQLPeg'        => $sql_peg,
            'SQLDept'       => $sql_dept,
            'SQLJabatan'    => $sql_jabatan,
            'SQLCuti'       => $SQLCuti,
            'MenuAktif'     => 'active',
            'MenuOpen'      => 'menu-open',
            'AksesGrup'     => $AksesGrup,
            'Pengguna'      => $ID,
            'PenggunaGrup'  => $IDGrup,
            'Pengaturan'    => $this->Setting,
            'ThemePath'     => $this->ThemePath,
            'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
            'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
            'konten'        => $this->ThemePath.'/user/profile_cuti',
        ];
        
        return view($this->ThemePath.'/index', $data); 
    }

    /**
     * Save employee leave/time-off data
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_cuti_simpan()
    {        
        // Get current user data
        $id          = $this->request->getPost('id');
        $id_karyawan = $this->request->getPost('id_karyawan');
        $tgl_cuti   = $this->request->getPost('tgl_cuti'); // Get directly from hidden fields
        $keterangan  = $this->request->getPost('keterangan');
        $tipe        = $this->request->getPost('tipe');
        $IDUser      = $this->ionAuth->user()->row()->id;

        $tgl         = explode('-', $tgl_cuti);
        $tgl_masuk   = tgl_indo_sys2($tgl[0]);
        $tgl_keluar  = tgl_indo_sys2($tgl[1]);
        
        // Load models
        $karyawanModel  = new \App\Models\mKaryawan();
        $cutiModel      = new \App\Models\trSdmCuti();
        
        // Set validation rules
        $validationRules = [
            'id_karyawan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'ID Karyawan harus diisi',
                    'numeric' => 'ID Karyawan harus berupa angka'
                ]
            ],
            'tgl_cuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal mulai cuti harus diisi',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Keterangan harus diisi',
                    'min_length' => 'Keterangan minimal 5 karakter'
                ]
            ],
            'tipe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe cuti harus dipilih'
                ]
            ]
        ];
        
        // Add file validation rule if it's a new record or file is uploaded
        $file = $this->request->getFile('file_berkas');
        // if (empty($id) || ($file && $file->getSize() > 0)) {
        //     $validationRules['file_berkas'] = [
        //         'rules' => 'uploaded[file_berkas]|max_size[file_berkas,2048]|mime_in[file_berkas,image/jpg,image/jpeg,image/png,application/pdf]',
        //         'errors' => [
        //             'uploaded' => 'File berkas harus diunggah',
        //             'max_size' => 'Ukuran file maksimal 2MB',
        //             'mime_in' => 'Format file harus jpg, jpeg, png, atau pdf'
        //         ]
        //     ];
        // }
        
        // Run validation
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // // Check for overlapping leave requests
        // if ($cutiModel->hasOverlappingRequests($id_karyawan, $tgl_masuk, $tgl_keluar, $id)) {
        //     return redirect()->back()->withInput()->with('error', 'Terdapat pengajuan cuti lain pada rentang tanggal yang sama');
        // }
        
        // Prepare data for saving
        $data = [
            'id_karyawan' => $id_karyawan,
            'id_user'     => $IDUser,
            'tgl_masuk'   => $tgl_masuk,
            'tgl_keluar'  => $tgl_keluar,
            'keterangan'  => $keterangan,
            'status'      => '0', // Default status is pending
            'tipe'        => $tipe  // Changed from 'kode' to 'tipe' to match database field
        ];
        
        // Handle file upload
        if ($file && $file->getSize() > 0) {
            $path       = ROOTPATH . 'public/';
            $dir        = 'file/profile/userid_' . $IDUser . '/';
            $filename   = 'cuti_' . date('YmdHis') . '_' . $file->getRandomName();
            
            $data['file_ext'] = $file->getExtension();

            
            // Create directory if it doesn't exist
            if (!is_dir($path.$dir)) {
                mkdir($path.$dir, 0777, true);
            }
            
            // Move file to directory
            if ($file->move($path.$dir, $filename)) {
                $data['file_name'] = $dir.$filename;
                $data['file_type'] = $file->getClientMimeType();
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file');
            }
        }
        
        // Add timestamps
        if (empty($id)) {
            $data['tgl_simpan'] = date('Y-m-d H:i:s');
        } else {
            $data['tgl_modif'] = date('Y-m-d H:i:s');
            $data['id'] = $id; // Add ID for update
        }

        // Save data
        try {
            $result = $cutiModel->save($data);
            if (empty($id)) {
                return redirect()->back()->with('success', 'Pengajuan cuti berhasil disimpan');
            } else {
                return redirect()->back()->with('success', 'Pengajuan cuti berhasil diperbarui');
            }
        } catch (\Exception $e) {
            log_message('error', 'CUTI SAVE EXCEPTION: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan pengajuan cuti: ' . $e->getMessage());
        }
    }

    /**
     * Delete employee leave/time-off data
     * 
     * @param int $id Leave/time-off record ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_cuti_hapus($id)
    {
        // Load model
        $CutiModel = new \App\Models\trSdmCuti();
        
        // Get leave data
        $cuti = $CutiModel->asObject()->getCutiById($id);
        
        // If leave data not found, set error message and redirect
        if (!$cuti) {
            $this->session->setFlashdata('error', 'Data cuti tidak ditemukan');
            return redirect()->to(base_url('profile/sdm/data_cuti'));
        }
        
        // Store employee ID for redirection after deletion
        $id_karyawan = $cuti->id_karyawan;
        
        // Check if file exists and delete it
        if (!empty($cuti->file_name)) {
            $path       = FCPATH . '/';
            $filepath   = $path . $cuti->file_name;
            
            if (file_exists($filepath)) {
                unlink($filepath);
            }
        }
        
        // Delete leave record
        if ($CutiModel->delete($id)) {
            $this->session->setFlashdata('success', 'Data cuti berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Data cuti gagal dihapus');
        }
        
        return redirect()->to(base_url("profile/sdm/data_cuti/{$id_karyawan}"));
    }

    /**
     * Edit employee leave/time-off data
     * 
     * @param int $id Leave/time-off record ID
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * 
     * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
     * @date 2025-03-13
     */
    public function data_cuti_edit($id)
    {
        // Get user and group information
        $ID         = $this->ionAuth->user()->row();
        $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
        $AksesGrup  = $this->ionAuth->groups()->result();
        
        // Load models
        $Karyawan    = new \App\Models\mKaryawan();
        $KaryawanPeg = new \App\Models\mKaryawanPeg();
        $Departemen  = new \App\Models\mDepartemen();
        $Jabatan     = new \App\Models\mJabatan();
        $CutiModel   = new \App\Models\trSdmCuti();
        
        // Get leave data by ID
        $sql_cuti = $CutiModel->asObject()->getCutiById($id);
        
        // If leave data not found, set error message and redirect
        if (!$sql_cuti) {
            $this->session->setFlashdata('error', 'Data cuti tidak ditemukan');
            return redirect()->to(base_url('profile/sdm/data_cuti'));
        }
        
        // Get employee ID from leave data
        $id_karyawan = $sql_cuti->id_karyawan;
        
        // Get employee data
        $sql_kary = $Karyawan->asObject()->where('id', $id_karyawan)->first();
        
        // If employee not found, redirect to profile
        if (!$sql_kary) {
            $this->session->setFlashdata('error', 'Data karyawan tidak ditemukan');
            return redirect()->to(base_url("profile/{$ID->id}"));
        }
        
        // Get employee employment data
        $sql_peg = $KaryawanPeg->asObject()->getKaryawanPeg($id_karyawan);
        
        // Get departments and positions for dropdown
        $sql_dept = $Departemen->asObject()->getDepartemen(true);
        $sql_jabatan = $Jabatan->asObject()->getJabatan();
        
        // Get all employee leave data for history
        $SQLCutiList = $CutiModel->asObject()->getCuti($id_karyawan);
        
        $data = [
            'SQLKary'       => $sql_kary,
            'SQLPeg'        => $sql_peg,
            'SQLDept'       => $sql_dept,
            'SQLJabatan'    => $sql_jabatan,
            'SQLCuti'       => $sql_cuti,     // Single leave record for editing
            'SQLCutiList'   => $SQLCutiList,  // All leave records for history table
            'MenuAktif'     => 'active',
            'MenuOpen'      => 'menu-open',
            'AksesGrup'     => $AksesGrup,
            'Pengguna'      => $ID,
            'PenggunaGrup'  => $IDGrup,
            'Pengaturan'    => $this->Setting,
            'ThemePath'     => $this->ThemePath,
            'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
            'menu_kiri'     => $this->ThemePath.'/user/menu_kiri',
            'konten'        => $this->ThemePath.'/user/profile_cuti',
        ];
        
        return view($this->ThemePath.'/index', $data); 
    }
} 