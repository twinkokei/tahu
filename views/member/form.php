<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
	<div class="row">
	<!-- right column -->
		<div class="col-md-12">
		<!-- general form elements disabled -->
			<div class="title_page"> <?= $title ?></div>
			<form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form" novalidate>
				<div class="box box-cokelat">
					<div class="box-body">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama</label>
								<input required type="text" name="i_name" class="form-control" placeholder="Masukkan nama member..." value="<?= $row->member_name ?>"/>
							</div>
							<div class="form-group">
								<label>No Telp</label>
								<input required type="phone" name="i_telp" id="i_telp" class="form-control" placeholder="Masukkan nomor telepon..." value="<?= $row->member_phone ?>"/>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input required type="email" name="i_email" id="i_email" class="form-control" placeholder="Masukkan email..." value="<?= $row->member_email ?>"/>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea name="i_address" id="i_address" cols="45" rows="5" class="form-control"><?= $row->member_address ?></textarea>
							</div>
						</div>
						<div style="clear:both;"></div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php if (strpos($permit, 'c') !== false || strpos($permit, 'u') !== false){ ?>
							<input class="btn btn-primary" type="submit" value="Simpan"/>
						<?php } ?>
						<a href="<?= $close_button?>" class="btn btn-danger" >Keluar</a>
					</div>
				</div><!-- /.box -->
			</form>
		</div><!--/.col (right) -->
	</div>   <!-- /.row -->
</section><!-- /.content -->
