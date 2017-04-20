<script type="text/javascript">
		  function grand_total()
			{

				var harga = parseFloat(document.getElementById("i_price").value);
				var qty = parseFloat(document.getElementById("i_qty").value);



				var	total = harga * qty;

        document.getElementById("i_total").value = total;
      $('#i_total_currency').val(toRp(total));

			}

		   </script>
<!-- MEMBER -->
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
    <div class="row">
        <div class="col-md-12">
          <div class="title_page"> <?= $title ?></div>
             <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form">
                  <div class="box box-cokelat">
                    <div class="box-body">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Tanggal</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" required class="form-control pull-right" id="date_picker1" name="i_date" value="<?= $row->purchase_date ?>"/>
                          </div><!-- /.input group -->
                        </div>
                        <div style="margin-left: -15px;" class="form-group">
                          <div class="row">
                            <div class="col-md-8">
                            <label>Nama Barang</label>
                            <select id="i_item_id" name="i_item_id" size="1" class="selectpicker show-tick form-control" data-live-search="true" onchange="get_satuan()">
                            <option value="0"></option>
                           <?php
                           while($r_item = mysql_fetch_array($query_item)){
                            $item_id ='';
                            if($_SESSION['item_id']){$item_id=$_SESSION['item_id'];}?>
                             <option value="<?= $r_item['item_id'] ?>" <?php if($item_id == $r_item['item_id']){ ?> selected="selected"<? } ?>><?= $r_item['item_name']?></option>
                             <?}?>
                           </select>
                            </div>
                            <div class="col-md-4">
                              <button style="margin-top: 23px;" data-toggle="modal" data-target="#modal_item" class="btn btn-info">
                              <span class="glyphicon glyphicon-plus"></span>Tambah Stock
                            </button>
                            </div>
                          </div>
                        </div>
                      <div class="form-group">
                        <label>Satuan Konversi</label>
                          <select id="i_satuan" name="i_satuan" class="selectpicker show-tick form-control" data-live-search="true">
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Harga</label>
                          <input required type="textarea" name="i_price_currency" id="i_price_currency" class="form-control" placeholder="Masukkan harga..." onkeyup="number_currency_(this);"
                          value="<?= $row->purchase_price ?>" min="0"/>
                          <input required type="hidden" name="i_price" id="i_price" class="form-control" placeholder="Masukkan harga..." value="<?= $row->purchase_price ?>" min="0"/>
                      </div>
                      <div class="form-group">
                          <label>QTY</label>
                          <input required type="number" name="i_qty" id="i_qty" class="form-control" placeholder="Masukkan jumlah..." value="<?= $row->purchase_qty ?>" onChange="grand_total()" min="0"/>
                      </div>
                      <div class="form-group">
                          <label>Total</label>
                          <input required type="textarea" name="i_total_currency" id="i_total_currency" class="form-control" readonly onkeyup="number_currency_(this);"
                          value="<?= $row->purchase_total ?>" min="0"/>
                          <input required type="hidden" name="i_total" id="i_total" class="form-control" placeholder="Masukkan harga..." value="<?= $row->purchase_total ?>" min="0"/>
                      </div>
                      <div class="form-group">
                        <label>Supplier</label>
                         <select id="basic" name="i_supplier" size="1" class="selectpicker show-tick form-control" data-live-search="true">
                         <?php
                         while($r_supplier = mysql_fetch_array($query_supplier)){?>
                           <option value="<?= $r_supplier['supplier_id'] ?>" <?php if($row->supplier_id == $r_supplier['supplier_id']){ ?> selected="selected"<?php } ?>><?= $r_supplier['supplier_name']?></option>
                           <?}?>
                         </select>
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
                    </div>
                  <div style="clear:both;"></div>
                </div><!-- /.box-body -->
              <div class="box-footer">
              <?php
              if(!$id){?>
                <input style="margin-left:5px;" class="btn btn-primary" type="submit" value="Simpan"/>
              <?}?>
                <!-- <a href="<?= $close_button?>" class="btn btn-danger" >Close</a> -->
              </div>
            </div><!-- /.box -->
          </form>
        </div><!--/.col (right) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->

<!-- modal input stock -->
<div id="modal_item" class="modal fade" name="medium_modal">
  <form action="purchase.php?page=save_add_item" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="color: #fff;" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Stock</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label>Nama Stock Item</label>
              <input name="i_stock" type="text" class="form-control" placeholder="Masukkan Item Baru ..">
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
              <label>Item Limit</label>
              <input name="i_limit" type="text" class="form-control" placeholder="Masukkan Item limit ..">
            </div>
            <div class="form-group">
              <label>Harga Pokok Produksi</label>
              <input required type="textarea" name="i_hpp_price" id="i_hpp_price_currency" class="form-control" placeholder="Masukan Harga pokok.." onkeyup="number_currency_(this);" value="<?= $row->item_hpp_price ?>" min="0"/>
              <input type="hidden" name="i_hpp_price" id="i_hpp_price" class="form-control" value="<?= $row->item_hpp_price ?>" min="0"/>
            </div>
            <div class="form-group">
              <div style="width:250px;width: 250px;left: 0px;top: 30px;">
                  <label>Gambar</label>
                  <?php if($id){
                  $gambar = ($row->item_img) ? $row->item_img : "default.png"; ?>
                  <br />
                  <img src="<?= "../img/menu/".$gambar ?>" id="output_1" style="width:200px;"/>
                  <?php } ?>
                  <img id="output" style="width:200px; padding: 10px">
                <input type="file" name="i_img" id="i_img" accept="image/*"  onchange="loadFile(event)"/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
        </div>
      </div>
    </div>
  </form>
</div>

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

    function get_satuan()
    {

      var item_id = $('#i_item_id').val();
      var url = "purchase.php?page=get_satuan";

			$('#i_satuan').empty();
      $.ajax({
              type      : 'POST',
              url       : "purchase.php?page=get_satuan",
              data      : {item_id:item_id},
              dataType  : "json",
              success   : function(data){
                $('#i_satuan').append('<option value="0"></option>');
                for (var i = 0; i < data.length; i++) {
                   $('#i_satuan').append('<option value="'+data[i].satuan_id+'">'+data[i].satuan_name+'</option>');
									 console.log(data[i].satuan_id);
                }

                $('#i_satuan').selectpicker('refresh');

              },error : function(){
                $('#i_satuan').empty();
                $('#i_satuan').selectpicker('refresh');
              }

            });

    }

</script>
