<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" style="text-align: center;">Recipe : <?=$menu_name?></h4>
</div>
<form action="<?= $action?>" method="post">
	<div class="modal-body">
		<div class="form-group">
			<input type="hidden" name="menu_recipe_id" id="menu_recipe_id" value="<?= $recipe_id ?>">
			<input type="hidden" name="menu_id" id="menu_id" value="<?= $menu_id ?>">
			<label>Nama Bahan</label>
			<select class="selectpicker form-control" name="item_id" id="item_id" value="0">
				<option value="0"></option>
				<?php 
				while ($r_item = mysql_fetch_array($q_item)) {?>
					<option value="<?= $r_item['item_id'] ?>"
					<?php if ($row->item_id == $r_item['item_id']){ ?> selected="selected"<?php } ?>>
					<?= $r_item['item_name']?>
					</option>
				<?php }?>
			</select>
		</div>
		<div class="form-group">
			<label>Satuan</label>
			<select class="selectpicker form-control" name="satuan_id" id="satuan_id" value="0">
				<option value="0"></option>
				<?php 
				while ($r_satuan = mysql_fetch_array($q_satuan)) {?>
					<option value="<?= $r_satuan['satuan_id'] ?>"
					<?php if ($row->satuan_id == $r_satuan['satuan_id']){ ?> selected="selected"<?php } ?>>
					<?= $r_satuan['satuan_name']?>
					</option>
				<?php }?>
			</select>
		</div>
		<div class="form-group">
			<label>Jumlah Bahan</label>
			<input type="textarea" name="item_qty_currency" id="item_qty_currency" class="form-control" 
			value="<?= $row->item_qty?>" onkeyup="number_currency_(this);" placeholder="Masukkan jumlah item ...">

			<input required type="hidden" name="item_qty" id="item_qty" class="form-control" placeholder="Masukkan jumlah item ..."
			value="<?= $row->item_qty?>"/>
		</div>
	</div>
	<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-primary" value="Simpan">
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