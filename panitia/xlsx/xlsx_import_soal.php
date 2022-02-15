<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$id = $_POST['id'];
$sumber = @$_FILES['excel']['tmp_name'];
$target = 'excel/';
$nama = @$_FILES['excel']['name'];
$type = pathinfo($nama, PATHINFO_EXTENSION);

if($type != 'xlsx') {
    echo "<script>window.location='..?page=soal&id=".$id."&action=tambah&import=1&error=type';</script>";
} else {
move_uploaded_file($sumber, $target.$nama);
$spreadsheet = IOFactory::load($target.$nama);

$sheetData = $spreadsheet->getActiveSheet()->toArray();
// hapus baris pertama
unset($sheetData[0]);

foreach ($sheetData as $t) {
    mysqli_query($conn, "INSERT INTO tb_soal VALUES ('', '$id', '$t[1]', '', '$t[2]', '$t[3]', '$t[4]', '$t[5]', '$t[6]', '$t[7]')");
}
echo "<script>window.location='..?page=soal&id=".$id."';</script>";
}