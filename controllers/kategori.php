<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/kategori_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("KATEGORI ITEM");

$_SESSION['menu_active'] = 1;
$_SESSION['sub_menu_active'] = 18;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
  case 'list':
    get_header($title);
    $query = select();
    $add_button = "kategori.php?page=form";
    include '../views/kategori/kategori_list.php';
    get_footer();
    break;

  case 'form':
    get_header();
    $close_button = "kategori.php?page=list";
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $where_kategori_id = "WHERE kategori_id = '$id'";
    $q_kategori_ket = select_config('kategori_keterangan', $where_kategori_id);
    if($id){
      $row = read_id($id);
      $action = "kategori.php?page=edit&id=$id";
      } else{
      //inisialisasi
      $row = new stdClass();
      $row->kategori_id = false;
      $row->kategori_name = false;
      $action = "kategori.php?page=save";
      }
      include '../views/kategori/kategori_form.php';
      get_footer();
    break;

  case 'save':
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    extract($_POST);

    $kategori_name = get_isset($kategori_name);
    $data = "'',
          '$kategori_name'";
    create_kategori($data);
    $id = mysql_insert_id();
    header("Location: kategori.php?page=list&did=1");
    break;

  case 'delete':
    $id = get_isset($_GET['id']);
    $where_kategori_id = "kategori_id = '$id'";    
    delete_config('kategori', $where_kategori_id);
    header('Location: kategori.php?page=list&did=3');
    break;

  case 'edit':

    extract($_POST);

    $id = get_isset($_GET['id']);
    $kategori_name = get_isset($kategori_name);
    $data = " kategori_name = '$kategori_name'";
    update_kategori($data,$id);

    header("Location: kategori.php?page=list&did=2");
    break;
}

 ?>
