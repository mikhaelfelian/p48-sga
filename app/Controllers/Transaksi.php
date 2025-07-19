<?php
namespace App\Controllers;

use App\Models\PengaturanProfile;
use App\Models\mTipe;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use FPDF;
use DateTime;

/**
 * Description of Pengaturan
 *
 * @author mike
 */
class Transaksi extends BaseController {
    
    public function index(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $Rab        = new \App\Models\vtrRab();
            $sql_rab    = $Rab->asObject()->where('status', '1')->countAllResults();
                        
            $data  = [
                'RabPros'       => $Rab->asObject()->where('status', '1')->countAllResults(),
                'RabMen'        => $Rab->asObject()->where('status', '4')->countAllResults(),
                'RabKlh'        => $Rab->asObject()->where('status', '5')->countAllResults(),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/konten',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_pesanan(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $kode       = $this->input->getVar('filter_kode');
            $kat        = $this->input->getVar('filter_kat');
            $hlmn       = $this->input->getVar('page');

            $vtrPsn     = new \App\Models\vtrPesanan();
            $sql_psn    = $vtrPsn->asObject()->orderBy('id', 'DESC'); //->like('kode', (!empty($kode) ? $kode : ''))->like('kategori', (!empty($kat) ? $kat : ''));
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLPsn'        => $sql_psn->paginate($jml_limit),
                'Pagination'    => $vtrPsn->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_pesanan',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_pesanan',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_pesanan_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPsn      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            
            if(!empty($IDPsn)){
                $Pes            = new \App\Models\trPesanan();
                $PesDet         = new \App\Models\trPesananDet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $sql_psn        = $Pes->asObject()->where('id', $IDPsn)->first();
                $sql_psn_det    = $PesDet->asObject()->where('id_pesanan', $IDPsn)->find();
                $sql_psn_det_rw = $PesDet->asObject()->where('id', $IDItm)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('id', $sql_psn->id_pelanggan)->first();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
                        
            $data  = [
                'SQLPsn'        => $sql_psn,
                'SQLPsnDet'     => $sql_psn_det,
                'SQLPsnDetRw'   => $sql_psn_det_rw,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLPlgn'       => $sql_plgn,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_pesanan',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_pesanan_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_pesanan_jawab(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPsn      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            
            if(!empty($IDPsn)){
                $Pes            = new \App\Models\trPesanan();
                $PesDet         = new \App\Models\trPesananDet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $sql_psn        = $Pes->asObject()->where('id', $IDPsn)->first();
                $sql_psn_det    = $PesDet->asObject()->where('id_pesanan', $IDPsn)->find();
                $sql_psn_det_rw = $PesDet->asObject()->where('id', $IDItm)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('id', $sql_psn->id_pelanggan)->first();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
                        
            $data  = [
                'SQLPsn'        => $sql_psn,
                'SQLPsnDet'     => $sql_psn_det,
                'SQLPsnDetRw'   => $sql_psn_det_rw,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLPlgn'       => $sql_plgn,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_pesanan',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_pesanan_jawab',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pesanan_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idp        = $this->input->getVar('id_pelanggan');
            $plgn       = $this->input->getVar('pelanggan');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');

            $Plgn       = new \App\Models\mPelanggan();
            $Pes        = new \App\Models\trPesanan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_pelanggan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Pelanggan tidak boleh kosong',
                    ]
                ],
                'keterangan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Keterangan tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'pelanggan'     => $validasi->getError('id_pelanggan'),
                    'keterangan'    => $validasi->getError('keterangan')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/pesanan/data_pesanan_tambah.php'));
            }else{
                $sql_cek    = $Pes->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $no_nota    = (!empty($this->Setting->kode_pes) ? $this->Setting->kode_pes : 'PSN').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id_user'       => $ID->id,
                    'id_pelanggan'  => $idp,
                    'id_sales'      => $ID->id,
                    'no_nota'       => $no_nota,
                    'keterangan'    => $ket,
                    'status'        => '0',
                ];

                $Pes->save($data);
                $last_id = $Pes->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('transaksi/pesanan/data_pesanan_tambah.php?id='.$last_id));
                
                echo '<pre>';
                print_r($data);
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pesanan_proses() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idpsn      = $this->input->getVar('id_pesanan');
            $idp        = $this->input->getVar('id_pelanggan');
            $plgn       = $this->input->getVar('pelanggan');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');

            $Plgn       = new \App\Models\mPelanggan();
            $Pes        = new \App\Models\trPesanan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_pesanan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Pesanan tidak boleh kosong',
                    ]
                ],
                'status'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Status tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_pesanan'    => $validasi->getError('id_pesanan'),
                    'status'        => $validasi->getError('status')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/pesanan/data_pesanan_tambah.php'));
            }else{
                $sql_cek    = $Pes->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $no_nota    = (!empty($this->Setting->kode_pes) ? $this->Setting->kode_pes : 'PSN').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id'      => $idpsn,
                    'status'  => $status,
                ];

                $Pes->save($data);
                $last_id = $idpsn;

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Transaksi berhasil dikirim !!");');
                }

                return redirect()->to(base_url('transaksi/pesanan/data_pesanan_tambah.php?id='.$last_id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_pesanan_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idpsndet   = $this->input->getVar('id_pesanan_det');
            $idpsn      = $this->input->getVar('id_pesanan');
            $item       = $this->input->getVar('item');
            $jml        = $this->input->getVar('jml');
            $satuan     = $this->input->getVar('satuan');
            $pagu       = $this->input->getVar('pagu');

            $Plgn       = new \App\Models\mPelanggan();
            $Pes        = new \App\Models\trPesanan();
            $PesDet     = new \App\Models\trPesananDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_pesanan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Pesanan tidak boleh kosong',
                    ]
                ],
                'item'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Item tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Kuantiti tidak boleh kosong',
                    ]
                ],
                'satuan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Satuan tidak boleh kosong',
                    ]
                ],
//                'pagu'  => [
//                    'rules'     => 'required',
//                    'errors'    => [
//                        'required' => 'Pagu tidak boleh kosong',
//                    ]
//                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_pesanan'    => $validasi->getError('id_pesanan'),
                    'item'          => $validasi->getError('item'),
                    'jml'           => $validasi->getError('jml'),
                    'satuan'        => $validasi->getError('satuan'),
//                    'pagu'          => $validasi->getError('pagu')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/pesanan/data_pesanan_tambah.php'.(!empty($idpsn) ? '?id='.$idpsn : '')));
            }else{
                $sql_cek    = $Pes->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $no_nota    = (!empty($this->Setting->kode_pes) ? $this->Setting->kode_pes : 'PSN').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id'                => $idpsndet,
                    'id_pesanan'        => $idpsn,
                    'id_satuan_pesanan' => $satuan,
                    'id_user_sales'     => $ID->id,
                    'pesanan'           => $item,
                    'jml_pesanan'       => (float)$jml,
                    'pagu'              => format_angka_db($pagu),
                    'status'            => '0',
                ];

                $PesDet->save($data);
                $last_id = $PesDet->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Pesanan berhasil disimpan !!");');
                }

                return redirect()->to(base_url('transaksi/pesanan/data_pesanan_tambah.php?id='.$idpsn));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_pesanan_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPsn      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $PsnDet = new \App\Models\trPesananDet();
                $PsnDet->where('id', $IDItm)->delete();
                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('transaksi/pesanan/data_pesanan_tambah.php'.(!empty($IDPsn) ? '?id='.$IDPsn : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    

    
    public function data_rab(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $kode       = $this->input->getVar('filter_kode');
            $nama       = $this->input->getVar('filter_nama');
            $tipe       = $this->input->getVar('filter_tipe');
            $status     = $this->input->getVar('status');
            $hlmn       = $this->input->getVar('page');

            $Tipe       = new \App\Models\mTipe();
            $vtrRab     = new \App\Models\vtrRab();
            $sql_rab    = $vtrRab->asObject()->orderBy('id', 'DESC')->like('no_rab', (!empty($kode) ? $kode : ''))->like('p_nama', (!empty($nama) ? $nama : ''))->like('id_tipe', (!empty($tipe) ? $tipe : ''), (!empty($tipe) ? 'none' : ''))->like('status', (!empty($status) ? $status : ''), (!empty($status) ? 'none' : ''));
            $sql_tipe   = $Tipe->asObject()->where('status', '1')->find(); //->like('kode', (!empty($kode) ? $kode : ''))->like('kategori', (!empty($kat) ? $kat : ''));
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLRab'        => $sql_rab->paginate($jml_limit),
                'SQLTipe'       => $sql_tipe,
                'Pagination'    => $vtrRab->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_rab',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_rab',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_rab_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDPsn          = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            
            $Plgn           = new \App\Models\mPelanggan();
            $Tipe           = new \App\Models\mTipe();
            $Profile        = new \App\Models\PengaturanProfile();
            
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
            
            if(!empty($IDPsn)){
                $Pes            = new \App\Models\trPesanan();
                $PesDet         = new \App\Models\trPesananDet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan();
                
                $sql_psn        = $Pes->asObject()->where('id', $IDPsn)->first();
                $sql_psn_det    = $PesDet->asObject()->where('id_pesanan', $IDPsn)->find();
                $sql_psn_det_rw = $PesDet->asObject()->where('id', $IDItm)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('id', $sql_psn->id_pelanggan)->first();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
                        
            $data  = [
                'SQLPsn'        => $sql_psn,
                'SQLPsnDet'     => $sql_psn_det,
                'SQLPsnDetRw'   => $sql_psn_det_rw,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLPlgn'       => $sql_plgn,
                'SQLUser'       => $ID,
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'SQLTipe'       => $sql_tipe,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_rab',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_rab_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_rab_import(){
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
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_rab',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_rab_import',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_rab_detail(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDRab          = $this->input->getVar('id');
            $IDPO           = $this->input->getVar('id_po');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDRab)){
                $Rab            = new \App\Models\vtrRab();
                $RabDet         = new \App\Models\trRabDet();
                $RabLog         = new \App\Models\vtrRabLog();
                $PO             = new \App\Models\vtrPO();
                $PODet          = new \App\Models\trPODet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $PlgnCP         = new \App\Models\mPelangganCp();
                $Tipe           = new \App\Models\mTipe();
                $Profile        = new \App\Models\PengaturanProfile();
                
                $sql_rab        = $Rab->asObject()->where('id', $IDRab)->first();
                $sql_rab_det_rw = $RabDet->asObject()->where('id', $IDItmDet)->first();
                $sql_rab_sum    = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS c')->where('status', '1')->where('id_rab', $IDRab)->first();             
                $sql_rab_sum_bi = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('status', '2')->where('status_biaya', '0')->where('id_rab', $IDRab)->first();             
                $sql_rab_sum_bi2= $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('status', '2')->where('status_biaya', '1')->where('id_rab', $IDRab)->first();             
                $sql_rab_log    = $RabLog->asObject()->where('id_rab', $IDRab)->find();             
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('id', $sql_rab->id_pelanggan)->first();
                $sql_plgn_cp    = $PlgnCP->asObject()->where('id_pelanggan', $sql_rab->id_pelanggan)->find();
                $sql_profile    = $Profile->asObject()->where('status', '1')->find();
                $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
                $sql_po         = $PO->asObject()->where('id_rab', $IDRab)->find();             
                $sql_po_rw      = $PO->asObject()->where('id', $IDPO)->first();             
                $sql_po_rw_det  = $PODet->asObject()->where('id_pembelian', $IDPO)->find();             
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
                $sql_po         = '';
                $sql_po_rw      = '';
                $sql_po_rw_det  = '';
            }
                            
            $ItemData       = $RabDet->itemData($IDRab);
            $sql_rab_det    = json_decode($ItemData);
            $sql_rab_det_bi = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '0')->find();

            $data  = [
                'SQLRab'            => $sql_rab,
                'SQLRabDet'         => $sql_rab_det,
                'SQLRabDetBi'       => $sql_rab_det_bi,
                'SQLRabDetRw'       => $sql_rab_det_rw,
                'SQLRabDetSum'      => $sql_rab_sum,
                'SQLRabDetSumBi'    => $sql_rab_sum_bi,
                'SQLRabDetSumBi2'   => $sql_rab_sum_bi2,
                'SQLRabLog'         => $sql_rab_log,
                'SQLItem'           => $sql_item,
                'SQLSatuan'         => $sql_sat,
                'SQLPlgn'           => $sql_plgn,
                'SQLPlgnCP'         => $sql_plgn_cp,
                'SQLUser'           => $ID,
                'SQLProfile'        => $sql_profile,
                'SQLTipe'           => $sql_tipe,
                'SQLPO'             => $sql_po,
                'SQLPORw'           => $sql_po_rw,
                'SQLPORwDet'        => $sql_po_rw_det,
                'AksesGrup'         => $AksesGrup,
                'Pengguna'          => $ID,
                'PenggunaGrup'      => $IDGrup,
                'Pengaturan'        => $this->Setting,
                'ThemePath'         => $this->ThemePath,
                'menu_atas'         => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'         => $this->ThemePath.'/manajemen/transaksi/menu_kiri_rab',
                'konten'            => $this->ThemePath .'/manajemen/transaksi/data_rab_detail',
                'konten_aksi'       => $this->ThemePath.'/manajemen/transaksi/data_rab_aksi_atas',
                'konten_kanan'      => $this->ThemePath.'/manajemen/transaksi/data_rab_aksi_kanan',
                'konten_list'       => $this->ThemePath.'/manajemen/transaksi/data_rab_list',
                'konten_list_tind'  => $this->ThemePath.'/manajemen/transaksi/data_rab_list_tind',
                'konten_list_log'   => $this->ThemePath.'/manajemen/transaksi/data_rab_list_log',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_rab_aksi(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDRab          = $this->input->getVar('id');
            $IDPO           = $this->input->getVar('id_po');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDRab)){
                $Rab            = new \App\Models\vtrRab();
                $RabDet         = new \App\Models\trRabDet();
                $RabLog         = new \App\Models\vtrRabLog();
                $PO             = new \App\Models\vtrPO();
                $PODet          = new \App\Models\trPODet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $PlgnCP         = new \App\Models\mPelangganCp();
                $Tipe           = new \App\Models\mTipe();
                $Profile        = new \App\Models\PengaturanProfile();
                
                $sql_rab        = $Rab->asObject()->where('id', $IDRab)->first();
                $sql_rab_tipe   = $Tipe->asObject()->where('id', $sql_rab->id_tipe)->first();
                $sql_rab_det_rw = $RabDet->asObject()->where('id', $IDItmDet)->first();
//                $sql_rab_det_bi = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '0')->find();
                $sql_rab_sum    = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('status', '1')->where('id_rab', $IDRab)->first();             
                $sql_rab_sum_bi = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('status', '2')->where('status_biaya', '0')->where('id_rab', $IDRab)->first();             
                $sql_rab_sum_bi2= $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('status', '2')->where('status_biaya', '1')->where('id_rab', $IDRab)->first();             
                $sql_rab_sum_bi3= $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('status', '3')->where('status_biaya', '1')->where('id_rab', $IDRab)->first();             
                $sql_rab_log    = $RabLog->asObject()->where('id_rab', $IDRab)->find();             
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('status', '1')->find();
                $sql_plgn_rw    = $Plgn->asObject()->where('id', $sql_rab->id_pelanggan)->first();
                $sql_plgn_cp    = $PlgnCP->asObject()->where('id_pelanggan', $sql_rab->id_pelanggan)->find();
                $sql_profile    = $Profile->asObject()->where('status', '1')->find();
                $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
                $sql_po         = $PO->asObject()->where('id_rab', $IDRab)->find();             
                $sql_po_rw      = $PO->asObject()->where('id', $IDPO)->first();             
                $sql_po_rw_det  = $PODet->asObject()->where('id_pembelian', $IDPO)->find();             

            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
                $sql_plgn_cp    = '';
                $sql_po         = '';
                $sql_po_rw      = '';
                $sql_po_rw_det  = '';
            }
                            
            # Tentukan view berdasarkan status
            switch ($status) {
                default:
                    $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '1')->find();
                    $sql_rab_det_bi = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '0')->find();
                    $sql_rab_det_bi2 = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '3')->find();

                    $view = $this->ThemePath . '/manajemen/transaksi/data_rab_aksi';
                    break;

                case '1':
                    $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', $status)->find();
                    $sql_rab_det_bi = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '0')->find();
                    $sql_rab_det_bi2 = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '3')->find();;
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_rab_item';
                    break;

                case '2':
                    $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', $status)->find();
                    $sql_rab_det_bi = '';
                    $sql_rab_det_bi2 = '';
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_rab_biaya';
                    break;

                case '3':                    
                    $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '1')->find();
                    $sql_rab_det_bi = '';
                    $sql_rab_det_bi2 = '';
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_rab_po';
                    break;

                case '4':                    
                    $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', $status)->find();
            
                    $view = $this->ThemePath . '/manajemen/transaksi/data_rab_pen';
                    break;
                
                case '5':
                    $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', 3)->find();// DATA POTONGAN
                    $sql_rab_det_bi = '';
                    $sql_rab_det_bi2 = '';
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_rab_potongan';
                    break;
            }

            $data  = [
                'SQLRab'            => $sql_rab,
                'SQLRabTipe'        => $sql_rab_tipe,
                'SQLRabDet'         => $sql_rab_det,
                'SQLRabDetBi'       => $sql_rab_det_bi, // biaya
                'SQLRabDetBi2'      => $sql_rab_det_bi2, // potongan
                'SQLRabDetRw'       => $sql_rab_det_rw,
                'SQLRabDetSum'      => $sql_rab_sum,
                'SQLRabDetSumBi'    => $sql_rab_sum_bi,
                'SQLRabDetSumBi2'   => $sql_rab_sum_bi2,
                'SQLRabDetSumBi3'   => $sql_rab_sum_bi3,
                'SQLRabLog'         => $sql_rab_log,
                'SQLItem'           => $sql_item,
                'SQLSatuan'         => $sql_sat,
                'SQLPlgn'           => $sql_plgn,
                'SQLPlgnRw'         => $sql_plgn_rw,
                'SQLPlgnCP'         => $sql_plgn_cp,
                'SQLUser'           => $ID,
                'SQLUsers'          => $this->ionAuth->users('sales')->result(),
                'SQLProfile'        => $sql_profile,
                'SQLTipe'           => $sql_tipe,
                'SQLPO'             => $sql_po,
                'SQLPORw'           => $sql_po_rw,
                'SQLPORwDet'        => $sql_po_rw_det,
                'AksesGrup'         => $AksesGrup,
                'Pengguna'          => $ID,
                'PenggunaGrup'      => $IDGrup,
                'Pengaturan'        => $this->Setting,
                'ThemePath'         => $this->ThemePath,
                'menu_atas'         => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'         => $this->ThemePath.'/manajemen/transaksi/menu_kiri_rab',
                'konten'            => $view,
                'konten_aksi'       => $this->ThemePath.'/manajemen/transaksi/data_rab_aksi_atas',
                'konten_kanan'      => $this->ThemePath.'/manajemen/transaksi/data_rab_aksi_kanan',
                'konten_kanan_prn'  => $this->ThemePath.'/manajemen/transaksi/data_rab_aksi_kanan_print',
                'konten_list'       => $this->ThemePath.'/manajemen/transaksi/data_rab_list',
                'konten_list_tind'  => $this->ThemePath.'/manajemen/transaksi/data_rab_list_tind',
                'konten_list_log'   => $this->ThemePath.'/manajemen/transaksi/data_rab_list_log',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_rab_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idp        = $this->input->getVar('id_pelanggan');
            $plgn       = $this->input->getVar('pelanggan');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $sales      = $this->input->getVar('sales');
            $tipe       = $this->input->getVar('tipe');
            $pers       = $this->input->getVar('perusahaan');
            $pagu       = $this->input->getVar('pagu');
            $hps        = $this->input->getVar('hps');
            $no_kontrak = $this->input->getVar('no_kontrak');
            $no_paket   = $this->input->getVar('no_paket');
            $status     = $this->input->getVar('status');
            $status_ppn = $this->input->getVar('status_ppn');
            $pph        = $this->input->getVar('pph');

            $Profile    = new \App\Models\PengaturanProfile;
            $Plgn       = new \App\Models\mPelanggan();
            $Rab        = new \App\Models\trRab();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_pelanggan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Pelanggan tidak boleh kosong',
                    ]
                ],
                'tgl_masuk'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tanggal tidak boleh kosong',
                    ]
                ],
                'tipe'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tipe tidak boleh kosong',
                    ]
                ],
                'perusahaan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Perusahaan tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'pelanggan'     => $validasi->getError('id_pelanggan'),
                    'tgl_masuk'     => $validasi->getError('tgl_masuk'),
                    'tipe'          => $validasi->getError('tipe'),
                    'perusahaan'    => $validasi->getError('perusahaan')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/rab/data_rab_tambah.php'));
            }else{
                $sql_cek    = $Rab->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                    
                # Format nomor rab
                $sql_profile       = $Profile->asObject()->where('id', $pers)->first();
                $sql_rab_ck        = $Rab->asObject()->where('id_perusahaan', $pers)->where('YEAR(tgl_masuk)', date('Y'))->where('MONTH(tgl_masuk)', date('m'));
                $no_urut           = $sql_rab_ck->countAll() + 1;
                $no_nota           = $sql_profile->kode_rab_dpn.'/'.sprintf('%03d', $no_urut).'-'.$sql_profile->kode_srt_blk.'/'.format_romawi(date('m')).'/'.date('Y');
                
                $data = [
                    'id_user'       => $ID->id,
                    'id_pelanggan'  => $idp,
                    'id_sales'      => $sales,
                    'id_perusahaan' => $pers,
                    'id_tipe'       => $tipe,
                    'tgl_masuk'     => tgl_indo_sys($tgl_msk),
                    'no_rab'        => $no_nota,
                    'no_kontrak'    => $no_kontrak,
                    'no_paket'      => $no_paket,
                    'jml_hps'       => format_angka_db($hps),
                    'jml_pagu'      => format_angka_db($pagu),
                    'status'        => '0',
                    'status_ppn'    => $status_ppn,
                    'pph'           => (float)$pph
                ];

                $Rab->save($data);
                $last_id = $Rab->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('transaksi/rab/data_rab.php'));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_rab_update() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $idp        = $this->input->getVar('id_pelanggan');
            $plgn       = $this->input->getVar('pelanggan');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $sales      = $this->input->getVar('sales');
            $tipe       = $this->input->getVar('tipe');
            $pers       = $this->input->getVar('perusahaan');
            $pagu       = $this->input->getVar('pagu');
            $hps        = $this->input->getVar('hps');
            $no_kontrak = $this->input->getVar('no_kontrak');
            $no_paket   = $this->input->getVar('no_paket');
            $status     = $this->input->getVar('status');
            $status_ppn = $this->input->getVar('status_ppn');
            $no_paket = $this->input->getVar('no_paket');

            $Profile    = new \App\Models\PengaturanProfile;
            $Plgn       = new \App\Models\mPelanggan();
            $Rab        = new \App\Models\trRab();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id'     => $validasi->getError('id'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/rab/data_rab_tambah.php'));
            }else{
                $sql_cek    = $Rab->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                
                $data = [
                    'id'            => $id,
                    'id_pelanggan'  => $idp,
                    'id_sales'      => $sales,
                    'id_perusahaan' => $pers,
                    'id_tipe'       => $tipe,
                    'status'        => $status,
                    'no_paket'      => $no_paket
                ];

                $Rab->save($data);
                $last_id = $Rab->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php?id='.$id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    
    public function set_rab_simpan_po() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $ids        = $this->input->getVar('id_supplier');
            $id_po      = $this->input->getVar('id_po');
            $id_rab     = $this->input->getVar('id_rab');
            $id_penj    = $this->input->getVar('id_penj');
            $idp        = $this->input->getVar('perusahaan');
            $supp       = $this->input->getVar('supplier');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $ket        = $this->input->getVar('keterangan');
            $rute       = $this->input->getVar('route');
            $status     = $this->input->getVar('status');

            $Profile    = new \App\Models\PengaturanProfile();
            $Supp       = new \App\Models\mSupplier();
            $PO         = new \App\Models\trPO();
            $PODet      = new \App\Models\trPODet();
            $Rab        = new \App\Models\vtrRab();
            $RabDet     = new \App\Models\trRabDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_supplier'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Supplier tidak boleh kosong',
                    ]
                ],
                'tgl_masuk'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tanggal tidak boleh kosong',
                    ]
                ],
                'perusahaan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Perusahaan tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'supplier'      => $validasi->getError('id_supplier'),
                    'perusahaan'    => $validasi->getError('perusahaan'),
                    'tgl_masuk'     => $validasi->getError('tgl_masuk'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

//                return redirect()->to(base_url('pembelian/pesanan/data_pesanan_tambah.php'));
            }else{
                $sql_cek        = $PO->asObject();
                $sql_supp       = $Supp->asObject()->where('id', $ids)->first();
                $sql_rab        = $Rab->asObject()->where('id', $id_rab)->first();
                $sql_rab_det    = $RabDet->asObject()->where('id_rab', $id_rab)->where('status', '1')->find();

                # Format nomor po
                $sql_profile       = $Profile->asObject()->where('id', $idp)->first();
                $sql_po_ck         = $sql_cek->asObject()->where('id_perusahaan', $idp)->where('YEAR(tgl_masuk)', date('Y'))->where('MONTH(tgl_masuk)', date('m'));
                $no_urut           = $sql_po_ck->countAll() + 1;
                $no_nota           = $sql_profile->kode_po_dpn.'/'.sprintf('%03d', $no_urut).'-'.$sql_profile->kode_srt_blk.'/'.format_romawi(date('m')).'/'.date('Y');
                # ------------- END ---------------------
                
                
                $data = [
                    'id'            => $id_po,
                    'id_user'       => $ID->id,
                    'id_perusahaan' => $idp,
                    'id_supplier'   => $ids,
                    'id_rab'        => $id_rab,
                    'id_penjualan'  => $id_penj,
                    'tgl_masuk'     => tgl_indo_sys($tgl_msk),
                    'no_po'         => $no_nota,
                    'supplier'      => $sql_supp->nama,
                    'keterangan'    => $ket,
                    'status_nota'   => '0',
                ];                

                $PO->save($data);
                $last_id = (!empty($id_po) ? $id_po : $PO->insertID());

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("PO berhasil disimpan !!");');
                }
                
                if(!empty($rute)){
                    return redirect()->to(base_url($rute.(!empty($id_po) ? '&id_po='.$id_po : '')));
                }else{
                    return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php?id='.$id_rab.'&status='.$status.(!empty($id_po) ? '&id_po='.$id_po : '')));
                }
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_rab_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idrab      = $this->input->getVar('id_rab');
            $idrabdet   = $this->input->getVar('id_rab_det');
            $iditem     = $this->input->getVar('id_item');
            $item       = $this->input->getVar('item');
            $item_link  = $this->input->getVar('item_link');
            $item_sn  = $this->input->getVar('item_sn');
            $jml        = $this->input->getVar('jml');
            $harga      = $this->input->getVar('harga');
            $hpp        = $this->input->getVar('hpp');
            $satuan     = $this->input->getVar('satuan');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');
            $status_ppn = $this->input->getVar('status_ppn');
            $status_bi  = $this->input->getVar('status_biaya');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Rab        = new \App\Models\trRab();
            $RabDet     = new \App\Models\trRabDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_rab'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'item'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Item tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ]
                ],
                'harga'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Harga tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_rab'    => $validasi->getError('id_rab'),
                    'item'      => $validasi->getError('item'),
                    'jml'       => $validasi->getError('jml'),
                    'harga'     => $validasi->getError('harga'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                // JIKA POTONGAN ARAHKAN KE STATUS HALAMAN 5
                if($status == 3) {
                    return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php'.(!empty($idrab) ? '?id='.$idrab : '').(!empty($status) ? '&status=5' : '')));
                }
                
                return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php'.(!empty($idrab) ? '?id='.$idrab : '').(!empty($iditem) ? '&id_item='.$iditem : '').(!empty($status) ? '&status='.$status : '')));
            }else{
                $sql_rab         = $Rab->asObject()->where('id', $idrab)->first();
                $sql_item        = $Item->asObject()->where('id', $iditem)->first();
                $sql_sat         = $Satuan->asObject()->where('id', $satuan)->first();
                $sql_rab_sum     = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot, SUM(harga_pph) AS harga_pph')->where('id_rab', $sql_rab->id)->where('status', '1')->first();             
                $sql_rab_sum_bi  = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '0')->first();
                $sql_rab_sum_bi2 = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '1')->first();
                
                # Variable harga, hitung subtotalnya
                $hrg             = format_angka_db($harga);
                $subtotal        = $hrg * $jml;
                
                # Pastikan status item atau status = 1
                if($status == '1'){
                    $hrg_dpp         = hitung_dpp($this->Setting->dpp, $subtotal, '1');
                    $hrg_ppn         = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $subtotal);
                    $hrg_pph         = hitung_pph($this->Setting->dpp, $sql_rab->pph, $subtotal);

                    $hrg_hpp         = format_angka_db($hpp);
                    $hrg_hpp_subtot  = $hrg_hpp * $jml;
                    $hrg_hpp_dpp     = hitung_dpp($this->Setting->dpp, $hrg_hpp_subtot, $status_ppn);
                    $hrg_hpp_ppn     = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $hrg_hpp_subtot);
                    $hrg_hpp_tot     = (!empty($hrg_hpp) ? $hrg_hpp_subtot : 0);
                    $hrg_profit      = $subtotal - $hrg_ppn - $hrg_pph - $hrg_hpp_subtot;
