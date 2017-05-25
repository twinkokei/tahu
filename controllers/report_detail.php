<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/report_detail_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Laporan Detail");

$_SESSION['menu_active'] = 7;
$_SESSION['sub_menu_active'] = 28;

$s_cabang = $_SESSION['branch_id'];
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
$tanggal = new_date();
$tahun = date("Y", strtotime($tanggal));

switch ($page) {

	case 'list':
		get_header();
		if ($_SESSION['branch_id'] == 3) {
				$where_branch = "";
				$where_branch2 = "";
			}else{
				$where_branch = " and a.branch_id = '".$_SESSION['branch_id']."' ";
				$where_branch2 = " and b.branch_id = '".$_SESSION['branch_id']."' ";
			}
		$cabang_active = get_cabang_name($s_cabang);
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		$date_default = "";
		$date_url = "";
		$button_download = "";
	
		if(isset($_GET['preview'])){
			$i_date = get_isset($_GET['date']);
			$date_default = $i_date;
			$date_url = "&date=".str_replace(" ","", $i_date);
		}
		$action = "report_detail.php?page=form_result&preview=1";
		include '../views/report_detail/form.php';
		if(isset($_GET['preview'])){
				if(isset($_GET['date'])){
					$i_date = $_GET['date'];
				}else{
					extract($_POST);
					$i_date = get_isset($i_date);
				}
			$date = explode("-", $i_date);
			$date1 = $date[0];
			$date2 = $date[1];
			$date1 = str_replace("/","-", $date1);
			$date2 = str_replace("/","-", $date2);
			$query_purchase = select_purchase($date1, $date2, $where_branch);
			$query_penjualan = select_transaction($date1, $date2, $where_branch);
			$q_produksi = select_produksi($date1, $date2 ,$where_branch);
			$q_jumlah_kebutuhan = select_jumlah_kebutuhan_stock($date1, $date2, $where_branch2);
			$datetime1 = new DateTime($date1);
			$datetime2 = new DateTime($date2);
			$difference = $datetime1->diff($datetime2);
			$jumlah_hari = $difference->days + 1;
			$jumlah_pembelian = get_jumlah_pembelian($date1, $date2,$s_cabang);
			$jumlah_penjualan = get_jumlah_penjualan($date1, $date2,$s_cabang);
			include '../views/report_detail/list_pembelian.php';
			include '../views/report_detail/list_penjualan.php';
			include '../views/report_detail/list_hasil_produksi.php';
			include '../views/report_detail/list_jumlah_kebutuhan.php';
		}
		get_footer();
	break;

	case 'form_result':

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		$date_default = "";
		$date_url = "";
			extract($_POST);
			$i_date = (isset($_POST['i_date'])) ? $_POST['i_date'] : null;
			$date_default = $i_date;
			$_SESSION['date'] = $date_default;
			$date_url = "&date=".str_replace(" ","", $i_date);
		header("Location: report_detail.php?page=list&preview=1&date=$date_default");
	break;

	case 'popmodal_pembelian':
	
	  	$purchase_code = get_isset($_GET['purchases_code']);
		$branch_id = get_isset($_GET['branch_id']);
		$where_purchase_code_branch_id = "where purchase_code = '$purchase_code' and branch_id = '$branch_id'";
		$q_detail_trans = select_detail_purchases($purchase_code, $branch_id);
		$supplier_id = select_config_by('purchases', 'supplier_id',$where_purchase_code_branch_id);
		$where_supplier_id = "where supplier_id = '$supplier_id'";
		$supplier_name = select_config_by('suppliers', 'supplier_name', $where_supplier_id);
	  	include '../views/report_detail/popmodal.php';
	break;
	case 'popmodal_penjualan':
	
	  	$transaction_code = get_isset($_GET['transaction_code']);
		$branch_id = get_isset($_GET['branch_id']);
		$where_transaction_code_branch_id = "where transaction_code = '$transaction_code' and branch_id = '$branch_id'";
		$q_detail_penjualan = select_detail_transaction($transaction_code, $branch_id);
		$member_id = select_config_by('transactions', 'member_id',$where_transaction_code_branch_id);
		$where_member_id = "where member_id = '$member_id'";
		$member_name = select_config_by('members', 'member_name', $where_member_id);
	  	include '../views/report_detail/popmodal_penjualan.php';
	break;
	case 'popmodal_produksi':
		$produksi_code = get_isset($_GET['produksi_code']);
		$branch_id = get_isset($_GET['branch_id']);
		$where_produksi_code = "where produksi_code = '$produksi_code' and branch_id = '$branch_id'";
		$menu_id = select_config_by('produksi', 'menu_id' , $where_produksi_code);
		$where_menu_id = "where menu_id = '$menu_id'";
		$menu_name = select_config_by('menus', 'menu_name', $where_menu_id);
		$where_code = "where produksi_code = '$produksi_code'";
		$menu_qty = select_config_by('produksi', 'qty', $where_code);
		$q_detail_produksi = select_detail_produksi($branch_id,$produksi_code);
		include '../views/report_detail/popmodal_produksi.php';
	break;
}