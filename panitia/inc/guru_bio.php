<?php 
	$data_guru = mysqli_fetch_array(mysqli_query($conn, "select * from tb_guru where id_guru = $id"));
	if(url(1) == "index"){
?>
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="<?=baseURL('guru');?>">Manajemen Guru</a></li>
				<li class="active">Biodata Guru</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Biodata Guru</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 widget-left" style="height:100%;padding:10px 0;">
									<img src="<?=baseURL("img/avatar.png");?>" alt="User Avatar" class="img-circle" />
						</div>
						<div class="col-sm-9 widget-right">
							<div class="large"><?php echo $data_guru['nama_guru'];?></div>
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
								<label class="col-md-4 control-label">NIP</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo $data_guru['nip'];?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Nama Guru</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo $data_guru['nama_guru'];?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Jenis Kelamin</label>
								<div class="col-md-8" id="name" style="padding-top:7px;"><?php echo getKelamin($data_guru['kelamin']);?></div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label"></label>
								<div class="col-md-8" id="name" style="padding-top:7px;">
									<a class="btn btn-primary" href="<?=baseURL("guru_bio/update/".$id);?>">Ubah Data Guru</a>
									<a class="btn btn-danger" href="<?=baseURL("guru_bio/delete/".$id);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Guru</a>
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
		<li><a href="<?=baseURL("guru");?>">Manajemen Guru</a></li>
		<li><a href="<?=baseURL("guru_bio/index/".$id);?>">Biodata Guru</a></li>
		<li class="active">Ubah Data Guru</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Biodata Guru</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Data Guru &nbsp; <a class="btn btn-default" href="<?=baseURL("guru_bio/index/".$id);?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">NIP</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nip" placeholder="Masukkan NIP guru" value="<?php echo $data_guru['nip'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Guru</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nama" placeholder="Masukkan nama guru" value="<?php echo $data_guru['nama_guru'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Jenis Kelamin</label>
							<div class="col-md-10">
							<select class="form-control" name="kelamin">
								<option value="">Pilih Jenis Kelamin</option>
								<option <?php if($data_guru['kelamin']=='P')echo "selected";?> value="P">Perempuan</option>
								<option <?php if($data_guru['kelamin']=='L')echo "selected";?> value="L">Laki-Laki</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="guru_ubah" class="btn btn-primary" value="Ubah Data Guru"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['guru_ubah']){
						$nip = @mysqli_real_escape_string($conn, $_POST['nip']);
						$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
						$kelamin = @mysqli_real_escape_string($conn, $_POST['kelamin']);
						
						mysqli_query($conn, "UPDATE tb_guru SET nip = '$nip', nama_guru = '$nama', kelamin = '$kelamin' WHERE id_guru = '$id'");
						
						echo "<script>window.location='?page=guru_bio&id=".$id."';</script>";
					}?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php 
}elseif(url(1) == "delete"){
    mysqli_query($conn, "DELETE FROM tb_guru WHERE id_guru = '$id'");
	?>
	<script>window.location='<?=baseURL("guru");?>';</script>";
<?php }?>