//                    $hrg_profit      = (!empty($hrg_hpp) ? $subtotal - $hrg_hpp_subtot : 0);
                }else{
                    $hrg_dpp         = 0;
                    $hrg_ppn         = 0;
                    $hrg_pph         = 0;

                    $hrg_hpp         = 0;
                    $hrg_hpp_subtot  = 0;
                    $hrg_hpp_dpp     = 0;
                    $hrg_hpp_ppn     = 0;
                    $hrg_hpp_tot     = 0;
                    $hrg_profit_ppn  = 0;
                    $hrg_profit      = 0;
                }
                

                # Start Transact SQL
                $this->db->transBegin();
                
                $data = [
                    'id'            => $idrabdet,
                    'id_rab'        => $idrab,
                    'id_user'       => $ID->id,
                    'id_item'       => (!empty($sql_item->id) ? $sql_item->id : 0),
                    'id_item_kat'   => (!empty($sql_item->id_kategori) ? $sql_item->id_kategori : 0),
                    'id_satuan'     => (!empty($satuan) ? $satuan : 0),
                    'tgl_masuk'     => $sql_rab->tgl_masuk,
                    'kode'          => (!empty($sql_item->kode) ? $sql_item->kode : ''),
                    'item'          => $item,
                    'item_link'     => $item_link,
                    'item_sn'       => $item_sn,
                    'jml'           => (float)$jml,
                    'jml_satuan'    => (!empty($sql_sat->jml) ? (int)$sql_sat->jml : 1),
                    'satuan'        => (!empty($sql_sat->satuanBesar) ? $sql_sat->satuanBesar : ''),
                    'harga'         => (float)$hrg,
                    'harga_dpp'     => (float)$hrg_dpp,
                    'harga_ppn'     => (float)$hrg_ppn,
                    'harga_pph'     => (float)$hrg_pph,
                    'subtotal'      => (float)$subtotal,
                    'profit'        => (float)$hrg_profit ,
                    'harga_hpp'     => (float)$hrg_hpp,
                    'harga_hpp_ppn' => ($status_ppn == '1' ? (float)$hrg_hpp_ppn : 0),
                    'harga_hpp_tot' => (float)$hrg_hpp_tot,
                    'keterangan'    => $ket,
                    'status'        => (int)$status,
                    'status_ppn'    => (!empty($status_ppn) ? $status_ppn : 0),
                    'status_biaya'  => (int)$status_bi,
                ];
                
                # Jika semua oke, simpan ke database
                $RabDet->save($data);
                $last_id = (!empty($idrabdet) ? $idrabdet : $RabDet->insertID());
                
                
                # Hitung ulang totalnya dengan cara di SUM, lalu masukkan ke perhitungan tabel global
                $sql_rab_sum     = $RabDet->asObject()->select('SUM(harga_dpp) AS harga_dpp, SUM(harga_ppn) AS harga_ppn, SUM(harga_pph) AS harga_pph, SUM(subtotal) AS subtotal, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot, SUM(profit) AS profit')->where('id_rab', $sql_rab->id)->where('status', '1')->first();             
                $sql_rab_sum_bi  = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '0')->first();
                $sql_rab_sum_bi2 = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '1')->first(); // BIAYA
                $sql_rab_sum_bi3 = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('id_rab', $sql_rab->id)->where('status', '3')->where('status_biaya', '1')->first(); // POTONGAN
                $biayaTabahKurang = ($sql_rab_sum_bi2->subtotal ?? 0) - ($sql_rab_sum_bi3->subtotal ?? 0);

                # Cek jika ada biaya yang tampil di nota, maka hitung ulang
                if(!empty($sql_rab_sum_bi2->subtotal) || !empty($sql_rab_sum_bi3->subtotal) ){
                    // $gtotal     = $sql_rab_sum->subtotal + $sql_rab_sum_bi2->subtotal;
                    $gtotal     = $sql_rab_sum->subtotal + $biayaTabahKurang;
                    $jml_dpp    = hitung_dpp($this->Setting->dpp, $gtotal);
                    $jml_ppn    = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $gtotal);
                    $jml_pph    = hitung_pph($this->Setting->dpp, $sql_rab->pph, $gtotal);
                    $ppn        = $this->Setting->jml_ppn;
                    $pph        = $sql_rab->pph;
                    $netto      = $jml_dpp - $jml_pph;
                    $lk         = $netto - $sql_rab_sum->harga_hpp_tot;
                    $biaya      = $lk - $sql_rab_sum_bi->subtotal;
                    $lb         = $biaya + $sql_rab_sum->harga_hpp_ppn;
                }else{
                    $gtotal     = $sql_rab_sum->subtotal;
                    $jml_dpp    = $sql_rab_sum->harga_dpp;
                    $jml_ppn    = $sql_rab_sum->harga_ppn;
                    $jml_pph    = $sql_rab_sum->harga_pph;
                    $netto      = $sql_rab_sum->harga_dpp - $sql_rab_sum->harga_pph;
                    $lk         = $netto - $sql_rab_sum->harga_hpp_tot;
                    $biaya      = $lk - $sql_rab_sum_bi->subtotal;
                    $lb         = $biaya + $sql_rab_sum->harga_hpp_ppn;
                }
                
                // HANYA UPDATE RAB KETIKA DATA ITEM YG DIBUAT. KALAU YG DI BUAT DATA BIAYA DAN POTONGAN GAUSAH
                if($status == 1){
                    $data_rab = [
                        'id'            => $sql_rab->id,
                        'jml_total'     => (float)$jml_dpp,
                        'ppn'           => (float)$this->Setting->ppn,
                        'jml_ppn'       => (float)$jml_ppn,
                        'pph'           => (float)$sql_rab->pph,
                        'jml_pph'       => (float)$jml_pph,
                        'jml_gtotal'    => (float)$sql_rab_sum->subtotal,
                        // 'jml_biaya'     => (float)$sql_rab_sum_bi2->subtotal,
                        'jml_biaya'     => (float)$biayaTabahKurang,
                        'jml_hpp'       => (float)$sql_rab_sum->harga_hpp_tot,
                        'jml_hpp_ppn'   => (float)$sql_rab_sum->harga_hpp_ppn,
                        'jml_profit'    => (float)$lb,
                    ];
                    
                    $Rab->save($data_rab);
                }

                // JIKA HPP ITEM PADA RAB DIUBAH. MAKA UBAH JUGA HPP ITEM MASTER
                if(!empty($sql_item->id) && ($sql_item->harga_beli != format_angka_db($hpp))){
                    $updateItem = [
                        "id" => $sql_item->id,
                        "harga_beli" => (float)format_angka_db($hpp)
                    ];
                    $itemModel = $Item->save($updateItem);
                }

                # End off transact SQL
                $this->db->transComplete();

                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }
                
                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil disimpan !!");');
                }else{
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil diupdate !!");');
                }

                // JIKA POTONGAN ARAHKAN KE STATUS HALAMAN 5
                if($status == 3) {
                    return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php'.(!empty($idrab) ? '?id='.$idrab : '').(!empty($status) ? '&status=5' : '')));
                }

                return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php'.(!empty($idrab) ? '?id='.$idrab : '').(!empty($status) ? '&status='.$status : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_rab_simpan_po() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id_rab     = $this->input->getVar('id_rab');
            $id_rab_det = $this->input->getVar('id_rab_det');
            $id_po      = $this->input->getVar('id_po');
            $id_itm     = $this->input->getVar('id_item');
            $id_satuan  = $this->input->getVar('id_satuan');
            $item       = $this->input->getVar('item');
            $item_link  = $this->input->getVar('item_link');
            $jml        = $this->input->getVar('jml');
            $harga      = $this->input->getVar('harga');
            $satuan     = $this->input->getVar('satuan');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');
            $status_ppn = $this->input->getVar('status_ppn');
            $status_bi  = $this->input->getVar('status_biaya');
            $act        = $this->input->getVar('act');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Rab        = new \App\Models\trRab();
            $RabDet     = new \App\Models\trRabDet();
            $PO         = new \App\Models\trPO();
            $PODet      = new \App\Models\trPODet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_rab'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'item'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Item tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ]
                ],
                'harga'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Harga tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_rab'        => $validasi->getError('id_rab'),
                    'item'          => $validasi->getError('item'),
                    'jml'           => $validasi->getError('jml'),
                    'harga'         => $validasi->getError('harga'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php?act='.$act.(!empty($id_rab) ? '&id='.$id_rab : '').(!empty($status) ? '&status='.$status : '').(!empty($id_po) ? '&id_po='.$id_po : '').(!empty($id_itm) ? '&id_item='.$id_itm : '').(!empty($id_rab_det) ? '&id_item_det='.$id_rab_det : '')));
            }else{
                $sql_rab         = $Rab->asObject()->where('id', $id_rab)->first();
                $sql_rab_det     = $RabDet->asObject()->where('id', $id_rab_det)->first();
                $sql_item        = $Item->asObject()->where('id', $id_itm)->first();
                $sql_sat         = $Satuan->asObject()->where('id', $id_satuan)->first();
                
                $hrg        = format_angka_db($harga);
                $subtotal   = $hrg * $jml;
                
                # Hitung dari jml rab dikurangi jml yang di PO
                $sisa_po = $sql_rab_det->jml_po + $jml;
                
                if($sisa_po > $sql_rab_det->jml){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.error("Jml PO tidak boleh lebih besar maupun lebih !!");');
                }elseif($jml < 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.error("Jml PO tidak boleh lebih besar maupun lebih !!");');
                }else{
                    # Start Transact SQL
                    $this->db->transBegin();

                    $data_po = [
                        'id_pembelian'      => $id_po,
                        'id_satuan'         => $id_satuan,
                        'id_user'           => $ID->id,
                        'id_item'           => $id_itm,
                        'id_rab_det'        => $id_rab_det,
                        'kode'              => $sql_item->kode,
                        'item'              => $sql_item->item,
                        'jml'               => (int)$jml,
                        'jml_satuan'        => (int)$sql_sat->jml,
                        'harga'             => (float)$hrg,
                        'subtotal'          => (float)$subtotal,
                        'satuan'            => $sql_sat->satuanBesar,
                        'status'            => '0',
                        'status_ppn'        => (!empty($status_ppn) ? $status_ppn : 0),
                    ];

                    $PODet->save($data_po);
                    $last_id = $PODet->insertID;

                    # Simpan jumlah PO ke tabel rab det
                    $data_rab = ['id'=>$sql_rab_det->id,'jml_po'=>$sisa_po];
                    $RabDet->save($data_rab);

                    # End off transact SQL
                    $this->db->transComplete();

                    # Cek status transact SQL, jika gagal maka rollback
                    if ($this->db->transStatus() === false) {
                        $this->db->transRollback();
                    }else{
                        # Set commit jika berhasil
                        $this->db->transCommit();
                    }

                    if($last_id > 0){
                        $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil disimpan !!");');
                    }else{
                        $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil diupdate !!");');
                    }
                }

                return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php?act='.$act.(!empty($id_rab) ? '&id='.$id_rab : '').(!empty($status) ? '&status='.$status : '').(!empty($id_po) ? '&id_po='.$id_po : '').(!empty($id_itm) ? '&id_item='.$id_itm : '').(!empty($id_rab_det) ? '&id_item_det='.$id_rab_det : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_rab_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDRab      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $status     = $this->input->getVar('status');
            
            if($this->input->is('get') == 1){
                $Rab            = new \App\Models\trRab();
                $RabDet         = new \App\Models\trRabDet();
                $sql_rab_det    = $RabDet->asObject()->where('id', $IDItm)->first();
                
                # Start Transact SQL
                $this->db->transBegin();
                
                $RabDet->where('id', $IDItm)->delete();
                
                # Hitung ulang totalnya dengan cara di SUM, lalu masukkan ke perhitungan tabel global
                $sql_rab         = $Rab->asObject()->where('id', $IDRab)->first();
                $sql_rab_sum     = $RabDet->asObject()->select('SUM(harga_dpp) AS harga_dpp, SUM(harga_ppn) AS harga_ppn, SUM(harga_pph) AS harga_pph, SUM(subtotal) AS subtotal, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot, SUM(profit) AS profit')->where('id_rab', $sql_rab->id)->where('status', '1')->first();             
                $sql_rab_sum_bi  = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '0')->first();
                $sql_rab_sum_bi2 = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '1')->first();
                $sql_rab_sum_bi3 = $RabDet->asObject()->select('SUM(subtotal) AS subtotal')->where('id_rab', $sql_rab->id)->where('status', '3')->where('status_biaya', '1')->first();
                $biayaTabahKurang = ($sql_rab_sum_bi2->subtotal ?? 0) - ($sql_rab_sum_bi3->subtotal ?? 0);
                
                # Cek jika ada biaya yang tampil di nota, maka hitung ulang
                if(!empty($sql_rab_sum_bi->subtotal)){
                    // $gtotal     = $sql_rab_sum->subtotal + $sql_rab_sum_bi2->subtotal;
                    $gtotal     = $sql_rab_sum->subtotal + $biayaTabahKurang;
                    $jml_dpp    = hitung_dpp($this->Setting->dpp, $gtotal);
                    $jml_ppn    = hitung_ppn($this->Setting->ppn, $this->Setting->ppn_tot, $gtotal);
                    $jml_pph    = hitung_pph($this->Setting->dpp, $sql_rab->pph, $gtotal);
                    $ppn        = $this->Setting->jml_ppn;
                    $pph        = $sql_rab->pph;
                    $netto      = $jml_dpp - $jml_pph;
                    $lk         = $netto - $sql_rab_sum->harga_hpp_tot;
                    $biaya      = $lk - $sql_rab_sum_bi->subtotal;
                    $lb         = $biaya + $sql_rab_sum->harga_hpp_ppn;
                }else{
                    $gtotal     = $sql_rab_sum->subtotal;
                    $jml_dpp    = $sql_rab_sum->harga_dpp;
                    $jml_ppn    = $sql_rab_sum->harga_ppn;
                    $jml_pph    = $sql_rab_sum->harga_pph;
                    $netto      = $sql_rab_sum->harga_dpp - $sql_rab_sum->harga_pph;
                    $lk         = $netto - $sql_rab_sum->harga_hpp_tot;
                    $biaya      = $lk - $sql_rab_sum_bi->subtotal;
                    $lb         = $biaya + $sql_rab_sum->harga_hpp_ppn;
                }
                
                $data_rab = [
                    'id'            => $sql_rab->id,
                    'jml_total'     => (float)$jml_dpp,
                    'ppn'           => (float)$this->Setting->ppn,
                    'jml_ppn'       => (float)$jml_ppn,
                    'pph'           => (float)$sql_rab->pph,
                    'jml_pph'       => (float)$jml_pph,
                    'jml_gtotal'    => (float)$sql_rab_sum->subtotal,
                    // 'jml_biaya'     => (float)$sql_rab_sum_bi2->subtotal,
                    'jml_biaya'     => (float)$biayaTabahKurang,
                    'jml_hpp'       => (float)$sql_rab_sum->harga_hpp_tot,
                    'jml_hpp_ppn'   => (float)$sql_rab_sum->harga_hpp_ppn,
                    'jml_profit'    => (float)$lb,
                ];
                
                $Rab->save($data_rab);
                
                # End off transact SQL
                $this->db->transComplete();

                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                } 
                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php'.(!empty($IDRab) ? '?id='.$IDRab : '').(!empty($status) ? '&status='.$status : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }  
    
    public function cart_rab_hapus_po(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDRab      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $id_itm_det = $this->input->getVar('id_item_det');
            $id_po      = $this->input->getVar('id_po');
            $act        = $this->input->getVar('act');
            $status     = $this->input->getVar('status');
            
            if($this->input->is('get') == 1){
                $RabDet        = new \App\Models\trRabDet();
                $PODet         = new \App\Models\trPODet();
                $sql_rab_det   = $RabDet->asObject()->where('id', $id_itm_det)->first();
                $sql_po_det    = $PODet->asObject()->where('id', $IDItm)->first();
                $sisa_po       = (!empty($sql_rab_det->jml_po) ? $sql_rab_det->jml_po : 0) - $sql_po_det->jml;
                
                # Start Transact SQL
                $this->db->transBegin();
                
                $data_rab = ['id'=>$id_itm_det,'jml_po'=>$sisa_po];
                $RabDet->save($data_rab);
                
                $PODet->where('id', $IDItm)->delete();

                # End off transact SQL
                $this->db->transComplete();

                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                } 
                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php?act='.$act.(!empty($IDRab) ? '&id='.$IDRab : '').(!empty($status) ? '&status='.$status : '').(!empty($id_po) ? '&id_po='.$id_po : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }  
    
    public function set_rab_proses() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $user       = $this->input->getVar('user');
            $status     = $this->input->getVar('status');
            $jml_gtotal = $this->input->getVar('jml_gtotal');
            $psn        = $this->input->getVar('pesan');
            $rute       = $this->input->getVar('route');
            $keterangan = $this->input->getVar('keterangan');

            $Plgn       = new \App\Models\mPelanggan();
            $Rab        = new \App\Models\trRab();
            $RabPen     = new \App\Models\trRabPen();
            $RabDet     = new \App\Models\trRabDet();
            $PO         = new \App\Models\vtrPO();
            $Penj       = new \App\Models\trPenj();
            $PenjDet    = new \App\Models\trPenjDet();
            $PenjPO     = new \App\Models\trPenjPO();
            $Profile    = new \App\Models\PengaturanProfile();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'status'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Status tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id'            => $validasi->getError('id'),
                    'status'        => $validasi->getError('status'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/rab/data_rab_tambah.php'));
            }else{
                $sql_rab            = $Rab->asObject()->where('id', $id)->first();
                $sql_rab_det        = $RabDet->asObject()->where('id_rab', $sql_rab->id)->find();
                $sql_rab_sum        = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $sql_rab->id)->where('status', '1')->first();             
                $sql_rab_sum_bi     = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '0')->first();
                $sql_rab_sum_bi2    = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $sql_rab->id)->where('status', '2')->where('status_biaya', '1')->first();
                $gtotal             = $sql_rab_sum->subtotal + $sql_rab_sum_bi2->subtotal;
                
                # Start Transact SQL
                $this->db->transBegin();
                
                // SET KETERANGAN HANYA DIISI KETIKA DI TOLAK
                if(!in_array($status, ['2','3'])) {
                    $keterangan = null;
                }
                
                # Cek id dan perubahan data status nya dan hitung ulang total
                $data = [
                    'id'            => $id,
                    'status'        => $status,
                    'keterangan'    => $keterangan
                ];

                $Rab->save($data);
                $last_id = $id;

                # Jika status = 2 atau ACC Pimpinan, maka buat nomor penawarannya secara otomatis
                if($status == '2'){
                    # Cek dulu sudah ada surat yang masuk belum, jika sudah hapus dulu. Terapkan 1 RAB 1 nomor surat
                    $sql_rab_pen_cek    = $RabPen->asObject()->where('id_rab', $sql_rab->id);
                    
                    if($sql_rab_pen_cek->countAll() > 0){
                        $trRabPen   = new \App\Models\trRabPen();
                        $trRabPen->where('id_rab', $sql_rab->id)->delete();
                    }
                    
                    # Hitung nomor surat yang masuk
                    $sql_profile        = $Profile->asObject()->where('id', $sql_rab->id_perusahaan)->first();
                    $sql_rab_pen        = $RabPen->asObject()->where('id_rab', $sql_rab->id)->where('id_perusahaan', $sql_rab->id_perusahaan)->where('YEAR(tgl_simpan)', date('Y'))->where('MONTH(tgl_simpan)', date('m'));
                    $no_urut            = $sql_rab_pen->countAll() + 1;
                    $no_surat           = $sql_profile->kode_srt_dpn.'/'.sprintf('%03d', $no_urut).'-'.$sql_profile->kode_srt_blk.'/'.format_romawi(date('m')).'/'.date('Y');
                    
                    # Simpan data surat ke database
                    $data_pen = [
                        'id_rab'        => $sql_rab->id,
                        'id_user'       => $ID->id,
                        'id_perusahaan' => $sql_rab->id_perusahaan,
                        'no_surat'      => $no_surat,
                        'status'        => '0'
                    ];
                    
                    $RabPen->save($data_pen);
                }
                
                # Jika status = 6 atau posting, maka lempar ke tabel penjualan
                if($status == '6'){
                    $sql_cek    = $Penj->asObject();
                    $sql_cek_po = $PO->asObject()->where('id_rab', $sql_rab->id)->find();
                    $no_urut    = $sql_cek->countAll() + 1;
                    $no_nota    = (!empty($this->Setting->kode_penj) ? $this->Setting->kode_penj : 'PJ').'-'.sprintf('%05d', $no_urut);
                
                    # Format nomor invoice
                    $sql_profile        = $Profile->asObject()->where('id', $sql_rab->id_perusahaan)->first();
                    $sql_penj_ck        = $Penj->asObject()->where('id_perusahaan', $sql_rab->id_perusahaan)->where('YEAR(tgl_bayar)', date('Y'))->where('MONTH(tgl_bayar)', date('m'));
                    $no_urut            = $sql_penj_ck->countAll() + 1;
                    $no_surat           = $sql_profile->kode_inv_dpn.'/'.sprintf('%03d', $no_urut).'-'.$sql_profile->kode_srt_blk.'/'.format_romawi(date('m')).'/'.date('Y');

                    # Simpan dahulu data di tabel penjualan nya
                    $data_penj = [
                        'id_rab'        => $sql_rab->id,
                        'id_user'       => $user,
                        'id_sales'      => $sql_rab->id_sales,
                        'id_pelanggan'  => $sql_rab->id_pelanggan,
                        'id_perusahaan' => $sql_rab->id_perusahaan,
                        'id_tipe'       => $sql_rab->id_tipe,
                        'tgl_masuk'     => $sql_rab->tgl_masuk,
                        'no_nota'       => $no_surat,
                        'no_kontrak'    => $sql_rab->no_kontrak,
                        'no_paket'      => $sql_rab->no_paket,
                        'jml_total'     => (float)$sql_rab->jml_total,
                        'ppn'           => (float)$sql_rab->ppn,
                        'jml_ppn'       => (float)$sql_rab->jml_ppn,
                        'pph'           => (float)$sql_rab->pph,
                        'jml_pph'       => (float)$sql_rab->jml_pph,
                        'jml_gtotal'    => (float)$sql_rab->jml_gtotal,
                        'jml_biaya'     => (float)$sql_rab->jml_biaya,
                        'jml_hpp'       => (float)$sql_rab->jml_hpp,
                        'jml_hpp_ppn'   => (float)$sql_rab->jml_hpp_ppn,
                        'jml_profit'    => (float)$sql_rab->jml_profit,
                        'status'        => '0',
                        'status_ppn'    => $sql_rab->status_ppn,
                    ];

                    $Penj->save($data_penj);
                    $last_id = $Penj->insertID();
                    
                    # Ambil detail rab lalu simpan ke tabel detail penjualan
                    foreach ($sql_rab_det as $rab_det){
                        $data_penj_det = [
                            'id_penjualan'  => $last_id,
                            'id_item'       => $rab_det->id_item,
                            'id_item_kat'   => $rab_det->id_item_kat,
                            'id_item_sat'   => $rab_det->id_satuan,
                            'tgl_masuk'     => $sql_rab->tgl_masuk,
                            'kode'          => $rab_det->kode,
                            'item'          => $rab_det->item,
                            'item_link'     => $rab_det->item_link,
                            'jml'           => (float)$rab_det->jml,
                            'jml_satuan'    => (float)$rab_det->jml_satuan,
                            'satuan'        => $rab_det->satuan,
                            'harga'         => (float)$rab_det->harga,
                            'subtotal'      => (float)$rab_det->subtotal,
                            'profit'        => (float)$rab_det->profit,
                            'harga_hpp'     => (float)$rab_det->harga_hpp,
                            'harga_hpp_ppn' => (float)$rab_det->harga_hpp_ppn,
                            'harga_hpp_tot' => (float)$rab_det->harga_hpp_tot,
                            'status_ppn'    => $rab_det->status_ppn,
                            'status_biaya'  => $rab_det->status_biaya,
                            'status'        => $rab_det->status,
                        ];
                        
                        $PenjDet->save($data_penj_det);
                        $last_id_det = $PenjDet->insertID();
                    }
                    
                    $Log = new \App\Models\trPenjLog();
                    $data_log = [
                        'id_penjualan'  => $last_id,
                        'id_user'       => $ID->id,
                        'log'           => json_encode($data_penj),
                        'status'        => '1'
                    ];
                    $Log->save($data_log);
                }
                
                # End off transact SQL
                $this->db->transComplete();

                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', $psn);
                }

                return redirect()->to(base_url($rute));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_rab_upload() {
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $fupl   = $this->request->getFile('fupload');

            $Kat    = new \App\Models\mKategori();
            $Merk   = new \App\Models\mMerk();
            $Satuan = new \App\Models\mSatuan();
            $Item   = new \App\Models\mItem();
            $Plgn   = new \App\Models\mPelanggan();
            $Tipe   = new \App\Models\mTipe();
            $Persh  = new \App\Models\PengaturanProfile();
            $Rab    = new \App\Models\trRab();
            $RabDet = new \App\Models\trRabDet();

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
                    $this->session->setFlashdata('transaksi_toast', 'toastr.error("Unggah excel error !!");');
                    return redirect()->to(base_url('transaksi/rab/data_rab_import.php'));
                }
                
                $data = $objPHPOffice->getWorksheetIterator();
                
                foreach($data as $x => $ws) {
                    # Ambil nilai tertinggi dari kolom dan baris
                    $brsmax     = $ws->getHighestRow();
                    $klmmax     = $ws->getHighestColumn();
                    
                    $plgn       = $ws->getCellByColumnAndRow(2, 2)->getValue();                      
                    $tipe       = $ws->getCellByColumnAndRow(3, 2)->getValue();
                    $profil     = $ws->getCellByColumnAndRow(4, 2)->getValue();
                    $pagu       = $ws->getCellByColumnAndRow(5, 2)->getValue();
                    $hps        = $ws->getCellByColumnAndRow(6, 2)->getValue();
                    
                    $sql_plgn   = $Plgn->asObject()->where('nama', $plgn);
                    $sql_tipe   = $Tipe->asObject()->where('tipe', $tipe);
                    $sql_profil = $Persh->asObject()->where('nama', $profil);
                    $sql_rab    = $Rab->asObject();
                    
                    $no_urut    = $sql_rab->countAll() + 1;
                    $no_rab     = (!empty($this->Setting->kode_rab) ? $this->Setting->kode_rab : 'RAB').'-'.sprintf('%05d', $no_urut);
                    
                    # Cek jika pelanggan belum terinput
                    if($sql_plgn->countAllResults() == 0){
                        $no_urut_plgn   = $sql_plgn->countAll() + 1;
                        $kode_plgn      = (!empty($this->Setting->kode_plgn) ? $this->Setting->kode_plgn : 'C').'-'.sprintf('%05d', $no_urut_plgn);
                        
                        $data_plgn = [
                            'id_user'   => $ID->id,
                            'kode'      => $kode_plgn,
                            'nama'      => $plgn,
                            'tipe'      => '1',
                            'status'    => '1'
                        ];
                        
                        $Plgn->save($data_plgn);
                        $id_plgn = $Plgn->insertID();
                    }else{
                        $id_plgn = $Plgn->asObject()->where('nama', $plgn)->first()->id;
                    }
                    
                    # Cek jika tipe belum terinput
                    if($sql_tipe->countAllResults() == 0){
                        $data_tipe = [
                            'id_user'   => $ID->id,
                            'tipe'      => $tipe,
                            'status'    => '1'
                        ];
                        
                        $Tipe->save($data_tipe);
                        $id_tipe = $Tipe->insertID();
                    }else{
                        $id_tipe = $Tipe->asObject()->where('tipe', $tipe)->first()->id;
                    }
                    
                    # Cek jika company belum terinput
                    if($sql_profil->countAllResults() == 0){
                        $data_profil = [
                            'id_pengaturan' => $this->Setting->id,
                            'id_user'       => $ID->id,
                            'nama'          => $profil,
                            'status'        => '1'
                        ];
                        
                        $Persh->save($data_profil);
                        $id_profil = $Persh->insertID();
                    }else{
                        $id_profil = $Persh->asObject()->where('nama', $profil)->first()->id;
                    }
                    
                    # Input RAB nya                        
                    $data_rab = [
                        'id_user'       => $ID->id,
                        'id_pelanggan'  => $id_plgn,
                        'id_sales'      => $ID->id,
                        'id_perusahaan' => $id_profil,
                        'id_tipe'       => $id_tipe,
                        'tgl_masuk'     => date('Y-m-d'),
                        'no_rab'        => $no_rab,
                        'jml_hps'       => format_angka_db($hps),
                        'jml_pagu'      => format_angka_db($pagu),
                        'status'        => '0',
                    ];
                    
                    $Rab->save($data_rab);
                    $id_rab = $Rab->insertID();
                    
                    $sql_rab = $Rab->asObject()->where('id', $id_rab)->first();
                    
                    for($brs=2; $brs <= $brsmax; $brs++){ 
                        $kat        = $ws->getCellByColumnAndRow(7, $brs)->getValue();                      
                        $merk       = $ws->getCellByColumnAndRow(8, $brs)->getValue();
                        $kode       = $ws->getCellByColumnAndRow(9, $brs)->getValue();
                        $item       = $ws->getCellByColumnAndRow(10, $brs)->getValue();
                        $jml        = $ws->getCellByColumnAndRow(11, $brs)->getValue();
                        $satuan     = $ws->getCellByColumnAndRow(12, $brs)->getValue();
                        $harga      = $ws->getCellByColumnAndRow(13, $brs)->getValue();

                        $sql_kat    = $Kat->asObject()->where('kategori', $kat);
                        $sql_merk   = $Merk->asObject()->where('merk', $merk);
                        $sql_satuan = $Satuan->asObject()->where('satuanBesar', $satuan);
                        $sql_item   = $Item->asObject()->where('item', $item);
                        
                        # Cek kategori sudah ada belum, jika belum maka insert
                        if($sql_kat->countAllResults() == 0){                            
                            $data_kat = [
                                'kode'      => strtoupper(substr(str_replace('-', '', $kat), 0, 2)),
                                'kategori'  => $kat,
                                'status'    => '1'
                            ];
                            
                            $Kat->save($data_kat);
                            $id_kategori = $Kat->insertID();
                        }else{
                            $id_kategori = $Kat->asObject()->where('kategori', $kat)->first()->id;
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
                            $id_merk = $Merk->asObject()->where('merk', $merk)->first()->id;
                        }
                        
                        # Cek jika sat belum ada
                        if($sql_satuan->countAllResults() == 0){                            
                            $data_sat = [
                                'satuanTerkecil'=> $satuan,
                                'satuanBesar'   => $satuan,
                                'jml'           => '1',
                                'status'        => '1'
                            ];
                            
                            $Satuan->save($data_sat);
                            $id_satuan = $Satuan->insertID();
                        }else{
                            $id_satuan = $Satuan->asObject()->where('satuanBesar', $satuan)->first()->id;
                        }
                        
                        # Cek jika item belum ada
                        if($sql_item->countAllResults() == 0){                        
                            $data_item = [
                                'id_satuan'     => 1,
                                'id_kategori'   => $id_kategori,
                                'id_merk'       => $id_merk,
                                'id_user'       => $ID->id,
                                'kode'          => $kode,
                                'item'          => strtoupper($item),
                                'harga_jual'    => format_angka_db($harga),
                                'status'        => '1',
                                'status_stok'   => '1',
                            ];
                            
                            $Item->save($data_item);
                            $id_item = $Item->insertID();
                        }else{
                            $id_item = $Item->asObject()->where('item', $item)->first()->id;
                        }
                        
                        $subtotal = $harga * $jml;
                                
                        # Input ke tabel rab_det
                        $data_det = [
                            'id_rab'        => $id_rab,
                            'id_item'       => (int)$id_item,
                            'id_item_kat'   => (int)$id_kategori,
                            'id_satuan'     => (int)$id_satuan,
                            'tgl_masuk'     => date('Y-m-d'),
                            'kode'          => $kode,
                            'item'          => strtoupper($item),
                            'jml'           => (int)$jml,
                            'jml_satuan'    => 1,
                            'satuan'        => $satuan,
                            'harga'         => (float)$harga,
                            'subtotal'      => (float)$subtotal,
                            'status'        => 1,
                        ];

                        $RabDet->save($data_det);
                        $last_id = $RabDet->insertID();
                    }
                }
                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Rab berhasil di unggah !!");');
                return redirect()->to(base_url('transaksi/rab/data_rab.php')); 
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_rab_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDRab      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Rab = new \App\Models\trRab();
                
                $data = ['id'=>$IDRab,'status_hps'=>'1'];
                $Rab->save($data);
                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Rab berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('transaksi/rab/data_rab.php'));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_rab_hapus_po(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDRab      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_po');
            $status     = $this->input->getVar('status');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $PO     = new \App\Models\trPO();
                $PODet  = new \App\Models\trPODet();
                
                $data_po = ['jml_po'=>'0'];
                $this->db->table('tbl_trans_rab_det')->where('id_rab', $IDRab)->set($data_po)->update();
                $PO->where('id', $IDItm)->delete();
//                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("PO berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php?id='.$IDRab.'&status='.$status));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_rab_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('no_rab');
            $nama   = $this->input->getVar('nama');
            $tipe   = $this->input->getVar('tipe');
            
            return redirect()->to(base_url('transaksi/rab/data_rab.php?'.(!empty($kode) ? 'filter_kode='.$kode : '').(!empty($nama) ? '&filter_nama='.$nama : '').(!empty($tipe) ? '&filter_tipe='.$tipe : '')));
        }
    }
    
    public function pdf_rab(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDRab          = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDRab)){
                $Rab            = new \App\Models\vtrRab();
                $RabDet         = new \App\Models\trRabDet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $Tipe           = new \App\Models\mTipe();
                $Profile        = new \App\Models\PengaturanProfile();

                $sql_rab        = $Rab->asObject()->where('id', $IDRab)->first();
                // $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '1')->find();
                $sql_rab_det = $RabDet->asObject()->select('tbl_trans_rab_det.*, tbl_m_item.item as item_name, tbl_m_item.keterangan as deskripsi')->join('tbl_m_item', 'tbl_m_item.id = tbl_trans_rab_det.id_item', 'left')->where('tbl_trans_rab_det.id_rab', $IDRab)->where('tbl_trans_rab_det.status', '1')->find();
                $sql_rab_det2   = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '1')->find();
                $sql_rab_det_bi = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '0')->find();
                $sql_rab_sum    = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $IDRab)->where('status', '1')->first();             
                $sql_rab_sum_bi = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '0')->first();  
                $sql_rab_det_rw = $RabDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('id', $sql_rab->id_pelanggan)->first();
                $sql_profile    = $Profile->asObject()->where('id', $sql_rab->id_perusahaan)->first();
                $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();              
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
            
            $logo       = FCPATH.'file/app/' . $sql_profile->logo_kop;  // Use FCPATH for absolute path
            $logo_wm    = FCPATH.'file/app/' . $sql_profile->logo_wm;
            
            if (isset($status)) {
                if($status == '1'){
                    $pdf = new FPDF('L', 'cm', array(21.5, 33));
                }else{
                    $pdf = new FPDF('P', 'cm', array(21.5, 33));
                }
            }else{
                $pdf = new FPDF('P', 'cm', array(21.5, 33));
            }
                        
            $pdf->SetAutoPageBreak('auto', 5);
            $pdf->SetMargins(1, 1, 1);
            $pdf->header = 0;
            $pdf->addPage('', '', false);

            # Tambahkan font
            $pdf->AddFont('TrebuchetMS','','trebuc.php');
            $pdf->AddFont('TrebuchetMS-Bold','','trebucbd.php');
            $pdf->AddFont('Trebuchet-BoldItalic','','trebucbi.php');
            $pdf->AddFont('TrebuchetMS-Italic','','trebucit.php');
            
            # ------------------------ KOP -------------------------------------------
            # Logo Kiri Atas
            if(file_exists($logo)) {
                $extension = strtolower(pathinfo($logo, PATHINFO_EXTENSION));
                if(!empty($extension)) {
                    $pdf->Image($logo, 1, 1.83, 5, 2, $extension);
                }
            }
            
            # Logo Watermark
            if(file_exists($logo_wm)) {
                $extension = strtolower(pathinfo($logo_wm, PATHINFO_EXTENSION));
                if(!empty($extension)) {
                    $pdf->Image($logo_wm, 2, 6, 14, 5, $extension);
                }
            }

            $fill = FALSE;
            $pdf->SetFont('TrebuchetMS-Bold','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->nama), '', 0, 'C', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, '', $fill);
            $pdf->Cell(14, .5, $sql_profile->alamat, '', 0, 'C', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->kota), '', 0, 'C', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Telp', 'T', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', 'T', 0, 'C', $fill);
            $pdf->Cell(7.5, .5, $sql_profile->no_telp, 'T', 0, 'L', $fill);
            $pdf->Cell(2, .5, 'Tanggal', 'T', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', 'T', 0, 'C', $fill);
            $pdf->Cell(2, .5, tgl_indo2($sql_rab->tgl_simpan), 'T', 0, '', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Fax', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(7.5, .5, $sql_profile->no_fax, '', 0, '', $fill);
            $pdf->Cell(2, .5, 'Nomor', '', 0, '', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(2, .5, $sql_rab->no_rab, '', 0, '', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', 'B', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Sales', 'B', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', 'B', 0, 'C', $fill);
            $pdf->Cell(7.5, .5, $this->ionAuth->user($sql_rab->id_sales)->row()->first_name, 'B', 0, 'L', $fill);
            $pdf->Cell(2, .5, 'Kepada', 'B', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', 'B', 0, 'C', $fill);
            $pdf->Cell(2, .5, '', 'B', 0, '', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS', '', 10);
            $pdf->Cell(14.5, 1, $sql_rab->p_nama, 'B', 0, 'L', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(4.5, .5, 'TOTAL', '', 0, 'C', $fill);
            $pdf->Ln(.5);
            $pdf->Cell(14.5, .5, '', '', 0, 'C', $fill);
            $pdf->Cell(4.5, .5, format_angka($sql_rab->jml_gtotal), 'B', 0, 'C', $fill);
            # ------------------------ END KOP -------------------------------------------
                        
            # ------------------------ HEADER --------------------------------------------
            $pdf->Ln(0.75);
            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(19, .5, 'RAB INTERNAL', '', 0, 'C', $fill);
            $pdf->Ln(0.75);            
            # ------------------------ END HEADER ----------------------------------------
            
            # ------------------------ ISI -----------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(1, .5, 'NO', 'TB', 0, 'C', $fill);
            $pdf->Cell(3, .5, 'ITEM', 'TB', 0, 'L', $fill);
            $pdf->Cell(7, .5, 'DESKRIPSI', 'TB', 0, 'L', $fill);
            $pdf->Cell(1, .5, 'JML', 'TB', 0, 'C', $fill);
            $pdf->Cell(2, .5, 'SATUAN', 'TB', 0, 'L', $fill);
            $pdf->Cell(2.5, .5, 'HARGA', 'TB', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, 'SUBTOTAL', 'TB', 0, 'R', $fill);
            
            $pdf->SetTextColor(0,0,0);
            
            if (isset($status)) {
                if($status == '1'){
                    $pdf->Cell(2.5, .5, 'Profit', '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, 'HPP', '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, 'PPN dari HPP', '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, 'Total', '', 0, 'R', $fill);
                }
            }
            
            $pdf->Ln();
            
            $pdf->SetFont('TrebuchetMS', '', 9);
            $no     = 1;
            $subtot = 0;
            foreach ($sql_rab_det as $det){
                $subtot = $subtot + $det->subtotal;
                
                $pdf->Cell(1, .5, $no.'.', '', 0, 'C', $fill);
                $pdf->Cell(3, .5, $det->item, '', 0, 'L', $fill);
                $pdf->Cell(7, .5, $det->deskripsi, '', 0, 'L', $fill);
                $pdf->Cell(1, .5, (int)$det->jml, '', 0, 'C', $fill);
                $pdf->Cell(2, .5, $det->satuan, '', 0, 'L', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->harga), '', 0, 'R', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->subtotal), '', 0, 'R', $fill);
                
                if (isset($status)) {
                    if($status == '1'){
                        $pdf->Cell(2.5, .5, format_angka($det->profit), '', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, format_angka($det->harga_hpp), '', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, format_angka($det->harga_hpp_ppn), '', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, format_angka($det->harga_hpp_tot), '', 0, 'R', $fill);                        
                    }
                }
                
                $pdf->Ln();
                
                $no++;
            }
            
            $gtotal = $subtot;
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(16.5, .5, 'SUBTOTAL', 'T', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, format_angka($subtot), 'T', 0, 'R', $fill);
            $pdf->Ln();
            
            if($RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '1')->countAllResults() > 0){
                # Biaya
                $biaya = 0;
                foreach ($sql_rab_det2 as $bi){
                    $biaya = $biaya + $bi->subtotal;

                    $pdf->Cell(16.5, .5, strtoupper($bi->item), '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($bi->subtotal), '', 0, 'R', $fill);
                    $pdf->Ln();
                }

                $gtotal = $subtot + $biaya;
                $pdf->Cell(16.5, .5, 'TOTAL', 'B', 0, 'R', $fill);
                $pdf->Cell(2.5, .5, format_angka($gtotal), 'B', 0, 'R', $fill);
                $pdf->Ln(0.75);
            }
            
            if (isset($status)) {
                if ($status == '1') {
                    $dpp    = hitung_dpp($this->Setting->dpp, $gtotal);
                    $pph    = hitung_pph($this->Setting->dpp, $sql_rab->pph, $gtotal);
                    $ppn    = hitung_ppn($this->Setting->jml_ppn,$this->Setting->ppn_tot, $gtotal);
                    $netto  = $dpp - $pph;
                    $lk     = $netto - $sql_rab_sum->harga_hpp_tot;
                    $biaya  = $lk - $sql_rab_sum_bi->subtotal;
                    $lb     = $biaya + $sql_rab_sum->harga_hpp_ppn;
                    $biaya2 = ($sql_rab_sum_bi->subtotal / $gtotal) * 100;
                    
                    $pdf->SetFont('TrebuchetMS-Bold', '', 9);
                    $pdf->Cell(14, .5, '', '0', 0, 'R', $fill);
                    $pdf->Cell(5, .5, 'Hormat Kami', '', 0, 'C', $fill);
                    $pdf->Cell(2.5, .5, 'HPS', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($sql_rab->jml_pagu), '0', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->Cell(21.5, .5, 'Kontrak', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($gtotal), '0', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->SetFont('TrebuchetMS', '', 9);
                    $pdf->Cell(21.5, .5, 'PPN', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($ppn), '0', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->Cell(21.5, .5, 'DPP', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($dpp), '0', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->Cell(21.5, .5, 'PPh', '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($pph), 'B', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->Cell(14, .5, '', '', 0, 'R', $fill);
                    $pdf->SetFont('TrebuchetMS-Bold', '', 9);
                    $pdf->Cell(5, .5, $this->ionAuth->user($sql_rab->id_sales)->row()->first_name, '', 0, 'C', $fill);
                    $pdf->Cell(2.5, .5, 'Netto', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($netto), '0', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->SetFont('TrebuchetMS', '', 9);
                    $pdf->Cell(21.5, .5, 'HPP', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, '('.format_angka($sql_rab_sum->harga_hpp_tot).')', 'B', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->SetFont('TrebuchetMS-Bold', '', 9);
                    $pdf->Cell(21.5, .5, 'Laba', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($lk), '0', 0, 'R', $fill);
                    $pdf->Ln();
                    
                    foreach ($sql_rab_det_bi as $by){
                        $pdf->SetFont('TrebuchetMS', '', 9);
                        $pdf->Cell(21.5, .5, $by->item, '0', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, '('.format_angka($by->subtotal).')', '', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, '', '', 0, 'L', $fill);
                        $pdf->Ln();                        
                    }
                    
                    $pdf->SetFont('TrebuchetMS-Bold', '', 9);
                    $pdf->Cell(21.5, .5, 'Total Biaya', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($sql_rab_sum_bi->subtotal), 'TB', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, '('.format_angka($biaya2).'%)', '', 0, 'L', $fill);
                    $pdf->Ln();
                    $pdf->SetFont('TrebuchetMS', '', 9);
                    $pdf->Cell(21.5, .5, '', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($biaya), '', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->SetFont('TrebuchetMS', '', 9);
                    $pdf->Cell(21.5, .5, 'Restitusi', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($sql_rab_sum->harga_hpp_ppn), 'B', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->SetFont('TrebuchetMS-Bold', '', 9);
                    $pdf->Cell(21.5, .5, 'Total Laba', '0', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($lb), '0', 0, 'R', $fill);
                    $pdf->Ln();
                }
            }else{
                $pdf->Ln(0.75);
                $pdf->Cell(14, .5, 'Keterangan :', '', 0, 'L', $fill);
                $pdf->Cell(5, .5, 'Hormat Kami', '', 0, 'C', $fill);

                $pdf->SetFont('TrebuchetMS', '', 9);
                $pdf->Ln();
                $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
                $pdf->Cell(5, .5, '', '', 0, 'C', $fill);
                $pdf->Ln();
                $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
                $pdf->Cell(5, .5, '', '', 0, 'C', $fill);
                $pdf->Ln(1);

                $pdf->Cell(14, .5, '', '', 0, 'R', $fill);
                $pdf->SetFont('TrebuchetMS-Bold', '', 9);
                $pdf->Cell(5, .5, $this->ionAuth->user($sql_rab->id_sales)->row()->first_name, '', 0, 'C', $fill);                
            }
            

            $this->response->setContentType('application/pdf');
            $pdf->Output('rab-'.$sql_rab->tgl_masuk.(isset($status) ? '-internal' : '').'.pdf', 'I');                   
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function pdf_rab_pen(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDRab          = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDRab)){
                $Rab            = new \App\Models\vtrRab();
                $RabDet         = new \App\Models\trRabDet();
                $RabPen         = new \App\Models\trRabPen();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $Tipe           = new \App\Models\mTipe();
                $Profile        = new \App\Models\PengaturanProfile();

                $sql_rab        = $Rab->asObject()->where('id', $IDRab)->first();
                // $sql_rab_det    = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '1')->find();
                $sql_rab_det = $RabDet->asObject()->select('tbl_trans_rab_det.*, tbl_m_item.item as item_name, tbl_m_item.keterangan as deskripsi')->join('tbl_m_item', 'tbl_m_item.id = tbl_trans_rab_det.id_item', 'left')->where('tbl_trans_rab_det.id_rab', $IDRab)->where('tbl_trans_rab_det.status', '1')->find();
                $sql_rab_det2   = $RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '1')->find();
                $sql_rab_sum    = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $IDRab)->where('status', '1')->first();             
                $sql_rab_sum_bi = $RabDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '0')->first();  
                $sql_rab_det_rw = $RabDet->asObject()->where('id', $IDItmDet)->first();
                $sql_rab_pen    = $RabPen->asObject()->where('id_rab', $sql_rab->id)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('id', $sql_rab->id_pelanggan)->first();
                $sql_profile    = $Profile->asObject()->where('id', $sql_rab->id_perusahaan)->first();
                $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();              
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
            
            $logo       = FCPATH . 'file/app/' . $sql_profile->logo_kop;
            $logo_wm    = FCPATH.'file/app/' . $sql_profile->logo_wm;
            
            if (isset($status)) {
                if($status == '1'){
                    $pdf = new FPDF('L', 'cm', array(21.5, 33));
                }else{
                    $pdf = new FPDF('P', 'cm', array(21.5, 33));
                }
            }else{
                $pdf = new FPDF('P', 'cm', array(21.5, 33));
            }
                        
            $pdf->SetAutoPageBreak('auto', 5);
            $pdf->SetMargins(1, 1, 1);
            $pdf->header = 0;
            $pdf->addPage('', '', false);

            # Tambahkan font
            $pdf->AddFont('TrebuchetMS','','trebuc.php');
            $pdf->AddFont('TrebuchetMS-Bold','','trebucbd.php');
            $pdf->AddFont('Trebuchet-BoldItalic','','trebucbi.php');
            $pdf->AddFont('TrebuchetMS-Italic','','trebucit.php');
            
            # ------------------------ KOP -------------------------------------------
            # Logo Kiri Atas
            if(file_exists($logo)){
                $pdf->Image($logo,1,1,5,2);
            }
            
            # Logo Watermark
            if(file_exists($logo_wm)){
                $pdf->Image($logo_wm,2,6,14,5); 
            }

            $fill = FALSE;
            $pdf->SetFont('TrebuchetMS-Bold','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->nama), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, '', $fill);
            $pdf->Cell(14, .5, $sql_profile->alamat, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->kota), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Telp', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(5.5, .5, $sql_profile->no_telp, '', 0, 'L', $fill);
            $pdf->Cell(2, .5, 'E-mail', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(2.5, .5, $sql_profile->email, '', 1, 'L', $fill);
            # ------------------------ END KOP -------------------------------------------
                        
            # ------------------------ HEADER --------------------------------------------
            $pdf->Ln(0.75);
            $pdf->Cell(19, .5, '', 'T', 0, 'C', $fill);
            $pdf->Ln(0.75);
            $pdf->SetFont('Arial', '', '9');
            $pdf->Cell(2, .5, 'Nomor', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(16.5, .5, $sql_rab_pen->no_surat, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(2, .5, 'Lampiran', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(16.5, .5, '-', '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(2, .5, 'Perihal', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(16.5, .5, 'Penawaran Harga', '', 0, 'L', $fill);
            $pdf->Ln(1);            
            # ------------------------ END HEADER ----------------------------------------
            
            # ------------------------ PEMBUKAAN ----------------------------------------- 
            $pdf->Cell(2, .5, 'Kepada Yth :', '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(19, .5, $sql_rab->p_nama, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->MultiCell(7, .5, $sql_rab->p_alamat, '', 'L', $fill);
            $pdf->Ln();
            
            $pdf->MultiCell(19, .5, 'Berdasarkan permintaan penawaran yang Bapak/Ibu sampaikan kepada kami, bersama ini kami sampaikan surat penawaran dengan rincian sebagai berikut :', '', 'L', $fill);
            $pdf->Ln();
            # ------------------------ END PEMBUKAAN -------------------------------------
            
            # ------------------------ ISI -----------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(1, .5, 'NO', 'TB', 0, 'C', $fill);
            $pdf->Cell(3, .5, 'ITEM', 'TB', 0, 'L', $fill);
            $pdf->Cell(7, .5, 'DESKRIPSI', 'TB', 0, 'L', $fill);
            $pdf->Cell(1, .5, 'JML', 'TB', 0, 'C', $fill);
            $pdf->Cell(2, .5, 'SATUAN', 'TB', 0, 'L', $fill);
            $pdf->Cell(2.5, .5, 'HARGA', 'TB', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, 'SUBTOTAL', 'TB', 0, 'R', $fill);            
            $pdf->Ln();
            
            $pdf->SetFont('TrebuchetMS', '', 9);
            $no     = 1;
            $subtot = 0;
            foreach ($sql_rab_det as $det){
                $subtot = $subtot + $det->subtotal;
                
                $pdf->Cell(1, .5, $no.'.', '', 0, 'C', $fill);
                $pdf->Cell(3, .5, $det->item, '', 0, 'L', $fill);
                $pdf->Cell(7, .5, $det->deskripsi, '', 0, 'L', $fill);
                $pdf->Cell(1, .5, (int)$det->jml, '', 0, 'C', $fill);
                $pdf->Cell(2, .5, $det->satuan, '', 0, 'L', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->harga), '', 0, 'R', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->subtotal), '', 0, 'R', $fill);                
                $pdf->Ln();
                $pdf->SetFont('TrebuchetMS-Italic', '', 9);
                $pdf->Cell(1, .5, '', '', 0, 'C', $fill);
                $pdf->Cell(18, .5, $det->item_link, '', 0, 'L', $fill);
                $pdf->SetFont('TrebuchetMS', '', 9);
                $pdf->Ln();
                
                $no++;
            }
            
            $gtotal = $subtot;
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(16.5, .5, 'SUBTOTAL', 'T', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, format_angka($subtot), 'T', 0, 'R', $fill);
            $pdf->Ln();
            
            if($RabDet->asObject()->where('id_rab', $IDRab)->where('status', '2')->where('status_biaya', '1')->countAllResults() > 0){
                # Biaya
                $biaya = 0;
                foreach ($sql_rab_det2 as $bi){
                    $biaya = $biaya + $bi->subtotal;

                    $pdf->Cell(16.5, .5, strtoupper($bi->item), '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, format_angka($bi->subtotal), '', 0, 'R', $fill);
                    $pdf->Ln();
                }

                $gtotal = $subtot + $biaya;
                $pdf->Cell(16.5, .5, 'TOTAL', 'B', 0, 'R', $fill);
                $pdf->Cell(2.5, .5, format_angka($gtotal), 'B', 0, 'R', $fill);
                $pdf->Ln(0.75);
            }
            
            # --------------------- KETERANGAN ---------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(19, .5, 'Harga sudah termasuk PPN', '', 0, 'L', $fill);
            // $pdf->Cell(19, .5, 'Keterangan', '', 0, 'L', $fill);
            // $pdf->Ln();
            // $pdf->SetFont('TrebuchetMS', '', 9);
            // $pdf->Cell(19, .5, '- Penawaran berlaku 7 hari setelah penawaran ini dibuat.', '', 0, 'L', $fill);
            // $pdf->Ln();
            // $pdf->Cell(19, .5, '- Harga sudah termasuk PPN, PPh.', '', 0, 'L', $fill);
            // $pdf->Ln();
            // $pdf->Cell(19, .5, '- Fasilitas Free Ongkir hanya berlaku untuk daerah Jawa Tengah & DIY saja.', '', 0, 'L', $fill);
            // $pdf->Ln();
            // $pdf->Cell(19, .5, '- Harga dapat berubah sewaktu-waktu dan bersifat tidak mengikat.', '', 0, 'L', $fill);
            // $pdf->Ln();
            // $pdf->Cell(19, .5, '- Kondisi stok barang tidak mengikat apabila belum deal dengan user terkait pembelanjaan.', '', 0, 'L', $fill);
            // $pdf->Ln();
            // $pdf->Cell(19, .5, '- Fasilitas Instalasi dan Training.', '', 0, 'L', $fill);
            // $pdf->Ln();
            // $pdf->Cell(19, .5, '- Untuk material instalasi menyesuaikan stock opname dilapangan.', '', 0, 'L', $fill);
            $pdf->Ln(1);
            
            # ------------------ TTD -------------------------------------------
            $pdf->Cell(19, .5, 'Demikian penawaran ini kami sampaikan, atas perhatiannya kami sampaikan terimakasih.', '', 0, 'L', $fill);
            $pdf->Ln(1);
            
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, 'Hormat Kami', '', 0, 'C', $fill);
            $pdf->Ln(2.5);
            $pdf->Cell(14, .5, '', '', 0, 'R', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(5, .5, ucwords(strtolower($sql_profile->direktur)), '', 0, 'C', $fill);  
            
            $this->response->setContentType('application/pdf');
            $pdf->Output('rab-'.$sql_rab->tgl_masuk.(isset($status) ? '-internal' : '').'.pdf', 'I');                   
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function xls_rab_import(){
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
            $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getAlignment()->setVertical('center');
            $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(TRUE);
                        
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Customer')
                    ->setCellValue('C1', 'Tipe')
                    ->setCellValue('D1', 'Perusahaan')
                    ->setCellValue('E1', 'Pagu')
                    ->setCellValue('F1', 'HPS')
                    ->setCellValue('G1', 'Kategori')
                    ->setCellValue('H1', 'Merk')
                    ->setCellValue('I1', 'SKU')
                    ->setCellValue('J1', 'Item')
                    ->setCellValue('K1', 'Jml')
                    ->setCellValue('L1', 'Satuan')
                    ->setCellValue('M1', 'Harga');
            
            $objPHPExcel->getActiveSheet()->freezePane("A2");
            $objPHPExcel->getActiveSheet()->setAutoFilter('A1:M1');
            
            # Pengaturan panjang sel
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(16);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(65);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(16);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16);

            $objPHPExcel->getActiveSheet()->setTitle('Import RAB');

            $writer     = new Xlsx($objPHPExcel);
            $fileName   = 'rab_import_template';
            
//            return response()->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')                             
//                             ->setStatusCode(200);
            
            # Redirect hasil generate xlsx ke web client
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    

    
    public function data_penjualan(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $hlmn       = $this->input->getVar('page');

            $vtrPenj    = new \App\Models\vtrPenj();
            $sql_penj   = $vtrPenj->asObject()->orderBy('id', 'DESC');
            
            // Apply filters from GET parameters
            $no_nota = $this->input->getVar('no_nota');
            $pelanggan = $this->input->getVar('pelanggan');
            $status_bayar = $this->input->getVar('status_bayar');
            
            if (!empty($no_nota)) {
                $sql_penj->like('no_nota', $no_nota);
            }
            
            if (!empty($pelanggan)) {
                $sql_penj->like('p_nama', $pelanggan);
            }
            
            if ($status_bayar !== '' && $status_bayar !== null) {
                $sql_penj->where('status_bayar', $status_bayar);
            }
            
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLPenj'       => $sql_penj->paginate($jml_limit),
                'Pagination'    => $vtrPenj->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_penjualan',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_penjualan',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_penjualan_aksi(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDPenj         = $this->input->getVar('id');
            $IDPO           = $this->input->getVar('id_po');
            $IDDO           = $this->input->getVar('id_do');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDPenj)){
                $Rab            = new \App\Models\vtrRab();
                $Penj           = new \App\Models\vtrPenj();
                $PenjDet        = new \App\Models\trPenjDet();
                $PenjFile       = new \App\Models\trPenjFile();
                $vtrMutasi      = new \App\Models\vtrMutasi();
                $trMutasiDet    = new \App\Models\trMutasiDet();
                $PO             = new \App\Models\vtrPO();
                $PODet          = new \App\Models\trPODet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $Tipe           = new \App\Models\mTipe();
                $TipeFile       = new \App\Models\mTipeFile();
                $Profile        = new \App\Models\PengaturanProfile();
                $ItemStokDet        = new \App\Models\mItemStokDet();
                
                $sql_penj           = $Penj->asObject()->where('id', $IDPenj)->first();
                $sql_rab            = $Rab->asObject()->where('id', $sql_penj->id_rab)->first();
                $sql_penj_det_rw    = $PenjDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item           = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat            = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn           = $Plgn->asObject()->where('id', $sql_penj->id_pelanggan)->first();
                $sql_profile        = $Profile->asObject()->where('status', '1')->find();
                $sql_tipe           = $Tipe->asObject()->where('status', '1')->find();
                $sql_tipe_file      = $TipeFile->asObject()->where('status', '1')->find();
                $sql_penj_sum       = $PenjDet->asObject()->selectSum('subtotal')->where('id_penjualan', $IDPenj)->first();             
                $sql_penj_file      = $PenjFile->asObject()->where('id_penjualan', $IDPenj)->find();             
                $sql_mut            = $vtrMutasi->asObject()->where('id_penjualan', $IDPenj)->where('status', '1')->find();
                $sql_mut_rw         = $vtrMutasi->asObject()->where('id', $IDDO)->first();
                $sql_mut_det        = $trMutasiDet->asObject()->where('id_mutasi', $IDDO)->find();
                $sql_mut_det_rw     = $trMutasiDet->asObject()->where('id', $IDItmDet)->first();
                $sql_po             = $PO->asObject()->where('id_rab', $sql_penj->id_rab)->orWhere('id_penjualan', $sql_penj->id)->find();
                $sql_po_rw          = $PO->asObject()->where('id', $IDPO)->first();
                $sql_po_rw_det      = $PODet->asObject()->where('id_pembelian', $IDPO)->find();    
                $sql_item_stok_det  = $ItemStokDet->asObject()->where('id_item', $IDItm)->where('status', 1)->find();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
                $sql_mut        = '';
                $sql_item_stok_det = '';
            }
                            
            # Tentukan view berdasarkan status
            switch ($status) {
                default:
                    $sql_penj_det   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->find();
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_penjualan_aksi';
                    break;

                case '1':
                    $sql_penj_det   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', $status)->find();
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_penjualan_item';
                    break;

                case '2':
                    $sql_penj_det   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', $status)->find();
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_penjualan_biaya';
                    break;

                case '3':
                    $sql_penj_det   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', '1')->find();
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_penjualan_po';
                    break;

                case '4':
                    $sql_penj_det   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', '1')->find();
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_penjualan_do';
                    break;

                case '5':
                    $sql_penj_det   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', $status)->find();
                    
                    $view = $this->ThemePath . '/manajemen/transaksi/data_penjualan_file';
                    break;
            }

            $data  = [
                'SQLRab'        => $sql_rab,
                'SQLPenj'       => $sql_penj,
                'SQLPenjDet'    => $sql_penj_det,
                'SQLPenjDetRw'  => $sql_penj_det_rw,
                'SQLPenjDetSum' => $sql_penj_sum,
                'SQLPenjFile'   => $sql_penj_file,
                'SQLPO'         => $sql_po,
                'SQLPORw'       => $sql_po_rw,
                'SQLPORwDet'    => $sql_po_rw_det,
                'SQLMutasi'     => $sql_mut,
                'SQLMutasiRw'   => $sql_mut_rw,
                'SQLMutasiDet'  => $sql_mut_det,
                'SQLMutasiDetRw'=> $sql_mut_det_rw,
                'SQLItem'       => $sql_item,
                'SQLItemStokDet'=> $sql_item_stok_det,
                'SQLSatuan'     => $sql_sat,
                'SQLPlgn'       => $sql_plgn,
                'SQLUser'       => $ID,
                'SQLProfile'    => $sql_profile,
                'SQLTipe'       => $sql_tipe,
                'SQLTipeFile'   => $sql_tipe_file,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_penjualan',
                'konten'        => $view,
                'konten_aksi'   => $this->ThemePath.'/manajemen/transaksi/data_penjualan_aksi_atas',
                'konten_kanan'  => $this->ThemePath.'/manajemen/transaksi/data_penjualan_aksi_kanan',
                'konten_list'   => $this->ThemePath.'/manajemen/transaksi/data_penjualan_list',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_penjualan_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $Plgn           = new \App\Models\mPelanggan();
            $Tipe           = new \App\Models\mTipe();
            $Profile        = new \App\Models\PengaturanProfile();
            
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
            
            if(!empty($IDPsn)){
                $Pes            = new \App\Models\trPesanan();
                $PesDet         = new \App\Models\trPesananDet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan();
                
                $sql_psn        = $Pes->asObject()->where('id', $IDPsn)->first();
                $sql_psn_det    = $PesDet->asObject()->where('id_pesanan', $IDPsn)->find();
                $sql_psn_det_rw = $PesDet->asObject()->where('id', $IDItm)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn       = $Plgn->asObject()->where('id', $sql_psn->id_pelanggan)->first();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
                        
            $data  = [
                'SQLPsn'        => $sql_psn,
                'SQLPsnDet'     => $sql_psn_det,
                'SQLPsnDetRw'   => $sql_psn_det_rw,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLPlgn'       => $sql_plgn,
                'SQLUser'       => $ID,
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'SQLTipe'       => $sql_tipe,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_penjualan',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_penjualan_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function set_penjualan_update() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $no_kontrak = $this->input->getVar('no_kontrak');
            $no_nota   = $this->input->getVar('no_nota');

            $Penj       = new \App\Models\trPenj();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id'     => $validasi->getError('id'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/rab/data_rab_tambah.php'));
            }else{
                
                $data = [
                    'id'            => $id,
                    'no_nota'       => $no_nota,
                    'no_kontrak'    => $no_kontrak,
                ];

                if (!empty($tgl_msk)) {
                    $data['tgl_masuk'] = tgl_indo_sys2($tgl_msk);
                }

                $Penj->save($data);
                $last_id = $Penj->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php?id='.$id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_penjualan_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idp        = $this->input->getVar('id_pelanggan');
            $plgn       = $this->input->getVar('pelanggan');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $sales      = $this->input->getVar('sales');
            $tipe       = $this->input->getVar('tipe');
            $pers       = $this->input->getVar('perusahaan');
            $pagu       = $this->input->getVar('pagu');
            $hps        = $this->input->getVar('hps');
            $no_kontrak = $this->input->getVar('no_kontrak');
            $no_paket   = $this->input->getVar('no_paket');
            $status     = $this->input->getVar('status');
            $status_ppn = $this->input->getVar('status_ppn');

            $Profile    = new \App\Models\PengaturanProfile;
            $Plgn       = new \App\Models\mPelanggan();
            $Penj       = new \App\Models\trPenj();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_pelanggan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Pelanggan tidak boleh kosong',
                    ]
                ],
                'tgl_masuk'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tanggal tidak boleh kosong',
                    ]
                ],
                'tipe'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tipe tidak boleh kosong',
                    ]
                ],
                'perusahaan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Perusahaan tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'pelanggan'     => $validasi->getError('id_pelanggan'),
                    'tgl_masuk'     => $validasi->getError('tgl_masuk'),
                    'tipe'          => $validasi->getError('tipe'),
                    'perusahaan'    => $validasi->getError('perusahaan')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/data_penjualan_tambah.php'));
            }else{
                $sql_cek    = $Penj->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                    
                # Format nomor invoice
                $sql_profile        = $Profile->asObject()->where('id', $pers)->first();
                $sql_penj_ck        = $Penj->asObject()->where('id_perusahaan', $pers)->where('YEAR(tgl_bayar)', date('Y'))->where('MONTH(tgl_bayar)', date('m'));
                $no_urut            = $sql_penj_ck->countAll() + 1;
                $no_nota            = $sql_profile->kode_inv_dpn.'/'.sprintf('%03d', $no_urut).'-'.$sql_profile->kode_srt_blk.'/'.format_romawi(date('m')).'/'.date('Y');
                
                $data = [
                    'id_user'       => $ID->id,
                    'id_pelanggan'  => $idp,
                    'id_sales'      => $sales,
                    'id_perusahaan' => $pers,
                    'id_tipe'       => $tipe,
                    'tgl_masuk'     => tgl_indo_sys($tgl_msk),
                    'no_nota'       => $no_nota,
                    'no_kontrak'    => $no_kontrak,
                    'no_paket'      => $no_paket,
                    'jml_hps'       => format_angka_db($hps),
                    'jml_pagu'      => format_angka_db($pagu),
                    'status'        => '0'
                ];

                $Penj->save($data);
                $last_id = $Penj->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('transaksi/data_penjualan.php'));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    } 
    
    public function set_penjualan_simpan_po() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $ids        = $this->input->getVar('id_supplier');
            $id_po      = $this->input->getVar('id_po');
            $id_rab     = $this->input->getVar('id_rab');
            $id_penj    = $this->input->getVar('id_penj');
            $idp        = $this->input->getVar('perusahaan');
            $supp       = $this->input->getVar('supplier');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $ket        = $this->input->getVar('keterangan');
            $rute       = $this->input->getVar('route');
            $status     = $this->input->getVar('status');

            $Profile    = new \App\Models\PengaturanProfile();
            $Supp       = new \App\Models\mSupplier();
            $PO         = new \App\Models\trPO();
            $PODet      = new \App\Models\trPODet();
            $Rab        = new \App\Models\vtrRab();
            $RabDet     = new \App\Models\trRabDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_supplier'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Supplier tidak boleh kosong',
                    ]
                ],
                'tgl_masuk'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tanggal tidak boleh kosong',
                    ]
                ],
                'perusahaan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Perusahaan tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'supplier'      => $validasi->getError('id_supplier'),
                    'perusahaan'    => $validasi->getError('perusahaan'),
                    'tgl_masuk'     => $validasi->getError('tgl_masuk'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php?id='.$id_penj.'&status='.$status.(!empty($id_po) ? '&id_po='.$id_po : '')));
            }else{
                $sql_cek        = $PO->asObject();
                $sql_supp       = $Supp->asObject()->where('id', $ids)->first();
                $sql_rab        = $Rab->asObject()->where('id', $id_rab)->first();
                $sql_rab_det    = $RabDet->asObject()->where('id_rab', $id_rab)->where('status', '1')->find();

                # Format nomor po
                $sql_profile       = $Profile->asObject()->where('id', $idp)->first();
                $sql_po_ck         = $sql_cek->asObject()->where('id_perusahaan', $idp)->where('YEAR(tgl_masuk)', date('Y'))->where('MONTH(tgl_masuk)', date('m'));
                $no_urut           = $sql_po_ck->countAll() + 1;
                $no_nota           = $sql_profile->kode_po_dpn.'/'.sprintf('%03d', $no_urut).'-'.$sql_profile->kode_srt_blk.'/'.format_romawi(date('m')).'/'.date('Y');
                # ------------- END ---------------------
                
                
                $data = [
                    'id'            => $id_po,
                    'id_user'       => $ID->id,
                    'id_perusahaan' => $idp,
                    'id_supplier'   => $ids,
                    'id_rab'        => $id_rab,
                    'id_penjualan'  => $id_penj,
                    'tgl_masuk'     => tgl_indo_sys2($tgl_msk),
                    'no_po'         => $no_nota,
                    'supplier'      => $sql_supp->nama,
                    'keterangan'    => $ket,
                    'status_nota'   => '0',
                ];                

                $PO->save($data);
                $last_id = (!empty($id_po) ? $id_po : $PO->insertID());

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("PO berhasil disimpan !!");');
                }
                
                if(!empty($rute)){
                    return redirect()->to(base_url($rute.(!empty($id_po) ? '&id_po='.$id_po : '')));
                }else{
                    return redirect()->to(base_url('transaksi/data_penjualan_aksi.php?id='.$id_penj.'&status='.$status.(!empty($id_po) ? '&id_po='.$id_po : '')));
                }
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_penjualan_upload() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idpenj     = $this->input->getVar('id_penjualan');
            $judul      = $this->input->getVar('judul');
            $no_dokumen      = $this->input->getVar('no_dokumen');
            $ket        = $this->input->getVar('keterangan');
            $tipe       = $this->input->getVar('tipe');
            $fupl       = $this->request->getFile('fupload');
            $status     = $this->input->getVar('status');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Rab        = new \App\Models\trRab();
            $RabDet     = new \App\Models\trRabDet();
            $Penj       = new \App\Models\trPenj();
            $PenjFile   = new \App\Models\trPenjFile();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_penjualan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'judul'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Judul tidak boleh kosong',
                    ]
                ],
                'tipe'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tipe tidak boleh kosong',
                    ]
                ],
                'fupload' => [
                    'rules'     => 'uploaded[fupload]|mime_in[fupload,application/pdf,image/png,image/jpg,image/jpeg]|ext_in[fupload,pdf,jpg,png,jpeg]|max_size[fupload,8192]',
                    'errors'    => [
                        'mime_in'   => 'Berkas harus berupa gambar / pdf',
                        'ext_in'    => 'Berkas harus berupa *.jpg, *.jpeg, *.png, *.pdf',
                        'max_size'  => 'Berkas harus berukuran maksimal 8MB',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_penjualan'  => $validasi->getError('id_rab'),
                    'judul'         => $validasi->getError('judul'),
                    'tipe'          => $validasi->getError('tipe'),
                    'fupload'       => $validasi->getError('fupload'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php'.(!empty($idpenj) ? '?id='.$idpenj : '').(!empty($status) ? '&status='.$status : '')));
            }else{
                $sql_penj   = $Penj->asObject()->where('id', $idpenj)->first();
//                $sql_rab    = $Rab->asObject()->where('id', $sql_penj->id_rab)->first();
                
                # Muat library untuk unggah file
                # $path untuk mengatur lokasi unggah file
                $path       = FCPATH . 'file/sale/'.strtolower($sql_penj->id);
                $unique = uniqid();
                $filename = 'so_' . strtolower(alnum($judul)) . '_' . $unique . '.' . $fupl->getClientExtension();

                if(!file_exists($path)){
                    mkdir($path, 0777);
                }
                
                # Jika valid lanjut upload file
                if ($fupl->isValid() && !$fupl->hasMoved()) {
                    $fupl->move($path, $filename, true);
                }

                $data = [
                    'id_penjualan'  => $idpenj,
                    'id_user'       => $ID->id,
                    'id_berkas'     => $tipe,
                    'judul'         => $judul,
                    'no_dokumen'         => $no_dokumen,
                    'keterangan'    => $ket,
                    'file_name'     => 'file/sale/'.strtolower($sql_penj->id).'/'.$filename,
                    'file_ext'      => $fupl->getClientExtension(),
                    'file_type'     => $fupl->getClientMimeType(),
                ];

                $PenjFile->save($data);
                $last_id = $PenjFile->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Berkas berhasil diunggah !!");');
                }else{
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil diupdate !!");');
                }

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php'.(!empty($idpenj) ? '?id='.$idpenj : '').(!empty($status) ? '&status='.$status : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_penjualan_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idpenj     = $this->input->getVar('id_penj');
            $idpenjdet  = $this->input->getVar('id_penj_det');
            $iditem     = $this->input->getVar('id_item');
            $item       = $this->input->getVar('item');
            $item_link  = $this->input->getVar('item_link');
            $item_sn    = $this->input->getVar('item_sn');
            $jml        = $this->input->getVar('jml');
            $harga      = $this->input->getVar('harga');
            $hpp        = $this->input->getVar('hpp');
            $satuan     = $this->input->getVar('satuan');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');
            $status_ppn = $this->input->getVar('status_ppn');
            $status_bi  = $this->input->getVar('status_biaya');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Penj       = new \App\Models\trPenj();
            $PenjDet    = new \App\Models\trPenjDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_penj'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'item'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Item tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ]
                ],
                'harga'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Harga tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_penj'   => $validasi->getError('id_penj'),
                    'item'      => $validasi->getError('item'),
                    'jml'       => $validasi->getError('jml'),
                    'harga'     => $validasi->getError('harga'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php'.(!empty($idpenj) ? '?id='.$idpenj : '').(!empty($iditem) ? '&id_item='.$iditem : '').(!empty($status) ? '&status='.$status : '')));
            }else{
                $sql_penj           = $Penj->asObject()->where('id', $idpenj)->first();
                $sql_item           = $Item->asObject()->where('id', $iditem)->first();
                $sql_sat            = $Satuan->asObject()->where('id', $satuan)->first();
                $sql_penj_sum       = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot, SUM(harga_pph) AS harga_pph')->where('id_penjualan', $sql_penj->id)->where('status', '1')->first();             
                $sql_penj_sum_bi    = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $sql_penj->id)->where('status', '2')->where('status_biaya', '0')->first();
                $sql_penj_sum_bi2   = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $sql_penj->id)->where('status', '2')->where('status_biaya', '1')->first();
                
                
                # Variable harga, hitung subtotalnya
                $hrg                = format_angka_db($harga);
                $subtotal           = $hrg * $jml;
                
                # Pastikan status item atau status = 1
                if($status == '1'){
                    $hrg_dpp         = hitung_dpp($this->Setting->dpp, $subtotal, '1');
                    $hrg_ppn         = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $subtotal);
                    $hrg_pph         = hitung_pph($this->Setting->dpp, $this->Setting->pph, $subtotal);

                    $hrg_hpp         = format_angka_db($hpp);
                    $hrg_hpp_subtot  = $hrg_hpp * $jml;
                    $hrg_hpp_dpp     = hitung_dpp($this->Setting->dpp, $hrg_hpp_subtot, $status_ppn);
                    $hrg_hpp_ppn     = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $hrg_hpp_subtot);
                    $hrg_hpp_tot     = (!empty($hrg_hpp) ? $hrg_hpp_subtot : 0);
                    $hrg_profit      = $subtotal - $hrg_ppn - $hrg_pph - $hrg_hpp_subtot;
                }else{
                    $hrg_dpp         = 0;
                    $hrg_ppn         = 0;
                    $hrg_pph         = 0;

                    $hrg_hpp         = 0;
                    $hrg_hpp_subtot  = 0;
                    $hrg_hpp_dpp     = 0;
                    $hrg_hpp_ppn     = 0;
                    $hrg_hpp_tot     = 0;
                    $hrg_profit_ppn  = 0;
                    $hrg_profit      = 0;
                }
                        
                $data = [
                    'id'            => $idpenjdet,
                    'id_penjualan'  => $idpenj,
                    'id_item'       => (!empty($sql_item->id) ? $sql_item->id : 0),
                    'id_item_kat'   => (!empty($sql_item->id_kategori) ? $sql_item->id_kategori : 0),
                    'id_item_sat'   => (!empty($satuan) ? $satuan : 0),
                    'tgl_masuk'     => $sql_penj->tgl_masuk,
                    'kode'          => (!empty($sql_item->kode) ? $sql_item->kode : ''),
                    'item'          => $item,
                    'item_link'     => $item_link,
                    'item_sn'        => $item_sn,
                    'jml'           => (float)$jml,
                    'jml_satuan'    => (!empty($sql_sat->jml) ? (int)$sql_sat->jml : 0),
                    'satuan'        => (!empty($sql_sat->satuanBesar) ? strtoupper($sql_sat->satuanBesar) : ''),
                    'harga'         => (float)$hrg,
                    'harga_dpp'     => (float)$hrg_dpp,
                    'harga_ppn'     => (float)$hrg_ppn,
                    'harga_pph'     => (float)$hrg_pph,
                    'subtotal'      => $subtotal,
                    'profit'        => (float)$hrg_profit ,
                    'harga_hpp'     => (float)$hrg_hpp,
                    'harga_hpp_ppn' => ($status_ppn == '1' ? (float)$hrg_hpp_ppn : 0),
                    'harga_hpp_tot' => (float)$hrg_hpp_tot,
                    'keterangan'    => $ket,
                    'status'        => (int)$status,
                    'status_ppn'    => (!empty($status_ppn) ? $status_ppn : 0),
                    'status_biaya'  => $status_bi,
                ];

                $PenjDet->save($data);
                $last_id = $PenjDet->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil disimpan !!");');
                }else{
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil diupdate !!");');
                }

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php'.(!empty($idpenj) ? '?id='.$idpenj : '').(!empty($status) ? '&status='.$status : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_penjualan_simpan_po() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id_rab     = $this->input->getVar('id_rab');
            $id_rab_det = $this->input->getVar('id_rab_det');
            $id_po      = $this->input->getVar('id_po');
            $id_itm     = $this->input->getVar('id_item');
            $id_satuan  = $this->input->getVar('id_satuan');
            $item       = $this->input->getVar('item');
            $item_link  = $this->input->getVar('item_link');
            $jml        = $this->input->getVar('jml');
            $harga      = $this->input->getVar('harga');
            $satuan     = $this->input->getVar('satuan');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');
            $status_ppn = $this->input->getVar('status_ppn');
            $status_bi  = $this->input->getVar('status_biaya');
            $act        = $this->input->getVar('act');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Rab        = new \App\Models\trRab();
            $RabDet     = new \App\Models\trRabDet();
            $PO         = new \App\Models\trPO();
            $PODet      = new \App\Models\trPODet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_rab'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'item'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Item tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ]
                ],
                'harga'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Harga tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_rab'        => $validasi->getError('id_rab'),
                    'item'          => $validasi->getError('item'),
                    'jml'           => $validasi->getError('jml'),
                    'harga'         => $validasi->getError('harga'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/rab/data_rab_aksi.php?act='.$act.(!empty($id_rab) ? '&id='.$id_rab : '').(!empty($status) ? '&status='.$status : '').(!empty($id_po) ? '&id_po='.$id_po : '').(!empty($id_itm) ? '&id_item='.$id_itm : '').(!empty($id_rab_det) ? '&id_item_det='.$id_rab_det : '')));
            }else{
                $sql_rab         = $Rab->asObject()->where('id', $id_rab)->first();
                $sql_rab_det     = $RabDet->asObject()->where('id', $id_rab_det)->first();
                $sql_item        = $Item->asObject()->where('id', $id_itm)->first();
                $sql_sat         = $Satuan->asObject()->where('id', $id_satuan)->first();
                
                $hrg        = format_angka_db($harga);
                $subtotal   = $hrg * $jml;
                
                # Hitung dari jml rab dikurangi jml yang di PO
                $sisa_po = $sql_rab_det->jml_po + $jml;
                
                if($sisa_po > $sql_rab_det->jml){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.error("Jml PO tidak boleh lebih besar maupun lebih !!");');
                }elseif($jml < 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.error("Jml PO tidak boleh lebih besar maupun lebih !!");');
                }else{
                    # Start Transact SQL
                    $this->db->transBegin();

                    $data_po = [
                        'id_pembelian'      => $id_po,
                        'id_satuan'         => $id_satuan,
                        'id_user'           => $ID->id,
                        'id_item'           => $id_itm,
                        'id_rab_det'        => $id_rab_det,
                        'kode'              => $sql_item->kode,
                        'item'              => $sql_item->item,
                        'jml'               => (int)$jml,
                        'jml_satuan'        => (int)$sql_sat->jml,
                        'harga'             => (float)$hrg,
                        'subtotal'          => (float)$subtotal,
                        'satuan'            => $sql_sat->satuanBesar,
                        'status'            => '0',
                        'status_ppn'        => (!empty($status_ppn) ? $status_ppn : 0),
                    ];

                    $PODet->save($data_po);
                    $last_id = $PODet->insertID;

                    # Simpan jumlah PO ke tabel rab det
                    $data_rab = ['id'=>$sql_rab_det->id,'jml_po'=>$sisa_po];
                    $RabDet->save($data_rab);

                    # End off transact SQL
                    $this->db->transComplete();

                    # Cek status transact SQL, jika gagal maka rollback
                    if ($this->db->transStatus() === false) {
                        $this->db->transRollback();
                    }else{
                        # Set commit jika berhasil
                        $this->db->transCommit();
                    }

                    if($last_id > 0){
                        $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil disimpan !!");');
                    }else{
                        $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil diupdate !!");');
                    }
                }

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php?act='.$act.(!empty($id_rab) ? '&id='.$id_rab : '').(!empty($status) ? '&status='.$status : '').(!empty($id_po) ? '&id_po='.$id_po : '').(!empty($id_itm) ? '&id_item='.$id_itm : '').(!empty($id_rab_det) ? '&id_item_det='.$id_rab_det : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_penjualan_simpan_do() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi       = \Config\Services::validation();
            
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();

            $id             = $this->input->getVar('id');
            $id_mts         = $this->input->getVar('id_mutasi');
            $id_mts_det     = $this->input->getVar('id_mutasi_det');
            $id_item        = $this->input->getVar('id_item');
            $id_penj_det    = $this->input->getVar('id_penjualan_det');
            $item           = $this->input->getVar('item');
            $jml            = $this->input->getVar('jml');
            $satuan         = $this->input->getVar('satuan');
            $sn             = $this->input->getVar('sn');
            $ket            = $this->input->getVar('keterangan');
            $status         = $this->input->getVar('status');
            $kode_sn_list = $this->request->getVar('kode_sn');

            $Plgn           = new \App\Models\mPelanggan();
            $Item           = new \App\Models\mItem();
            $Satuan         = new \App\Models\mSatuan();
            $Mts            = new \App\Models\trMutasi();
            $MtsDet         = new \App\Models\trMutasiDet();
            $PenjDet        = new \App\Models\trPenjDet();
            $ItemStokDet   = new \App\Models\mItemStokDet();
            $TrJualKirimSn = new \App\Models\trJualKirimSn();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_mutasi'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'item'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Item tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ]
                ],
                'satuan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Satuan tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_mutasi' => $validasi->getError('id_rab'),
                    'item'      => $validasi->getError('item'),
                    'jml'       => $validasi->getError('jml'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php?act=do_input&id='.$id.(!empty($status) ? '&status='.$status : '').(!empty($id_mts) ? '&id_do='.$id_mts : '').(!empty($id_item) ? '&id_item='.$id_item : '').(!empty($id_mts_det) ? '&id_item_det='.$id_mts_det : '')));
            }else{
                $sql_mts        = $Mts->asObject()->where('id', $id_mts)->first();
                $sql_item       = $Item->asObject()->where('id', $id_item)->first();
                $sql_sat        = $Satuan->asObject()->where('id', $satuan)->first();
                $sql_penj_det   = $PenjDet->asObject()->where('id', $id_penj_det)->first();
                
                if(!empty($sql_penj_det)){
                    if($jml <= $sql_penj_det->jml){
                        # Start Transact SQL
                        $this->db->transBegin();

                        $data = [
                            'id'                => $id_mts_det,
                            'id_mutasi'         => $id_mts,
                            'id_user'           => $ID->id,
                            'id_item'           => (!empty($sql_item->id) ? $sql_item->id : 0),
                            'id_item_kat'       => (!empty($sql_item->id_kategori) ? $sql_item->id_kategori : 0),
                            'id_penjualan_det'  => $id_penj_det,
                            'id_satuan'         => (!empty($satuan) ? $satuan : 0),
                            'tgl_masuk'         => $sql_mts->tgl_masuk,
                            'kode'              => (!empty($sql_item->kode) ? $sql_item->kode : ''),
                            'item'              => $item,
                            'jml'               => (float)$jml,
                            'jml_satuan'        => (!empty($sql_sat->jml) ? (int)$sql_sat->jml : 1),
                            'satuan'            => (!empty($sql_sat->satuanBesar) ? $sql_sat->satuanBesar : ''),
                            'keterangan'        => $ket
                        ];

                        $MtsDet->save($data);
                        $last_id = $id_mts_det;
                        
                        // LOOPING DATA KODE SN DAN INSERT DATA DIBAWAH INI
                        if (!empty($kode_sn_list) && is_array($kode_sn_list)) {
                            foreach ($kode_sn_list as $id_sn) {
                                // UPDATE status di item_stok_det

                                // UPDATE status SN di item_stok_det
                                $ItemStokDet->update($id_sn, [
                                    'status' => 0
                                ]);


                                $getSN = $ItemStokDet->asObject()->where('id', $id_sn)->first();

                                // INSERT ke mutasi stok
                                $TrJualKirimSn->save([
                                    'id_user'           => $ID->id,
                                    'id_penjualan'      =>  $id,
                                    'id_penjualan_det'  => $id_penj_det,
                                    'id_item'           => (!empty($sql_item->id) ? $sql_item->id : 0),
                                    'id_item_stok_det'  => $id_sn, // asumsinya ada kolom ini untuk relasi SN
                                    'kode_sn'           => $getSN->kode,
                                    'keterangan'        => 'STOK KELUAR PENGIRIMAN',
                                    'status'            => '1'
                                ]);
                            }
                        }
                        # End off transact SQL
                        $this->db->transComplete();

                        # Cek status transact SQL, jika gagal maka rollback
                        if ($this->db->transStatus() === false) {
                            $this->db->transRollback();
                        
                            // ✅ Tambahkan pesan error jika gagal
                            $this->session->setFlashdata('gudang_toast', 'toastr.error("Gagal menyimpan item. Silakan coba lagi.");');
                            // dd($this->db->error()['message']);
                        } else {
                            $this->db->transCommit();
                        
                            if(empty($id_mts_det)){
                                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil disimpan !!");');
                            }else{
                                $this->session->setFlashdata('transaksi_toast', 'toastr.success("'.$jml.' Item berhasil dikirim !!");');
                            }
                        }

                        
                    }else{
                        $this->session->setFlashdata('transaksi_toast', 'toastr.error("Jumlah yang dikirim tidak sesuai !!");');
                    } 
                }else{}

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php?act=do_input&id='.$id.(!empty($status) ? '&status='.$status : '').(!empty($id_mts) ? '&id_do='.$id_mts : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_penjualan_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPenj     = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $status     = $this->input->getVar('status');
            
            if($this->input->is('get') == 1){
                $PenjDet = new \App\Models\trPenjDet();
                $PenjDet->where('id', $IDItm)->delete();
                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Item berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('transaksi/data_penjualan_aksi.php'.(!empty($IDPenj) ? '?id='.$IDPenj : '').(!empty($status) ? '&status='.$status : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_penjualan_hapus_file(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPenj     = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $status     = $this->input->getVar('status');
            
            if($this->input->is('get') == 1){
                $PenjFile = new \App\Models\trPenjFile();
                $sql_file = $PenjFile->asObject()->where('id', $IDItm)->first();

                # Definisikan path lengkap filenya
                $filename = FCPATH.'/'.$sql_file->file_name;
                
                # Pastikan filenya ada dan hapuslah
                if(file_exists($filename)){
                    unlink($filename);
                }
                
                # Hapus databasenya
                $PenjFile->where('id', $IDItm)->delete();
                
                $this->session->setFlashdata('transaksi_toast', 'toastr.success("Berkas berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('transaksi/data_penjualan_aksi.php'.(!empty($IDPenj) ? '?id='.$IDPenj : '').(!empty($status) ? '&status='.$status : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    } 
        
    public function set_penjualan_proses() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $user       = $this->input->getVar('user');
            $status     = $this->input->getVar('status');
            $jml_gtotal = $this->input->getVar('jml_gtotal');
            $psn        = $this->input->getVar('pesan');
            $rute       = $this->input->getVar('route');

            $Plgn       = new \App\Models\mPelanggan();
            $Rab        = new \App\Models\trRab();
            $RabDet     = new \App\Models\trRabDet();
            $PO         = new \App\Models\vtrPO();
            $Penj       = new \App\Models\trPenj();
            $PenjDet    = new \App\Models\trPenjDet();
            $PenjPO     = new \App\Models\trPenjPO();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'status'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Status tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id'            => $validasi->getError('id'),
                    'status'        => $validasi->getError('status'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/rab/data_rab_tambah.php'));
            }else{
                $sql_penj           = $Penj->asObject()->where('id', $id)->first();
                $sql_penj_det       = $PenjDet->asObject()->where('id_penjualan', $sql_penj->id)->find();
                $sql_penj_sum       = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $sql_penj->id)->where('status', '1')->first();             
                $sql_penj_sum_bi    = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $sql_penj->id)->where('status', '2')->where('status_biaya', '0')->first();
                $sql_penj_sum_bi2   = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $sql_penj->id)->where('status', '2')->where('status_biaya', '1')->first();
                $sql_rab            = $Rab->asObject()->where('id', $sql_penj->id_rab)->first();
                $gtotal             = $sql_penj_sum->subtotal + $sql_penj_sum_bi2->subtotal;
                    
//                # Jika status ppn == 1, maka project ber ppn
//                if($sql_penj->status_ppn == '1'){
//                    # Perhitungan PPn, DPP dll
//                  $hpp        = $sql_penj_sum->harga_hpp_tot;
//                  $hpp_ppn    = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $sql_penj_sum->harga_hpp_tot);
//                  $dpp        = hitung_dpp($this->Setting->dpp, $gtotal);
//                  $jml_pph    = hitung_pph($this->Setting->dpp, $this->Setting->pph, $gtotal);
//                  $jml_ppn    = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $gtotal);
//                  $ppn        = $this->Setting->jml_ppn;
//                  $pph        = $this->Setting->pph;
//                  $netto      = $dpp - $jml_pph;
//                  $lk         = $netto - $sql_penj_sum->harga_hpp_tot;
//                  $biaya      = $lk - $sql_penj_sum_bi->subtotal;
//                  $lb         = $biaya + $sql_penj_sum->harga_hpp_ppn;
//                  $biaya2     = ($sql_penj_sum_bi->subtotal / $gtotal) * 100;
//                }else{ // if($sql_penj->status_ppn == '0'){
//                    # Perhitungan Non PPn
//                    $hpp        = $sql_penj_sum->harga_hpp_tot;
//                    $hpp_ppn    = 0;
//                    $dpp        = $gtotal;
//                    $jml_pph    = hitung_pph($this->Setting->dpp, $this->Setting->pph, $gtotal);
//                    $jml_ppn    = 0;
//                    $ppn        = 0;
//                    $pph        = $this->Setting->pph;
//                    $netto      = $dpp - $jml_pph;
//                    $lk         = $netto - $sql_penj_sum->harga_hpp_tot;
//                    $biaya      = $lk - $sql_penj_sum_bi->subtotal;
//                    $lb         = $biaya + $sql_penj_sum->harga_hpp_ppn;
//                    $biaya2     = ($sql_penj_sum_bi->subtotal / $gtotal) * 100;
//                }
                
                $hpp        = $sql_penj_sum->harga_hpp_tot;
                $hpp_ppn    = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $sql_penj_sum->harga_hpp_tot);
                $dpp        = hitung_dpp($this->Setting->dpp, $gtotal);
                $jml_pph    = hitung_pph($this->Setting->dpp, $this->Setting->pph, $gtotal);
                $jml_ppn    = hitung_ppn($this->Setting->jml_ppn, $this->Setting->ppn_tot, $gtotal);
                $ppn        = $this->Setting->jml_ppn;
                $pph        = $this->Setting->pph;
                $netto      = $dpp - $jml_pph;
                $lk         = $netto - $sql_penj_sum->harga_hpp_tot;
                $biaya      = $lk - $sql_penj_sum_bi->subtotal;
                $lb         = $biaya + $sql_penj_sum->harga_hpp_ppn;
                // $biaya2     = ($sql_penj_sum_bi->subtotal / $gtotal) * 100;
                if ($gtotal > 0) {
                    $biaya2 = ($sql_penj_sum_bi->subtotal / $gtotal) * 100;
                } else {
                    $biaya2 = 0; // atau null, tergantung logika kamu
                }
                
                # Start Transact SQL
                $this->db->transBegin();
                
                # Cek id dan perubahan data status nya dan hitung ulang total
                $data = [
                    'id'            => $id,
                    'jml_total'     => (float)$dpp,
                    'ppn'           => (float)$ppn,
                    'jml_ppn'       => (float)$jml_ppn,
                    'pph'           => (float)$pph,
                    'jml_pph'       => (float)$jml_pph,
                    'jml_gtotal'    => (float)$gtotal,
                    'jml_biaya'     => (float)$sql_penj_sum_bi->subtotal,
                    'jml_hpp'       => (float)$hpp,
                    'jml_hpp_ppn'   => (float)$hpp_ppn,
                    'jml_profit'    => (float)$lb,
                    'status'        => $status,
                ];

                $Penj->save($data);
                $last_id = $id;
                
                # Cek status, apakah ada rab
                if(!empty($sql_penj->id_rab)){
                    # Jika status_rab = 6 atau posting, dan status rab 0
                    if($sql_rab->status == '6' AND $sql_penj->status == '0' AND $status == '0'){                    
                        # Update data rab atur status mjd 4
                        $data_rab = [
                            'id'            => $sql_rab->id,
                            'status'        => '4',
                        ];

                        $Rab->save($data_rab);

                        # Hapus penjualan jika masih dalam status rab
                        $Penj->where('id', $id)->delete();
                    }                    
                }
                
                
                # End off transact SQL
                $this->db->transComplete();
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', $psn);
                }

                return redirect()->to(base_url($rute));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }    
    
    
    public function pdf_penjualan_inv(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDPenj         = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDPenj)){
                $Penj           = new \App\Models\vtrPenj();
                $PenjDet        = new \App\Models\trPenjDet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $Tipe           = new \App\Models\mTipe();
                $Profile        = new \App\Models\PengaturanProfile();

                $sql_penj        = $Penj->asObject()->where('id', $IDPenj)->first();
                $sql_penj_det    = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', '1')->find();
                $sql_penj_det2   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', '2')->where('status_biaya', '1')->find();
                $sql_penj_sum    = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $IDPenj)->where('status', '1')->first();             
                $sql_penj_sum_bi = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $IDPenj)->where('status', '2')->where('status_biaya', '0')->first();  
                $sql_penj_det_rw = $PenjDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item        = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat         = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn        = $Plgn->asObject()->where('id', $sql_penj->id_pelanggan)->first();
                $sql_profile     = $Profile->asObject()->where('id', $sql_penj->id_perusahaan)->first();
                $sql_tipe        = $Tipe->asObject()->where('status', '1')->find();              
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
            
            $logo       = FCPATH.'file/app/' . $sql_profile->logo_kop;
            $logo_wm    = FCPATH.'file/app/' . $sql_profile->logo_wm;
            
            if (isset($status)) {
                if($status == '1'){
                    $pdf = new FPDF('L', 'cm', array(21.5, 33));
                }else{
                    $pdf = new FPDF('P', 'cm', array(21.5, 33));
                }
            }else{
                $pdf = new FPDF('P', 'cm', array(21.5, 33));
            }
                        
            $pdf->SetAutoPageBreak('auto', 5);
            $pdf->SetMargins(1, 1, 1);
            $pdf->header = 0;
            $pdf->addPage('', '', false);

            # Tambahkan font
            $pdf->AddFont('TrebuchetMS','','trebuc.php');
            $pdf->AddFont('TrebuchetMS-Bold','','trebucbd.php');
            $pdf->AddFont('Trebuchet-BoldItalic','','trebucbi.php');
            $pdf->AddFont('TrebuchetMS-Italic','','trebucit.php');
            
            # ------------------------ KOP -------------------------------------------
            # Logo Kiri Atas
            if(file_exists($logo)){
                $pdf->Image($logo,1,1,5,2);
            }
            
            # Logo Watermark
            if(file_exists($logo_wm)){
                $pdf->Image($logo_wm,2,6,14,5); 
            }

            $fill = FALSE;
            $pdf->SetFont('TrebuchetMS-Bold','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->nama), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, '', $fill);
            $pdf->Cell(14, .5, $sql_profile->alamat, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->kota), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Telp', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(5, .5, $sql_profile->no_telp, '', 0, 'L', $fill);
            $pdf->Cell(1, .5, 'E-mail', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(4, .5, $sql_profile->email, '', 1, 'L', $fill);
            # ------------------------ END KOP -------------------------------------------
                        
            # ------------------------ HEADER --------------------------------------------
            $pdf->Ln(1); 
            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(19, .5, 'INVOICE', '', 0, 'C', $fill);
            $pdf->Ln(0.75);            
            # ------------------------ END HEADER ----------------------------------------
            
            # ------------------------ ISI -----------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(2, .5, 'Tanggal', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Cell(9, .5, tgl_indo2($sql_penj->tgl_masuk), '', 0, 'L', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(1.5, .5, 'Sales', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Cell(5.5, .5, $sql_penj->sales, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(2, .5, 'Nomor', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Cell(15, .5, $sql_penj->no_nota, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(2, .5, 'Kepada Yth', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Cell(15, .5, $sql_penj->p_nama, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(2, .5, 'Alamat', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS', '', 9);
//            $pdf->Cell(15, .5, $sql_penj->p_alamat, '', 0, 'L', $fill);
            $pdf->MultiCell(15, .5, (!empty($sql_penj->p_alamat) ? $sql_penj->p_alamat : ''), '0', 'L');
            $pdf->Ln(0.75); 
            
            $pdf->Cell(1, .5, 'NO', 'TB', 0, 'C', $fill);
            $pdf->Cell(10, .5, 'DESKRIPSI', 'TB', 0, 'C', $fill);
            $pdf->Cell(1, .5, 'JML', 'TB', 0, 'C', $fill);
            $pdf->Cell(2, .5, 'SATUAN', 'TB', 0, 'L', $fill);
            $pdf->Cell(2.5, .5, 'HARGA', 'TB', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, 'SUBTOTAL', 'TB', 0, 'R', $fill);
            
            $pdf->SetTextColor(0,0,0);
            
            if (isset($status)) {
                if($status == '1'){
                    $pdf->Cell(2.5, .5, 'Profit', '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, 'HPP', '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, 'PPN dari HPP', '', 0, 'R', $fill);
                    $pdf->Cell(2.5, .5, 'Total', '', 0, 'R', $fill);
                }
            }
            
            $pdf->Ln();
            
            $pdf->SetFont('TrebuchetMS', '', 9);
            $no     = 1;
            $subtot = 0;
            foreach ($sql_penj_det as $det){
                $subtot = $subtot + $det->subtotal;
                
                $pdf->Cell(1, .5, $no.'.', '', 0, 'C', $fill);
                $pdf->Cell(10, .5, $det->item, '', 0, 'L', $fill);
                $pdf->Cell(1, .5, (int)$det->jml, '', 0, 'C', $fill);
                $pdf->Cell(2, .5, $det->satuan, '', 0, 'L', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->harga), '', 0, 'R', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->subtotal), '', 0, 'R', $fill);
                
                if (isset($status)) {
                    if($status == '1'){
                        $pdf->Cell(2.5, .5, format_angka($det->profit), '', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, format_angka($det->harga_hpp), '', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, format_angka($det->harga_hpp_ppn), '', 0, 'R', $fill);
                        $pdf->Cell(2.5, .5, format_angka($det->harga_hpp_tot), '', 0, 'R', $fill);                        
                    }
                }
                
                $pdf->Ln();
                
                $no++;
            }
            
            $gtotal = $subtot;
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(16.5, .5, 'TOTAL', 'T', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, format_angka($subtot), 'T', 0, 'R', $fill);
            $pdf->Ln(1);            
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(14, .5, 'TRANSFER KE :', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, 'HORMAT KAMI', '', 0, 'C', $fill);
            $pdf->Ln();            
            $pdf->SetFont('TrebuchetMS-Italic', '', 9);
            $pdf->Cell(19, .5, $sql_profile->rek_bank, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(19, .5, $sql_profile->rek_nomor, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(19, .5, $sql_profile->rek_nama, '', 0, 'L', $fill);
            $pdf->Ln();            
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(5, .5, '( '.$sql_profile->direktur.' )', '', 0, 'C', $fill);
            $pdf->Ln(1);            

            $this->response->setContentType('application/pdf');
            $pdf->Output('pdf-'.url_title(strtolower($sql_penj->no_nota)).(isset($status) ? '-internal' : '').'.pdf', 'I');                   
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function pdf_penjualan_kwi(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDPenj         = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDPenj)){
                $Penj           = new \App\Models\vtrPenj();
                $PenjDet        = new \App\Models\trPenjDet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $Tipe           = new \App\Models\mTipe();
                $Profile        = new \App\Models\PengaturanProfile();

                $sql_penj        = $Penj->asObject()->where('id', $IDPenj)->first();
                $sql_penj_det    = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', '1')->find();
                $sql_penj_det2   = $PenjDet->asObject()->where('id_penjualan', $IDPenj)->where('status', '2')->where('status_biaya', '1')->find();
                $sql_penj_sum    = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $IDPenj)->where('status', '1')->first();             
                $sql_penj_sum_bi = $PenjDet->asObject()->select('SUM(subtotal) AS subtotal, SUM(profit) AS profit, SUM(harga_hpp) AS harga_hpp, SUM(harga_hpp_ppn) AS harga_hpp_ppn, SUM(harga_hpp_tot) AS harga_hpp_tot')->where('id_penjualan', $IDPenj)->where('status', '2')->where('status_biaya', '0')->first();  
                $sql_penj_det_rw = $PenjDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item        = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat         = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn        = $Plgn->asObject()->where('id', $sql_penj->id_pelanggan)->first();
                $sql_profile     = $Profile->asObject()->where('id', $sql_penj->id_perusahaan)->first();
                $sql_tipe        = $Tipe->asObject()->where('status', '1')->find();              
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
            }
            
            $logo       = FCPATH.'file/app/'.$sql_profile->logo_kop;
            $logo_wm    = FCPATH.'file/app/'.$sql_profile->logo_wm;
            
            if (isset($status)) {
                if($status == '1'){
                    $pdf = new FPDF('L', 'cm', array(21.5, 33));
                }else{
                    $pdf = new FPDF('P', 'cm', array(21.5, 33));
                }
            }else{
                $pdf = new FPDF('P', 'cm', array(21.5, 33));
            }
                        
            $pdf->SetAutoPageBreak('auto', 5);
            $pdf->SetMargins(1, 1, 1);
            $pdf->header = 0;
            $pdf->addPage('', '', false);

            # Tambahkan font
            $pdf->AddFont('TrebuchetMS','','trebuc.php');
            $pdf->AddFont('TrebuchetMS-Bold','','trebucbd.php');
            $pdf->AddFont('Trebuchet-BoldItalic','','trebucbi.php');
            $pdf->AddFont('TrebuchetMS-Italic','','trebucit.php');
            
            # ------------------------ KOP -------------------------------------------
            # Logo Kiri Atas
            if(file_exists($logo)){
                $pdf->Image($logo,1,1,5,2);
            }
            
            # Logo Watermark
            if(file_exists($logo_wm)){
                $pdf->Image($logo_wm,2,6,14,5); 
            }

            $fill = FALSE;
            $pdf->SetFont('TrebuchetMS-Bold','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->nama), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, '', $fill);
            $pdf->Cell(14, .5, $sql_profile->alamat, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(14, .5, strtoupper($sql_profile->kota), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Telp', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(5, .5, $sql_profile->no_telp, '', 0, 'L', $fill);
            $pdf->Cell(1, .5, 'E-mail', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(4, .5, $sql_profile->email, '', 1, 'L', $fill);
            # ------------------------ END KOP -------------------------------------------
                        
            # ------------------------ HEADER --------------------------------------------
            $pdf->Ln(1); 
            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(19, .5, 'KWITANSI', '', 0, 'C', $fill);
            $pdf->Ln(0.75);            
            # ------------------------ END HEADER ----------------------------------------
            
            # ------------------------ ISI -----------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(3.5, .5, 'Sudah diterima dari', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Cell(15, .5, $sql_penj->p_nama, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(3.5, .5, 'Terbilang', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS-Italic', '', 9);
            $pdf->Cell(15, .5, strtoupper(format_angka_str($sql_penj->jml_gtotal)), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(3.5, .5, 'Untuk Pembayaran', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Cell(15, .5, $sql_penj->no_kontrak, '', 0, 'L', $fill);
            $pdf->Ln(1); 
                       
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(14, .5, 'TRANSFER KE :', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, ucwords(strtolower($sql_profile->kota)).', '. tgl_indo3($sql_penj->tgl_masuk), '', 0, 'C', $fill);
            $pdf->Ln();            
            $pdf->SetFont('TrebuchetMS-Italic', '', 9);
            $pdf->Cell(19, .5, '', '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(19, .5, '', '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(19, .5, '', '', 0, 'L', $fill);
            $pdf->Ln();            
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(5, .5, '( '.$sql_profile->direktur.' )', '', 0, 'C', $fill);
            $pdf->Ln(1);            

            $this->response->setContentType('application/pdf');
            $pdf->Output('inv-'.$sql_penj->tgl_masuk.(isset($status) ? '-internal' : '').'.pdf', 'I');                   
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_penjualan_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('no_nota');
            $nama   = $this->input->getVar('nama');
            $tipe   = $this->input->getVar('tipe');
            
            return redirect()->to(base_url('transaksi/data_penjualan.php?'.(!empty($kode) ? 'filter_kode='.$kode : '').(!empty($nama) ? '&filter_nama='.$nama : '').(!empty($tipe) ? '&filter_tipe='.$tipe : '')));
        }
    }
    

    
    public function data_pembayaran(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $no_nota       = $this->input->getVar('filter_no_nota');
            $kat        = $this->input->getVar('filter_kat');
            $status_bayar        = $this->input->getVar('filter_status_bayar');
            $hlmn       = $this->input->getVar('page');

            $vtrPenj    = new \App\Models\vtrPenj();
            $sql_penj   = $vtrPenj->asObject()->where('status', '1')->orderBy('id', 'DESC'); //->like('kode', (!empty($kode) ? $kode : ''))->like('kategori', (!empty($kat) ? $kat : ''));
            
            if (!empty($no_nota)) {
                $sql_penj->where('no_nota', $no_nota);
            }

            if (!empty($status_bayar)) {
                $status = $status_bayar == 'paid' ? '1' : ($status_bayar == 'partial' ? '2' : '0');
                $sql_penj->where('status_bayar', $status);
            }

            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLPenj'       => $sql_penj->paginate($jml_limit),
                'Pagination'    => $vtrPenj->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_bayar',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/data_pembayaran',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_pembayaran_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDPenj         = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDPenj)){
                $Penj           = new \App\Models\vtrPenj();
                $PenjDet        = new \App\Models\trPenjDet();
                $PenjFile       = new \App\Models\trPenjFile();
                $vtrMutasi      = new \App\Models\vtrMutasi();
                $PO             = new \App\Models\vtrPO();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Plgn           = new \App\Models\mPelanggan();
                $Tipe           = new \App\Models\mTipe();
                $TipeFile       = new \App\Models\mTipeFile();
                $Platform       = new \App\Models\mPlatform();
                $Profile        = new \App\Models\PengaturanProfile();
                $PenjPlat   = new \App\Models\trPenjPlat();
                
                $sql_penj           = $Penj->asObject()->where('id', $IDPenj)->first();
                $sql_penj_det       = $PenjDet->asObject()->where('id_penjualan', $sql_penj->id)->find();
                $sql_item           = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat            = $Sat->asObject()->where('status', '1')->find();
                $sql_plgn           = $Plgn->asObject()->where('id', $sql_penj->id_pelanggan)->first();
                $sql_profile        = $Profile->asObject()->where('status', '1')->find();
                $sql_tipe           = $Tipe->asObject()->where('status', '1')->find();
                $sql_tipe_file      = $TipeFile->asObject()->where('status', '1')->find();
                $sql_penj_sum       = $PenjDet->asObject()->selectSum('subtotal')->where('id_penjualan', $IDPenj)->first();             
                $sql_penj_file      = $PenjFile->asObject()->where('id_penjualan', $IDPenj)->find();             
                $sql_mut            = $vtrMutasi->asObject()->where('id_penjualan', $IDPenj)->where('status', '1')->find();
                $sql_po             = $PO->asObject()->where('id_rab', $sql_penj->id_rab)->find();
                $sql_plat           = $Platform->asObject()->where('status', '1')->find();
                $sql_penj_plat      = $PenjPlat->asObject()->where('id_penjualan', $IDPenj)->find();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_plgn       = '';
                $sql_mut        = '';
                $sql_penj_plat  = '';
            }

            $data  = [
                'SQLPenj'       => $sql_penj,
                'SQLPenjPlat'   => $sql_penj_plat,
                'SQLPenjDet'    => $sql_penj_det,
                'SQLPenjDetSum' => $sql_penj_sum,
                'SQLPenjFile'   => $sql_penj_file,
                'SQLPO'         => $sql_po,
                'SQLMutasi'     => $sql_mut,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLPlgn'       => $sql_plgn,
                'SQLUser'       => $ID,
                'SQLProfile'    => $sql_profile,
                'SQLTipe'       => $sql_tipe,
                'SQLTipeFile'   => $sql_tipe_file,
                'SQLPlat'       => $sql_plat,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri_bayar',
                'konten'        => $this->ThemePath . '/manajemen/transaksi/data_penjualan_bayar'
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_penjualan_bayar() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $tgl_bayar  = $this->input->getVar('tgl_bayar');
            $jml_bayar  = $this->input->getVar('jml_bayar');
            $metode     = $this->input->getVar('metode');
            $keterangan     = $this->input->getVar('keterangan');
            $rute       = $this->input->getVar('route');
            $fupl       = $this->request->getFile('fupload');

            $Profile    = new \App\Models\PengaturanProfile();
            $Plgn       = new \App\Models\mPelanggan();
            $Rab        = new \App\Models\trRab();
            $RabDet     = new \App\Models\trRabDet();
            $PO         = new \App\Models\vtrPO();
            $Penj       = new \App\Models\trPenj();
            $PenjDet    = new \App\Models\trPenjDet();
            $PenjPO     = new \App\Models\trPenjPO();
            $PenjPlat   = new \App\Models\trPenjPlat();
            $Platform   = new \App\Models\mPlatform();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'tgl_bayar'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Tanggal Bayar tidak boleh kosong',
                    ]
                ],
                'jml_bayar'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Jml Bayar tidak boleh kosong',
                    ]
                ],
                'metode'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Metode Bayar tidak boleh kosong',
                    ]
                ],
                'keterangan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Keterangan Bayar tidak boleh kosong',
                    ]
                ],
                // 'fupload' => [
                //     'rules'     => 'uploaded[fupload]|mime_in[fupload,application/pdf,image/png,image/jpg,image/jpeg]|ext_in[fupload,pdf,jpg,png,jpeg]|max_size[fupload,8192]',
                //     'errors'    => [
                //         'mime_in'   => 'Berkas harus berupa gambar / pdf',
                //         'ext_in'    => 'Berkas harus berupa *.jpg, *.jpeg, *.png, *.pdf',
                //         'max_size'  => 'Berkas harus berukuran maksimal 8MB',
                //     ]
                // ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id'            => $validasi->getError('id'),
                    'tgl_bayar'     => $validasi->getError('tgl_bayar'),
                    'metode'        => $validasi->getError('metode'),
                    'jml_bayar'     => $validasi->getError('jml_bayar'),
                    // 'fupload'       => $validasi->getError('fupload'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/data_pembayaran_tambah.php?id='.$id));
            }else{
                $sql_penj           = $Penj->asObject()->where('id', $id)->first();
                $sql_penj_det       = $PenjDet->asObject()->where('id_penjualan', $sql_penj->id)->find();
                $sql_rab            = $Rab->asObject()->where('id', $sql_penj->id_rab)->first();
                $sql_platform       = $Platform->asObject()->where('id', $metode)->first();
                $jml_bayar          = format_angka_db($jml_bayar);
                
                // if($jml_bayar >= $sql_penj->jml_gtotal){
                //     $status_bayar = '1';
                // }else{
                //     $status_bayar = '0';
                // }               

                $totalBayar = $jml_bayar + $sql_penj->jml_bayar;
                if($totalBayar >= $sql_penj->jml_gtotal){
                    $status_bayar = '1'; //LUNAS
                }else {
                    $status_bayar = '2'; //BELUM LUNAS
                }
                
                # Start Transact SQL
                $this->db->transBegin();
                
                # Masukkan data pembayaran
                $data = [
                    'id'            => $id,
                    // 'tgl_bayar'     => tgl_indo_sys($tgl_bayar),
                    'jml_bayar'     => (float)$totalBayar,
                    'jml_kurang' => (float)$sql_penj->jml_gtotal - $totalBayar,
                    // 'metode_bayar'  => $metode,
                    'status_bayar'  => $status_bayar,
                ];
                
                $resultPenj = $Penj->save($data);
                if (!$resultPenj) {
                    dd('Gagal menyimpan PenjPlat:', $PenjPlat->errors());
                }
                $last_id = $id;
                
                // IMG HANDLING
                $path       = FCPATH . 'file/sale/paid/'.strtolower($sql_penj->id);
                $unique = uniqid();
                $filename = 'so_' . strtolower(string: alnum($sql_platform->platform)) . '_' . $unique . '.' . $fupl->getClientExtension();

                if(!file_exists($path)){
                    mkdir($path, 0777, true);
                }
                
                # Jika valid lanjut upload file
                if ($fupl->isValid() && !$fupl->hasMoved()) {
                    $fupl->move($path, $filename, true);
                }
                
                // DETAIL PEMBAYARAN
                $dataPlatform = [
                    'id_penjualan' => $id,
                    'id_platform' => $metode,
                    'tgl_simpan'     => tgl_indo_sys2_time($tgl_bayar),
                    'platform' => $sql_platform->platform,
                    'no_nota' => $sql_penj->no_nota,
                    'nominal' => (float)$jml_bayar,
                    'file'     => 'file/sale/paid/'.strtolower($sql_penj->id).'/'.$filename,
                    'keterangan' => $keterangan
                ];
                $resultPenjPlat = $PenjPlat->save($dataPlatform);
                if (!$resultPenjPlat) {
                    dd('Gagal menyimpan PenjPlat:', $PenjPlat->errors());
                }
                # End off transact SQL
                $this->db->transComplete();
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                if($last_id > 0){
                    $this->session->setFlashdata('transaksi_toast', 'toastr.success("Transaksi berhasil dibayar !!");');
                }

                return redirect()->to(base_url(relativePath: 'transaksi/data_pembayaran.php'));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function struk(){
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
                'menu_kiri'     => $this->ThemePath.'/manajemen/transaksi/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/transaksi/struk',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function pdf_struk(){
        if ($this->ionAuth->loggedIn()) {
            $ID                     = $this->ionAuth->user()->row();
            $kuitansi         = $this->input->getVar('kuitansi');
            $tgl_masuk              = $this->input->getVar('tgl_masuk');
            $terima_dari            = $this->input->getVar('terima_dari');
            $nominal                = $this->input->getVar('nominal');
            $keperluan              = $this->input->getVar('keperluan');
            
            $nominal                = $nominal == '' ? '0' : format_angka_db($nominal);
            if($tgl_masuk != ""){
                $tgl_masuk = DateTime::createFromFormat('d/m/Y', $tgl_masuk);
                $tgl_masuk = $tgl_masuk->format('d F Y');
            }else{
                $tgl_masuk = '                  '.date("Y");
            }

            $Profile        = new \App\Models\PengaturanProfile();
            $sql_profile    = $Profile->asObject()->first();
            $logo       = FCPATH . 'file/app/' . $sql_profile->logo_kop;
            $logo_wm    = FCPATH.'file/app/' . $sql_profile->logo_wm;
            
            if (isset($status)) {
                if($status == '1'){
                    $pdf = new FPDF('L', 'cm', array(21.5, 33));
                }else{
                    $pdf = new FPDF('P', 'cm', array(21.5, 33));
                }
            }else{
                $pdf = new FPDF('P', 'cm', array(21.5, 33));
            }
                        
            $pdf->SetAutoPageBreak('auto', 5);
            $pdf->SetMargins(1, 1, 1);
            $pdf->header = 0;
            $pdf->addPage('', '', false);

            # Tambahkan font
            $pdf->AddFont('TrebuchetMS','','trebuc.php');
            $pdf->AddFont('TrebuchetMS-Bold','','trebucbd.php');
            $pdf->AddFont('Trebuchet-BoldItalic','','trebucbi.php');
            $pdf->AddFont('TrebuchetMS-Italic','','trebucit.php');
            
            # ------------------------ KOP -------------------------------------------
            # Logo Kiri Atas
            if(file_exists($logo)){
                $pdf->Image($logo,1,1,5,2);
            }
            
            # Logo Watermark
            if(file_exists($logo_wm)){
                $pdf->Image($logo_wm,2,6,14,5); 
            }

            $fill = FALSE;
            $pdf->SetFont('TrebuchetMS-Bold','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            // $pdf->Cell(14, .5, strtoupper($sql_profile->nama), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, '', $fill);
            // $pdf->Cell(14, .5, $sql_profile->alamat, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(5, .5, '', '', 0, 'L', $fill);
            // $pdf->Cell(14, .5, strtoupper($sql_profile->kota), '', 0, 'L', $fill);
            $pdf->Ln();
            # ------------------------ END KOP -------------------------------------------
                        
            # ------------------------ HEADER --------------------------------------------
            
            $pdf->Ln(0.75);
            $pdf->Cell(19, .5, '', 'T', 0, 'C', $fill);
            $pdf->Ln(0.4);

            $pdf->SetFont('Arial', 'B', 15);
            $pdf->Cell(18, .5, 'KUITANSI', '', 0, 'C', $fill);
            $pdf->Ln(0.5);
            $pdf->SetFont('Arial', '', '9');
            $pdf->Cell(18, .5, 'No : '.$kuitansi, '', 0, 'C', $fill);
            $pdf->Ln(0.75);
            
            $pdf->SetFont('Arial', '', '9');
            $pdf->Cell(3, .5, 'Telah Terima Dari', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(15.5, .5, $terima_dari, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(3, .5, 'Banyak Uang', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(15.5, .5, format_angka($nominal), '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(3, .5, 'Untuk Pembayaran', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(15.5, .5, $keperluan, '', 0, 'L', $fill);
            $pdf->Ln(1);            
            # ------------------------ END HEADER ----------------------------------------
            
            # ------------------------ ISI -----------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 15);
            $pdf->Cell(19, .9, 'Rp. '.format_angka($nominal), 'TB', 0, 'C', $fill);
            $pdf->Ln();
            
            
            # ------------------ TTD -------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Ln(1);
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, 'Magelang, '.$tgl_masuk, '', 0, 'C', $fill);
            $pdf->Ln(1);
            
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, 'Hormat Kami', '', 0, 'C', $fill);
            $pdf->Ln(2.5);
            $pdf->Cell(14, .5, '', '', 0, 'R', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(5, .5, ucwords($ID->first_name), '', 0, 'C', $fill);  
            
            $this->response->setContentType('application/pdf');
            $pdf->Output('rab-'.$tgl_masuk.(isset($status) ? '-internal' : '').'.pdf', 'I');                 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
}
