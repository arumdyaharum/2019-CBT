	<?php
	$data_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_siswa siswa JOIN tb_kelas kelas ON siswa.kelas = kelas.id_kelas WHERE id = '$_SESSION[id_siswa]'"));
	$query_highscore = mysqli_query($conn, "SELECT * FROM tb_nilai_pilgan nilai JOIN tb_siswa siswa ON nilai.id_siswa = siswa.id JOIN tb_kelas kelas ON siswa.kelas = kelas.id_kelas WHERE kelas.tingkat = '$data_siswa[tingkat]' GROUP BY kelas.jurusan ORDER BY nilai.nilai DESC LIMIT 3");
	?>
	  <div class="jumbotron p-5 text-white rounded bg-dark">
		  <div class="row">
			<div class="col-md-12 text-center">
			  <h1 class="display-4 font-italic">Welcome</h1>
			  <p class="lead">Selamat Datang di Website CBT SMK Negeri 48 Jakarta</p>
			</div>
		  </div>
      </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
            Berita Ujian
          </h3>
		<?php
		$query_berita = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'terbit' ORDER BY id_berita DESC");
		while($data_berita = mysqli_fetch_array($query_berita)){
		?>
          <div class="blog-post" id="<?= $data_berita['id_berita'];?>">
            <h2 class="blog-post-title"><?= $data_berita['judul'];?></h2>
            <p class="blog-post-meta"><?= tgl_indo($data_berita['tgl_buat']);?></p>

            <p><?= $data_berita['isi'];?></p>
          </div><!-- /.blog-post -->
		<?php }?>

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">

          <div class="p-3">
            <h4 class="font-italic">Daftar Berita Ujian</h4>
            <ol class="list-unstyled mb-0">
              
		<?php
		$query_berita_list = mysqli_query($conn, "SELECT * FROM tb_berita WHERE status = 'terbit' ORDER BY id_berita DESC");
		while($data_berita_list = mysqli_fetch_array($query_berita_list)){
		?>
			  <li><a href="#<?= $data_berita_list['id_berita'];?>"><?= $data_berita_list['judul'];?></a></li>
		<?php }?>
            </ol>
          </div>

        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->