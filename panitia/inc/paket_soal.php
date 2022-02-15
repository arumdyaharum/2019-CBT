<?php
	$data_detail_ujian = mysqli_fetch_array(mysqli_query($conn, "select * from tb_ujian where id_ujian='$id'"));
	if(url(1) == "index"){
?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li class="active"><?php echo $data_detail_ujian['judul'].' TA '.$data_detail_ujian['thn_ajar'];?></li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data_detail_ujian['judul'].' TA '.$data_detail_ujian['thn_ajar'];?></h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Paket Soal &nbsp; <a class="btn btn-default" href="<?=baseURL("ujian");?>">Kembali</a></div>
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("paket_soal/tambah/".$id);?>">Tambah Paket Soal</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">Mata Pelajaran</th>
						<th data-sortable="true">Kelas</th>
						<th data-sortable="true">Pengajar</th>
						<th data-sortable="true">Tanggal Input</th>
						<th data-sortable="true">Status</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php				  
				  $query_paket = mysqli_query($conn, "SELECT * from tb_paket_soal paket JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel WHERE paket.id_ujian = '$id'");
				  while($data_paket = mysqli_fetch_array($query_paket)){
					  
					$paket_kelas_explode = explode(',',$data_paket['id_kelas']);
					$query_paket_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas IN ($data_paket[id_kelas])");
					?>
					<tr>
						<td><?php echo $no_table++;?></td>
						<td><?php echo $data_paket['nama_mapel'];?></td>
						<td>
						<?php 
						if($data_paket['id_kelas']){
							while($data_paket_kelas = mysqli_fetch_array($query_paket_kelas)){echo $data_paket_kelas['tingkat']." - ".$data_paket_kelas['jurusan']."<br>";}}else{echo " - ";}?>
						</td>
						<td>
						<?php
						if($data_paket['id_guru']){
						$paket_guru_explode = explode(',',$data_paket['id_guru']);
						$query_paket_guru = mysqli_query($conn, "select * from tb_guru WHERE id_guru IN ($data_paket[id_guru])");
						while($data_paket_guru = mysqli_fetch_array($query_paket_guru)){echo $data_paket_guru['nama_guru']."<br>";}
						}else{echo " - ";}?></td>
						<td><?php echo tgl_indo($data_paket['tgl_buat']);?>
						</td>
											
						<td><?php echo $data_paket['status'];?></td>
						<td>
						<a class="btn btn-primary btn-sm" href="<?=baseURL("soal/index/".$data_paket['id_paket']);?>">Lihat Soal</a>
						<a class="btn btn-danger btn-sm" href="<?=baseURL("paket_soal/delete/".$id."/".$data_paket['id_paket']);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Paket Soal</a>
						<br>
						<a class="btn btn-warning btn-sm" href="<?=baseURL("paket_soal/update/".$id."/".$data_paket['id_paket']);?>">Ubah Paket Soal</a></td>
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
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li><a href="<?=baseURL("paket_soal/index/".$id);?>"><?php echo $data_detail_ujian['judul'].' TA '.$data_detail_ujian['thn_ajar'];?></a></li>
		<li class="active">Tambah Paket Soal</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data_detail_ujian['judul'].' TA '.$data_detail_ujian['thn_ajar'];?></h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Paket Soal <a class="btn btn-default" href="<?=baseURL("paket_soal/index/".$id);?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Status</label>
							<div class="col-md-10">
							<select class="form-control" name="status">
								<option value="tidak aktif">Tidak Aktif</option>
								<option value="aktif">Aktif</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Mata Pelajaran</label>
							<div class="col-md-10">
							<select class="form-control" name="mapel"><!--id="load_mapel"-->
								<option value="">Pilih Mata Pelajaran</option>
								<?php $query_paket_mapel = mysqli_query($conn, "SELECT * FROM tb_mapel ORDER BY nama_mapel");
								while($data_paket_mapel = mysqli_fetch_array($query_paket_mapel)){?>
								<option value="<?php echo $data_paket_mapel['id_mapel'];?>"><?php echo $data_paket_mapel['nama_mapel'];?></option>
								<?php }?>
							</select>
							</div>
						</div>	
						
						<div class="form-group">
							<label class="col-md-2 control-label">Pengajar</label>
							<div class="col-md-10" style="padding-top:7px;">
							<select name="pengajar[]" id="multiselect" multiple class="form-control">
								<?php $query_pengajar = mysqli_query($conn, "select * from tb_guru order by nama_guru");
								while($data_pengajar = mysqli_fetch_array($query_pengajar)){
									echo '<option value="'.$data_pengajar['id_guru'].'">'.$data_pengajar['nama_guru'].'</option>';
								}?>
							</select>
							</div>
						</div>				
						<div class="form-group">
							<label class="col-xs-2 control-label">Kelas</label>
							<div class="col-xs-3">
								<?php $query_paket_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'X'");
								while($data_paket_kelas = mysqli_fetch_array($query_paket_kelas)){?>
								<div class="checkbox">
									<label><input type="checkbox" name="kelas[]" value="<?php echo $data_paket_kelas['id_kelas'];?>"><?php echo $data_paket_kelas['tingkat'].' - '.$data_paket_kelas['jurusan'];?></label>
								</div><?php }?>
							</div>
							<div class="col-xs-3">
								<?php $query_paket_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'XI'");
								while($data_paket_kelas = mysqli_fetch_array($query_paket_kelas)){?>
								<div class="checkbox">
									<label><input type="checkbox" name="kelas[]" value="<?php echo $data_paket_kelas['id_kelas'];?>"><?php echo $data_paket_kelas['tingkat'].' - '.$data_paket_kelas['jurusan'];?></label>
								</div><?php }?>
							</div>
							<div class="col-xs-4">
								<?php $query_paket_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'XII'");
								while($data_paket_kelas = mysqli_fetch_array($query_paket_kelas)){?>
								<div class="checkbox">
									<label><input type="checkbox" name="kelas[]" value="<?php echo $data_paket_kelas['id_kelas'];?>"><?php echo $data_paket_kelas['tingkat'].' - '.$data_paket_kelas['jurusan'];?></label>
								</div><?php }?>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-2 control-label">Waktu Ujian</label>
							<div class="col-md-10"><input class="form-control" type="text" name="waktu" placeholder="Menit"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Info</label>
							<div class="col-md-10">
							<textarea class="form-control" rows="3" placeholder="Masukkan informasi sebelum memulai ujian" name="info"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="paket_tambah" class="btn btn-primary" value="Tambah Paket Soal"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['paket_tambah']){
						$mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
						$pengajar = implode(",",$_POST['pengajar']);
						$kelas = implode(",",$_POST['kelas']);
						$tgl_ujian = @mysqli_real_escape_string($conn, $_POST['tgl_ujian']);
						$waktu = @mysqli_real_escape_string($conn, $_POST['waktu']) * 60;
						$info = @mysqli_real_escape_string($conn, $_POST['info']);
						$status = @mysqli_real_escape_string($conn, $_POST['status']);
						
						mysqli_query($conn, "INSERT INTO tb_paket_soal(id_ujian, id_mapel, id_kelas, id_guru, tgl_buat, waktu, info, status) VALUES ('$id', '$mapel', '$kelas', '$pengajar', now(), '$waktu', '$info', '$status')");
						?>
						<script>window.location='<?=baseURL("paket_soal/index/".$id);?>';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php }elseif(url(1) == "update"){
	$data_paket_update = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_paket_soal WHERE id_paket = '$id_dua'"));
	?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li><a href="<?=baseURL("paket_soal/index/".$id);?>"><?php echo $data_detail_ujian['judul'].' TA '.$data_detail_ujian['thn_ajar'];?></a></li>
		<li class="active">Ubah Paket Soal</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data_detail_ujian['judul'].' TA '.$data_detail_ujian['thn_ajar'];?></h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Paket Soal <a class="btn btn-default" href="<?=baseURL("paket_soal/index/".$id);?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post">
						<div class="form-group">
							<label class="col-md-2 control-label">Status</label>
							<div class="col-md-10">
							<select class="form-control" name="status">
								<option <?php if($data_paket_update['status'] == 'tidak aktif'){echo "selected";}?> value="tidak aktif">Tidak Aktif</option>
								<option <?php if($data_paket_update['status'] == 'aktif'){echo "selected";}?> value="aktif">Aktif</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Mata Pelajaran</label>
							<div class="col-md-10">
							<select class="form-control" name="mapel" id="load_mapel">
								<option value="">Pilih Mata Pelajaran</option>
								<?php $query_paket_mapel = mysqli_query($conn, "SELECT * FROM tb_mapel ORDER BY nama_mapel");
								while($data_paket_mapel = mysqli_fetch_array($query_paket_mapel)){?>
								<option <?php if($data_paket_update['id_mapel'] == $data_paket_mapel['id_mapel']){echo "selected";}?> value="<?php echo $data_paket_mapel['id_mapel'];?>"><?php echo $data_paket_mapel['nama_mapel'];?></option>
								<?php }?>
							</select>
							</div>
						</div>							
						<div class="form-group">
							<label class="col-md-2 control-label">Pengajar</label>
							<div class="col-md-10">
							<select name="pengajar[]" id="multiselect" multiple class="form-control">
								
								<?php
								if($data_paket_update['id_guru']){
								$paket_guru_explode = explode(',',$data_paket_update['id_guru']);
								$query_select_pengajar = mysqli_query($conn, "select * from tb_guru where id_guru IN ($data_paket_update[id_guru])");
								while($data_select_pengajar = mysqli_fetch_array($query_select_pengajar)){
									echo '<option selected value="'.$data_select_pengajar['id_guru'].'">'.$data_select_pengajar['nama_guru'].'</option>';
								}
								
								$query_notselect_pengajar = mysqli_query($conn, "select * from tb_guru where id_guru NOT IN ($data_paket_update[id_guru])");
								while($data_notselect_pengajar = mysqli_fetch_array($query_notselect_pengajar)){
									echo '<option value="'.$data_notselect_pengajar['id_guru'].'">'.$data_notselect_pengajar['nama_guru'].'</option>';
								}} else {
								$query_pengajar_update = mysqli_query($conn, "select * from tb_guru");
								while($data_pengajar_update = mysqli_fetch_array($query_pengajar_update)){
									echo '<option value="'.$data_pengajar_update['id_guru'].'">'.$data_pengajar_update['nama_guru'].'</option>';
								}
								}?>
							</select>
							</div>
						</div>					
						<div class="form-group">
							<label class="col-xs-2 control-label">Kelas</label>
							<div class="col-xs-3">
								<?php $query_paket_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'X'");
								
								$explode_paket_update = explode(",",$data_paket_update['id_kelas']);
								while($data_paket_kelas = mysqli_fetch_array($query_paket_kelas)){?>
								<div class="checkbox">
									<label><input <?php if(in_array($data_paket_kelas['id_kelas'], $explode_paket_update)){echo "checked";}?> type="checkbox" name="kelas[]" value="<?php echo $data_paket_kelas['id_kelas'];?>"><?php echo $data_paket_kelas['tingkat'].' - '.$data_paket_kelas['jurusan'];?></label>
								</div><?php }?>
							</div>
							<div class="col-xs-3">
								<?php $query_paket_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'XI'");
								while($data_paket_kelas = mysqli_fetch_array($query_paket_kelas)){?>
								<div class="checkbox">
									<label><input <?php if(in_array($data_paket_kelas['id_kelas'], $explode_paket_update)){echo "checked";}?> type="checkbox" name="kelas[]" value="<?php echo $data_paket_kelas['id_kelas'];?>"><?php echo $data_paket_kelas['tingkat'].' - '.$data_paket_kelas['jurusan'];?></label>
								</div><?php }?>
							</div>
							<div class="col-xs-4">
								<?php $query_paket_kelas = mysqli_query($conn, "select * from tb_kelas where tingkat = 'XII'");
								while($data_paket_kelas = mysqli_fetch_array($query_paket_kelas)){?>
								<div class="checkbox">
									<label><input <?php if(in_array($data_paket_kelas['id_kelas'], $explode_paket_update)){echo "checked";}?> type="checkbox" name="kelas[]" value="<?php echo $data_paket_kelas['id_kelas'];?>"><?php echo $data_paket_kelas['tingkat'].' - '.$data_paket_kelas['jurusan'];?></label>
								</div><?php }?>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-2 control-label">Waktu Ujian</label>
							<div class="col-md-10"><input class="form-control" type="text" name="waktu" placeholder="Menit" value="<?php echo $data_paket_update['waktu']/60;?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Info</label>
							<div class="col-md-10">
							<textarea class="form-control" rows="3" placeholder="Masukkan informasi sebelum memulai ujian" name="info"><?php echo $data_paket_update['info'];?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="paket_update" class="btn btn-primary" value="Ubah Paket Soal"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['paket_update']){
						$mapel = @mysqli_real_escape_string($conn, $_POST['mapel']);
						$pengajar = implode(",",$_POST['pengajar']);
						$kelas = implode(",",$_POST['kelas']);
						$waktu = @mysqli_real_escape_string($conn, $_POST['waktu']) * 60;
						$info = @mysqli_real_escape_string($conn, $_POST['info']);
						$status = @mysqli_real_escape_string($conn, $_POST['status']);
						
						mysqli_query($conn, "UPDATE tb_paket_soal SET id_ujian = '$id', id_mapel = '$mapel', id_kelas = '$kelas', id_guru = '$pengajar', waktu = '$waktu', info = '$info', status = '$status' WHERE id_paket = '$id_dua'");
						?>
						<script>window.location='<?=baseURL("paket_soal/index/".$id);?>';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php 
}elseif(url(1) == "delete"){
	$query_gambar = mysqli_query($conn, "SELECT gambarSoal FROM tb_soal WHERE id_paket = '$id_dua'");
	while($nama_gambar = mysqli_fetch_array($query_gambar)){
	if($nama_gambar['gambarSoal']){
		$alamat = '../img/soal/'.$id_dua.'_';
		$files = glob($alamat.$nama_gambar['gambarSoal']); // get all file names
		foreach($files as $file){ // iterate files
		if(is_file($file)) {  
			unlink($file); // delete file
		}
		}
	}}
	mysqli_query($conn, "DELETE FROM tb_soal WHERE id_paket = '$id_dua'");
	mysqli_query($conn, "DELETE FROM tb_paket_soal WHERE id_paket = '$id_dua'");
	mysqli_query($conn, "DELETE FROM tb_nilai WHERE id_paket = '$id_dua'");
	?>
	<script>window.location='<?=baseURL("paket_soal/index/".$id);?>';</script>
<?php }?>