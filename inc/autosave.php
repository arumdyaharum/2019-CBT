<?php
@SESSION_START();
include "../+koneksi.php";

if(isset($_POST['jawab'])){
$id_paket = mysqli_real_escape_string($conn, $_POST['id_paket']);
$id_siswa = mysqli_real_escape_string($conn, $_POST['id_siswa']);
$id_soal = mysqli_real_escape_string($conn, $_POST['id_soal']);
$waktu = mysqli_real_escape_string($conn, $_POST['waktu']);
$jawab = mysqli_real_escape_string($conn, $_POST['jawab']);

$cek_waktu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_waktu WHERE id_paket = '$id_paket' AND id_siswa = '$id_siswa'"));

$cek_jawab = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_jawaban WHERE id_paket = '$id_paket' AND id_soal = '$id_soal' AND id_siswa = '$id_siswa'"));

if($cek_waktu > 0) {
    mysqli_query($conn, "UPDATE tb_waktu SET waktu = '$waktu' WHERE id_paket = '$id_paket' AND id_siswa = '$id_siswa'");
    echo "data waktu diperbaharui ";
} else {
    mysqli_query($conn, "INSERT INTO tb_waktu VALUES ('', '$id_paket', '$id_siswa', '$waktu')");
    echo "data waktu ditambah ";
}

if($cek_jawab > 0) {
    mysqli_query($conn, "UPDATE tb_jawaban SET jawab = '$jawab' WHERE id_paket = '$id_paket' AND id_siswa = '$id_siswa' AND id_soal = '$id_soal'");
    echo "data jawaban diperbaharui";
} else {
    mysqli_query($conn, "INSERT INTO tb_jawaban VALUES ('', '$id_paket', '$id_soal', '$id_siswa', '$jawab')");
    echo "data jawaban ditambah";
}

} else {
    echo "jawaban Kosong";
}
?>