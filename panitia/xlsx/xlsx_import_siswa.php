<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$id = $_POST['kelas'];
$sumber = @$_FILES['excel']['tmp_name'];
$target = 'excel/';
$nama = @$_FILES['excel']['name'];
$type = pathinfo($nama, PATHINFO_EXTENSION);

if($type != 'xlsx') {
    echo "<script>window.location='../siswa/tambah/".$id."/import?error=type';</script>";
} else {
move_uploaded_file($sumber, $target.$nama);
$spreadsheet = IOFactory::load($target.$nama);

$sheetData = $spreadsheet->getActiveSheet()->toArray();
// hapus baris pertama
unset($sheetData[0]);

foreach ($sheetData as $t) {
	$kelas_explode = explode("-", $t[3]);
    $kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT id_kelas FROM tb_kelas WHERE tingkat = '$kelas_explode[0]' AND jurusan = '$kelas_explode[1]'"));

    $d = DateTime::createFromFormat('d/m/Y', $t[4]);
    $date = $d->format('Y-m-d');

    mysqli_query($conn, "INSERT INTO tb_siswa VALUES ('', '$t[1]', '$t[2]', '$kelas[id_kelas]', '$date', '$t[5]', '$t[6]', sha2('$t[7]',0), '$t[7]', 'aktif')");
}
echo "<script>window.location='../siswa/index/".$id."';</script>";
}