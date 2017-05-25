<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
  <div class="row">
  <!-- right column -->
    <div class="col-md-12">
    <!-- general form elements disabled -->
      <div class="title_page"> <?= $title_ ?></div>
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
                    <input type="hidden" name="kredit_id" id="kredit_id" value="<?= $id?>">
                    <input type="hidden" name="transaction_code" id="transaction_code" value="<?= $code?>">
                    <input type="datepicker" required  name="date" 
                    class="form-control pull-right calendar" id="date_picker1" value="<?= $tanggal?>" />
                  </div><!-- /.input group -->
              <div class="form-group">
                <label>Sisa Piutang</label>
                <input required type="textarea" name="i_sisa_currency" id="i_sisa_currency" class="form-control" placeholder="Masukkan bayar ..." onkeyup="number_currency_(this);" value="<?= format_rupiah($transaction_piutang)?>"/>
                <input required type="hidden" id="i_sisa" name="i_sisa" class="form-control" value="<?= $transaction_piutang?>"/>
              </div>
              <div class="form-group">
                <label>Bayar</label>
                <input required type="textarea" name="i_bayar_currency" id="i_bayar_currency" class="form-control" placeholder="Masukkan bayar ..." onkeyup="number_currency_(this);"/>
                <input required type="hidden" id="i_bayar" name="i_bayar" class="form-control"/>
              </div>
              <div class="form-group">
                <label>Metode Pembayaran</label>
                <select id="i_payment_method"  name="i_payment_method" class="form-control" onchange="payment_method()">
                  <option value="1">Cash</option>
                  <option value="3">Transfer</option>
                </select>
              </div>
              <div class="form-group" id="form_method">

              </div>
            </div>
          <div style="clear:both;"></div>
          </div><!-- /.box-body -->
        <div class="box-footer">
          <?php if (strpos($permit, 'c') !== false || strpos($permit, 'u') !== false): ?>
            <input class="btn btn-primary" type="submit" value="Simpan"/>
          <?php endif; ?>
        <a href="<?= $close_button?>" class="btn btn-danger" >Keluar</a>
        </div>
        </div><!-- /.box -->
      </form>
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
     function payment_method(){
      var method = $('#i_payment_method').val();

      if (method == 3) {
         $('#form_method').empty();
         $('#form_method').append('<label>Bank</label>\
                    <select class="form-control" name="bank" id="bank">\
                    <?php
                    while($r_bank = mysql_fetch_array($q_bank)){?>\
                    <option value="<?= $r_bank['bank_id'] ?>"><?= $r_bank['bank_name']?> </option>\
                    <?}?> \
                    </select>\
                    <div class="form-group">\
                    <label>No Rek</label>\
                    <input type="text" name="no_rek" id="no_rek" class="form-control" value=""/>\
                    </div>');
     } else {
     $('#form_method').html('');
  }
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