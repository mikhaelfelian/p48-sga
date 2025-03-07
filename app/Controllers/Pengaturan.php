<?php

namespace App\Controllers;

use App\Models\PengaturanProfile;

/**
 * Description of Pengaturan
 *
 * @author mike
 */
class Pengaturan extends BaseController {
    //put your code here
    public function __construct() {
        
    }

    
    public function index(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
                        
            $data  = [
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pengaturan/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/pengaturan/konten',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function pengaturan(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
                        
            $data  = [
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pengaturan/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/pengaturan/pengaturan',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function pengaturan_set_update() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $IDPeng     = $this->input->getVar('id');
            $judul      = $this->input->getVar('judul');
            $judul_app  = $this->input->getVar('judul_app');
            $url_app    = $this->input->getVar('url_app');
            $kota       = $this->input->getVar('kota');
            $alamat     = $this->input->getVar('alamat');
            $kd_kary    = $this->input->getVar('kode_kary');
            $kd_plgn    = $this->input->getVar('kode_plgn');
            $kd_supp    = $this->input->getVar('kode_supp');
            $jml_item   = $this->input->getVar('jml_item');
            $jml_ppn    = $this->input->getVar('jml_ppn');
            $no_tlp     = $this->input->getVar('no_tlp');
            $berkas_logo= $this->request->getFile('fupload_logo');
            $berkas_hdr = $this->request->getFile('fupload_logo_hdr');
            $berkas_fav = $this->request->getFile('fupload_logo_fav');

            $Setting    = new \App\Models\Pengaturan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'fupload_logo' => [
                    'rules'     => 'is_image[fupload_logo]|max_size[fupload_logo,2048]',
                    'errors'    => [
//                        'uploaded' => 'Berkas unggah tidak tersedia',
                        'is_image' => 'Berkas harus berupa gambar',
                        'max_size' => 'Berkas harus berukuran maksimal 2MB',
                    ]
                ],
                'fupload_logo_hdr' => [
                    'rules'     => 'is_image[fupload_logo_hdr]|max_size[fupload_logo_hdr,2048]',
                    'errors'    => [
//                        'uploaded' => 'Berkas unggah tidak tersedia',
                        'is_image' => 'Berkas harus berupa gambar',
                        'max_size' => 'Berkas harus berukuran maksimal 2MB',
                    ]
                ],
                'fupload_logo_fav' => [
                    'rules'     => 'is_image[fupload_logo_fav]|max_size[fupload_logo_fav,2048]',
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
                    'id'                => $validasi->getError('nama'),
                    'fupload_logo'      => $validasi->getError('fupload_logo'),
                    'fupload_logo_hdr'  => $validasi->getError('fupload_logo_hdr'),
                    'fupload_logo_fav'  => $validasi->getError('fupload_logo_fav'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);
                
                if(!empty($validasi->getError('pass2'))){
                    $this->session->setFlashdata('pengaturan_toast', 'toastr.error("'.$validasi->getError('pass2').'");');
                }

                return redirect()->to(base_url('pengaturan/pengaturan.php'));
            }else{
                $sql_cek    = $Setting->asObject()->where('id', $IDPeng)->first();
                
                # Muat library untuk unggah file
                # $path untuk mengatur lokasi unggah file
                $path           = FCPATH.'file/app/';
                $flname_logo    = 'logo_'.strtolower(str_replace(' ', '', $sql_cek->judul)).'.'.$berkas_logo->getClientExtension();
                $flname_hdr     = 'logo_hdr_'.strtolower(str_replace(' ', '', $sql_cek->judul)).'.'.$berkas_hdr->getClientExtension();
                $flname_fav     = 'logo_fav_'.strtolower(str_replace(' ', '', $sql_cek->judul)).'.'.$berkas_fav->getClientExtension();
                
                
                # Jika valid lanjut upload file logo
                if ($berkas_logo->isValid() && !$berkas_logo->hasMoved()) {
                    if(!empty($sql_cek->logo)){
                        unlink($path.$sql_cek->logo);
                    }
                    
                    $berkas_logo->move($path, $flname_logo, true);
                }
                
                # Jika valid lanjut upload file header
                if ($berkas_hdr->isValid() && !$berkas_hdr->hasMoved()) {
                    if(!empty($sql_cek->logo_header)){
                        unlink($path.$sql_cek->logo_header);
                    }
                    
                    $berkas_hdr->move($path, $flname_hdr, true);
                }
                
                # Jika valid lanjut upload file fav
                if ($berkas_fav->isValid() && !$berkas_fav->hasMoved()) {
                    if(!empty($sql_cek->favicon)){
                        unlink($path.$sql_cek->favicon);
                    }
                    
                    $berkas_fav->move($path, $flname_fav, true);
                }
                
                $file_logo  = new \CodeIgniter\Files\File($path.$berkas_logo);
                $file_hdr   = new \CodeIgniter\Files\File($path.$berkas_hdr);
                $file_fav   = new \CodeIgniter\Files\File($path.$berkas_fav);
                
                $data = [
                    'id'            => $IDPeng,
                    'judul'         => $judul,
                    'judul_app'     => $judul_app,
                    'url_app'       => $url_app,
                    'kota'          => $kota,
                    'alamat'        => $alamat,
                    'tlp'           => $no_tlp,
                    'kode_plgn'     => $kd_plgn,
                    'kode_supp'     => $kd_supp,
                    'kode_kary'     => $kd_kary,
                    'jml_item'      => $jml_item,
                    'jml_ppn'       => $jml_ppn,
                    'favicon'       => (!empty($berkas_fav->getClientExtension()) ? $flname_fav : $sql_cek->favicon),
                    'logo'          => (!empty($berkas_logo->getClientExtension()) ? $flname_logo : $sql_cek->logo),
                    'logo_header'   => (!empty($berkas_hdr->getClientExtension()) ? $flname_hdr : $sql_cek->logo_header),
                ];                

                $Setting->save($data);
                $last_id = $IDPeng;

                if($last_id > 0){
                    $this->session->setFlashdata('pengaturan_toast', 'toastr.success("Pengaturan berhasil disimpan !!");');
                }

                return redirect()->to(base_url('pengaturan/pengaturan.php'));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    } 

    public function perusahaan_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $hlmn       = $this->input->getVar('page');

            $Pengaturan = new \App\Models\PengaturanProfile();
            $sql_pers   = $Pengaturan->asObject()->orderBy('id', 'DESC')->where('id_pengaturan', $this->Setting->id)->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLCompany'    => $sql_pers->paginate($jml_limit),
                'Pagination'    => $Pengaturan->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pengaturan/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/pengaturan/perusahaan_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function perusahaan_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            $IDProf     = $this->input->getVar('id');
                            
            if(!empty($IDProf)){
                $Profile    = new \App\Models\PengaturanProfile();
                $sql_prof   = $Profile->asObject()->where('id', $IDProf)->first();
            }else{
                $sql_prof   = '';
            }
            
            $data  = [
                'SQLProfile'    => $sql_prof,
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pengaturan/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/pengaturan/perusahaan_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function perusahaan_set_simpan() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $id         = $this->input->getVar('id');
            $IDPeng     = $this->input->getVar('id_pengaturan');
            $npwp       = $this->input->getVar('npwp');
            $nama       = $this->input->getVar('nama');
            $kota       = $this->input->getVar('kota');
            $alamat     = $this->input->getVar('alamat');
            $no_telp    = $this->input->getVar('no_telp');
            $dirut          = $this->input->getVar('nm_dirut');
            $berkas_logo    = $this->request->getFile('fupload_logo');
            $berkas_logo_wm = $this->request->getFile('fupload_logo_wm');

            $Setting    = new \App\Models\PengaturanProfile();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_pengaturan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'nama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Nama tidak boleh kosong',
                    ]
                ],
                'fupload_logo' => [
                    'rules'     => 'is_image[fupload_logo]|max_size[fupload_logo,2048]',
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
                    'id_pengaturan'     => $validasi->getError('id_pengaturan'),
                    'nama'              => $validasi->getError('nama'),
                    'fupload_logo'      => $validasi->getError('fupload_logo'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('pengaturan/perusahaan_tambah.php?err'));
            }else{
                $sql_cek    = $Setting->asObject()->where('id', $id)->first();
                
                # Muat library untuk unggah file
                # $path untuk mengatur lokasi unggah file
                $path           = FCPATH.'file/app/';
                
                
                # Jika valid lanjut upload file logo
                if ($berkas_logo->isValid() && !$berkas_logo->hasMoved()) {
                    $flname_logo    = 'logo_prof_'.strtolower(alnum($nama)).'.'.$berkas_logo->getClientExtension();
                
                    # Hapus file sebelumnya
                    if(!empty($sql_cek->logo_kop)){
                        unlink($path.$sql_cek->logo_kop);
                    }
                    
                    # Upload file barunya
                    $berkas_logo->move($path, $flname_logo, true);
                }
                
                # Jika valid lanjut upload file logo untuk watermark pdf
                if ($berkas_logo_wm->isValid() && !$berkas_logo_wm->hasMoved()) {
                    $flname_logo_wm = 'logo_prof_'.strtolower(alnum($nama)).'_wm.'.$berkas_logo_wm->getClientExtension();
                    
                    # Hapus file sebelumnya
                    if(!empty($sql_cek->logo_wm)){
                        unlink($path.$sql_cek->logo_wm);
                    }
                    
                    # Upload file barunya
                    $berkas_logo_wm->move($path, $flname_logo_wm, true);
                }
                
                $data = [
                    'id'            => $id,
                    'id_pengaturan' => $IDPeng,
                    'id_user'       => $ID->id,
                    'npwp'          => $npwp,
                    'nama'          => $nama,
                    'kota'          => $kota,
                    'alamat'        => $alamat,
                    'no_telp'       => $no_telp,
                    'direktur'      => ucwords($dirut),
                    'logo_kop'      => (!empty($berkas_logo->getClientExtension()) ? $flname_logo : $sql_cek->logo_kop),
                    'logo_wm'       => (!empty($berkas_logo_wm->getClientExtension()) ? $flname_logo_wm : $sql_cek->logo_wm),
                ];                

                $Setting->save($data);
                $last_id = (!empty($id) ? $id : $Setting->insertID());

                if($last_id > 0){
                    $this->session->setFlashdata('pengaturan_toast', 'toastr.success("Profile perusahaan berhasil disimpan !!");');
                }

                return redirect()->to(base_url('pengaturan/perusahaan_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function perusahaan_set_update() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $IDProf         = $this->input->getVar('id');
            $IDPeng         = $this->input->getVar('id_pengaturan');
            $npwp           = $this->input->getVar('npwp');
            $nama           = $this->input->getVar('nama');
            $kota           = $this->input->getVar('kota');
            $alamat         = $this->input->getVar('alamat');
            $no_telp        = $this->input->getVar('no_telp');
            $berkas_logo    = $this->request->getFile('fupload_logo');
            $berkas_logo_wm = $this->request->getFile('fupload_logo_wm');

            $Setting    = new \App\Models\PengaturanProfile();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_pengaturan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'nama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Nama tidak boleh kosong',
                    ]
                ],
                'fupload_logo' => [
                    'rules'     => 'is_image[fupload_logo]|max_size[fupload_logo,2048]',
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
                    'id_pengaturan'     => $validasi->getError('id_pengaturan'),
                    'nama'              => $validasi->getError('nama'),
                    'fupload_logo'      => $validasi->getError('fupload_logo'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('pengaturan/perusahaan_tambah.php?err'));
            }else{
                $sql_cek    = $Setting->asObject()->where('id', $IDProf)->first();


                
                $file_logo      = new \CodeIgniter\Files\File($path.$berkas_logo);
                $file_logo_wm   = new \CodeIgniter\Files\File($path.$berkas_logo_wm);
                
                $data = [
                    'id'            => $IDProf,
                    'id_pengaturan' => $IDPeng,
                    'id_user'       => $ID->id,
                    'npwp'          => $npwp,
                    'nama'          => $nama,
                    'kota'          => $kota,
                    'alamat'        => $alamat,
                    'no_telp'       => $no_telp,
                ];
                
                # Muat library untuk unggah file
                # $path untuk mengatur lokasi unggah file
                $path           = FCPATH.'file/app/';
                $flname_logo_wm = 'logo_prof_'.strtolower(alnum($nama)).'_wm.'.$berkas_logo_wm->getClientExtension();
                
                
                # Jika valid lanjut upload file logo
                if ($berkas_logo->isValid() && !$berkas_logo->hasMoved()) {
                    # Hapus file sebelumnya
                    if(!empty($sql_cek->logo_kop)){
                        unlink($path.$sql_cek->logo_kop);
                    }
                    
                    # Upload file barunya
                    $berkas_logo->move($path, $flname_logo, true);

                    $data['logo_kop'] = $flname_logo;
                }
                
                # Jika valid lanjut upload file logo untuk watermark pdf
                if ($berkas_logo_wm->isValid() && !$berkas_logo_wm->hasMoved()) {
                    # Hapus file sebelumnya
                    if(!empty($sql_cek->logo_wm)){
                        unlink($path.$sql_cek->logo_wm);
                    }
                    
                    # Upload file barunya
                    $berkas_logo_wm->move($path, $flname_logo_wm, true);

                    $data['logo_wm'] = $flname_logo_wm;
                }
                
                pre($data);

                // $Setting->save($data);
                // $last_id = $IDProf;

                // if($last_id > 0){
                //     $this->session->setFlashdata('pengaturan_toast', 'toastr.success("Profile perusahaan berhasil diubah !!");');
                // }

                // return redirect()->to(base_url('pengaturan/perusahaan_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function perusahaan_set_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDProf     = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Model      = new \App\Models\PengaturanProfile();
                $sql_prof   = $Model->asObject()->where('id', $IDProf)->first();
                echo $path       = FCPATH.'file/app/'.$sql_prof->logo_kop;
                
                # Hapus File nya duluan
                if (!empty($sql_prof->logo_kop)) {
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }

                # Hapus db nya kemudian
                $Model->asObject()->where('id', $IDProf)->delete();//                
                $this->session->setFlashdata('pengaturan_toast', 'toastr.success("Data profile berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('pengaturan/perusahaan_list.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function perusahaan_set_cari() {                
        if ($this->input->is('post') == 1) {
            $nama = $this->input->getVar('nama');
            $kode = $this->input->getVar('kode');
            
            return redirect()->to(base_url('pengaturan/perusahaan_list.php?'.(!empty($nama) ? 'filter_nama='.$nama : '').(!empty($kode) ? '&filter_kode='.$kode : '')));
        }
    }

    public function hapus_img() {
        $type   = $this->request->getVar('type');
        $id     = $this->request->getVar('id');
        
        if (!empty($type)) {
            // Company profile image deletion
            $Pengaturan         = new \App\Models\Pengaturan();
            $Profile            = new \App\Models\PengaturanProfile();
            $current_profile    = $Pengaturan->first();
            $sql_profile        = $Profile->asObject()->where('id', $id)->first();
            
            $file_path  = '';
            $field_name = '';
            $file_name  = '';
            
            switch ($type) {
                case 'logo':
                    $file_name  = $current_profile['logo'];
                    $field_name = 'logo';
                    
                    // Update database to clear the file name
                    $Pengaturan->update('1', [$field_name => '']);

                    $uri = 'pengaturan/pengaturan.php';
                    break;
                    
                case 'logo_header':
                    $file_name  = $current_profile['logo_header']; 
                    $field_name = 'logo_header';
                    
                    // Update database to clear the file name
                    $Pengaturan->update('1', [$field_name => '']);

                    $uri = 'pengaturan/pengaturan.php';
                    break;
                    
                case 'favicon':
                    $file_name  = $current_profile['favicon']; 
                    $field_name = 'favicon';
                    
                    // Update database to clear the file name
                    $Pengaturan->update('1', [$field_name => '']);

                    $uri = 'pengaturan/pengaturan.php';
                    break;
                    
                case 'logo_kop_profile':
                    $file_name  = $sql_profile->logo_kop;
                    $field_name = 'logo_kop';
                    
                    // Update database to clear the file name 
                    $Profile->update($id, [$field_name => '']);

                    $uri = 'pengaturan/perusahaan_tambah.php?id='.$id;
                    break;
                    
                case 'logo_wm_profile':
                    $file_name  = $sql_profile->logo_wm;
                    $field_name = 'logo_wm';
                    
                    // Update database to clear the file name
                    $Profile->update($id, [$field_name => '']);

                    $uri = 'pengaturan/perusahaan_tambah.php?id='.$id;
                    break;
            }
            
            if (!empty($file_name)) {
                $file_path = FCPATH . 'file/app/' . $file_name;
                
                // Delete physical file if exists
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                
                $this->session->setFlashdata('pengaturan_toast', 'toastr.success("Gambar berhasil dihapus!");');
            }
            
            return redirect()->to(base_url($uri));
        }else{
            $this->session->setFlashdata('pengaturan_toast', 'toastr.error("Gambar tidak ditemukan!");');
            return redirect()->back();
        }
    }
}
