<?php 
if(url(1) == ""){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li>Manajemen Guru</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Guru</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Guru</div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("guru/tambah");?>">Tambah Guru</a>
					<a class="btn btn-primary" href="<?=baseURL("guru/print");?>">Cetak Daftar Guru</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">NIP</th>
						<th data-sortable="true">Nama Guru</th>
						<th data-sortable="true">Jenis Kelamin</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php $query_guru = mysqli_query($conn, "select * from tb_guru order by nama_guru");
				  while($data_guru = mysqli_fetch_array($query_guru)){?>
					<tr>
						<td><?php echo $no_table++;?></td>
						<td><?php echo $data_guru['nip'];?></td>
						<td><?php echo $data_guru['nama_guru'];?></td>
						<td><?php kelamin($data_guru['kelamin']);?></td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("guru_bio/index/".$data_guru['id_guru']);?>">Biodata Guru</a>
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
		<li><a href="<?=baseURL(url(0));?>">Manajemen Guru</a></li>
		<li class="active">Cetak Daftar Guru</li>
	</ol>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Guru</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Cetak Daftar Guru</div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a>
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
							<a class="btn btn-primary btn-sm" href="<?=baseURL("pdf/pdf_guru.php");?>">Cetak PDF</a>
						</td>
					</tr>
					<tr>
						<td>Microsoft Excel</td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("xlsx/xlsx_download_guru.php");?>">Cetak Excel</a>
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
		<li><a href="<?=baseURL(url(0));?>">Manajemen Guru</a></li>
		<li class="active">Tambah Guru</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Guru</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if(url(2) == ""){?>
			<div class="panel-heading">Tambah Guru &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("guru/tambah/import");?>">Import Guru</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">NIP</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nip" placeholder="Masukkan NIP guru"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Guru</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nama" placeholder="Masukkan nama guru"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Jenis Kelamin</label>
							<div class="col-md-10">
							<select class="form-control" name="kelamin">
								<option value="">Pilih Jenis Kelamin</option>
								<option value="P">Perempuan</option>
								<option value="L">Laki-Laki</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="guru_tambah" class="btn btn-primary" value="Tambah Guru"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['guru_tambah']){
						$nip = @$_POST['nip'];
						$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
						$kelamin = @mysqli_real_escape_string($conn, $_POST['kelamin']);
						
						mysqli_query($conn, "INSERT INTO tb_guru VALUES ('', '$nip', '$nama', '$kelamin')");
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
			<div class="panel-heading">Tambah Guru &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("guru/tambah");?>">Input Guru</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
					<form method="post" enctype="multipart/form-data" action="<?=baseURL("xlsx/xlsx_import_guru.php");?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Unduh Template</label>
							<div class="col-md-10" style="padding-top:7px;"><a class="btn btn-primary" href="<?=baseURL("xlsx/xlsx_template_guru.php");?>">Template</a></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Import File Excel</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="file" name="excel" placeholder="Masukkan File Excel"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="guru_tambah" class="btn btn-primary" value="Tambah Guru"></div>
						</div>
						</form>
					</fieldset>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div><!--/.row-->
<?php }?>
