<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Tingkat');
$sheet->setCellValue('C1', 'Jurusan');

$sheet->setCellValue('A2', 'Contoh');
$sheet->setCellValue('B2', 'XII');
$sheet->setCellValue('C2', 'MM');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Template Kelas.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');