<?php if(url(1) == ""){?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Manajemen Berita</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Berita</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Berita</div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("berita/tambah");?>">Tambah Berita</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">Judul Berita</th>
						<th data-sortable="true">Tanggal Buat</th>
						<th data-sortable="true">Status</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php $query_berita = mysqli_query($conn, "select * from tb_berita");
				  while($data_berita = mysqli_fetch_array($query_berita)){?>
					<tr>
						<td><?php echo $no_table++;?></td>
						<td><?php echo $data_berita['judul'];?></td>
						<td><?php echo tgl_indo($data_berita['tgl_buat']);?></td>
						<td><?php echo $data_berita['status'];?></td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("berita/detail/".$data_berita['id_berita']);?>">Lihat Berita</a>
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
		<li><a href="<?=baseURL(url(0));?>">Manajemen Berita</a></li>
		<li class="active">Tambah Berita</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Berita</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Berita &nbsp; <a class="btn btn-default" href="<?=baseURL(url(0));?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Judul Berita</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="judul" placeholder="Judul Berita"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Isi Berita</label>
							<div class="col-md-10" style="padding-top:7px;">
							<textarea name="isi" class="form-control" placeholder="Isi berita"></textarea></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Status Berita</label>
							<div class="col-md-10" style="padding-top:7px;">
							<select name="status" class="form-control">
								<option value="Draf">Draf</option>
								<option value="Terbit">Terbit</option>
							</select></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="berita_tambah" class="btn btn-primary" value="Tambah Berita"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['berita_tambah']){
						$judul = @mysqli_real_escape_string($conn, $_POST['judul']);
						$isi = @mysqli_real_escape_string($conn, $_POST['isi']);
						$status = @mysqli_real_escape_string($conn, $_POST['status']);
						
						mysqli_query($conn, "INSERT INTO tb_berita(judul, isi, tgl_buat, status) VALUES ('$judul', '$isi', now(), '$status')");
						?>
						<script>window.location='<?=baseURL("berita");?>';</script>
					<?php }?>	
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php }elseif(url(1) == "update"){
	$data_update_berita = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_berita WHERE id_berita = '$id'"));
	?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL(url(0));?>">Manajemen Berita</a></li>
		<li class="active">Ubah Berita</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Manajemen Berita</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Berita &nbsp; <a class="btn btn-default" href="<?=baseURL("berita/detail/".$id);?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Judul Berita</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="judul" placeholder="Judul Berita" value="<?php echo $data_update_berita['judul'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Isi Berita</label>
							<div class="col-md-10" style="padding-top:7px;">
							<textarea name="isi" class="form-control" placeholder="Isi berita"><?php echo $data_update_berita['isi'];?></textarea></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Status Berita</label>
							<div class="col-md-10" style="padding-top:7px;">
							<select name="status" class="form-control">
								<option <?php if($data_update_berita['status']=='Draf') echo "selected ";?>value="Draf">Draf</option>
								<option <?php if($data_update_berita['status']=='Terbit') echo "selected ";?>value="Terbit">Terbit</option>
							</select></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="berita_update" class="btn btn-primary" value="Ubah Berita"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['berita_update']){
						$judul = @mysqli_real_escape_string($conn, $_POST['judul']);
						$isi = @mysqli_real_escape_string($conn, $_POST['isi']);
						$status = @mysqli_real_escape_string($conn, $_POST['status']);
						
						mysqli_query($conn, "UPDATE tb_berita SET judul = '$judul', isi = '$isi', status = '$status' WHERE id_berita = '$id'");
						?>
						<script>window.location='<?=baseURL("berita/detail/".$id);?>';</script>";
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php
}elseif(url(1) == "detail"){
	$data_detail_berita = mysqli_fetch_array(mysqli_query($conn, "select * from tb_berita where id_berita='$id'"));
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL(url(0));?>">Manajemen Berita</a></li>
		<li class="active">Lihat Berita</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data_detail_berita['judul'];?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo tgl_indo($data_detail_berita['tgl_buat']).' | <span class="font-weight-bold">'.$data_detail_berita['status'].'</span>';?> &nbsp; <a class="btn btn-default" href="<?=baseURL("berita");?>">Kembali</a></div>
			<div class="panel-body">
				<p><?php echo $data_detail_berita['isi'];?></p><br>
				<a class="btn btn-primary btn-sm" href="<?=baseURL("berita/update/".$id);?>">Ubah Berita</a>
				<a class="btn btn-danger btn-sm" href="<?=baseURL("berita/delete/".$id);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Berita</a>
			</div>
		</div>
	</div>
</div><!--/.row-->

<?php }elseif(url(1) == "delete"){
    mysqli_query($conn, "DELETE FROM tb_berita WHERE id_berita = '$id'");
	?>
	<script>window.location='<?=baseURL(url(0));?>';</script>
<?php }?>
