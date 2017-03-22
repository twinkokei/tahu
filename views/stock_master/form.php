<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
  <div class="row">
  <!-- right column -->
    <div class="col-md-12">
    <!-- general form elements disabled -->
      <div class="title_page"> <?= $title ?></div>
      <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" novalidate>
        <div class="box box-cokelat">
          <div class="box-body">
            <div class="col-md-12">
              <div class="form-group">
                  <label>Nama Item</label>
                  <input type="hidden" name="i_name" id="i_name" value="<?= $id?>">
                  <input required type="text" name="i_name" class="form-control"
                  placeholder="Masukkan nama item ..." value="<?= $row->item_name ?>"/>
                </div>
              <div class="form-group" id="barang_stok">
                  <label>Kategori Item</label>
                    <select name="i_kategori" id="i_kategori" class="selectpicker show-tick form-control"
                    data-live-search="true"
                    value="0">
                      <option value="0"></option>
                      <?php while($row_kategori = mysql_fetch_array($q_kategori)){ ?>
                      <option value="<?= $row_kategori['kategori_id'] ?>"
                      <?php if($row->item_kategori == $row_kategori['kategori_id']){ ?> selected="selected"<?php } ?>>
                      <?= $row_kategori['kategori_name'] ?> 
                      </option>
                    <?php } ?>
                    </select>
                </div>
              <div class="form-group">
                <label>Limit Item</label>
                <input required type="text" name="i_limit" id="i_limit" class="form-control"
                  placeholder="Masukkan limit stok ..." value="<?= $row->item_limit ?>"/>
              </div>
              <div class="form-group">
                <label>Harga Pokok Produksi</label>
                <input required type="textarea" name="i_hpp_price_currency" id="i_hpp_price_currency" class="form-control" placeholder="Masukkan harga original ..."
                value="<?= $row->item_hpp_price ?>" onkeyup="number_currency_(this);"/>

                <input required type="hidden" name="i_hpp_price" id="i_hpp_price" class="form-control" placeholder="Masukkan harga original ..."
                value="<?= $row->item_hpp_price ?>"/>
              </div>
              <div class="form-group">
                <label>Harga Jual</label>
                <input required type="textarea" name="i_price_currency" id="i_price_currency" class="form-control" 
                placeholder="Masukkan harga ..." value="<?= $row->item_price ?>" onkeyup="number_currency_(this);"/>

                <input required type="hidden" name="i_price" id="i_price" class="form-control" placeholder="Masukkan harga ..."
                value="<?= $row->item_price ?>"/>
              </div>
          <div style="clear:both;"></div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <?php if (strpos($permit, 'c') !== false || strpos($permit, 'u') !== false): ?>
              <input class="btn btn-primary" type="submit" value="Simpan"/>
            <?php endif; ?>
          <a href="<?= $close_button?>" class="btn btn-danger" >Keluar</a>
          </div>
        </div>
        </div><!-- /.box -->
      </form>
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
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