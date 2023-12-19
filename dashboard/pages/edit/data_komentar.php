<?php require_once(__DIR__ . '/../../../config/koneksi.php');

$query = mysqli_query($conn, "
    SELECT k.id_komentar, v.video, u.username, u.foto_profile, k.komentar
    FROM tbl_komentar k
    INNER JOIN tbl_video v ON k.id_video = v.id_video
    INNER JOIN tbl_user u ON k.id_user = u.id_user
");
$data = mysqli_fetch_assoc($query);
?>
<section>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Edit Komentar</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="simpan.php" autocomplete="off">
                    <input type="hidden" name="id_komentar" value="<?php echo $data['id_komentar']; ?>">
                        <input type="hidden" name="type" value="data_komentar">
                        <input type="hidden" name="cmd" value="edit">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $data['username']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>video</label>
                            <input type="text" class="form-control" name="password" placeholder="Password" value="<?php echo $data['video']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>komentar</label>
                            <input type="text" class="form-control" name="level" placeholder="Level" value="<?php echo $data['komentar']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>foto_profile</label>
                            <input type="file" class="form-control" name="foto_profile" placeholder="Foto Profile" value="<?php echo $data['foto_profile']; ?>" />
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