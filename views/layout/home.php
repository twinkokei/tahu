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
    <!-- Small boxes (Stat box) -->
<div id="container" style="height: 400px; min-width: 310px"></div>
</section><!-- /.content -->
<script type="text/javascript">
  $(document).ready(function() {
    var seriesOptions = [],
    seriesCounter = 0,
    names = ['Penjualan', 'Pembelian'];
    journals = [1,2];

/**
 * Create the chart when all data is loaded
 * @returns {undefined}
 */
function createChart() {

    Highcharts.stockChart('container', {

        rangeSelector: {
            selected: 4
        },

        yAxis: {
            labels: {
                formatter: function () {
                    return (this.value > 0 ? ' + ' : '') + this.value + '%';
                }
            },
            plotLines: [{
                value: 0,
                width: 2,
                color: 'silver'
            }]
        },

        plotOptions: {
            series: {
                compare: 'percent',
                showInNavigator: true
            }
        },

        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
            valueDecimals: 2,
            split: true
        },

        series: seriesOptions
    });
}



$.each(names, function (i, name) {

    $.getJSON('home.php?page=Highcharts&journal_types='+journals,    function (data) {


      // console.log(data);
        if (data.journal_type_id = 1) {
            seriesOptions[i] = {
              name: name,
              data: data
          };
        }
        // seriesOptions[i] = {
        //     name: name,
        //     data: data
        // };

        console.log(seriesOptions[i]);

        // As we're loading the data asynchronously, we don't know what order it will arrive. So
        // we keep a counter and create the chart when all the data is loaded.
        // seriesCounter += 1;

        // if (seriesCounter === names.length) {
        //     createChart();
        // }
    });
});
  });
</script>