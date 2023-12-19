<section>
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements disabled -->
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Tambah User</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<form role="form" method="post" action="simpan.php" enctype="multipart/form-data" autocomplete="off">
						<!-- text input -->
						<input type="hidden" name="type" value="data_user">
						<input type="hidden" name="cmd" value="tambah">

						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username" value="" />
						</div>
						<!-- textarea -->
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						<div class="form-group">
							<label>Level</label>
							<input type="text" class="form-control" name="level" placeholder="User / Admin" value="" />
						</div>
						<div class="form-group">
							<label>Profile</label>
							<input type="file" class="form-control" name="foto_profile" placeholder="Profile" value="" />
						</div>

						<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
						<button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
						<a href="index.php?page=data_user" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.col (right) -->
	</div>
</section>