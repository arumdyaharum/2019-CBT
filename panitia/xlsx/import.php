<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = IOFactory::load('hello world.xlsx');

// menghitung jumlah baris
$d=$spreadsheet->getSheet(0)->toArray();
echo count($d);

$sheetData = $spreadsheet->getActiveSheet()->toArray();
$i=1;
// hapus baris pertama
unset($sheetData[0]);

foreach ($sheetData as $t) {
	echo $i."---".$t[0].",".$t[1]." <br>";
	$i++;
}