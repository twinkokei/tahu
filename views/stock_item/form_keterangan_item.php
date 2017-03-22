<style media="screen">
  .btn-bullet{
    border-radius:18px;
  }
  .field-on-tb{
    width: 100%;
    height: 35px;
    padding-left: 5px;
    padding-right: 5px;
    background-color: transparent;
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form class="" action="<?= $action?>" method="post">
        <div class="box">
          <div class="box-body2 table-responsive">
            <div class="title_page">Keterangan Tiap Unit</div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align:center;width:5%;">No.</th>
                <?php
                $col = 1;
                $colcol = 0;
                while ($r_kategori_keterangan = mysql_fetch_array($q_kategori_keterangan)) {?>
                  <th style="text-align:center;"><?= $r_kategori_keterangan['kategori_keterangan_name']?></th>
                <?
                $col++;
                $colcol++;
               } ?>
                  <th style="text-align:center;">Id Pembelian</th>
                  <th style="text-align:center;">Tanggal Beli</th>
                  <th style="text-align:center;">Supplier</th>
                  <th style="text-align:center;">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1;
                $j = 1;
                $jj = 0;
                for ($i=1; $i <= $jml_stock_pernah_ada; $i++) { ?>
                  <tr>
                    <td style="text-align:center;">
                      <?= $no?>
                      <input type="hidden" name="baris_<?= $i?>" value="<?= $i?>">
                    </td>
                    <?php
                    $row = $r_kategori_keterangan.$no;
                    $query = $q_kategori_keterangan.$no;
                    $query = select_config('kategori_keterangan', $where_kategori_id);
                    while ($row = mysql_fetch_array($query)) {?>
                      <td style="text-align:center;">
                          <?= $item_details[$j]?>
                          <?php
                          $where_purchase_id = "WHERE purchases_id = '".$purchase_id[$j]."'";
                          $where_supplier_id = "WHERE supplier_id = '".$supplier_id[$j]."'";
                          $purchase_date = select_config_by('purchases', 'purchases_date',$where_purchase_id);
                          $purchase_code = select_config_by('purchases', 'purchases_code',$where_purchase_id);
                          $supplier_name = select_config_by('suppliers', 'supplier_name',$where_supplier_id);
                           ?>
                      </td>
                         <?
                         $j++;
                         $jj++;
                       } ?>
                         <td style="text-align:center;"><?= $purchase_code?></td>
                         <td style="text-align:center;"><?= format_date_only($purchase_date)?></td>
                         <td style="text-align:center;"><?= $supplier_name?></td>
                         <td style="text-align:center;">
                          <?php
                          $jjj = $j-$jml_kategori;
                          if($status[$jjj]==1){
                            echo "Terjual";
                          } elseif ($status[$jjj]==2) {
                            echo "Retur Penjualan";
                          } elseif ($status[$jjj]==3) {
                            echo "Retur Pembelian";
                          }
                          ?>
                         </td>
                  </tr>
                 <? $no++;} ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" >Simpan</button>
            <a href="<?= $close_button?>" class="btn btn-danger" >Keluar</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script type="text/javascript">
  function tambah_keterangan(id){
    $('#medium_modal').modal();
    $(function(){
      var url = "stock_master.php?page=kategori_keterangan_details&id="+id;
        $('#medium_modal_content').load(url,function(result){
      });
    })
  }
  function checked_simpan(id) {
    var button_submit = $('#button_submit_'+id);
    var check_box = $('#checkbox_'+id);
    if (!check_box.is(":checked")) {
      check_box.prop('checked',true);
      button_submit.removeClass('btn-default');
      button_submit.addClass('btn-primary');
    } else {
      check_box.prop('checked',false);
      button_submit.removeClass('btn-primary');
      button_submit.addClass('btn-default');
    }
  }
</script>
