<div class="modal-header">
<?php 
  $row = mysql_fetch_array($q_menu) ?>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <tr>
    <td>
      <h4 class="modal-title"><?= $row['menu_name']?></h4>
    </td>
    <td class="modal-title">Jumlah : <?= $row['menu_stock_qty']?>
    </td>
  </tr>
</div>
<div class="modal-body">
  <table id="example3" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th>Nama item</th>
        <th>Qty item/1 qty menu</th>
        <th>Total Kebutuhan</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no=1;
       while ($row = mysql_fetch_array($query)) { ?>
        <tr>
          <td><?= $no;?></td>
          <td><?= $row['item_name']?></td>
          <td><?= $row['item_qty']?></td>
          <td><?= $row['total_kebutuhan']?></td>
        </tr>
      <?$no++;}?>
    </tbody>
  </table>
</div>
<div class="modal-footer">
  <!-- <a href="print.php?page=print_purchase&id=<?= $purchase_id?>">
    <button type="button" class="btn btn-success">
      <i class="fa fa-print"></i>
      Print
    </button>
  </a>
  <?php if ($permit == 1): ?>
    <button type="button" class="btn btn-danger"
    onclick="confirm_delete_3(<?= $purchases_code ?>,<?= $branch_id?>,'report_detail.php?page=delete_purchase&purchases_code=','&branch_id=')"
    data-dismiss="modal">
      Hapus
    </button>
  <?php endif; ?> -->
  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
</div>
