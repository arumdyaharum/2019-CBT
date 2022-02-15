<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";
$id = @$_GET['id'];

$mapel = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_paket_soal a JOIN tb_mapel c ON a.id_mapel = c.id_mapel where a.id_paket='$id'"));

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(50);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(10);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Pertanyaan');
$sheet->setCellValue('C1', 'Pilihan A');
$sheet->setCellValue('D1', 'Pilihan B');
$sheet->setCellValue('E1', 'Pilihan C');
$sheet->setCellValue('F1', 'Pilihan D');
$sheet->setCellValue('G1', 'Pilihan E');
$sheet->setCellValue('H1', 'Jawaban');

$sheet->setCellValue('A2', 'Contoh');
$sheet->setCellValue('B2', 'Hewan berkaki 2 adalah ');
$sheet->setCellValue('C2', 'Ayam');
$sheet->setCellValue('D2', 'Ikan');
$sheet->setCellValue('E2', 'Kuda');
$sheet->setCellValue('F2', 'Ular');
$sheet->setCellValue('G2', 'Singa');
$sheet->setCellValue('H2', 'A');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Template Soal '.$mapel['nama_mapel'].'.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');