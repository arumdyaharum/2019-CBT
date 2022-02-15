<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$sumber = @$_FILES['excel']['tmp_name'];
$target = 'excel/';
$nama = @$_FILES['excel']['name'];
$type = pathinfo($nama, PATHINFO_EXTENSION);

if($type != 'xlsx') {
    echo "<script>window.location='../kelas/tambah/import?error=type';</script>";
} else {
move_uploaded_file($sumber, $target.$nama);
$spreadsheet = IOFactory::load($target.$nama);

$sheetData = $spreadsheet->getActiveSheet()->toArray();
// hapus baris pertama
unset($sheetData[0]);

foreach ($sheetData as $t) {
    mysqli_query($conn, "INSERT INTO tb_kelas VALUES ('', '$t[1]', '$t[2]')");
}
echo "<script>window.location='../kelas';</script>";
}