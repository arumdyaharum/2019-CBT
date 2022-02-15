<main role="main" class="container mt-4">
<?php
$data_profil = mysqli_fetch_array(mysqli_query($conn, "select * from tb_siswa siswa JOIN tb_kelas kelas ON siswa.kelas = kelas.id_kelas where siswa.id = $_SESSION[id_siswa]"));
if(url(1) == ""){
?>
  <div class="row">
	<div class="col-md-12 blog-main">
	 <div class="blog-post">
		<h2 class="blog-post-title"><?php echo $_SESSION['nm_siswa'];?></h2>
		<p class="blog-post-meta">Pengaturan : <a href="<?=baseURL("profil/update");?>">Ubah Profil</a></p>
		<hr>
		<div class="row">
			<div class="col-sm-2">NIS</div>
			<div class="col-sm-10">: <?php echo $data_profil['nis'];?></div>
		</div>
		<div class="row">
			<div class="col-sm-2">Kelas</div>
			<div class="col-sm-10">: <?php echo $data_profil['tingkat'].'-'.$data_profil['jurusan'];?></div>
		</div>
		<div class="row">
			<div class="col-sm-2">Tanggal Lahir</div>
			<div class="col-sm-10">: <?php echo tgl_indo($data_profil['tgl_lahir']);?></div>
		</div>
		<div class="row">
			<div class="col-sm-2">Jenis Kelamin</div>
			<div class="col-sm-10">: <?php echo getKelamin($data_profil['kelamin']);?></div>
		</div>
		<div class="row">
			<div class="col-sm-2">Username</div>
			<div class="col-sm-10">: <?php echo $data_profil['user'];?></div>
		</div>
		<div class="row">
			<div class="col-sm-2">Password</div>
			<div class="col-sm-10">: <?php echo $data_profil['pass'];?></div>
		</div>
	  </div><!-- /.blog-post -->
	</div><!-- /.blog-main -->

  </div><!-- /.row -->
<?php
}elseif(url(1) == 'update'){?>

  <div class="row">
	<div class="col-md-12 blog-main">
	 <div class="blog-post">
		<h2 class="blog-post-title"><?php echo $_SESSION['nm_siswa'];?></h2>
		<p class="blog-post-meta"><a href="<?=baseURL("profil");?>">kembali ke profil</a></p>
		<hr>
		<form method="post">
		  <div class="form-group row">
			<label for="formNama" class="col-sm-2 col-form-label">Nama</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formNama" name="nama" value="<?php echo $data_profil['nama'];?>" placeholder="Masukkan Nama">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formNIS" class="col-sm-2 col-form-label">NIS</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formNIS" name="nis" value="<?php echo $data_profil['nis'];?>" placeholder="Masukkan NIS">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formKelas" class="col-sm-2 col-form-label">Kelas</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formKelas" name="nis" value="<?php echo $data_profil['tingkat'].'-'.$data_profil['jurusan'];?>" disabled>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
			<div class="col-sm-10">
			  <input type="date" class="form-control" id="formLahir" name="tgl_lahir" value="<?php echo $data_profil['tgl_lahir'];?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
			<div class="col-sm-10">
			  <select name="kelamin" class="form-control" id="formKelamin">
				<option value="P"<?php if($data_profil['kelamin'] == "P"){echo " selected";}?>>Perempuan</option>
				<option value="L"<?php if($data_profil['kelamin'] == "L"){echo " selected";}?>>Laki-Laki</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formUser" class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formUser" name="user" value="<?php echo $data_profil['user'];?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="formPass" class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="formPass" name="pass" value="<?php echo $data_profil['pass'];?>">
			</div>
		  </div>
		  <input type="submit" name="update_profil" class="btn btn-primary mb-2">
		</form>
	  </div><!-- /.blog-post -->
	</div><!-- /.blog-main -->
<?php 
if(@$_POST['update_profil']){
	$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
	$nis = @$_POST['nis'];
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$kelamin = @mysqli_real_escape_string($conn, $_POST['kelamin']);
	$user = @mysqli_real_escape_string($conn, $_POST['user']);
	$pass = @mysqli_real_escape_string($conn, $_POST['pass']);
	$_SESSION['nm_siswa'] = $nama;
	
	mysqli_query($conn, "UPDATE tb_siswa SET nis = '$nis', nama = '$nama', tgl_lahir = '$tgl_lahir', kelamin = '$kelamin', user = '$user', pass = '$pass', pw = sha2('$pass',0) WHERE id = '$_SESSION[id_siswa]'");
	?>
	<script>window.location='<?=baseURL("profil");?>';</script>
<?php }
}?>
</main><!-- /.container -->