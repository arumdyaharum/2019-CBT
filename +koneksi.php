<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "cbt_48";
$conn = mysqli_connect($host, $user, $pass, $db);

//---fungsi2---//
function nama_situs($keterangan = "") {
	$ket = explode("_", $keterangan);
	if($ket[0] == "nama"){
		$jenis_sklh = "SMK";
		$no_sklh = "48";
		if($ket[1] == "shortcut"){
			$status = "N ";
			$tempat = " JKT";
		} else {
			$status = " Negeri ";
			$tempat = " Jakarta";
		}
		return $jenis_sklh.$status.$no_sklh.$tempat;
	} elseif($ket[0] == "alamat") {
		$data = "Jl. Radin Inten II No. 3 Buaran Klender Duren Sawit Jakarta Timur";
		return $data;
	} elseif($ket[0] == "notelp") {
		$data = "(021) 8617467";
		return $data;
	} elseif($ket[0] == "fax") {
		$data = "(021) 86613397";
		return $data;
	} elseif($ket[0] == "web") {
		$data = "http://smkn48jkt.sch.id";
		return $data;
	}
}

function baseURL($a = ""){
	echo str_replace("index.php", "", $_SERVER['PHP_SELF']);
	echo $a;
}

function url($a) {
	$URL = explode("/", $_SERVER['QUERY_STRING']);
	return @$URL[$a];
}

function kelamin($k){
	if($k == "P"){echo "Perempuan";}
	if($k == "W"){echo "Wanita";}
	if($k == "L"){echo "Laki-Laki";}
}

function getKelamin($bln){
	switch ($bln){
		case 'P': 
			return "Perempuan";
			break;
		case 'L':
			return "Laki-Laki";
			break;
	}
}

function tgl_indo($tgl) {
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}

function getBulan($bln){
	switch ($bln){
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