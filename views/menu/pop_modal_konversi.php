<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title" style="text-align: center;">Konversi : <?=$menu_name?></h4>
</div>
<form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" novalidate>
<div class="modal-body">
      <div class="form-group">
        <input type="hidden" name="menu_id" value="<?=$id?>">
        <input type="hidden" name="menu_satuan" id="satuan" value="<?=$menu_satuan?>">
        <label>Jumlah Satuan Utama</label>
        <input required type="text" name="qty_utama" id="qty_utama" class="form-control"
        placeholder="1" value="1 Lemari" readonly />
      </div>
      <div class="form-group">
        <label>Satuan Konversi</label>
        <select id="satuan_konversi" name="satuan_konversi" size="1" class="selectpicker show-tick form-control" data-live-search="true">
        <?php
         while($r_satuan = mysql_fetch_array($q_konversi)){?>
        <option value="<?= $r_satuan['satuan_id'] ?>"
                      <?php if($row->satuan_konversi == $r_satuan['satuan_id']){ ?> selected="selected"<?php } ?>>
                      <?= $r_satuan['satuan_name'] ?> 
                      </option>
                    <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>Jumlah Satuan Konversi</label>
        <input required type="textarea" name="qty_konversi_currency" id="qty_konversi_currency" class="form-control"
        placeholder="Masukkan jumlah satuan utama..." value="<?= $row->jumlah_satuan_konversi ?>" 
        onkeyup="number_currency_(this);"/>
        <input required type="hidden" name="qty_konversi" id="qty_konversi" class="form-control"
        placeholder="Masukkan jumlah..." value="<?= $row->jumlah_satuan_konversi ?>"/>
      </div>
      <div class="form-group">
        <label>Harga/Konversi</label>
        <input required type="textarea" name="konversi_harga_currency" id="konversi_harga_currency" class="form-control"
        placeholder="Masukkan harga/konversi..." value="<?= $row->konversi_harga ?>" 
        onkeyup="number_currency_(this);"/>
        <input required type="hidden" name="konversi_harga" id="konversi_harga" class="form-control"
        placeholder="Masukkan harga/konversi..." value="<?= $row->konversi_harga ?>"/>
      </div>
    </div>
<div class="modal-footer">
  <?php if (strpos($permit, 'c') !== false || strpos($permit, 'u') !== false){ ?>
  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    <input class="btn btn-primary" type="submit" value="Simpan"/>
  <?php } ?>
</div>
</form>

<script type="text/javascript">
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