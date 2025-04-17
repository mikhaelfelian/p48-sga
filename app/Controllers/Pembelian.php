<?php

namespace App\Controllers;

use App\Models\PengaturanProfile;
use App\Models\mTipe;
use App\Models\trPembelianPlat;
use App\Models\mPlatform;

use FPDF;

/**
 * Description of Pembelian
 *
 * @author mike
 */
class Pembelian extends BaseController {

    public function index(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $vtrPsn     = new \App\Models\vtrPO();
            $vtrBeli    = new \App\Models\vtrPembelian();
            $sql_psn_br = $vtrPsn->asObject()->where('status_fkt', '0');
            $sql_psn_pr = $vtrPsn->asObject()->where('status_fkt', '1');
            $sql_bli_br = $vtrBeli->asObject()->where('status', '0');
            $sql_bli_pr = $vtrBeli->asObject()->where('status', '1');
            
            $data  = [
                'SQLPsnBaru'    => $sql_psn_pr->countAllResults(),
                'SQLPsnPros'    => $sql_psn_pr->countAllResults(),
                'SQLBeliBaru'   => $sql_bli_pr->countAllResults(),
                'SQLBeliPros'   => $sql_bli_pr->countAllResults(),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/konten',
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
            $nama       = $this->input->getVar('filter_nama');
            $status     = $this->input->getVar('filter_status');
            $hlmn       = $this->input->getVar('page');
            
            $vtrPsn     = new \App\Models\vtrPO();
            $sql_psn    = $vtrPsn->asObject()->like('status_fkt', (isset($status) ? $status : ''))->like('supplier', (!empty($nama) ? $nama : ''))->orderBy('id', 'DESC');
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLPsn'        => $sql_psn->paginate($jml_limit),
                'Pagination'    => $vtrPsn->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pesanan',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pesanan',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_pesanan_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $IDPsn          = $this->input->getVar('id');
            $IDItm          = $this->input->getVar('id_item');
            
            $Profile        = new \App\Models\PengaturanProfile();
            $sql_profile    = $Profile->asObject()->where('status', '1')->find();
            
            if(!empty($IDPsn)){
                $Pes            = new \App\Models\trPO();
                $PesDet         = new \App\Models\trPODet();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Supp           = new \App\Models\mSupplier();
            
                $sql_psn        = $Pes->asObject()->where('id', $IDPsn)->first();
                $sql_psn_det    = $PesDet->asObject()->where('id_pembelian', $IDPsn)->find();
                $sql_psn_det_rw = $PesDet->asObject()->where('id', $IDItm)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_supp       = $Supp->asObject()->where('id', $sql_psn->id_supplier)->first();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_supp       = '';
            }
                        
            $data  = [
                'SQLPsn'        => $sql_psn,
                'SQLPsnDet'     => $sql_psn_det,
                'SQLPsnDetRw'   => $sql_psn_det_rw,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLSupp'       => $sql_supp,
                'SQLProfile'    => $sql_profile,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pesanan',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pesanan_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_pesanan_detail(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPsn      = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            
            if(!empty($IDPsn)){
                $Pes            = new \App\Models\vtrPO();
                $PesDet         = new \App\Models\trPODet();
                $Beli           = new \App\Models\trPembelian();
                $Itm            = new \App\Models\vItem();
                $Sat            = new \App\Models\mSatuan;
                $Supp           = new \App\Models\mSupplier();
                $sql_psn        = $Pes->asObject()->where('id', $IDPsn)->first();
                $sql_psn_det    = $PesDet->asObject()->where('id_pembelian', $IDPsn)->find();
                $sql_psn_det_rw = $PesDet->asObject()->where('id', $IDItm)->first();
                $sql_beli       = $Beli->asObject()->where('id_po', $sql_psn->id)->first();
                $sql_item       = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat        = $Sat->asObject()->where('status', '1')->find();
                $sql_supp       = $Supp->asObject()->where('id', $sql_psn->id_supplier)->first();
            }else{
                $sql_psn        = '';
                $sql_psn_det    = '';
                $sql_psn_det_rw = '';
                $sql_beli       = '';
                $sql_item       = '';
                $sql_sat        = '';
                $sql_supp       = '';
            }
                        
            $data  = [
                'SQLPsn'        => $sql_psn,
                'SQLPsnDet'     => $sql_psn_det,
                'SQLPsnDetRw'   => $sql_psn_det_rw,
                'SQLBeli'       => $sql_beli,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLSupp'       => $sql_supp,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pesanan',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pesanan_detail',
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

            $ids        = $this->input->getVar('id_supplier');
            $idrab      = $this->input->getVar('id_rab');
            $idp        = $this->input->getVar('perusahaan');
            $supp       = $this->input->getVar('supplier');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');

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

                return redirect()->to(base_url('pembelian/pesanan/data_pesanan_tambah.php'));
            }else{
                $sql_cek        = $PO->asObject();
                $sql_supp       = $Supp->asObject()->where('id', $ids)->first();
                $sql_rab        = $Rab->asObject()->where('id', $idrab)->first();
                $sql_rab_det    = $RabDet->asObject()->where('id_rab', $idrab)->where('status', '1')->find();
                $no_urut        = $sql_cek->countAll() + 1;
                $no_nota        = (!empty($this->Setting->kode_po) ? $this->Setting->kode_po : 'PO').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id_user'       => $ID->id,
                    'id_perusahaan' => $idp,
                    'id_supplier'   => $ids,
                    'id_rab'        => $idrab,
                    'tgl_masuk'     => tgl_indo_sys2($tgl_msk),
                    'no_po'         => $no_nota,
                    'supplier'      => $sql_supp->nama,
                    'keterangan'    => $ket,
                    'status_nota'   => '0',
                ];

                $PO->save($data);
                $last_id = $PO->insertID();
                
                # Cek isi rab pastikan ga kosong
                foreach ($sql_rab_det as $det){
                    $data_po = [
                        'id_pembelian'      => $last_id,
                        'id_satuan'         => $det->id_satuan,
                        'id_user'           => $ID->id,
                        'id_item'           => $det->id_item,
                        'kode'              => $det->kode,
                        'item'              => $det->item,
                        'jml'               => (int)$det->jml,
                        'jml_satuan'        => (int)$det->jml_satuan,
                        'satuan'            => $det->satuan,
                        'status'            => '0',
                    ];
                    
                    $PODet->save($data_po);
                }

                if($last_id > 0){
                    $this->session->setFlashdata('pembelian_toast', 'toastr.success("Transaksi berhasil disimpan !!");');
                }

                return redirect()->to(base_url('pembelian/pesanan/data_pesanan_tambah.php?id='.$last_id));
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

            $id         = $this->input->getVar('id');
            $idp        = $this->input->getVar('id_supplier');
            $supp       = $this->input->getVar('supplier');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $ket        = $this->input->getVar('keterangan');
            $status     = $this->input->getVar('status');

            $Supp       = new \App\Models\mSupplier();
            $PO         = new \App\Models\trPO();

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

                return redirect()->to(base_url('pembelian/pesanan/data_pesanan_tambah.php'));
            }else{
                $sql_cek    = $PO->asObject();
                $sql_supp   = $Supp->asObject()->where('id', $idp)->first();
                $no_urut    = $sql_cek->countAll() + 1;
                $no_nota    = (!empty($this->Setting->kode_po) ? $this->Setting->kode_po : 'PO').'-'.sprintf('%05d', $no_urut);
                
                $data = [
                    'id'            => $id,
                    'status_nota'   => '1',
                ];

                $PO->save($data);

                $this->session->setFlashdata('pembelian_toast', 'toastr.success("Transaksi berhasil diproses !!");');

                return redirect()->to(base_url('pembelian/pesanan/data_pesanan.php'));
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
            $iditem     = $this->input->getVar('id_item');
            $item       = $this->input->getVar('item');
            $jml        = $this->input->getVar('jml');
            $satuan     = $this->input->getVar('satuan');
            $harga      = $this->input->getVar('harga');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $PO         = new \App\Models\trPO();
            $PODet      = new \App\Models\trPODet();

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
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_pesanan' => $validasi->getError('id_pesanan'),
                    'item'       => $validasi->getError('item'),
                    'jml'        => $validasi->getError('jml'),
                    'satuan'     => $validasi->getError('satuan'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('pembelian/pesanan/data_pesanan_tambah.php'.(!empty($idpsn) ? '?id='.$idpsn : '').(!empty($iditem) ? '&id_item='.$iditem : '')));
            }else{
                $sql_item   = $Item->asObject()->where('id', $iditem)->first();
                $sql_sat    = $Satuan->asObject()->where('id', $satuan)->first();
                                
                $data = [
                    'id'                => $idpsndet,
                    'id_pembelian'      => $idpsn,
                    'id_satuan'         => $satuan,
                    'id_user'           => $ID->id,
                    'id_item'           => $sql_item->id,
                    'kode'              => $sql_item->kode,
                    'item'              => $item,
                    'jml'               => (int)$jml,
                    'jml_satuan'        => (int)$sql_sat->jml,
                    'satuan'            => $sql_sat->satuanBesar,
                    'status'            => '0',
                ];

                $PODet->save($data);
                $last_id = $PODet->insertID();

                if($last_id > 0){
                    $this->session->setFlashdata('pembelian_toast', 'toastr.success("Pesanan berhasil disimpan !!");');
                }

                return redirect()->to(base_url('pembelian/pesanan/data_pesanan_tambah.php?id='.$idpsn));
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
                $PsnDet = new \App\Models\trPODet();
                $PsnDet->where('id', $IDItm)->delete();
                
                $this->session->setFlashdata('pembelian_toast', 'toastr.success("Item berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('/pembelian/pesanan/data_pesanan_tambah.php'.(!empty($IDPsn) ? '?id='.$IDPsn : '')));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    public function set_pesanan_hapus(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDPO       = $this->input->getVar('id');
            $IDItm      = $this->input->getVar('id_item');
            $Hal        = $this->input->getVar('page');
            
            if($this->input->is('get') == 1){
                $PO = new \App\Models\trPO();
                
                $data = ['id'=>$IDPO,'status_hps'=>'1'];
                $PO->save($data);
                
                $this->session->setFlashdata('pembelian_toast', 'toastr.success("PO berhasil dihapus !!");');
            }
            
            return redirect()->to(base_url('pembelian/pesanan/data_pesanan.php'));         
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function pdf_pesanan(){
        if ($this->ionAuth->loggedIn()) {
            $ID             = $this->ionAuth->user()->row();
            $IDGrup         = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup      = $this->ionAuth->groups()->result();
            
            $id             = $this->input->getVar('id');
            $id_itm         = $this->input->getVar('id_item');
            $id_itm_det     = $this->input->getVar('id_item_det');
            $status         = $this->input->getVar('status');
            
            if(!empty($id)){
                $PO             = new \App\Models\vtrPO();
                $PODet          = new \App\Models\trPODet();
                $Profile        = new \App\Models\PengaturanProfile();

                $sql_po         = $PO->asObject()->where('id', $id)->first();
                $sql_po_det     = $PODet->asObject()->where('id_pembelian', $id)->find();
                $sql_profile    = $Profile->asObject()->where('id', $sql_po->id_perusahaan)->first();             
            }else{
                $sql_po         = '';
                $sql_po_det     = '';
                $sql_profile    = '';
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
               $pdf->Image($logo,1,1.5,5,2);
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
            $pdf->Cell(16.5, .5, $sql_po->no_po, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(2, .5, 'Tanggal', '', 0, 'L', $fill);
            $pdf->Cell(.5, .5, ':', '', 0, 'C', $fill);
            $pdf->Cell(16.5, .5, tgl_indo2($sql_po->tgl_masuk), '', 0, 'L', $fill);
            $pdf->Ln(1);            
            # ------------------------ END HEADER ----------------------------------------
            
            # ------------------------ PEMBUKAAN ----------------------------------------- 
            $pdf->Cell(2, .5, 'Kepada Yth :', '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->Cell(19, .5, $sql_po->supplier, '', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->MultiCell(7, .5, $sql_po->alamat, '', 'L', $fill);
            $pdf->Ln();
            # ------------------------ END PEMBUKAAN -------------------------------------
            
            # ------------------------ ISI -----------------------------------------------
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(1, .5, 'NO', 'TB', 0, 'C', $fill);
            $pdf->Cell(10, .5, 'DESKRIPSI', 'TB', 0, 'L', $fill);
            $pdf->Cell(1, .5, 'JML', 'TB', 0, 'C', $fill);
            $pdf->Cell(2, .5, 'SATUAN', 'TB', 0, 'L', $fill);
            $pdf->Cell(2.5, .5, 'HARGA', 'TB', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, 'SUBTOTAL', 'TB', 0, 'R', $fill);            
            $pdf->Ln();
            
            $pdf->SetFont('TrebuchetMS', '', 9);
            $no     = 1;
            $subtot = 0;
            foreach ($sql_po_det as $det){
                $subtot = $subtot + $det->subtotal;
                
                $pdf->Cell(1, .5, $no.'.', '', 0, 'C', $fill);
                $pdf->Cell(10, .5, $det->item, '', 0, 'L', $fill);
                $pdf->Cell(1, .5, (int)$det->jml, '', 0, 'C', $fill);
                $pdf->Cell(2, .5, $det->satuan, '', 0, 'L', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->harga), '', 0, 'R', $fill);
                $pdf->Cell(2.5, .5, format_angka($det->subtotal), '', 0, 'R', $fill);                
                $pdf->Ln();
                
                $no++;
            }
            
            $gtotal = $subtot;
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(16.5, .5, 'SUBTOTAL', 'T', 0, 'R', $fill);
            $pdf->Cell(2.5, .5, format_angka($subtot), 'T', 0, 'R', $fill);
            $pdf->Ln();
            
            # ------------------ TTD -------------------------------------------
            $pdf->Cell(19, .5, 'Demikian surat pesanan ini kami buat, atas pehatiannya kami ucapkan terima kasih.', '', 0, 'L', $fill);
            $pdf->Ln(1);
            
            $pdf->Cell(14, .5, '', '', 0, 'L', $fill);
            $pdf->Cell(5, .5, 'Hormat Kami', '', 0, 'C', $fill);
            $pdf->Ln(2.5);
            $pdf->Cell(14, .5, '', '', 0, 'R', $fill);
            $pdf->SetFont('TrebuchetMS-Bold', '', 9);
            $pdf->Cell(5, .5, $sql_profile->nama, '', 0, 'C', $fill);  
            
            $this->response->setContentType('application/pdf');
            $pdf->Output('po-'.$sql_po->tgl_masuk.(isset($status) ? '-internal' : '').'.pdf', 'I');                   
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
    
    

    public function data_pembelian(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $vtrBeli    = new \App\Models\vtrPembelian();
            $sql_beli   = $vtrBeli->asObject()->orderBy('id', 'DESC');
            
            // Apply filters from search form
            $no_pi = $this->request->getGet('no_pi');
            $supplier = $this->request->getGet('supplier');
            $status_bayar = $this->request->getGet('status_bayar');
            
            if (!empty($no_pi)) {
                $sql_beli->like('no_nota', $no_pi);
            }
            
            if (!empty($supplier)) {
                $sql_beli->like('supplier', $supplier);
            }
            
            if ($status_bayar !== '' && $status_bayar !== null) {
                $sql_beli->where('status_bayar', $status_bayar);
            }
            
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLBeli'       => $sql_beli->paginate($jml_limit),
                'Pagination'    => $vtrBeli->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pembelian',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pembelian',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_pembelian_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDBeli     = $this->input->getVar('id');
            $IDSupp     = $this->input->getVar('id_supplier');
            $IDItm      = $this->input->getVar('id_item');
            $IDItmDet   = $this->input->getVar('id_item_det');
            
            $Supp       = new \App\Models\mSupplier();
            $Profile    = new \App\Models\PengaturanProfile();
            $Beli       = new \App\Models\vtrPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
                
            $sql_beli   = $Beli->asObject()->where('id', $IDBeli)->first();
            $sql_profile= $Profile->asObject()->where('status', '1')->find();
            $sql_supp   = $Supp->asObject()->where('id', (isset($_GET['id_supplier']) ? $IDSupp : (!empty($sql_beli->id_supplier) ? $sql_beli->id_supplier : '0')))->first();
            
            if(!empty($IDBeli)){
                $Itm                = new \App\Models\vItem();
                $Sat                = new \App\Models\mSatuan;
                $sql_beli_det       = $BeliDet->asObject()->where('id_pembelian', $IDBeli)->find();
                $sql_beli_det_rw    = $BeliDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item           = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat            = $Sat->asObject()->where('status', '1')->find();
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
                'SQLProfile'    => $sql_profile,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pembelian',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pembelian_tambah',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function data_pembelian_detail(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDBeli     = $this->input->getVar('id');
            $IDSupp     = $this->input->getVar('id_supplier');
            $IDItm      = $this->input->getVar('id_item');
            $IDItmDet   = $this->input->getVar('id_item_det');
            
            $Supp       = new \App\Models\mSupplier();
            $PO         = new \App\Models\vtrPO();
            $Beli       = new \App\Models\vtrPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
                
            $sql_beli   = $Beli->asObject()->where('id', $IDBeli)->first();
            $sql_po     = $PO->asObject()->where('id', $sql_beli->id_po)->first();
            $sql_supp   = $Supp->asObject()->where('id', (isset($_GET['id_supplier']) ? $IDSupp : (!empty($sql_beli->id_supplier) ? $sql_beli->id_supplier : '0')))->first();
            
            if(!empty($IDBeli)){
                $Itm                = new \App\Models\vItem();
                $Sat                = new \App\Models\mSatuan;
                $sql_beli_det       = $BeliDet->asObject()->where('id_pembelian', $IDBeli)->find();
                $sql_beli_det_rw    = $BeliDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item           = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat            = $Sat->asObject()->where('status', '1')->find();
            }else{
                $sql_beli           = '';
                $sql_beli_det       = '';
                $sql_beli_det_rw    = '';
                $sql_item           = '';
                $sql_sat            = '';
            }
                        
            $data  = [
                'SQLPsn'        => $sql_po,
                'SQLBeli'       => $sql_beli,
                'SQLBeliDet'    => $sql_beli_det,
                'SQLBeliDetRw'  => $sql_beli_det_rw,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLSupp'       => $sql_supp,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pembelian',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pembelian_detail',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_pembelian_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $idp        = $this->input->getVar('id_supplier');
            $idpo       = $this->input->getVar('id_po');
            $pers       = $this->input->getVar('perusahaan');
            $supp       = $this->input->getVar('supplier');
            $no_nota    = $this->input->getVar('no_nota');
            $tgl_msk    = $this->input->getVar('tgl_masuk');
            $tgl_klr    = $this->input->getVar('tgl_keluar');
            $ket        = $this->input->getVar('keterangan');
            $status_ppn = $this->input->getVar('status_ppn');
            
            $Supp       = new \App\Models\mSupplier();
            $PO         = new \App\Models\trPO();
            $PODet      = new \App\Models\trPODet();
            $Beli       = new \App\Models\trPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();

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
                'no_nota'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'No Faktur tidak boleh kosong',
                    ]
                ],
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'supplier'  => $validasi->getError('id_supplier'),
                    'tgl_masuk' => $validasi->getError('tgl_masuk'),
                    'no_nota'   => $validasi->getError('no_nota'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('pembelian/faktur/data_pembelian_tambah.php'));
            }else{
                $sql_supp   = $Supp->asObject()->where('id', $idp)->first();
                
                # Start Transact SQL
                $this->db->transBegin();
                
                // Get PO data if idpo is provided
                $po_no_nota = '';
                if (!empty($idpo)) {
                    $sql_po = $PO->asObject()->where('id', $idpo)->first();
                    if (!empty($sql_po)) {
                        $po_no_nota = $sql_po->no_nota;
                    }
                }
                
                $data = [
                    'id'            => $id,
                    'id_user'       => $ID->id,
                    'id_supplier'   => $idp,
                    'id_po'         => (!empty($idpo) ? $idpo : 0),
                    'id_perusahaan' => $pers,
                    'tgl_masuk'     => tgl_indo_sys($tgl_msk),
                    'tgl_keluar'    => tgl_indo_sys($tgl_klr),
                    'no_nota'       => $no_nota,
                    'no_po'         => $po_no_nota,
                    'supplier'      => $sql_supp->nama,
                    'status'        => '0',
                    'status_ppn'    => $status_ppn,
                ];

                # Simpan ke tabel pembelian
                $Beli->save($data);
                $last_id = (!empty($id) ? $id : $Beli->insertID());               
      
                # Cek apakah faktur ini ada PO atau tidak
                if(!empty($idpo)){
                    $sql_po     = $PO->asObject()->where('id', $idpo)->first();
                    $sql_po_det = $PODet->asObject()->where('id_pembelian', $sql_po->id)->find();
                    
                    # Pindahkan isi PO ke tabel detail faktur
                    foreach ($sql_po_det as $po_det){                    
                        $data_pemb_det = [
                            'id_pembelian'      => $last_id,
                            'id_satuan'         => $po_det->id_satuan,
                            'id_user'           => $po_det->id_user,
                            'id_item'           => $po_det->id_item,
                            'kode'              => $po_det->kode,
                            'item'              => $po_det->item,
                            'jml'               => (int)$po_det->jml,
                            'jml_satuan'        => (int)$po_det->jml_satuan,
                            'harga'             => (float)$po_det->harga,
                            'subtotal'          => (float)$po_det->subtotal,
                            'satuan'            => $po_det->satuan,
                            'status_ppn'        => $po_det->status_ppn,
                        ];

                        $BeliDet->save($data_pemb_det);
                    }
                
                    # Set status PO nya
                    $data_po = [
                        'id'            => $sql_po->id,
                        'status_fkt'    => '1'
                    ];

                    $PO->save($data_po);
                }
                
                # Cek status transact SQL, jika gagal maka rollback
                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                }else{
                    # Set commit jika berhasil
                    $this->db->transCommit();
                }

                if($last_id > 0){
                    $this->session->setFlashdata('pembelian_toast', 'toastr.success("Faktur berhasil dibuat !!");');
                }

                return redirect()->to(base_url('pembelian/faktur/data_pembelian_tambah.php?id='.(!empty($last_id) ? $last_id : $id)));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_pembelian_proses() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $id         = $this->input->getVar('id');
            $status     = $this->input->getVar('status');
            $diskon     = $this->input->getVar('discount');
            
            $Supp       = new \App\Models\mSupplier();
            $PO         = new \App\Models\trPO();
            $PODet      = new \App\Models\trPODet();
            $Beli       = new \App\Models\trPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Supplier tidak boleh kosong',
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

                return redirect()->to(base_url('pembelian/faktur/data_pembelian_tambah.php?id='.$id));
            }else{
                $sql_beli       = $Beli->asObject()->where('id', $id)->first();
                $sql_beli_det   = $BeliDet->asObject()->select('SUM(subtotal) as jml_total')->where('id_pembelian', $sql_beli->id)->first();
                
                # Start Transact SQL
                $this->db->transBegin();
                
                try {
                    // Convert values to appropriate types to prevent operand type errors
                    $jmlTotal = (float)$sql_beli_det->jml_total;
                    $jmlDiskon = (float)$diskon;
                    
                    $data = [
                        'id'            => $id,
                        'jml_total'     => $jmlTotal,
                        'jml_subtotal'  => $jmlTotal,
                        'jml_diskon'    => $jmlDiskon,
                        'jml_gtotal'    => $jmlTotal - $jmlDiskon,
                        'status'        => $status,
                    ];

                    # Simpan ke tabel pembelian
                    $Beli->save($data);
                    $last_id = (!empty($id) ? $id : $Beli->insertID());
                    
                    # Cek status transact SQL, jika gagal maka rollback
                    if ($this->db->transStatus() === false) {
                        $this->db->transRollback();
                        $this->session->setFlashdata('pembelian_toast', 'toastr.error("Gagal memproses faktur!");');
                    } else {
                        # Set commit jika berhasil
                        $this->db->transCommit();
                        
                        if($last_id > 0){
                            $this->session->setFlashdata('pembelian_toast', 'toastr.success("Faktur berhasil diproses !!");');
                        }
                    }
                } catch (\Exception $e) {
                    $this->db->transRollback();
                    $this->session->setFlashdata('pembelian_toast', 'toastr.error("Error: ' . $e->getMessage() . '");');
                    log_message('error', $e->getMessage());
                }

                return redirect()->to(base_url('pembelian/faktur/data_pembelian.php'));
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }
        
    public function set_pembelian_bayar() {
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
            $rute       = $this->input->getVar('route');
            $keterangan = $this->input->getVar('keterangan');

            $Beli       = new \App\Models\trPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
            $BeliPlat   = new \App\Models\trPembelianPlat();
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
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('pembelian/faktur/data_pembayaran_tambah.php?id='.$id));
            }else{
                $sql_beli      = $Beli->asObject()->where('id', $id)->first();
                $sql_beli_det  = $BeliDet->asObject()->where('id_pembelian', $sql_beli->id)->find();
                $jml_bayar     = format_angka_db($jml_bayar);

                // # Start Transact SQL
                // $this->db->transStart();
                
                try {              
                    if($jml_bayar >= $sql_beli->jml_gtotal){
                        $status_bayar = '1';
                    }else{
                        $status_bayar = '0';
                    }
                    
                    # Masukkan data pembayaran
                    $data = [
                        'id'            => $id,
                        'tgl_bayar'     => tgl_indo_sys($tgl_bayar),
                        'jml_bayar'     => (float)$jml_bayar,
                        'metode_bayar'  => $metode,
                        'status_bayar'  => $status_bayar,
                    ];

                    $result = $Beli->save($data);
                    if (!$result) {
                        throw new \Exception('Gagal menyimpan data pembayaran ke database');
                    }

                    $sql_plat = $Platform->asObject()->where('id', $metode)->first();

                    # Masukkan data platform pembayaran
                    $data_plat = [
                        'id_pembelian'  => $id,
                        'id_platform'   => (int)$metode,
                        'platform'      => $sql_plat->platform,
                        'keterangan'    => $sql_plat->platform.' '.$keterangan,
                        'nominal'       => (float)$jml_bayar,
                        'tgl_simpan'    => date('Y-m-d H:i:s')
                    ];

                    $result_plat = $BeliPlat->save($data_plat);
                    if (!$result_plat) {
                        throw new \Exception('Gagal menyimpan data platform pembayaran ke database');
                    }
                    
                    # Commit transaction
                    $this->db->transComplete();
                    
                    if ($this->db->transStatus() === false) {
                        throw new \Exception('Gagal menyimpan data pembayaran');
                    }
                    
                    $this->session->setFlashdata('pembelian_toast', 'toastr.success("Transaksi berhasil dibayar !!");');
                    return redirect()->to(base_url('pembelian/faktur/data_pembayaran.php'));
                    
                } catch (\Exception $e) {
                    # Rollback transaction if error occurs
                    $this->db->transRollback();
                    $this->session->setFlashdata('pembelian_toast', 'toastr.error("' . $e->getMessage() . '");');
                    return redirect()->to(base_url('pembelian/faktur/data_pembayaran_tambah.php?id='.$id));
                }
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    } 
    
    public function cart_pembelian_simpan() {
        if ($this->ionAuth->loggedIn()) {
            # Load helper validasi
            $validasi   = \Config\Services::validation();
            
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();

            $idbeli     = $this->input->getVar('id_beli');
            $idbelidet  = $this->input->getVar('id_beli_det');
            $iditem     = $this->input->getVar('id_item');
            $item       = $this->input->getVar('item');
            $jml        = $this->input->getVar('jml');
            $satuan     = $this->input->getVar('satuan');
            $harga      = $this->input->getVar('harga');
            $diskon1    = $this->input->getVar('disk1');
            $diskon2    = $this->input->getVar('disk2');
            $diskon3    = $this->input->getVar('disk3');
            $pot        = $this->input->getVar('potongan');

            $Plgn       = new \App\Models\mPelanggan();
            $Item       = new \App\Models\mItem();
            $Satuan     = new \App\Models\mSatuan();
            $Beli       = new \App\Models\trPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();

            # Aturan validasi form tulis disini
            $aturan = [
                'id_beli'  => [
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
            ];

            # Simpan config validasi
            $validasi->setRules($aturan);

            # Jalankan validasi
            if(!$this->validate($aturan)){
                $psn_gagal = [
                    'id_pesanan' => $validasi->getError('id_pesanan'),
                    'item'       => $validasi->getError('item'),
                    'jml'        => $validasi->getError('jml'),
                    'satuan'     => $validasi->getError('satuan'),
                ];

                $this->session->setFlashdata('psn_gagal', $psn_gagal);

                return redirect()->to(base_url('pembelian/faktur/data_pembelian_tambah.php'.(!empty($idpsn) ? '?id='.$idpsn : '').(!empty($iditem) ? '&id_item='.$iditem : '')));
            }else{
                $sql_item   = $Item->asObject()->where('id', $iditem)->first();
                $sql_sat    = $Satuan->asObject()->where('id', $satuan)->first();
                
                $hrg        = format_angka_db($harga);
                $potongan   = format_angka_db($pot);
                
                $disk1      = $hrg - (($diskon1 / 100) * $hrg);
                $disk2      = $disk1 - (($diskon2 / 100) * $disk1);
                $disk3      = $disk2 - (($diskon3 / 100) * $disk2);
                $diskon     = ($hrg - $disk3) * (int)$jml;
                $subtotal   = ($disk3 * (int)$jml) - $potongan;
                                
                $data = [
                    'id'                => $idbelidet,
                    'id_pembelian'      => $idbeli,
                    'id_satuan'         => $satuan,
                    'id_user'           => $ID->id,
                    'id_item'           => $sql_item->id,
                    'kode'              => $sql_item->kode,
                    'item'              => $item,
                    'jml'               => (int)$jml,
                    'jml_satuan'        => (int)$sql_sat->jml,
                    'satuan'            => $sql_sat->satuanBesar,
                    'harga'             => (float)$hrg,
                    'disk1'             => (int)$diskon1,
                    'disk2'             => (int)$diskon2,
                    'disk3'             => (int)$diskon3,
                    'diskon'            => (float)$diskon,
                    'potongan'          => (float)$potongan,
                    'subtotal'          => (float)$subtotal,
                ];

                $BeliDet->save($data);
                $last_id = $BeliDet->insertID();
                
                $sql_det = $BeliDet->asObject()->select('SUM(diskon) AS diskon, SUM(potongan) AS potongan, SUM(subtotal) AS subtotal')->where('id_pembelian', $idbeli)->first();
                
                $data_beli = [
                    'id'            => $idbeli,
                    'jml_diskon'    => $sql_det->diskon,
                    'jml_potongan'  => $sql_det->potongan,
                    'jml_gtotal'    => $sql_det->subtotal,
                ];
                
                $Beli->save($data_beli);
                

                if($last_id > 0){
                    $this->session->setFlashdata('pembelian_toast', 'toastr.success("Pesanan berhasil disimpan !!");');
                }

                return redirect()->to(base_url('pembelian/faktur/data_pembelian_tambah.php?id='.$idbeli));
                
//                echo '<pre>';
//                print_r($sql_det);
            }
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }    
    

    public function data_pembayaran(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $vtrBeli    = new \App\Models\vtrPembelian();
            $sql_beli   = $vtrBeli->asObject()->where('status', '1')->where('status_bayar', '0')->orderBy('id', 'DESC'); //->like('kode', (!empty($kode) ? $kode : ''))->like('kategori', (!empty($kat) ? $kat : ''));
            $jml_limit  = $this->Setting->jml_item;
            
            $data  = [
                'SQLBeli'       => $sql_beli->paginate($jml_limit),
                'Pagination'    => $vtrBeli->pager->links(),
                'Halaman'       => (isset($_GET['page']) ? ($_GET['page'] != '1' ? ($_GET['page'] * $jml_limit) + 1 : 1) : 1),
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pembayaran',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pembayaran',
            ];
            
            return view($this->ThemePath.'/index', $data);           
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    } 

    public function data_pembayaran_tambah(){
        if ($this->ionAuth->loggedIn()) {
            $ID         = $this->ionAuth->user()->row();
            $IDGrup     = $this->ionAuth->getUsersGroups($ID->id)->getRow();
            $AksesGrup  = $this->ionAuth->groups()->result();
            
            $IDBeli     = $this->input->getVar('id');
            $IDSupp     = $this->input->getVar('id_supplier');
            $IDItm      = $this->input->getVar('id_item');
            $IDItmDet   = $this->input->getVar('id_item_det');
            
            $Supp       = new \App\Models\mSupplier();
            $Profile    = new \App\Models\PengaturanProfile();
            $Beli       = new \App\Models\vtrPembelian();
            $BeliDet    = new \App\Models\trPembelianDet();
            $Platform   = new \App\Models\mPlatform();
                
            $sql_beli   = $Beli->asObject()->where('id', $IDBeli)->first();
            $sql_profile= $Profile->asObject()->where('status', '1')->find();
            $sql_supp   = $Supp->asObject()->where('id', (isset($_GET['id_supplier']) ? $IDSupp : (!empty($sql_beli->id_supplier) ? $sql_beli->id_supplier : '0')))->first();
            
            if(!empty($IDBeli)){
                $Itm                = new \App\Models\vItem();
                $Sat                = new \App\Models\mSatuan;
                $sql_beli_det       = $BeliDet->asObject()->where('id_pembelian', $IDBeli)->find();
                $sql_beli_det_rw    = $BeliDet->asObject()->where('id', $IDItmDet)->first();
                $sql_item           = $Itm->asObject()->where('id', $IDItm)->first();
                $sql_sat            = $Sat->asObject()->where('status', '1')->find();
                $sql_plat           = $Platform->asObject()->where('status', '1')->find();
            }else{
                $sql_beli           = '';
                $sql_beli_det       = '';
                $sql_beli_det_rw    = '';
                $sql_item           = '';
                $sql_sat            = '';
                $sql_plat           = '';
            }
                        
            $data  = [
                'SQLBeli'       => $sql_beli,
                'SQLBeliDet'    => $sql_beli_det,
                'SQLBeliDetRw'  => $sql_beli_det_rw,
                'SQLPlat'       => $sql_plat,
                'SQLItem'       => $sql_item,
                'SQLSatuan'     => $sql_sat,
                'SQLSupp'       => $sql_supp,
                'SQLProfile'    => $sql_profile,
                'AksesGrup'     => $AksesGrup,
                'Pengguna'      => $ID,
                'PenggunaGrup'  => $IDGrup,
                'Pengaturan'    => $this->Setting,
                'ThemePath'     => $this->ThemePath,
                'menu_atas'     => $this->ThemePath.'/layout/menu_atas',
                'menu_kiri'     => $this->ThemePath.'/manajemen/pembelian/menu_kiri_pembayaran',
                'konten'        => $this->ThemePath.'/manajemen/pembelian/data_pembelian_bayar',
            ];
            
            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    } 

    
    public function set_pesanan_cari() {                
        if ($this->input->is('post') == 1) {
            $kode   = $this->input->getVar('no_po');
            $nama   = $this->input->getVar('supplier');
            
            return redirect()->to(base_url('/pembelian/pesanan/data_pesanan.php?'.(!empty($kode) ? 'filter_kode='.$kode : '').(!empty($nama) ? '&filter_nama='.$nama : '')));
        }else{
            return redirect()->to(base_url());
        }
    }
    
    
    public function json_supplier(){
        if ($this->ionAuth->loggedIn()) {
            $Term       = $this->input->getVar('term');
            
            $Supp       = new \App\Models\mSupplier();
            $sql_supp   = $Supp->asObject()->where('status', '1')->like('nama', (!empty($Term) ? $Term : ''))->find();
            
            foreach ($sql_supp as $supp){
                $data[] = [
                    'id'    => $supp->id,
                    'kode'  => $supp->kode,
                    'nama'  => (!empty($supp->kode) ? '['.$supp->kode.'] ' : '').$supp->nama,
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
    
    public function json_item(){
        if ($this->ionAuth->loggedIn()) {
            $Term       = $this->input->getVar('term');
            
            $Item       = new \App\Models\vItem();
            $sql_item   = $Item->asObject()->where('status', '1')->like('item2', (!empty($Term) ? $Term : ''))->find();
            
            foreach ($sql_item as $item){
                $data[] = [
                    'id'    => $item->id,
                    'kode'  => $item->kode,
                    'nama'  => $item->item2,
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
        
    public function json_rab(){
        if ($this->ionAuth->loggedIn()) {
            $Term       = $this->input->getVar('term');
            
            $Rab        = new \App\Models\vtrRab();
            $sql_rab    = $Rab->asObject()->like('no_rab', (!empty($Term) ? $Term : ''))->like('p_nama', (!empty($Term) ? $Term : ''))->find();
            
            foreach ($sql_rab as $det){
                $data[] = [
                    'id'    => $det->id,
                    'kode'  => $det->no_rab,
                    'nama'  => (!empty($det->no_rab) ? '['.$det->no_rab.'] ' : '').$det->p_nama,
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
