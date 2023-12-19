<?php

require_once('../config/koneksi.php');

$data_user = mysqli_query($conn, "select * from tbl_user");
$data_video = mysqli_query($conn, "select * from tbl_video");
$data_transaksi = mysqli_query($conn, "select * from tbl_transaction");
$data_komentar = mysqli_query($conn, "select * from tbl_komentar");
$data_kategori = mysqli_query($conn, "select * from tbl_kategori");
?>
<div class="row col-lg-12">
  <div class="col-lg-2 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($data_user); ?></h3>
        <p>Data User</p>
      </div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <a href="./?page=data_user" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($data_video); ?></h3>
        <p>Data Video</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
      <a href="./?page=data_video" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
  <div class="col-lg-2 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($data_transaksi); ?></h3>
        <p>Data Transaksi</p>
      </div>
      <div class="icon">
        <i class="fa fa-group"></i>
      </div>
      <a href="./?page=data_transaksi" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($data_komentar); ?></h3>
        <p>Data Komentar</p>
      </div>
      <div class="icon">
        <i class="fa fa-file"></i>
      </div>
      <a href="./?page=data_komentar" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-2 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($data_kategori); ?></h3>
        <p>Data Kategori</p>
      </div>
      <div class="icon">
        <i class="fa fa-file"></i>
      </div>
      <a href="./?page=data_kategori" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
</div><!-- /.row -->
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>