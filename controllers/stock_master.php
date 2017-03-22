<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/stock_master_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("STOCK");

$_SESSION['menu_active'] = 1;
$_SESSION['sub_menu_active'] = 10;
$cabang = $_SESSION['branch_id'];
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);

switch ($page) {
	case 'list':

		get_header($title);
		$where = '';
		$q_all_stock = select_config('items', $where);
		$where = '';
		$r_branch = select_config('branches', $where);
		$add_button = "stock_master.php?page=form";
		include '../views/stock_master/list.php';
		get_footer();
		break;

	case 'form':
		get_header();
		$close_button = "stock_master.php?page=list";
		$q_kategori = select_config('kategori', '');
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){
			$where_item_id = "where item_id = '$id'";
			$row = select_object_config('items', $where_item_id);

			$action = "stock_master.php?page=edit&id=$id";
		} else {

			//inisialisasi
			$row = new stdClass();

			$row->item_name = false;
			$row->item_kategori = false;
			$row->item_limit = false;
			$row->item_hpp_price = false;
			$row->item_price = false;

			$action = "stock_master.php?page=save";
		}
		include '../views/stock_master/form.php';
		get_footer();
		break;

		case 'save':

		extract($_POST);

		$i_name = get_isset($i_name);
		$i_kategori = get_isset($i_kategori);
		$i_limit = get_isset($i_limit);
		$i_hpp_price = get_isset($i_hpp_price);
		$i_price = get_isset($i_price);
		$date = time();

		$data = "'',
					'$i_name',
					'$i_kategori',
					'$i_limit',
					'$i_hpp_price',
					'$i_price'
			";

		create_config('items', $data);
		var_dump($data);
		header("Location: stock_master.php?page=list&did=1");
		break;

		case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		$i_kategori = get_isset($i_kategori);
		$i_limit = get_isset($i_limit);
		$i_hpp_price = get_isset($i_hpp_price);
		$i_price = get_isset($i_price);

		$date = time();

		echo $i_limit;
		$data = "item_name = '$i_name',
					item_kategori = '$i_kategori',
					item_limit = '$i_limit',
					item_hpp_price = '$i_hpp_price',
					item_price = '$i_price'
			";
			
		$where_item_id = "item_id = '$id'";	
		update_config2('items', $data, $where_item_id);

		var_dump($data);
		header('Location: stock_master.php?page=list&did=2');
		break;

		case 'delete':

		$id = get_isset($_GET['id']);

		$where_item_id = "item_id = '$id'";	
		delete_config('items', $where_item_id);

		header('Location: stock_master.php?page=list&did=3');

		break;
}

?>
