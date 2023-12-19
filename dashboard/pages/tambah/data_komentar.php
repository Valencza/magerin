<section>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Tambah Komentar</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" action="simpan.php" autocomplete="off">
                        <!-- text input -->
                        <input type="hidden" name="type" value="data_komentar">
                        <input type="hidden" name="cmd" value="tambah">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="" />
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Video</label>
                            <input class="form-control" rows="3" name="video" placeholder="Video" value="" />
                        </div>
                        <div class="form-group">
                            <label>Komentar</label>
                            <input type="text" class="form-control" name="komentar" placeholder="Komentar" value="" />
                        </div>
                        <div class="form-group">
                            <label>Profile</label>
                            <input type="file" class="form-control" name="foto_profile" value="" />
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