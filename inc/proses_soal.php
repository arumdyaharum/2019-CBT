<?php
@SESSION_START();
include "../+koneksi.php";

$id_paket = mysqli_real_escape_string($conn, $_POST['id_paket']);

if($_POST['pilihan_ganda']){
	$benar = 0;
	$salah = 0;
	foreach($_POST['pilihan_ganda'] as $key => $value){
		$query_cek_pilgan = mysqli_query($conn, "SELECT kunci FROM tb_soal WHERE id_soal = '$key'");
		while($cek_pilgan = mysqli_fetch_array($query_cek_pilgan)){
			$jawaban = $cek_pilgan['kunci'];
		}
		if($value == $jawaban){
			$benar++;
		}else{
			$salah++;
		}
	}
	$jumlah = $_POST['jumlah_soal_pilgan'];
	$kosong = $jumlah - $benar - $salah;
	$nilai = ($benar / $jumlah) * 100;
	mysqli_query($conn, "INSERT INTO tb_nilai(id_paket, id_siswa, benar, salah, kosong, nilai) VALUES ('$id_paket', '$_SESSION[id_siswa]', '$benar', '$salah', '$kosong', '$nilai')");
}
?>
<script>window.location='<?=baseURL("selesai/index/".$_POST['id_paket']);?>';</script>