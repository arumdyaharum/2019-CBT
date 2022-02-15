	  <div class="row">
        <div class="col-md-5 blog-main" style="margin:5.5rem auto;">
		  <div class="blog-post">
            <h3 class="pb-3 mb-4 font-italic border-bottom text-center">Masuk</h3>
			<?php
			if(@$_POST['login']) {
				$user = @mysqli_real_escape_string($conn, $_POST['user']);
				$pass = @mysqli_real_escape_string($conn, $_POST['pass']);
				$sql = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE user = '$user' AND pass = '$pass'") or die ($conn->error);
				$data = mysqli_fetch_array($sql);
				if(mysqli_num_rows($sql) > 0) {
					if($data['status'] == 'aktif') {
						@$_SESSION['id_siswa'] = $data['id'];
						@$_SESSION['nm_siswa'] = $data['nama'];
						@$_SESSION['kelas_siswa'] = $data['kelas'];
						echo "<script>window.location='./';</script>";
					} else {
						echo '<div class="alert alert-secondary">Maaf, Akun Anda belum diverifikasi.</div>';
					}
				} else {
					echo '<h6 class="font-italic text-center mb-4" style="color:#666;">Login gagal, username / password salah, coba lagi!</h6>';
				}
			} ?>
			<form method="post">
			  <div class="form-group">
				<label for="inputUsername">Username</label>
				<input type="text" class="form-control" id="inputUsername" name="user" placeholder="Enter Username">
			  </div>
			  <div class="form-group">
				<label for="inputPassword">Password</label>
				<input type="password" class="form-control" id="inputPassword" name="pass" placeholder="Password">
			  </div>
			  <div><input type="submit" class="btn btn-primary" name="login" value="Masuk"></div>
			</form>
		  </div>
		</div>
	  </div>