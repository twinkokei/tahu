<?php
      $query=mysql_query("SELECT * from office");
      $r_img = mysql_fetch_array($query);
      $gambar = $r_img['office_img'];
      ?>
<style>
  .img-office{
    background-image: image('<?= "../img/menu/".$gambar?>');
    width: auto;;
  }
  .center{
    text-align: center;
  }
</style>
  <?php
  if(isset($_GET['did']) && $_GET['did'] == 1){
  ?>
  <section class="content_new">
    <div class="alert alert-info alert-dismissable">
      <i class="fa fa-check"></i>
      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
      <b>Sukses !</b>
      Simpan Berhasil
    </div>
  </section>
  <?php }else if(isset($_GET['did']) && $_GET['did'] == 2){ ?>
  <section class="content_new">
    <div class="alert alert-info alert-dismissable">
      <i class="fa fa-check"></i>
      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
      <b>Sukses !</b>
      Edit Berhasil
    </div>
  </section>
  <?php }else if(isset($_GET['did']) && $_GET['did'] == 3){ ?>
  <section class="content_new">
    <div class="alert alert-info alert-dismissable">
      <i class="fa fa-check"></i>
      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
      <b>Sukses !</b>
      Delete Berhasil
    </div>
  </section>
  <?php } ?>
                <!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
  <div class="row">
      </div><!-- ./row -->
</section><!-- /.content -->
