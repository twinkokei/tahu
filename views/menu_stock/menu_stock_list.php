<?php if(isset($_GET['did']) && $_GET['did'] == 1){ ?>
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
  <div class="row">
    <div class="col-xs-12">
      <div class="title_page"> <?= $title?></div>
        <div class="box">
          <div class="box-body2 table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="5%">No</th> 
                  <th>Cabang</th>
                  <th>Nama Menu</th>
                  <th>Jumlah</th>
                  <th style="text-align:center;">Config</th>
                </tr>
              </thead>
            <tbody>
            <?php
            $no = 1;
            while($row = mysql_fetch_array($query)){ ?>
              <tr>
                <td><?= $no?></td>
                <td><?= $row['branch_name']?></td>
                <td><?= $row['menu_name']?></td>
                <td><?= $row['menu_stock_qty']?></td>
                <td style="text-align:center;">
                <button type="button" class="btn btn-default"
                onclick="detail_recipes(<?= $row['menu_id']?>,<?= $row['branch_id']?>)">
                  <i class="fa fa-search"></i>
                </button>
                </td>
              </tr>
            <?php $no++; } ?>
            </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
<div id="modal_recipe" class="modal fade bs-example-modal-lg" tabindex="-1"
 role="dialog" aria-labelledby="myLargeModalLabel" style="z-index:888888;">
  <div class="modal-dialog modal-lg" role="document"  style="width:1100px;">
    <div class="modal-content" style="border-radius:0;">

    </div>
  </div>
</div>
<script type="text/javascript">
    function detail_recipes(x,y) {
    $('#modal_recipe').modal();
  $(function(){
    var url = "menustock.php?page=popmodal&menu_id="+x+"&branch_id="+y;
      $('.modal-content').load(url,function(result){
    });
  })
}
</script>