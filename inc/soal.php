	<?php  
	$data_paket = mysqli_fetch_array(mysqli_query($conn, "
	SELECT * FROM tb_paket_soal paket
	JOIN tb_mapel mapel ON paket.id_mapel = mapel.id_mapel
	JOIN tb_ujian ujian ON paket.id_ujian = ujian.id_ujian
	WHERE id_paket = '$id'"));
	$guru_explode = explode(',',$data_paket['id_guru']);
	$query_paket_guru = mysqli_query($conn, "SELECT * FROM tb_guru WHERE id_guru IN ($data_paket[id_guru])");
	$jumlah_guru = mysqli_num_rows($query_paket_guru);
	$nomor = 1;
	
	$query_soal = mysqli_query($conn, "SELECT * FROM tb_soal WHERE id_paket = '$id' ORDER BY rand()");
	$jumlah_soal = mysqli_num_rows($query_soal);

	$query_waktu = mysqli_query($conn, "SELECT waktu FROM tb_waktu WHERE id_paket = '$id' AND id_siswa = '$_SESSION[id_siswa]'");
	$cek_waktu = mysqli_num_rows($query_waktu);
	$data_waktu = mysqli_fetch_array($query_waktu);
	?>
	
<script>
<?php if($cek_waktu > 0){?>
var countDownDate = <?php echo $data_waktu['waktu'];?>;
<?php } else {?>
var countDownDate = <?php echo $data_paket['waktu'];?>;
<?php }?>
var x = setInterval(function() {
  var hours = Math.floor((countDownDate % (60 * 60 * 24)) / (60 * 60));
  var minutes = Math.floor((countDownDate % (60 * 60)) / (60));
  var seconds = Math.floor((countDownDate % (60)) / 1);
   minutes = minutes < 10 ? "0" + minutes : minutes;
   seconds = seconds < 10 ? "0" + seconds : seconds; 
  document.getElementById("demo").innerHTML = hours + ":"
  + minutes + ":" + seconds;
  countDownDate--;
    
  if (countDownDate < 0) {
    clearInterval(x);
	document.getElementById("kirim").click();
  }
}, 1000);

    window.history.forward();
    function noBack(){ window.history.forward(); }
</script>	
	<main role="main" class="container mt-4">
      <div class="row">
        <div class="col-md-9 blog-main">
            
            <h2 class="blog-post-title"><?php echo $data_paket['nama_mapel'];?></h2>
            <p class="blog-post-meta"><?php echo $data_paket['judul'].' TA '.$data_paket['thn_ajar'];?></p>

            <p>Pengajar : <?php while($data_paket_guru = mysqli_fetch_array($query_paket_guru)){
				echo $data_paket_guru['nama_guru'];
				if($nomor == $jumlah_guru){
					$nomor = 1;
				} else {
					echo ", ";
					$nomor++;
				}
			}?>
            
          </div><!-- /.blog-post -->

        <aside class="col-md-3 blog-sidebar">
          <div class="p-3 bg-light rounded">
            <p class="mb-0">Waktu Ujian</p>
			<h1 class="display-4 font-italic" id="demo">0:00:00</h1>
          </div>
        </aside><!-- /.blog-sidebar -->
      </div><!-- /.row -->
	  
	  <div class="accordion" id="accordionExample">
		<div class="card">
			<div class="card-header" id="headingTwo">
			<h2 class="mb-0">
				<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				Nomor Soal
				</button>
			</h2>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
			<div class="card-body">
				<?php for($i = 1; $i <= $jumlah_soal; $i++){?>
				<a class="btn btn-primary active page" id="<?php echo $i;?>"><?php echo $i;?></a>
				<?php }?>
			</div>
			</div>
		</div>
		</div>

      <div class="row">
		<div class="col-md-12">
		  <div class="card flex-md-row mb-4 box-shadow">
            <div class="card-body d-flex flex-column  table-soal">
			  <form action="<?=baseURL("inc/proses_soal.php");?>" method="post">
				<input type="hidden" name="id_siswa" value="<?php echo $_SESSION['id_siswa'];?>">
				<input type="hidden" name="id_paket" value="<?php echo $id;?>">
				<input type="hidden" name="id_ujian" value="<?php echo $data_paket['id_ujian'];?>">
				<input type="hidden" name="jumlah_soal_pilgan" value="<?php echo $jumlah_soal;?>">
				<?php while($data_soal = mysqli_fetch_array($query_soal)){
					$data_jawab = mysqli_fetch_array(mysqli_query($conn, "SELECT jawab FROM tb_jawaban WHERE id_paket = '$id' AND id_siswa = '$_SESSION[id_siswa]' AND id_soal = '$data_soal[id_soal]'"));	
				?>
				<table class="w-100 ngumpet<?php if($nomor == '1'){echo " muncul";}?>" id="<?php echo $nomor;?>">
				<tr>
				<td>
				<strong class="d-inline-block mb-2">( Nomor <?php echo $nomor++;?> )</strong>
				</td>
				</tr>
				<tr>
				<td>
                <h4 class="mb-3"><a class="text-dark"><?php echo $data_soal['pertanyaan'];?></a></h4>
				<input type="hidden" name="id_soal" value="<?php echo $data_soal['id_soal'];?>">
				</td>
				<?php if($data_soal['gambarSoal']){?>
				<td rowspan="5" width="1%">
				<img src="<?=baseURL("img/soal/".$id."_".$data_soal['gambarSoal']);?>">
				</td>
				<?php }?>
				</tr>
				  <tr>
					<td>
					  <label><input type="radio" name="pilihan_ganda[<?php echo $data_soal['id_soal'];?>]" value="A" <?php if(isset($data_jawab['jawab']) AND $data_jawab['jawab'] == 'A'){echo "checked";}?>> A. <?php echo $data_soal['pil_A'];?></label>
					</td>
				  </tr>
				  <tr>
					<td>
					  <label><input type="radio" name="pilihan_ganda[<?php echo $data_soal['id_soal'];?>]" value="B" <?php if(isset($data_jawab['jawab']) AND $data_jawab['jawab'] == 'B'){echo "checked";}?>> B. <?php echo $data_soal['pil_B'];?></label>
					</td>
				  </tr>
				  <tr>
					<td>
					  <label><input type="radio" name="pilihan_ganda[<?php echo $data_soal['id_soal'];?>]" value="C" <?php if(isset($data_jawab['jawab']) AND $data_jawab['jawab'] == 'C'){echo "checked";}?>> C. <?php echo $data_soal['pil_C'];?></label>
					</td>
				  </tr>
				  <tr>
					<td>
					  <label><input type="radio" name="pilihan_ganda[<?php echo $data_soal['id_soal'];?>]" value="D" <?php if(isset($data_jawab['jawab']) AND $data_jawab['jawab'] == 'D'){echo "checked";}?>> D. <?php echo $data_soal['pil_D'];?></label>
					</td>
				  </tr>
				  <tr>
					<td>
					  <label><input type="radio" name="pilihan_ganda[<?php echo $data_soal['id_soal'];?>]" value="E" <?php if(isset($data_jawab['jawab']) AND $data_jawab['jawab'] == 'E'){echo "checked";}?>> E. <?php echo $data_soal['pil_E'];?></label>
					</td>
				  </tr>
				</table>
				<?php }?>
				<hr>
				  <div class="row">
					<div class="col-6">
					<a class="btn btn-secondary active float-left" id="prev">Save and Previous</a>
					</div>
					<div class="col-6">
					<a class="btn btn-primary active float-right" id="next">Save and Next</a>
					<button type="submit" class="btn btn-danger float-right" id="kirim">selesai</button>
					</div>
				  </div>
				</form>
            </div>
          </div>
		</div>
      </div><!-- /.row -->
    </main><!-- /.container -->