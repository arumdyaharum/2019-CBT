<?php $data_detail_nilai = mysqli_fetch_array(mysqli_query($conn, "select * from tb_ujian where id_ujian = '$id'"));
if(url(1) == "index"){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li class="active">Nilai <?php echo $data_detail_nilai['judul'].' TA '.$data_detail_nilai['thn_ajar'];?></li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Nilai <?php echo $data_detail_nilai['judul'].' TA '.$data_detail_nilai['thn_ajar'];?></h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="alert bg-warning" role="alert">Cetak nilai hanya bisa dilakukan di Nilai per Paket.</div>
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab">Nilai Masuk Terbaru</a></li>
					<li><a href="#tab2" data-toggle="tab">Nilai per Paket</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab1">
						<div id="toolbar1">
							<a class="btn btn-default" href="<?=baseURL("ujian");?>">Kembali</a>
						</div>
						<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar1">
						  <thead>
							<tr>
								<th data-sortable="true">#</th>
								<th data-sortable="true">Siswa</th>
								<th data-sortable="true">Kelas</th>
								<th data-sortable="true">Mapel</th>
								<th data-sortable="true">Nilai</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php $query_nilai_baru = mysqli_query($conn, "
						  SELECT nilai.id_siswa, paket.id_paket, mapel.nama_mapel, siswa.nama, nilai.nilai, nilai.id_nilai, kelas.tingkat, kelas.jurusan
						  FROM tb_nilai nilai
						  JOIN tb_siswa siswa ON nilai.id_siswa = siswa.id
						  JOIN tb_paket_soal paket ON nilai.id_paket = paket.id_paket
						  JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel
						  JOIN tb_kelas kelas ON siswa.kelas = kelas.id_kelas
						  WHERE paket.id_ujian = '$id'
						  ORDER BY nilai.id_nilai DESC LIMIT 100");
						  while($data_nilai_baru = mysqli_fetch_array($query_nilai_baru)){?>
							<tr>
								<td><?php echo $no_table++;?></td>
								<td><?php echo $data_nilai_baru['nama'];?></td>
								<td><?php echo $data_nilai_baru['tingkat'].'-'.$data_nilai_baru['jurusan'];?></td>
								<td><?php echo $data_nilai_baru['nama_mapel'];?></td>
								<td><?php echo $data_nilai_baru['nilai'];?></td>
								<td>
									<a class="btn btn-danger btn-sm" href="<?=baseURL("nilai/delete/".$id."/".$data_nilai_baru['id_paket']."/".$data_nilai_baru['id_siswa']);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Nilai</a>
								</td>
							</tr>
						  <?php }?>
						  </tbody>
						</table>
					</div>
					<div class="tab-pane fade" id="tab2">
						<div id="toolbar2">
							<a class="btn btn-default" href="<?=baseURL("ujian");?>">Kembali</a>
						</div>
						<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar2">
						  <thead>
							<tr>
								<th data-sortable="true">#</th>
								<th data-sortable="true">Mapel</th>
								<th data-sortable="true">Kelas</th>
								<th data-sortable="true">Guru</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php
						  $query_nilai_mapel = mysqli_query($conn, "select * from tb_paket_soal paket JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel WHERE paket.id_ujian = '$id'");
						  while($data_nilai_mapel = mysqli_fetch_array($query_nilai_mapel)){
							$guru_explode = explode(',',$data_nilai_mapel['id_guru']);
							$query_nilai_guru = mysqli_query($conn, "SELECT * FROM tb_guru WHERE id_guru IN ($data_nilai_mapel[id_guru])");
							  
							$kelas_explode = explode(',',$data_nilai_mapel['id_kelas']);
							$query_nilai_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas IN ($data_nilai_mapel[id_kelas])");
							  ?>
							<tr>
								<td><?php echo $no_table++;?></td>
								<td><?php echo $data_nilai_mapel['nama_mapel'];?></td>
								<td>
								<?php if($data_nilai_mapel['id_kelas']){
								while($data_nilai_kelas = mysqli_fetch_array($query_nilai_kelas)){echo $data_nilai_kelas['tingkat'].'-'.$data_nilai_kelas['jurusan'].'<br>';}} else {echo "-";}?>
								</td>
								<td>
								<?php if($data_nilai_mapel['id_guru']){
								while($data_nilai_guru = mysqli_fetch_array($query_nilai_guru)){echo $data_nilai_guru['nama_guru'].'<br>';}} else {echo "-";}?>
								</td>
								<td>
									<a class="btn btn-primary btn-sm" href="<?=baseURL("nilai/detail/".$id."/".$data_nilai_mapel['id_paket']);?>">Lihat Nilai</a>
								</td>
							</tr>
						  <?php }?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.panel-->
	</div>
</div><!--/.row-->
<?php }elseif(url(1) == "detail"){
	$data_nilai_info = mysqli_fetch_array(mysqli_query($conn, "select * from tb_paket_soal a JOIN tb_mapel c ON a.id_mapel = c.id_mapel where a.id_paket='$id_dua'"));
		$kelas_explode = explode(',',$data_nilai_info['id_kelas']);
		$query_nilai_kelas = mysqli_query($conn, "SELECT tingkat, jurusan FROM tb_kelas WHERE id_kelas IN ($data_nilai_info[id_kelas])");
		
		$guru_explode = explode(',',$data_nilai_info['id_guru']);
		$query_nilai_guru = mysqli_query($conn, "SELECT nama_guru FROM tb_guru WHERE id_guru IN ($data_nilai_info[id_guru])");
		
		$jumlah_kelas = mysqli_num_rows($query_nilai_kelas);
		$jumlah_guru = mysqli_num_rows($query_nilai_guru);
		$jumlah = 0;
		
		$query_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai nilai JOIN tb_siswa siswa ON nilai.id_siswa = siswa.id JOIN tb_kelas kelas ON siswa.kelas = kelas.id_kelas WHERE nilai.id_paket = '$id_dua'");
		$jumlah_nilai = mysqli_num_rows($query_nilai);
	?>
	
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li><a href="<?=baseURL("nilai/index/".$id);?>">Nilai <?php echo $data_detail_nilai['judul'].' TA '.$data_detail_nilai['thn_ajar'];?></a></li>
		<li class="active">Mapel <?php echo $data_nilai_info['nama_mapel'];?></li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Nilai <?php echo $data_detail_nilai['judul'].' TA '.$data_detail_nilai['thn_ajar'];?></h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<p class="row">
					<div class="col-xs-2"><strong>Mata Pelajaran</strong></div>
					<div class="col-xs-4">: <?php echo $data_nilai_info['nama_mapel'];?></div>
					<div class="col-xs-2"><strong>Tanggal Input</strong></div>
					<div class="col-xs-4">: <?php echo tgl_indo($data_nilai_info['tgl_buat']);?></div>
				</p>
				<p class="row">
					<div class="col-xs-2"><strong>Pengajar</strong></div>
					<div class="col-xs-4">: <?php 
					while($data_nilai_guru = mysqli_fetch_array($query_nilai_guru)){
						echo $data_nilai_guru['nama_guru'];
						$jumlah++;
						if($jumlah == $jumlah_guru){
							$jumlah = 0;
						} else {
							echo ", ";
						}
					}?></div>
					<div class="col-xs-2"><strong>Waktu</strong></div>
					<div class="col-xs-4">: <?php echo $data_nilai_info['waktu']/60;?> Menit</div>
				</p>
				<p class="row">
					<div class="col-xs-2"><strong>Kelas</strong></div>
					<div class="col-xs-10">: <?php 
					while($data_nilai_kelas = mysqli_fetch_array($query_nilai_kelas)){
						echo $data_nilai_kelas['tingkat'].'-'.$data_nilai_kelas['jurusan'];
						$jumlah++;
						if($jumlah == $jumlah_kelas){
							$jumlah = 0;
						} else {
							echo ", ";
						}
					}?></div>
				</p>
			</div>
		</div>
	</div><!--/.col-->
</div><!--/.row-->
<?php if(url(4) == ""){?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("nilai/index/".$id);?>">Kembali</a>
					<a class="btn btn-primary" href="<?=baseURL("nilai/detail/".$id."/".$id_dua."/print");?>">Cetak Nilai</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">Kelas</th>
						<th data-sortable="true">Nama Siswa</th>
						<th data-sortable="true">Benar</th>
						<th data-sortable="true">Salah</th>
						<th data-sortable="true">Kosong</th>
						<th data-sortable="true">Nilai</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php 
				  while($data_nilai = mysqli_fetch_array($query_nilai)){?>
					<tr>
						<td><?php echo $no_table++;?></td>
						<td><?php echo $data_nilai['tingkat'].'-'.$data_nilai['jurusan'];?></td>
						<td><?php echo $data_nilai['nama'];?></td>
						<td><?php echo $data_nilai['benar'];?></td>
						<td><?php echo $data_nilai['salah'];?></td>
						<td><?php echo $data_nilai['kosong'];?></td>
						<td><?php echo $data_nilai['nilai'];?></td>
						<td>
							<a class="btn btn-danger btn-sm" href="<?=baseURL("nilai/delete/".$id."/".$data_nilai_baru['id_paket']."/".$data_nilai_baru['id_siswa']);?>"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"/></svg> Hapus Nilai</a>
						</td>
					</tr>
				  <?php }?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php } else {
	$data_print_query = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas IN ($data_nilai_info[id_kelas])");	
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">			
				<div id="toolbar">
					<a class="btn btn-default" href="<?=baseURL("nilai/index/".$id);?>">Kembali</a>
					<a class="btn btn-primary" href="<?=baseURL("nilai/detail/".$id."/".$id_dua);?>">Daftar Nilai</a>
				</div>
				<table data-toggle="table" data-show-columns="true" data-search="true" data-pagination="true" data-toolbar="#toolbar">
				  <thead>
					<tr>
						<th data-sortable="true">#</th>
						<th data-sortable="true">Kelas</th>
						<th data-sortable="true">Jumlah Data</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php 
				  while($data_print = mysqli_fetch_array($data_print_query)){
					$jumlah_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_nilai a JOIN tb_siswa b ON a.id_siswa = b.id WHERE a.id_paket = $id_dua AND b.kelas = $data_print[id_kelas]"));
					?>
					<tr>
						<td><?= $no_table++;?></td>
						<td><?= $data_print['tingkat'].'-'.$data_print['jurusan'];?></td>
						<td><?= $jumlah_data;?></td>
						<td>
							<a class="btn btn-primary btn-sm" href="<?=baseURL("pdf/pdf_nilai.php?u=".$id_dua."&k=".$data_print['id_kelas']);?>"><svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Cetak PDF</a> <a class="btn btn-success btn-sm" href="<?=baseURL("xlsx/xlsx_download_nilai.php?u=".$id_dua."&k=".$data_print['id_kelas']);?>"><svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Cetak Excel</a>
						</td>
					</tr>
				  <?php }?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php
}}elseif(@$_GET['action'] == "delete"){
    mysqli_query($conn, "DELETE FROM tb_nilai WHERE id_siswa = '$id_tiga' && id_paket = '$id_dua'");
	?>
	<script>window.location='<?=baseURL("nilai/index/".$id);?>';</script>
<?php }?>