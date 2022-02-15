<?php 
if(url(1) == ""){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Manajemen Siswa</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Siswa <sup><a class="btn btn-info btn-sm" href="<?=baseURL("kelas/tambah");?>">Tambah Kelas</a></sup></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay">Kelas X</div>
			<div class="panel-body">
				<ul class="todo-list">
				<?php $query_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'X' ORDER BY jurusan");
				  while($data_kelas = mysqli_fetch_array($query_kelas)){?>
					<li class="todo-list-item">
						<div class="checkbox">
							<a href="<?=baseURL("siswa/index/".$data_kelas['id_kelas']);?>"><strong>Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></strong></a>
						</div>
						<div class="pull-right">
							<a href="<?=baseURL("kelas/update/".$data_kelas['id_kelas']);?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
							<a href="<?=baseURL("kelas/delete/".$data_kelas['id_kelas']);?>" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a>
						</div>
					</li>
				  <?php }?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay">Kelas XI</div>
			<div class="panel-body">
				<ul class="todo-list">
				<?php $query_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'XI' ORDER BY jurusan");
				  while($data_kelas = mysqli_fetch_array($query_kelas)){?>
					<li class="todo-list-item">
						<div class="checkbox">
							<a href="<?=baseURL("siswa/index/".$data_kelas['id_kelas']);?>"><strong>Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></strong></a>
						</div>
						<div class="pull-right">
							<a href="<?=baseURL("kelas/update/".$data_kelas['id_kelas']);?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
							<a href="<?=baseURL("kelas/delete/".$data_kelas['id_kelas']);?>" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a>
						</div>
					</li>
				  <?php }?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay">Kelas XII</div>
			<div class="panel-body">
				<ul class="todo-list">
				<?php $query_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'XII' ORDER BY jurusan");
				  while($data_kelas = mysqli_fetch_array($query_kelas)){?>
					<li class="todo-list-item">
						<div class="checkbox">
							<a href="<?=baseURL("siswa/index/".$data_kelas['id_kelas']);?>"><strong>Kelas <?php echo $data_kelas['tingkat']."-".$data_kelas['jurusan'];?></strong></a>
						</div>
						<div class="pull-right">
							<a href="<?=baseURL("kelas/update/".$data_kelas['id_kelas']);?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
							<a href="<?=baseURL("kelas/delete/".$data_kelas['id_kelas']);?>" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a-->
						</div>
					</li>
				  <?php }?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php }elseif(url(1) == "tambah"){?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL(url(0));?>">Manajemen Siswa</a></li>
		<li class="active">Tambah Kelas</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Siswa</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if($id == ""){?>
			<div class="panel-heading">Tambah Kelas &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("kelas/tambah/import");?>">Import Excel</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Tingkat</label>
							<div class="col-md-10" style="padding-top:7px;">
							<select name="tingkat">
								<option value="X">X</option>
								<option value="XI">XI</option>
								<option value="XII">XII</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Jurusan</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="jurusan" placeholder="Jurusan"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="kelas_tambah" class="btn btn-primary" value="Tambah Kelas"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['kelas_tambah']){
						$tingkat = @mysqli_real_escape_string($conn, $_POST['tingkat']);
						$jurusan = @mysqli_real_escape_string($conn, $_POST['jurusan']);
						mysqli_query($conn, "INSERT INTO tb_kelas VALUES ('', '$tingkat', '$jurusan')");
						?>
						<script>window.location='<?=baseURL(url(0));?>';</script>
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
			<div class="panel-heading">Tambah Kelas &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("kelas/tambah");?>">Input Kelas</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post" enctype="multipart/form-data" action="<?=baseURL("xlsx/xlsx_import_kelas.php");?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Unduh Template</label>
							<div class="col-md-10" style="padding-top:7px;"><a class="btn btn-primary" href="<?=baseURL("xlsx/xlsx_template_kelas.php");?>">Template</a></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Import File Excel</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="file" name="excel" placeholder="Masukkan File Excel"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" class="btn btn-primary" value="Tambah Kelas"></div>
						</div>
						</form>
					</fieldset>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div><!--/.row-->
<?php
}elseif(url(1) == "update"){?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL(url(0));?>">Manajemen Siswa</a></li>
		<li class="active">Ubah Kelas</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Siswa</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Kelas &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<?php $query_kelas_update = mysqli_query($conn, "select * from tb_kelas where id_kelas = '$id'");
						while($data_kelas_update = mysqli_fetch_array($query_kelas_update)){?>
						<div class="form-group">
							<label class="col-md-2 control-label">Tingkat</label>
							<div class="col-md-10" style="padding-top:7px;">
							<select name="tingkat">
								<option value="X"<?php if($data_kelas_update['tingkat'] == "X") echo ' selected="selected"';?>>X</option>
								<option value="XI"<?php if($data_kelas_update['tingkat'] == "XI") echo ' selected="selected"';?>>XI</option>
								<option value="XII"<?php if($data_kelas_update['tingkat'] == "XII") echo ' selected="selected"';?>>XII</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Jurusan</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="jurusan" placeholder="Jurusan"<?php echo 'value="'.$data_kelas_update['jurusan'].'"'?>></div>
						</div>
						<?php }?>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="kelas_ubah" class="btn btn-primary" value="Ubah Kelas"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['kelas_ubah']){
						$tingkat = @mysqli_real_escape_string($conn, $_POST['tingkat']);
						$jurusan = @mysqli_real_escape_string($conn, $_POST['jurusan']);
						mysqli_query($conn, "UPDATE tb_kelas SET tingkat = '$tingkat', jurusan = '$jurusan' where id_kelas = $id");
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
	mysqli_query($conn, "DELETE FROM tb_siswa WHERE kelas IN (select id_kelas from tb_kelas where id_kelas = '$id')");
    mysqli_query($conn, "DELETE FROM tb_kelas WHERE id_kelas = '$id'");
	?>
	<script>window.location='<?=baseURL(url(0));?>';</script>
<?php }?>
