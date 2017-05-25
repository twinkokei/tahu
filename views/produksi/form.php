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
                          <select id="i_branch_id" name="i_branch_id" size="1" class="selectpicker show-tick form-control" data-live-search="true">
                          <?php
                          while($r_branch = mysql_fetch_array($query_branch)){?>
                            <option value="<?= $r_branch['branch_id'] ?>"><?= $r_branch['branch_name']?> 
                            </option>
                          <?}?>
                          </select>                                            
                        </div>    
                  <div class="form-group">
                    <label>Tahu</label>
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
      <div class="col-md-12">
        <div id="menu_detail_form">
          <!-- <div class="title_page">Pilih Tahu</div> -->
        </div>
      </div> 
  </div>   <!-- /.row -->
</form>  
</section><!-- /.content -->
<script type="text/javascript">

// var item_tersedia = [];
// var item_konversi = [];
var menu_konversi = [];
var satuan_utama  = '';
var satuan_pilih = $('#satuan_id').val();

var jumlah = [];
var jumlah_satuan_konversi = [];
var konversi_harga = [];
var menu_id = [];
var satuan_konversi = [];
var satuan_utama = [];
var jumlah_menu_asli = '';
var menustock = '';
// var menukonversi  = [];

  function menu_detail(){
    var i_tanggal = $('#date_picker1').val();
    var i_menu_id = $('#i_menu_id').val();
    var i_branch_id = $('#i_branch_id').val();
    var i_member_id = $('#i_member_id').val();
    var produksi_id = $('#produksi_id').val();
    
    $.ajax({
      cache : false,
      type  : 'POST',
      url   : "produksi.php?page=get_menu_details", 
      data  : {i_menu_id:i_menu_id, i_branch_id:i_branch_id},
      dataType  : "json",
      success   : function(data){
        $('#menu_detail_form').empty();
        $('#menu_detail_form').append('<div class="box"><div class="box-body"><center><label>'+data['menu_detail'].menu_name+'</label><br>\
        <img src="../img/menu/'+data['menu_detail'].menu_img+'" width="200px" height="200px"></center>\
          <div class="form-group" style="padding-left:15px;padding-right:15px;">\
            <label>Satuan</label>\
            <select id="satuan_id"  name="satuan_id" size="1" class="selectpicker show-tick form-control" \
            data-live-search="true"/>\
          </div>\
          <div class="form-group" style="padding-left:15px;padding-right:15px;">\
            <label>QTY</label>\
            <input required type="textarea" name="i_qty_currency" id="i_qty_currency" onKeyup="number_currency_(this); cek_item_tersedia(this);" class="form-control" placeholder="Masukkan jumlah..." min="0"/>\
            <input required type="hidden" name="i_qty" id="i_qty" class="form-control" min="0"/>\
          </div>\
          <button type="submit" class="btn btn-primary" style="margin-left:15px;">Simpan</button>\
          </div></div> '); 
        if (i_menu_id == 0) {$('#menu_detail_form').html('<div class="title_page">Pilih Tahu</div>');}
        get_satuan_item(i_menu_id);

        satuan_utama = data.satuan_utama;
        // console.log(data['menukonversi']);
        // console.log(data['menukonversi']);
         for (var i = 0; i < data['menukonversi'].length; i++) {
          var menukonversi = {
           'menu_id'                : data['menukonversi'][i].menu_id,
           'satuan_utama'           : data['menukonversi'][i].satuan_utama,
           'jumlah'                 : data['menukonversi'][i].jumlah,
           'satuan_konversi'        : data['menukonversi'][i].satuan_konversi,
           'jumlah_satuan_konversi' : data['menukonversi'][i].jumlah_satuan_konversi,
           'konversi_harga'         : data['menukonversi'][i].konversi_harga
          }
            menu_konversi.push(menukonversi);
            localStorage.setItem('menukonversi', JSON.stringify(menu_konversi));

         }
      }
          
    });

  }


  function cek_item_tersedia(elem)
  {   
      var jumlah_beli = $(elem).val();
     // storagemenuKonversi = JSON.parse(localStorage.getItem('menukonversi'));
      // console.log(menu_konversi);
      if (satuan_pilih!=satuan_utama) 
      {
        $.each(menukonversi, function(index, value){
           satuan_konversi = value.satuan_konversi;
           if (satuan_konversi==satuan_pilih) 
           {
            if (jumlah>jumlah_satuan_konversi) 
            {
              jumlah_menu_asli = jumlah_beli/jumlah_satuan_konversi;
            } 
            else 
            {
              jumlah_menu_asli = jumlah_beli*jumlah_satuan_konversi;
            }
           }  
      });  
      }
      
    // console.log(storagemenuKonversisi);
  }



  function get_satuan_item(i_menu_id){
    $.ajax({
      type : 'POST',
      url : "produksi.php?page=get_satuan_details",
      data : {i_menu_id:i_menu_id},
      dataType : "json",
      success : function(data){
        $('#satuan_id').empty();
        for (var i = 0; i<data.length; i++) {
         $('#satuan_id').append('<option value="'+  data[i].satuan_id+'">'+data[i].satuan_name+'</option');
        }

      }
    });
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