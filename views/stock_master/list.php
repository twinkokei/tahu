
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
      <div class="title_page"> <?= $title ?></div>
      <div class="box">
        <div class="box-body2 table-responsive">
        <table id="example_stok" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th style="text-align:center;">Nama Item</th>
              <th style="text-align:center;">Kategori Item</th>
              <th style="text-align:center;">Limit Item</th>
              <?php
                  $no=1;
                  $q_branch = select_config('branches', '');
                  while ($r_branch = mysql_fetch_array($q_branch)) {?>
                    <th style="text-align:center;"><?= $r_branch['branch_name']?></th>
                  <?}?>
              <th style="text-align:center;">Harga Pokok Produksi</th>
              <th style="text-align:center;">Harga Jual</th>
              <th style="text-align:center;">Config</th>
            </tr>
          </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysql_fetch_array($q_all_stock)) { ?>
            <tr>
               <td style="text-align:center;"><?= $no?></td>
               <td><?= $row['item_name']?></td>
               <td><?= $row['item_kategori']?></td>
               <td><?= $row['item_limit']?></td>
               <?php
                $q_branch_ = select_config('branches', '');
                while ($r_branch = mysql_fetch_array($q_branch_)) {?>
               <td
                 <?php
                  $i_id=$row['item_id'];
                  if( get_stock($i_id,$cabang) <= $row['item_limit']){ ?>
                    bgcolor="#d82827" style="color:#fff;"<?php  } ?>>
                  <?= get_stock($row['item_id'],$cabang)?>
                  </td>         
                 <?}?>
                <td><?= format_rupiah($row['item_hpp_price'])?></td>
                <td><?= format_rupiah($row['item_price'])?></td>
                <td style="text-align:center;">
                  <a href="stock_master.php?page=form&id=<?= $row['item_id']?>" class="btn btn-default" >
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['item_id']; ?>,'stock_master.php?page=delete&id=')"
                    class="btn btn-default" ><i class="fa fa-trash-o"></i>
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
    $('#example_stok').DataTable( {
        "scrollX": true
    } );
} );

</script>