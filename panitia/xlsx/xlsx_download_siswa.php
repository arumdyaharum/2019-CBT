<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$id = @$_GET['k'];
$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas = $id"));
$query_data = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE kelas = $id AND status = 'Aktif'");
$row = 2;
$no = 1;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'NISN');
$sheet->setCellValue('C1', 'Nama Lengkap');
$sheet->setCellValue('D1', 'Kelas');
$sheet->setCellValue('E1', 'Tanggal Lahir');
$sheet->setCellValue('F1', 'Kelamin');

while($data = mysqli_fetch_array($query_data)){
    $sheet->setCellValue('A'.$row, $no++.'.');
    $sheet->setCellValue('B'.$row, $data['nis']);
    $sheet->setCellValue('C'.$row, $data['nama']);
    $sheet->setCellValue('D'.$row, $kelas['tingkat'].'-'.$kelas['jurusan']);
    $sheet->setCellValue('E'.$row, tgl_indo($data['tgl_lahir']));
    $sheet->setCellValue('F'.$row++, getKelamin($data['kelamin']));
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Daftar Siswa Kelas '.$kelas['tingkat'].'-'.$kelas['jurusan'].'.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');