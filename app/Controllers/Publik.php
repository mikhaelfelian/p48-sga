<?php
namespace App\Controllers;

/**
 * Description of Publik
 *
 * @author mike
 */
class Publik extends BaseController {

    public function json_supplier(){

            $Term       = $this->input->getVar('term');
            
            if(!empty($Term)){
                $Supp       = new \App\Models\mSupplier();
                $sql_supp   = $Supp->asObject()->where('status', '1')->like('nama', $Term)->find();

                foreach ($sql_supp as $supp){
                    $data[] = [
                        'id'    => $supp->id,
                        'kode'  => $supp->kode,
                        'nama'  => (!empty($supp->kode) ? '['.$supp->kode.'] ' : '').$supp->nama,
                    ];
                }
            }

            $msg[]      = ['nama'=>'Data tidak ditemukan'];
            $json_data  = (!empty($data) ? $data : $msg);
            return response()->setContentType('application/json')                             
                             ->setStatusCode(200)
                             ->setJSON($json_data);
    }
    
    public function json_pelanggan(){
            $Term = $this->request->getVar('term');
            
            if(!empty($Term)){
                $Plgn = new \App\Models\mPelanggan();
                $sql_plgn = $Plgn->asObject()
                    ->where('status', '1')
                    ->like('nama', $Term)
                    ->find();

                $data = [];
                foreach ($sql_plgn as $plgn){
                    $data[] = [
                        'id'    => $plgn->id,
                        'kode'  => $plgn->kode,
                        'nama'  => (!empty($plgn->kode) ? '['.$plgn->kode.'] ' : '').$plgn->nama,
                    ];
                }
            }

            $msg = [['nama' => 'Data tidak ditemukan']];
            $json_data = (!empty($data) ? $data : $msg);
            
            return response()->setContentType('application/json')
                           ->setStatusCode(200)
                           ->setJSON($json_data);
    }
    
    public function json_item(){

            $Term       = $this->input->getVar('term');
            
            if(!empty($Term)){
                $Item       = new \App\Models\vItem();
                $sql_item   = $Item->asObject()->where('status', '1')->like('item', $Term)->find();

                foreach ($sql_item as $item){
                    $data[] = [
                        'id'    => $item->id,
                        'kode'  => $item->kode,
                        'nama'  => $item->item,
                    ];
                }
            }

            $msg[]      = ['nama'=>'Data tidak ditemukan'];
            $json_data  = (!empty($data) ? $data : $msg);
            return response()->setContentType('application/json')                             
                             ->setStatusCode(200)
                             ->setJSON($json_data);
    }
    
    public function json_po(){

            $Term       = $this->input->getVar('term');
            
            if(!empty($Term)){
                $PO        = new \App\Models\vtrPO();
                $sql_po    = $PO->asObject()->like('supplier', $Term)->find();

                foreach ($sql_po as $item){
                    $data[] = [
                        'id'        => $item->id,
                        'no_po'     => $item->no_po,
                        'supplier'  => $item->supplier,
                    ];
                }
            }
            
            $msg[]      = ['nama'=>'Data tidak ditemukan'];
            $json_data  = (!empty($data) ? $data : $msg);
            return response()->setContentType('application/json')                             
                             ->setStatusCode(200)
                             ->setJSON($json_data);
    }
        
    public function json_rab(){

            $Term       = $this->input->getVar('term');
            
            if(!empty($Term)){
                $Rab        = new \App\Models\vtrRab();
                $sql_rab    = $Rab->asObject()->where('status', '4')->like('p_nama', $Term)->orLike('no_rab', $Term)->find();

                foreach ($sql_rab as $det){
                    $data[] = [
                        'id'    => $det->id,
                        'kode'  => $det->no_rab,
                        'nama'  => (!empty($det->no_rab) ? '['.$det->no_rab.'] ' : '').$det->p_nama,
                    ];
                }
            }

            $msg[]      = ['nama'=>'Data tidak ditemukan'];
            $json_data  = (!empty($data) ? $data : $msg);
            return response()->setContentType('application/json')                             
                             ->setStatusCode(200)
                             ->setJSON($json_data);
    }
        
    public function json_penjualan(){

            $Term       = $this->input->getVar('term');
            
            if(!empty($Term)){
                $Penj       = new \App\Models\vtrPenj();
                $sql_penj   = $Penj->asObject()->where('status', '1')->like('no_nota', $Term)->orLike('p_nama', $Term)->find();

                foreach ($sql_penj as $det){
                    $data[] = [
                        'id'    => $det->id,
                        'kode'  => $det->no_nota,
                        'nama'  => (!empty($det->no_nota) ? '['.$det->no_nota.'] ' : '').$det->p_nama,
                    ];
                }                
            }

            $msg[]      = ['nama'=>'Data tidak ditemukan'];
            $json_data  = (!empty($data) ? $data : $msg);
            return response()->setContentType('application/json')                             
                             ->setStatusCode(200)
                             ->setJSON($json_data);
    }
}
