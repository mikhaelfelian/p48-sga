<?php

function tgl_indo($tglan) {
    $str_tgl    = $tglan;
    $dta_tgl    = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln       = (!empty($dta_tgl) ? date('m/d/Y', strtotime($dta_tgl)) : '');
    $tgle       = $tgln;
    return $tgle;
}

function tgl_indo2($tglan) {
    $str_tgl    = $tglan;
    $dta_tgl    = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln       = (!empty($dta_tgl) ? date('d/m/Y', strtotime($dta_tgl)) : '');
    $tgle       = $tgln;
    return $tgle;
}

function tgl_indo3($tglan) {
        $str_tgl    = $tglan;
        $dta_tgl    = ($str_tgl != '0000-00-00' ? $str_tgl : '');
        $tgln       = (!empty($dta_tgl) ? date('Y-m-d', strtotime($dta_tgl)) : '');

        $tgl        = explode('-', $tgln);
        $tanggal    = $tgl[2];
        $bulan      = bulan_ke($tgl[1]);
        $tahun      = $tgl[0];
        $tgle       = (!empty($tglan) ? $tanggal . ' ' . $bulan . ' ' . $tahun : '');
        return $tgle;
}

function tgl_indo4($tglan) {
    $str_tgl    = $tglan;
    $dta_tgl    = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln       = (!empty($dta_tgl) ? date('m/d/Y', strtotime($dta_tgl)).' '.date('H:i') : '');
    $tgle       = $tgln;
    return $tgle;
}

function tgl_indo5($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln = (!empty($dta_tgl) ? date('d/m/Y', strtotime($dta_tgl)) : '');
    $wktu = (!empty($dta_tgl) ? date('H:i', strtotime($dta_tgl)) : '');
    $tgle = $tgln . ' ' . $wktu;
    return $tgle;
}

function tgl_indo6($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln = (!empty($dta_tgl) ? date('d/m/Y', strtotime($dta_tgl)) : '');
    $tgle = hari_ke($tglan) . ', ' . $tgln;
    return $tgle;
}

function tgl_indo7($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln = (!empty($dta_tgl) ? date('m/d/Y', strtotime($dta_tgl)) : '');
    $tgle = $tgln;
    return $tgle;
}

function tgl_indo8($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln = (!empty($dta_tgl) ? date('d-m-Y', strtotime($dta_tgl)) : '-');
    $tgle = $tgln;
    return $tgle;
}

/**
 * Format date and time to dd-mm-yyyy HH:MM format
 * 
 * @param string $tglan Date string in any format
 * @return string Formatted date string (e.g., 20-03-2020 20:55)
 */
function tgl_indo9($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    if (empty($dta_tgl)) {
        return '-';
    }
    
    $tgl_format = date('d-m-Y', strtotime($dta_tgl));
    $waktu_format = date('H:i', strtotime($dta_tgl));
    
    return $tgl_format . ' ' . $waktu_format;
}


function bln_indo($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln = (!empty($dta_tgl) ? date('m', strtotime($dta_tgl)) : '');
    $tgle = $tgln;
    return $tgle;
}

function tgl_indo_sys($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? strtotime($str_tgl) : '');
    $tgln = (!empty($dta_tgl) ? date('Y-m-d', $dta_tgl) : '');
    $tgle = $tgln;
    return $tgle;
}

function tgl_indo_sys2($tglan) {
    $tgl = explode('/', $tglan);
    $tanggal = $tgl[0];
    $bulan = $tgl[1];
    $tahun = $tgl[2];
    $tgle = (!empty($tglan) ? $tahun . '-' . $bulan . '-' . $tanggal : '');
    return $tgle;
}

function tgl_indo_sys2_time($tglan) {
    $tgl = explode('/', $tglan);
    $tanggal = $tgl[0];
    $bulan = $tgl[1];
    $tahun = $tgl[2];
    $jam_sekarang = date('H:i:s');
    $tgle = (!empty($tglan) ? $tahun . '-' . $bulan . '-' . $tanggal : '') .' '. $jam_sekarang;
    return $tgle;
}

function wkt_indo($tglan) {
    $str_tgl = $tglan;
    $dta_tgl = ($str_tgl != '0000-00-00' ? $str_tgl : '');
    $tgln = (!empty($dta_tgl) ? date('H:i', strtotime($dta_tgl)) : '');
    $tgle = $tgln;
    return $tgle;
}

