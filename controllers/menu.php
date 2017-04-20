<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/menu_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("menu");

$_SESSION['menu_active'] = 2;
$_SESSION['sub_menu_active'] = 43;
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
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;

		$add_button_item = "menu.php?page=form_item&menu_id=$id";

		if($id){

			$row = read_id($id);
			$query_recipe = select_recipe($id);
			$action = "menu.php?page=edit&id=$id";
		} else{

			//inisialisasi
			$row = new stdClass();

			$row->menu_name = false;
			$row->menu_kategori=false;
			$row->menu_original_price = false;
			$row->menu_price = false;
			$row->menu_img = false;
			$action = "menu.php?page=save";
		}

		include '../views/menu/form.php';
		get_footer();
	break;

	case 'save':

		extract($_POST);
		$i_name = get_isset($i_name);
		$i_menu_kategori = get_isset($i_menu_kategori);
		$i_original_price = get_isset($i_original_price);
		$i_price = get_isset($i_price);
		$path = "../img/menu/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? time()."_".$_FILES['i_img']['name'] : "";

			$data = "'',
					'$i_menu_kategori',
					'$i_name',
					'$i_original_price',
					'$i_price',
					'$i_img'";
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
								menu_img 				= '$i_img'

					";
				}
			}

			}else{
				$data = " menu_name 			= '$i_name',
							menu_kategori 		= '$i_menu_kategori',
							menu_original_price = '$i_original_price',
							menu_price 			= '$i_price'
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
		$recipe_id 	= (isset($_GET['recipe_id'])) ? $_GET['recipe_id'] : null;
		$q_item = select_config('items', '');

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
		} 
		
		include '../views/menu/popmodal_menu_recipe.php';

		break;

	case 'save_recipes':
			$menu_id 	= $_POST['menu_id'];
			$item_id 	= $_POST['item_id'];
			$item_qty 	= $_POST['item_qty'];
			$data 		= "'',
						 '$menu_id',
						 '$item_id',
						 '$item_qty'";
			create_config('menu_recipes', $data);
			echo $data;
			// header("Location: menu.php?page=form&id=$menu_id");
			break;	

	case 'edit_recipes':

			$menu_id 			= $_POST['menu_id'];
			$menu_recipe_id 	= $_POST['menu_recipe_id'];
			$item_id			= $_POST['item_id'];
			$item_qty 			= $_POST['item_qty'];
			$data 				= " item_id = '$item_id',
									item_qty = '$item_qty'
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
}

?>
