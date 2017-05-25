<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/menu_stock_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Stock tahu");

$_SESSION['menu_active'] = 4;
$_SESSION['sub_menu_active'] = 20;
$cabang = $_SESSION['branch_id'];
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);

switch ($page) {
  case 'list':

    get_header($title);
    $where = '';
    $q_menu = select($where);
    $where = '';
    $r_branch = select_config('branches', $where);
    $where_branch = " where a.branch_id = '".$_SESSION['branch_id']."' ";
    $query = select($where_branch);
    $add_button = "menu_stock.php?page=form";
    include '../views/menu_stock/list.php';
    get_footer();
    break;

  // case 'form':
  //   get_header();
  //   $close_button = "menu_stock.php?page=list";
  //   $q_kategori = select_config('kategori', '');
  //   $q_satuan = select();
    
  //   $id = (isset($_GET['id'])) ? $_GET['id'] : null;
  //   if($id){
  //     $where_item_id = "where item_id = '$id'";
  //     $row = select_object_config('items', $where_item_id);
  //     $q_tabel_konversi = select_tabel_konversi($id);
  //     $action = "menu_stock.php?page=edit&id=$id";
  //   } else {

  //     //inisialisasi
  //     $row = new stdClass();

  //     $row->item_name = false;
  //     $row->satuan_utama = false;
  //     $row->item_kategori = false;
  //     $row->item_limit = false;
  //     $row->item_hpp_price = false;


  //     $action = "menu_stock.php?page=save";
  //   }
  //   include '../views/menu_stock/form.php';
  //   get_footer();
  //   break;

  case 'delete':

    $id = get_isset($_GET['id']);
    $where_item_id = "item_id = '$id'"; 
    delete_config('items', $where_item_id);

    header('Location: menu_stock.php?page=list&did=3');

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