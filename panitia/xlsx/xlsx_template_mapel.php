<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(50);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Nama Mata Pelajaran');

$sheet->setCellValue('A2', 'Contoh');
$sheet->setCellValue('B2', 'Matematika');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Template Mapel.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');