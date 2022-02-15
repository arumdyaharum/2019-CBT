<?php 
if(url(1) == ""){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Manajemen Ujian</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Ujian</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Ujian</div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("ujian/tambah");?>">Tambah Ujian</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">Ujian</th>
						<th data-sortable="true">Tahun Ajaran</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php $query_ujian = mysqli_query($conn, "select * from tb_ujian order by id_ujian desc");
				  while($data_ujian = mysqli_fetch_array($query_ujian)){?>
					<tr>
						<td><?php echo $no_table++;?></td>
						<td><?php echo $data_ujian['judul'];?></td>
						<td><?php echo $data_ujian['thn_ajar'];?></td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("paket_soal/index/".$data_ujian['id_ujian']);?>">Lihat Paket Soal</a>
							<a class="btn btn-success btn-sm" href="<?=baseURL("nilai/index/".$data_ujian['id_ujian']);?>">Lihat Nilai Ujian</a>
							<a class="btn btn-warning btn-sm" href="<?=baseURL("ujian/update/".$data_ujian['id_ujian']);?>">Ubah Ujian</a>
							<a class="btn btn-danger btn-sm" href="<?=baseURL("ujian/delete/".$data_ujian['id_ujian']);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Ujian</a>
						</td>
					</tr>
				  <?php }?>
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
		<li><a href="<?=baseURL(url(0));?>">Manajemen Ujian</a></li>
		<li class="active">Tambah Ujian</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Ujian</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Ujian &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Judul Ujian</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="judul" placeholder="contoh : UAS Ganjil"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Tahun Ajaran</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="thn_ajar" placeholder="contoh : 2018/2019"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="ujian_tambah" class="btn btn-primary" value="Tambah Ujian"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['ujian_tambah']){
						$judul = @mysqli_real_escape_string($conn, $_POST['judul']);
						$thn_ajar = @mysqli_real_escape_string($conn, $_POST['thn_ajar']);
						
						mysqli_query($conn, "INSERT INTO tb_ujian(judul, thn_ajar) VALUES ('$judul', '$thn_ajar')");
						?>
						<script>window.location='<?=baseURL(url(0));?>';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php }elseif(url(1) == "update"){
	$data_update_ujian = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_ujian WHERE id_ujian = '$id'"));
	?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL(url(0));?>">Manajemen Ujian</a></li>
		<li class="active">Ubah Ujian</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Ujian</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Ujian &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Judul Ujian</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="judul" placeholder="contoh : UAS Ganjil" value="<?php echo $data_update_ujian['judul'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Tahun Ajaran</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="thn_ajar" placeholder="contoh : 2018/2019" value="<?php echo $data_update_ujian['thn_ajar'];?>"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="ujian_update" class="btn btn-primary" value="Ubah Ujian"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['ujian_update']){
						$judul = @mysqli_real_escape_string($conn, $_POST['judul']);
						$thn_ajar = @mysqli_real_escape_string($conn, $_POST['thn_ajar']);
						
						mysqli_query($conn, "UPDATE tb_ujian SET judul = '$judul', thn_ajar = '$thn_ajar' WHERE id_ujian = '$id'");
						?>
						<script>window.location='<?=baseURL(url(0));?>';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->

<?php }elseif(url(1) == "delete"){
	$query_gambar = mysqli_query($conn, "SELECT soal.gambarSoal, soal.id_paket FROM tb_soal soal JOIN tb_paket_soal paket ON soal.id_paket = paket.id_paket WHERE paket.id_ujian = '$id'");
	while($nama_gambar = mysqli_fetch_array($query_gambar)){
	if($nama_gambar['gambarSoal']){
		$alamat = '../img/soal/'.$nama_gambar['id_paket'].'_';
		$files = glob($alamat.$nama_gambar['gambarSoal']); // get all file names
		foreach($files as $file){ // iterate files
		if(is_file($file)) {  
			unlink($file); // delete file
		}
		}
	}}
	mysqli_query($conn, "DELETE FROM tb_soal WHERE id_paket IN (select id_paket from tb_paket_soal where id_ujian = '$id')");
	mysqli_query($conn, "DELETE FROM tb_nilai WHERE id_paket IN (select id_paket from tb_paket_soal where id_ujian = '$id')");
	mysqli_query($conn, "DELETE FROM tb_paket_soal WHERE id_ujian = '$id'");
    mysqli_query($conn, "DELETE FROM tb_ujian WHERE id_ujian = '$id'");
	?>
	<script>window.location='<?=baseURL(url(0));?>';</script>
<?php }?>
