<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/piutang_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucwords("List Piutang");
$title_ = ucwords("Pelunasan");

$_SESSION['menu_active'] = 5;
$_SESSION['sub_menu_active'] = 22;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
	case 'list':
		get_header($title);

		$query = select();
		include '../views/piutang/list.php';
		get_footer();
	break;
	case 'form':
		get_header($title_);
		$q_bank = select_config('banks','');
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		$code = (isset($_GET['code'])) ? $_GET['code'] : null;
		$where_kredit_id = "WHERE kredit_id = '$id'";
      	$transaction_piutang = select_config_by('kredit', 'transaction_piutang', $where_kredit_id);
		if(isset($_SESSION['i_tanggal'])!=null) {
			$tanggal = $_SESSION['i_tanggal'];
		} else {
			$tanggal = date('d-m-Y');
		}
		$close_button = "piutang.php?page=list";
		$action = "piutang.php?page=save&id=$id&&code=$code";
		include '../views/piutang/form_pelunasan.php';
		get_footer();
		break;
	case 'save':

		extract($_POST);

		$id = $_GET['id'];
		$code = $_GET['code'];
		$i_bayar = get_isset($i_bayar);
		$date = get_isset($date);
		$i_date = format_back_date3($date);
		$i_payment_method = get_isset($i_payment_method);
		$bank = '';
		$no_rek = '';
		$i_user_id = $_SESSION['user_id'];
		$i_branch_id = $_SESSION['branch_id'];


		if ($i_payment_method == 3) {
			$bank = $_POST['bank'];
			$no_rek = $_POST['no_rek'];
		}
			$data = "'',
					'$id',
					'$code',
					'$i_bayar',
					'$i_date',
					'$i_payment_method',
					'$bank',
					'$no_rek'
					";
			create_config('angsuran_kredit', $data);
			create_journal($code, "piutang.php?page=form$id=", 5, $i_bayar, $i_user_id, $i_branch_id, $i_payment_method, $bank,$no_rek);
			// $where_kredit_id = "WHERE kredit_id = '$id'";
			// $check_piutang = select_config_by('kredit', 'count(kredit_id)', $where_kredit_id);
			
		// header("Location: piutang.php?page=list&did=1");
	break;

	case 'edit':
	break;

	case 'delete':
	break;
}

?>
