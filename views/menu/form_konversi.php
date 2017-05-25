<div class="row">
      <div class="col-xs-12">
        <div class="title_page">Konversi</div>      
        <div class="box"> 
          <div class="box-body2 table-responsive">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama Menu</th>
                  <th>Satuan Utama</th>
                  <th>QTY</th> 
                  <th>Konversi</th>
                  <th>QTY</th>
                  <th>Harga/Konversi</th>
                  <th style="text-align : center;">Config</th>
                </tr>
              </thead>
                <tbody>
                  <?php
                  $no = 1;
                    while($row = mysql_fetch_array($q_tabel_konversi)){?>
                  <tr>
                    <td><?= $no?></td>
                    <td><?= $row['menu_name']; ?></td>
                    <td><?= $row['satuan_name']?></td>
                    <td><?= $row['jumlah']?></td>
                    <td><?= $row['konversi']?></td>
                    <td>
                      <?= $row['jumlah_satuan_konversi']?>
                      <!-- <input type="" id="konversi_id" name="konversi_id" value="<?= $row['konversi_id']?>"/> -->
                    </td>
                    <td style="text-align: right;"><?= format_rupiah($row['konversi_harga'])?></td>
                    <td style="text-align: center;">
                          <a onclick="edit_konversi(<?= $row['konversi_id']?>)" class="btn btn-default" >
                        <i class="fa fa-pencil"></i>
                      </a>
                     <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['konversi_id']; ?>,'menu.php?page=delete_konversi&menu_id=<?= $id?>&id=')"
                        class="btn btn-danger" ><i class="fa fa-trash-o"></i>
                      </a>
                    </td>
                  </tr>
                  <?php
                  $no++;
                  }?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                          <button class="btn btn-success" onclick="add_konversi()">
                            Tambah
                          </button>
                          </a>
                        </td>
                    </tr>
                </tfoot>
           </table>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
<script type="text/javascript">
  function select_satuan(){
  var id = $('#menu_id').val()
    $('#medium_modal').modal();
  var url = 'menu.php?page=pop_modal_konversi&id='+id;
    $('#medium_modal_content').load(url,function(result){});
}
function edit_konversi(konversi_id){
  var id = $('#menu_id').val()
    $('#medium_modal').modal();
  var url = 'menu.php?page=pop_modal_konversi&id='+id+'&konversi_id='+konversi_id;
    $('#medium_modal_content').load(url,function(result){});
}

function add_konversi(){
  var id = $('#menu_id').val();
  // alert(id);
    $('#medium_modal').modal();
    var url = 'menu.php?page=pop_modal_konversi&id='+id;
    $('#medium_modal_content').load(url,function(result){});
}

</script>