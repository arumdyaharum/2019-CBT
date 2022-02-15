<?php 
	$query_panitia = mysqli_query($conn, "select * from tb_panitia WHERE id = '$_SESSION[id_panitia]'");
	$data_panitia = mysqli_fetch_array($query_panitia);
if(url(1) == ""){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg>&nbsp; Beranda</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Beranda</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="alert bg-danger" role="alert">
			<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Mohon mengubah username dan password panitia untuk mencegah peretasan akun / hacking
		</div>
</div>
<div class="row">
	<div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">Ujian Terbaru</div>
					<div class="panel-body">
						<table data-toggle="table">
						    <thead>
						    <tr>
								<th data-sortable="true">#</th>
								<th data-sortable="true">Ujian</th>
								<th data-sortable="true">Tahun Ajaran</th>
								<th>Action</th>
						    </tr>
						    </thead>
							<tbody>
							<?php $query_ujian_terbaru = mysqli_query($conn, "select * from tb_ujian order by id_ujian desc limit 3");
							while($data_ujian_terbaru = mysqli_fetch_array($query_ujian_terbaru)){?>
								<tr>
									<td><?php echo $no_table++;?></td>
									<td><?php echo $data_ujian_terbaru['judul'];?></td>
									<td><?php echo $data_ujian_terbaru['thn_ajar'];?></td>
									<td>
										<a class="btn btn-primary btn-sm" href="<?=baseURL("paket_soal/index/".$data_ujian_terbaru['id_ujian']);?>">Lihat Paket Ujian</a>
										<a class="btn btn-success btn-sm" href="<?=baseURL("nilai/index/".$data_ujian_terbaru['id_ujian']);?>">Lihat Nilai Ujian</a>
									</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">Biodata Panitia Ujian</div>
			<div class="panel-body">
				<fieldset class="form-horizontal">
					<div class="form-group">
						<label class="col-md-5 control-label">Nama Panitia</label>
						<div class="col-md-7" style="padding-top:7px;"><?php echo $data_panitia['nama'];?></div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Username</label>
						<div class="col-md-7" style="padding-top:7px;"><?php echo $data_panitia['user'];?></div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">Password</label>
						<div class="col-md-7" style="padding-top:7px;"><?php echo $data_panitia['pass'];?></div>
					</div>
					<div class="form-group">
						<div class="col-md-12" style="padding-top:7px;">
							<a class="btn btn-primary" href="<?=baseURL("beranda/update");?>">Ubah Data Panitia Ujian</a>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
</div><!--/.row--><?php
}elseif(url(1) == "update"){?>
		
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Ubah Data Panitia Ujian</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Biodata Panitia Ujian</h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Data Panitia Ujian &nbsp; <a class="btn btn-default" href="<?=baseURL();?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Panitia</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="nama" placeholder="Masukkan nama guru" value="<?php echo $data_panitia['nama'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username</label>
							<div class="col-md-10"><input class="form-control" type="text" name="user" placeholder="Masukkan username siswa" value=<?php echo $data_panitia['user'];?>></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Password</label>
							<div class="col-md-10"><input class="form-control" type="text" name="pass" placeholder="Masukkan password siswa" value=<?php echo $data_panitia['pass'];?>></div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="panitia_ubah" class="btn btn-primary" value="Ubah Data Panitia Ujian"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['panitia_ubah']){
						$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
						$user = @mysqli_real_escape_string($conn, $_POST['user']);
						$pass = @mysqli_real_escape_string($conn, $_POST['pass']);
						
						mysqli_query($conn, "UPDATE tb_panitia SET nama = '$nama', user = '$user', pass = '$pass', pw = sha2('$pass',0) WHERE id = '$_SESSION[id_panitia]'");
						?>
						<script>window.location='./';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php 
}?>