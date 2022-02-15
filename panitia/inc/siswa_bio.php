<?php 
	$data_kelas = mysqli_fetch_array(mysqli_query($conn, "select * from tb_kelas where id_kelas = $id"));
	$data_siswa = mysqli_fetch_array(mysqli_query($conn, "select * from tb_siswa where id = $id_dua"));
	if(url(1) == "index"){
?>
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="<?=baseURL("kelas");?>">Manajemen Siswa</a></li>
				<li><a href="<?=baseURL("siswa/index/".$id);?>">Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></a></li>
				<li class="active">Biodata Siswa</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Biodata Siswa</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
				<div class="col-sm-12">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 widget-left" style="height:100%;padding:10px 0;">
									<img src="<?=baseURL("img/avatar.png");?>" alt="User Avatar" class="img-circle" />
						</div>
						<div class="col-sm-9 widget-right">
							<div class="large"><?php echo $data_siswa['nama'];?></div>
							<div class="text-muted medium">Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">	
					<div class="panel-body">
						<fieldset class="form-horizontal">
							<div class="form-group">
								<label class="col-md-4 control-label">Nama</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo $data_siswa['nama'];?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">NIS</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo $data_siswa['nis'];?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Tanggal Lahir</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo tgl_indo($data_siswa['tgl_lahir']);?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Jenis Kelamin</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo getKelamin($data_siswa['kelamin']);?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Username</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo $data_siswa['user'];?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo $data_siswa['pass'];?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Status</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo $data_siswa['status'];?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label"></label>
								<div class="col-md-8" id="name" style="padding-top:7px;">
									<a class="btn btn-primary" href="<?=baseURL("siswa_bio/update/".$id."/".$id_dua);?>">Ubah Data Siswa</a>
									<a class="btn btn-danger" href="<?=baseURL("siswa_bio/delete/".$id."/".$id_dua);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Siswa</a>
								</div>
							</div>
							
						</fieldset>
					</div>
				</div><!--/.panel-->
			</div><!--/.col-->
		</div><!--/.row-->
<?php
}elseif(url(1) == "update"){?>
		
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("kelas");?>">Manajemen Siswa</a></li>
		<li><a href="<?=baseURL("siswa/index/".$id);?>">Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></a></li>
		<li><a href="<?=baseURL("siswa_bio/index/".$id."/".$id_dua);?>">Biodata Siswa</a></li>
		<li class="active">Ubah Data Siswa</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Biodata Siswa</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Data Siswa &nbsp; <a class="btn btn-default" href="<?=baseURL("siswa_bio/index/".$id."/".$id_dua);?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">NIS</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nis" placeholder="Masukkan NIS siswa" value=<?php echo $data_siswa['nis'];?>></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Siswa</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nama" placeholder="Masukkan nama siswa"value=<?php echo $data_siswa['nama'];?>></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Tanggal Lahir</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="date" name="tgl_lahir" value=<?php echo $data_siswa['tgl_lahir'];?>></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Jenis Kelamin Siswa</label>
							<div class="col-md-10">
							<select class="form-control" name="kelamin">
								<option <?php if($data_siswa['kelamin']=='P')echo "selected";?> value="P">Perempuan</option>
								<option <?php if($data_siswa['kelamin']=='L')echo "selected";?> value="L">Laki-Laki</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username</label>
							<div class="col-md-10"><input class="form-control" type="text" name="user" placeholder="Masukkan username siswa" value=<?php echo $data_siswa['user'];?>></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password</label>
							<div class="col-md-10"><input class="form-control" type="text" name="pass" placeholder="Masukkan password siswa" value=<?php echo $data_siswa['pass'];?>></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Status</label>
							<div class="col-md-10">
							<select class="form-control" name="status">
								<option <?php if($data_siswa['status']=='aktif')echo "selected";?> value="aktif">Aktif</option>
								<option <?php if($data_siswa['status']=='nonaktif')echo "selected";?> value="nonaktif">Nonaktif</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="siswa_ubah" class="btn btn-primary" value="Ubah Data Siswa"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['siswa_ubah']){
						$nis = @$_POST['nis'];
						$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
						$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
						$kelamin = @mysqli_real_escape_string($conn, $_POST['kelamin']);
						$user = @mysqli_real_escape_string($conn, $_POST['user']);
						$pass = @mysqli_real_escape_string($conn, $_POST['pass']);
						$status = @mysqli_real_escape_string($conn, $_POST['status']);
						
						mysqli_query($conn, "UPDATE tb_siswa SET nis = '$nis', nama = '$nama', kelas = '$id', tgl_lahir = '$tgl_lahir', kelamin = '$kelamin', user = '$user', pass = '$pass', status = '$status', pw = sha2('$pass',0) WHERE id = '$id_dua'");
						?>
						<script>window.location='<?=baseURL("siswa_bio/index/".$id."/".$id_dua);?>';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php 
}elseif(url(1) == "delete"){
    mysqli_query($conn, "DELETE FROM tb_siswa WHERE id = '$id_dua'");
	?>
	<script>window.location='<?=baseURL("siswa/index/".$id);?>';</script>
<?php }?>