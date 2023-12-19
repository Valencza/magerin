<?php
require_once(__DIR__ . '/../../config/koneksi.php');
$query = mysqli_query($conn, "SELECT v.*, k.nama_kategori
FROM tbl_video v
INNER JOIN tbl_kategori k ON v.id_kategori = k.id_kategori 
ORDER BY id_video DESC");
?>

<style>
  .table-container {
    overflow-x: auto;
  }
</style>


<!-- Modal for Video -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="videoModalLabel">Tonton Video</h4>
      </div>
      <div class="modal-body">
        <video controls id="modalVideo" style="width: 100%;">
          <source src="" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Image Video -->
<div class="modal fade" id="imageVideoModal" tabindex="-1" role="dialog" aria-labelledby="imageVideoModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="imageVideoModalLabel">Video Image</h4>
      </div>
      <div class="modal-body">
        <img id="modalImageVideo" src="" style="width: 100%;" alt="Video Image">
      </div>
    </div>
  </div>
</div>

<!-- Modal for Trailer -->
<div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-labelledby="trailerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="trailerModalLabel">Trailer</h4>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" id="modalTrailer" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal for Thumbnail -->
<div class="modal fade" id="thumbnailModal" tabindex="-1" role="dialog" aria-labelledby="thumbnailModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="thumbnailModalLabel">Thumbnail Image</h4>
      </div>
      <div class="modal-body">
        <img id="modalThumbnail" src="" style="width: 100%;" alt="Thumbnail Image">
      </div>
    </div>
  </div>
</div>

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Video ( Terdapat <?php echo mysqli_num_rows($query); ?> Data)</h3>
  </div>

  <!-- /.box-header -->

  <div class="box-body">
    <?php if (isset($_SESSION['username'])) : ?>
      <a href="tambah.php?tambah=data_video" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data Video</a>
    <?php endif; ?>
	<div class="table-container">
  <table width="100%" class="table table-bordered" id="tabel">
      <thead>
        <tr>
          <th>NO</th>
          <th>JUDUL</th>
          <th>KATEGORI</th>
          <th>VIDEO</th>
          <th>TRAILER</th>
          <th>IMAGE</th>
          <th>THUMBNAIL</th>
          <th>TAHUN</th>
          <th>DURASI</th>
          <th>RATING</th>
          <th>DESKRIPSI</th>
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
          // Assuming that $q['video'], $q['image_video'], and $q['thumbnail'] already contain the correct paths
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $q['judul'] ?></td>
            <td><?php echo $q['nama_kategori'] ?></td>

            <td>
              <a href="#" class="open-modal" data-toggle="modal" data-target="#videoModal" data-video="../img/video/<?php echo $q['video']; ?>">
                Tonton Video
              </a>
            </td>

            <td>
    <a href="#" class="open-trailer-modal" data-toggle="modal" data-target="#trailerModal" data-trailer="<?php echo htmlspecialchars($q['trailer']); ?>">
        Watch Trailer
    </a>
</td>


            <td>
              <a href="#" class="open-modal" data-toggle="modal" data-target="#imageVideoModal" data-image="../img/poster/<?php echo $q['image_video']; ?>">
                <img src="../img/poster/<?php echo $q['image_video']; ?>" style="width: 30px; height: 30px;">
              </a>
            </td>
			<td>
				<a href="#" class="open-modal" data-toggle="modal" data-target="#thumbnailModal" data-thumbnail="../img/thumbnail/<?php echo $q['thumbnail']; ?>">
					<img src="../img/thumbnail/<?php echo $q['thumbnail']; ?>" style="width: 30px; height: 30px;">
				</a>
			</td>
            <td><?php echo $q['tahun'] ?></td>
            <td><?php echo $q['durasi'] ?></td>
            <td><?php echo $q['rating'] ?></td>
            <td><?php echo $q['deskripsi'] ?></td>
            <?php if (isset($_SESSION['username'])) : ?>
              <td>
                <a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id_video=<?php echo $q['id_video']; ?>">Edit</a>
                <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data video ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id_video=<?php echo $q['id_video']; ?>">Hapus</a>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Function to stop and reset the video player
    function resetVideoPlayer() {
      var modalVideo = $('#modalVideo')[0];
      modalVideo.pause();
      modalVideo.currentTime = 0;
    }

    // Function to stop and reset the trailer iframe
    function resetTrailerIframe() {
      var modalTrailer = $('#modalTrailer')[0];
      modalTrailer.src = '';
    }

    $('.open-modal').click(function() {
      var mediaSource = $(this).data('video');
      var imageSource = $(this).data('image');
      var thumbnailSource = $(this).data('thumbnail');

      $('#modalVideo source').attr('src', mediaSource);
      $('#modalImageVideo').attr('src', imageSource);
      $('#modalThumbnail').attr('src', thumbnailSource);

      // Reload the video
      $('#modalVideo')[0].load();
    });

    $('#trailerModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var iframeCode = button.data('trailer'); // Extract info from data-* attributes
      var modalBody = $(this).find('.modal-body');
      
      // Set the HTML content with the trailer iframe code
      modalBody.html(iframeCode);
    });

    // Use the shown.bs.modal event to trigger actions after the modal is fully shown
    $('#videoModal').on('shown.bs.modal', function() {
      $('#modalVideo')[0].play(); // Start playing the video
    });

    // When the video modal is hidden (closed), stop and reset the video player
    $('#videoModal').on('hidden.bs.modal', function() {
      resetVideoPlayer();
    });

    // When the trailer modal is hidden (closed), reset the trailer iframe
    $('#trailerModal').on('hidden.bs.modal', function() {
      resetTrailerIframe();
    });

    // When the trailer modal is closed via the close button
    $('#trailerModal .close').click(function() {
      resetTrailerIframe();
    });

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
