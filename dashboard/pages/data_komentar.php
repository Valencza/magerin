<?php
require_once('../config/koneksi.php');

$query = mysqli_query($conn, "
SELECT k.id_komentar, v.video, u.username, k.komentar
FROM tbl_komentar k
LEFT JOIN tbl_video v ON k.id_video = v.id_video
LEFT JOIN tbl_user u ON k.id_user = u.id_user
");

$data = mysqli_fetch_all($query, MYSQLI_ASSOC); // Mengambil semua baris data

?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Komentar ( Terdapat <?php echo count($data); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered" id="tabel">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>USERNAME</th>
                    <th>VIDEO</th>
                    <th>KOMENTAR</th>
                    <th>ACTION</th>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <th></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data as $q) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo ($q['username'] !== null) ? $q['username'] : 'N/A'; ?></td>
						<td><?php echo $q['video'] ?></td>
						<td><?php echo $q['komentar'] ?></td>
						<?php if (isset($_SESSION['username'])) : ?>
							<td>
								<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data user ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id_komentar=<?php echo $q['id_komentar']; ?>">Hapus</a>
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