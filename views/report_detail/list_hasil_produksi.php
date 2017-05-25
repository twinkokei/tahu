<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
        <div class="box-header">
          <h3 class="box-title"><strong>List Hasil Produksi</strong></h3>
        </div>
        <table id="list_hasil_produksi" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Tanggal Produksi</th>
              <th>Produksi code</th>
              <th>Menu</th>
              <th>Qty Menu</th>
              <th>Cabang</th>

            </tr>
          </thead>
        <tbody>
        <?php
          $no = 1;
          while($row = mysql_fetch_array($q_produksi)){ ?>
            <tr>
              <td><?= $no?></td>
              <td><?= format_date_only($row['produksi_date'])?></td>
              <td><a data-toggle="tooltip" data-placement="right" title="Lihat Detail!" onclick="detail_produksi(<?= $row['produksi_code']?>,<?= $row['branch_id']?>)"><?= $row['produksi_code']?></a></td>
              <td><?= $row['menu_name']?></td>
              <td style="text-align: right;"><?= $row['qty']?></td>
              <td><?= $row['branch_name']?></td>
            </tr>
        <? $no++; } ?>
        </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>


<div id="modal_produksi" class="modal fade bs-example-modal-sm" tabindex="-1"
 role="dialog" aria-labelledby="mySmallModalLabel" style="z-index:888888;">
  <div class="modal-dialog modal-sm" role="document"  style="width:1100px;">
    <div class="modal-content" style="border-radius:0;">

    </div>
  </div>
</div>
<script>

  function detail_produksi(x,y) {
    $('#modal_produksi').modal();
  $(function(){
    var url = "report_detail.php?page=popmodal_produksi&produksi_code="+x+"&branch_id="+y;
      $('.modal-content').load(url,function(result){
    });
  })
}


  $(document).ready(function() {
    $('#list_hasil_produksi').DataTable( {
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