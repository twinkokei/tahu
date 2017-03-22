<!-- Content Header (Page header) -->
<?php if(isset($_GET['did']) && $_GET['did'] == 1){ ?>
<section class="content_new">
  <div class="alert alert-info alert-dismissable">
    <i class="fa fa-check"></i>
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    <b>Simpan gagal !</b>
    Password dan confirm password tidak sama
  </div>
</section>
<? }else if(isset($_GET['did']) && $_GET['did'] == 2){ ?>
<section class="content_new">
  <div class="alert alert-info alert-dismissable">
    <i class="fa fa-check"></i>
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    <b>Edit sukses</b>
  </div>
</section>
<?php } else if(isset($_GET['err']) && $_GET['err'] == 2){ ?>
<section class="content_new">
  <div class="alert alert-info alert-dismissable">
    <i class="fa fa-check"></i>
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    <b>Mohon Gunakan</b>
    username dengan nama lain!
  </div>
</section>
<?php } ?>
<!-- Main content -->
<section class="content">
  <div class="row">
  <!-- right column -->
    <div class="col-md-12">
    <!-- general form elements disabled -->
    <div class="title_page"> <?= $title ?></div>
      <form role="form" action="<?= $action?>" method="post" enctype="multipart/form-data" role="form">
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-9">
              <div class="form-group">
                <label>Name</label>
                <input required type="text" name="i_name" class="form-control" placeholder="Enter name ..." value="<?= $row->user_name ?>"/>
              </div>
              <div class="form-group">
              <label>Phone</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input required class="form-control" type="text" name="i_phone" placeholder="Enter phone ..." value="<?= $row->user_phone?>">
                </div>
              </div>
              <div class="form-group">
                <label>User login</label>
                <input required type="text" name="i_login" class="form-control" placeholder="Enter user login ..." value="<?= $row->user_login ?>"/>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input   type="password" name="i_password" class="form-control" placeholder="Enter password ..." value=""/>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input   type="password" name="i_confirm_password" class="form-control" placeholder="Enter confirm password ..." value=""/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Gambar</label>
                <?php
                if($id){ ?>
                <?php 
                if($row->user_img){
                  ?>
                    <img src="<?= "../img/user/".$row->user_img ?>" style="width:100%;"/>
                    <?}?>
                    <img id="user_img" style="width:100%;padding: 10px;"/>
                    <input type="file" accept="image/*" name="i_img" onchange="loadFile(event)">
                <?php
                 } ?>
              </div>
            </div>
            <div style="clear:both;"></div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <input class="btn btn-success" type="submit" value="Simpan"/>
          </div>
        </div><!-- /.box -->
      </form>
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section>
<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var user_img = document.getElementById('user_img');
      user_img.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
