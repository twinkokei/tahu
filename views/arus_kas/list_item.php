
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
        <div class="box-header" style="cursor: move;">
          <h3 class="box-title"><strong>Journal</strong></h3>
        </div>
        <table id="example_arus_kas" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="width:2%;">No</th>
              <th style="max-width: 10px;">Tanggal</th>
              <th style="max-width: 10px; width:5%;">Tipe Jurnal</th>
              <th style="max-width: 10px;">Id Transaksi</th>
              <th style="max-width: 100px;">Debit</th>
              <th style="max-width: 100px;">Kredit</th>
              <th style="max-width: 100px;">Piutang</th>
              <th style="max-width: 100px;">Hutang</th>
              <th style="max-width: 10px;">Bank Kita</th>
              <th style="max-width: 10px;">No. Rek</th>
              <th style="max-width: 10px;">Bank Client</th>
              <th style="max-width: 150px;">No. Rek</th>
              <th style="max-width: 100px;">Cabang</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $no_item = 1;
            $total_debit = 0;
            $total_credit = 0;
            $total_piutang = 0;
            $total_hutang = 0;
          while($row_item = mysql_fetch_array($query_item)){ ?>
            <tr>
              <td><?= $no_item ?></td>
              <td><?= format_date($row_item['journal_date']); ?></td>
              <td><?= $row_item['journal_type_name'] ?></td>
              <td><?= $row_item['code'] ?></td>
              <td><?= tool_format_number($row_item['journal_debit'])?></td>
              <td><?= tool_format_number($row_item['journal_credit'])?></td>
              <td><?= tool_format_number($row_item['journal_piutang'])?></td>
              <td><?= tool_format_number($row_item['journal_hutang'])?></td>
              <td><?= $row_item['bank_name']?></td>
              <td><?= $row_item['bank_account_number']?></td>
              <td><?= $row_item['bank_id_to']?></td>
              <td><?= $row_item['bank_account_to']?></td>
              <?php
              $q_branch=mysql_query("SELECT branch_name from branches WHERE branch_id =".$row_item['branch_id']);
              $r_branch = mysql_fetch_array($q_branch);
              ?>
              <td><?= $r_branch['branch_name']?></td>
            </tr>
          <?php
            $total_debit = $total_debit + $row_item['journal_debit'];
            $total_credit = $total_credit + $row_item['journal_credit'];
            $total_piutang = $total_piutang + $row_item['journal_piutang'];
            $total_hutang = $total_hutang + $row_item['journal_hutang'];
            $no_item++; } ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="9" align="right" style="font-size:22px; font-weight:bold;">TOTAL</td>
              <td><?= tool_format_number_report($total_debit)?></td>
              <td><?= tool_format_number_report($total_credit)?></td>
              <td><?= tool_format_number_report($total_piutang)?></td>
              <td><?= tool_format_number_report($total_hutang)?></td>
            </tr>
          </tfoot>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#example_arus_kas').DataTable( {
        "scrollX": "100%",
        dom: 'Bfrtip',
        buttons: [

            {
                extend: 'pageLength'
            },
            {
                extend: 'copy'
            },
            {
                text: 'excel',
                action: function () {
                   window.location.assign('print.php?page=excel_aruskas&date=<?= $i_date?>');                
                   // alert(<?= $i_date?>);
                 }

            },
            {
                extend: 'pdf'
            }
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ]

    } );
} );


</script>