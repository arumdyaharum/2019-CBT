<?php 
if(url(1) == ""){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Manajemen Mapel</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Mata Pelajaran</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Mata Pelajaran</div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("mapel/tambah");?>">Tambah Mapel</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">Nama Mapel</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php $query_mapel = mysqli_query($conn, "select * from tb_mapel order by nama_mapel");
				  while($data_mapel = mysqli_fetch_array($query_mapel)){
				  ?>
					<tr>
						<td><?php echo $no_table++;?></td>
						<td><?php echo $data_mapel['nama_mapel'];?></td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("mapel/update/".$data_mapel['id_mapel']);?>">Ubah Mapel</a>
							<a class="btn btn-danger btn-sm" href="<?=baseURL("mapel/delete/".$data_mapel['id_mapel']);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Mapel</a>
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
		<li><a href="<?=baseURL(url(0));?>">Manajemen Mapel</a></li>
		<li class="active">Tambah Mapel</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Mata Pelajaran</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if($id == ""){?>
			<div class="panel-heading">Tambah Mata Pelajaran <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a> <a class="btn btn-primary" href="<?=baseURL("mapel/tambah/import");?>">Import Excel</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Mapel</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="mapel" placeholder="Tambah Mata Pelajaran"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="mapel_tambah" class="btn btn-primary" value="Tambah Mapel"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['mapel_tambah']){
						$mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
						mysqli_query($conn, "INSERT INTO tb_mapel VALUES ('', '$mapel')");
						?>
						<script>window.location='<?=baseURL(url(0));?>';</script>
					<?php }?>
				</div>
			</div>
			<?php } else {
			if(@$_GET['error'] == "type"){	
			?>
			<div class="alert bg-danger" role="alert">
				<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Ekstensi file salah. File harus berekstensi XLSX. <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
			</div>
			<?php }?>
			<div class="panel-heading">Tambah Mata Pelajaran <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a> <a class="btn btn-primary" href="<?=baseURL("mapel/tambah");?>">Input Mapel</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post" enctype="multipart/form-data" action="<?=baseURL("xlsx/xlsx_import_mapel.php");?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Unduh Template</label>
							<div class="col-md-10" style="padding-top:7px;"><a class="btn btn-primary" href="<?=baseURL("xlsx/xlsx_template_mapel.php");?>">Template</a></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Import File Excel</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="file" name="excel" placeholder="Masukkan File Excel"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" class="btn btn-primary" value="Tambah Mapel"></div>
						</div>
						</form>
					</fieldset>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div><!--/.row-->
<?php }elseif(url(1) == "update"){
	$data_update_mapel = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_mapel WHERE id_mapel = $id"));
	?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL(url(0));?>">Manajemen Mapel</a></li>
		<li class="active">Ubah Mapel</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Mata Pelajaran</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Mapel <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Mapel</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="mapel" placeholder="Tambah Mata Pelajaran" value="<?php echo $data_update_mapel['nama_mapel'];?>"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="mapel_update" class="btn btn-primary" value="Ubah Pengajar"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['mapel_update']){
						$mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
						mysqli_query($conn, "UPDATE tb_mapel SET nama_mapel = '$mapel' WHERE id_mapel = $id");
						?>
						<script>window.location='<?=baseURL(url(0));?>';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php
}elseif(url(1) == "delete"){
    mysqli_query($conn, "DELETE FROM tb_mapel WHERE id_mapel = '$id'");
	?>
	<script>window.location='<?=baseURL(url(0));?>';</script>
<?php }?>
