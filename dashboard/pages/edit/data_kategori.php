<?php require_once(__DIR__ . '/../../../config/koneksi.php');

$query = mysqli_query($conn, "select * from tbl_kategori where id_kategori=" . $_GET['id_kategori']);
$data = mysqli_fetch_array($query);
?>
<section>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Edit Kategori</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="simpan.php">
                        <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori']; ?>">
                        <input type="hidden" name="type" value="data_kategori">
                        <input type="hidden" name="cmd" value="edit">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" placeholder="Kategori" value="<?php echo $data['nama_kategori']; ?>" />
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