function getBulan($bln) {
    switch ($bln) {
        case 1:
            return "01";
            break;
        case 2:
            return "02";
            break;
        case 3:
            return "03";
            break;
        case 4:
            return "04";
            break;
        case 5:
            return "05";
            break;
        case 6:
            return "06";
            break;
        case 7:
            return "07";
            break;
        case 8:
            return "08";
            break;
        case 9:
            return "09";
            break;
        case 10:
            return "10";
            break;
        case 11:
            return "11";
            break;
        case 12:
            return "12";
            break;
    }
}

function hari_ini() {
    $nm_hari = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    );

    $hari = date("D");
    $hari_ini = $nm_hari[$hari];
    return $hari_ini;
}

function hari_ke($tanggal) {
    $nm_hari = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    );

    $hari = date('D', strtotime($tanggal));
    $hari_ini = $nm_hari[$hari];
    return $hari_ini;
}

function bulan_ke($bln) {
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function usia($tglan) {
    $birthDate = new DateTime($tglan);
    $today = new DateTime("today");
    if ($birthDate > $today) {
        return "0 Tahun 0 Bulan 0 Hari";
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    $umur = $y . " tahun";
    return ucwords($umur);
}

function usia_angka($tglan) {
    $birthDate = new DateTime($tglan);
    $today = new DateTime("today");
    if ($birthDate > $today) {
        return "0 Tahun 0 Bulan 0 Hari";
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    $umur = $y;
    return ucwords($umur);
}

function usia_lkp($tglan) {
    $birthDate = new DateTime($tglan);
    $today = new DateTime("today");

    $str_tgl = $tglan;
    if ($str_tgl != '0000-00-00') {
//            exit("0 Tahun 0 Bulan 0 Hari");
//        }else{            
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        $umur = $y . " tahun " . $m . " bulan " . $d . " hari";
        //}else{
        //    $umur = "0 Tahun 0 Bulan 0 Hari";            
    }else{
        $umur = '';
    }
    return $umur;
}

function usia_hari($tgl_awal, $tgl_akhir) {
    $birthDate = new DateTime($tgl_awal);
    $today = new DateTime($tgl_akhir);
    if ($birthDate > $today) {
        return "0 Hari 0 Jam";
    }
    $h = $today->diff($birthDate)->d;
    $j = $today->diff($birthDate)->h;
    $m = $today->diff($birthDate)->i;
    $umur = $h . ' Hari ' . $j . ' Jam';

    return ucwords($umur);
}

function usia_wkt($tgl_awal, $tgl_akhir) {
    $birthDate = new DateTime($tgl_awal);
    $today = new DateTime($tgl_akhir);
    if ($birthDate > $today) {
        return "0 Jam 0 Menit";
    }

    $j = $today->diff($birthDate)->h;
    $m = $today->diff($birthDate)->i;
    $d = $today->diff($birthDate)->s;
    $umur = ($j > 0 ? $j . " Jam " . $m . " Menit" : $m . " Menit");
    return ucwords($umur);
}

function sejak($since) {
    $timeCalc = strtotime(date('Y-m-d H:i:s')) - strtotime($since);

    if ($timeCalc >= (60 * 60 * 24 * 30 * 12 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " years ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30 * 12)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " tahun";
    } else if ($timeCalc >= (60 * 60 * 24 * 30 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " months ago";
    } else if ($timeCalc >= (60 * 60 * 24 * 30)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " bulan";
    } else if ($timeCalc >= (60 * 60 * 24 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60 / 24) . " hari";
    } else if ($timeCalc >= (60 * 60 * 24)) {
        $timeCalc = " Kemarin";
    } else if ($timeCalc >= (60 * 60 * 2)) {
        $timeCalc = intval($timeCalc / 60 / 60) . " hours ago";
    } else if ($timeCalc >= (60 * 60)) {
        $timeCalc = intval($timeCalc / 60 / 60) . " jam";
    } else if ($timeCalc >= 60 * 2) {
        $timeCalc = intval($timeCalc / 60) . " menit";
    } else if ($timeCalc >= 60) {
        $timeCalc = intval($timeCalc / 60) . " menit";
    } else if ($timeCalc > 0) {
        $timeCalc .= " detik";
    }

    return $timeCalc;
}
