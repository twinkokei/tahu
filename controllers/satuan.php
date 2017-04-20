<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/satuan_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Stock Satuan");

$_SESSION['menu_active'] = 2;
$_SESSION['sub_menu_active'] = 45;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
  case 'list':
    get_header($title);
    $query = select();
    $add_button = "satuan.php?page=form";
    include '../views/satuan/satuan_list.php';
    get_footer();
    break;

  case 'form':
    get_header();
    $close_button = "satuan.php?page=list";
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $where_satuan_id = "WHERE satuan_id = '$id'";
    $q_satuan_ket = select_config('satuan_keterangan', $where_satuan_id);
    if($id){
      $row = read_id($id);
      $action = "satuan.php?page=edit&id=$id";
      } else{
      //inisialisasi
      $row = new stdClass();
      $row->satuan_id = false;
      $row->satuan_name = false;
      $action = "satuan.php?page=save";
      }
      include '../views/satuan/satuan_form.php';
      get_footer();
    break;

  case 'save':
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    extract($_POST);

    $satuan_name = get_isset($satuan_name);
    $data = "'',
          '$satuan_name'";
    create_satuan($data);
    $id = mysql_insert_id();
    header("Location: satuan.php?page=list&did=1");
    break;

  case 'delete':
    $id = get_isset($_GET['id']);
    $where_satuan_id = "satuan_id = '$id'";    
    delete_config('satuan', $where_satuan_id);
    header('Location: satuan.php?page=list&did=3');
    break;

  case 'edit':

    extract($_POST);

    $id = get_isset($_GET['id']);
    $satuan_name = get_isset($satuan_name);
    $data = " satuan_name = '$satuan_name'";
    update_satuan($data,$id);

    header("Location: satuan.php?page=list&did=2");
    break;
}

 ?>
