<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query_guru = mysqli_query($conn, "SELECT * FROM tb_guru");
$row = 2;
$no = 1;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'NIP');
$sheet->setCellValue('C1', 'Nama Lengkap');
$sheet->setCellValue('D1', 'Kelamin');

while($data_guru = mysqli_fetch_array($query_guru)){
    $sheet->setCellValue('A'.$row, $no++.'.');
    $sheet->setCellValue('B'.$row, $data_guru['nip']);
    $sheet->setCellValue('C'.$row, $data_guru['nama_guru']);
    $sheet->setCellValue('D'.$row++, getKelamin($data_guru['kelamin']));
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Daftar Guru.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');