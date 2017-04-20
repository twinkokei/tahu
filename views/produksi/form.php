<style>
img {

    -webkit-transition: width 2s; 
    transition: width 2s;
}
img:hover{
 
  width: 250px;
}
</style>
<?php if(isset($_GET['did']) && $_GET['did'] == 1){ ?>
<section class="content_new">
  <div class="alert alert-info alert-dismissable">
    <i class="fa fa-check"></i>
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    <b>Sukses !</b>
    Transaksi telah tersimpan
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
<!-- Content Header (Page header) -->
        

                <!-- Main content -->
<section class="content">
  <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" novalidate>
    <div class="row">
      <div class="col-md-12">
        <div class="title_page"> <?= $title ?></div>
          
            <div class="box box-cokelat">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Tanggal</label>
                    <div class="input-group">   
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="hidden" name="produksi_id" id="produksi_id" value="<?= $produksi_id?>">
                      <input type="datepicker" required  name="tanggal" 
                      class="form-control pull-right calendar" id="date_picker1" value="<?= $tanggal?>"/>
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group">
                          <label>Cabang</label>
                          <select id="basic" name="i_branch_id" size="1" class="selectpicker show-tick form-control" data-live-search="true">
                          <?php
                          while($r_branch = mysql_fetch_array($query_branch)){?>
                            <option value="<?= $r_branch['branch_id'] ?>"><?= $r_branch['branch_name']?> 
                            </option>
                          <?}?>
                          </select>                                            
                        </div>    
                  <div class="form-group">
                    <label>Menu</label>
                    <select id="i_menu_id"  name="i_menu_id" size="1" class="selectpicker show-tick form-control" 
                    data-live-search="true" onchange="menu_detail()">
                    <option value="0"></option>
                    <?php
                    while($r_menu = mysql_fetch_array($query_menu)){?>
                    <option value="<?= $r_menu['menu_id'] ?>"><?= $r_menu['menu_name']?> </option>
                    <?}?>
                    </select>                                            
                  </div>
                </div>
                    <div style="clear:both;"></div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          
      </div><!--/.col (produksi) -->
    </div>
  <div class="row">
      <div class="col-md-12"><div class="title_page">Menu</div>
        <div class="box">
          <div class="box-body" id="menu_detail_form">
              <label> </label>
              <div class="form-group">
              </div>
          </div>
        </div>
      </div> 
  </div>   <!-- /.row -->
</form>  
</section><!-- /.content -->
<script type="text/javascript">
  function menu_detail(){
    var i_tanggal = $('#date_picker1').val();
    var i_menu_id = $('#i_menu_id').val();
    var i_branch_id = $('#i_branch_id').val();
    var i_member_id = $('#i_member_id').val();
    var produksi_id = $('#produksi_id').val();
    $.ajax({
      type  : 'POST',
      url   : "produksi.php?page=get_menu_details", 
      data  : {i_menu_id:i_menu_id},
      dataType  : "json",
      success   : function(data){
        $('#menu_detail_form').empty();
        $('#menu_detail_form').append('<center><label>'+data.menu_name+'</label><br>\
        <img src="../img/menu/'+data.menu_img+'" width="200px" height="200px"></center>\
          <div class="form-group" style="padding-left:15px;padding-right:15px;">\
            <label>Satuan</label>\
            <select id="satuan_id"  name="satuan_id" size="1" class="selectpicker show-tick form-control" \
            data-live-search="true">\
            <?php
            while($r_satuan = mysql_fetch_array($query_satuan)){?>\
            <option value="<?= $r_satuan['satuan_id'] ?>"><?= $r_satuan['satuan_name']?>\
            </option>\
            <?}?>\
            </select>\
          </div>\
          <div class="form-group" style="padding-left:15px;padding-right:15px;">\
            <label>QTY</label>\
            <input required type="number" name="i_qty" id="i_qty" class="form-control" placeholder="Masukkan jumlah..." min="0"/>\
          </div>\
          <button type="submit" class="btn btn-primary" style="margin-left:15px;">Simpan</button>\
          ');

      }
    })
  }

function number_currency_(elem){
  var elem_id = '#'+elem.id;
  var elem_val   = $(elem_id).val();
  var elem_no_cur = elem_id.replace(/_currency/g,'');

  var str = elem_val.toString(), parts = false, output = [], i = 1, formatted = null;

  parts = str.split(".");
  var gabung = '';
  for (var i = 0; i < parts.length; i++) {
   var gabung = gabung+parts[i];
  }

  str = gabung.split("").reverse();
  var i = 1;
  for(var j = 0, len = gabung.length; j < len; j++) {
   if(str[j] != ".") {
     output.push(str[j]);
     if(i%3 == 0 && j < (len - 1)) {
       output.push(".");
     }
     i++;
   }
  }

  formatted = output.reverse().join("");
  $(elem_id).val(formatted);
  $(elem_no_cur).val(gabung);
}

</script>