<?php
require_once(__DIR__ . '/../../../config/koneksi.php');

$id_video_to_edit = $_GET['id_video']; // Assuming you pass the video ID through the URL

$query = mysqli_query($conn, "SELECT v.*, k.nama_kategori
FROM tbl_video v
INNER JOIN tbl_kategori k ON v.id_kategori = k.id_kategori
WHERE v.id_video = $id_video_to_edit");

// Fetch all rows from the result set
$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data[] = $row;
}

// Assuming you are working with a specific row for editing (you need to adjust this based on your logic)
if (!empty($data)) {
    $current_data = $data[0];
} else {
    // Handle the case where the specified video ID is not found
    die("Video not found for editing");
}
?>

<section>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Edit Video</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="simpan.php" enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="id_video" value="<?php echo $current_data['id_video']; ?>">
                        <input type="hidden" name="type" value="data_video">
                        <input type="hidden" name="cmd" value="edit">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul" value="<?php echo $current_data['judul']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="id_kategori" class="form-control">
                                <?php
                                // Query untuk mengambil data kategori
                                $query_kategori = mysqli_query($conn, "SELECT id_kategori, nama_kategori FROM tbl_kategori");

                                while ($kategori = mysqli_fetch_array($query_kategori)) {
                                    $selected = ($kategori['id_kategori'] == $current_data['id_kategori']) ? "selected" : "";
                                    echo "<option value='" . $kategori['id_kategori'] . "' $selected>" . $kategori['nama_kategori'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Video</label>
                            <input type="file" class="form-control" name="video" placeholder="video" accept="video/*" />
                        </div>
                        <div class="form-group">
                            <label>Trailer</label>
                            <textarea class="form-control" name="trailer" placeholder="Trailer"><?php echo $current_data['trailer']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="image_video" placeholder="Gambar Video" accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" placeholder="Thumbnail" accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" class="form-control" name="tahun" placeholder="Tahun" value="<?php echo $current_data['tahun']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Durasi</label>
                            <input type="text" class="form-control" name="durasi" placeholder="Durasi" value="<?php echo $current_data['durasi']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="text" class="form-control" name="rating" placeholder="Rating" value="<?php echo $current_data['rating']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"><?php echo $current_data['deskripsi']; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-warning"> <i class="fa fa-backward"></i> Kembalikan Data</button>
                        <a href="index.php?page=data_video" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
    </div>
</section>
