
<div class="modal-header" style="border-radius:0px">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Detail Penjualan</h4>
</div>
<div class="modal-header">
  <label> Kode Penjualan : <?= $transaction_code?></label>
</div>
<div class="modal-body">
  <table style="line-height:25px;">
    <tr>
      <td>Nama Member</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</td>
      <td><?= $member_name?></td>
    </tr>
  </table>
  <table id="example3" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th>Nama Menu</th>
        <th>Jumlah</th>
        <th>Harga Penjualan/qty</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no=1;
       while ($row = mysql_fetch_array($q_detail_penjualan)) { ?>
        <tr>
          <td><?= $no;?></td>
          <td><?= $row['menu_name']?></td>
          <td><?= $row['qty']?></td>
          <td><?= format_rupiah($row['price'])?></td>
          <td><?= format_rupiah($row['grand_total'])?></td>
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
  <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
</div>
