<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/produksi_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Produksi");
$item = ucfirst("ITEM");

$_SESSION['menu_active'] = 2;
$_SESSION['sub_menu_active'] = 46;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
	case 'list':
		get_header();

		$close_button = "home.php";
	
		$where = '';
		$query_menu = select_menu();
		$query_branch = select_branch();
		$query_satuan = select_satuan();

		$save_produksi = "produksi.php?page=save_produksi";

		$transaction_id_new = select_config_by('transactions', 'max(transaction_id)+1', $where);
		if ($transaction_id_new==null) {$transaction_id_new = 1;}
		$transaction_id = (isset($_GET['transaction_id'])) ? $_GET['transaction_id'] : $transaction_id_new;

		if(isset($_SESSION['i_tanggal'])!=null) {
			$tanggal = $_SESSION['i_tanggal'];
		} else {
			$tanggal = date('d-m-Y');
		}
		$action = "produksi.php?page=save_produksi";	
		include '../views/produksi/form.php';
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

	case 'save_produksi':
		extract($_POST);

		$i_branch_id = get_isset($i_branch_id);
		$tanggal = date("Y-m-d h:m:s");
		$i_menu_id = get_isset($i_menu_id);
		$i_qty = get_isset($i_qty);
		$i_code = '1'.time();
			$data = "'',
					 '$i_menu_id',
					 '$i_branch_id',
					 '$tanggal',
					 '$i_code',
					 '$satuan_id',
					 '$i_qty'
				";
		// create_config("produksi", $data);
		$data_id = mysql_insert_id();
		echo $data;
		$where_menu_id = "WHERE menu_id = $i_menu_id";
		$cek_menu_stock = select_config_by('menu_stock', 'menu_id', $where_menu_id);

		if ($cek_menu_stock == null){
			$datamenu = "'',
						 '$i_menu_id',
						 '$i_branch_id',
						 '$i_qty'
						 ";
		// create_config("menu_stock", $datamenu);
		} else{
			update_menu_stock($i_menu_id, $i_branch_id, $i_qty);
		}
		$where_menu_id = "WHERE menu_id = '$i_menu_id'";
		$q_menu_recipe = select_config('menu_recipes', $where_menu_id);
		while ($r_menu_recipe = mysql_fetch_array($q_menu_recipe)) {
			$item_qty = $r_menu_recipe['item_qty'];
			$item_id = $r_menu_recipe['item_id'];
			update_item_stock($item_id, $i_branch_id, $item_qty);
			}
		// update_pengurangan();

		echo $data;
		// header("Location: produksi.php?page=list&did=1");
	break;

	case 'delete':
		$id = get_isset($_GET['id']);
    	$where_keranjang_id = "keranjang_id = '$id'";    
    	delete_config('keranjang', $where_keranjang_id);
    	header('Location: produksi.php?page=list&did=3');
	break;

	case 'print':
		$transaction_id = $_GET['transaction_id'];
		header("Location: print.php?page=print_transaction&transaction_id=$transaction_id");
		break;

}
?>