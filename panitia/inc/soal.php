<?php
$data_paket = mysqli_fetch_array(mysqli_query($conn, "select * from tb_paket_soal a JOIN tb_ujian b ON a.id_ujian = b.id_ujian JOIN tb_mapel c ON a.id_mapel = c.id_mapel where a.id_paket='$id'"));
 if(url(1) == "index"){
	?>
<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li><a href="<?=baseURL("paket_soal/index/".$data_paket["id_ujian"]);?>"><?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></a></li>
		<li class="active">Soal <?php echo $data_paket['nama_mapel'];?></li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Soal <?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></h1>
	</div>
</div><!--/.row-->
<?php
		$kelas_explode = explode(',',$data_paket['id_kelas']);
		$query_soal_kelas = mysqli_query($conn, "SELECT tingkat, jurusan FROM tb_kelas WHERE id_kelas IN ($data_paket[id_kelas])");
		
		$guru_explode = explode(',',$data_paket['id_guru']);
		$query_soal_guru = mysqli_query($conn, "SELECT nama_guru FROM tb_guru WHERE id_guru IN ($data_paket[id_guru])");
		
		@$jumlah_kelas = mysqli_num_rows($query_soal_kelas);
		@$jumlah_guru = mysqli_num_rows($query_soal_guru);
		$jumlah = 0;
		
		$query_soal = mysqli_query($conn, "select * from tb_soal where id_paket = '$id'");
		$jumlah_soal = mysqli_num_rows($query_soal);
		$no = 1;
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<p class="row">
							<div class="col-xs-2"><strong>Mata Pelajaran</strong></div>
							<div class="col-xs-4">: <?php echo $data_paket['nama_mapel'];?></div>
							<div class="col-xs-2"><strong>Tanggal Input</strong></div>
							<div class="col-xs-4">: <?php echo tgl_indo($data_paket['tgl_buat']);?></div>
						</p>
						<p class="row">
							<div class="col-xs-2"><strong>Pengajar</strong></div>
							<div class="col-xs-4">: <?php 
							if($data_paket['id_guru']){
							while($data_soal_guru = mysqli_fetch_array($query_soal_guru)){
								echo $data_soal_guru['nama_guru'];
								$jumlah++;
								if($jumlah == $jumlah_guru){
									$jumlah = 0;
								} else {
									echo ", ";
								}
							}}else{echo " - ";}?></div>
							<div class="col-xs-2"><strong>Waktu</strong></div>
							<div class="col-xs-4">: <?php echo $data_paket['waktu']/60;?> Menit</div>
						</p>
						<p class="row">
							<div class="col-xs-2"><strong>Jumlah Soal</strong></div>
							<div class="col-xs-4">: <?php echo $jumlah_soal;?> soal</div>
							<div class="col-xs-2"><strong>Status</strong></div>
							<div class="col-xs-4">: <?php echo $data_paket['status'];?></div>
						</p>
						<p class="row">
							<div class="col-xs-2"><strong>Kelas</strong></div>
							<div class="col-xs-10">: <?php 
							if($data_paket['id_kelas']){
							while($data_soal_kelas = mysqli_fetch_array($query_soal_kelas)){
								echo $data_soal_kelas['tingkat'].'-'.$data_soal_kelas['jurusan'];
								$jumlah++;
								if($jumlah == $jumlah_kelas){
									$jumlah = 0;
								} else {
									echo ", ";
								}
							}}else{echo " - ";}?></div>
						</p>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Info Paket Soal</div>
					<div class="panel-body">
							<?php echo $data_paket['info'];?>
					</div>
				</div>
			</div><!--/.col-->
		</div><!--/.row-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default chat">
					<?php if($id_dua == "print"){ ?>
					<div class="panel-heading" id="accordion">
						<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Cetak Soal &nbsp; <a class="btn btn-success" href="<?=baseURL("soal/index/".$id);?>">Daftar Soal</a> &nbsp; <a class="btn btn-default" href="<?=baseURL("paket_soal/index/".$data_paket['id_ujian']);?>">Kembali</a>
					</div>
					<?php
						$query_print_kelas = mysqli_query($conn, "SELECT id_kelas, tingkat, jurusan FROM tb_kelas WHERE id_kelas IN ($data_paket[id_kelas])");
						
						$query_print_guru = mysqli_query($conn, "SELECT id_guru, nama_guru FROM tb_guru WHERE id_guru IN ($data_paket[id_guru])");?>
					<div class="panel-body">
						<form class="form-horizontal" action="<?=baseURL("pdf/pdf_soal.php");?>" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-md-3 control-label" for="guru">Guru</label>
									<div class="col-md-9">
									<select id="guru" class="form-control" name="guru">
										<?php while($data_print_guru = mysqli_fetch_array($query_print_guru)){?>
										<option value="<?php echo $data_print_guru['id_guru'];?>"><?php echo $data_print_guru['nama_guru'];?></option>
										<?php }?>
									</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="kelas">Kelas</label>
									<div class="col-md-9">
									<select id="kelas" class="form-control" name="kelas">
										<?php while($data_print_kelas = mysqli_fetch_array($query_print_kelas)){?>
										<option value="<?php echo $data_print_kelas['id_kelas'];?>"><?php echo $data_print_kelas['tingkat'].'-'.$data_print_kelas['jurusan'];?></option>
										<?php }?>
									</select>
									</div>
								</div>
								<input name="id" type="hidden" value="<?php echo $id;?>" class="form-control">
								<div class="form-group">
									<div class="col-md-12">
										<button type="submit" class="btn btn-default btn-md">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<?php } else {?>
					<div class="panel-heading" id="accordion">
						<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Daftar Soal &nbsp; <a class="btn btn-primary" href="<?=baseURL("soal/tambah/".$id."/".($jumlah_soal + 1));?>">Tambah Soal</a> &nbsp; <a class="btn btn-success" href="<?=baseURL("soal/index/".$id."/print");?>">Cetak Soal</a> &nbsp; <a class="btn btn-default" href="<?=baseURL("paket_soal/index/".$data_paket['id_ujian']);?>">Kembali</a>
					</div>
					<div class="panel-body">
						<ul>
							<?php
							while($data_soal = mysqli_fetch_array($query_soal)){?>
							<li class="left clearfix">
								<div class="chat-body clearfix">
								<div class="col-md-7">
									<div class="header">
										<strong class="primary-font"><?php echo $no++;?>. &nbsp; <?php echo $data_soal['pertanyaan'];?></strong>
									</div>
									<ol type="A">
										<li><?php echo $data_soal['pil_A'];?></li>
										<li><?php echo $data_soal['pil_B'];?></li>
										<li><?php echo $data_soal['pil_C'];?></li>
										<li><?php echo $data_soal['pil_D'];?></li>
										<li><?php echo $data_soal['pil_E'];?></li>
									</ol>
									<br>
									<div class="header">
										<strong class="primary-font">Jawaban : <?php echo $data_soal['kunci'];?></strong>
									</div> 
									<br>
									<a class="btn btn-default btn-sm" href="<?=baseURL("soal/update/".$id."/".$data_soal['id_soal']);?>">Ubah Soal</a>
									<a class="btn btn-danger btn-sm" href="<?=baseURL("soal/delete/".$id."/".$data_soal['id_soal']);?>">Hapus Soal</a>
								</div>
								<div class="col-md-5">
									<?php if($data_soal["gambarSoal"]){?><img src="<?=baseURL("../img/soal/".$id."_".$data_soal['gambarSoal']);?>" class="img-thumbnail"><?php }?>
								</div></div>
							</li>
							<?php }?>
						</ul>
					</div>
					<?php }?>
				</div>
				
			</div><!--/.col-->
		</div><!--/.row-->
		
<?php }elseif(url(1) == "tambah"){
	?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li><a href="<?=baseURL("paket_soal/index/".$data_paket["id_ujian"]);?>"><?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></a></li>
		<li><a href="<?=baseURL("soal/index/".$id);?>">Soal <?php echo $data_paket['nama_mapel'];?></a></li>
		<li class="active">Tambah Soal</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Soal <?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></h1>
	</div>
		</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<?php if($id_tiga == ""){?>
			<div class="panel-heading">Tambah Soal &nbsp; <a class="btn btn-default" href="<?=baseURL("soal/index/".$id);?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("soal/tambah/".$id."/".$id_dua."/import");?>">Import Excel</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-md-2 control-label">Pertanyaan nomor <?php echo $id_dua;?></label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pertanyaan" placeholder="Masukkan Pertanyaan Soal"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Gambar Soal</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="file" name="gambar" placeholder="Masukkan Gambar Soal"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan A</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_A" placeholder="Masukkan Pilihan Jawaban A"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan B</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_B" placeholder="Masukkan Pilihan Jawaban B"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan C</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_C" placeholder="Masukkan Pilihan Jawaban C"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan D</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_D" placeholder="Masukkan Pilihan Jawaban D"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan E</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_E" placeholder="Masukkan Pilihan Jawaban E"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Kunci Jawaban</label>
							<div class="col-md-10">
							<select class="form-control" name="kunci">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="soal_tambah" class="btn btn-primary" value="Tambah Soal"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['soal_tambah']){
						$pertanyaan = @mysqli_real_escape_string($conn, $_POST['pertanyaan']);
						$pil_A = @mysqli_real_escape_string($conn, $_POST['pil_A']);
						$pil_B = @mysqli_real_escape_string($conn, $_POST['pil_B']);
						$pil_C = @mysqli_real_escape_string($conn, $_POST['pil_C']);
						$pil_D = @mysqli_real_escape_string($conn, $_POST['pil_D']);
						$pil_E = @mysqli_real_escape_string($conn, $_POST['pil_E']);
						$kunci = @mysqli_real_escape_string($conn, $_POST['kunci']);
						
						$sumber = @$_FILES['gambar']['tmp_name'];
						$target_soal = '../img/soal/';
						$nama_gambar = @$_FILES['gambar']['name'];
						$type = $_FILES['gambar']['type'];
						
						move_uploaded_file($sumber, $target_soal.$id.'_'.$nama_gambar);
					
						mysqli_query($conn, "INSERT INTO tb_soal(id_paket, pertanyaan, gambarSoal, pil_A, pil_B, pil_C, pil_D, pil_E, kunci) VALUES ('$id', '$pertanyaan', '$nama_gambar', '$pil_A', '$pil_B', '$pil_C', '$pil_D', '$pil_E', '$kunci')");
						?>
						<script>window.location='<?=baseURL("soal/index/".$id);?>';</script>
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
			<div class="panel-heading">Tambah Soal &nbsp; <a class="btn btn-default" href="<?=baseURL("soal/index/".$id);?>">Kembali</a> &nbsp; <a class="btn btn-primary" href="<?=baseURL("soal/tambah/".$id."/".$id_dua);?>">Input Soal</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post" enctype="multipart/form-data" action="<?=baseURL("xlsx/xlsx_import_soal.php");?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Unduh Template</label>
							<div class="col-md-10" style="padding-top:7px;"><a class="btn btn-primary" href="<?=baseURL("xlsx/xlsx_template_soal.php?id=".$id);?>">Template</a></div>
						</div>
						<input type="hidden" name="id" value="<?= $id;?>">
						<div class="form-group">
							<label class="col-md-2 control-label">Import File Excel</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="file" name="excel" placeholder="Masukkan File Excel"></div>
						</div>						
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="soal_tambah" class="btn btn-primary" value="Tambah Soal"></div>
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
	$data_soal_update = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_soal WHERE id_soal = '$id_dua'"));
	?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="<?=baseURL();?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li><a href="<?=baseURL("ujian");?>">Manajemen Ujian</a></li>
		<li><a href="<?=baseURL("paket_soal/index/".$data_paket["id_ujian"]);?>"><?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></a></li>
		<li><a href="<?=baseURL("soal/index/".$id);?>">Soal <?php echo $data_paket['nama_mapel'];?></a></li>
		<li class="active">Ubah Soal</li>
	</ol>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Soal <?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></h1>
	</div>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Ubah Soal &nbsp; <a class="btn btn-default" href="<?=baseURL("soal/index/".$id);?>">Kembali</a></div>
			<div class="panel-body">
				<div class="tab-content">
					<fieldset class="form-horizontal">
						<form method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-md-2 control-label">Pertanyaan</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pertanyaan" placeholder="Masukkan Pertanyaan Soal" value="<?php echo $data_soal_update['pertanyaan'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Gambar Soal</label>
							<div class="col-md-10">
								<?php if($data_soal_update['gambarSoal'] == ''){echo "Tidak ada gambar.";}else{?>
								<img class="img-thumbnail" src="<?=baseURL("../img/soal/".$id."_".$data_soal_update['gambarSoal']);?>" style="width:300px;">
								<input class="form-control" type="file" name="gambar" placeholder="Masukkan Gambar Soal">
								<?php }?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan A</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_A" placeholder="Masukkan Pilihan Jawaban A" value="<?php echo $data_soal_update['pil_A'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan B</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_B" placeholder="Masukkan Pilihan Jawaban B" value="<?php echo $data_soal_update['pil_B'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan C</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_C" placeholder="Masukkan Pilihan Jawaban C" value="<?php echo $data_soal_update['pil_C'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan D</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_D" placeholder="Masukkan Pilihan Jawaban D" value="<?php echo $data_soal_update['pil_D'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Pilihan E</label>
							<div class="col-md-10" style="padding-top:7px;"><input class="form-control" type="text" name="pil_E" placeholder="Masukkan Pilihan Jawaban E" value="<?php echo $data_soal_update['pil_E'];?>"></div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Kunci Jawaban</label>
							<div class="col-md-10">
							<select class="form-control" name="kunci">
								<option <?php if($data_soal_update['kunci'] == 'A'){echo "selected";}?> value="A">A</option>
								<option <?php if($data_soal_update['kunci'] == 'B'){echo "selected";}?> value="B">B</option>
								<option <?php if($data_soal_update['kunci'] == 'C'){echo "selected";}?> value="C">C</option>
								<option <?php if($data_soal_update['kunci'] == 'D'){echo "selected";}?> value="D">D</option>
								<option <?php if($data_soal_update['kunci'] == 'E'){echo "selected";}?> value="E">E</option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 control-label"><input type="submit" name="soal_update" class="btn btn-primary" value="Ubah Soal"></div>
						</div>
						</form>
					</fieldset>
					<?php if(@$_POST['soal_update']){
						$pertanyaan = @mysqli_real_escape_string($conn, $_POST['pertanyaan']);
						$pil_A = @mysqli_real_escape_string($conn, $_POST['pil_A']);
						$pil_B = @mysqli_real_escape_string($conn, $_POST['pil_B']);
						$pil_C = @mysqli_real_escape_string($conn, $_POST['pil_C']);
						$pil_D = @mysqli_real_escape_string($conn, $_POST['pil_D']);
						$pil_E = @mysqli_real_escape_string($conn, $_POST['pil_E']);
						$kunci = @mysqli_real_escape_string($conn, $_POST['kunci']);					
						$nama_gambar = $data_soal_update['gambarSoal'];

						if($_FILES['gambar']) {
							$alamat = '../img/soal/'.$id.'_';
							$files = glob($alamat.$nama_gambar); // get all file names
							foreach($files as $file){ // iterate files
							if(is_file($file)) {  
								unlink($file); // delete file
							}
							}
							
							$sumber = @$_FILES['gambar']['tmp_name'];
							$target_soal = '../img/soal/';
							$nama_gambar = @$_FILES['gambar']['name'];
							$type = $_FILES['gambar']['type'];
							
							move_uploaded_file($sumber, $target_soal.$id.'_'.$nama_gambar);
						}
						mysqli_query($conn, "UPDATE tb_soal SET pertanyaan = '$pertanyaan', gambarSoal = '$nama_gambar', pil_A = '$pil_A', pil_B = '$pil_B', pil_C = '$pil_C', pil_D = '$pil_D', pil_E = '$pil_E', kunci = '$kunci' WHERE id_soal = '$id_dua'");
						?>
						<script>window.location='<?=baseURL("soal/index/".$id);?>';</script>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
<?php 
}elseif(url(1) == "delete"){
	$nama_gambar = mysqli_fetch_array(mysqli_query($conn, "SELECT gambarSoal FROM tb_soal WHERE id_soal = '$id_dua'"));
	if($nama_gambar['gambarSoal']) {
		$alamat = '../img/soal/'.$id.'_';
		$files = glob($alamat.$nama_gambar['gambarSoal']); // get all file names
		foreach($files as $file){ // iterate files
		if(is_file($file)) {  
			echo $nama_gambar['gambarSoal'];
			//unlink($file); // delete file
		}
		}
	}
    mysqli_query($conn, "DELETE FROM tb_soal WHERE id_soal = '$id_dua'");
	?>
	<script>window.location='<?=baseURL("soal/index/".$id);?>';</script>
<?php }?>