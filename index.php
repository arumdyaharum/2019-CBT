<?php
@session_start();
include ("+koneksi.php");
$id = url(2);
$id_dua = url(3);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CBT <?=nama_situs('nama_shortcut');?></title>

    <link href="<?=baseURL("css/Playfair.css");?>" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="<?=baseURL("css/bootstrap.min.css");?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=baseURL("css/blog.css");?>" rel="stylesheet">
	
	<style>	  
	  .w-max{max-width:50%;}
	
.table-soal .ngumpet {
	display:none;
	}	
	
.table-soal .muncul {
	display:block;
	}
    </style>
  </head>
  <body>

<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-2 flex-fill w-max">
        <a class="blog-header-logo text-dark" href="<?=baseURL();?>"><?=nama_situs('nama_');?></a>
      </div>
      <div class="col-2 d-flex flex-fill w-max justify-content-end align-items-center">
	<?php if(!@$_SESSION['id_siswa']){?>
		<div style="border-right:1px solid #aaa; padding-right:1rem; margin-right:1rem;"><a class="btn btn-sm btn-outline-secondary" href="<?=baseURL("daftar");?>">Daftar</a></div>
		<div style="padding-right:.25rem; margin-right:.25rem;"><a class="btn btn-sm btn-outline-secondary" href="./">Masuk</a></div>
	<?php }else{
		if(url(0)=="soal"){?>
        <div style="padding-right:.25rem; margin-right:.25rem;"><a class="text-muted"><?= $_SESSION['nm_siswa'];?></a></div>
		<?php }else{?>
        <div style="padding-right:.25rem; margin-right:.25rem;"><a class="text-muted" href="<?=baseURL("profil");?>"><?= $_SESSION['nm_siswa'];?></a></div><div style="border-right:1px solid #aaa; padding-right:1rem; margin-right:1rem;"><a class="btn btn-sm btn-outline-secondary" href="<?=baseURL("profil");?>">Profil</a></div>
        <a class="btn btn-sm btn-outline-secondary" href="<?=baseURL("logout");?>">Log Out</a>
	<?php }}?>
      </div>
    </div>
  </header>
<div class="wrap">
<?php if(!@$_SESSION['id_siswa']){
		if(url(0)=='daftar') {
      include("inc/daftar.php");
    } else {
      include("inc/login.php");
    }
	  }else{
		  if(@$_GET['page'] != 'soal'){?>
  <div class="nav-scroller py-1 border-bottom">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" <?php if(url(0)==""){echo 'style="text-decoration:underline;"';}?> href="<?=baseURL();?>">Beranda</a>
      <a class="p-2 text-muted" <?php if(url(0)=="ujian"){echo 'style="text-decoration:underline;"';}?> href="<?=baseURL("ujian");?>">Ujian</a>
      <a class="p-2 text-muted" <?php if(url(0)=="nilai"){echo 'style="text-decoration:underline;"';}?> href="<?=baseURL("nilai");?>">Nilai</a>
    </nav>
  </div>
		<?php 
		  }
        if(url(0) == "") {
          include "inc/beranda.php";
        } elseif(url(0) == "logout"){
          @$_SESSION['id_siswa'] = null;
          @$_SESSION['nm_siswa'] = null;
          echo "<script>window.location='./';</script>";
        } else {
          include("inc/".url(0).".php");
        }
      //   if(@$_GET['page'] == '') {
      //       include ("inc/beranda.php");
      //   } else if(@$_GET['page'] == 'ujian') {
      //       include ("inc/ujian.php");
      //   } else if(@$_GET['page'] == 'soal') {
      //       include ("inc/soal.php");
      //   } else if(@$_GET['page'] == 'selesai') {
      //       include ("inc/selesai.php");
      //   } else if(@$_GET['page'] == 'nilai') {
      //       include ("inc/nilai.php");
      //   } else if(@$_GET['page'] == 'profil') {
      //       include ("inc/profil.php");
      //   } else if(@$_GET['page'] == 'logout') {
			// @$_SESSION['id_siswa'] = null;
			// @$_SESSION['nm_siswa'] = null;
			// echo "<script>window.location='./';</script>";
      //   } else {
      //     echo "<script>window.location='./';</script>";
      //   }
        }?></div>
