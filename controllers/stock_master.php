<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/stock_master_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("ITEM STOCK");

$_SESSION['menu_active'] = 2;
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
		$q_satuan = select();
		
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){
			$where_item_id = "where item_id = '$id'";
			$row = select_object_config('items', $where_item_id);
			$q_tabel_konversi = select_tabel_konversi($id);
			$action = "stock_master.php?page=edit&id=$id";
		} else {

			//inisialisasi
			$row = new stdClass();

			$row->item_name = false;
			$row->satuan_utama = false;
			$row->item_kategori = false;
			$row->item_limit = false;
			$row->item_hpp_price = false;


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
		$satuan_utama = get_isset($satuan_utama);
		$date = time();

		$path = "../img/menu/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? time()."_".$_FILES['i_img']['name'] : "";

		$data = "'',
					'$i_name',
					'$satuan_utama',
					'$i_kategori',
					'$i_limit',
					'$i_hpp_price',
					'$i_price',
					'$i_img'
					";
					create_config('items', $data);
					// echo $data;
		if($i_img){
				move_uploaded_file($i_img_tmp, $path.$i_img);
			}
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
		$satuan_utama = get_isset($satuan_utama);
		$date = time();
		// echo $i_limit;
		$path = "../img/menu/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? time()."_".$_FILES['i_img']['name'] : "";
		if($i_img){
			if($i_img){
			if(move_uploaded_file($i_img_tmp, $path.$i_img)){
				$get_img_old = get_img_old($id);
				if($get_img_old){
					if(file_exists($path.$get_img_old)){
						unlink($path . $get_img_old);
						}
					}

		$data 	= 	"item_name = '$i_name',
					satuan_utama = '$satuan_utama',	
					item_kategori = '$i_kategori',
					item_limit = '$i_limit',
					item_hpp_price = '$i_hpp_price'
					item_img = '$i_img'
					";
						}
					}
				} else {
		$data 	= 	"item_name = '$i_name',
					satuan_utama = '$satuan_utama',	
					item_kategori = '$i_kategori',
					item_limit = '$i_limit',
					item_hpp_price = '$i_hpp_price'";			
				}

		$where_item_id = "item_id = '$id'";	
		update_config2("items", $data, $where_item_id);
		// var_dump($data);
		if($i_img){
				move_uploaded_file($i_img_tmp, $path.$i_img);
			}
		header('Location: stock_master.php?page=list&did=2');
		break;

		case 'delete':

		$id = get_isset($_GET['id']);
		$where_item_id = "item_id = '$id'";	
		delete_config('items', $where_item_id);

		header('Location: stock_master.php?page=list&did=3');

		break;

		case 'delete_konversi':
		$id  = $_GET['item_id'];
		$konversi_id = get_isset($_GET['id']);
		$where_konversi_id = "konversi_id = '$konversi_id'";

		delete_config('konversi_item', $where_konversi_id);
		header("location: stock_master.php?page=form&id=$id");
		break;

		case 'pop_modal_konversi':
		$id  = $_GET['id'];
		$where_item_id = "WHERE item_id = '$id'";
		$satuan_utama = select_config_by('items', 'satuan_utama', $where_item_id);
		$konversi_id = (isset($_GET['konversi_id'])) ? $_GET['konversi_id'] : null;

		$and_satuan_konversi = "";

		if ($konversi_id!=null) {
			$where_konversi_id = "where konversi_id = '$konversi_id'";
			$row = select_object_config('konversi_item', $where_konversi_id);

			$and_satuan_konversi = " and satuan_id ='$row->satuan_konversi'";

			$action = "stock_master.php?page=edit_konversi&id=$konversi_id";
		} else {
				$row = new stdClass();

			// $row->satuan_utama = false;
			$row->jumlah = false;
			$row->satuan_konversi = false;
			$row->jumlah_satuan_konversi = false;
			$action = "stock_master.php?page=save_konversi";
		}	

		$where_item_id = "WHERE item_id = '$id'";
     	$item_name = select_config_by('items', 'item_name', $where_item_id);
      	$where_satuan_id = "WHERE satuan_id = '$satuan_utama'";
      	$satuan_name = select_config_by('satuan', 'satuan_name', $where_satuan_id);
      	$q_satuan = select_config('satuan','');

      	$where_satuan_yang_sudah_dipilih = "where satuan_id != '$satuan_utama'";
      	$and_satuan_yang_sudah_dipilih = "";
      	$q_satuan_yang_sudah_dipilih = select_config('konversi_item', $where_item_id);

     
      	while ($r_satuan_yang_sudah_dipilih = mysql_fetch_array($q_satuan_yang_sudah_dipilih)) {

      		$satuan_konversi_yg_sudah_dipilih = $r_satuan_yang_sudah_dipilih['satuan_konversi'];

      		if ($satuan_konversi_yg_sudah_dipilih != null && $satuan_konversi_yg_sudah_dipilih != $row->satuan_konversi) {
      			$and_satuan_yang_sudah_dipilih = " and satuan_id != '$satuan_konversi_yg_sudah_dipilih'";      		
      			$where_satuan_yang_sudah_dipilih = $where_satuan_yang_sudah_dipilih.$and_satuan_yang_sudah_dipilih;
      		}

      	}


      	$q_konversi = select_konversi($where_satuan_yang_sudah_dipilih);

      	include '../views/stock_master/pop_modal_konversi.php';
		break;

		case 'save_konversi':
		$id  = $_POST['item_id'];

		extract($_POST);
		$item_id = get_isset($item_id);
		$satuan_utama = get_isset($satuan_utama);
		$qty_utama = get_isset($qty_utama);
		$satuan_konversi = get_isset($satuan_konversi);
		$qty_konversi = get_isset($qty_konversi);

		$data = "'',
				 '$item_id',
				 '$satuan_utama',
				 '$qty_utama',
				 '$satuan_konversi',
				 '$qty_konversi'
				";

		create_config('konversi_item', $data);
		header("location: stock_master.php?page=form&id=$id");
		break;

		case 'edit_konversi':
		$id  = $_POST['item_id'];
		
		extract($_POST);
		$konversi_id = get_isset($_GET['id']);
		$item_id = get_isset($item_id);
		$satuan_utama = get_isset($satuan_utama);
		$qty_utama = get_isset($qty_utama);
		$satuan_konversi = get_isset($satuan_konversi);
		$qty_konversi = get_isset($qty_konversi);

		$data = "
				 item_id = '$item_id',
				 satuan_utama = '$satuan_utama',
				 jumlah = '$qty_utama',
				 satuan_konversi = '$satuan_konversi',
				 jumlah_satuan_konversi = '$qty_konversi'
				";

		$where_konversi_id = "konversi_id = '$konversi_id'";	
		update_config2("konversi_item", $data, $where_konversi_id);
		header("location: stock_master.php?page=form&id=$id");
		break;

}
?>