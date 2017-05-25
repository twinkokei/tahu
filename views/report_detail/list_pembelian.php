<style type="text/css">
  a:hover{
    color:green;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
        <div class="box-header">
          <h3 class="box-title"><strong>List Pembelian</strong></h3>
        </div>
        <table id="list_pembelian" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Tanggal</th>
              <th>Purchase code</th>
              <th>User</th>
              <th>Total</th>
              <th>Supplier</th>
              <th>Cabang</th>
            </tr>
          </thead>
        <tbody>
        <?php
          $no = 1;
          while($row = mysql_fetch_array($query_purchase)){ ?>
            <tr>
              <td><?= $no?></td>
              <td><?= format_date_only($row['purchase_date'])?></td>
              <td><a  data-toggle="tooltip" data-placement="right" title="Lihat Detail!" onclick="detail_purchase(<?= $row['purchase_code']?>,<?= $row['branch_id']?>)" ><?= $row['purchase_code']?></a></td>
              <td><?= $row['user_name']?></td>
              <td style="text-align: right;"><?= format_rupiah($row['purchase_total'])?></td>
              <td><?= $row['supplier_name']?></td>
              <td><?= $row['branch_name']?></td>
            </tr>
        <? $no++; } ?>
        </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<div id="modal_pembelian" class="modal fade bs-example-modal-sm" tabindex="-1"
 role="dialog" aria-labelledby="mySmallModalLabel" style="z-index:888888;">
  <div class="modal-dialog modal-sm" role="document"  style="width:1100px;">
    <div class="modal-content" style="border-radius:0;">

    </div>
  </div>
</div>
<script>

  function detail_purchase(x,y) {
    $('#modal_pembelian').modal();
  $(function(){
    var url = "report_detail.php?page=popmodal_pembelian&purchases_code="+x+"&branch_id="+y;
      $('.modal-content').load(url,function(result){
    });
  })
}


  $(document).ready(function() {
    $('#list_pembelian').DataTable( {
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
                   window.location.assign('print.php?page=excel_pembelian&date=<?= $i_date?>');                
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