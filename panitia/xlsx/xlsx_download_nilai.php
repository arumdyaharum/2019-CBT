<?php
require 'vendor/autoload.php';
include "../../+koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$id_u = @$_GET['u'];
$id_k = @$_GET['k'];
$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas = $id_k"));
$paket = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_mapel FROM tb_mapel a JOIN tb_paket_soal b ON a.id_mapel = b.id_mapel WHERE b.id_paket = $id_u"));
$query_data = mysqli_query($conn, "SELECT * FROM tb_nilai a JOIN tb_siswa b ON a.id_siswa = b.id WHERE a.id_paket = $id_u AND b.kelas = $id_k");
$row = 2;
$no = 1;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(10);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(5);
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Kelas');
$sheet->setCellValue('C1', 'Nama Lengkap');
$sheet->setCellValue('D1', 'Nilai');

while($data = mysqli_fetch_array($query_data)){
    $sheet->setCellValue('A'.$row, $no++.'.');
    $sheet->setCellValue('B'.$row, $kelas['tingkat'].'-'.$kelas['jurusan']);
    $sheet->setCellValue('C'.$row, $data['nama']);
    $sheet->setCellValue('D'.$row++, $data['nilai']);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// nama file result.xlsx
header('Content-Disposition: attachment;filename="Nilai '.$paket['nama_mapel'].' Kelas '.$kelas['tingkat'].'-'.$kelas['jurusan'].'.xlsx"');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');