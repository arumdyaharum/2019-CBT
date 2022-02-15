<?php 
$data_kelas = mysqli_fetch_array(mysqli_query($conn, "select * from tb_kelas where id_kelas = $id"));
if(url(1) == "index"){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("kelas");?>">Manajemen Siswa</a></li>
		<li>Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Siswa Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Siswa <a class="btn btn-default" href="<?=baseURL("kelas");?>">Kembali</a></div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("siswa/tambah/".$id);?>">Tambah Siswa</a> <a class="btn btn-primary" href="<?=baseURL("siswa/print/".$id);?>">Cetak Daftar Siswa</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">NIS</th>
						<th data-sortable="true">Nama Siswa</th>
						<th data-sortable="true">Jenis Kelamin</th>
						<th data-sortable="true">Status</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php $query_siswa = mysqli_query($conn, "select * from tb_siswa where kelas = $id AND status = 'aktif' order by nama");
				  while($data_siswa = mysqli_fetch_array($query_siswa)){?>
					<tr>
						<td><?= $no_table++;?></td>
						<td><?= $data_siswa['nis'];?></td>
						<td><?= $data_siswa['nama'];?></td>
						<td><?= getKelamin($data_siswa['kelamin']);?></td>
						<td><?= $data_siswa['status'];?></td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("siswa_bio/index/".$id."/".$data_siswa['id']);?>">Biodata Siswa</a>
						</td>
					</tr>
				  <?php }?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php }elseif(url(1) == "print"){?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("kelas");?>">Manajemen Siswa</a></li>
		<li>Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Siswa Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Cetak Daftar Siswa <a class="btn btn-default" href="<?=baseURL("kelas");?>">Kembali ke Kelas</a></div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("siswa/index/".$id);?>">Kembali ke Daftar Siswa</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">Cetak</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
						<td>PDF</td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("pdf/pdf_siswa.php?k=".$id);?>">Cetak PDF</a>
						</td>
					</tr>
					<tr>
						<td>Microsoft Excel</td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("xlsx/xlsx_download_siswa.php?k=".$id);?>">Cetak Excel</a>
						</td>
					</tr>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php }elseif(url(1) == "tambah"){?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("kelas");?>">Manajemen Siswa</a></li>
		<li><a href="<?=baseURL("siswa/index/".$id);?>">Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></a></li>
		<li class="active">Tambah Siswa</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Siswa Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if($id_dua == ""){?>
			<div class="panel-heading">Tambah Siswa &nbsp; <a class="btn btn-default" href="<?=baseURL("siswa/index/".$id);?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("siswa/tambah/".$id."/import");?>">Import Excel</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">NIS</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nis" placeholder="Masukkan NIS siswa"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Siswa</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nama" placeholder="Masukkan nama siswa"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Tanggal Lahir</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="date" name="tgl_lahir"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Jenis Kelamin</label>
							<div class="col-md-10">
							<select class="form-control" name="kelamin">
								<option value="P">Perempuan</option>
								<option value="L">Laki-Laki</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username</label>
							<div class="col-md-10"><input class="form-control" type="text" name="user" placeholder="Masukkan username siswa"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password</label>
							<div class="col-md-10"><input class="form-control" type="text" name="pass" placeholder="Masukkan password siswa"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Status</label>
							<div class="col-md-10"><input class="form-control" type="text" name="status" value="aktif" disabled></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="siswa_tambah" class="btn btn-primary" value="Tambah Siswa"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['siswa_tambah']){
						$nis = @$_POST['nis'];
						$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
						$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
						$kelamin = @mysqli_real_escape_string($conn, $_POST['kelamin']);
						$user = @mysqli_real_escape_string($conn, $_POST['user']);
						$pass = @mysqli_real_escape_string($conn, $_POST['pass']);
						$status = @mysqli_real_escape_string($conn, $_POST['status']);
						
						mysqli_query($conn, "INSERT INTO tb_siswa VALUES ('', '$nis', '$nama', '$id', '$tgl_lahir', '$kelamin', '$user', sha2('$pass',0), '$pass', '$status')");
						?>
						<script>window.location='<?=baseURL("siswa/index/".$id);?>';</script>
					<?php }?>
				</div>
			</div>
			<?php } else {
			if(@$_GET['error'] == "type"){	
			?>
			<div class="alert bg-danger" role="alert">
				<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Ekstensi file salah. File harus berekstensi XLSX.
			</div>
			<?php }?>
			<div class="panel-heading">Tambah Siswa &nbsp; <a class="btn btn-default" href="<?=baseURL("siswa/index/".$id);?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("siswa/tambah/".$id);?>">Input Siswa</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post" enctype="multipart/form-data" action="<?=baseURL("xlsx/xlsx_import_siswa.php");?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Unduh Template</label>
							<div class="col-md-10" style="padding-top:7px;"><a class="btn btn-primary" href="<?=baseURL("xlsx/xlsx_template_siswa.php?kelas=".$id);?>">Template</a></div>
						</div>
						<input type="hidden" name="kelas" value="<?= $id;?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Import File Excel</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="file" name="excel" placeholder="Masukkan File Excel"></div>
						</div>						
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="siswa_tambah" class="btn btn-primary" value="Tambah Siswa"></div>
						</div>
						</form>
					</fieldset>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div><!--/.row-->
<?php }?>
