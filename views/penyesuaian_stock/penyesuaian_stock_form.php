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
<?php }?>
<!-- Main content -->
<section class="content">
  <div class="row">
  <!-- right column -->
  <div class="row">

  </div>
    <div class="col-md-12">
    <!-- general form elements disabled -->
      <div class="title_page"> <?= $title ?> <?= $row->branch_name?></div>
      <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" novalidate>
        <div class="box box-cokelat">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <input required type="hidden" name="i_branch_id" id="i_branch_id" class="form-control" value="<?= $row->branch_id?> "/>
                <div class="form-group">
                  <input type="hidden" id="i_item_id" name="i_item_id" value="<?= $id?>"/>
                  <!-- <input type="hidden" id="i_rak_id" name="i_rak_id" value="<?= $rak_id?>"/> -->
                  <label>Nama Item</label>
                  <input required type="text" name="i_name" id="i_name" class="form-control" placeholder="Masukkan nama ..." value="<?= $row->item_name ?> " disabled/>
                </div>
                <div class="form-group">
                  <label>Jumlah Stock Awal</label>
                  <input required type="" name="i_item_qty" id="i_item_qty" class="form-control" placeholder="Masukkan jumlah ..." value="<?= format_rupiah($row->item_stock_qty)?> " disabled/>
                  <input type="hidden" required name="item_qty_lama" id="item_qty_lama" class="form-control" placeholder="Masukkan jumlah ..." value="<?= $row->item_stock_qty?>"/>
                </div>
                <label>Jumlah Stock baru</label>
                <input type="textarea" id="item_qty_baru_currency" name="item_qty_baru_currency" class="form-control" onkeyup="number_currency_(this);selisih()"/>
                <input required type="hidden" name="item_qty_baru" id="item_qty_baru" class="form-control"/>
                <label>Selisih Stock</label>
                <input required type="text" name="edit_item_qty_currency" id="edit_item_qty_currency" class="form-control" onkeyup="number_currency_(this);jumlah()" />
                <input required type="hidden" name="edit_item_qty" id="edit_item_qty" class="form-control" />
              </div>
              </div>
            </div>
          <div style="clear:both;"></div>
          <div class="box-footer">
            <input class="btn btn-primary" type="submit" value="Simpan"/>
            <a href="<?= $close_button?>" class="btn btn-danger">Batal</a>
          </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </form>
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
  function selisih() { 
    var x = parseFloat($('#item_qty_lama').val())||0;
    var y = parseFloat($('#item_qty_baru').val())||0;
    total = y-x;
    $('#edit_item_qty').val(total);
    $('#edit_item_qty_currency').val(total);
   
  }

  function jumlah(){
    var x = parseFloat($('#edit_item_qty').val())||0;
    var y = parseFloat($('#item_qty_lama').val())||0;
    total = x+y;
    $('#item_qty_baru').val(total);
    $('#item_qty_baru_currency').val(total);
    
  }

function number_currency_(elem){
  var elem_id = '#'+elem.id;
  var elem_val   = $(elem_id).val();
  var elem_no_cur = elem_id.replace(/_currency/g,'');

  var str = elem_val.toString(), parts = false, output = [], i = 1, formatted = null;

  // str = str.split(".");

  parts = str.split(",");
  var gabung = '';
  for (var i = 0; i < parts.length; i++) {
   var gabung = gabung+parts[i];
  }

  str = gabung.split("").reverse();
  var i = 1;
  for(var j = 0, len = gabung.length; j < len; j++) {
   if(str[j] != ",") {
     output.push(str[j]);
     if(i%3 == 0 && j < (len - 1)) {
       output.push(",");
     }
     i++;
   }
  }

  console.log(str[1]);

  formatted = output.reverse().join("");

  $(elem_id).val(formatted)||0;
  $(elem_no_cur).val(gabung)||0;
}
</script>
