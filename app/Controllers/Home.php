<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\PengaturanTempl;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use FPDF;
//use SimpleSoftwareIO\QrCode\Generator;

class Home extends BaseController {

    public function __construct() {
//        $this->Kategori = new KategoriModel();
    }

    public function index() {
        if ($this->ionAuth->loggedIn()) {
            
            # Hak Akses
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
                'menu_kiri'     => $this->ThemePath.'/layout/menu_kiri',
                'konten'        => $this->ThemePath.'/layout/konten'
            ];

            return view($this->ThemePath.'/index', $data);
        } else {
            $this->session->setFlashdata('login_toast', 'toastr.error("Sesi berakhir, silahkan login kembali !");');
            return redirect()->to(base_url());
        }
    }

    public function tes() {
        $id = '5';
        $Rab    = new \App\Models\trRab();
        $RabDet = new \App\Models\trRabDet();
        
        $sql_rab_det    = $RabDet->asObject()->groupBy('status')->where('id_rab', $id)->find();
        
        foreach ($sql_rab_det as $rab){
            $sql_rab = $RabDet->asObject()->where('id_rab', $rab->id_rab)->where('status', $rab->status)->find();
            $data[] = [
                'tipe' => ($rab->status == '1' ? 'Item' : 'Biaya'),
                'data'  => $sql_rab
            ];
        }
        
        $datanya = json_encode($data);
        $itm = (object)$data;
        
        foreach (json_decode($datanya) as $dt){
            echo $dt->tipe. br();
            
            foreach ($dt->data as $det){
                echo nbs(2).$det->item.br();
            }
        }
    }

    public function tes2() {
        $Gd         = new \App\Models\mGudang();
        $Kat        = new \App\Models\mKategori();
        $Merk       = new \App\Models\mMerk();
        $Item       = new \App\Models\mItem();
        $ItemStok   = new \App\Models\mItemStok();
        $Satuan     = new \App\Models\mSatuan();
        
        $sql_kat   = $Kat->asObject()->find();
        $sql_mrk   = $Merk->asObject()->find();
        
        $n = 1;
        foreach ($sql_kat as $det){
            $kode = sprintf('%03d', $n);
            
            $data = [
                'id'    => $det->id,
                'kode'  => strtoupper($kode),
                'kategori'   => strtoupper($det->kategori),
            ];
            
            $Kat->save($data);
            pre($data);
            
             $n++;
        }
    }

    public function tes3_qr() {
        $qrcode = new Generator;
        $qrCodes = [];
        $qrCodes['simple'] = $qrcode->size(120)->generate('https://www.binaryboxtuts.com/');
        $qrCodes['changeColor'] = $qrcode->size(120)->color(255, 0, 0)->generate('https://www.binaryboxtuts.com/');
        $qrCodes['changeBgColor'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 0, 0)->generate('https://www.binaryboxtuts.com/');
          
        $qrCodes['styleDot'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 255, 255)->style('dot')->generate('https://www.binaryboxtuts.com/');
        $qrCodes['styleSquare'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 255, 255)->style('square')->generate('https://www.binaryboxtuts.com/');
        $qrCodes['styleRound'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 255, 255)->style('round')->generate('https://www.binaryboxtuts.com/');
      
        $qrCodes['withImage'] = $qrcode->size(200)->format('png')->merge('img/logo.png', .4)->generate('https://www.binaryboxtuts.com/');
            return view('qr-codes', $qrCodes);
        }
}
