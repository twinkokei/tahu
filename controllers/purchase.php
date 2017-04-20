<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/purchase_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Pembelian");

$_SESSION['menu_active'] = 4;
$_SESSION['sub_menu_active'] = 22;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
	case 'list':
		get_header();

		$close_button = "http://localhost/tahu-master/home.php";
		$action = "purchase.php?page=save_add_item";
		$where = '';
		$q_kategori = select_config('kategori', '');
		$query_user = select_user();
		$query_supplier = select_supplier();
		$query_item = select_item();
		$query_branch = select_branch();
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
			$row = select_object_config('items', $where_item_id);
			$q_satuan = select_satuan_konversi($item_id);
			$row->purchase_date = format_date($row->purchase_date);

			$action = "purchase.php?page=edit&id=$id";
		} else{

			//inisialisasi
			$row = new stdClass();

			$row->purchase_date = format_date(date("Y-m-d"));
			$row->item_id = false;
			$row->purchase_price = false;
			$row->purchase_qty = false;
			$row->purchase_total = false;
			$row->user_id = false;
			$row->supplier_id = false;
			$row->branch_id = false;
			$row->item_kategori = false;
			$row->item_hpp_price = false;
			$row->item_img = false;
			$row->satuan_konversi = false;

			$action = "purchase.php?page=save";
		}

		include '../views/purchase/form.php';
		get_footer();
	break;

	case 'save':

		extract($_POST);


		$i_date = get_isset($i_date);
		$i_date = format_back_date($i_date);
		$i_item_id = get_isset($i_item_id);
		$i_price = get_isset($i_price);
		$i_qty = get_isset($i_qty);
		$i_total = get_isset($i_total);
		$i_user = $_SESSION['user_id'];
		$i_supplier = get_isset($i_supplier);
		$i_branch_id = get_isset($i_branch_id);
		$i_code = '1'.time();
		$i_satuan = get_isset($i_satuan);


		$get_item_name = get_item_name($i_item_id);

		$data = "'',
					'$i_date',
					'$i_code',
					'$i_item_id',
					'$i_price',
					'$i_qty',
					'$i_total',
					'$i_user',
					'$i_supplier',
					'$i_branch_id',
					'$i_satuan'
					";

		create($data);
		$qty_real=$i_qty;			
		if ($i_satuan!=null) {
			$qty_real = konversi_ke_satuan_utama($i_item_id, $i_satuan, $i_qty);
			echo $qty_real;
		}
		echo $i_satuan;

		$data_id = mysql_insert_id();
		$where_item_id_branch_id = "where item_id = '$i_item_id' and branch_id = '$i_branch_id'";

		$cek_stok = select_config_by('item_stocks', 'count(*)', $where_item_id_branch_id);
		if ($cek_stok > 0) {
			add_stock($i_item_id, $qty_real, $i_branch_id);
		}
		else{

			$data_i = "'',
					 '$i_item_id',
					 '$i_qty',
					 '$i_branch_id'
					";

		create_config('item_stocks', $data_i);
		}
		// simpan jurnal
		create_journal($data_id, "purchase.php?page=form&id=", 2, $i_harga, $i_user_id, $i_branch_id);
		unset($_SESSION['item_id']);
		header("Location: purchase.php?page=list&did=1");


	break;

	case 'delete':

		$id = get_isset($_GET['id']);

		delete($id);

		header('Location: purchase.php?page=list&did=3');

	break;

	case 'save_add_item':

	extract($_POST);

    $i_stock = get_isset($i_stock);
    $i_kategori = get_isset($i_kategori);
    $i_limit = get_isset($i_limit);
    $i_hpp_price = get_isset($i_hpp_price);
    $date = time();
    $path = "../img/menu/";
	$i_img_tmp = $_FILES['i_img']['tmp_name'];
	$item_img = ($_FILES['i_img']['name']) ? time()."_".$_FILES['i_img']['name'] : "";

    $data_s = "'',
          '$i_stock',
          '$i_kategori',
          '$i_limit',
          '$i_hpp_price',
          '$i_img'
      	";
    	create_config('items',$data_s);
    var_dump($data_s);
	if($i_img){
			move_uploaded_file($i_img_tmp, $path.$i_img);
		}
    $item_id = mysql_insert_id();
    $_SESSION['item_id'] = $item_id;

    header('location: purchase.php');
	break;

	case 'get_satuan':
		$item_id = $_POST['item_id'];
		$q_item_satuan = select_item_satuan($item_id);
		while ($r_item_satuan = mysql_fetch_array($q_item_satuan)) {
			$data[] = array(
				'satuan_id' => $r_item_satuan['satuan_id'],
				'satuan_name' => $r_item_satuan['satuan_name']
			 );
		}
		echo json_encode($data);

		break;

}

?>
