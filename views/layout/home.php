<?php
      $query=mysql_query("SELECT * from office");
      $r_img = mysql_fetch_array($query);
      $gambar = $r_img['office_img'];
      ?>
<style>
  .img-office{
    background-image: image('<?= "../img/menu/".$gambar?>');
    width: auto;;
  }
  .center{
    text-align: center;
  }
</style>
  <?php
  if(isset($_GET['did']) && $_GET['did'] == 1){
  ?>
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
  <?php }else if(isset($_GET['did']) && $_GET['did'] == 3){ ?>
  <section class="content_new">
    <div class="alert alert-info alert-dismissable">
      <i class="fa fa-check"></i>
      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
      <b>Sukses !</b>
      Delete Berhasil
    </div>
  </section>
  <?php } ?>
                <!-- Main content -->
<section class="content">
    <div id="container" style="height: 400px; width: : 310px"></div>
  <div class="row">
      <div class="title_page"></div>
      <div class="box">
        <div class="box-body2 table-responsive">
          <div class="box-header">
          <h3 class="box-title" style=""><strong>List Piutang</strong></h3>
          </div>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Member</th>
              <th>Transaction code</th>
              <th>Total</th>
              <th>Uang Muka</th>
              <th>Sisa Hutang</th>
              <th>Pelunasan</th>
            </tr>
          </thead>
        <tbody>
        <?php
        $no = 1;
        while($row = mysql_fetch_array($q_piutang)){ ?>
          <tr>
            <td><?= $no?></td>
            <td><?= strtoupper($row['member_name'])?></td>
            <td><?= $row['transaction_code'] ?></td>
            <td style="text-align: right;"><?= format_rupiah($row['transaction_total']) ?></td>
            <td style="text-align: right;"><?= format_rupiah($row['transaction_uang_muka'])?></td>
            <td style="text-align: right;"><?= format_rupiah($row['transaction_piutang'])?></td>
            <td style="text-align:center;">
              <a href="piutang.php?page=form&id=<?= $row['kredit_id']?>&&code=<?= $row['transaction_code']?>" class="btn btn-default" >
                <i class="fa fa-pencil"></i>
              </a>
            </td>
          </tr>
        <?php $no++; } ?>
        </tbody>
        <tfoot>
        </tfoot>
        </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    <!-- </div> -->
  </div><!-- /row-->
</section><!-- /.content -->

<script type="text/javascript">
var series_chart = [];
$(document).ready(function(){
  var utc_date = [];
  var normal_date = [];
  var date   = [];
  var date_1 = [];
  var date_2 = [];
  var date_3 = [];
  var date_utc1 = [];
  var date_utc2 = '';
  var aa_date = '';
  var pembelian = [];
  var penjualan = [];
  var date_parse_to_hc_pembelian = [];
  var date_parse_to_hc_penjualan = [];
  var data_hc = '';
  var date_parse_to_hc_pembelian_ = [];
  var date_parse_to_hc_penjualan_ = [];
  var pembelian_ = '';
  function get_val_chart(){
    $.ajax({
      dataType  : "json",
      data      : "get",
      url       : "home.php?page=Highcharts",
      success   : function(data){
        $.each(data, function(index, value){
          pembelian = value.journal_credit;
          penjualan = value.journal_debit;
          aa_date   = value.journal_date;
          date      = aa_date.split("-");
          date_parse_to_hc_pembelian = [Date.UTC(date[0], date[1], date[2]), parseInt(pembelian)];
          date_parse_to_hc_pembelian_.push(date_parse_to_hc_pembelian);
          date_parse_to_hc_penjualan = [Date.UTC(date[0], date[1], date[2]), parseInt(penjualan)];
          date_parse_to_hc_penjualan_.push(date_parse_to_hc_penjualan);
        });
        Highcharts_(date_parse_to_hc_pembelian_, date_parse_to_hc_penjualan_);
      }
    });
  }
  get_val_chart();
function Highcharts_(pembelian, penjualan){
  // console.log(data);
  Highcharts.chart('container', {
      chart: {
          type: 'spline'
      },
      title: {
          text: ''
      },
      subtitle: {
          text: 'Grafik Penjualan dan Pembelian'
      },
      xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { // don't display the dummy year
              month: '%e. %b',
              year: '%b'
          },
          title: {
              text: 'Date'
          }
      },
      yAxis: {
          title: {
              text: ''
          },
          min: 0
      },
      tooltip: {
          headerFormat: '<b>{series.name}</b><br>',
          pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
      },
      plotOptions: {
          spline: {
              marker: {
                  enabled: true
              }
          }
      },
      series: [{
          name: 'Pembelian',
          data: pembelian
      }, {
          name: 'Penjualan',
          data: penjualan
      }]
      // series:[]
    });
}
  // console.log(series_chart);
});
</script>
