<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/stock_item_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("STOCK_ITEM");

$_SESSION['menu_active'] = 1;
$_SESSION['sub_menu_active'] = 11;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
	case 'list':
		get_header($title);
		$count = 0;
		if ($_SESSION['branch_id'] == 3) {
				$where_branch = "";
			}else{
				$where_branch = " where a.branch_id = '".$_SESSION['branch_id']."' ";
			}
		$branch_active = get_branch($s_cabang);
		$query = select($where_branch);
		$add_button = "stock_item.php?page=form";
		include '../views/stock_item/list.php';
		get_footer();
	break;

	case 'form':

		get_header($title);
		$close_button = "stock_item.php?page=list";
		$query_item_type = select_item_type();
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		$branch_id = (isset($_GET['branch_id'])) ? $_GET['branch_id'] : null;
		$row = read_id($id,$branch_id);
		$row2 = read_stock($id,$branch_id);
		$get_new_date = get_new_date($id,$branch_id);
		$stock_buy = read_stock_buy($get_new_date,$branch_id);
		$unit_id_new_buy = get_unit_id_new_buy($id,$branch_id);
		$q_type_pembeli = get_type_pembeli();
		// var_dump($stock_buy);
		if($row2){
			$action = "stock_item.php?page=edit&id=$id";
		} else{
			//inisialisasi
			$action = "stock_item.php?page=save&id=$id";
		}
		include '../views/stock_item/form.php';
		get_footer();
		break;

		case 'delete':

			$id = get_isset($_GET['id']);
			delete($id);
			header('Location: stock_item.php?page=list&did=3');
			break;

		case 'edit':
			extract($_POST);
			// $item_id = $_POST['id'];
			$item_id = get_isset($_GET['id']);
			$item_type_id = get_isset($item_type_id);
			$stock_id = get_isset($stock_id);
			$i_original_price = get_isset($i_original_price);
			$i_margin_price = '';
			$i_price = get_isset($i_price);
			$data_new = "'',
						'$item_id',
						'$item_type_id',
						'$i_original_price',
						'$i_margin_price',
						'$i_price'
				";
			$data = " item_original_price = '$i_original_price',
								item_margin_price = '$i_margin_price',
								item_price = '$i_price'
								";
			update_stock($data,$item_id,$data_new);
			var_dump($data);
			header('Location: stock_item.php?page=list&did=3');
			break;

		case 'save':

			extract($_POST);

			$item_id = get_isset($_GET['id']);
			$item_type_id = get_isset($item_type_id);
			$i_original_price = get_isset($i_original_price);
			$i_margin_price = '';
			$i_price = get_isset($i_price);
			$data = "'',
						'$item_id',
						'$item_type_id',
						'$i_original_price',
						'$i_margin_price',
						'$i_price'
				";
			var_dump($data);
			create_stock($data);
			header('Location: stock_item.php?page=list&did=2');
			break;

		case 'popmodal_pembelian_item':
			$item_id = $_GET['item_id'];
			$branch_id = $_GET['branch_id'];
			$q_item = get_item_name($item_id);
			$row = mysql_fetch_array($q_item);
			$item_name = $row['item_name'];
			$q_item_purchase = select_item_purchase($item_id);
			include '../views/stock_item/popmodal_pembelian_item.php';
			break;

		case 'popmodal_penjualan_item':
			$item_id = $_GET['item_id'];
			$branch_id = $_GET['branch_id'];
			$q_item = get_item_name($item_id);
			$row = mysql_fetch_array($q_item);
			$item_name = $row['item_name'];
			$q_item_penjualan = select_item_penjualan($item_id);
			include '../views/stock_item/popmodal_penjualan_item.php';
			break;

		case 'form_keterangan':
			get_header();
			$branch_id = $_GET['branch_id'];
			$id = $_GET['id'];
			$where = '';
			$where_item_id = "WHERE item_id = '$id'";
			$kategori_id = select_config_by('items', 'kategori_id', $where_item_id);
			$where_kategori_id = "WHERE kategori_id = '$kategori_id'";

			$jml_kategori = select_config_by('kategori_keterangan', 'COUNT(*)',$where_kategori_id);
			$jml_stock_pernah_ada = select_config_by('item_keterangan_details', 'COUNT(*)',$where_item_id);
			$jml_stock_pernah_ada = $jml_stock_pernah_ada/$jml_kategori;
			$jml_stock_pernah_ada = ceil($jml_stock_pernah_ada);

			$item_qty = select_config_by('item_stocks', 'item_stock_qty', $where_item_id);
			$q_kategori_keterangan = select_config('kategori_keterangan', $where);
			$q_kategori_keterangan_2 = select_config('kategori_keterangan', $where);
			$q_item_keterangan_details = select_config('item_keterangan_details', $where_item_id);
			$col_detail = 1;
			while ($r_item_keterangan_details = mysql_fetch_array($q_item_keterangan_details)) {
					$purchase_id[$col_detail] = $r_item_keterangan_details['purchase_id'];
					$supplier_id[$col_detail] = $r_item_keterangan_details['supplier'];
					$item_details[$col_detail] = $r_item_keterangan_details['keterangan_details'];
					$status[$col_detail] = $r_item_keterangan_details['status'];
			$col_detail++;}
			$action = "stock_item.php?page=save_keterangan_item";
			$close_button = "stock_item.php?page=list";

			include '../views/stock_item/form_keterangan_item.php';
			get_footer();
			break;

	case 'kategori_keterangan_details':
		$id = $_GET['id'];
		$where = '';
		$where_kategori_id = "WHERE kategori_id = '$id'";
		$q_kategori_keterangan = select_config('kategori_keterangan', $where);
		include '../views/stock_item/popmodal_keterangan_details.php';
		break;

	case 'supplier':
		$where = '';
		$query = select_config('suppliers', $where);
		while ($row = mysql_fetch_array($query)) {
			$data[] = array(
				'supplier_id' => $row['supplier_id'],
				'supplier_name' => $row['supplier_name']);
		}
		echo json_encode($data);
		break;

	case 'save_keterangan_item':

		$item_qty = $_POST['item_qty'];
		$item_id = $_POST['item_id'];
		$where_item_id = "WHERE item_id = '$item_id'";
		$kategori_id = select_config_by('items', 'kategori_id', $where_item_id);
		$where_kategori_id = "WHERE kategori_id = '$kategori_id'";
		$q_kategori_keterangan = select_config('kategori_keterangan', $where_kategori_id);

		$x = 1;
		$item_keterangan_details_id[0] = 1;
		$q_item_keterangan_details_row	= select_config('item_keterangan_details',$where_item_id);
		while ($r_item_keterangan_details_row = mysql_fetch_array($q_item_keterangan_details_row)) {
						$item_keterangan_details_id[$x] = $r_item_keterangan_details_row['item_keterangan_details_id'];
		$x++;
	}
	$jml_col  = select_config_by('kategori_keterangan', 'COUNT(*)',$where_kategori_id);
		$j = 1;
		$no[0] = 0;
		$row=0;
		$vov = 0;
			$baris = $jml_col*$item_qty;
			for ($i=1; $i <=$baris; $i++) {
						$checkbox = 'checkbox_'.$i;
						$status_simpan = $_POST[$checkbox];
							if ($status_simpan == 1) {

									$purchase_id_input = "purchase_id_".$i;
									$purchase_id = $_POST[$purchase_id_input];
									$field_input = "field_keterangan_".$i."_".$no[$j];
									$field_keterangan = $_POST[$field_input];
									$data[$vov] = "keterangan_details = '$field_keterangan'";
											while ($r_kategori_keterangan = mysql_fetch_array($q_kategori_keterangan)) {
												$no[$j] = $r_kategori_keterangan['kategori_keterangan_id'];
												$where_ = " purchase_id = '$purchase_id'
																		and item_id = '$item_id'
																		and kategori_keterangan_id = '".$r_kategori_keterangan['kategori_keterangan_id']."'";

											}
											$where_item_keterangan_details_id[$i] = "and item_keterangan_details_id = '$i'";
											var_dump($where_item_keterangan_details_id);
								$vov++;
							}
						}
		break;
	}
?>
