<?php require_once('../config/koneksi.php');
$query = mysqli_query($conn, "select * from tbl_user");
?>


<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data User ( Terdapat <?php echo mysqli_num_rows($query); ?> Data)</h3>
	</div>

	<!-- /.box-header -->

	<div class="box-body">
		<?php if (isset($_SESSION['username'])) : ?>
			<a href="tambah.php?tambah=data_user" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data User</a>
		<?php endif; ?>
		<table wid_videoth="100%" class="table table-bordered" id_user="tabel">
			<thead>

				<tr>
					<th>NO</th>
					<th>USERNAME</th>
					<th>PASSWORD</th>
					<th>LEVEL</th>
					<th>PROFILE</th>
					<th>ACTION</th>
					<?php if (isset($_SESSION['username'])) : ?>
						<th></th>
					<?php endif; ?>
				</tr>

			</thead>
			<tbody>
				<?php
				$no = 1;
				while ($q = mysqli_fetch_array($query)) {
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $q['username'] ?></td>
						<td><?php echo $q['password'] ?></td>
						<td><?php echo $q['level'] ?></td>
						<td><img src="<?php echo $q['foto_profile']; ?>" style="width: 20px; height:20px;"></td>
						<?php if (isset($_SESSION['username'])) : ?>
							<td>
								<a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id_user=<?php echo $q['id_user']; ?>">Edit</a>
								<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data user ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id_user=<?php echo $q['id_user']; ?>">Hapus</a>
							</td>
						<?php endif; ?>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel').dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWid_videoth": true
		});
	});
</script>