<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of Pengaturan
 *
 * @author mike
 */
class Pengaturan extends Model {
    protected $table            = 'tbl_pengaturan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_app', 'website', 'judul', 'judul_app', 'url_app', 'favicon', 'logo', 'logo_header', 'logo_header_kop', 'deskripsi', 'deskripsi_pendek', 'notifikasi', 'alamat', 'kota', 'email', 'pesan', 'tlp', 'fax', 'kode_plgn', 'kode_kary', 'kode_supp', 'ppn','dpp','pph', 'ppn_tot', 'jml_ppn', 'jml_item', 'jml_limit_stok', 'jml_limit_tempo', 'status_app'];
}