<footer class="blog-footer">&copy;Bootstrap Examples edited by Dyah Achwatiningrum | <a href="#">Back to top</a></footer>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=baseURL("js/jquery-3.3.1.min.js");?>"></script>
    <script src="<?=baseURL("js/popper.min.js");?>"></script>
    <script src="<?=baseURL("js/bootstrap.min.js");?>"></script>
    <script src="<?=baseURL("js/holder.min.js");?>"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
		
	$('document').ready(function(){
    $('#prev').hide();
    $('#kirim').hide();
	});	

	$('.page').click(function () {
    var waktu = countDownDate;
    var id_siswa = $("input[name='id_paket']").val();
    var id_paket = $("input[name='id_paket']").val();
    var id_soal = $("table.muncul input[name='id_soal']").val();
    var jawab = $("input[name='pilihan_ganda["+id_soal+"]']:checked").val();
    console.log(waktu+"/"+id_siswa+"/"+id_paket+"/"+id_soal+"/"+jawab);
 
    $.ajax({  
          url:"<?=baseURL("inc/autosave.php");?>",  
          method:"POST",  
          data:{waktu:waktu, id_paket:id_paket, id_siswa:id_siswa, id_soal:id_soal, jawab:jawab}, 
          success:function(data)  
          {  
            console.log(data);  
          }  
    });

		var nomor = $(this).attr('id');
    var soal = $('table#' + nomor + '.ngumpet');
		
      $('#prev').show();
      $('#next').show();
      $('#kirim').hide();
    
    $('table.muncul').removeClass('muncul');
		soal.addClass('muncul');
	});

	$("#next").click(function () {
    var waktu = countDownDate;
    var id_siswa = $("input[name='id_paket']").val();
    var id_paket = $("input[name='id_paket']").val();
    var id_soal = $("table.muncul input[name='id_soal']").val();
    var jawab = $("input[name='pilihan_ganda["+id_soal+"]']:checked").val();
    console.log(waktu+"/"+id_siswa+"/"+id_paket+"/"+id_soal+"/"+jawab);
 
    $.ajax({  
          url:"<?=baseURL("inc/autosave.php");?>",  
          method:"POST",  
          data:{waktu:waktu, id_paket:id_paket, id_siswa:id_siswa, id_soal:id_soal, jawab:jawab}, 
          success:function(data)  
          {  
            console.log(data);  
          }  
    });

    var nextItem  = $('table.muncul').removeClass('muncul').next();
		if (!nextItem.length) {
			nextItem = $('table.ngumpet').first();
		}
		nextItem.addClass('muncul');
		$('#prev').show();
		var last = $('table.ngumpet').last();
		
		if(nextItem.is(last)) {
			$('#next').hide(); $('#kirim').show();
		}
	});
			
	$("#prev").click(function () {
    var waktu = countDownDate;
    var id_siswa = $("input[name='id_paket']").val();
    var id_paket = $("input[name='id_paket']").val();
    var id_soal = $("table.muncul input[name='id_soal']").val();
    var jawab = $("input[name='pilihan_ganda["+id_soal+"]']:checked").val();
    console.log(waktu+"/"+id_siswa+"/"+id_paket+"/"+id_soal+"/"+jawab);
 
    $.ajax({  
          url:"<?=baseURL("inc/autosave.php");?>",  
          method:"POST",  
          data:{waktu:waktu, id_paket:id_paket, id_siswa:id_siswa, id_soal:id_soal, jawab:jawab}, 
          success:function(data)  
          {  
            console.log(data);  
          }  
    });

		var nextItem  = $('table.muncul').removeClass('muncul').prev();
		if (!nextItem.length) {
			nextItem = $('table.ngumpet').first();
		}
		nextItem.addClass('muncul');
		$('#next').show(); $('#kirim').hide();
		var first = $('table.ngumpet').first();
		
		if(nextItem.is(first)) {
			$('#prev').hide();
		}
	});
    </script>
  </body>
</html>
