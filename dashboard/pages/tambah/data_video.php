    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-success">
                
               
<div class="box-header">
                    <h3 class="box-title">Tambah Video</h3>
                </div><!-- /.box-header -->
                
               
<div class="box-body">
                    <form role="form" method="post" action="simpan.php" autocomplete="off" enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="type" value="data_video">
                        <input type="hidden" name="cmd" value="tambah">

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul" value="" />
                        </div>

						<div class="form-group">
    <label>Kategori</label>
    <select name="id_kategori" class="form-control">
        <option value="" disabled selected hidden>PILIH KATEGORI</option>
        <?php

        $query_kategori = mysqli_query($conn, "SELECT id_kategori, nama_kategori FROM tbl_kategori");

        while ($kategori = mysqli_fetch_assoc($query_kategori)) {
            echo "<option value='" . $kategori['id_kategori'] . "'>" . $kategori['nama_kategori'] . "</option>";
        }
        ?>
    </select>
</div>


						<div class="form-group">
                            <label>Video</label>
                            <input type="file" class="form-control" name="video" />
                        </div>

                        <div class="form-group">
                            <label>Trailer</label>
                            <input type="text" class="form-control" name="trailer" />
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image_video" />
                        </div>

                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" />
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Tahun</label>
                                <input type="text" class="form-control" name="tahun" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Durasi</label>
                                <input type="text" class="form-control" name="durasi" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Rating</label>
                                <input type="text" class="form-control" name="rating" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
                        <a href="index.php?page=data_video" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
                    </form>
					</div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
    </div>
</section>

<!-- Include Bootstrap JS (Assuming you are using Bootstrap) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
