<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/member_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Member");

$_SESSION['menu_active'] = 2;
$_SESSION['sub_menu_active'] = 44;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);

switch ($page) {
	case 'list':
		get_header($title);

		$query = select();
		$add_button = "member.php?page=form";

		include '../views/member/list.php';
		get_footer();
	break;

	case 'form':
		get_header();
		
		$close_button = "member.php?page=list";

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){
			$row = read_id($id);
			$action = "member.php?page=edit&id=$id";
		} else{

			//inisialisasi
			$row = new stdClass();

			$row->member_name = false;
			$row->member_phone = false;
			$row->member_email = false;
			$row->member_address = false;

		$action = "member.php?page=save";
		}

		include '../views/member/form.php';
		get_footer();
	break;

	case 'save':

		extract($_POST);

		$i_name = get_isset($i_name);
		$i_telp = get_isset($i_telp);
		$i_email = get_isset($i_email);
		$i_address = get_isset($i_address);

		$data = "'',
					'$i_name',
					'$i_telp',
					'$i_address',
					'$i_email'
			";

			create($data);

			header("Location: member.php?page=list&did=1");


	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		$i_telp = get_isset($i_telp);
		$i_email = get_isset($i_email);
		$i_address = get_isset($i_address);

			$data = " member_name = '$i_name',
						member_phone = '$i_telp',
						member_address = '$i_address',
						member_email = '$i_email'
						";
			echo $data;
			update_member($data, $id);
			header('Location: member.php?page=list&did=2');
	break;

	case 'delete':

		$id = get_isset($_GET['id']);

		delete($id);

		header('Location: member.php?page=list&did=3');

	break;
}

?>
