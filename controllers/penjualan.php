<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/penjualan_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Penjualan");
$item = ucfirst("ITEM");

$_SESSION['menu_active'] = 3;
$_SESSION['sub_menu_active'] = 3;
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
		$i_menu_id = $_POST['i_menu_id'];
		$where_menu_id =  "where menu_id = '$i_menu_id'";
 		$q_menu = select_config('menus', $where_menu_id);
		$r_menu = mysql_fetch_array($q_menu);
		$data = array(
						'menu_id' => $r_menu['menu_id'],
						'menu_name' => $r_menu['menu_name'],
						'menu_price' => $r_menu['menu_price'],
						'menu_img' => $r_menu['menu_img'], );
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

		$i_total   = $i_qty*$i_price;

		$_SESSION['i_member_id'] = $i_member_id;
		$_SESSION['i_tanggal'] = $i_tanggal;
		$_SESSION['i_branch_id'] = $i_branch_id;

		$where_menu_id = "WHERE menu_id = '$i_menu_id'";
		$check_keranjang = select_config_by('keranjang', 'count(*)', $where_menu_id);
		if ($check_keranjang==0) {
			$data = "'',
				 '$transaction_id',
				 '$i_menu_id',
				 '$i_price',
				 '$i_qty',
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

		if ($jns_bayar!=1) {
			$bank = $_POST['bank'];
			$no_rek = $_POST['no_rek'];
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
				'$no_rek'
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
								'".$r_keranjang['total']."'
								";

				create_config('transaction_details', $data_detail);
		}

		$where_transaction_id_ = "transaction_id = '$transaction_id_'";
		delete_config('keranjang',$where_transaction_id_);

		$int_transaction = intval($transaction_id_);
		echo json_encode($int_transaction);
	break;

	case 'delete':
		$id = get_isset($_GET['id']);
    	$where_keranjang_id = "keranjang_id = '$id'";
    	delete_config('keranjang', $where_keranjang_id);
    	header('Location: penjualan.php?page=list&did=3');
	break;

	case 'print':
		$transaction_id = $_GET['transaction_id'];
		header("Location: print.php?page=print_transaction&transaction_id=$transaction_id");
		break;

}
?>
