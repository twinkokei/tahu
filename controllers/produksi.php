<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/produksi_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucfirst("Produksi");
$item = ucfirst("ITEM");

$_SESSION['menu_active'] = 3;
$_SESSION['sub_menu_active'] = 3;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
	case 'list':
		get_header();

		$close_button = "home.php";
	
		$where = '';
		$query_menu = select_menu();
		$query_branch = select_branch();
		$query_satuan = select_satuan();

		$save_produksi = "produksi.php?page=save_produksi";

		$transaction_id_new = select_config_by('transactions', 'max(transaction_id)+1', $where);
		if ($transaction_id_new==null) {$transaction_id_new = 1;}
		$transaction_id = (isset($_GET['transaction_id'])) ? $_GET['transaction_id'] : $transaction_id_new;

		if(isset($_SESSION['i_tanggal'])!=null) {
			$tanggal = $_SESSION['i_tanggal'];
		} else {
			$tanggal = date('d-m-Y');
		}
		$action = "produksi.php?page=save_produksi";	
		include '../views/produksi/form.php';
		get_footer();
	break;

	case 'get_menu_details':

		$i_menu_id = $_POST['i_menu_id'];
		$i_branch_id = $_POST['i_branch_id'];
		$where_menu_id =  "where menu_id = '$i_menu_id'";
 		$q_menu = select_config('menus', $where_menu_id);
		$r_menu = mysql_fetch_array($q_menu);

		$stok_bahan_real = 0;
		$status = 'ada';
		$stok_ = 0;
		$stok = 0;

		$q_check_recipe = select_config('menu_recipes', $where_menu_id);

		$no = 0;

		$q_menu_konversi = select_config('konversi_menu', $where_menu_id);
		while ($r_menu_konversi = mysql_fetch_array($q_menu_konversi)) {

			$data['menukonversi'][] = array(
				'menu_id' 					=> $r_menu_konversi['menu_id'], 
				'satuan_utama' 				=> $r_menu_konversi['satuan_utama'], 
				'jumlah' 					=> $r_menu_konversi['jumlah'], 
				'satuan_konversi' 			=> $r_menu_konversi['satuan_konversi'], 
				'jumlah_satuan_konversi'	=> $r_menu_konversi['jumlah_satuan_konversi'], 
				'konversi_harga'			=> $r_menu_konversi['konversi_harga']
				);

			$satuan_utama 				= $r_menu_konversi['satuan_utama'];
		}

		while ($r_check_recipe = mysql_fetch_array($q_check_recipe)) {

				$item_qty_tersedia = check_stok_bahan_real($r_check_recipe['item_id'], $i_branch_id);
				$stok = check_stok($r_check_recipe['item_id'], $r_check_recipe['item_qty'], $i_branch_id);
				$where_item_id = "WHERE item_id = '".$r_check_recipe['item_id']."'";
				$q_item_konversi = select_config('konversi_item', $where_item_id);

				while ($r_item_konversi =  mysql_fetch_array($q_item_konversi)) {

					$data['itemkonversi'] = array(
							'item_id' 					=> $r_item_konversi['item_id'], 
							'satuan_utama'				=> $r_item_konversi['satuan_utama'], 
							'jumlah'					=> $r_item_konversi['jumlah'], 
							'satuan_konversi' 			=> $r_item_konversi['satuan_konversi'], 
							'jumlah_satuan_konversi' 	=> $r_item_konversi['jumlah_satuan_konversi']
						);

				}

				$stok_ = $stok_ + $stok;

			$no++;		
			$data['item_detail'] = array(
					'item_id' 				=> $r_check_recipe['item_id'], 
					'item_qty_tersedia' 	=> $item_qty_tersedia,
					'item_qty_kebutuhan' 	=> $r_check_recipe['item_qty']
					);
		}
		// echo $status;

		if ($stok_ < $no) {
			$status = 'habis';
		}

		$data['menu_detail'] = array(
						'menu_id' 			=> $r_menu['menu_id'],
						'menu_name' 		=> $r_menu['menu_name'],
						'menu_price' 		=> $r_menu['menu_price'], 
						'menu_img' 			=> $r_menu['menu_img'],
						'status'			=> $status
					);

		echo json_encode($data);

		break;

	case 'get_satuan_details':
		$i_menu_id = $_POST['i_menu_id'];
		// $satuan_utama = "where menu_satuan != '$where_satuan_utama'";
		// $satuan_konversi = ()
		$q_satuan = select_satuan_konversi($i_menu_id);
		while ($r_satuan = mysql_fetch_array($q_satuan)) {
			$where_satuan_id = "WHERE satuan_id = '".$r_satuan['satuan_konversi']."'";

			$satuan_name = select_config_by('satuan_menu', 'satuan_name', $where_satuan_id);
			$data[] = array(
				'satuan_id' 	=> $r_satuan['satuan_konversi'], 
				'satuan_name' 	=> $satuan_name 
				);
		}
		echo json_encode($data);
		break;

	case 'save_produksi':
		extract($_POST);

		$i_branch_id = get_isset($i_branch_id);
		$tanggal = date("Y-m-d h:m:s");
		$tanggal_2 = date("Y.m");
		$bulan	   = date("m");
		$tahun	   = date("Y");
		$i_menu_id = get_isset($i_menu_id);
		$i_qty = get_isset($i_qty);
		$i_code = '1'.time();
		$where_tanggal = "WHERE month(produksi_date) = '$bulan' and year(produksi_date) = '$tahun' ";
		$produksi_old = select_config_by('produksi', 'count(produksi_id)', $where_tanggal); 
		$produksi_old = $produksi_old + 1;
		$i_code_2 = $tanggal_2."/".$produksi_old;
		// tanggal / bulan / no urut;
		echo $i_code_2;
		// $produksi_id = '';
			$data = "'',
					 '$i_menu_id',
					 '$i_branch_id',
					 '$tanggal',
					 '$i_code',
					 '',
					 '$satuan_id',
					 '$i_qty'
				";

		create_config("produksi", $data);


		$produksi_id = mysql_insert_id();
		echo $satuan_id;
		$qty_real = $i_qty;
		if ($satuan_id != null) {
			$qty_real = konversi_ke_satuan_utama2($i_menu_id, $satuan_id, $i_qty);
			echo $qty_real;
		}

		$where_menu_id = "WHERE menu_id = '$i_menu_id'";
		$q_menu_recipe = select_config('menu_recipes', $where_menu_id);
		while ($r_menu_recipe = mysql_fetch_array($q_menu_recipe)) {
			$item_qty = $r_menu_recipe['item_qty']*$qty_real;
			$item_id = $r_menu_recipe['item_id'];
			update_item_stock($item_id, $i_branch_id, $item_qty);

			$data_pengurangan ="'',
								'$i_code',
								'$tanggal',
								'$qty_real',
								'$item_id',
								'$item_qty',
								'$i_branch_id'
								";

			create_config('pengurangan_produksi', $data_pengurangan);


			}
		$where_menu_id = "WHERE menu_id = $i_menu_id";
		$cek_menu_stock = select_config_by('menu_stock', 'menu_id', $where_menu_id);

		if ($cek_menu_stock == null){
			$datamenu = "'',
						 '$i_menu_id',
						 '$i_branch_id',
						 '$qty_real'
						 ";
		create_config("menu_stock", $datamenu);
		} else{
			update_menu_stock($i_menu_id, $i_branch_id, $qty_real);
		}

			
		header("Location: produksi.php?page=list&did=1");
	break;

	case 'delete':
		$id = get_isset($_GET['id']);
    	$where_keranjang_id = "keranjang_id = '$id'";    
    	delete_config('keranjang', $where_keranjang_id);
    	header('Location: produksi.php?page=list&did=3');
	break;

	case 'print':
		$transaction_id = $_GET['transaction_id'];
		header("Location: print.php?page=print_transaction&transaction_id=$transaction_id");
		break;

}
?>