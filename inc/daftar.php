<main role="main" class="container mt-4">
  <div class="row">
	<div class="col-md-8 blog-main" style="margin:0 auto;>
	 <div class="blog-post">
		<h2 class="blog-post-title text-center">Daftar</h2>
		<hr>
		<form method="post">
		  <div class="form-group row">
			<label for="formNama" class="col-sm-2 col-form-label">Nama</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formNama" name="nama" placeholder="Masukkan Nama">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formNIS" class="col-sm-2 col-form-label">NIS</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formNIS" name="nis" placeholder="Masukkan NIS">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formKelas" class="col-sm-2 col-form-label">Kelas</label>
			<div class="col-sm-10">
			  <select name="kelas" class="form-control" id="formKelas">
                <?php $query_daftar_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas");
                while($daftar_kelas = mysqli_fetch_array($query_daftar_kelas)){
				echo '<option value="'.$daftar_kelas['id_kelas'].'">'.$daftar_kelas['tingkat'].'-'.$daftar_kelas['jurusan'].'</option>';
                }?>
			  </select>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
			<div class="col-sm-10">
			  <input type="date" class="form-control" id="formLahir" name="tgl_lahir">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
			<div class="col-sm-10">
			  <select name="kelamin" class="form-control" id="formKelamin">
				<option value="P">Perempuan</option>
				<option value="L">Laki-Laki</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formUser" class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formUser" name="user" placeholder="Masukkan Username">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formPass" class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formPass" name="pass" placeholder="Masukkan Password">
			</div>
		  </div>
		  <input type="submit" name="daftar" class="btn btn-primary mb-2" value="Daftar">
		</form>
	  </div><!-- /.blog-post -->
	</div><!-- /.blog-main -->
<?php 
if(@$_POST['daftar']){
	$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
	$nis = @$_POST['nis'];
	$kelas = @$_POST['kelas'];
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$kelamin = @mysqli_real_escape_string($conn, $_POST['kelamin']);
	$user = @mysqli_real_escape_string($conn, $_POST['user']);
	$pass = @mysqli_real_escape_string($conn, $_POST['pass']);
    $status = 'nonaktif';
	
    mysqli_query($conn, "INSERT INTO tb_siswa VALUES ('', '$nis', '$nama', '$kelas', '$tgl_lahir', '$kelamin', '$user', sha2('$pass',0), '$pass', '$status')");
	
    echo "<script>window.location='./';</script>";
}?>
</main><!-- /.container -->