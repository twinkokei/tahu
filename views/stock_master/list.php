
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
     <div class="box">
      <div class="box-body2 table-responsive">
      <div class="title_page"> <?= $title ?></div>
        <table id="example_stok" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th style="text-align:center;max-width: 150px;">Nama Bahan</th>
              <th style="text-align:center;max-width: 150px;">Satuan Utama</th>
              <th style="text-align:center;max-width: 80px;">Limit Bahan</th>
              <?php
                  $no=1;
                  $q_branch = select_config('branches', '');
                  while ($r_branch = mysql_fetch_array($q_branch)) {?>
                    <th style="text-align:center;max-width: 200px;"><?= $r_branch['branch_name']?></th>
                  <?}?>
              <th style="text-align:center;max-width: 200px;">Harga Pokok Produksi</th>
              <th style="text-align:center;width: 100px;">Config</th>
            </tr>
          </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysql_fetch_array($q_all_stock)) { ?>
            <tr>
               <td style="text-align:center;"><?= $no?></td>
               <td><?= $row['item_name']?></td>
               <td><?= $row['satuan_name']?></td>
               <td style="text-align:center;"><?= $row['item_limit']?></td>
               <?php
                $q_branch_ = select_config('branches', '');
                while ($r_branch = mysql_fetch_array($q_branch_)) {?>
               <td style="text-align: right"
                 <?php
                  $i_id=$row['item_id'];
                  if( get_stock($i_id,$r_branch['branch_id']) <= $row['item_limit']){ ?>
                    bgcolor="#d82827" style="color:#fff;"<?php  } ?>>
                  <?= get_stock($row['item_id'],$r_branch['branch_id'])?>
                  </td>         
                 <?}?>
                <td style="text-align:right;"><?= format_rupiah($row['item_hpp_price'])?></td>
                
                <td style="text-align:center;">
                  <a href="stock_master.php?page=form&id=<?= $row['item_id']?>" class="btn btn-default" >
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['item_id']; ?>,'stock_master.php?page=delete&id=')"
                    class="btn btn-danger" ><i class="fa fa-trash-o"></i>
                  </a>
                </td>          
            </tr>
            <?php $no++; } ?>
      </tbody>
        <tfoot>
          <tr>
            <td colspan="5">
              <?php if (strpos($permit, 'c') !== false): ?>
              <a href="<?= $add_button ?>" class="btn btn-success " >Tambah</a>
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
        "scrollX": "100%"
    } );
} );

</script>