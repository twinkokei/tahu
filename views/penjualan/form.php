<?php if(isset($_GET['did']) && $_GET['did'] == 1){ ?>
<section class="content_new">
  <div class="alert alert-info alert-dismissable">
    <i class="fa fa-check"></i>
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    <b>Sukses !</b>
    Transaksi telah tersimpan
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
<!-- Content Header (Page header) -->
        

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="title_page"> <?= $title ?></div>
        <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" novalidate>
          <div class="box box-cokelat">
            <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Tanggal</label>
                  <div class="input-group">   
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="hidden" name="transaction_id" id="transaction_id" value="<?= $transaction_id?>">
                    <input type="datepicker" required  name="i_tanggal" 
                    class="form-control pull-right calendar" id="date_picker1" value="<?= $tanggal?>"/>
                  </div><!-- /.input group -->
                </div>
                      <div class="form-group">
                        <label>Cabang</label>
                        <select id="i_branch_id" name="i_branch_id" size="1" class="selectpicker show-tick form-control" data-live-search="true">
                        <?php
                        while($r_branch = mysql_fetch_array($query_branch)){
                          $branch_id = '';
                          if ($_SESSION['branch_id']) { $branch_id=$_SESSION['branch_id']; }?>
                          <option value="<?= $r_branch['branch_id'] ?>"
                          <?php if($branch_id==$r_branch['branch_id']){echo "selected";}?>>
                            <?= $r_branch['branch_name']?> 
                          </option>
                        <?}?>
                        </select>                                            
                      </div>
                <div class="form-group">
                  <label>Member</label>
                  <select id="i_member_id" name="i_member_id" size="1" class="selectpicker show-tick form-control" 
                  data-live-search="true">
                  <?php
                  while($r_member = mysql_fetch_array($query_member)){
                    $member_id = '';
                    if ($_SESSION['member_id']) { $member_id=$_SESSION['member_id']; }?>?>
                    <option value="<?= $r_member['member_id'] ?>"
                    <?php if($branch_id==$r_branch['branch_id']){echo "selected";}?>>
                      <?= $r_member['member_name']?> </option>
                  <?}?>
                  </select>                                            
                </div>  
                <div class="form-group">
                  <label>Tahu</label>
                  <select id="i_menu_id"  name="i_menu_id" size="1" class="selectpicker show-tick form-control" 
                  data-live-search="true" onChange="menu_detail()">
                  <option value="0">--</option>
                  <?php
                  while($r_menu = mysql_fetch_array($query_menu)){?>
                  <option value="<?= $r_menu['menu_id'] ?>"><?= $r_menu['menu_name']?> </option>
                  <?}?>
                  </select>                                            
                </div>
              </div>
                  <div style="clear:both;"></div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </form>
    </div><!--/.col (penjualan) -->
  </div>
<div class="row">
    <div class="col-md-6"><div class="title_page">Tahu</div>
      <div class="box" style="height: 710px;">
        <div class="box-body" id="menu_detail_form">

        </div>
      </div>
    </div>
    <div class="col-md-6"><div class="title_page">Cart</div>
      <div class="box">         
        <div class="box-body2 table-responsive">
          <table id="ea" class="table table-bordered table-striped" style="width: 100%;">
            <thead style="background-color: #008d4c; color: #FFF">
              <tr>
              <th>No</th>
              <th>Nama Tahu</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Total</th> 
              <th>Config</th>
              </tr>
            </thead>
              <tbody style="overflow-x: auto;overflow-y: auto;">
              <?php
              $total_harga=0;
              $no = 1;
              while($row = mysql_fetch_array($query_keranjang)){ ?>
              <tr>
                <td><?= $no?></td>
                <td><?= $row['menu_name']?></td>
                <td><?= $row['satuan_name']?></td>
                <td><?= format_rupiah($row['price'])?></td>
                <td><?= format_rupiah($row['qty'])?></td>
                <td><?= format_rupiah($row['total'])?></td>
                <td style="text-align:center;">
                  <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['keranjang_id']; ?>,'penjualan.php?page=delete&id=')"
                    class="btn btn-default" ><i class="fa fa-trash-o"></i>
                  </a>
                </td>
              </tr>
            <?php 
              $total_harga = $total_harga + $row['total'];
              $no++; } ?>
              </tbody>

              </table>
              <form id="form_keranjang">
                <div class="form-group">
                    <label>Total</label>
                    <input type="hidden" name="transaction_id_" id="transaction_id_" value="<?= $transaction_id?>"/>
                    <input required type="text" readonly name="total_harga_" id="total_harga_" class="form-control" 
                    value="<?= format_rupiah($total_harga)?>" min="0"/>
                    <input required type="hidden" readonly name="total_harga" id="total_harga" class="form-control" 
                    value="<?= $total_harga?>" min="0"/>
                </div>
                <div class="form-group">
                      <label>Diskon (1-100)%</label>
                      <input type="number" required class="form-control" id="diskon_byr" name="diskon_byr" onkeyup="diskon()" placeholder="Diskon %" min="0" />
                </div>
                <div class="form-group">
                      <label>Jenis Pembayaran</label>
                      <select class="form-control" id="jns_bayar" name="jns_bayar" onChange="jns_pembayaran()">
                        <option value="1">Cash</option>
                        <!-- <option value="2">Kredit</option> -->
                        <option value="3">Debit</option>
                        <option value="4">Transfer</option>
                        <option value="5">Angsuran</option>
                      </select>
                </div>
                <div class="form-group" id="form_kredit">

                </div>
                <div class="form-group">
                      <label>Grand Total</label>
                      <input required type="" readonly name="grand_total_" id="grand_total_" class="form-control" 
                      value="<?= format_rupiah($total_harga) ?>" min="0"/>
                      <input required type="hidden" readonly name="grand_total" id="grand_total" class="form-control" 
                      value="<?= $total_harga ?>" min="0"/>
                </div>
                <div class="form-group">
                      <label>Bayar</label>
                      <input required type="textarea" name="bayar_currency" id="bayar_currency" onkeyup="number_currency_(this);bayar_(this);" class="form-control" value="" 
                      placeholder="masukan bayar"/>
                      <input required type="hidden" name="bayar" id="bayar" class="form-control" value="" placeholder="masukan bayar"/>
                </div>
                <div class="form-group">
                      <label>Kembalian</label>
                      <input type="text" readonly name="kembalian_currency" id="kembalian_currency" class="form-control" 
                      value="" min="0"/>
                      <input type="hidden" readonly name="kembalian" id="kembalian" class="form-control" 
                      value="" min="0"/>
                </div>
                <button type="button" style="margin-left: 82%;" class="btn btn-success" onclick="submit_form()">Simpan</button>
                </form> 
              <tfoot>
        <!--         <button type="button" style="margin-left: 90%;" class="btn btn-info">Save</button>  -->
              </tfoot>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>    
