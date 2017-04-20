<!-- Content Header (Page header) -->

                 <?php
                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
                <section class="content_new">

                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Simpan gagal !</b>
               Password dan confirm password tidak sama
                </div>

                </section>
                <?php
                }
                ?>

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <!-- right column -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->


                          <div class="title_page"> <?= $title ?></div>

                             <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form">

                            <div class="box box-cokelat">


                                <div class="box-body">


                                        <div class="col-md-9">

                                          <div class="form-group">
                                            <label>Nama Menu</label>
                                            <input type="hidden" id="menu_id" name="menu_id" value="<?= $id ?>">
                                            <input required type="text" name="i_name" class="form-control" placeholder="Masukkan nama menu ..." value="<?= $row->menu_name ?>"/>
                                          </div>
                                        <!-- menu kategori -->
                                          <div class="form-group">
                                            <label>Kategori Utama</label>
                                            <select id="kategori_utama" name="i_menu_kategori" size="1" class="selectpicker show-tick form-control" data-live-search="true">
                                              <?php
                                              while($r_type = mysql_fetch_array($query_menu_kategori)){ ?>
                                             <option <?php if($row->menu_kategori == $r_type['kategori_id']){ ?> selected="selected"<?php } ?> value="<?= $r_type['kategori_id'] ?>"><?= $r_type['kategori_name']?></option>
                                             <?php } ?>
                                           </select>
                                          </div>
										                    <div class="form-group">
                                            <label>HPP</label>
                                            <input type="textarea" name="i_original_price_currency" id="i_original_price_currency" 
                                            class="form-control" placeholder="Masukkan harga original ..."
                                            value="<?= $row->menu_original_price ?>" onkeyup="number_currency_(this);"/>

                                            <input type="hidden" name="i_original_price" id="i_original_price" class="form-control" 
                                            placeholder="Masukkan harga original ..." value="<?= $row->menu_original_price ?>"/>
                                        </div>
                                          <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="textarea" name="i_price_currency" id="i_price_currency" class="form-control" placeholder="Masukkan harga original ..." 
                                            value="<?= $row->menu_price ?>" onkeyup="number_currency_(this);"/>

                                            <input type="hidden" name="i_price" id="i_price" class="form-control" 
                                            placeholder="Masukkan harga ..." value="<?= $row->menu_price ?>"/>
                                        </div>
                                      </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                         <label>Images</label>
                                          <?php
                                          if($id){
  											                  $gambar = ($row->menu_img) ? $row->menu_img : "default.png";
  									                       	?>
                                          <br />
                                          <img src="<?= "../img/menu/".$gambar ?>" style="width:100%;"/>
                                          <?php
										                      }?>
                                           <input type="file" name="i_img" id="i_img" />
                                        </div>
                                      </div>
                                          <div style="clear:both;"></div>
                                </div><!-- /.box-body -->
                                  <div class="box-footer">
                                <input class="btn btn-primary" type="submit" value="Simpan"/>
                                <a href="<?= $close_button?>" class="btn btn-danger" >Keluar</a>
                                  </div>

                            </div><!-- /.box -->
                          </form>
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->

                    <?php
                    if($id){
					           ?>
                     <div class="row">
                        <div class="col-xs-12">

                             <div class="title_page"> Recipe</div>

                            <div class="box">

                                <div class="box-body2 table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th width="5%">No</th>
                                              <th style="text-align: center;">Nama Bahan</th>
                                              <th style="text-align: center;">Qty</th>
                                              <th style="text-align: center;">Config</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           $no = 1;
                                            while($row_recipe = mysql_fetch_array($query_recipe)){
                                            ?>
                                            <tr>
                                              <td><?= $no?></td>
                                              <td><?= $row_recipe['item_name']?></td>
                                              <td><?= format_rupiah($row_recipe['item_qty'])?></td>
                                              <td style="text-align:center;">
                                                  <a href="javascript:void(0)" class="btn btn-default" 
                                                  onclick="menu_recipe(<?= $row_recipe['menu_recipe_id']?>)">
                                                    <i class="fa fa-pencil"></i>
                                                  </a>
                                                  <a href="javascript:void(0)" onclick="confirm_delete(<?= $row_recipe['menu_recipe_id']; ?>,
                                                  'menu.php?page=delete_recipes&menu_id=<?= $row->menu_id ?>&id=')" class="btn btn-default" >
                                                    <i class="fa fa-trash-o"></i>
                                                  </a>
                                              </td>
                                            </tr>
                                            <?php
											                        $no++;
                                            }
                                            ?>
                                        </tbody>
                                          <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                  <a href="javascript:void(0)" class="btn btn-danger" 
                                                  onclick="menu_recipe('','')">Add Item
                                                  </a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <?php
					}
					?>
                </section><!-- /.content -->  


<script type="text/javascript">
  function menu_recipe(recipe_id){
    var menu_id = $('#menu_id').val();  
    $('#medium_modal').modal();
  var url = 'menu.php?page=tambah_menu_recipe&&recipe_id='+recipe_id+'&menu_id='+menu_id;
    $('#medium_modal_content').load(url,function(result){
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