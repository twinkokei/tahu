<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
        <div class="box-header">
          <h3 class="box-title"><strong>List Penjualan</strong></h3>
        </div>
        <table id="list_penjualan" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Tanggal</th>
              <th>Transaction code</th>
              <th>Member</th>
              <th>Total</th>
              <th>Cabang</th>

            </tr>
          </thead>
        <tbody>
        <?php
          $no = 1;
          while($row = mysql_fetch_array($query_penjualan)){ ?>
            <tr>
              <td><?= $no?></td>
              <td><?= format_date_only($row['transaction_date'])?></td>
              <td><a data-toggle="tooltip" data-placement="right" title="Lihat Detail!" onclick="detail_transaction(<?= $row['transaction_code']?>,<?= $row['branch_id']?>)"><?= $row['transaction_code']?></a></td>
              <td><?= $row['member_name']?></td>
              <td style="text-align: right;"><?= format_rupiah($row['transaction_total'])?></td>
              <td><?= $row['branch_name']?></td>
            </tr>
        <? $no++; } ?>
        </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<div id="modal_penjualan" class="modal fade bs-example-modal-sm" tabindex="-1"
 role="dialog" aria-labelledby="mySmallModalLabel" style="z-index:888888;">
  <div class="modal-dialog modal-sm" role="document"  style="width:1100px;">
    <div class="modal-content" style="border-radius:0;">

    </div>
  </div>
</div>
<script>

  function detail_transaction(x,y) {
    $('#modal_penjualan').modal();
  $(function(){
    var url = "report_detail.php?page=popmodal_penjualan&transaction_code="+x+"&branch_id="+y;
      $('.modal-content').load(url,function(result){
    });
  })
}


  $(document).ready(function() {
    $('#list_penjualan').DataTable( {
        dom: 'Bfrtip',
        buttons: [

            {
                extend: 'pageLength'
            }
    ,
            {
                extend: 'copy'
            },
            {
                text: 'excel',
                action: function () {
                   window.location.assign('print.php?page=excel_penjualan&date=<?= $i_date?>');                
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