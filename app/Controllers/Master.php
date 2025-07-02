<?php
namespace App\Controllers;

use App\Models\mKategori;
use App\Models\mMerk;
use App\Models\mSatuan;
use App\Models\mPelanggan;
use App\Models\mSupplier;
use App\Models\mKaryawan;
use App\Models\mTipeFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\PengaturanProfile;

/**
 * Description of Master
 *
 * @author mike
 */
class Master extends BaseController {
    
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
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/master/konten',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    
    public function data_kategori_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $kode       = $this->input->getVar('filter_kode');
            $kat        = $this->input->getVar('filter_kat');
            $hlmn       = $this->input->getVar('page');

            $Kategori   = new \App\Models\mKategori();
            $sql_kat    = $Kategori->asObject()->orderBy('id', 'DESC')->like('kode', (!empty($kode) ? $kode : ''))->like('kategori', (!empty($kat) ? $kat : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLKategori'   => $sql_kat->paginate($jml_limit),
                'Pagination'    => $Kategori->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_kategori',
                'konten'        => $this->ThemePath.'/manajemen/master/data_kategori_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_kategori_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDKategori = $this->input->getVar('id');
            
            if(!empty($IDKategori)){
                $Kategori   = new \App\Models\mKategori();
                $sql_kat    = $Kategori->asObject()->where('id', $IDKategori)->first();
            }else{
                $sql_kat = '';
            }
                                                
            $data  = [
                'SQLKategori'   => $sql_kat,
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_kategori',
                'konten'        => $this->ThemePath.'/manajemen/master/data_kategori_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_kategori_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDKategori = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Kategori   = new \App\Models\mKategori();
                $Kategori->where('id', $IDKategori)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data kategori berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_kategori.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_kategori_simpan() {
        # Load helper validasi
        $validasi   = \Config\Services::validation();
        
        $id     = $this->input->getVar('id');
        $kode   = $this->input->getVar('kode');
        $kat    = $this->input->getVar('kategori');
        $ket    = $this->input->getVar('keterangan');
        $status = $this->input->getVar('status');
        
        $Kategori   = new \App\Models\mKategori();
        
        # Aturan validasi form tulis disini
        $aturan = [
            'kode'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Kode tidak boleh kosong',
                ]
            ],
            'kategori'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Kategori tidak boleh kosong',
                ]
            ],
//            'keterangan'  => [
//                'rules'     => 'required',
//                'errors'    => [
//                    'required'      => 'Keterangan tidak boleh kosong',
//                ]
//            ]
        ];
        
        # Simpan config validasi
        $validasi->setRules($aturan);
        
