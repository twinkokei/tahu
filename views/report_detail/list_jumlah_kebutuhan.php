<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
        <div class="box-header">
          <h3 class="box-title"><strong>List Jumlah Kebutuhan Produksi</strong></h3>
        </div>
        <table id="list_kebutuhan_produksi" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Item Name</th>
              <th>Satuan Utama</th>
              <th>Qty</th>
              <th>Cabang</th>

            </tr>
          </thead>
        <tbody>
        <?php
          $no = 1;
          while($row = mysql_fetch_array($q_jumlah_kebutuhan)){ ?>
            <tr>
              <td><?= $no?></td>
              <td><?= $row['item_name']?></td>
              <td><?= $row['satuan_name']?></td>
              <td style="text-align: right;"><?= $row['result']?></td>
              <td><?= $row['branch_name']?></td>
            </tr>
        <? $no++; } ?>
        </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>


<!-- <div id="modal_produksi" class="modal fade bs-example-modal-sm" tabindex="-1"
 role="dialog" aria-labelledby="mySmallModalLabel" style="z-index:888888;">
  <div class="modal-dialog modal-sm" role="document"  style="width:1100px;">
    <div class="modal-content" style="border-radius:0;">

    </div>
  </div>
</div> -->
<script>

//   function detail_produksi(x,y) {
//     $('#modal_produksi').modal();
//   $(function(){
//     var url = "report_detail.php?page=popmodal_produksi&produksi_code="+x+"&branch_id="+y;
//       $('.modal-content').load(url,function(result){
//     });
//   })
// }


  $(document).ready(function() {
    $('#list_kebutuhan_produksi').DataTable( {
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