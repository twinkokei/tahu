<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/penjualan_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Penjualan");
$item = ucfirst("ITEM");

$_SESSION['menu_active'] = 5;
$_SESSION['sub_menu_active'] = 43;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
	case 'list':
		get_header();

		$close_button = "home.php";
	
		$where = '';
		$query_menu = select_menu();
		$query_bank = select_bank();
		$query_branch = select_branch();
		$query_member = select_member();
		$query_keranjang = select_keranjang();
		// $query_satuan = select_satuan();

		$save_transactions = "penjualan.php?page=save_transactions";

		$q_total = grand_total();

		$transaction_id_new = select_config_by('transactions', 'max(transaction_id)+1', $where);
		if ($transaction_id_new==null) {$transaction_id_new = 1;}
		$transaction_id = (isset($_GET['transaction_id'])) ? $_GET['transaction_id'] : $transaction_id_new;

		if(isset($_SESSION['i_tanggal'])!=null) {
			$tanggal = $_SESSION['i_tanggal'];
		} else {
			$tanggal = date('d-m-Y');
		}
		$action = "penjualan.php?page=save";	
		include '../views/penjualan/form.php';
		get_footer();
	break;

	case 'get_menu_details':

		$i_menu_id 		= $_POST['i_menu_id'];
		$i_branch_id 	= $_POST['i_branch_id']; 

		$where_menu_id 	= "where menu_id = '$i_menu_id'";
 		$q_menu 		= select_config('menus', $where_menu_id);
 		$and_branch_id	= " AND branch_id = '$i_branch_id'";
 		$stok_menu 		= select_config_by('menu_stock', 'menu_stock_qty', $where_menu_id.$and_branch_id);
 		$status 		= 0;
 		$q_satuan_name 	= select_satuan_name($where_menu_id);


		$r_menu = mysql_fetch_array($q_menu);
		$r_satuan = mysql_fetch_array($q_satuan_name);	
		if ($stok_menu >= $r_menu['menu_limit']) {
			$status = 1;
		} elseif ($stok_menu <= $r_menu['menu_limit']) {
			$status = 2;
		} elseif ($stock_menu == 0) {
			$status = 0;
		}

		$data = array(
						'menu_id' => $r_menu['menu_id'],
						'menu_name' => $r_menu['menu_name'],
						'menu_price_' => format_rupiah($r_menu['menu_price']), 
						'menu_price' => $r_menu['menu_price'], 
						'menu_img' => $r_menu['menu_img'],
						'menu_limit' => $r_menu['menu_limit'],
						'status' 	=> $status,
						'stok_menu' => $stok_menu,
						'satuan' => $r_satuan['satuan_name']
						);

		echo json_encode($data);

		break;

	case 'save':
		extract($_POST);

		$i_tanggal = get_isset($i_tanggal);
		$i_branch_id = get_isset($i_branch_id);
		$i_member_id = get_isset($i_member_id);
		$i_menu_id = get_isset($i_menu_id);
		$transaction_id = get_isset($transaction_id);
		$i_price = get_isset($i_price);
		$i_qty = get_isset($i_qty);
		$jns_satuan = get_isset($jns_satuan);

		$where_satuan_utama = "WHERE menu_satuan = '$jns_satuan'";
		$check_satuan_utama = select_config_by('menus', 'count(menu_id)', $where_satuan_utama);

		$i_total   = $i_qty*$i_price;

		if ($check_satuan_utama == 0 && $jns_satuan !=0) {

			$where_menu_id = "WHERE menu_id = '$i_menu_id' and satuan_konversi = '$jns_satuan'";
			$i_price = select_config_by('konversi_menu', 'konversi_harga', $where_menu_id);
			$i_total = $i_qty*$i_price;
		}

		$_SESSION['i_member_id'] = $i_member_id;
		$_SESSION['i_tanggal'] = $i_tanggal;
		$_SESSION['i_branch_id'] = $i_branch_id;

		$where_menu_id = "WHERE menu_id = '$i_menu_id' and satuan_konversi = '$jns_satuan'";
		$check_keranjang = select_config_by('keranjang', 'count(menu_id)', $where_menu_id);
		if ($check_keranjang==0) {
			$data = "'',
				 '$transaction_id',
				 '$i_menu_id',
				 '$i_price',
				 '$i_qty',
				 '$jns_satuan',
				 '$i_total'
				";

			create_config("keranjang",$data);
			$data_id = mysql_insert_id();
		} else {
			$where_menu_id = "menu_id = '$i_menu_id'";
			$data_update = "qty = qty+'$i_qty',
							total = total+'$i_total'";
			update_config2('keranjang', $data_update, $where_menu_id);
		}
		header("Location: penjualan.php?page=list&did=1");
	break;

	case 'save_transactions':
		$i_branch_id = $_POST['i_branch_id'];
		$i_member_id = $_POST['i_member_id'];
		$tanggal = $_POST['i_tanggal'];
		$grand_total = $_POST['grand_total'];
		$transaction_id_ = $_POST['transaction_id_'];
		$i_code = '1'.time();
		$total_harga = $_POST['total_harga'];
		$diskon_byr = $_POST['diskon_byr'];
		$bayar = $_POST['bayar'];
		$kembalian = $_POST['kembalian'];
		$jns_bayar = $_POST['jns_bayar'];
		$bank = '';
		$no_rek = '';
		$tanggal = date("Y-m-d h:m:s", strtotime($tanggal));
		$i_user_id = $_SESSION['user_id'];
		$status = '';

		if ($jns_bayar != 1) {
			$bank = $_POST['bank'];
			$no_rek = $_POST['no_rek'];
		} else if ($jns_bayar == 5) {
			$status = 1;
		}
		$data = "'$transaction_id_',
				'$i_branch_id',
				'$i_member_id',
				'$tanggal',
				'$i_code',
				'$total_harga',
				'$diskon_byr',
				'',
				'$grand_total',
				'$bayar',
				'$kembalian',
				'$jns_bayar',
				'$bank',
				'$no_rek',
				'$status'
				";
		create_config('transactions', $data);
		$where_transaction_id = "where transaction_id = '$transaction_id_'";
		$q_keranjang = select_config('keranjang',  $where_transaction_id);
		while ($r_keranjang = mysql_fetch_array($q_keranjang)) {
				$data_detail = "'',
								'".$transaction_id_."',
								'".$r_keranjang['menu_id']."',
								'".$r_keranjang['qty']."',
								'".$r_keranjang['price']."',
								'".$r_keranjang['total']."',
								'".$r_keranjang['satuan']."'
								";		

				create_config('transaction_details', $data_detail);		
		}

		$where_transaction_id_ = "transaction_id = '$transaction_id_'";
		delete_config('keranjang',$where_transaction_id_);

		$int_transaction = intval($transaction_id_);
		echo json_encode($int_transaction);

				//simpan jurnal
		create_journal($i_code, "penjualan.php?page=form&id=", 1, $grand_total, $i_user_id, $i_branch_id, $jns_bayar, $bank, $no_rek);
	break;

	case 'delete':
		$id = get_isset($_GET['id']);
    	$where_keranjang_id = "keranjang_id = '$id'";    
    	delete_config('keranjang', $where_keranjang_id);
    	header('Location: penjualan.php?page=list&did=3');
	break;

	case 'get_satuan':
		$menu_id = $_POST['menu_id'];
		$q_satuan = select_menu_konversi($menu_id);
		while ($r_satuan = mysql_fetch_array($q_satuan)) {
			$data[] = array(
					'satuan_id' => $r_satuan['satuan_id'],
					'satuan_name' => $r_satuan['satuan_name'], 
					'konversi_harga' => $r_satuan['konversi_harga']
					);
		}
		echo json_encode($data);
		break;

	case 'get_harge_konversi':
			$satuan_konversi = $_POST['satuan_konversi'];
			$i_menu_id = $_POST['menu_id'];
			$where_menu_id = "WHERE menu_id = '$i_menu_id' and satuan_konversi = '$satuan_konversi'";
			$konversi_harga = select_config_by('konversi_menu', 'konversi_harga', $where_menu_id);

			echo json_encode(intval($konversi_harga));	
			break;	


	case 'print':
		$transaction_id = $_GET['transaction_id'];
		header("Location: print.php?page=print_transaction&transaction_id=$transaction_id");
		break;

	
}
?>