
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
<section class="content">
  <div class="row">
    <div class="col-xs-12">
     <div class="box">
      <div class="box-body2 table-responsive">
      <div class="title_page"> <?= $title ?></div>
        <table id="example_stok" class="table table-bordered table-striped" style="width:100%;">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th style="text-align:center;max-width: 100px;">Nama Tahu</th>
              <?php
                  $no=1;
                  $q_branch = select_config('branches', '');
                  while ($r_branch = mysql_fetch_array($q_branch)) {?>
                    <th style="text-align:center;max-width: 100px;"><?= $r_branch['branch_name']?></th>
                  <?}?>
              <th style="text-align:center;max-width: 100px;">Config</th>
            </tr>
          </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysql_fetch_array($q_menu)) { ?>
            <tr>
               <td style="text-align:center;"><?= $no?></td>
               <td><?= $row['menu_name']?></td>               <?php
                $q_branch_ = select_config('branches', '');
                while ($r_branch = mysql_fetch_array($q_branch_)) {?>
               <td style="text-align: right"
                 <?php
                  $i_id=$row['menu_id'];
                  if( get_stock($i_id,$r_branch['branch_id'])){ ?>
                    x<?php  } ?>>
                  <?= get_stock($row['menu_id'],$r_branch['branch_id'])?>
                  </td>         
                 <?}?>
                
                 <td style="text-align:center;">
                  <button type="button" class="btn btn-default"
                  onclick="detail_recipes(<?= $row['menu_id']?>,<?= $row['branch_id']?>)">
                    <i class="fa fa-search"></i>
                  </button>
                </td>  
            </tr>
            <?php $no++; } ?>
      </tbody><!-- 
        <tfoot>
          <tr>
            <td colspan="6">
              <?php if (strpos($permit, 'c') !== false): ?>
              <a href="<?= $add_button ?>" class="btn btn-danger " >Tambah</a>
            <?php endif;?>
            </td>
          </tr>
        </tfoot> -->
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

$(document).ready(function() {
    $('#example_stok').DataTable( {
        "scrollX": "100%"
    } );
} );

</script>