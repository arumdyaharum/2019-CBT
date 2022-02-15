<?php 
$data_selesai = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_nilai nilai JOIN tb_paket_soal paket ON nilai.id_paket = paket.id_paket JOIN tb_ujian ujian ON paket.id_ujian = ujian.id_ujian JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel WHERE nilai.id_paket = '$id'"));
?>
<main role="main" class="container mt-4 text-center">
  <div class="row">
	<div class="col-md-12 blog-main">
	  <div class="blog-post">
		<h2 class="blog-post-title"><?php echo $data_selesai['nama_mapel'];?></h2>
		<p class="blog-post-meta"><?php echo $data_selesai['judul'].' TA '.$data_selesai['thn_ajar'];?></p>
		<hr>

		<p>
		Benar : <?php echo $data_selesai['benar'];?> &nbsp; &nbsp; Salah : <?php echo $data_selesai['salah'];?> &nbsp; &nbsp; Kosong : <?php echo $data_selesai['kosong'];?></p><br>
		<h3>Nilai</h3>
		<h3><?php echo $data_selesai['nilai'];?></h3>
		<br>
		<br>
		<a class="btn btn-outline-secondary" href="<?=baseURL();?>">Beranda</a>
		<a class="btn btn-primary" href="<?=baseURL("nilai/detail/".$data_selesai['id_ujian']);?>">Lihat Semua Nilai</a>
		
	  </div><!-- /.blog-post -->
	</div><!-- /.blog-main -->

  </div><!-- /.row -->

</main><!-- /.container -->
