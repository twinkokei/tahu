<style media="screen">
  .frame-diskon{
    border: 1px solid #b0b0b0;
    padding: 15px;
    padding-bottom: 30px;
  }
</style>
<script type="text/javascript">
  function grand_total(){
    var harga = parseFloat(document.getElementById("i_harga").value);
    var qty = parseFloat(document.getElementById("i_qty").value);
    var total = harga * qty;
    document.getElementById("i_total").value = total;
  }
</script>
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
  <div class="row">
  <!-- right column -->
    <div class="col-md-12">
    <!-- general form elements disabled -->
      <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form">
        <div class="box box-cokelat">
          <div class="box-body">
            <div class="title_page"> <?= $title ?></div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Item</label>
                <input required type="text" name="kategori_name" id="kategori_name"
                class="form-control" placeholder="Masukkan nama kategori..." value="<?= $row->kategori_name ?>"/>
              </div>
            </div>
            <div style="clear:both;"></div>
          </div><!-- /.box-body -->
        <div class="box-footer">
          <?php if (strpos($permit, 'c') !== false || strpos($permit, 'u') !== false): ?>
            <input class="btn btn-primary" type="submit" value="Simpan"/>
          <?php endif; ?>
          <a href="<?= $close_button?>" class="btn btn-danger" >Batal</a>
        </div>
        </div><!-- /.box -->
      </form>
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</script>
