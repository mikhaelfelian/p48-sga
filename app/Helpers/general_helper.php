<?php

function alnum($teks) {
    $string = preg_replace("/[^A-Za-z0-9]/",'',$teks);
    return $string;
}

function jns_klm($jenis) {
    switch ($jenis) {
        case 'L':
            $jns_klm = 'Laki-laki';
            break;
        case 'P':
            $jns_klm = 'Perempuan';
            break;
        case 'O':
            $jns_klm = 'Lainnya';
            break;
    }
    return $jns_klm;
}

function format_angka($str, $dec = null) {
    $string = number_format($str, $dec, ',', '.');
    return $string;
}

function format_angka2($str, $dec) {
    $string = number_format($str, $dec, '.', '');
    $var = explode('.', $string);
    $hasil = ($var[1] == '00' ? $var[0] : $string);
    return $hasil;
}

function format_angka_str($str) {
    $angka = abs($str);
    $terbilang = array(
        '',
        'satu',
        'dua',
        'tiga',
        'empat',
        'lima',
        'enam',
        'tujuh',
        'delapan',
        'sembilan',
        'sepuluh',
        'sebelas'
    );

    $hasil = '';

    if ($angka < 12) {
        $hasil = ' ' . $terbilang[$angka];
    } elseif ($angka < 20) {
        $hasil = format_angka_str($angka - 10) . ' belas';
    } elseif ($angka < 100) {
        $hasil = format_angka_str($angka / 10) . ' puluh' . format_angka_str($angka % 10);
    } elseif ($angka < 200) {
        $hasil = ' seratus' . format_angka_str($angka - 100);
    } elseif ($angka < 1000) {
        $hasil = format_angka_str($angka / 100) . ' ratus' . format_angka_str($angka % 100);
    } elseif ($angka < 2000) {
        $hasil = ' seribu' . format_angka_str($angka - 1000);
    } elseif ($angka < 1000000) {
        $hasil = format_angka_str($angka / 1000) . ' ribu' . format_angka_str($angka % 1000);
    } elseif ($angka < 1000000000) {
        $hasil = format_angka_str($angka / 1000000) . ' juta' . format_angka_str($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        $hasil = format_angka_str($angka / 1000000000) . ' miliar' . format_angka_str(fmod($angka, 1000000000));
    } elseif ($angka < 1000000000000000) {
        $hasil = format_angka_str($angka / 1000000000000) . ' triliun' . format_angka_str(fmod($angka, 1000000000000));
    }

    return $hasil;
}

function format_angka_db($str) {
    $angka  = (float)$str;
    $string = str_replace(',', '.', str_replace('.', '', $str));
    return $string;
}

function format_numerik($str, $des) {
    $string = number_format($str, 0, ',', '.');
    return $string;
}

function format_numerik2($str) {
    $string = str_replace(',', '.', str_replace('.', '', $str));
    return $string;
}

function format_romawi($integer) {
    // Convert the integer into an integer (just to make sure)
    $integer = intval($integer);
    $result = '';

    // Create a lookup array that contains all of the Roman numerals.
    $lookup = array('M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1);

    foreach ($lookup as $roman => $value) {
        // Determine the number of matches
        $matches = intval($integer / $value);

        // Add the same number of characters to the string
        $result .= str_repeat($roman, $matches);

        // Set the integer to be the remainder of the integer and the value
        $integer = $integer % $value;
    }

    // The Roman numeral should be built, return it
    return $result;
}

function format_nama($nama){
    $nama = ucwords(strtolower($nama));
    return $nama;
}

function hitung_dpp($dpp, $jml_gtotal) {
    $angka = (float) $jml_gtotal;
    $jml_total = str_replace(',', '.', str_replace('.', '', $angka));

    $jml_dpp = $jml_total / $dpp;

    return $jml_dpp;
}

function hitung_ppn($ppn, $ppn_tot, $jml_gtotal) {
    $jml_gtotal = (float) $jml_gtotal;
    $ppn        = (float) $ppn;
    $ppn_tot    = (float) $ppn_tot;
    
    $jml_total  = str_replace(',', '.', str_replace('.', '', $jml_gtotal));
    
    $jml_ppn    = ($ppn / $ppn_tot) * $jml_total;

    return $jml_ppn;
}

function hitung_pph($dpp, $pph, $jml_gtotal) {
    $angka      = (float) $jml_gtotal;
    $jml_total  = str_replace(',', '.', str_replace('.', '', $angka));

    $jml_dpp = $jml_total / $dpp;
    $jml_ppn = $jml_total - $jml_dpp;
    $jml_pph = $jml_dpp * ($pph / 100);

    return $jml_pph;
}

function hitung_netto($dpp, $pph, $jml_gtotal) {
    $angka = (float) $jml_gtotal;
    $jml_total = str_replace(',', '.', str_replace('.', '', $angka));

    $jml_dpp = $jml_total / $dpp;
    $jml_ppn = $jml_total - $jml_dpp;
    $jml_pph = $jml_dpp * ($pph / 100);
    $jml_netto = $jml_dpp - $jml_pph;

    return $jml_netto;
}

function hitung_profit($dpp, $pph, $ppn, $ppn_tot, $jml_hpp, $jml_total) {
    $dpp        = (float) $dpp;
    $pph        = (float) $pph;
    $ppn        = (float) $ppn;
    $ppn_tot    = (float) $ppn_tot;
    $jml_hpp    = (float) $jml_hpp;
    $jml_total  = (float) $jml_total;
    $hpp        = str_replace(',', '.', str_replace('.', '', $jml_hpp));
    $total      = str_replace(',', '.', str_replace('.', '', $jml_total));

    $jml_dpp        = hitung_dpp($dpp, $jml_hpp);
    $jml_dpp_dinas  = hitung_dpp($dpp, $jml_total);
    $jml_ppn_dinas  = $jml_total - $jml_dpp_dinas;
    $jml_pph_dinas  = $jml_dpp_dinas * ($pph / 100);
    $profit         = $jml_total - $jml_ppn_dinas - $jml_pph_dinas - $jml_hpp;

    return $profit;
}

function status_rab($status) {
    switch ($status) {
        default:
            $status = '<label class="badge badge-secondary">DRAFT</label>';
            break;
        
        case '0':
            $status = '<label class="badge badge-secondary">DRAFT</label>';
            break;

        case '1':
            $status = '<label class="badge badge-info">PROSES</label>';
            break;

        case '2':
            $status = '<label class="badge badge-success">ACC</label>';
            break;

        case '3':
            $status = '<label class="badge badge-danger">TOLAK</label>';
            break;

        case '4':
            $status = '<label class="badge badge-success">MENANG</label>';
            break;

        case '5':
            $status = '<label class="badge badge-warning">KALAH</label>';
            break;

        case '6':
            $status = '<label class="badge badge-primary">POSTING</label>';
            break;
    }
    return $status;
}

function status_rab_text($status) {
    switch ($status) {
        default:
            $status = 'DRAFT';
            break;
        
        case '0':
            $status = 'DRAFT';
            break;

        case '1':
            $status = 'PROSES';
            break;

        case '2':
            $status = 'ACC';
            break;

        case '3':
            $status = 'TOLAK';
            break;

        case '4':
            $status = 'MENANG';
            break;

        case '5':
            $status = 'KALAH';
            break;

        case '6':
            $status = 'POSTING';
            break;
    }
    return $status;
}

function status_penj($status) {
    switch ($status) {
        default:
            $status = '<label class="badge badge-secondary">DRAFT</label>';
            break;
        
        case '0':
            $status = '<label class="badge badge-secondary">DRAFT</label>';
            break;

        case '1':
            $status = '<label class="badge badge-info">PROSES</label>';
            break;
    }
    return $status;
}

function status_profit($status) {
    switch ($status) {
        default:
            $status = '<label class="badge badge-warning">RUGI</label>';
            break;
        
        case 'Rugi':
            $status = '<label class="badge badge-warning">RUGI</label>';
            break;

        case 'Untung':
            $status = '<label class="badge badge-success">UNTUNG</label>';
            break;
    }
    return $status;
}

function status_penj_rab($status) {    
    if(!empty($status)){
        $status = '<label class="badge badge-info">RAB</label>';
    }else{
        $status = '<label class="badge badge-warning">Non-RAB</label>';
    }
    return $status;
}

function status_tipe($status) {
    switch ($status) {
        case '0':
            $status = '<label class="badge badge-warning">Menunggu</label>';
            break;

        case '1':
            $status = '<label class="badge badge-info">Proses</label>';
            break;

        case '2':
            $status = '<label class="badge badge-success">Menunggu</label>';
            break;
    }
    return $status;
}

function status_ppn($status) {
    switch ($status) {
        case '0':
            $status = '<label class="badge badge-warning">Non PPN</label>';
            break;

        case '1':
            $status = '<label class="badge badge-info">Include PPN</label>';
            break;

        case '2':
            $status = '<label class="badge badge-primary">Tambah PPN</label>';
            break;
    }
    return $status;
}

function status_ppn_text($status) {
    switch ($status) {
        case '0':
            $status = 'Non PPN';
            break;

        case '1':
            $status = 'Tambah PPN';
            break;

        case '2':
            $status = 'Include PPN';
            break;
    }
    return $status;
}

function status_mutasi($status) {
    switch ($status) {
        default:
            $status = '<label class="badge badge-secondary">DRAFT</label>';
            break;

        case '1':
            $status = '<label class="badge badge-info">Pindah Gudang</label>';
            break;

        case '2':
            $status = '<label class="badge badge-success">Stok Masuk</label>';
            break;

        case '3':
            $status = '<label class="badge badge-danger">Stok Keluar</label>';
            break;

        case '4':
            $status = '<label class="badge badge-danger">Pengiriman</label>';
            break;
    }
    return $status;
}

function status_mutasi_trx($status) {
    switch ($status) {
        default:
            $status = '<label class="badge badge-secondary">DRAFT</label>';
            break;

        case '1':
            $status = '<label class="badge badge-info">PROSES</label>';
            break;

        case '2':
            $status = '<label class="badge badge-success">SELESAI</label>';
            break;
    }
    return $status;
}

function status_mutasi_text($status) {
    switch ($status) {
        default:
            $status = '';
            break;

        case '1':
            $status = 'Pindah Gudang';
            break;

        case '2':
            $status = 'Stok Masuk';
            break;

        case '3':
            $status = 'Stok Keluar';
            break;
    }
    return $status;
}

function status_bayar($status) {
    switch ($status) {
        case '0':
            $status = '<label class="badge badge-warning">Belum Bayar</label>';
            break;

        case '1':
            $status = '<label class="badge badge-success">Lunas</label>';
            break;
    }
    return $status;
}

function status_biaya($status) {
    switch ($status) {
        case '0':
            $status = '<label class="badge badge-success">Tidak Tampil</label>';
            break;

        case '1':
            $status = '<label class="badge badge-warning">Tampil di nota</label>';
            break;
    }
    return $status;
}

function status_po_fkt($status) {
    switch ($status) {
        case '0':
            $status = '<label class="badge badge-warning">Belum PI</label>';
            break;

        case '1':
            $status = '<label class="badge badge-success">Sudah PI</label>';
            break;
    }
    return $status;
}

function status_gd($status) {
    switch ($status) {
        case '0':
            $status = '';
            break;

        case '1':
            $status = '<label class="badge badge-success">Utama</label>';
            break;

        default:
            $status = '';
            break;
    }
    return $status;
}

function status_stok($status) {
    switch ($status) {
        case '1':
            $status = '<label class="badge badge-success">Stok Masuk</label>';
            break;

        case '2':
            $status = '<label class="badge badge-success">Stok Masuk</label>';
            break;

        case '3':
            $status = '<label class="badge badge-info">Retur Jual</label>';
            break;

        case '4':
            $status = '<label class="badge badge-info">Stok Keluar</label>';
            break;

        case '5':
            $status = '<label class="badge badge-info">Retur Beli</label>';
            break;

        case '6':
            $status = '<label class="badge badge-warning">Stok Opname</label>';
            break;

        case '7':
            $status = '<label class="badge badge-info">Stok Keluar</label>';
            break;

        case '8':
            $status = '<label class="badge badge-warning">Mutasi</label>';
            break;
    }
    return $status;
}

function status_penerimaan($status) {
    switch ($status) {
        case '0':
            $status = '<label class="badge badge-warning">Menunggu</label>';
            break;

        case '1':
            $status = '<label class="badge badge-primary">Menunggu</label>';
            break;

        case '2':
            $status = '<label class="badge badge-warning">Proses</label>';
            break;

        case '3':
            $status = '<label class="badge badge-success">Selesai</label>';
            break;

        case '4':
            $status = '<label class="badge badge-info">Siap di ambil</label>';
            break;

        case '5':
            $status = '<label class="badge badge-default">Sudah diambil</label>';
            break;
    }
    return $status;
}

function br($num = 1) {
    return str_repeat("<br />", $num);
}

function nbs($num = 1) {
    return str_repeat("&nbsp;", $num);
}

function pre($data) {
    $print  = print_r('<pre>');
    $print .= print_r($data);
    $print .= print_r('</pre>');
    
    return $print;
}

/**
 * Get employee status text based on status code
 * 
 * @param string $tipe Employee type code
 * @return string Status text
 */
function status_pegawai($tipe) {
    $status = '-';
    
    if (!empty($tipe)) {
        switch ($tipe) {
            case '0':
                $status = 'Tetap';
                break;
            case '1':
                $status = 'Kontrak';
                break;
            case '2':
                $status = 'Magang';
                break;
            case '3':
                $status = 'Outsourcing';
                break;
            default:
                $status = '-';
        }
    }
    
    return $status;
}

/**
 * Generate HTML badge for leave status
 * 
 * @param string|int $status Status code (0: Pending, 1: Approved, 2: Rejected)
 * @return string HTML badge element
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-13
 */
function status_cuti($status) {
    switch ($status) {
        default:
            $badge = '<span class="badge badge-secondary">Unknown</span>';
            break;
        
        case '0':
        case 0:
            $badge = '<span class="badge badge-warning">Pending</span>';
            break;

        case '1':
        case 1:
            $badge = '<span class="badge badge-success">Disetujui</span>';
            break;

        case '2':
        case 2:
            $badge = '<span class="badge badge-danger">Ditolak</span>';
            break;
    }
    
    return $badge;
}

/**
 * Generate HTML badge for employee status
 * 
 * This function returns an HTML badge with appropriate color based on employee status.
 * 
 * @param string|int $status Employee status code (0: Non-Active, 1: Permanent, 2: Contract)
 * @param bool $rounded Whether to use rounded-0 class or not
 * @return string HTML badge element
 * 
 * @author Mikhael Felian Waskito - mikhaelfelian@gmail.com
 * @date 2025-03-13
 */
function status_karyawan($status, $rounded = true) {
    $status_label = '';
    $status_class = '';
    $rounded_class = $rounded ? '' : ' rounded-0';
    
    switch ($status) {
        case '0':
        case 0:
            $status_label = 'Non-Aktif';
            $status_class = 'badge-danger' . $rounded_class;
            break;
        case '1':
        case 1:
            $status_label = 'Tetap';
            $status_class = 'badge-success' . $rounded_class;
            break;
        case '2':
        case 2:
            $status_label = 'Kontrak';
            $status_class = 'badge-warning' . $rounded_class;
            break;
        default:
            $status_label = 'Tidak Diketahui';
            $status_class = 'badge-secondary' . $rounded_class;
    }
    
    return '<span class="badge ' . $status_class . '">' . $status_label . '</span>';
}

