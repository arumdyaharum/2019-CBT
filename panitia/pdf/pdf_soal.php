<?php
include "../../+koneksi.php";
require('fpdf.php');
$id = @$_POST['id'];
$id_kelas = @$_POST['kelas'];
$id_guru = @$_POST['guru'];

class PDF extends FPDF
{
// Page header
function Header()
{
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

protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html, $br)
{
	// HTML parser
	$html = str_replace("\n",' ',$html);
	$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);

	foreach($a as $i=>$e)
	{
		if($i%2==0)
		{
			// Text
			if($this->HREF) {
				$this->PutLink($this->HREF,$e);
			} else {
				$this->SetLeftMargin($br);
				$this->Write(5,$e);
				$this->SetLeftMargin(10);
			}
		}
		else
		{
			// Tag
			if($e[0]=='/')
				$this->CloseTag(strtoupper(substr($e,1)));
			else
			{
				// Extract attributes
				$a2 = explode(' ',$e);
				$tag = strtoupper(array_shift($a2));
				$attr = array();
				foreach($a2 as $v)
				{
					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						$attr[strtoupper($a3[1])] = $a3[2];
				}
				$this->OpenTag($tag,$attr);
			}
		}
	}
}

function OpenTag($tag, $attr)
{
	// Opening tag
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,true);
	if($tag=='A')
		$this->HREF = $attr['HREF'];
	if($tag=='BR')
		$this->Ln(5);
}

function CloseTag($tag)
{
	// Closing tag
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,false);
	if($tag=='A')
		$this->HREF = '';
}

function SetStyle($tag, $enable)
{
	// Modify style and select corresponding font
	$this->$tag += ($enable ? 1 : -1);
	$style = '';
	foreach(array('B', 'I', 'U') as $s)
	{
		if($this->$s>0)
			$style .= $s;
	}
	$this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
	// Put a hyperlink
	$this->SetTextColor(0,0,255);
	$this->SetStyle('U',true);
	$this->Write(5,$txt,$URL);
	$this->SetStyle('U',false);
	$this->SetTextColor(0);
}
}

$data_paket = mysqli_fetch_array(mysqli_query($conn, "select * from tb_paket_soal a JOIN tb_ujian b ON a.id_ujian = b.id_ujian JOIN tb_mapel c ON a.id_mapel = c.id_mapel where a.id_paket='$id'"));

$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT tingkat, jurusan FROM tb_kelas WHERE id_kelas = '$id_kelas'"));
		
$guru = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_guru FROM tb_guru WHERE id_guru = '$id_guru'"));

$query_soal = mysqli_query($conn, "select * from tb_soal where id_paket = '$id'");
$jumlah_soal = mysqli_num_rows($query_soal);
$no = 1;

// Start Page
$pdf = new PDF('P','mm','A4');
$pdf->AddPage();


$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,5,strtoupper(nama_situs('nama_')),'0','1','C',false);

$pdf->SetFont('Arial','i',8);
$pdf->Cell(0,5,'Alamat : '.strtoupper(nama_situs('alamat_')),'0','1','C',false);
$pdf->Cell(0,2,'Telp : '.nama_situs('notelp_').', Fax : '.nama_situs('fax_').' - Web : '.nama_situs('web_'),'0','1','C',false);

$pdf->Ln(3);
$pdf->Cell(0,0.6,'','0','1','C',true);
$pdf->Ln(5);

$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(40,6,'Mata Pelajaran',0,0,'');
$pdf->Cell(50,6,': '.$data_paket['nama_mapel'],0,0,'');
$pdf->Cell(20);
$pdf->Cell(35,6,'Waktu',0,0,'');
$pdf->Cell(50,6,': '.($data_paket['waktu']/60).' Menit',0,0,'');
$pdf->Ln();
$pdf->Cell(10);
$pdf->Cell(40,6,'Pengajar',0,0,'');
$pdf->Cell(50,6,': '.$guru['nama_guru'],0,0,'');
$pdf->Cell(20);
$pdf->Cell(35,6,'Jumlah Soal',0,0,'');
$pdf->Cell(50,6,': '.$jumlah_soal,0,0,'');
$pdf->Ln();
$pdf->Cell(10);
$pdf->Cell(40,6,'Kelas',0,0,'');
$pdf->Cell(150,6,': '.$kelas['tingkat'].'-'.$kelas['jurusan'],0,0,'');
$pdf->Ln();

$pdf->Ln(5);
$pdf->Cell(0,0.6,'','0','1','C',true);
$pdf->Ln(5);

$w = array(10, 150, 7, 150); // total 190

$pdf->SetFont('Arial','',12);
while($data = mysqli_fetch_array($query_soal)) {
	if($data['gambarSoal']) {
		$gambar_explode = explode('.', $data['gambarSoal']);
		$pdf->Image('../../img/soal/'.$id.'_'.$data['gambarSoal'],$pdf->GetX(),$pdf->GetY(),0,60,$gambar_explode[1]);
		$pdf->Ln(60);
	}
	$y=$pdf->GetY();
	if($y>=260) {
		$pdf->AddPage();
	}
	$pdf->Cell($w[0],6,$no++.'.',0,0,'');
	if($y>=260) {
		$ymin = 260+($y%271);
		$pdf->SetXY(10,$y-$ymin);
	} else {
		$pdf->SetXY(10,$y);
	}
	$pertanyaan = $pdf->WriteHTML($data['pertanyaan'].$y,10+$w[0]);
	// $wrap_text = $pdf->WordWrap($pertanyaan, $w[1]);
	$pdf->MultiCell($w[1],6,$pertanyaan,0,0,'');
	$pdf->Cell($w[0]);
	$pdf->Cell($w[2],6,'A.',0,0,'');
	$pdf->MultiCell($w[3],6,$data['pil_A'],0,1,'');
	$pdf->Cell($w[0]);
	$pdf->Cell($w[2],6,'B.',0,0,'');
	$pdf->MultiCell($w[3],6,$data['pil_B'],0,1,'');
	$pdf->Cell($w[0]);
	$pdf->Cell($w[2],6,'C.',0,0,'');
	$pdf->MultiCell($w[3],6,$data['pil_C'],0,1,'');
	$pdf->Cell($w[0]);
	$pdf->Cell($w[2],6,'D.',0,0,'');
	$pdf->MultiCell($w[3],6,$data['pil_D'],0,1,'');
	$pdf->Cell($w[0]);
	$pdf->Cell($w[2],6,'E.',0,0,'');
	$pdf->MultiCell($w[3],6,$data['pil_E'],0,1,'');
	$pdf->Ln();
}
// metode download(kosongin aja), nama file
$pdf->Output('','Soal '.$data_paket['nama_mapel'].' Kelas '.$kelas['tingkat'].'-'.$kelas['jurusan'].'.pdf');
?>