        # Jalankan validasi
        if(!$this->validate($aturan)){
            $psn_gagal = [
                'kode'          => $validasi->getError('kode'),
                'kategori'      => $validasi->getError('kategori'),
//                'keterangan'    => $validasi->getError('keterangan'),
            ];
            
            $this->session->setFlashdata('psn_gagal', $psn_gagal);
            
            return redirect()->to(base_url('master/data_kategori_tambah.php'));
        }else{
            $data = [
                'id'            => $id,
                'kode'          => $kode,
                'kategori'      => $kat,
                'keterangan'    => $ket,
                'status'        => $status,
            ];
            
            $Kategori->save($data);
            $last_id = (!empty($id) ? $id : $Kategori->insertID());
            
            if($last_id > 0){
                $this->session->setFlashdata('master_toast', 'toastr.success("Data kategori berhasil disimpan !!");');
            }
            
            return redirect()->to(base_url('master/data_kategori_tambah.php?id='.$last_id));
        }
    }
    
    public function set_kategori_cari() {        
        $IDKat = $this->input->getVar('id');
        $kat   = $this->input->getVar('kategori');
        $ket   = $this->input->getVar('keterangan');
        
        if ($this->input->is('post') == 1) {
            $kat = $this->input->getVar('kategori');
            $kde = $this->input->getVar('kode');
            
            return redirect()->to(base_url('master/data_kategori.php?'.(!empty($kat) ? 'filter_kat='.$kat : '').(!empty($kde) ? '&filter_kode='.$kde : '')));
        }
    }
    
    
    public function data_merk_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $kode       = $this->input->getVar('filter_kode');
            $mrk        = $this->input->getVar('filter_merk');
            $hlmn       = $this->input->getVar('page');
            
            $Merk       = new \App\Models\mMerk();
            $sql_merk   = $Merk->asObject()->orderBy('id', 'DESC')->like('kode', (!empty($kode) ? $kode : ''))->like('merk', (!empty($mrk) ? $mrk : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLMerk'       => $sql_merk->paginate($jml_limit),
                'Pagination'    => $sql_merk->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_merk',
                'konten'        => $this->ThemePath.'/manajemen/master/data_merk_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_merk_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMerk     = $this->input->getVar('id');
            
            if(!empty($IDMerk)){
                $Merk       = new \App\Models\mMerk();
                $sql_merk   = $Merk->asObject()->where('id', $IDMerk)->first();
            }else{
                $sql_merk   = '';
            }
                                                
            $data  = [
                'SQLMerk'       => $sql_merk,
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_merk',
                'konten'        => $this->ThemePath.'/manajemen/master/data_merk_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_merk_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMerk = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Merk   = new \App\Models\mMerk();
                $Merk->where('id', $IDMerk)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data merk berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_merk.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_merk_simpan() {
        # Load helper validasi
        $validasi   = \Config\Services::validation();
        
        $id     = $this->input->getVar('id');
        $kode   = $this->input->getVar('kode');
        $merk   = $this->input->getVar('merk');
        $ket    = $this->input->getVar('keterangan');
        $status = $this->input->getVar('status');
        
        $Merk   = new \App\Models\mMerk();
        
        # Aturan validasi form tulis disini
        $aturan = [
            'kode'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Kode tidak boleh kosong',
                ]
            ],
            'merk'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Merk tidak boleh kosong',
                ]
            ]
        ];
        
        # Simpan config validasi
        $validasi->setRules($aturan);
        
        # Jalankan validasi
        if(!$this->validate($aturan)){
            $psn_gagal = [
                'kode'      => $validasi->getError('kode'),
                'merk'      => $validasi->getError('merk'),
            ];
            
            $this->session->setFlashdata('psn_gagal', $psn_gagal);
            
            return redirect()->to(base_url('master/data_merk_tambah.php'.(!empty($id) ? '?id='.$id : '')));
        }else{
            $data = [
                'id'            => $id,
                'kode'          => strtoupper($kode),
                'merk'          => strtoupper($merk),
                'keterangan'    => $ket,
                'status'        => $status,
            ];
            
            $Merk->save($data);
            $last_id = (!empty($id) ? $id : $Merk->insertID());
            
            if($last_id > 0){
                $this->session->setFlashdata('master_toast', 'toastr.success("Data merk berhasil disimpan !!");');
            }
            
            return redirect()->to(base_url('master/data_merk_tambah.php?id='.$last_id));
        }
    }
    
    public function set_item_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDItem     = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Model      = new \App\Models\mItem();
                $Model->asObject()->where('id', $IDItem)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data item berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_item.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_merk_cari() {                
        if ($this->input->is('post') == 1) {
            $merk = $this->input->getVar('merk');
            $kode = $this->input->getVar('kode');
            
            return redirect()->to(base_url('master/data_merk.php?'.(!empty($merk) ? 'filter_merk='.$merk : '').(!empty($kode) ? '&filter_kode='.$kode : '')));
        }
    }
    
    
    public function data_satuan_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $sat        = $this->input->getVar('filter_sat');
            $satb       = $this->input->getVar('filter_satb');
            $hlmn       = $this->input->getVar('page');
            
            $Model      = new \App\Models\mSatuan();
            $sql_satuan = $Model->asObject()->like('satuanTerkecil', (!empty($sat) ? $sat : ''))->like('satuanBesar', (!empty($satb) ? $satb : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLSatuan'     => $sql_satuan->paginate($jml_limit),
                'Pagination'    => $Model->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_satuan',
                'konten'        => $this->ThemePath.'/manajemen/master/data_satuan_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_satuan_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDSatuan   = $this->input->getVar('id');
            
            if(!empty($IDSatuan)){
                $Model      = new \App\Models\mSatuan();
                $sql_satuan = $Model->asObject()->where('id', $IDSatuan)->first();
            }else{
                $sql_satuan   = '';
            }
                                                
            $data  = [
                'SQLSatuan'     => $sql_satuan,
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_satuan',
                'konten'        => $this->ThemePath.'/manajemen/master/data_satuan_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_satuan_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDSatuan = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Model      = new \App\Models\mSatuan();
                $Model->asObject()->where('id', $IDSatuan)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data satuan berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_satuan.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_satuan_simpan() {
        # Load helper validasi
        $validasi   = \Config\Services::validation();
        
        $sat        = $this->input->getVar('satuan');
        $satB       = $this->input->getVar('satuanBesar');
        $jml        = $this->input->getVar('jml');
        $status     = $this->input->getVar('status');
        
        $Model      = new \App\Models\mSatuan();
        
        # Aturan validasi form tulis disini
        $aturan = [
            'satuan'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Satuan tidak boleh kosong',
                ]
            ],
            'satuanBesar'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Keterangan tidak boleh kosong',
                ]
            ]
        ];
        
        # Simpan config validasi
        $validasi->setRules($aturan);
        
        # Jalankan validasi
        if(!$this->validate($aturan)){
            $psn_gagal = [
                'satuan'      => $validasi->getError('satuan'),
                'satuanBesar' => $validasi->getError('satuanBesar'),
            ];
            
            $this->session->setFlashdata('psn_gagal', $psn_gagal);
            
            return redirect()->to(base_url('master/data_satuan_tambah.php'));
        }else{
            $data = [
                'satuanTerkecil'    => $sat,
                'satuanBesar'       => $satB,
                'jml'               => $jml,
                'status'            => $status,
            ];
            
            $Model->save($data);
            $last_id = $Model->insertID();
            
            if($last_id > 0){
                $this->session->setFlashdata('master_toast', 'toastr.success("Data satuan berhasil disimpan !!");');
            }
            
            return redirect()->to(base_url('master/data_satuan_tambah.php?id='.$last_id));
            
        }
    }
    
    public function set_satuan_update() {
        # Load helper validasi
        $validasi   = \Config\Services::validation();
        
        $IDSat      = $this->input->getVar('id');
        $sat        = $this->input->getVar('satuan');
        $satB       = $this->input->getVar('satuanBesar');
        $jml        = $this->input->getVar('jml');
        $status     = $this->input->getVar('status');
        
        $Model      = new \App\Models\mSatuan();
        
        # Aturan validasi form tulis disini
        $aturan = [
            'satuan'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Satuan tidak boleh kosong',
                ]
            ],
            'satuanBesar'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Keterangan tidak boleh kosong',
                ]
            ]
        ];
        
        # Simpan config validasi
        $validasi->setRules($aturan);
        
        # Jalankan validasi
        if(!$this->validate($aturan)){
            $psn_gagal = [
                'satuan'      => $validasi->getError('satuan'),
                'satuanBesar' => $validasi->getError('satuanBesar'),
            ];
            
            $this->session->setFlashdata('psn_gagal', $psn_gagal);
            
            return redirect()->to(base_url('master/data_satuan_tambah.php'));
        }else{
            $data = [
                'id'                => $IDSat,
                'satuanTerkecil'    => $sat,
                'satuanBesar'       => $satB,
                'jml'               => $jml,
                'status'            => $status,
            ];
            
            $Model->save($data);
            
            $this->session->setFlashdata('master_toast', 'toastr.success("Data satuan berhasil diubah !!");');
            return redirect()->to(base_url('master/data_satuan_tambah.php?id='.$IDSat));
        }
    }
    
    public function set_satuan_cari() {
        if ($this->ionAuth->loggedIn()) {
            if ($this->input->is('post') == 1) {
                $sat    = $this->input->getVar('satuan');
                $satB   = $this->input->getVar('satuanBesar');

                return redirect()->to(base_url('master/data_satuan.php?'.(!empty($sat) ? 'filter_sat='.$sat : '').(!empty($satB) ? '&filter_satb='.$satB : '')));
            } 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    
    public function data_item_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $item       = $this->input->getVar('filter_item');
            $satb       = $this->input->getVar('filter_satb');
            $hlmn       = $this->input->getVar('page');
            
            $Model      = new \App\Models\vItem();
            $sql_item   = $Model->asObject()->like('item2', (!empty($item) ? $item : ''))->orLike('kode', (!empty($item) ? $item : ''));
//            $sql_item   = $Model->ItemList($this->Setting->jml_item)['dftItem'];
//            $jml_baris  = $Model->ItemList($this->Setting->jml_item)['jmlBaris'];
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLItem'       => $sql_item->paginate($jml_limit),
                'Pagination'    => $Model->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_item',
                'konten'        => $this->ThemePath.'/manajemen/master/data_item_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_item_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDItem     = $this->input->getVar('id');
            
            $Kategori   = new \App\Models\mKategori();
            $Merk       = new \App\Models\mMerk();
            $Satuan     = new \App\Models\mSatuan();
            $sql_kat    = $Kategori->asObject()->where('status', '1')->get();
            $sql_merk   = $Merk->asObject()->where('status', '1')->get();
            $sql_satuan = $Satuan->asObject()->where('status', '1')->get();
            
            if(!empty($IDItem)){
                $Item       = new \App\Models\mItem();
                $sql_item   = $Item->asObject()->where('id', $IDItem)->first();
            }else{
                $sql_item = '';
            }
                                    
            $data  = [
                'SQLItem'       => $sql_item,
                'SQLKategori'   => $sql_kat->getResult(),
                'SQLMerk'       => $sql_merk->getResult(),
                'SQLSatuan'     => $sql_satuan->getResult(),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_item',
                'konten'        => $this->ThemePath.'/manajemen/master/data_item_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_item_import(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDItem     = $this->input->getVar('id');
            
            $Kategori   = new \App\Models\mKategori();
            $Merk       = new \App\Models\mMerk();
            $Satuan     = new \App\Models\mSatuan();
            $sql_kat    = $Kategori->asObject()->where('status', '1')->get();
            $sql_merk   = $Merk->asObject()->where('status', '1')->get();
            $sql_satuan = $Satuan->asObject()->where('status', '1')->get();
            
            if(!empty($IDItem)){
                $Item       = new \App\Models\mItem();
                $sql_item   = $Item->asObject()->where('id', $IDItem)->first();
            }else{
                $sql_item = '';
            }
                                    
            $data  = [
                'SQLItem'       => $sql_item,
                'SQLKategori'   => $sql_kat->getResult(),
                'SQLMerk'       => $sql_merk->getResult(),
                'SQLSatuan'     => $sql_satuan->getResult(),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_item',
                'konten'        => $this->ThemePath.'/manajemen/master/data_item_import',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function xls_item(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $item       = $this->input->getVar('filter_item');
            $satb       = $this->input->getVar('filter_satb');
            $tmpl       = $this->input->getVar('status_temp');
            $hlmn       = $this->input->getVar('page');
            
            $Model      = new \App\Models\vItem();
            $sql_item   = $Model->asObject()->like('item2', (!empty($item) ? $item : ''))->find();
            
            $objPHPExcel = new Spreadsheet();
            
            # Header Excel
            $objPHPExcel->getActiveSheet()->getStyle('A1:L4')->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle('A1:L4')->getAlignment()->setVertical('center');
            $objPHPExcel->getActiveSheet()->getStyle('A1:L4')->getFont()->setBold(TRUE);
            
            # Judul header
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'DATA ITEM')->mergeCells('A1:F1');
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', $this->Setting->judul_app)->mergeCells('A2:F2');
            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'Kategori')
                    ->setCellValue('C4', 'Merk')
                    ->setCellValue('D4', 'SKU')
                    ->setCellValue('E4', 'Item')
                    ->setCellValue('F4', 'HPP');
            
            $objPHPExcel->getActiveSheet()->freezePane("A5");
            $objPHPExcel->getActiveSheet()->setAutoFilter('A4:F4');
            
            # Pengaturan panjang sel
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(65);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

            if(empty($tmpl)){
                $no     = 1;
                $cell   = 5;
                foreach ($sql_item as $data) {
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$cell)->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle('B'.$cell.':E'.$cell)->getAlignment()->setHorizontal('left');
//                    $objPHPExcel->getActiveSheet()->getStyle('D'.$cell)->getAlignment()->setHorizontal('center');
//                    $objPHPExcel->getActiveSheet()->getStyle('E'.$cell)->getAlignment()->setHorizontal('left');
                    $objPHPExcel->getActiveSheet()->getStyle('F'.$cell)->getAlignment()->setHorizontal('right');
                    $objPHPExcel->getActiveSheet()->getStyle('F'.$cell)->getNumberFormat()->setFormatCode("_(\"\"* #,##0_);_(\"\"* \(#,##0\);_(\"\"* \"-\"??_);_(@_)");

                    $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A' . $cell, $no)
                                ->setCellValue('B' . $cell, strtoupper($data->kategori))
                                ->setCellValue('C' . $cell, strtoupper($data->merk))
                                ->setCellValue('D' . $cell, $data->kode)
                                ->setCellValue('E' . $cell, $data->item)
                                ->setCellValue('F' . $cell, $data->harga_beli);

                    $no++;
                    $cell++;
                }
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Item');

            $writer     = new Xlsx($objPHPExcel);
            $fileName   = 'data_item_'.(!empty($tmpl) ? 'template' : date('YmdH'));

            // Redirect hasil generate xlsx ke web client
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_item_simpan() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $idp    = $this->input->getVar('id');
            $idi    = $this->input->getVar('id_item');
            $sti    = $this->input->getVar('status_item');
            $kat    = $this->input->getVar('kategori');
            $mrk    = $this->input->getVar('merk');
            $kode   = $this->input->getVar('kode');
            $item   = $this->input->getVar('item');
            $satuan = $this->input->getVar('satuan');
            $hrg_bl = $this->input->getVar('harga_beli');
            $hrg_jl = $this->input->getVar('harga_jual');
            $ket    = $this->input->getVar('keterangan');
            $rute   = $this->input->getVar('route');
            $status = $this->input->getVar('status');

            $Satuan     = new \App\Models\mSatuan();
            $Item       = new \App\Models\mItem();
            $ItemStok   = new \App\Models\mItemStok();
            $Gudang     = new \App\Models\mGudang();

            # Aturan validasi form tulis disini
            $aturan = [
                'kategori'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Kategori tidak boleh kosong',
                    ]
                ],
                'merk'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Merk tidak boleh kosong',
                    ]
                ],
