	  <?php if(url(1) == ""){?>
      <div class="row mt-3">
		<div class="col-md-12">
          <h3 class="pb-3 font-italic border-bottom text-center">
            Daftar Nilai
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
				SELECT @row :=0) r, tb_ujian u
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
                <a class="text-dark" href="<?=baseURL("nilai/detail/".$data_ujian_1['id_ujian']);?>"><?php echo $data_ujian_1['judul'];?></a>
              </h3>
              <p class="card-text mb-auto">Ujian Tersedia : <?php echo $data_jumlah_ujian1;?> Mapel<br>Ujian Selesai : <?php echo $data_jumlah_nilai1;?> Mapel</p>
              <a href="<?=baseURL("nilai/detail/".$data_ujian_1['id_ujian']);?>">Lihat Nilai</a>
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
				SELECT @row :=2) r, tb_ujian u
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
                <a class="text-dark" href="<?=baseURL("nilai/detail/".$data_ujian_2['id_ujian']);?>"><?php echo $data_ujian_2['judul'];?></a>
              </h3>
              <p class="card-text mb-auto">Ujian Tersedia : <?php echo $data_jumlah_ujian2;?> Mapel<br>Ujian Selesai : <?php echo $data_jumlah_nilai2;?> Mapel</p>
              <a href="<?=baseURL("nilai/detail/".$data_ujian_2['id_ujian']);?>">Lihat Nilai</a>
            </div>
          </div>
		<?php }?>
        </div>
        <div class="col-md-4">
		<?php $query_ujian_3 = mysqli_query($conn, "
		SELECT * 
		FROM ( 
			SELECT 
				@row := @row +1 AS rownum, u.*
			FROM ( 
				SELECT @row :=1) r, tb_ujian u
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
                <a class="text-dark" href="<?=baseURL("nilai/detail/".$data_ujian_3['id_ujian']);?>"><?php echo $data_ujian_3['judul'];?></a>
              </h3>
              <p class="card-text mb-auto">Ujian Tersedia : <?php echo $data_jumlah_ujian3;?> Mapel<br>Ujian Selesai : <?php echo $data_jumlah_nilai3;?> Mapel</p>
              <a href="<?=baseURL("nilai/detail/".$data_ujian_3['id_ujian']);?>">Lihat Nilai</a>
            </div>
          </div>
		<?php }?>
        </div>
      </div>
	  
  <?php }else{
	$data_ujian = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_ujian ujian WHERE id_ujian = '$id'"));
	$query_nilai = mysqli_query($conn, "SELECT * FROM tb_paket_soal paket
	JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel
	JOIN tb_nilai nilai ON paket.id_paket = nilai.id_paket
	WHERE paket.id_ujian = '$id'
		AND nilai.id_siswa = '$_SESSION[id_siswa]'
		AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas)
	ORDER BY mapel.nama_mapel");
	$query_nilai_samping = mysqli_query($conn, "SELECT * FROM tb_paket_soal paket
	JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel
	JOIN tb_nilai nilai ON paket.id_paket = nilai.id_paket
	WHERE paket.id_ujian = '$id'
		AND nilai.id_siswa = '$_SESSION[id_siswa]'
		AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas)
	ORDER BY mapel.nama_mapel");
	$jumlah_nilai = mysqli_num_rows($query_nilai);
	$jumlah = 0;
	
	$data_jumlah_ujian = mysqli_num_rows(mysqli_query($conn, "select id_paket from tb_paket_soal where id_ujian = '$id' AND FIND_IN_SET('$_SESSION[kelas_siswa]', id_kelas)"));
	$data_jumlah_nilai = mysqli_num_rows(mysqli_query($conn, "select nilai.id_nilai from tb_nilai nilai JOIN tb_paket_soal paket ON nilai.id_paket = paket.id_paket where paket.id_ujian = '$id' AND FIND_IN_SET('$_SESSION[kelas_siswa]', paket.id_kelas) AND nilai.id_siswa = '$_SESSION[id_siswa]'"));
	
	  ?>
      
    <main role="main" class="container mt-4">
      <div class="row">
        <div class="col-md-8 blog-main">

          <div class="blog-post">
            <h2 class="blog-post-title">Nilai <?php echo $data_ujian['judul'];?></h2>
            <p class="blog-post-meta">Tahun Ajaran <?php echo $data_ujian['thn_ajar'];?></p>

            
			<div class="row text-muted">
				<div class="col-10">
				</div>
				<div class="col-2">
					<strong>Nilai</strong>
				</div>
			</div>
			<hr>
			<?php 
			if($jumlah_nilai == 0){
				echo "Maaf, Nilai ujian ini tidak ada.";
				}else{
			while($data_nilai = mysqli_fetch_array($query_nilai)){
				
			$guru_explode = explode(',',$data_nilai['id_guru']);
			$query_nilai_guru = mysqli_query($conn, "SELECT nama_guru FROM tb_guru WHERE id_guru IN ($data_nilai[id_guru])");
			$jumlah_guru = mysqli_num_rows($query_nilai_guru);
			?>
			<div class="row" id="<?php echo $data_nilai['nama_mapel'];?>">
				<div class="col-10">
					<h4><?php echo $data_nilai['nama_mapel'];?></h4>
					Guru :
					<?php while($data_nilai_guru = mysqli_fetch_array($query_nilai_guru)){
						echo $data_nilai_guru['nama_guru'];
						$jumlah++;
						if($jumlah == $jumlah_guru){
							$jumlah = 0;
						} else {
							echo ", ";
						}
					}?>
				</div>
				<div class="col-2">
					<h2><?php echo $data_nilai['nilai'];?></h2>
				</div>
			</div>
			<hr>
			<?php }}?>
			
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
              <a href="<?=baseURL("nilai");?>">Kembali</a>
            </div>
          </div>

          <div class="p-3">
            <h4 class="font-italic">Daftar Mata Pelajaran</h4>
            <ol class="list-unstyled mb-0">
              <?php 
			while($data_nilai_samping = mysqli_fetch_array($query_nilai_samping)){?>
			  <li><a href="#<?php echo $data_nilai_samping['nama_mapel'];?>"><?php echo $data_nilai_samping['nama_mapel'];?></a></li>
			<?php }?>
            </ol>
          </div>
        </aside><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </main><!-- /.container -->
	  <?php }?>