</div>   <!-- /.row -->  
</section><!-- /.content -->
<script type="text/javascript">
  function menu_detail(){
    var i_tanggal = $('#date_picker1').val();
    var i_menu_id = $('#i_menu_id').val();
    var i_branch_id = $('#i_branch_id').val();
    var i_member_id = $('#i_member_id').val();
    var transaction_id = $('#transaction_id').val();
    $.ajax({
      type  : 'POST',
      url   : "penjualan.php?page=get_menu_details", 
      data  : {i_menu_id:i_menu_id, i_branch_id:i_branch_id},
      dataType  : "json",
      success   : function(data){
        var status = '';

        if (data.status == 1) {status = '1' 
        $('#menu_detail_form').empty();
        $('#menu_detail_form').append('<center><label>'+data.menu_name+'</label><br><label>Stok Tersedia : '+data.stok_menu+' '+data.satuan+'</label>\
          <br><img src="../img/menu/'+data.menu_img+'" width="200px" height="200px"></center>\
          <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" style="padding:10px;">\
          <div class="form-group">\
            <label style="color:red;">Harga</label>\
            <input readonly type="hidden" name="i_price" id="i_price" class="form-control" value="'+data.menu_price+'"/>\
            <input readonly type="textarea" name="i_price_" id="i_price_" class="form-control" value="'+data.menu_price_+'"/>\
            <input type="hidden" name="i_menu_id" id="i_menu_id" class="form-control" value="'+data.menu_id+'"/>\
            <input type="hidden" name="i_tanggal" id="i_tanggal" class="form-control" value="'+i_tanggal+'"/>\
            <input type="hidden" name="i_branch_id" id="i_branch_id" class="form-control" value="'+i_branch_id+'"/>\
            <input type="hidden" name="i_member_id" id="i_member_id" class="form-control" value="'+i_member_id+'"/>\
            <input type="hidden" name="transaction_id" id="transaction_id" class="form-control" value="'+transaction_id+'"/>\
          </div>\
            <div class="form-group">\
              <label>Paket Satuan</label>\
              <select class="selectpicker show-tick form-control" id="jns_satuan" name="jns_satuan"\
              onChange="get_harga_konversi()" data-live-search="true"/>\
            </div>\
            <div class="form-group" id="form_harga_konversi">\
                </div>\
            <div class="form-group">\
              <label>QTY</label>\
              <input required type="number" name="i_qty" id="i_qty" class="form-control" placeholder="Masukkan jumlah..." onChange="grand_total()" min="0"/>\
            </div>\
                      <div class="form-group">\
                          <label>Total Harga</label>\
                          <input readonly type="text" name="i_total" id="i_total" class="form-control" min="0"/>\
                      </div>\
          <button class="btn btn-primary">Simpan</button></form>\
          ');} else if (data.status == 2){ 
                if (data.stok_menu == null) {
                  $('#menu_detail_form').html('<center><div class="alert alert-info alert-dismissable">\
                   <i class="fa fa-warning"></i>\
                   <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>\
                   <b>Stok Habis !</b>\
                   </div>');
                  
          } else $('#menu_detail_form').html('<center><div class="alert alert-info alert-dismissable">\
                   <i class="fa fa-warning"></i>\
                   <b>Stok sedang krisis !</b>\
                   Stok yang tersedia : '+data.stok_menu+' '+data.satuan+' </div><br>\
                   <img src="../img/menu/'+data.menu_img+'" width="200px" height="200px"></center>\
            <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" style="padding:10px;">\
            <div class="form-group">\
            <label style="color:red;">Harga</label>\
            <input readonly type="hidden" name="i_price" id="i_price" class="form-control" value="'+data.menu_price+'"/>\
            <input readonly type="textarea" name="i_price_" id="i_price_" class="form-control" value="'+data.menu_price_+'"/>\
            <input type="hidden" name="i_menu_id" id="i_menu_id" class="form-control" value="'+data.menu_id+'"/>\
            <input type="hidden" name="i_tanggal" id="i_tanggal" class="form-control" value="'+i_tanggal+'"/>\
            <input type="hidden" name="i_branch_id" id="i_branch_id" class="form-control" value="'+i_branch_id+'"/>\
            <input type="hidden" name="i_member_id" id="i_member_id" class="form-control" value="'+i_member_id+'"/>\
            <input type="hidden" name="transaction_id" id="transaction_id" class="form-control" value="'+transaction_id+'"/>\
            </div>\
            <div class="form-group">\
              <label>Paket Satuan</label>\
              <select class="selectpicker show-tick form-control" id="jns_satuan" name="jns_satuan"\
              onChange="get_harga_konversi()" data-live-search="true"/>\
            </div>\
            <div class="form-group" id="form_harga_konversi">\
                </div>\
            <div class="form-group">\
              <label>QTY</label>\
              <input required type="number" name="i_qty" id="i_qty" class="form-control" placeholder="Masukkan jumlah..." onChange="grand_total()" min="0"/>\
            </div>\
                      <div class="form-group">\
                          <label>Total Harga</label>\
                          <input readonly type="text" name="i_total" id="i_total" class="form-control" min="0"/>\
                      </div>\
          <button class="btn btn-primary">Simpan</button></form>');
              }

        if(i_menu_id == 0){
          $('#menu_detail_form').html('');
        }
        jns_satuan(data.menu_id);
      }
    });
  }


  function jns_satuan(menu_id)
  {
    $.ajax({
      dataType:"json",
      type    :"post",
      data    :{menu_id:menu_id},
      url     :"penjualan.php?page=get_satuan",
      success :function(data){
        $('#jns_satuan').empty();
        $('#jns_satuan').append('<option value="0">--</option>');
       for (var i = 0; i < data.length; i++) {
            $('#jns_satuan').append('<option value="'+data[i].satuan_id+'">'+data[i].satuan_name+'</option>');
          }
      }
    })
  }


    function get_harga_konversi(){ 
    var satuan_konversi = $('#jns_satuan').val();
    var menu_id = $('#i_menu_id').val();
      $.post("penjualan.php?page=get_harge_konversi", {satuan_konversi:satuan_konversi, menu_id:menu_id}, function(data){
        // alert(data);
    if (satuan_konversi != 0) {

          $('#form_harga_konversi').empty();
          $('#form_harga_konversi').append('<label>Harga/Paket</label>\
                    <input type="text" name="" readonly id="" class="form-control" value="'+toRp(data)+'"/>\
                    <input type="hidden" name="harga_konversi" readonly id="harga_konversi" class="form-control" value="'+data+'"/>\
                    ');
          } else {
            $('#form_harga_konversi').html('');
          }
      })  
    }


