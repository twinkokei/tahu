<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/menu_stock_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Menu Stock");

$_SESSION['menu_active'] = 2;
$_SESSION['sub_menu_active'] = 47;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
$s_cabang = $_SESSION['branch_id'];
$branch_active = get_branch($s_cabang);

switch ($page) {
  case 'list':
  get_header($title);
	$where_branch = " where a.branch_id = '".$_SESSION['branch_id']."' ";
  $query = select($where_branch);
  include '../views/menu_stock/menu_stock_list.php';
  get_footer();
    break;
    // case 'form':
  		// get_header($title);
  		// $close_button = "menu_stock.php?page=list";
  		// $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    //   $branch_id = (isset($_GET['branch_id'])) ? $_GET['branch_id'] : null;
    //   $row = read_id($id,$branch_id);
    //   $action = "menu_stock.php?page=edit";
  		// include '../views/menu_stock/menu_stock_form.php';
  		// get_footer();
  		// break;

	case 'delete':
		$id = get_isset($_GET['id']);
    $branch_id = get_isset($_GET['branch_id']);
		delete($id,$branch_id);
		header('Location: menu_stock.php?page=list&did=3');
		break;

  case 'edit':
    $item_id = $_POST['i_item_id'];
    $i_branch_id = $_POST['i_branch_id'];
    $i_item_qty_lama = $_POST['item_qty_lama'];
    $i_item_selisih = $_POST['edit_item_qty'];
    $i_item_qty_baru = $_POST['item_qty_baru'];
    $tanggal = date("Y-m-d h:m:s");
      $data_penyesuaian = "'',
                          '".$_SESSION['user_id']."',
                          '$i_branch_id',
                          '$tanggal',
                          '$item_id',
                          '$i_item_qty_lama',
                          '$i_item_selisih'
                          ";
    create_config("menu_stock_cabang",$data_penyesuaian);
    update_stok($i_item_qty_baru, $i_branch_id, $item_id);
		header('Location: menu_stock.php?page=list&id=3');
		break;

    case 'popmodal':
      $menu_id = get_isset($_GET['menu_id']);
      $branch_id = get_isset($_GET['branch_id']);
      $q_menu = select_menu_stock($menu_id);
      $query = select_detail_recipe($menu_id);
      include '../views/menu_stock/popmodal.php';
      break;
}


?>
