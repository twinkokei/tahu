<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/print_model.php';
$page = null;
$page = $_GET['page'];

switch ($page) {
	case 'excel_aruskas':
	    $date = explode("-", $_GET["date"]);
	    $date1 = $date[0];
	    $date2 = $date[1];
	    $date1 = str_replace("/", "-", $date1);
	    $date2 = str_replace("/", "-", $date2);
	    $query = select_pembelian_bydate($date1, $date2);

	    include '../views/print/excel_aruskas.php';
	break;
	
	case 'excel_pembelian':
	    $date = explode("-", $_GET["date"]);
	    $date1 = $date[0];
	    $date2 = $date[1];
	    $date1 = str_replace("/", "-", $date1);
	    $date2 = str_replace("/", "-", $date2);
	    $query = select_pembelian_bydate($date1, $date2);

	    include '../views/print/excel_pembelian.php';
	break;

  	case 'print_transaction':
  		$transaction_id = $_GET['transaction_id'];
		$query = select($transaction_id);
		$row = mysql_fetch_array($query);
  		$date 	= isset($_GET["date"]);
		$q_cabang = cabang();
		$r_cabang = mysql_fetch_array($q_cabang);
		// echo $r_cabang['office_name'];
		// echo $transaction_id;
	   include '../views/print/print_penjualan.php';
  	break;

  }

