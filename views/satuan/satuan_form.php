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
                <label>Nama Satuan</label>
                <input required type="text" name="satuan_name" id="satuan_name"
                class="form-control" placeholder="Masukkan nama satuan..." value="<?= $row->satuan_name ?>"/>
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
