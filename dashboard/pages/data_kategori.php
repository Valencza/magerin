<?php require_once('../config/koneksi.php');
$query = mysqli_query($conn, "select * from tbl_kategori");
?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Kategori ( Terdapat <?php echo mysqli_num_rows($query); ?> Data)</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<?php if (isset($_SESSION['username'])) : ?>
			<a href="tambah.php?tambah=data_kategori" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data Kategori</a>
		<?php endif; ?>
		<br>
		<table class="table table-bordered" id="tabel">
			<thead>
				<tr>
					<th>NO</th>
					<th>KATEGORI</th>
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
						<td><?php echo $q['nama_kategori'] ?></td>
						<?php if (isset($_SESSION['username'])) : ?>
							<td>
								<a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id_kategori=<?php echo $q['id_kategori']; ?>">Edit</a>
								<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data kategori ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id_kategori=<?php echo $q['id_kategori']; ?>">Hapus</a>
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
			"bAutoWidth": true
		});
	});
</script>