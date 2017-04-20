
<?php
if(isset($_GET['did']) && $_GET['did'] == 1){ ?>
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
<?php
}else if(isset($_GET['did']) && $_GET['did'] == 3){
?>
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
  <div class="row">
    <div class="col-xs-12">
      <div class="title_page"> <?= $title ?></div>
      <div class="box">
        <div class="box-body2 table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="text-align:center; width:5%;">No</th>
              <th style="text-align:center;">Nama Tutorial</th>
              <th style="text-align:center;">Config</th>
            </tr>
          </thead>
        <tbody>
        <?php
        $no = 1;
        while($row = mysql_fetch_array($query)){ ?>
          <tr>
            <td><?= $no?></td>
            <td><?= $row['tutorial_name']?></td>
            <td style="text-align:center;">
              <a href="tutorial.php?page=form&id=<?= $row['tutorial_id']?>" class="btn btn-default" >
                <i class="fa fa-pencil"></i>
              </a>
              <?php if (strpos($permit, 'd') !== false){ ?>
              <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['tutorial_id']; ?>,'tutorial.php?page=delete&id=')"
                class="btn btn-default" >
                <i class="fa fa-trash-o"></i>
              </a>
              <button type="button" name="button" class="btn btn-default" onclick="play_video(<?= $row['tutorial_id']?>)">
                <i class="fa fa-play"></i>
              </button>
                <?php }; ?>
            </td>
          </tr>
        <?php $no++; } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">
              <?php if (strpos($permit, 'c') !== false): ?>
              <a href="<?= $add_button ?>" class="btn btn-danger " >Tambah</a>
            <?php endif;?>
            </td>
          </tr>
        </tfoot>
        </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
<script type="text/javascript">
function play_video(id){
  $('#large_modal').modal();
  var url = 'home.php?page=play_video&id='+id;
    $('#large_modal_content').load(url,function(result){id
  });
}
</script>
