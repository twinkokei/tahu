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
		// if($_SESSION['journal_debit' => ,
		// 	'journal_credit' => ,
		// 	'journal_piutang']==1 || $_SESSION['user_type_id']==2){ => ,
		// 	'journal_hutang' => ,
		// 'journal_date' =>
		// 	$where_branch = "";
		// } else {
		// 	$where_branch = " and branch_id = '".$_SESSION['branch_id']."' ";
		// }
		$q_piutang = select_piutang();		
		include '../views/layout/home.php';
		get_footer();
	break;

	case 'Highcharts':
		$q_journal = select_journal();
		while ($r_journal = mysql_fetch_array($q_journal)) {
				$data[] = array(
					'journal_id' 			=> $r_journal['journal_id'],
					'journal_type_id' => $r_journal['journal_type_id'],
					'journal_date' 		=> $r_journal['s_journal_date'],
					'journal_debit' 	=> $r_journal['penjualan'],
					'journal_credit' 	=> $r_journal['pembelian'],
					'journal_piutang' => $r_journal['journal_piutang'],
					'journal_hutang' => $r_journal['journal_hutang']
				 );
			}
		echo json_encode($data);
		break;
}
?>