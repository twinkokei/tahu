<?php
/*
$outprint = "Just the test printer";
$printer = printer_open("58 Printer(1)");
printer_set_option($printer, PRINTER_MODE, "RAW");
printer_start_doc($printer, "Tes Printer");
printer_start_page($printer);
printer_write($printer, $outprint);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
*/
?>
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../css/print/print.css" rel="stylesheet">
<style type="text/css">
	body{
		font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
	}
	.frame{
		border:1px solid #000;
		width:10%;
		margin-left:auto;
		margin-right:auto;
		padding:10px;
	}
	table{
		font-size:10px;

	}
	.header{
		text-align:center;
		font-weight:bold;
		font-size:11px;

	}
	.header_img{

		width:164px;
		height:79px;
		margin-left:auto;
		margin-right:auto;
		margin-bottom:10px;
	}

	.back_to_order{
		width:10%;
		margin-left:auto;
		margin-right:auto;
		color:#fff;
		font-weight:bold;
		background:#09F;
		text-align:center;
		border-radius:10px;
		margin-top:10px;
		padding:5px;height:30px;
	}
	.back_to_order:hover{
		background:#069;
	}

	@media print{
		.btn{
			display: none;
			}	
		}
	</style>
	<body  onload=print()>
	<!--<body>-->
	<div class="header">
		<span style="font-size:14px;">
		<?= $r_cabang['office_name']?><br>
        <?= $r_cabang['branch_name']?><br>
		</span><br>
	</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;">
	  <tr>
	    <td>N/<b><?= $row['transaction_id']?></td>
	    <td align="right"><?= $row['transaction_date'] ?></td>
	  </tr>
	  <tr>
	  <td>Nama Member :</td>
	  	<td align="right"><?= $row['member_name']?></td>
	  </tr>
	  <?php
	  $query1 = mysql_query("SELECT a.*, b.menu_name
	                		FROM transaction_details a
	                		LEFT JOIN menus b ON b.menu_id = a.menu_id
	                		WHERE transaction_id = '$transaction_id'");
	  							while($row_item = mysql_fetch_array($query1)){
	  								$count = count($row_item);
	  	?>
	  <tr>
	  	<td>Nama Menu :</td>
	    <td align="right"><?= $row_item['menu_name'] ?></td>
	  </tr>
	  <tr>
	  	<td>Qty :</td>
	  	<td align="right"><?= format_rupiah($row_item['qty'])?></td>
	  </tr>
	  <tr>
	  	<td>Price :</td>
	  	<td align="right">Rp. <?= format_rupiah($row_item['price'])?></td>
	  </tr>
	  <?php
	  		}
		 ?>
	  <tr>
	  	<td>Total Price</td>
	  	<td align="right">Rp. <?= format_rupiah($row['transaction_total'])?></td>
	  </tr>
	  <tr>
	  	<td>Discount :</td>
	  	<td align="right"><?= $row['transaction_discount']?>%</td>
	  </tr>
	</table>
		<?php $bank = array('Mandiri', 'BCA', 'BRI');?>
		<?php if($row['payment_method_id'] != 1){?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;font-size:12px;">
  	  <tr>
    	<td>Bank :</td>
    	<td align="right"><?= $bank[$row['bank_id']]?></td>
  	  </tr>
  	  <tr>
  	  	<td>No Rekening :</td>
  	  	<td align="right"><?= $row['bank_account_number']?></td>
  	  </tr>
	</table>
		<?php }?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 5;font-size:12px;">
	  <tr>
	    <td style="font-size:12px"><strong>Total Pembayaran</strong></td>
	    <td style="font-size:12px" align="right"><strong>Rp. <?= format_rupiah($row['transaction_grand_total'])?></strong></td>
	  </tr>
	  <tr>
	    <td style="font-size:12px"><strong>Bayar</strong></td>
	    <td style="font-size:12px" align="right"><strong>Rp. <?= format_rupiah($row['transaction_payment'])?></strong></td>
	  </tr>
	  <tr>
	    <td style="font-size:12px"><strong>Kembalian</strong></td>
	    <td style="font-size:12px" align="right"><strong>Rp. <?= format_rupiah($row['transaction_change'])?></strong></td>
	  </tr>
	</table>

	<center><button class="btn btn-danger" onclick="exit()">Kembali</button></center>

<script type="text/javascript">
	function exit(){
		window.location.assign('penjualan.php?page=list');
	}
</script>