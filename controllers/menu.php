<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/menu_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("menu");

$_SESSION['menu_active'] = 2;
$_SESSION['sub_menu_active'] = 18;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);

switch ($page) {
	case 'list':
		get_header($title);

		$query = select();
		$add_button = "menu.php?page=form";

		include '../views/menu/list.php';
		get_footer();
	break;

	case 'form':
		get_header();

		$close_button = "menu.php?page=list";
		$query_menu_kategori = select_menu_kategori();
		$q_satuan = select_config('satuan_menu','');
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;

		$add_button_item = "menu.php?page=form_item&menu_id=$id";

		if($id){

			$row = read_id($id);
			$query_recipe = select_recipe($id);
			$q_tabel_konversi = select_tabel_konversi($id);
			$action = "menu.php?page=edit&id=$id";
		} else{

			//inisialisasi
			$row = new stdClass();

			$row->menu_name = false;
	
			$row->menu_original_price = false;
			$row->menu_price = false;
			$row->menu_img = false;
			$row->menu_satuan = false;
			$action = "menu.php?page=save";
		}

		include '../views/menu/form.php';
		get_footer();
	break;

	case 'save':

		extract($_POST);
		$i_name = get_isset($i_name);

		$i_original_price = get_isset($i_original_price);
		$i_price = get_isset($i_price);
		$menu_satuan = get_isset($menu_satuan);
		$path = "../img/menu/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? time()."_".$_FILES['i_img']['name'] : "";

			$data = "'',
					'',
					'$i_name',
					'$i_original_price',
					'$i_price',
					'$i_img',
					'$menu_satuan'
					";
				create_config('menus', $data);
				if($i_img){
				move_uploaded_file($i_img_tmp, $path.$i_img);
				}
			header("Location: menu.php?page=list&did=1");
			echo $data;


	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		$i_menu_kategori = get_isset($i_menu_kategori);
		$i_original_price = get_isset($i_original_price);
		$i_price = get_isset($i_price);
		$menu_satuan = get_isset($menu_satuan);

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

					$data = " menu_name					= '$i_name',
								menu_kategori 			= '$i_menu_kategori',
								menu_original_price		= '$i_original_price',
								menu_price 				= '$i_price',
								menu_img 				= '$i_img',
								menu_satuan				= '$menu_satuan'

					";
				}
			}

			}else{
				$data = " menu_name 			= '$i_name',
							menu_kategori 		= '$i_menu_kategori',
							menu_original_price = '$i_original_price',
							menu_price 			= '$i_price',
							menu_satuan			= '$menu_satuan'
					";
			}

			// echo $data;
			update($data, $id);
			header('Location: menu.php?page=list&did=2');



	break;

	case 'delete':

		$id = get_isset($_GET['id']);

		$path = "../img/menu/";
		$get_img_old = get_img_old($id);
					if($get_img_old){
						if(file_exists($path.$get_img_old)){
							unlink($path . $get_img_old);
						}
					}
		delete($id);

		header('Location: menu.php?page=list&did=3');

	break;

	case 'tambah_menu_recipe':
		$menu_id 	= $_GET['menu_id'];
		$where_menu_id = '$id';
     	$menu_name = select_config_by('menus', 'menu_name', $where_menu_id);
		$recipe_id 	= (isset($_GET['recipe_id'])) ? $_GET['recipe_id'] : null;
		$q_item = select_config('items', '');
		$q_satuan = select_config('satuan', '');

		if ($recipe_id) {
			$action = "menu.php?page=edit_recipes";
			$where_menu_recipe_id = "where menu_recipe_id = '$recipe_id'";
			$row = select_object_config('menu_recipes', $where_menu_recipe_id);

		} else {
			$action = "menu.php?page=save_recipes";
			$row = new stdClass();
			$where_menu_id = $menu_id;
			$row->item_id = false;
			$row->item_qty = false;
			$row->satuan_id = false;
		} 
	
		include '../views/menu/popmodal_menu_recipe.php';

		break;

	case 'save_recipes':
			$menu_id 	= $_POST['menu_id'];
			$item_id 	= $_POST['item_id'];
			$item_qty 	= $_POST['item_qty'];
			$satuan_id = $_POST['satuan_id'];
			$data 		= "'',
						 '$menu_id',
						 '$item_id',
						 '$item_qty',
						 '$satuan_id'";
			create_config('menu_recipes', $data);
			echo $data;
			// header("Location: menu.php?page=form&id=$menu_id");
			break;	

	case 'edit_recipes':

			$menu_id 			= $_POST['menu_id'];
			$menu_recipe_id 	= $_POST['menu_recipe_id'];
			$item_id			= $_POST['item_id'];
			$item_qty 			= $_POST['item_qty'];
			$satuan_id         	= $_POST['satuan_id'];
			$data 				= " item_id = '$item_id',
									item_qty = '$item_qty',
									satuan_id = '$satuan_id'
									";
			$where_menu_recipe_id = "menu_recipe_id = '$menu_recipe_id'";

			update_config2('menu_recipes', $data, $where_menu_recipe_id);
			header("Location: menu.php?page=form&id=$menu_id");
			break;		

	case 'delete_recipes':

			$id 	= get_isset($_GET['id']);

			delete_item($id);
			header("Location: menu.php?page=form&id=$menu_id");
			break;

	case 'delete_konversi':
		$id  = $_GET['menu_id'];
		$konversi_id = get_isset($_GET['id']);
		$where_konversi_id = "konversi_id = '$konversi_id'";

		delete_config('konversi_menu', $where_konversi_id);
		header("location: menu.php?page=form&id=$id");
		break;

		case 'pop_modal_konversi':
		$id  = $_GET['id'];
		$where_menu_id = "WHERE menu_id = '$id'";
		$menu_satuan = select_config_by('menus', 'menu_satuan', $where_menu_id);
		$konversi_id = (isset($_GET['konversi_id'])) ? $_GET['konversi_id'] : null;

		$and_satuan_konversi = "";

		if ($konversi_id!=null) {
			$where_konversi_id = "where konversi_id = '$konversi_id'";
			$row = select_object_config('konversi_menu', $where_konversi_id);

			$and_satuan_konversi = " and satuan_id ='$row->satuan_konversi'";

			$action = "menu.php?page=edit_konversi&id=$konversi_id";
		} else {
				$row = new stdClass();

			// $row->menu_satuan = false;
			$row->jumlah = false;
			$row->satuan_konversi = false;
			$row->jumlah_satuan_konversi = false;
			$row->konversi_harga = false;
			$action = "menu.php?page=save_konversi";
		}	

		$where_menu_id = "WHERE menu_id = '$id'";
     	$menu_name = select_config_by('menus', 'menu_name', $where_menu_id);
      	$where_satuan_id = "WHERE satuan_id = '$menu_satuan'";
      	$satuan_name = select_config_by('satuan_menu', 'satuan_name', $where_satuan_id);
      	$q_satuan = select_config('satuan_menu','');

      	$where_satuan_yang_sudah_dipilih = "where satuan_id != '$menu_satuan'";
      	$and_satuan_yang_sudah_dipilih = "";
      	$q_satuan_yang_sudah_dipilih = select_config('konversi_menu', $where_menu_id);

     
      	while ($r_satuan_yang_sudah_dipilih = mysql_fetch_array($q_satuan_yang_sudah_dipilih)) {

      		$satuan_konversi_yg_sudah_dipilih = $r_satuan_yang_sudah_dipilih['satuan_konversi'];

      		if ($satuan_konversi_yg_sudah_dipilih != null && $satuan_konversi_yg_sudah_dipilih != $row->satuan_konversi) {
      			$and_satuan_yang_sudah_dipilih = " and satuan_id != '$satuan_konversi_yg_sudah_dipilih'";      		
      			$where_satuan_yang_sudah_dipilih = $where_satuan_yang_sudah_dipilih.$and_satuan_yang_sudah_dipilih;
      		}

      	}


      	$q_konversi = select_konversi($where_satuan_yang_sudah_dipilih);

      	include '../views/menu/pop_modal_konversi.php';
		break;

		case 'save_konversi':
		$id  = $_POST['menu_id'];

		extract($_POST);
		$menu_id = get_isset($menu_id);
		$menu_satuan = get_isset($menu_satuan);
		$qty_utama = get_isset($qty_utama);
		$satuan_konversi = get_isset($satuan_konversi);
		$qty_konversi = get_isset($qty_konversi);
		$konversi_harga = get_isset($konversi_harga);

		$data = "'',
				 '$menu_id',
				 '$menu_satuan',
				 '$qty_utama',
				 '$satuan_konversi',
				 '$qty_konversi',
				 '$konversi_harga'
				";

		create_config('konversi_menu', $data);
		var_dump($data);
		// header("location: menu.php?page=form&id=$id");
		break;

		case 'edit_konversi':
		$id  = $_POST['menu_id'];
		
		extract($_POST);
		$konversi_id = get_isset($_GET['id']);
		$menu_id = get_isset($menu_id);
		$menu_satuan = get_isset($menu_satuan);
		$qty_utama = get_isset($qty_utama);
		$satuan_konversi = get_isset($satuan_konversi);
		$qty_konversi = get_isset($qty_konversi);
		$konversi_harga = get_isset($konversi_harga);

		$data = "
				 menu_id = '$menu_id',
				 satuan_utama = '$menu_satuan',
				 jumlah = '$qty_utama',
				 satuan_konversi = '$satuan_konversi',
				 jumlah_satuan_konversi = '$qty_konversi',
				 konversi_harga = '$konversi_harga'
				";

		$where_konversi_id = "konversi_id = '$konversi_id'";	
		update_config2("konversi_menu", $data, $where_konversi_id);
		// var_dump($data);
		header("location: menu.php?page=form&id=$id");
		break;

}

?>