//                'kode'  => [
//                    'rules'     => 'required',
//                    'errors'    => [
//                        'required'      => 'SKU tidak boleh kosong',
//                    ]
//                ],
                'item'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Item tidak boleh kosong',
                    ]
                ],
                'satuan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Satuan tidak boleh kosong',
                    ]
                ],
                'harga_beli'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Harga Jual tidak boleh kosong',
                    ]
                ],
                'harga_jual'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Harga Jual tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'kategori'  => $validasi->getError('kategori'),
                    'merk'      => $validasi->getError('merk'),
//                    'kode'      => $validasi->getError('kode'),
                    'item'      => $validasi->getError('item'),
                    'satuan'    => $validasi->getError('satuan'),
                    'harga_beli'=> $validasi->getError('harga_beli'),
                    'harga_jual'=> $validasi->getError('harga_jual'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_item_tambah.php'));
            }else{
                $sql_sat = $Satuan->asObject()->where('id', $satuan)->first();
                $sql_cek = $Item->asObject();
                $nomor   = $Item->asObject()->countAll() + 1;
                
                $id_mrk  = sprintf('%02d', $mrk);
                $id_kat  = sprintf('%02d', $kat);
                $id_usr  = sprintf('%02d', $ID->id);
                $no_urut = sprintf('%04d', $nomor);
                $sku     = $id_mrk.$no_urut.$id_kat;
                
                $data = [
                    'id'            => $idp,
                    'id_satuan'     => $satuan,
                    'id_kategori'   => $kat,
                    'id_merk'       => $mrk,
                    'id_user'       => $ID->id,
                    'kode'          => (!empty($kode) ? $kode : $sku),
                    'item'          => $item,
                    'harga_beli'    => format_angka_db($hrg_bl),
                    'harga_jual'    => format_angka_db($hrg_jl),
                    'keterangan'    => $ket,
                    'status'        => $status,
                    'status_stok'   => '1',
                ];

                $Item->save($data);
                $last_id = (!empty($idp) ? $idp : $Item->insertID());
                                
                $sql_gdg    = $Gudang->asObject()->find();
                $sql_stok   = $ItemStok->asObject()->where('id_item', $last_id);
                
                if($sql_stok->countAllResults() == 0){
                    foreach ($sql_gdg as $gdg){
                        $data_gdg = [
                            'id_item'       => $last_id,
                            'id_satuan'     => $satuan,
                            'id_gudang'     => $gdg->id,
                            'jml'           => 0,
                            'jml_satuan'    => 1,
                            'satuan'        => $sql_sat->satuanBesar,
                            'status'        => $gdg->status,
                        ];
                        
                        $ItemStok->save($data_gdg);
                    }
                }

                if(!empty($rute)){
                    if($last_id > 0){
                        $this->session->setFlashdata('transaksi_toast', 'toastr.success("Data item berhasil disimpan !!");');
                    }
                    return redirect()->to(base_url($rute.'?id='.$idi.'&status='.$sti.(!empty($last_id) ? '&id_item='.$last_id : '')));
                }else{
                    if($last_id > 0){
                        $this->session->setFlashdata('master_toast', 'toastr.success("Data item berhasil disimpan !!");');
                    }
                    return redirect()->to(base_url('master/data_item_tambah.php?id='.$last_id));
                }
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_item_upload() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $fupl   = $this->request->getFile('fupload');

            $Item       = new \App\Models\mItem();
            $ItemStok   = new \App\Models\mItemStok();
            $Gudang     = new \App\Models\mGudang();
            $Kat        = new \App\Models\mKategori();
            $Merk       = new \App\Models\mMerk();

            # Aturan validasi form tulis disini
            $aturan = [
                'fupload' => [
                    'rules'     => 'mime_in[fupload,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/excel]',
                    'errors'    => [
//                        'uploaded' => 'Berkas unggah tidak tersedia',
                        'mime_in' => 'Berkas harus berupa excel file',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'fupload'   => $validasi->getError('fupload'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_item_import.php'));
            }else{
                # Muat library untuk unggah file
                # $path untuk mengatur lokasi unggah file
                $ext    = $fupl->getClientExtension();
                $file   = $fupl->getClientName();
                
                if($ext == 'xlsx'){
                    $objPHPExcel    = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $objPHPOffice   = $objPHPExcel->load($fupl);
                }elseif($ext == 'xls'){
                    $objPHPExcel  = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    $objPHPOffice = $objPHPExcel->load($fupl); 
                }elseif($ext == 'csv'){
                    $objPHPExcel  = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    $objPHPOffice = $objPHPExcel->load($fupl);
                }else{
                    $this->session->setFlashdata('master_toast', 'toastr.error("Unggah excel error !!");');
                    return redirect()->to(base_url('master/data_item_import.php'));
                }
                
                $data = $objPHPOffice->getWorksheetIterator();
                
                $cell = 5;
                foreach($data as $x => $ws) {
                    # Ambil nilai tertinggi dari kolom dan baris
                    $brsmax = $ws->getHighestRow();
                    $klmmax = $ws->getHighestColumn();
                    
                    for($brs=5; $brs <= $brsmax; $brs++){ 
                        $kat        = $ws->getCellByColumnAndRow(2, $brs)->getValue();                      
                        $merk       = $ws->getCellByColumnAndRow(3, $brs)->getValue();
                        $kode       = $ws->getCellByColumnAndRow(4, $brs)->getValue();
                        $item       = $ws->getCellByColumnAndRow(5, $brs)->getValue();
                        $hpp        = $ws->getCellByColumnAndRow(6, $brs)->getValue();
                        
                        $sql_kat    = $Kat->asObject()->where('kategori', $kat);
                        $sql_merk   = $Merk->asObject()->where('merk', $merk);
                        
                        # Cek jika kategori belum ada
                        if($sql_kat->countAllResults() == 0){                            
                            $data_kat = [
                                'kode'      => strtoupper(substr(str_replace('-', '', $kat), 0, 2)),
                                'kategori'  => $kat,
                                'status'    => '1'
                            ];
                            
                            $Kat->save($data_kat);
                            $id_kategori = $Kat->insertID();
                        }else{
                            $id_kategori = $sql_kat->first()->id;
                        }
                        
                        # Cek jika merk belum ada
                        if($sql_merk->countAllResults() == 0){                            
                            $data_merk = [
                                'kode'      => strtoupper(substr(str_replace('-', '', $merk), 0, 2)),
                                'merk'      => $merk,
                                'status'    => '1'
                            ];
                            
                            $Merk->save($data_merk);
                            $id_merk = $Merk->insertID();
                        }else{
                            $id_merk = $sql_merk->first()->id;
                        }
                        
                        $data = [
                            'id_satuan'     => 1,
                            'id_kategori'   => $id_kategori,
                            'id_merk'       => $id_merk,
                            'id_user'       => $ID->id,
                            'kode'          => $kode,
                            'item'          => $item,
                            'harga_beli'    => format_angka_db($hpp),
                            'status'        => '1',
                            'status_stok'   => '1',
                        ];
                        
                        $Item->save($data);
                        $last_id = $Item->insertID();
                        
                        $sql_gdg    = $Gudang->asObject()->find();
                        $sql_stok   = $ItemStok->asObject()->where('id_item', $last_id);

                        if($sql_stok->countAllResults() > 0){
                            foreach ($sql_gdg as $gdg){
                                $data_gdg = [
                                    'id_item'       => $last_id,
                                    'id_satuan'     => 1,
                                    'id_gudang'     => $gdg->id,
                                    'jml'           => 0,
                                    'jml_satuan'    => 1,
                                    'status'        => $gdg->status,
                                ];

                                $ItemStok->save($data_gdg);
                            }
                        }
                        $this->session->setFlashdata('master_toast', 'toastr.success("Data item berhasil diunggah !!");');
                    }
                }
                
                return redirect()->to(base_url('master/data_item_import.php'));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_item_cari() {
        if ($this->ionAuth->loggedIn()) {
            if ($this->input->is('post') == 1) {
                $item   = $this->input->getVar('item');
                $satB   = $this->input->getVar('satuanBesar');

                return redirect()->to(base_url('master/data_item.php?'.(!empty($kode) ? 'filter_kode='.$kode : '').(!empty($item) ? '&filter_item='.$item : '')));
            } 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    
    public function data_berkas(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $hlmn       = $this->input->getVar('page');

            $TipeFile   = new \App\Models\mTipeFile;
            $sql_tipe   = $TipeFile->asObject()->orderBy('id', 'DESC');
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLTipeFile'   => $sql_tipe->paginate($jml_limit),
                'Pagination'    => $TipeFile->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_berkas',
                'konten'        => $this->ThemePath.'/manajemen/master/data_berkas',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_berkas_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDKategori = $this->input->getVar('id');
            
            if(!empty($IDKategori)){
                $Kategori   = new \App\Models\mKategori();
                $sql_kat    = $Kategori->asObject()->where('id', $IDKategori)->first();
            }else{
                $sql_kat = '';
            }
                                                
            $data  = [
                'SQLKategori'   => $sql_kat,
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_berkas',
                'konten'        => $this->ThemePath.'/manajemen/master/data_berkas_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_berkas_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDTipe     = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $TipeFile   = new \App\Models\mTipeFile();
                $TipeFile->where('id', $IDTipe)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data tipe dokumen berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_berkas.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_berkas_simpan() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $tipe   = $this->input->getVar('tipe');
            $status = $this->input->getVar('status');

            $TipeFile   = new \App\Models\mTipeFile();

            # Aturan validasi form tulis disini
            $aturan = [
                'tipe'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Kategori tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'tipe' => $validasi->getError('tipe'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_berkas_tambah.php'));
            }else{
                $data = [
                    'id_user'   => $ID->id,
                    'tipe'      => $tipe,
                    'status'    => $status,
                ];

                $TipeFile->save($data);
                $last_id = $TipeFile->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data tipe dokumen berhasil disimpan !!");');
                }

                return redirect()->to(base_url('master/data_berkas.php'));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    
    public function data_pelanggan_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $nama       = $this->input->getVar('filter_nama');
            $ket        = $this->input->getVar('filter_ket');
            $hlmn       = $this->input->getVar('page');
            
            $Plgn       = new \App\Models\mPelanggan();
            $sql_plgn   = $Plgn->asObject()->orderBy('id', 'DESC')->asObject()->orderBy('id', 'DESC')->like('kode', (!empty($kode) ? $kode : ''))->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLPelanggan'  => $sql_plgn->paginate($jml_limit),
                'Pagination'    => $sql_plgn->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_pelanggan',
                'konten'        => $this->ThemePath.'/manajemen/master/data_pelanggan_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_pelanggan_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPlgn     = $this->input->getVar('id');
            
            if(!empty($IDPlgn)){
                $Plgn           = new \App\Models\mPelanggan();
                $PlgnDet        = new \App\Models\mPelangganCp();
                $sql_plgn       = $Plgn->asObject()->where('id', $IDPlgn)->first();
                $sql_plgn_det   = $PlgnDet->asObject()->where('id_pelanggan', $IDPlgn)->find();
            }else{
                $sql_plgn       = '';
                $sql_plgn_det   = '';
            }
                                                
            $data  = [
                'SQLPelanggan'      => $sql_plgn,
                'SQLPelangganDet'   => $sql_plgn_det,
                'MenuAktif'         => 'active',
                'MenuOpen'          => 'menu-open',
                'AksesGrup'         => $AksesGrup,
                'Pengguna'          => $ID,
                'PenggunaGrup'      => $IDGrup,
                'Pengaturan'        => $this->Setting,
                'ThemePath'         => $this->ThemePath,
                'menu_atas'         => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'         => $this->ThemePath.'/manajemen/master/menu_kiri_pelanggan',
                'konten'            => $this->ThemePath.'/manajemen/master/data_pelanggan_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pelanggan_simpan() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $nama   = $this->input->getVar('nama');
            $tlp    = $this->input->getVar('no_telp');
            $npwp    = $this->input->getVar('npwp');
            $almt   = $this->input->getVar('alamat');
            $kota   = $this->input->getVar('kota');
            $prov   = $this->input->getVar('provinsi');
            $tipe   = $this->input->getVar('tipe');
            $status = $this->input->getVar('status');

            $Plgn   = new \App\Models\mPelanggan();

            # Aturan validasi form tulis disini
            $aturan = [
                'nama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Nama tidak boleh kosong',
                    ]
                ],
                'alamat'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Alamat pelanggan tidak boleh kosong',
                    ]
                ],
                'kota'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Kota pelanggan tidak boleh kosong',
                    ]
                ],
                'provinsi'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Provinsi tidak boleh kosong',
                    ]
                ],
                'tipe'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Tipe pelanggan tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'nama'      => $validasi->getError('nama'),
                    'alamat'    => $validasi->getError('alamat'),
                    'kota'      => $validasi->getError('kota'),
                    'provinsi'  => $validasi->getError('provinsi'),
                    'tipe'      => $validasi->getError('tipe')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_pelanggan_tambah.php'));
            }else{
                $sql_cek    = $Plgn->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $kode       = (!empty($this->Setting->kode_plgn) ? $this->Setting->kode_plgn : 'C').'-'.sprintf('%05d', $no_urut);

                $data = [
                    'id_user'   => $ID->id,
                    'kode'      => $kode,
                    'nama'      => $nama,
                    'no_telp'   => $tlp,
                    'npwp'      => $npwp,
                    'alamat'    => $almt,
                    'provinsi'  => strtoupper($prov),
                    'kota'      => strtoupper($kota),
                    'tipe'      => $tipe,
                    'status'    => $status,
                ];

                $Plgn->save($data);
                $last_id = $Plgn->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data pelanggan berhasil disimpan !!");');
                }

                return redirect()->to(base_url('master/data_pelanggan_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pelanggan_simpan_cp() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $idp    = $this->input->getVar('id_pelanggan');
            $nama   = $this->input->getVar('nama');
            $tlp    = $this->input->getVar('no_hp');
            $jbtn   = $this->input->getVar('jabatan');
            $status = $this->input->getVar('status');

            $Plgn   = new \App\Models\mPelangganCp();

            # Aturan validasi form tulis disini
            $aturan = [
                'nama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Nama tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'nama'      => $validasi->getError('nama'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_pelanggan_tambah.php?id='.$idp));
            }else{
                $data = [
                    'id_user'       => $ID->id,
                    'id_pelanggan'  => $idp,
                    'nama'          => $nama,
                    'no_hp'         => $tlp,
                    'jabatan'       => $jbtn,
                    'status'        => '1',
                ];
                
                $Plgn->save($data);
                $last_id = $Plgn->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data kontak pelanggan berhasil disimpan !!");');
                }

                return redirect()->to(base_url('master/data_pelanggan_tambah.php?id='.$idp));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pelanggan_update() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $IDPlgn = $this->input->getVar('id');
            $nama   = $this->input->getVar('nama');
            $tlp    = $this->input->getVar('no_telp');
            $npwp    = $this->input->getVar('npwp');
            $almt   = $this->input->getVar('alamat');
            $kota   = $this->input->getVar('kota');
            $prov   = $this->input->getVar('provinsi');
            $tipe   = $this->input->getVar('tipe');
            $status = $this->input->getVar('status');

            $Plgn   = new \App\Models\mPelanggan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
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
                'alamat'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Alamat pelanggan tidak boleh kosong',
                    ]
                ],
                'kota'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Kota pelanggan tidak boleh kosong',
                    ]
                ],
                'provinsi'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Provinsi tidak boleh kosong',
                    ]
                ],
                'tipe'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Tipe pelanggan tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'nama'      => $validasi->getError('nama'),
                    'alamat'    => $validasi->getError('alamat'),
                    'kota'      => $validasi->getError('kota'),
                    'provinsi'  => $validasi->getError('provinsi'),
                    'tipe'      => $validasi->getError('tipe')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_pelanggan_tambah.php'));
            }else{
                $sql_cek    = $Plgn->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $kode       = (!empty($this->Setting->kode_plgn) ? $this->Setting->kode_plgn : 'P').'-'.sprintf('%05d', $no_urut);

                $data = [
                    'id'        => $IDPlgn,
                    'nama'      => $nama,
                    'no_telp'   => $tlp,
                    'npwp'      => $npwp,
                    'alamat'    => $almt,
                    'provinsi'  => $prov,
                    'kota'      => $kota,
                    'tipe'      => $tipe,
                    'status'    => $status,
                ];

                $Plgn->save($data);
                $last_id = $IDPlgn;

                if($last_id > 0){
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data pelanggan berhasil diubah !!");');
                }

                return redirect()->to(base_url('master/data_pelanggan_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pelanggan_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPlgn     = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Plgn   = new \App\Models\mPelanggan();
                $Plgn->where('id', $IDPlgn)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data pelanggan berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_pelanggan.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pelanggan_hapus_cp(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $id         = $this->input->getVar('id');
            $id_plgn    = $this->input->getVar('id_plgn');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Plgn   = new \App\Models\mPelangganCp();
                $Plgn->where('id', $id)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data CP berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_pelanggan_tambah.php?id='.$id.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pelanggan_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('kode');
            $nama   = $this->input->getVar('nama');
            
            return redirect()->to(base_url('master/data_pelanggan.php?'.(!empty($kode) ? 'filter_kode='.$kode : '').(!empty($nama) ? '&filter_nama='.$nama : '')));
        }
    }
    
    
    public function data_supplier_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $kode       = $this->input->getVar('filter_kode');
            $hlmn       = $this->input->getVar('page');

            $Supp       = new \App\Models\mSupplier();
            $sql_supp   = $Supp->asObject()->orderBy('id', 'DESC')->like('kode', (!empty($kode) ? $kode : ''))->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLSupplier'   => $sql_supp->paginate($jml_limit),
                'Pagination'    => $sql_supp->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_supplier',
                'konten'        => $this->ThemePath.'/manajemen/master/data_supplier_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_supplier_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDSupp     = $this->input->getVar('id');
            
            if(!empty($IDSupp)){
                $Supp       = new \App\Models\mSupplier();
                $sql_supp   = $Supp->asObject()->where('id', $IDSupp)->first();
            }else{
                $sql_supp   = '';
            }
                                                
            $data  = [
                'SQLSupplier'   => $sql_supp,
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_supplier',
                'konten'        => $this->ThemePath.'/manajemen/master/data_supplier_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_supplier_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $nama   = $this->input->getVar('nama');
            $tlp    = $this->input->getVar('no_telp');
            $hp     = $this->input->getVar('no_hp');
            $npwp     = $this->input->getVar('npwp');
            $almt   = $this->input->getVar('alamat');
            $kota   = $this->input->getVar('kota');
            $prov   = $this->input->getVar('provinsi');
            $tipe   = $this->input->getVar('tipe');
            $status = $this->input->getVar('status');

            $Supp   = new \App\Models\mSupplier();

            # Aturan validasi form tulis disini
            $aturan = [
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
                'kota'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Kota supplier tidak boleh kosong',
                    ]
                ],
                'provinsi'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Provinsi tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'nama'      => $validasi->getError('nama'),
                    'alamat'    => $validasi->getError('alamat'),
                    'kota'      => $validasi->getError('kota'),
                    'provinsi'  => $validasi->getError('provinsi')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_supplier_tambah.php'));
            }else{
                $sql_cek    = $Supp->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $kode       = (!empty($this->Setting->kode_supp) ? $this->Setting->kode_supp : 'P').'-'.sprintf('%05d', $no_urut);

                $data = [
                    'kode'      => $kode,
                    'nama'      => $nama,
                    'no_telp'   => $tlp,
                    'no_hp'     => $hp,
                    'npwp'      => $npwp,
                    'alamat'    => $almt,
                    'provinsi'  => strtoupper($prov),
                    'kota'      => strtoupper($kota),
                    'status'    => $status,
                ];

                $Supp->save($data);
                $last_id = $Supp->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data supplier berhasil disimpan !!");');
                }

                return redirect()->to(base_url('master/data_supplier_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_supplier_update() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $IDSupp = $this->input->getVar('id');
            $nama   = $this->input->getVar('nama');
            $tlp    = $this->input->getVar('no_telp');
            $hp     = $this->input->getVar('no_hp');
            $npwp     = $this->input->getVar('npwp');
            $almt   = $this->input->getVar('alamat');
            $kota   = $this->input->getVar('kota');
            $prov   = $this->input->getVar('provinsi');
            $tipe   = $this->input->getVar('tipe');
            $status = $this->input->getVar('status');

            $Supp   = new \App\Models\mSupplier();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
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
                'alamat'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Alamat supplier tidak boleh kosong',
                    ]
                ],
                'kota'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Kota supplier tidak boleh kosong',
                    ]
                ],
                'provinsi'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Provinsi tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'nama'      => $validasi->getError('nama'),
                    'alamat'    => $validasi->getError('alamat'),
                    'kota'      => $validasi->getError('kota'),
                    'provinsi'  => $validasi->getError('provinsi')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/data_supplier_tambah.php?id='.$IDSupp));
            }else{
                $sql_cek    = $Supp->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $kode       = (!empty($this->Setting->kode_plgn) ? $this->Setting->kode_plgn : 'P').'-'.sprintf('%05d', $no_urut);

                $data = [
                    'id'        => $IDSupp,
                    'nama'      => $nama,
                    'no_telp'   => $tlp,
                    'no_hp'     => $hp,
                    'npwp'      => $npwp,
                    'alamat'    => $almt,
                    'provinsi'  => strtoupper($prov),
                    'kota'      => strtoupper($kota),
                    'status'    => $status,
                ];

                $Supp->save($data);
                $last_id = $IDSupp;

                if($last_id > 0){
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data supplier berhasil diubah !!");');
                }

                return redirect()->to(base_url('master/data_supplier_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_supplier_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDSupp     = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Supp   = new \App\Models\mSupplier();
                $Supp->where('id', $IDSupp)->delete();
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data supplier berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/data_supplier.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_supplier_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('kode');
            $nama   = $this->input->getVar('nama');
            
            return redirect()->to(base_url('master/data_supplier.php?'.(!empty($kode) ? 'filter_kode='.$kode : '').(!empty($nama) ? '&filter_nama='.$nama : '')));
        }
    }
    
    
    public function karyawan_list(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $nama       = $this->input->getVar('filter_nama');
            $kode       = $this->input->getVar('filter_kode');
            $hlmn       = $this->input->getVar('page');

            $Kary       = new \App\Models\mKaryawan();
            $sql_kary   = $Kary->asObject()->orderBy('id', 'DESC')->like('kode', (!empty($kode) ? $kode : ''))->like('nama', (!empty($nama) ? $nama : ''));
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLKary'       => $sql_kary->paginate($jml_limit),
                'Pagination'    => $sql_kary->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_karyawan',
                'konten'        => $this->ThemePath.'/manajemen/master/karyawan_list',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function karyawan_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDKry      = $this->input->getVar('id');

            $Profile        = new \App\Models\PengaturanProfile();
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            
            if(!empty($IDKry)){
                $Kry        = new \App\Models\mKaryawan();
                $sql_kary   = $Kry->asObject()->where('id', $IDKry)->first();
            }else{
                $sql_kary   = '';
            }
                                                
            $data  = [
                'SQLProfile'    => $sql_profile,
                'SQLKary'       => $sql_kary,
                'SQLUser'       => (!empty($sql_kary->id_user) ? $this->ionAuth->user($sql_kary->id_user)->row() : ''),
                'MenuAktif'     => 'active',
                'MenuOpen'      => 'menu-open',
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/master/menu_kiri_karyawan',
                'konten'        => $this->ThemePath.'/manajemen/master/karyawan_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function karyawan_set_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $id         = $this->input->getVar('id');
            $nik        = $this->input->getVar('nik');
            $nama       = $this->input->getVar('nama');
            $nama2      = $this->input->getVar('nama_blk');
            $jns_klm    = $this->input->getVar('jns_klm');
            $pers       = $this->input->getVar('perusahaan');
            $hp         = $this->input->getVar('no_hp');
            $almt       = $this->input->getVar('alamat');
            $almt2      = $this->input->getVar('alamat_dom');
            $tmp_lhr    = $this->input->getVar('tmp_lahir');
            $tgl_lhr    = $this->input->getVar('tgl_lahir');
            $fupl       = $this->input->getVar('fupload');
            $user       = $this->input->getVar('user');
            $pass1      = $this->input->getVar('pass');
            $pass2      = $this->input->getVar('pass2');
            $grup       = $this->input->getVar('grup');

            $Kry        = new \App\Models\mKaryawan();

            # Aturan validasi form tulis disini
            $aturan = [
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
                'user'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Username tidak boleh kosong',
                    ]
                ],
//                'pass'  => [
//                    'rules'     => 'required',
//                    'errors'    => [
//                        'required'      => 'Kata sandi tidak boleh kosong',
//                    ]
//                ],
//                'pass2'  => [
//                    'rules'     => 'required|matches[pass]',
//                    'errors'    => [
//                        'required'      => 'Ulang Kata sandi tidak boleh kosong dan harus sama',
//                    ]
//                ],
                'grup'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Grup tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'nik'       => $validasi->getError('nik'),
                    'nama'      => $validasi->getError('nama'),
                    'alamat'    => $validasi->getError('alamat'),
                    'jns_klm'   => $validasi->getError('jns_klm'),
                    'user'      => $validasi->getError('user'),
//                    'pass'      => $validasi->getError('pass'),
//                    'pass2'     => $validasi->getError('pass2'),
                    'grup'      => $validasi->getError('grup'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('master/karyawan_tambah.php'));
            }else{
                $sql_cek        = $Kry->asObject();
                $no_urut        = $sql_cek->countAll() + 1;
                $kode           = (!empty($this->Setting->kode_kary) ? $this->Setting->kode_kary : 'PG').'-'.sprintf('%03d', $no_urut);
                
                if($this->ionAuth->usernameCheck($user)){
                    $this->session->setFlashdata('master_toast', 'toastr.error("Username sudah digunakan, silahkan ulangi !");');
                    return redirect()->to(base_url('master/karyawan_tambah.php'));
                }else{
                    $group  = [$grup];
                    $email  = 'noreply@arshaka.co.id';
                    
                    $data_user = [
                        'nik'           => $nik,
                        'first_name'    => strtoupper($nama),
                        'last_name'     => $nama2,
                        'birthdate'     => tgl_indo_sys($tgl_lhr),
                    ];
                
                    $this->ionAuth->register($user, $pass2, $email, $data_user, $group);                    
                    $sql_user = $this->ionAuth->getUserIdFromIdentity($user);
                }
                
                $data = [
                    'id'            => $id,
                    'id_user'       => $sql_user,
                    'id_user_group' => $grup,
                    'id_perusahaan' => $pers,
                    'kode'          => $kode,
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
                $last_id = (!empty($id) ? $id : $Kry->insertID());

                if ($last_id > 0) {
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data karyawan berhasil disimpan !!");');
                }
                
                return redirect()->to(base_url('master/karyawan_tambah.php'.(!empty($last_id) ? '?id='.$last_id : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function karyawan_set_update() {
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
            $pers       = $this->input->getVar('perusahaan');
            $hp         = $this->input->getVar('no_hp');
            $almt       = $this->input->getVar('alamat');
            $almt2      = $this->input->getVar('alamat_dom');
            $tmp_lhr    = $this->input->getVar('tmp_lahir');
            $tgl_lhr    = $this->input->getVar('tgl_lahir');
            $fupl       = $this->input->getVar('fupload');
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
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);
                
                if(!empty($validasi->getError('pass2'))){
                    $this->session->setFlashdata('master_toast', 'toastr.error("'.$validasi->getError('pass2').'");');
                }

                return redirect()->to(base_url('master/karyawan_tambah.php?id='.$IDKary));
            }else{
                $sql_cek    = $Kry->asObject()->where('id', $IDKary)->first();
                $user_lama  = $this->ionAuth->user($IDUser)->row();

                # Cek username existing
                if($this->ionAuth->usernameCheck($user) AND $user_lama->username != $user){
                    $this->session->setFlashdata('master_toast', 'toastr.error("Username sudah digunakan, silahkan ulangi !");');
                    return redirect()->to(base_url('master/karyawan_tambah.php?id='.$IDKary));
                }else{
                    if(!empty($pass2)){
                        $data_user = [
                            'username'      => $user,
                            'first_name'    => strtoupper($nama),
                            'last_name'     => $nama2,
                            'birthdate'     => tgl_indo_sys($tgl_lhr),
                            'password'      => $pass2,
                        ];

                        $this->ionAuth->update($IDUser, $data_user);
                        $this->ionAuth->removeFromGroup($sql_cek->id_user_group, $IDUser);
                        $this->ionAuth->addToGroup($grup, $IDUser);                    
                    }else{
                        $data_user = [
                            'username'      => $user,
                            'first_name'    => strtoupper($nama),
                            'last_name'     => $nama2,
                            'birthdate'     => tgl_indo_sys($tgl_lhr),
                        ];

                        $this->ionAuth->update($IDUser, $data_user);
                        $this->ionAuth->removeFromGroup($sql_cek->id_user_group, $IDUser);
                        $this->ionAuth->addToGroup($grup, $IDUser);
                    }                    
                }
                
                $data = [
                    'id'            => $IDKary,
                    'id_user_group' => $grup,
                    'id_perusahaan' => $pers,
                    'nik'           => $nik,
                    'nama'          => strtoupper($nama),
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
                    $this->session->setFlashdata('master_toast', 'toastr.success("Data karyawan berhasil diubah !!");');
                }

                return redirect()->to(base_url('master/karyawan_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function karyawan_set_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDKary     = $this->input->getVar('id');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
//                $Kary   = new \App\Models\mKaryawan();
//                $Kary->where('id', $IDSupp)->delete();
                $this->ionAuth->deleteUser($IDKary);
                
                $this->session->setFlashdata('master_toast', 'toastr.success("Data karyawan berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('master/karyawan_list.php'.(!empty($Hal) ? '?page='.$Hal : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function karyawan_set_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('kode');
            $nama   = $this->input->getVar('nama');
            
            return redirect()->to(base_url('master/karyawan_list.php?'.(!empty($kode) ? 'filter_kode='.$kode : '').(!empty($nama) ? '&filter_nama='.$nama : '')));
        }
    }
}
