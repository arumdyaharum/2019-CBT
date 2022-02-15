<?php
include "../../+koneksi.php";
require('fpdf.php');
$id_k = @$_GET['k'];

$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas = $id_k"));

class PDF extends FPDF
{
// Page header
function Header()
{
	$this->SetFont('Arial','B',18);
	// width, height, text, border, line(1), align, garis
	$this->Cell(0,5,strtoupper(nama_situs('nama_')),'0','1','C',false);

	$this->SetFont('Arial','i',8);
	$this->Cell(0,5,'Alamat : '.strtoupper(nama_situs('alamat_')),'0','1','C',false);
	$this->Cell(0,2,'Telp : '.nama_situs('notelp_').', Fax : '.nama_situs('fax_').' - Web : '.nama_situs('web_'),'0','1','C',false);

	// spasi vertikal 3mm
	$this->Ln(3);
	$this->Cell(0,0.6,'','0','1','C',true);
	$this->Ln(5);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,6,'Daftar Siswa Kelas '.$kelas['tingkat'].'-'.$kelas['jurusan'],0,1,'C');
$pdf->Ln();

$w = array(10, 20, 70, 20, 40, 30); // total 190

$pdf->SetFont('Arial','B',11);
	$pdf->Cell($w[0],6,'No.',1,0,'C');
	$pdf->Cell($w[1],6,'NISN',1,0,'C');
	$pdf->Cell($w[2],6,'Nama Lengkap',1,0,'C');
	$pdf->Cell($w[3],6,'Kelas',1,0,'C');
	$pdf->Cell($w[4],6,'Tanggal Lahir',1,0,'C');
	$pdf->Cell($w[5],6,'Kelamin',1,0,'C');
	// otomatis baris baru
	$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$no = 1;
$query_data = mysqli_query($conn, "SELECT * FROM tb_siswa a JOIN tb_kelas b ON a.kelas = b.id_kelas WHERE a.kelas = $id_k AND a.status = 'aktif'");
while($data = mysqli_fetch_array($query_data)) {
	$pdf->Cell($w[0],6,$no++.'.',1,0,'C');
	$pdf->Cell($w[1],6,$data['nis'],1,0,'C');
	$pdf->Cell($w[2],6,$data['nama'],1,0,'C');
	$pdf->Cell($w[3],6,$data['tingkat'].'-'.$data['jurusan'],1,0,'C');
	$pdf->Cell($w[4],6,tgl_indo($data['tgl_lahir']),1,0,'C');
	$pdf->Cell($w[5],6,getKelamin($data['kelamin']),1,0,'C');
	$pdf->Ln();
}

$pdf->Ln(10);
// biar posisi di kanan halaman
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Jakarta, ".tgl_indo(date('Y-m-d')),0,0,'R');

// metode download(kosongin aja), nama file
$pdf->Output('','Daftar Siswa Kelas '.$kelas['tingkat'].'-'.$kelas['jurusan'].'.pdf');
?>