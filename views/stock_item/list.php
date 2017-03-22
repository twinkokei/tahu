<!-- STOCK  -->
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
        <div class="box">
          <div class="box-body2 table-responsive">
            <div class="title_page"><?php if ($_SESSION['branch_id']!=3){?>
              <?= $title?>
              <?= $branch_active?>
            <? }else { ?>
              <?= $branch_active?> ( PUSAT )
            <? } ?></div>
            <table id="example_stok_cabang" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align:center;" width="5%">No</th>
                  <th style="text-align:center;">Item Name</th>
                  <th style="text-align:center;">Harga Item</th>
                  <th style="text-align:center;">Jumlah</th>
                  <?php
                  $no=1;
                  $q_branch = select_config('branches', '');
                  while ($r_branch = mysql_fetch_array($q_branch)) {?>
                    <th style="text-align:center;"><?= $r_branch['branch_name']?></th>
                  <?}?>
                  <th style="text-align:center;">Config</th>
                </tr>
              </thead>
            <tbody>
            <?php
            $no = 1;
            while($row = mysql_fetch_array($query)){ ?>
              <tr>
                <td><?= $no?></td>
                <td><?= $row['item_name']?></td>
                <td><?= format_rupiah($row['item_price'])?></td>
                <td><?= format_rupiah($row['item_stock_qty'])?></td>
                <?php
                $q_branch_ = select_config('branches', '');
                while ($r_branch = mysql_fetch_array($q_branch_)) {?>
                    <th style="text-align:center;">
                      10000
                    </th>
                  <?}?>
                <td style="text-align:center;">
                  <a href="javascript:void(0)"
                  class="btn btn-default" onclick="popmodal_pembelian_item(<?= $row['item_id']?>,<?= $row['branch_id']?>)">
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                  <a href="javascript:void(0)" onclick="popmodal_penjualan_item(<?= $row['item_id']?>,<?= $row['branch_id']?>)"
                    class="btn btn-default" >
                    <i class="fa fa-money"></i>
                  </a>
                  <a href="stock_master.php?page=form_keterangan&id=<?= $row['item_id']?>&branch_id=<?= $row['branch_id']?>"
                    class="btn btn-default">
                    <i class="fa fa-search"></i>
                  </a>
                </td>
              </tr>
            <?php $no++; } ?>
            </tbody>
        <tfoot>
          <tr>
            <td colspan="8">
              <?php if (strpos($permit, 'c') !== false): ?>
              <a href="<?= $add_button ?>" class="btn btn-danger " >Tambah</a>
            <?php endif;?>
            </td>
          </tr>
        </tfoot>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
<script type="text/javascript">
$(document).ready(function() {
    $('#example_stok_cabang').DataTable( {
        "scrollX": true
    } );
} );

  function popmodal_pembelian_item(x,y){
    $('#large_modal').modal();
    $(function(){
      var url = "stock_master.php?page=popmodal_pembelian_item&item_id="+x+"&branch_id=y";
        $('#large_modal_content').load(url,function(result){
      });
    })
  }

  function popmodal_penjualan_item(x,y){
    $('#large_modal').modal();
    $(function(){
      var url = "stock_master.php?page=popmodal_penjualan_item&item_id="+x+"&branch_id=y";
        $('#large_modal_content').load(url,function(result){
      });
    })
  }

</script>
