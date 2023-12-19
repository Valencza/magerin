<?php require_once(__DIR__ . '/../../../config/koneksi.php');

$query = mysqli_query($conn, "select * from tbl_user where id_user=" . $_GET['id_user']);
$data = mysqli_fetch_array($query);
?>
<section>
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements disabled -->
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Edit User</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<form role="form" method="post" action="simpan.php" autocomplete="off" enctype="multipart/form-data">
						<input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
						<input type="hidden" name="type" value="data_user">
						<input type="hidden" name="cmd" value="edit">
						<!-- text input -->
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $data['username']; ?>" />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control" name="password" placeholder="Password" value="<?php echo $data['password']; ?>" />
						</div>
						<div class="form-group">
							<label>level</label>
							<input type="text" class="form-control" name="level" placeholder="Level" value="<?php echo $data['level']; ?>" />
						</div>

						<div class="form-group">
							<label>foto_profile</label>
							<img src="<?php echo $data['foto_profile']; ?>" alt="Foto Profile" style="max-width: 100px;">
							<input type="file" class="form-control" name="foto_profile" accept="image/*" />
						</div>

						<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
						<button type="reset" class="btn btn-warning"> <i class="fa fa-backward"></i> Kembalikan Data</button>
						<a href="index.php?page=data_user" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.col (right) -->
	</div>
</section>