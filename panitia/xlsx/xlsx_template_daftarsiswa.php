<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(10);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'NISN');
$sheet->setCellValue('C1', 'Nama Lengkap');
$sheet->setCellValue('D1', 'Kelas');
$sheet->setCellValue('E1', 'Tanggal Lahir');
$sheet->setCellValue('F1', 'Kelamin');
$sheet->setCellValue('G1', 'Username');
$sheet->setCellValue('H1', 'Password');

$sheet->setCellValue('A2', 'Contoh');
$sheet->setCellValue('B2', '123456');
$sheet->setCellValue('C2', 'Dyah Achwatiningrum');
$sheet->setCellValue('D2', 'XII-MM');
$sheet->setCellValue('E2', 'HH/BB/TTTT');
$sheet->setCellValue('F2', 'P/L');
$sheet->setCellValue('G2', '123456');
$sheet->setCellValue('H2', '123456');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Template Daftar Siswa.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');