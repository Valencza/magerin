<?php require_once('../config/koneksi.php');
$query = mysqli_query($conn, "select * from tbl_transaction");
?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Transaksi ( Terdapat <?php echo mysqli_num_rows($query); ?> Data)</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table class="table table-bordered" id="tabel">
			<thead>
				<tr>
					<th>NO</th>
					<th>ORDER ID</th>
					<th>TYPE SUBSCRIPTION</th>
					<th>STATUS</th>
					<th>ACTION</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				while ($q = mysqli_fetch_array($query)) {
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $q['order_id'] ?></td>
						<td><?php echo $q['type_subscription'] ?></td>
						<td><?php echo $q['status'] ?></td>
						<?php if (isset($_SESSION['username'])) : ?>
              <td>
                <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data video ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id_transaction=<?php echo $q['id_transaction']; ?>">Hapus</a>
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