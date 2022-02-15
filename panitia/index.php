<?php 
include "../+koneksi.php";
session_start();
$id = url(2);
$id_dua = url(3);
$id_tiga = url(4);
@$no_table = 1;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
	<?php if(@$_SESSION['id_panitia']){
		if(url(0)==""){
			echo 'Beranda';
		} elseif(url(0)=="siswa_bio"){
			echo 'Bio Siswa';
		} elseif(url(0)=="daftar_siswa"){
			echo 'Daftar Siswa';
		} elseif(url(0)=="guru" || url(0)=="guru_bio"){
			echo 'Guru';
		} elseif(url(0)=="ujian" || url(0)=="paket_soal" || url(0)=="soal"){
			echo 'Ujian';
		} else {
			echo ucwords(url(0));
		}
		echo " - Panitia | ".nama_situs('nama_shortcut');
	}else{
		echo 'Login | '.nama_situs('nama_shortcut');
	}?>
</title>

<link href="<?=baseURL("css/bootstrap.min.css");?>" rel="stylesheet">
<link href="<?=baseURL("css/datepicker3.css");?>" rel="stylesheet">
<link href="<?=baseURL("css/bootstrap-table.css");?>" rel="stylesheet">
<link href="<?=baseURL("css/styles.css");?>" rel="stylesheet">
<link href="<?=baseURL("css/jquery.lwMultiSelect.css");?>" rel="stylesheet" />

<!--Icons-->
<script src="<?=baseURL("js/lumino.glyphs.js");?>"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

<style>
	.btn .glyph{
	width:16px;
	height:16px;
	stroke-width:3px;
	}
</style>

</head>

<body>

	<?php if(isset($_SESSION['id_panitia'])){?>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=baseURL();?>"><span>CBT </span><?=nama_situs('nama_shortcut')?></a>
				<ul class="user-menu">
					<li class="pull-right"><a href="<?=baseURL("logout");?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li role="presentation" class="divider"></li>
			<li<?php if(url(0)=="" || url(0)=="beranda") echo ' class="active"';?>><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg> Beranda</a></li>
			<li<?php if(url(0)=="daftar_siswa") echo ' class="active"';?>><a href="<?=baseURL("daftar_siswa");?>"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Pendaftaran Siswa</a></li>
			<li role="presentation" class="divider"></li>
			<li<?php if(url(0)=="siswa_bio" || url(0)=="siswa" || url(0)=="kelas") echo ' class="active"';?>><a href="<?=baseURL("kelas");?>"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Manajemen Siswa</a></li>
			<li<?php if(url(0)=="guru") echo ' class="active"';?>><a href="<?=baseURL("guru");?>"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Manajemen Guru</a></li>
			<li<?php if(url(0)=="mapel") echo ' class="active"';?>><a href="<?=baseURL("mapel");?>"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Manajemen Mapel</a></li>
			<li role="presentation" class="divider"></li>
			<li<?php if(url(0)=="ujian" || url(0)=="nilai" || url(0)=="paket_soal" || url(0)=="soal") echo ' class="active"';?>><a href="<?=baseURL("ujian");?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Manajemen Ujian</a></li>
			<li<?php if(url(0)=="berita") echo ' class="active"';?>><a href="<?=baseURL("berita");?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Manajemen Berita</a></li>
			<li<?php if(url(0)=="pengaturan") echo ' class="active"';?>><a href="<?=baseURL("pengaturan");?>"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"/></svg> Pengaturan</a></li>
			<li role="presentation" class="divider"></li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<?php
		if(url(0) == "") {
			include "inc/beranda.php";
		} elseif(url(0) == "logout"){
			@$_SESSION['id_panitia'] = null;
			@$_SESSION['nm_panitia'] = null;
			echo "<script>window.location='./';</script>";
		} else {
			include("inc/".url(0).".php");
		}
		?>
	</div><!--/.main-->	
	
	<?php }else{include "inc/login.php";}?>

	<script src="<?=baseURL("js/jquery-1.11.1.min.js");?>"></script>
	<script src="<?=baseURL("js/bootstrap.min.js");?>"></script>
	<script src="<?=baseURL("js/chart.min.js");?>"></script>
	<script src="<?=baseURL("js/chart-data.js");?>"></script>
	<script src="<?=baseURL("js/easypiechart.js");?>"></script>
	<script src="<?=baseURL("js/easypiechart-data.js");?>"></script>
	<script src="<?=baseURL("js/bootstrap-datepicker.js");?>"></script>
	<script src="<?=baseURL("js/bootstrap-table.js");?>"></script>
	<script src="<?=baseURL("js/jquery.lwMultiSelect.js");?>"></script>
	
	<script>	
$(document).ready(function(){  
	$('#multiselect').lwMultiSelect();
});  		
	</script>	
</body>

</html>
