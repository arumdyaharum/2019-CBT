<?php if(url(1) == ""){?>
      <div class="row mt-3">
		<div class="col-md-12">
          <h3 class="pb-3 font-italic border-bottom  text-center">
            Daftar Ujian
          </h3>
		</div>
		<div class="col-md-4">
		<?php
		$query_ujian_1 = mysqli_query($conn, "
		SELECT * 
		FROM ( 
			SELECT 
				@row := @row +1 AS rownum, u.*
			FROM ( 
				SELECT @row :=0
			) r, tb_ujian u 
			WHERE u.id_ujian IN (
				SELECT id_ujian
				FROM tb_paket_soal
				WHERE FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas) && status = 'aktif'
			) ORDER BY id_ujian DESC
		) ranked 
		WHERE rownum % 3 = 1");
		while($data_ujian_1 = mysqli_fetch_array($query_ujian_1)){
			$data_jumlah_ujian1 = mysqli_num_rows(mysqli_query($conn, "select id_paket from tb_paket_soal where id_ujian = '$data_ujian_1[id_ujian]' AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas)"));
			$data_jumlah_nilai1 = mysqli_num_rows(mysqli_query($conn, "select nilai.id_nilai from tb_nilai nilai JOIN tb_paket_soal paket ON nilai.id_paket = paket.id_paket where paket.id_ujian = '$data_ujian_1[id_ujian]' AND FIND_IN_SET('$_SESSION[kelas_siswa]', paket.id_kelas) AND nilai.id_siswa = '$_SESSION[id_siswa]'"));
		?>
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">TA <?php echo $data_ujian_1['thn_ajar'];?></strong>
              <h3 class="mb-0">
                <a class="text-dark" href="<?=baseURL("ujian/detail/".$data_ujian_1['id_ujian']);?>"><?php echo $data_ujian_1['judul'];?></a>
              </h3>
              <p class="card-text mb-auto">Ujian Tersedia : <?php echo $data_jumlah_ujian1;?> Mapel<br>Ujian Selesai : <?php echo $data_jumlah_nilai1;?> Mapel</p>
              <a href="<?=baseURL("ujian/detail/".$data_ujian_1['id_ujian']);?>">Lihat Ujian</a>
            </div>
          </div>
		<?php }?>
        </div>
        <div class="col-md-4">
		<?php $query_ujian_2 = mysqli_query($conn, "
		SELECT * 
		FROM ( 
			SELECT 
				@row := @row +1 AS rownum, u.*
			FROM ( 
				SELECT @row :=2
			) r, tb_ujian u
			WHERE u.id_ujian IN (
				SELECT id_ujian
				FROM tb_paket_soal
				WHERE FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas) && status = 'aktif'
			) ORDER BY id_ujian DESC
		) ranked 
		WHERE rownum % 3 = 1");
		while($data_ujian_2 = mysqli_fetch_array($query_ujian_2)){
			$data_jumlah_ujian2 = mysqli_num_rows(mysqli_query($conn, "select id_paket from tb_paket_soal where id_ujian = '$data_ujian_2[id_ujian]' AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas)"));
			$data_jumlah_nilai2 = mysqli_num_rows(mysqli_query($conn, "select nilai.id_nilai from tb_nilai nilai JOIN tb_paket_soal paket ON nilai.id_paket = paket.id_paket where paket.id_ujian = '$data_ujian_2[id_ujian]' AND FIND_IN_SET('$_SESSION[kelas_siswa]', paket.id_kelas) AND nilai.id_siswa = '$_SESSION[id_siswa]'"));
		?>
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">TA <?php echo $data_ujian_2['thn_ajar'];?></strong>
              <h3 class="mb-0">
                <a class="text-dark" href="<?=baseURL("ujian/detail/".$data_ujian_2['id_ujian']);?>"><?php echo $data_ujian_2['judul'];?></a>
              </h3>
              <p class="card-text mb-auto">Ujian Tersedia : <?php echo $data_jumlah_ujian2;?> Mapel<br>Ujian Selesai : <?php echo $data_jumlah_nilai2;?> Mapel</p>
              <a href="<?=baseURL("ujian/detail/".$data_ujian_2['id_ujian']);?>">Lihat Ujian</a>
            </div>
          </div>
		<?php }?>
        </div>
        <div class="col-md-4">
		<?php $query_ujian_3 = mysqli_query($conn, "
		SELECT * 
		FROM ( 
			SELECT @row := @row +1 AS rownum, u.*
			FROM ( 
				SELECT @row :=1
			) r, tb_ujian u
			WHERE u.id_ujian IN (
				SELECT id_ujian 
				FROM tb_paket_soal
				WHERE FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas) && status = 'aktif'
			) ORDER BY id_ujian DESC
		) ranked 
		WHERE rownum % 3 = 1");
		while($data_ujian_3 = mysqli_fetch_array($query_ujian_3)){
			$data_jumlah_ujian3 = mysqli_num_rows(mysqli_query($conn, "select id_paket from tb_paket_soal where id_ujian = '$data_ujian_3[id_ujian]' AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas)"));
			$data_jumlah_nilai3 = mysqli_num_rows(mysqli_query($conn, "select nilai.id_nilai from tb_nilai nilai JOIN tb_paket_soal paket ON nilai.id_paket = paket.id_paket where paket.id_ujian = '$data_ujian_3[id_ujian]' AND FIND_IN_SET('$_SESSION[kelas_siswa]', paket.id_kelas) AND nilai.id_siswa = '$_SESSION[id_siswa]'"));
		?>
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">TA <?php echo $data_ujian_3['thn_ajar'];?></strong>
              <h3 class="mb-0">
                <a class="text-dark" href="<?=baseURL("ujian/detail/".$data_ujian_3['id_ujian']);?>"><?php echo $data_ujian_3['judul'];?></a>
              </h3>
              <p class="card-text mb-auto">Ujian Tersedia : <?php echo $data_jumlah_ujian3;?> Mapel<br>Ujian Selesai : <?php echo $data_jumlah_nilai3;?> Mapel</p>
              <a href="<?=baseURL("ujian/detail/".$data_ujian_3['id_ujian']);?>">Lihat Ujian</a>
            </div>
          </div>
		<?php }?>
        </div>
      </div>

<?php }else{
	 if(!$id_dua){
	$data_ujian = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_ujian ujian WHERE id_ujian = '$id'"));
	$query_paket = mysqli_query($conn, "SELECT * FROM tb_paket_soal paket JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel WHERE paket.id_ujian = '$id' AND paket.status = 'aktif' AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas) ORDER BY mapel.nama_mapel");
	$query_paket_samping = mysqli_query($conn, "SELECT mapel.nama_mapel FROM tb_paket_soal paket JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel WHERE paket.id_ujian = '$id' AND paket.status = 'aktif' AND FIND_IN_SET('".$_SESSION['kelas_siswa']."', id_kelas) ORDER BY mapel.nama_mapel");

	$data_jumlah_ujian = mysqli_num_rows(mysqli_query($conn, "select id_paket from tb_paket_soal where id_ujian = '$id' AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas)"));
	$data_jumlah_nilai = mysqli_num_rows(mysqli_query($conn, "select nilai.id_nilai from tb_nilai nilai JOIN tb_paket_soal paket ON nilai.id_paket = paket.id_paket where paket.id_ujian = '$id' AND FIND_IN_SET('$_SESSION[kelas_siswa]', paket.id_kelas) AND nilai.id_siswa = '$_SESSION[id_siswa]'"));
	?>
      
    <main role="main" class="container mt-4">
      <div class="row">
        <div class="col-md-8 blog-main">
          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $data_ujian['judul'];?></h2>
            <p class="blog-post-meta">Tahun Ajaran <?php echo $data_ujian['thn_ajar'];?></p>
			<hr>
		<?php
			while($data_paket = mysqli_fetch_array($query_paket)){
			$guru_explode = explode(',',$data_paket['id_guru']);
			$jumlah_nilai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_nilai WHERE id_siswa = '$_SESSION[id_siswa]' && id_paket = '$data_paket[id_paket]'"));
			@$query_guru = mysqli_query($conn, "SELECT nama_guru FROM tb_guru WHERE id_guru IN ($data_paket[id_guru])");
			@$jumlah_guru = mysqli_num_rows($query_guru);
			$jumlah = 0;
			?>

			<div class="row" id="<?php echo $data_paket['nama_mapel'];?>">
				<div class="col-9">
					<h3><?php echo $data_paket['nama_mapel'];?></h3>
					Pengajar :
					<?php while(@$data_guru = mysqli_fetch_array($query_guru)){
						echo $data_guru['nama_guru'];
						$jumlah++;
						if($jumlah == $jumlah_guru){
							$jumlah = 0;
						} else {
							echo ", ";
						}
					}?>
					| 
					<?php if($jumlah_nilai > 0){?><small class="text-info">Sudah Dikerjakan</small>
					<?php }else{?><small class="text-danger">Belum Dikerjakan</small><?php }?>
				</div>
				<div class="col-3">
					<?php if($jumlah_nilai > 0){?>
					<a class="btn btn-outline-primary" href="<?=baseURL("nilai/detail/".$id);?>">Lihat Nilai</a>
					<?php }else{?>
					<a class="btn btn-primary" href="<?=baseURL("ujian/detail/".$id."/".$data_paket['id_paket']);?>">Pilih Mapel</a>
					<?php }?>
				</div>
			</div>
			<hr>
			<?php }?>
			
          </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">TA <?php echo $data_ujian['thn_ajar'];?></strong>
              <h3 class="mb-0">
                <a class="text-dark"><?php echo $data_ujian['judul'];?></a>
              </h3>
              <p class="card-text mb-auto">Ujian Tersedia : <?php echo $data_jumlah_ujian;?> Mapel<br>Ujian Selesai : <?php echo $data_jumlah_nilai;?> Mapel</p>
              <a href="<?=baseURL("ujian");?>">Kembali</a>
            </div>
          </div>

          <div class="p-3">
            <h4 class="font-italic">Daftar Mata Pelajaran</h4>
            <ol class="list-unstyled mb-0">
              <?php 
			while($data_paket_samping = mysqli_fetch_array($query_paket_samping)){?>
			  <li><a href="#<?php echo $data_paket_samping['nama_mapel'];?>"><?php echo $data_paket_samping['nama_mapel'];?></a></li>
			<?php }?>
            </ol>
          </div>
        </aside><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </main><!-- /.container -->
<?php }else{	
	$data_paket = mysqli_fetch_array(mysqli_query($conn, "
	SELECT * FROM tb_paket_soal paket
	JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel
	JOIN tb_ujian ujian ON paket.id_ujian = ujian.id_ujian
	WHERE id_paket = '$id_dua'"));
	$guru_explode = explode(',',$data_paket['id_guru']);
	@$query_paket_guru = mysqli_query($conn, "SELECT * FROM tb_guru WHERE id_guru IN ($data_paket[id_guru])");
	@$jumlah_paket_guru = mysqli_num_rows($query_paket_guru);
	$jumlah = 0;
	?>
    
    <main role="main" class="container mt-4 text-center">
      <div class="row">
        <div class="col-md-12 blog-main">
          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $data_paket['nama_mapel'];?></h2>
            <p class="blog-post-meta"><?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></p>
			<hr>

            <p>Pengajar :
					<?php while(@$data_paket_guru = mysqli_fetch_array($query_paket_guru)){
						echo $data_paket_guru['nama_guru'];
						$jumlah++;
						if($jumlah == $jumlah_paket_guru){
							$jumlah = 0;
						} else {
							echo ", ";
						}
					}?><br>
			Waktu Pengerjaan : <?php echo $data_paket['waktu']/60;?> Menit</p>
			<?php if($data_paket['info']){ echo "<strong>Info</strong><p>".$data_paket['info']."</p>";}?>
			<br>
            <a class="btn btn-outline-secondary" href="<?=baseURL("ujian/detail/".$id);?>">Kembali</a>
			<a class="btn btn-primary" href="<?=baseURL("soal/index/".$id_dua);?>">Mulai Ujian</a>
			
          </div><!-- /.blog-post -->
        </div><!-- /.blog-main -->

      </div><!-- /.row -->

    </main><!-- /.container -->
<?php }}?>