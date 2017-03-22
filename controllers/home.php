<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/home_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Home");

$_SESSION['menu_active'] = '';

switch ($page) {

	case 'list':
			get_header($title);
		if($_SESSION['user_type_id']==1 || $_SESSION['user_type_id']==2){
			$where_branch = "";
		} else {
			$where_branch = " and branch_id = '".$_SESSION['branch_id']."' ";
		}
		include '../views/layout/home.php';
		get_footer();
	break;

}

?>
