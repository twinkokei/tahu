<div class="modal-header">
<?php 
  $row = mysql_fetch_array($q_menu) ?>
  <label><?= $row['menu_name']?></label><br>
  <label>QTY : <?= $row['menu_stock_qty']?></label>
</div>
<div class="modal-body">
  <table id="example3" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th>Nama item</th>
        <th>Qty item</th>
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
  <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
</div>