$(document).ready(function(){
  $('#ea').DataTable({
    "scrollY":"200%"
  });
});
      function grand_total()
      {
        
        var harga = $('#i_price').val();
        var satuan = $('#jns_satuan').val();
        var satuan_konversi = $('#harga_konversi').val();
        var qty = $('#i_qty').val();
        
      if (satuan <= 1) {
        var total = harga * qty;
      } else {
        var total = satuan_konversi * qty;
      } 
        // var total = harga * qty;
        
        document.getElementById("i_total").value = format_rupiah(total);
        
      }

  function bayar_(elem){
        var elem_id = '#'+elem.id;   
        var harga = $('#grand_total').val();
        var jns_bayar = $('#jns_bayar').val();
        var bayar = $('#bayar').val();
        var kembalian = bayar-harga;
        document.getElementById("kembalian_currency").value = toRp(kembalian);
        document.getElementById("kembalian").value = kembalian;
      }

function jns_pembayaran(){
  var kredit = $('#jns_bayar').val();

  if (kredit != 1) {
     $('#form_kredit').empty();
    $('#form_kredit').append('<label>Bank</label>\
                    <select class="form-control" name="bank" id="bank">\
                    <?php
                    while($r_bank = mysql_fetch_array($query_bank)){?>\
                    <option value="<?= $r_bank['bank_id'] ?>"><?= $r_bank['bank_name']?> </option>\
                    <?}?> \
                    </select>\
                    <div class="form-group">\
                    <label>No Rek</label>\
                    <input type="text" name="no_rek" id="no_rek" class="form-control" value=""/>\
                    </div>');
  } else {
     $('#form_kredit').html('');
  }
}

function diskon(){

  var harga = $('#total_harga').val();
  var diskon = $('#diskon_byr').val();

  var grand_total = harga - (harga*diskon/100); 
  
  document.getElementById("grand_total_").value = toRp(grand_total);   
  document.getElementById("grand_total").value = grand_total;   
}
$(document).ready(function(){


$('.calendar').datepicker()
    .on("change", function (e) {
   // <!--  console.log("Date changed: ", e.target.value); -->
   alert($(this).val())
    });
}); 
 

function submit_form(){
  var jns_bayar     = $('#jns_bayar').val();
  var bayar         = $('#bayar').val();
  var grand_total   = $('#grand_total').val();

  var url = "penjualan.php?page=save_transactions";
  var i_tanggal = $('#date_picker1').val();

  var i_branch_id = $('#i_branch_id').val();
  var i_member_id = $('#i_member_id').val();
  var transaction_id_ = $('#transaction_id_').val();
  var data_keranjang = $("#form_keranjang").serialize();

  var paramArr = $("#form_keranjang").serializeArray();

  paramArr.push( {name:'i_tanggal', value:i_tanggal },
                 {name:'transaction_id_', value:transaction_id_ },
                 {name:'i_branch_id', value:i_branch_id }, 
                 {name:'i_member_id', value:i_member_id });

  if (grand_total>0) {

     if (jns_bayar!=5){
        if (grand_total>bayar) {            
            alert("Nominal Bayar Kurang ");
        } else {
            $.post("penjualan.php?page=save_transactions", $.param(paramArr), function(result) {
            print(result);
          });       
        }
     } else {
      alert();
      // if (grand_total>bayar){
      //   $.post("penjualan.php?page=save_transactions", $.param(paramArr), function(result) {
      //       print(result);
      //     });
      //   }
      }

  }
}

function print(result){
  window.location.assign('penjualan.php?page=print&transaction_id='+result);
  // window.location.href="penjualan.php?page=print&transaction_id="+result;
}

function number_currency_(elem){
  var elem_id = '#'+elem.id;
  var elem_val   = $(elem_id).val();
  var elem_no_cur = elem_id.replace(/_currency/g,'');

  var str = elem_val.toString(), parts = false, output = [], i = 1, formatted = null;

  parts = str.split(".");
  var gabung = '';
  for (var i = 0; i < parts.length; i++) {
   var gabung = gabung+parts[i];
  }

  str = gabung.split("").reverse();
  var i = 1;
  for(var j = 0, len = gabung.length; j < len; j++) {
   if(str[j] != ".") {
     output.push(str[j]);
     if(i%3 == 0 && j < (len - 1)) {
       output.push(".");
     }
     i++;
   }
  }

  formatted = output.reverse().join("");
  $(elem_id).val(formatted);
  $(elem_no_cur).val(gabung);
}

</script>