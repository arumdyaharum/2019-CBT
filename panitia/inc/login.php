
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="user" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="pass" type="password">
							</div>
							<input class="btn btn-primary" type="submit" name="login">
						</fieldset>
					</form>
				</div>
			</div>
			<?php
			if(@$_POST['login']) {
				$user = @mysqli_real_escape_string($conn, $_POST['user']);
				$pass = @mysqli_real_escape_string($conn, $_POST['pass']);
				$sql = mysqli_query($conn, "SELECT * FROM tb_panitia WHERE user = '$user' AND pw = sha2('$pass',0)") or die ($conn->error);
				$data = mysqli_fetch_array($sql);
				if(mysqli_num_rows($sql) > 0) {
					@$_SESSION['id_panitia'] = $data['id'];
					@$_SESSION['nm_panitia'] = $data['nama'];
					echo "<script>window.location='./';</script>";
				} else {?>	
				<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Login gagal, username / password salah, coba lagi!
				</div>
				<?php }
			} ?>
		</div><!-- /.col-->
	</div><!-- /.row -->