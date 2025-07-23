<?php
namespace App\Controllers;

use App\Models\PengaturanProfile;
use App\Models\mTipe;
use FPDF;

/**
 * Description of Gudang
 *
 * @author mike
 */
class Gudang extends BaseController {
    
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
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/gudang/konten',
            ];
            
            return view($this->ThemePath.'/index', $data);          
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    

    public function data_item(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $item       = $this->input->getVar('filter_item');
            $kategori       = $this->input->getVar('filter_kategory');
            $hlmn       = $this->input->getVar('page');
            
            $Model      = new \App\Models\vItem();
            $ModKategory = new \App\Models\mKategori();
            $ModMerk = new \App\Models\mMerk();
            $sql_item   = $Model->asObject()->where('status_stok', '1'); //->like('item2', (!empty($item) ? $item : ''))->orLike('kode', (!empty($item) ? $item : ''));
            // Apply filters if they exist
            if (!empty($kategori)) {
                $sql_item->where('id_kategori', $kategori);
            }

            if (!empty($item)) {
                $keyword = strtolower($item);
                $sql_item->groupStart()
                ->where("LOWER(item) LIKE", "%$keyword%")
                ->orWhere("LOWER(merk) LIKE", "%$keyword%")
                ->orWhere("LOWER(kode) LIKE", "%$keyword%")
                ->orWhere("LOWER(keterangan) LIKE", "%$keyword%")
                ->groupEnd();
            }
            
            $jml_limit  = $this->Setting->jml_item;
                                    
            $data  = [
                'SQLItem'       => $sql_item->paginate($jml_limit),
                'SQLKategori'   => $ModKategory->findAll(),
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
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_item',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_item_stok(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDItem     = $this->input->getVar('id');
            
            $Kategori   = new \App\Models\mKategori();
            $Merk       = new \App\Models\mMerk();
            $Satuan     = new \App\Models\mSatuan();
            $Gudang     = new \App\Models\mGudang();
            $sql_satuan = $Satuan->asObject()->where('status', '1')->find();
            $sql_gd     = $Gudang->asObject()->find();
            
            if(!empty($IDItem)){
                $Item           = new \App\Models\vItem();
                $ItemStok       = new \App\Models\vItemStok();
                $ItemHist       = new \App\Models\vItemHist();
                
                $sql_item       = $Item->asObject()->where('id', $IDItem)->first();
                $sql_item_stok  = $ItemStok->asObject()->where('id_item', $sql_item->id)->find();
                $sql_item_hist  = $ItemHist->asObject()->where('id_item', $sql_item->id)->find();
            }else{
                $sql_item = '';
            }
                                    
            $data  = [
                'SQLItem'       => $sql_item,
                'SQLItemStok'   => $sql_item_stok,
                'SQLItemHist'   => $sql_item_hist,
                'SQLSatuan'     => $sql_satuan,
                'SQLGudang'     => $sql_gd,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_item_stok',
            ];
            
            return view($this->ThemePath.'/index', $data); 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }   
       
    public function set_item_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $id_item    = $this->input->getVar('id_item');
            $id_gudang  = $this->input->getVar('id_gudang');
            $satuan     = $this->input->getVar('satuan');
            $jml        = $this->input->getVar('jml');
            
            $Gudang     = new \App\Models\mGudang();
            $Item       = new \App\Models\mItem();
            $ItemStok   = new \App\Models\mItemStok();
            $Satuan     = new \App\Models\mSatuan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id'    => $validasi->getError('id'),
                    'jml'   => $validasi->getError('jml'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/stok/data_item_det.php'.(!empty($id_item) ? '?id='.$id_item : '')));
            }else{
                $sql_item       = $Item->asObject()->where('id', $id_item)->first();
                $sql_sat        = $Satuan->asObject()->where('id', $satuan)->first();

                $data = [
                    'id'            => $id,
                    'id_item'       => (!empty($sql_item->id) ? $sql_item->id : 0),
                    'id_gudang'     => $id_gudang,
                    'id_satuan'     => (!empty($satuan) ? $satuan : 0),
                    'id_user'       => $ID->id,
                    'jml'           => (float)$jml,
                    'jml_satuan'    => (!empty($sql_sat->jml) ? (int)$sql_sat->jml : 1),
                    'satuan'        => (!empty($sql_sat->satuanBesar) ? $sql_sat->satuanBesar : ''),
                ];
                
                $ItemStok->save($data);
                
                # Hitung Sum stok
                $sql_item_stok  = $ItemStok->asObject()->select('SUM(jml) as jml')->where('id_item', $id_item)->first();
                
                $data_stok = [
                    'id'    => $id_item,
                    'jml'   => $sql_item_stok->jml
                ];
                
                $Item->save($data_stok);
                $last_id = $id_item;               

                if($last_id > 0){
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Stok berhasil disimpan !!");');
                }else{
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Stok berhasil diupdate !!");');
                }

                return redirect()->to(base_url('gudang/stok/data_item_det.php'.(!empty($last_id) ? '?id='.$last_id : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_beli(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $no_nota    = $this->input->getVar('filter_no_nota');
            $supplier   = $this->input->getVar('filter_supplier');
            
            
            $vtrBeli    = new \App\Models\vtrPembelian();
            $sql_beli   = $vtrBeli->asObject()->where('status', '1')->orderBy('id', 'DESC');
            if (!empty($no_nota)) {
                $sql_beli->like('no_nota', $no_nota);
            }
            if (!empty($supplier)) {
                $sql_beli->like('supplier', $supplier);
            }

            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLBeli'       => $sql_beli->paginate($jml_limit),
                'Pagination'    => $vtrBeli->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_beli',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function set_data_beli_cari() {
        if ($this->ionAuth->loggedIn()) {
            if ($this->input->is('post') == 1) {
                $no_nota   = $this->input->getVar('no_nota');
                $supplier   = $this->input->getVar('supplier');

                return redirect()->to(base_url('gudang/penerimaan/data_beli.php?'.(!empty($no_nota) ? 'filter_no_nota='.$no_nota : '').(!empty($supplier) ? '&filter_supplier='.$supplier : '')));
            } 
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_beli_terima(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDBeli     = $this->input->getVar('id');
            $IDSupp     = $this->input->getVar('id_supplier');
            $IDItm      = $this->input->getVar('id_item');
            $IDItmDet   = $this->input->getVar('id_item_det');
            
            $Supp       = new \App\Models\mSupplier();
            $Gudang     = new \App\Models\mGudang();
            $Beli       = new \App\Models\vtrPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
                
            $sql_beli   = $Beli->asObject()->where('id', $IDBeli)->first();
            $sql_supp   = $Supp->asObject()->where('id', (isset($_GET['id_supplier']) ? $IDSupp : (!empty($sql_beli->id_supplier) ? $sql_beli->id_supplier : '0')))->first();
            
            if(!empty($IDBeli)){
                $Itm                = new \App\Models\vItem();
                $Sat                = new \App\Models\mSatuan;
                $sql_beli_det       = $BeliDet->asObject()->where('id_pembelian', $IDBeli)->find();
                $sql_beli_det_rw    = $BeliDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item           = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat            = $Sat->asObject()->where('status', '1')->find();
                $sql_gdg            = $Gudang->asObject()->where('status', '1')->find();
            }else{
                $sql_beli           = '';
                $sql_beli_det       = '';
                $sql_beli_det_rw    = '';
                $sql_item           = '';
                $sql_sat            = '';
            }
                        
            $data  = [
                'SQLBeli'       => $sql_beli,
                'SQLBeliDet'    => $sql_beli_det,
                'SQLBeliDetRw'  => $sql_beli_det_rw,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLSupp'       => $sql_supp,
                'SQLGudang'     => $sql_gdg,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_beli_terima',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_beli_terima_item(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDBeli     = $this->input->getVar('id');
            $IDSupp     = $this->input->getVar('id_supplier');
            $IDItm      = $this->input->getVar('id_item');
            $IDItmDet   = $this->input->getVar('id_item_det');
            
            $Supp       = new \App\Models\mSupplier();
            $Gudang     = new \App\Models\mGudang();
            $Beli       = new \App\Models\vtrPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
                
            $sql_beli   = $Beli->asObject()->where('id', $IDBeli)->first();
            $sql_supp   = $Supp->asObject()->where('id', (isset($_GET['id_supplier']) ? $IDSupp : (!empty($sql_beli->id_supplier) ? $sql_beli->id_supplier : '0')))->first();
            
            if(!empty($IDBeli)){
                $Item               = new \App\Models\vItem();
                $ItemStok           = new \App\Models\mItemStok;
                $ItemStokDet        = new \App\Models\mItemStokDet();
                $ItemStokHist       = new \App\Models\mItemHist();
                $Sat                = new \App\Models\mSatuan;
                $Gudang             = new \App\Models\mGudang();
                
                $sql_gudang         = $Gudang->asObject()->where('status', '1')->first();
                $sql_beli_det       = $BeliDet->asObject()->where('id_pembelian', $IDBeli)->find();
                $sql_beli_det_rw    = $BeliDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item           = $Item->asObject()->where('id', $IDItm)->first();
                
                // Initialize variables to prevent null property access
                $sql_item_stok      = null;
                $sql_item_stok_det  = [];
                $sql_item_stok_hist = [];
                
                // Only proceed with these queries if $sql_item is not null
                if(!empty($sql_item) && !empty($sql_gudang)) {
                    $sql_item_stok = $ItemStok->asObject()->where('id_item', $sql_item->id)->where('id_gudang', $sql_gudang->id)->first();
                    
                    if(!empty($sql_item_stok)) {
                        $sql_item_stok_det = $ItemStokDet->asObject()->where('id_item_stok', $sql_item_stok->id)->find();
                    }
                    
                    $sql_item_stok_hist = $ItemStokHist->asObject()->where('id_pembelian', $IDBeli)->where('id_item', $sql_item->id)->find();
                }
                
                $sql_sat            = $Sat->asObject()->where('status', '1')->find();
                $sql_gdg            = $Gudang->asObject()->where('status', '1')->find();
            }else{
                $sql_beli           = '';
                $sql_beli_det       = '';
                $sql_beli_det_rw    = '';
                $sql_item           = '';
                $sql_sat            = '';
                $sql_item_stok      = null;
                $sql_item_stok_det  = [];
                $sql_item_stok_hist = [];
                $sql_gdg            = [];
            }
                        
            $data  = [
                'SQLBeli'           => $sql_beli,
                'SQLBeliDet'        => $sql_beli_det,
                'SQLBeliDetRw'      => $sql_beli_det_rw,
                'SQLItem'           => $sql_item,
                'SQLItemStok'       => $sql_item_stok,
                'SQLItemStokDet'    => $sql_item_stok_det,
                'SQLItemStokHist'   => $sql_item_stok_hist,
                'SQLSatuan'         => $sql_sat,
                'SQLSupp'           => $sql_supp,
                'SQLGudang'         => $sql_gdg,
                'AksesGrup'         => $AksesGrup,
                'Pengguna'          => $ID,
                'PenggunaGrup'      => $IDGrup,
                'Pengaturan'        => $this->Setting,
                'ThemePath'         => $this->ThemePath,
                'menu_atas'         => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'         => $this->ThemePath.'/manajemen/gudang/menu_kiri',
                'konten'            => $this->ThemePath.'/manajemen/gudang/data_beli_terima_item',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function cart_beli_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID          = $this->ionAuth->user()->row();
            $IDGrup      = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup   = $this->ionAuth->groups()->result();
            
            $id          = $this->input->getVar('id');
            $id_beli     = $this->input->getVar('id_beli');
            $id_item     = $this->input->getVar('id_item');
            $id_item_det = $this->input->getVar('id_item_det');
            $Hal         = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $Beli           = new \App\Models\trPembelian();
                $BeliDet        = new \App\Models\trPembelianDet();
                $Item           = new \App\Models\mItem();
                $Stok           = new \App\Models\mItemStok();
                $StokHist       = new \App\Models\mItemHist();
                $sql_beli       = $Beli->asObject()->where('id', $id_beli)->first();
                $sql_beli_det   = $BeliDet->asObject()->where('id', $id_item_det)->first();
                $sql_item       = $Item->asObject()->where('id', $id_item)->first();
                $sql_stok_hist  = $StokHist->asObject()->where('id', $id)->first();
                $sql_stok       = $Stok->asObject()->where('id_item', $sql_beli_det->id_item)->where('id_gudang', $sql_stok_hist->id_gudang)->first();

                $sisa           = $sql_stok->jml - $sql_stok_hist->jml;
                $sisa_terima    = $sql_beli_det->jml_diterima - $sql_stok_hist->jml;
                
                # Start Transact SQL
                $this->db->transBegin();

                # HITUNG SUM STOK                
                $data_stok = [
                    'id'    => $sql_stok->id,
                    'jml'   => (float)$sisa
                ];
                
                $Stok->save($data_stok);
                # ---- END HITUNG SUM STOK
                
                # SIMPAN DATA PEMBELIAN DETAIL
                $data_terima = [
                    'id'            => $sql_beli_det->id,
                    'jml_diterima'  => $sisa_terima,
                    'keterangan'    => '',
                ];
                
                $BeliDet->save($data_terima);
                # ---- END SIMPAN DATA PEMBELIAN DETAIL
                
                # SIMPAN DATA STOK GLOBAL
                $ItemStok       = new \App\Models\mItemStok();
                $sql_stok_glob  = $ItemStok->asObject()->select('SUM(jml) AS jml')->where('id_item', $sql_item->id)->first();
                $data_stok_glob = [
                    'id'    => $sql_item->id,
                    'jml'   => $sql_stok_glob->jml,
                ];
                $Item->save($data_stok_glob);
                # ---- END SIMPAN DATA STOK GLOBAL
                
                # DELETE RECORDS SQL
                $StokHist->where('id', $id)->delete();             
                
                # End off transact SQL
                $this->db->transComplete();
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                $this->session->setFlashdata('gudang_toast', 'toastr.success("Stok berhasil dihapus !!");');

                return redirect()->to(base_url('gudang/penerimaan/data_beli_terima_item.php'.(!empty($id_beli) ? '?id='.$id_beli : '').(!empty($id_item) ? '&id_item='.$id_item : '').(!empty($id_item_det) ? '&id_item_det='.$id_item_det : '')));
            }
            
//            return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'.(!empty($IDMts) ? '?id='.$IDMts : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
       
    public function set_beli_terima_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $id_beli    = $this->input->getVar('id_beli');
            $id_beli_det= $this->input->getVar('id_beli_det');
            $id_item    = $this->input->getVar('id_item');
            $gudang     = $this->input->getVar('gudang');
            $tgl_terima = $this->input->getVar('tgl_terima');
            $jml        = $this->input->getVar('jml');
            $ket        = $this->input->getVar('keterangan');
            
            
            $Beli       = new \App\Models\trPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
            $Gudang     = new \App\Models\mGudang();
            $Item       = new \App\Models\mItem();
            $ItemStok   = new \App\Models\mItemStok();
            $ItemStokDet= new \App\Models\mItemStokDet();
            $ItemHist   = new \App\Models\mItemHist();
            $Satuan     = new \App\Models\mSatuan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_beli'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'gudang'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Gudang tidak boleh kosong',
                    ]
                ],
                'jml'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Jml tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_beli'   => $validasi->getError('id_beli'),
                    'gudang'    => $validasi->getError('gudang'),
                    'jml'       => $validasi->getError('jml'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/penerimaan/data_beli_terima_item.php'.(!empty($id_beli) ? '?id='.$id_beli : '').(!empty($id_item) ? '&id_item='.$id_item : '').(!empty($id_beli_det) ? '&id_item_det='.$id_beli_det : '')));
            }else{
                $sql_beli       = $Beli->asObject()->where('id', $id_beli)->first();
                $sql_beli_det   = $BeliDet->asObject()->where('id', $id_beli_det)->first();
                $sql_item       = $Item->asObject()->where('id', $id_item)->first();
                $sql_item_stok  = $ItemStok->asObject()->where('id_item', $id_item)->where('id_gudang', $gudang)->first();              
                $sql_satuan     = $Satuan->asObject()->where('id', $sql_item->id_satuan)->first();              

                # Start Transact SQL
                $this->db->transBegin();

                # HITUNG SUM STOK
                $ItemStok       = new \App\Models\mItemStok();
                $sql_item_stok  = $ItemStok->asObject()->where('id_item', $sql_item->id)->where('id_gudang', $gudang)->first();
                
                // Check if $sql_item_stok exists before accessing its properties
                if (!empty($sql_item_stok)) {
                    $stok = $sql_item_stok->jml + $jml;
                } else {
                    // If item stock doesn't exist yet, create new stock record
                    $stok = $jml;
                    
                    // Create new item stock record
                    $data_new_stok = [
                        'id_item'    => $sql_item->id,
                        'id_gudang'  => $gudang,
                        'jml'        => 0, // Will be updated later
                        'keterangan' => $ket,
                    ];
                    
                    $ItemStok->insert($data_new_stok);
                    $sql_item_stok = $ItemStok->asObject()->where('id_item', $sql_item->id)->where('id_gudang', $gudang)->first();
                }
                
                $data_stok = [
                    'id'            => $sql_item_stok->id,
                    'jml'           => (float)$stok,
                    'keterangan'    => (!empty($sql_item_stok->keterangan) ? $sql_item_stok->keterangan.'\r\n' : '').$ket,
                ];
                
                $ItemStok->save($data_stok);
                # ---- END HITUNG SUM STOK
                
                # SIMPAN DATA STOK GLOBAL
                $ItemStok       = new \App\Models\mItemStok();
                $sql_stok_glob  = $ItemStok->asObject()->select('SUM(jml) AS jml')->where('id_item', $sql_item->id)->first();
                $data_stok_glob = [
                    'id'    => $sql_item->id,
                    'jml'   => $sql_stok_glob->jml,
                ];
                $Item->save($data_stok_glob);
                # ---- END SIMPAN DATA STOK GLOBAL
                
                # SIMPAN DATA PEMBELIAN DETAIL
                $data_terima = [
                    'id'            => $sql_beli_det->id,
                    'jml_diterima'  => $sql_beli_det->jml_diterima + $jml,
                    'keterangan'    => $ket,
                ];
                
                $BeliDet->save($data_terima);
                # ---- END SIMPAN DATA PEMBELIAN DETAIL
                
                # SIMPAN DATA HIST PEMBELIAN
                $data_hist = [
                    'id_item'           => $sql_item->id,
                    'id_gudang'         => $gudang,
                    'id_perusahaan'     => $sql_beli->id_perusahaan,
                    'id_supplier'       => $sql_beli->id_supplier,
                    'id_pembelian'      => $sql_beli->id,
                    'id_pembelian_det'  => $id_beli_det,
                    'id_user'           => $ID->id,
                    'tgl_masuk'         => tgl_indo_sys($tgl_terima).' '.date('H:i:s'),
                    'no_nota'           => $sql_beli->no_nota,
                    'kode'              => $sql_item->kode,
                    'item'              => $sql_item->item,
                    'keterangan'        => 'Pembelian ['.$sql_item->kode.'] '.$sql_item->item,
                    'sn'                => $ket,
                    'nominal'           => (float)$sql_beli_det->harga,
                    'jml'               => (float)$jml,
                    'jml_satuan'        => $sql_satuan->jml,
                    'satuan'            => $sql_satuan->satuanBesar,
                    'status'            => '1',
                ];
                $ItemHist->save($data_hist);                
                
                # End off transact SQL
                $this->db->transComplete();
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                $this->session->setFlashdata('gudang_toast', 'toastr.success("Stok berhasil disimpan !!");');

                return redirect()->to(base_url('gudang/penerimaan/data_beli_terima_item.php'.(!empty($id_beli) ? '?id='.$id_beli : '').(!empty($id_item) ? '&id_item='.$id_item : '').(!empty($id_beli_det) ? '&id_item_det='.$id_beli_det : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
       
    public function set_beli_terima_simpan_sn() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $id_beli    = $this->input->getVar('id_beli');
            $id_beli_det= $this->input->getVar('id_beli_det');
            $id_item    = $this->input->getVar('id_item');
            $gudang     = $this->input->getVar('gudang');
            $tgl_terima = $this->input->getVar('tgl_terima');
            $kode       = $this->input->getVar('kode_sn');
            
            
            $Beli       = new \App\Models\trPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
            $Gudang     = new \App\Models\mGudang();
            $Item       = new \App\Models\mItem();
            $ItemStok   = new \App\Models\mItemStok();
            $ItemStokDet= new \App\Models\mItemStokDet();
            $ItemHist   = new \App\Models\mItemHist();
            $Satuan     = new \App\Models\mSatuan();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_beli'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'ID tidak boleh kosong',
                    ]
                ],
                'kode_sn'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'SN tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_beli'   => $validasi->getError('id_beli'),
                    'kode_sn'   => $validasi->getError('kode_sn'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/penerimaan/data_beli_terima_item.php'.(!empty($id_beli) ? '?id='.$id_beli : '').(!empty($id_item) ? '&id_item='.$id_item : '').(!empty($id_beli_det) ? '&id_item_det='.$id_beli_det : '')));
            }else{
                $sql_beli       = $Beli->asObject()->where('id', $id_beli)->first();
                $sql_beli_det   = $BeliDet->asObject()->where('id', $id_beli_det)->first();
                $sql_item       = $Item->asObject()->where('id', $id_item)->first();
                $sql_item_stok  = $ItemStok->asObject()->where('id_item', $id_item)->where('id_gudang', '1')->first();              
                $sql_satuan     = $Satuan->asObject()->where('id', $sql_item->id_satuan)->first();              

                # Start Transact SQL
                $this->db->transBegin();

                # SIMPAN DATA SN
                $data_stok = [
                    'id_gudang'         => $sql_item_stok->id_gudang,
                    'id_item'           => $sql_item->id,
                    'id_item_stok'      => $sql_item_stok->id,
                    'id_perusahaan'     => $sql_beli->id_perusahaan,
                    'id_supplier'       => $sql_beli->id_supplier,
                    'id_pembelian'      => $sql_beli->id,
                    'id_pembelian_det'  => $id_beli_det,
                    'id_user'           => $ID->id,
                    'tgl_masuk'         => date('Y-m-d H:i:s'),
                    'kode'              => $kode,
                    'jml'               => 1,
                    'jml_satuan'        => $sql_satuan->jml,
                    'satuan'            => $sql_satuan->satuanBesar,
                    'status'            => '1',
                ];
                $ItemStokDet->save($data_stok);
                
                # End off transact SQL
                $this->db->transComplete();
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                $this->session->setFlashdata('gudang_toast', 'toastr.success("Stok berhasil disimpan !!");');

                return redirect()->to(base_url('gudang/penerimaan/data_beli_terima_item.php'.(!empty($id_beli) ? '?id='.$id_beli : '').(!empty($id_item) ? '&id_item='.$id_item : '').(!empty($id_beli_det) ? '&id_item_det='.$id_beli_det : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function set_beli_hapus_sn(){
        if ($this->ionAuth->loggedIn()) {
            $ID          = $this->ionAuth->user()->row();
            $IDGrup      = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup   = $this->ionAuth->groups()->result();
            
            $id          = $this->input->getVar('id');
            $id_beli     = $this->input->getVar('id_beli');
            $id_item     = $this->input->getVar('id_item');
            $id_item_det = $this->input->getVar('id_item_det');
            $Hal         = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $ItemStokDet= new \App\Models\mItemStokDet();
                
                # Start Transact SQL
                $this->db->transBegin();
                
                # DELETE RECORDS SQL
                $ItemStokDet->where('id', $id)->delete();
                
                # End off transact SQL
                $this->db->transComplete();
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                $this->session->setFlashdata('gudang_toast', 'toastr.success("SN berhasil dihapus !!");');

                return redirect()->to(base_url('gudang/penerimaan/data_beli_terima_item.php'.(!empty($id_beli) ? '?id='.$id_beli : '').(!empty($id_item) ? '&id_item='.$id_item : '').(!empty($id_item_det) ? '&id_item_det='.$id_item_det : '')));
            }
            
//            return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'.(!empty($IDMts) ? '?id='.$IDMts : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
       
    public function set_beli_terima_proses() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $status     = $this->input->getVar('status_penerimaan');
            
            $Beli       = new \App\Models\trPembelian();

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
                    'id'  => $validasi->getError('id'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/data_pembelian_terima.php'.(!empty($id) ? '?id='.$id : '')));
            }else{
                $sql_beli       = $Beli->asObject()->where('id', $id)->first();
                
                # Start Transact SQL
                $this->db->transBegin();
                
                # SET PENERIMAAN
                $data = [
                    'id'                  => $sql_beli->id,
                    'status_penerimaan'   => $status,
                ];
                
                $Beli->save($data);
                # -- END HITUNG STOK MASUK BERDASARKAN SN                
                
                # End off transact SQL
                $this->db->transComplete();
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                $this->session->setFlashdata('gudang_toast', 'toastr.success("Penerimaan berhasil diproses !!");');

                return redirect()->to(base_url('gudang/penerimaan/data_beli_terima.php?id='.$id));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_sn(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $kode       = $this->input->getVar('filter_kode');
            
            $vtrMutasi  = new \App\Models\vtrMutasi();
            $sql_mutasi = $vtrMutasi->asObject()->where('tipe !=', '4')->where('status_hps', '0'); //->like('no_nota', (!empty($kode) ? $kode : ''))->orderBy('id', 'DESC');
            
            $jml_limit  = $this->Setting->jml_item;
            $ItemStokDet        = new \App\Models\mItemStokDet();
            // $sql_item_stok_det = $ItemStokDet->asObject()
            // ->select('tbl_m_item_stok_det.*, g.kode AS gudang_kode, g.gudang, i.kode AS item_kode, i.item, p.id')
            // ->join('tbl_m_gudang g', 'g.id = tbl_m_item_stok_det.id_gudang', 'left')
            // ->join('tbl_m_item i', 'i.id = tbl_m_item_stok_det.id_item', 'left')
            // ->join('tbl_trans_jual_kirim_sn p', 'p.id_item_stok_det = tbl_m_item_stok_det.id', 'left')
            // ->join('tbl_trans_mutasi_stok m', 'm.id_item_stok_det = tbl_m_item_stok_det.id', 'left')
            // ->orderBy('id_item_stok_det.id', 'DESC');

            $sql_item_stok_det = $ItemStokDet->asObject()
                ->select('
                    tbl_m_item_stok_det.*,
                    g.kode AS gudang_kode,
                    g.gudang,
                    i.kode AS item_kode,
                    i.item,
                    
                    -- Info dari transaksi penjualan (jika ada)
                    jual_sn.id_penjualan,
                    jual.no_nota AS no_nota_jual,
                    pelanggan_jual.nama AS nama_pelanggan_jual,
                    pelanggan_jual.kode AS kode_pelanggan_jual,

                    -- Info dari mutasi stok (jika ada)
                    mutasi_sn.id_mutasi,
                    mutasi.no_nota AS no_nota_mutasi,
                    pelanggan_mutasi.nama AS nama_pelanggan_mutasi,
                    pelanggan_mutasi.kode AS kode_pelanggan_mutasi
                ')
                ->join('tbl_m_gudang g', 'g.id = tbl_m_item_stok_det.id_gudang', 'left')
                ->join('tbl_m_item i', 'i.id = tbl_m_item_stok_det.id_item', 'left')

                // Join ke transaksi penjualan
                ->join('tbl_trans_jual_kirim_sn jual_sn', 'jual_sn.id_item_stok_det = tbl_m_item_stok_det.id', 'left')
                ->join('tbl_trans_jual jual', 'jual.id = jual_sn.id_penjualan', 'left')
                ->join('tbl_m_pelanggan pelanggan_jual', 'pelanggan_jual.id = jual.id_pelanggan', 'left')

                // Join ke transaksi mutasi
                ->join('tbl_trans_mutasi_stok mutasi_sn', 'mutasi_sn.id_item_stok_det = tbl_m_item_stok_det.id', 'left')
                ->join('tbl_trans_mutasi mutasi', 'mutasi.id = mutasi_sn.id_mutasi', 'left')
                ->join('tbl_m_pelanggan pelanggan_mutasi', 'pelanggan_mutasi.id = mutasi.id_pelanggan', 'left')

                ->orderBy('tbl_m_item_stok_det.id', 'DESC');

            if (!empty($kode)) {
                $sql_item_stok_det->like('tbl_m_item_stok_det.kode', $kode);
            }

            $data  = [
                'SQLItemDet'     => $sql_item_stok_det->paginate($jml_limit),
                'Pagination'    => $ItemStokDet->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_sn',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function set_sn_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('kode');
            
            return redirect()->to(base_url('gudang/stok/data_sn.php?'.(!empty($kode) ? 'filter_kode='.$kode : '')));
        }
    }
    
    # == MUTASI == #
    public function data_mutasi(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $kode       = $this->input->getVar('filter_nota');
            
            $vtrMutasi  = new \App\Models\vtrMutasi();
            $sql_mutasi = $vtrMutasi->asObject()->where('tipe !=', '4')->where('status_hps', '0'); //->like('no_nota', (!empty($kode) ? $kode : ''))->orderBy('id', 'DESC');
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLMutasi'     => $sql_mutasi->paginate($jml_limit),
                'Pagination'    => $vtrMutasi->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri_mutasi',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_mutasi',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_mutasi_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMts      = $this->input->getVar('id');
            $IDItem     = $this->input->getVar('id_item');
            
            $Plgn           = new \App\Models\mPelanggan();
            $Tipe           = new \App\Models\mTipe();
            $Gudang         = new \App\Models\mGudang();
            $Profile        = new \App\Models\PengaturanProfile();
            
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
            $sql_gudang     = $Gudang->asObject()->find();
            
            if(!empty($IDMts)){
                $Sat            = new \App\Models\mSatuan();
                $Item           = new \App\Models\mItem();
                $vtrMutasi      = new \App\Models\vtrMutasi();
                $MutasiDet      = new \App\Models\trMutasiDet();
                $ItemStokDet= new \App\Models\mItemStokDet();
                
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_item       = $Item->asObject()->where('id', $IDItem)->first();
                $sql_mut        = $vtrMutasi->asObject()->where('id', $IDMts)->first();
                $sql_mut_det    = $MutasiDet->asObject()->where('id_mutasi', $IDMts)->find();
                if(!empty($sql_mut)){
                    $sql_item_stock_det    = $ItemStokDet->asObject()->where('id_item', $IDItem)->where('id_gudang', $sql_mut->id_gd_asal);
                    if($sql_mut->tipe == 2){
                        // STOK MASUK BERARTI TAMPILKAN LIST SN YG STATUSNYA SUDAH TERPAKAI
                        $sql_item_stock_det = $sql_item_stock_det->where('status', '0');
                    }
                    if($sql_mut->tipe == 3){
                        // STOK KELUAR BERARTI TAMPILKAN LIST SN YANG STATUSNYA TERSEDIA
                        $sql_item_stock_det = $sql_item_stock_det->where('status', '1');
                    }

                    $sql_item_stock_det = $sql_item_stock_det->find();
                }
            }else{                
                $sql_sat        = '';
                $sql_item       = '';
                $sql_mut        = '';
                $sql_mut_det    = '';
                $sql_item_stock_det    = '';
            }
            
            $data  = [
                'SQLSatuan'     => $sql_sat,
                'SQLItem'       => $sql_item,
                'SQLItemStokDet'=> $sql_item_stock_det,
                'SQLMutasi'     => $sql_mut,
                'SQLMutasiDet'  => $sql_mut_det,
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'SQLGudang'     => $sql_gudang,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri_mutasi',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_mutasi_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_mutasi_det(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMts      = $this->input->getVar('id');
            $IDItem     = $this->input->getVar('id_item');
            
            $Plgn           = new \App\Models\mPelanggan();
            $Tipe           = new \App\Models\mTipe();
            $Gudang         = new \App\Models\mGudang();
            $Profile        = new \App\Models\PengaturanProfile();
            
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
            $sql_gudang     = $Gudang->asObject()->find();
            
            if(!empty($IDMts)){
                $Sat            = new \App\Models\mSatuan();
                $Item           = new \App\Models\mItem();
                $vtrMutasi      = new \App\Models\vtrMutasi();
                $MutasiDet      = new \App\Models\trMutasiDet();
                
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_item       = $Item->asObject()->where('id', $IDItem)->first();
                $sql_mut        = $vtrMutasi->asObject()->where('id', $IDMts)->first();
                $sql_mut_det    = $MutasiDet->asObject()->where('id_mutasi', $IDMts)->find();
            }else{                
                $sql_sat        = '';
                $sql_item       = '';
                $sql_mut        = '';
                $sql_mut_det    = '';
            }
            
            $data  = [
                'SQLSatuan'     => $sql_sat,
                'SQLItem'       => $sql_item,
                'SQLMutasi'     => $sql_mut,
                'SQLMutasiDet'  => $sql_mut_det,
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'SQLGudang'     => $sql_gudang,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri_mutasi',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_mutasi_det',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_mutasi_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $tipe       = $this->input->getVar('tipe');
            $gd_asal    = $this->input->getVar('gd_asal');
            $gd_7an     = $this->input->getVar('gd_7an');
            $idp        = $this->input->getVar('id_pelanggan');
            $plgn       = $this->input->getVar('pelanggan');
//            $sales      = $this->input->getVar('sales');
            $pers       = $this->input->getVar('perusahaan');
            $ket        = $this->input->getVar('keterangan');

            $Plgn       = new \App\Models\mPelanggan();
            $Mutasi     = new \App\Models\trMutasi();

            # Aturan validasi form tulis disini
            $aturan = [
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
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'tgl_masuk'     => $validasi->getError('tgl_masuk'),
                    'tipe'          => $validasi->getError('tipe')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'));
            }else{
                $sql_cek    = $Mutasi->asObject();
                $no_urut    = $sql_cek->where('tipe !=', '4')->countAllResults() + 1;
                $no_nota    = (!empty($this->Setting->kode_mts) ? $this->Setting->kode_mts : 'MTS').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id_user'       => $ID->id,
                    'id_gd_asal'    => $gd_asal,
                    'id_pelanggan'  => $idp,
                    'id_perusahaan' => $pers,
                    'tgl_masuk'     => tgl_indo_sys($tgl_msk),
                    'no_nota'       => $no_nota,
                    'tipe'          => $tipe,
                    'keterangan'    => $ket,
                    'status'        => '0',
                ];
                
                $Mutasi->save($data);
                $last_id = $Mutasi->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'.(!empty($last_id) ? '?id='.$last_id : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_mutasi_proses() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id_mts     = $this->input->getVar('id');
            $status     = $this->input->getVar('status');

            $Plgn       = new \App\Models\mPelanggan();
            $Mutasi     = new \App\Models\trMutasi();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'ID tidak boleh kosong',
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
                    'id'          => $validasi->getError('id')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'));
            }else{
                $sql_cek    = $Mutasi->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $no_nota    = (!empty($this->Setting->kode_mts) ? $this->Setting->kode_mts : 'MTS').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id'            => $id_mts,
                    'status'        => $status,
                ];
                
                $Mutasi->save($data);
                $last_id = $id_mts;

                if($last_id > 0){
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'.(!empty($last_id) ? '?id='.$last_id : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
       
    public function cart_mutasi_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id_mts     = $this->input->getVar('id_mutasi');
            $id_mts_det = $this->input->getVar('id_mutasi_det');
            $id_item    = $this->input->getVar('id_item');
            $item       = $this->input->getVar('item');
            $jml        = $this->input->getVar('jml');
            $satuan     = $this->input->getVar('satuan');
            $sn         = $this->input->getVar('sn');
            $ket        = $this->input->getVar('keterangan');
            $kode_sn_list = $this->request->getVar('kode_sn');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Mts        = new \App\Models\trMutasi();
            $MtsDet     = new \App\Models\trMutasiDet();
            $MtsStock   = new \App\Models\trMutasiStok();
            $ItemStokDet   = new \App\Models\mItemStokDet();

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
//                    'sn'        => $validasi->getError('harga'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'.(!empty($id_mts) ? '?id='.$id_mts : '')));
            }else{
                $sql_mts        = $Mts->asObject()->where('id', $id_mts)->first();
                $sql_item       = $Item->asObject()->where('id', $id_item)->first();
                $sql_sat        = $Satuan->asObject()->where('id', $satuan)->first();

                # Start Transact SQL
                $this->db->transBegin();

                $data = [
                    'id'            => $id_mts_det,
                    'id_mutasi'     => $id_mts,
                    'id_user'       => $ID->id,
                    'id_item'       => (!empty($sql_item->id) ? $sql_item->id : 0),
                    'id_item_kat'   => (!empty($sql_item->id_kategori) ? $sql_item->id_kategori : 0),
                    'id_satuan'     => (!empty($satuan) ? $satuan : 0),
                    'tgl_masuk'     => $sql_mts->tgl_masuk,
//                    'sn'            => $sn,
                    'kode'          => (!empty($sql_item->kode) ? $sql_item->kode : ''),
                    'item'          => $item,
                    'jml'           => (float)$jml,
                    'jml_satuan'    => (!empty($sql_sat->jml) ? (int)$sql_sat->jml : 1),
                    'satuan'        => (!empty($sql_sat->satuanBesar) ? $sql_sat->satuanBesar : ''),
                    'keterangan'    => $ket
                ];

                $MtsDet->save($data);
                $last_id = $MtsDet->insertID();
                // dd($last_id);

                // LOOPING DATA KODE SN DAN INSERT DATA DIBAWAH INI
                if (!empty($kode_sn_list) && is_array($kode_sn_list)) {
                    foreach ($kode_sn_list as $id_sn) {
                        // UPDATE status di item_stok_det
                        // Tentukan status update berdasarkan status mutasi
                        $status_stok = 1; // default
                        if ($sql_mts->tipe == 3) {
                            $status_stok = 0;
                        }

                        // UPDATE status SN di item_stok_det
                        $ItemStokDet->update($id_sn, [
                            'status' => $status_stok
                        ]);


                        $getSN = $ItemStokDet->asObject()->where('id', $id_sn)->first();

                        // INSERT ke mutasi stok
                        $MtsStock->save([
                            'id_user'       => $ID->id,
                            'id_mutasi'     => $id_mts,
                            'id_mutasi_det' => $last_id,
                            'id_item'       => (!empty($sql_item->id) ? $sql_item->id : 0),
                            'id_item_stok_det'   => $id_sn, // asumsinya ada kolom ini untuk relasi SN
                            'id_gd_asal'    => $sql_mts->id_gd_asal,
                            'id_gd_tujuan'  => $sql_mts->id_gd_tujuan,
                            'tgl_masuk'     => $sql_mts->tgl_simpan,
                            'tgl_simpan'    => $sql_mts->tgl_simpan,
                            'item'          => '',
                            'kode_sn'       => $getSN->kode,
                            'stok_awal'     => 1,
                            'jml'           => 1,
                            'stok_akhir'    => 1,
                            'keterangan'    => $status_stok == 0 ? 'STOK KELUAR' : 'STOK MASUK'
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
                
                    if ($id_mts_det == 0 && $last_id > 0) {
                        $this->session->setFlashdata('gudang_toast', 'toastr.success("Item berhasil disimpan !!");');
                    } else {
                        $this->session->setFlashdata('gudang_toast', 'toastr.success("Item berhasil diupdate !!");');
                    }
                }

                return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'.(!empty($id_mts) ? '?id='.$id_mts : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function cart_mutasi_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMts      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $MtsDet = new \App\Models\trMutasiDet();
                $MtsDet->where('id', $IDItm)->delete();
                
                $this->session->setFlashdata('gudang_toast', 'toastr.success("Item berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('gudang/mutasi/data_mutasi_tambah.php'.(!empty($IDMts) ? '?id='.$IDMts : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_mutasi_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('no_nota');
//            $nama   = $this->input->getVar('nama');
//            $tipe   = $this->input->getVar('tipe');
            
            return redirect()->to(base_url('gudang/mutasi/data_mutasi.php?'.(!empty($kode) ? 'filter_nota='.$kode : '')));
        }
    }
    
    public function pdf_mutasi_do(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDMts          = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            $IDItmDet       = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($IDMts)){            
                $Sat            = new \App\Models\mSatuan();
                $Item           = new \App\Models\mItem();
                $vtrMutasi      = new \App\Models\vtrMutasi();
                $MutasiDet      = new \App\Models\trMutasiDet();
                $Profile        = new \App\Models\PengaturanProfile();
                $Penjualan      = new \App\Models\trPenj();
                
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_mts        = $vtrMutasi->asObject()->where('id', $IDMts)->first();
                $sql_mts_det    = $MutasiDet->asObject()->where('id_mutasi', $IDMts)->find();
                $sql_profile    = $Profile->asObject()->where('id', $sql_mts->id_perusahaan)->first();
                $sql_penj       = $Penjualan->asObject()
                                    ->select('tbl_trans_jual.*, tbl_m_pelanggan.nama as nama_pelanggan')
                                    ->join('tbl_m_pelanggan', 'tbl_m_pelanggan.id = tbl_trans_jual.id_pelanggan', 'left')
                                    ->where('tbl_trans_jual.id', $sql_mts->id_penjualan)
                                    ->first();
            }else{                
                $sql_sat        = '';
                $sql_item       = '';
                $sql_mut        = '';
                $sql_mut_det    = '';
                $sql_profile    = '';
            }
            
            $logo       = FCPATH.'file/app/' . $sql_profile->logo_kop;
            $logo_wm    = FCPATH.'file/app/' . $sql_profile->logo_wm;
            
            $pdf = new FPDF('P', 'cm', array(21.5, 33));
                        
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
            if(!empty($sql_profile->logo_kop) && file_exists($logo)) {
                $pdf->Image($logo, 1, 1.8, 4, 1.8);
            }
            
            # Logo Watermark
            if(!empty($sql_profile->logo_wm) && file_exists($logo_wm)) {
                $pdf->Image($logo_wm, 2, 6, 15, 5);
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
            $pdf->Cell(4, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Telp', 'T', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', 'T', 0, 'C', $fill);
            $pdf->Cell(4.5, .5, $sql_profile->no_telp, 'T', 0, 'L', $fill);
            $pdf->Cell(2, .5, 'Tanggal', 'T', 0, 'L', $fill);
            $pdf->Cell(.1, .5, ':', 'T', 0, 'C', $fill);
            $pdf->Cell(6.4, .5, tgl_indo2($sql_mts->tgl_simpan), 'T', 0, '', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(4, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Fax', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(4.5, .5, $sql_profile->no_fax, '', 0, '', $fill);
            $pdf->Cell(2, .5, 'Nomor', '', 0, '', $fill);
            $pdf->Cell(.1, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(6.4, .5, $sql_mts->no_pengiriman, '', 0, '', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS','',9);
            $pdf->Cell(4, .5, '', 'B', 0, 'L', $fill);
            $pdf->Cell(1.5, .5, 'Petugas', 'B', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', 'B', 0, 'C', $fill);
            $pdf->Cell(4.5, .5, $sql_mts->user, 'B', 0, 'L', $fill);
            $pdf->Cell(2, .5, 'Kepada', 'B', 0, 'L', $fill);
            $pdf->Cell(.1, .5, ':', 'B', 0, 'C', $fill);
            $pdf->Cell(6.4, .5, $sql_penj->nama_pelanggan, 'B', 0, '', $fill);
            $pdf->Ln();
            $pdf->SetFont('TrebuchetMS', '', 10);
            $pdf->Cell(14.5, 1, $sql_mts->p_nama, 'B', 0, 'L', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(4.5, .5, $sql_mts->keterangan, '', 0, 'C', $fill);
            $pdf->Ln(.5);
            $pdf->Cell(14.5, .5, '', '', 0, 'C', $fill);
            $pdf->Cell(4.5, .5, '', 'B', 0, 'C', $fill);
            # ------------------------ END KOP -------------------------------------------
                        
            # ------------------------ HEADER --------------------------------------------
            $pdf->Ln(0.75);
            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(19, .5, 'SURAT JALAN', '', 0, 'C', $fill);
            $pdf->Ln(0.75);            
            # ------------------------ END HEADER ----------------------------------------
            #          
            # ------------------------ ISI -----------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(1, .5, 'NO', 'TB', 0, 'C', $fill);
            $pdf->Cell(15, .5, 'DESKRIPSI', 'TB', 0, 'L', $fill);
            $pdf->Cell(1, .5, 'JML', 'TB', 0, 'C', $fill);
            $pdf->Cell(2, .5, 'SATUAN', 'TB', 0, 'L', $fill);
            
            $pdf->SetTextColor(0,0,0);
            
            $pdf->Ln();
            
            $pdf->SetFont('TrebuchetMS', '', 9);
            $no     = 1;
            $subtot = 0;
            foreach ($sql_mts_det as $det){
                $pdf->Cell(1, .5, $no.'.', '', 0, 'C', $fill);
                $pdf->Cell(15, .5, $det->item, '', 0, 'L', $fill);
                $pdf->Cell(1, .5, (int)$det->jml, '', 0, 'C', $fill);
                $pdf->Cell(2, .5, $det->satuan, '', 0, 'L', $fill);
                $pdf->Ln();
                
                if(!empty($det->keterangan)){
                    $pdf->SetFont('TrebuchetMS-Italic', '', 9);
                    $pdf->Cell(1, .5, '', '', 0, 'C', $fill);
                    $pdf->Cell(18, .5, 'S/N :', '', 0, 'L', $fill);
                    $pdf->Ln();
                    $pdf->Cell(1, .5, '', '', 0, 'C', $fill);
                    $pdf->MultiCell(15, .5, (!empty($det->keterangan) ? $det->keterangan : ''), '0', 'L');
                    $pdf->Ln();
                }
            }
            
            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Ln(0.75);
            $pdf->Cell(3, .5, 'Dibuat Oleh', '', 0, 'C', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, 'Mengetahui', '', 0, 'C', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, 'Pengirim', '', 0, 'C', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, 'Penerima', '', 0, 'C', $fill);

            $pdf->SetFont('TrebuchetMS', '', 9);
            $pdf->Ln();
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, '', '', 0, 'C', $fill);
            $pdf->Ln();
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, '', '', 0, 'C', $fill);
            $pdf->Ln(1.5);

            $pdf->Cell(3, .5, '( ...................... )', 'B', 0, 'C', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, '( ...................... )', 'B', 0, 'C', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, '( ...................... )', 'B', 0, 'C', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, '( ...................... )', 'B', 0, 'C', $fill);
            $pdf->Ln();
            $pdf->Cell(3, .5, 'Tgl : ', '', 0, 'L', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, 'Tgl : ', '', 0, 'L', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, 'Tgl : ', '', 0, 'L', $fill);
            $pdf->Cell(2.33, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(3, .5, 'Tgl : ', '', 0, 'L', $fill);
            $pdf->Ln();
            
//            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
//            $pdf->Cell(5, .5, $this->ionAuth->user($sql_mts->id_user)->row()->first_name, '', 0, 'C', $fill);

            $this->response->setContentType('application/pdf');
            $pdf->Output('sj-'.$sql_mts->tgl_masuk.(isset($status) ? '-internal' : '').'.pdf', 'I');                   
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    

    # == PENGIRIMAN == #
    public function data_pengiriman(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $kode       = $this->input->getVar('filter_nota');
            
            $vtrMutasi  = new \App\Models\vtrMutasi();
            $sql_mutasi = $vtrMutasi->asObject()->where('tipe', '4')->where('status_hps', '0'); // ->like('no_nota', (!empty($kode) ? $kode : ''))->orderBy('id', 'DESC');
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLMutasi'     => $sql_mutasi->paginate($jml_limit),
                'Pagination'    => $vtrMutasi->pager->links('default', 'bootstrap_full'),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri_kirim',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_kirim',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_pengiriman_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMts      = $this->input->getVar('id');
            $IDItem     = $this->input->getVar('id_item');
            
            $Plgn           = new \App\Models\mPelanggan();
            $Tipe           = new \App\Models\mTipe();
            $Gudang         = new \App\Models\mGudang();
            $Profile        = new \App\Models\PengaturanProfile();
            
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
            $sql_gudang     = $Gudang->asObject()->find();
            
            if(!empty($IDMts)){
                $Sat            = new \App\Models\mSatuan();
                $Item           = new \App\Models\mItem();
                $vtrMutasi      = new \App\Models\vtrMutasi();
                $MutasiDet      = new \App\Models\trMutasiDet();
                $vtrPenj        = new \App\Models\vtrPenj();
                $PenjDet        = new \App\Models\trPenjDet();
                
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_item       = $Item->asObject()->where('id', $IDItem)->first();
                $sql_mut        = $vtrMutasi->asObject()->where('id', $IDMts)->first();
                $sql_mut_det    = $MutasiDet->asObject()->where('id_mutasi', $IDMts)->find();
                $sql_penj       = $vtrPenj->asObject()->where('id', $sql_mut->id_penjualan)->first();
                $sql_penj_det   = $PenjDet->asObject()->where('id_penjualan', $sql_mut->id_penjualan)->where('status', '1')->find();
            }else{                
                $sql_sat        = '';
                $sql_item       = '';
                $sql_mut        = '';
                $sql_mut_det    = '';
                $sql_penj       = '';
                $sql_penj_det   = '';
            }
            
            $data  = [
                'SQLSatuan'     => $sql_sat,
                'SQLItem'       => $sql_item,
                'SQLMutasi'     => $sql_mut,
                'SQLMutasiDet'  => $sql_mut_det,
                'SQLPenj'       => $sql_penj,
                'SQLPenjDet'    => $sql_penj_det,
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'SQLGudang'     => $sql_gudang,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri_kirim',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_kirim_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function data_pengiriman_det(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMts      = $this->input->getVar('id');
            $IDItem     = $this->input->getVar('id_item');
            
            $Plgn           = new \App\Models\mPelanggan();
            $Tipe           = new \App\Models\mTipe();
            $Gudang         = new \App\Models\mGudang();
            $Profile        = new \App\Models\PengaturanProfile();
            
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            $sql_tipe       = $Tipe->asObject()->where('status', '1')->find();
            $sql_gudang     = $Gudang->asObject()->find();
            
            if(!empty($IDMts)){
                $Sat            = new \App\Models\mSatuan();
                $Item           = new \App\Models\mItem();
                $vtrMutasi      = new \App\Models\vtrMutasi();
                $MutasiDet      = new \App\Models\trMutasiDet();
                
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_item       = $Item->asObject()->where('id', $IDItem)->first();
                $sql_mut        = $vtrMutasi->asObject()->where('id', $IDMts)->first();
                $sql_mut_det    = $MutasiDet->asObject()->where('id_mutasi', $IDMts)->find();
            }else{                
                $sql_sat        = '';
                $sql_item       = '';
                $sql_mut        = '';
                $sql_mut_det    = '';
            }
            
            $data  = [
                'SQLSatuan'     => $sql_sat,
                'SQLItem'       => $sql_item,
                'SQLMutasi'     => $sql_mut,
                'SQLMutasiDet'  => $sql_mut_det,
                'SQLUsers'      => $this->ionAuth->users('sales')->result(),
                'SQLProfile'    => $sql_profile,
                'SQLGudang'     => $sql_gudang,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/gudang/menu_kiri_kirim',
                'konten'        => $this->ThemePath.'/manajemen/gudang/data_kirim_det',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_pengiriman_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi       = \Config\Services::validation();

            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();

            $id_mts         = $this->input->getVar('id');
            $tgl_msk        = $this->input->getVar('tgl_masuk');
            $tipe           = $this->input->getVar('tipe');
            $gd_asal        = $this->input->getVar('gd_asal');
            $gd_7an         = $this->input->getVar('gd_7an');
            $id_penj        = $this->input->getVar('id_penjualan');
            $plgn           = $this->input->getVar('pelanggan');
//            $sales      = $this->input->getVar('sales');
            $pers           = $this->input->getVar('perusahaan');
            $ket            = $this->input->getVar('keterangan');
            $status         = $this->input->getVar('status');
            $rute           = $this->input->getVar('route');
            $no_pengiriman  = $this->input->getVar('no_pengiriman');

            $Item           = new \App\Models\mItem();
            $Satuan         = new \App\Models\mSatuan();
            $Plgn           = new \App\Models\mPelanggan();
            $Gudang         = new \App\Models\mGudang();
            $Mutasi         = new \App\Models\trMutasi();
            $MutasiDet      = new \App\Models\trMutasiDet();
            $Penjualan      = new \App\Models\vtrPenj();
            $PenjualanDet   = new \App\Models\trPenjDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'tgl_masuk'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'Tanggal tidak boleh kosong',
                    ]
                ]
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'tgl_masuk'     => $validasi->getError('tgl_masuk'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('transaksi/data_penjualan_aksi.php?id='.$id_penj.'&status='.$status));
            }else{
                $sql_gdg        = $Gudang->asObject()->where('status', '1')->first();
                $sql_penj       = $Penjualan->asObject()->where('id', $id_penj)->first();
                $sql_penj_det   = $PenjualanDet->asObject()->where('id_penjualan', $id_penj)->where('status', '1')->find();
                $sql_cek        = $Mutasi->asObject();
                $no_urut        = $sql_cek->where('tipe', '4')->countAllResults() + 1;
                $no_nota        = (!empty($this->Setting->kode_do) ? $this->Setting->kode_do : 'DO').'-'.sprintf('%05d', $no_urut);
                
                # Start Transact SQL
                $this->db->transBegin();
                
                $data = [
                    'id'            => $id_mts,
                    'id_user'       => $ID->id,
                    'id_gd_asal'    => $sql_gdg->id,
                    'id_penjualan'  => $sql_penj->id,
                    'id_sales'      => $sql_penj->id_sales,
                    'id_pelanggan'  => $sql_penj->id_pelanggan,
                    'id_perusahaan' => $pers,
                    'tgl_masuk'     => tgl_indo_sys2($tgl_msk),
                    'no_nota'       => $no_nota,
                    'tipe'          => '4',
                    'keterangan'    => $ket,
                    'status'        => (!empty($id_penj) ? '1' : '0'),
                    'no_pengiriman' => $no_pengiriman
                ];
                
                $Mutasi->save($data);
                $last_id = (!empty($id_mts) ? $id_mts : $Mutasi->insertID());
                                
//                # Simpan detail barang yang dikirim ke tabel
//                if(!empty($id_penj) AND empty($id_mts)){
//                    foreach ($sql_penj_det as $det){
//                        $sql_item       = $Item->asObject()->where('id', $det->id_item)->first();
//                        $sql_sat        = $Satuan->asObject()->where('id', $det->id_item_sat)->first();
//                        
//                        $data_kirim = [
//                            'id_mutasi'         => $last_id,
//                            'id_user'           => $ID->id,
//                            'id_item'           => (!empty($sql_item->id) ? $sql_item->id : 0),
//                            'id_item_kat'       => (!empty($sql_item->id_kategori) ? $sql_item->id_kategori : 0),
//                            'id_penjualan_det'  => $det->id,
//                            'id_satuan'         => $det->id_item_sat,
//                            'tgl_masuk'         => tgl_indo_sys($tgl_msk),
//                            'kode'              => (!empty($sql_item->kode) ? $sql_item->kode : ''),
//                            'item'              => $det->item,
//                            'jml_satuan'        => (!empty($sql_sat->jml) ? (int)$sql_sat->jml : 1),
//                            'satuan'            => (!empty($sql_sat->satuanBesar) ? $sql_sat->satuanBesar : ''),
//                        ];
//                        
//                        # Simpan ke tabel detail mutasi
//                        $MutasiDet->save($data_kirim);
//                    }
//                }
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                if($last_id > 0){
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Permintaan pengiriman berhasil dibuat !!");');
                }

                if(!empty($rute)){
                    return redirect()->to(base_url($rute));
                }else{
                    return redirect()->to(base_url('gudang/pengiriman/data_kirim_tambah.php'.(!empty($last_id) ? '?id='.$last_id : '')));
                }
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_pengiriman_proses() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();

            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id_mts     = $this->input->getVar('id');
            $status     = $this->input->getVar('status');

            $Plgn       = new \App\Models\mPelanggan();
            $Mutasi     = new \App\Models\trMutasi();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'ID tidak boleh kosong',
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
                    'id'          => $validasi->getError('id')
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/pengiriman/data_kirim_tambah.php'));
            }else{
                $sql_cek    = $Mutasi->asObject();
                $no_urut    = $sql_cek->countAll() + 1;
                $no_nota    = (!empty($this->Setting->kode_mts) ? $this->Setting->kode_mts : 'MTS').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id'            => $id_mts,
                    'status'        => $status,
                ];
                
                $Mutasi->save($data);
                $last_id = $id_mts;

                if($last_id > 0){
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('gudang/pengiriman/data_kirim_tambah.php'.(!empty($last_id) ? '?id='.$last_id : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pengiriman_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDMts      = $this->input->getVar('id');
            $IDPenj     = $this->input->getVar('id_penj');
            $status     = $this->input->getVar('status');
            $rute       = $this->input->getVar('route');
            
            if($this->input->is('get') == 1){
                $Mts = new \App\Models\trMutasi();
                $Mts->where('id', $IDMts)->delete();
                
                $this->session->setFlashdata('gudang_toast', 'toastr.success("DO berhasil dihapus !!");');
            }
            
            if (!empty($rute)) {
                return redirect()->to(base_url($rute.(!empty($IDPenj) ? '?id='.$IDPenj.'&status='.$status : '')));
            } else {
                return redirect()->to(base_url('gudang/pengiriman/data_kirim.php'));
            }         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
       
    public function cart_pengiriman_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id_mts     = $this->input->getVar('id_mutasi');
            $id_mts_det = $this->input->getVar('id_mutasi_det');
            $id_item    = $this->input->getVar('id_item');
            $id_penj_dt = $this->input->getVar('id_penj_det');
            $item       = $this->input->getVar('item');
            $jml        = $this->input->getVar('jml');
            $satuan     = $this->input->getVar('satuan');
            $sn         = $this->input->getVar('sn');
            $ket        = $this->input->getVar('keterangan');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Mts        = new \App\Models\trMutasi();
            $MtsDet     = new \App\Models\trMutasiDet();

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
//                    'sn'        => $validasi->getError('harga'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('gudang/pengiriman/data_pengiriman_tambah.php'.(!empty($id_mts) ? '?id='.$id_mts : '')));
            }else{
                $sql_mts        = $Mts->asObject()->where('id', $id_mts)->first();
                $sql_item       = $Item->asObject()->where('id', $id_item)->first();
                $sql_sat        = $Satuan->asObject()->where('id', $satuan)->first();

                $data = [
                    'id'                => $id_mts_det,
                    'id_mutasi'         => $id_mts,
                    'id_user'           => $ID->id,
                    'id_item'           => (!empty($sql_item->id) ? $sql_item->id : 0),
                    'id_item_kat'       => (!empty($sql_item->id_kategori) ? $sql_item->id_kategori : 0),
                    'id_penjualan_det'  => $id_penj_dt,
                    'id_satuan'         => (!empty($satuan) ? $satuan : 0),
                    'tgl_masuk'         => $sql_mts->tgl_masuk,
                    'sn'                => $sn,
                    'kode'              => (!empty($sql_item->kode) ? $sql_item->kode : ''),
                    'item'              => $item,
                    'jml'               => (float)$jml,
                    'jml_satuan'        => (!empty($sql_sat->jml) ? (int)$sql_sat->jml : 1),
                    'satuan'            => (!empty($sql_sat->satuanBesar) ? $sql_sat->satuanBesar : ''),
                    'keterangan'        => $ket
                ];

                $MtsDet->save($data);
                $last_id = $MtsDet->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Item berhasil disimpan !!");');
                }else{
                    $this->session->setFlashdata('gudang_toast', 'toastr.success("Item berhasil diupdate !!");');
                }

                return redirect()->to(base_url('gudang/pengiriman/data_kirim_tambah.php'.(!empty($id_mts) ? '?id='.$id_mts : '')));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    
    public function json_pelanggan(){
        if ($this->ionAuth->loggedIn()) {
            $Term       = $this->input->getVar('term');
            
            $Plgn       = new \App\Models\mPelanggan();
            $sql_plgn   = $Plgn->asObject()->where('status', '1')->like('nama', (!empty($Term) ? $Term : ''))->find();
            
            foreach ($sql_plgn as $plgn){
                $data[] = [
                    'id'    => $plgn->id,
                    'kode'  => $plgn->kode,
                    'nama'  => (!empty($plgn->kode) ? '['.$plgn->kode.'] ' : '').$plgn->nama,
                ];
            }

            return response()->setContentType('application/json')                             
                             ->setStatusCode(200)
                             ->setJSON($data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
}
