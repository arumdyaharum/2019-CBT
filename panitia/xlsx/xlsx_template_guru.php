<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'NIP');
$sheet->setCellValue('C1', 'Nama Lengkap');
$sheet->setCellValue('D1', 'Kelamin');

$sheet->setCellValue('A2', 'Contoh');
$sheet->setCellValue('B2', '123456');
$sheet->setCellValue('C2', 'Dyah Achwatiningrum');
$sheet->setCellValue('D2', 'P/L');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Template Guru.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');