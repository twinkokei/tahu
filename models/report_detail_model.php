<?php

function select_purchase($date1, $date2, $where_branch){
						$query = mysql_query("SELECT a.* , b.supplier_name, d.item_name, e.branch_name, f.user_name
														FROM purchases a
														JOIN suppliers b ON b.supplier_id = a.supplier_id
														JOIN items d ON d.item_id = a.item_id
														JOIN branches e ON e.branch_id = a.branch_id
														JOIN users f ON f.user_id = a.user_id
														WHERE  a.purchase_date >= '$date1'
														AND a.purchase_date <= '$date2'
														$where_branch
														GROUP BY a.purchase_id order by a.purchase_id
											");
	return $query;
}
function select_transaction($date1, $date2, $where_branch){
						$query = mysql_query("SELECT a.* , b.member_name, d.menu_name, e.branch_name
														FROM transactions a
														JOIN members b ON b.member_id = a.member_id
														LEFT JOIN transaction_details c ON c.transaction_id = a.transaction_id
														JOIN menus d ON d.menu_id = d.menu_id
														JOIN branches e ON e.branch_id = a.branch_id
														WHERE  a.transaction_date >= '$date1'
														AND a.transaction_date <= 'date2'
														$where_branch
														GROUP BY a.transaction_id ORDER BY a.transaction_id
											");
	return $query;
}

function select_jumlah_kebutuhan_stock($date1, $date2, $where_branch2){
	$query = mysql_query("SELECT a.item_name, b.item_id, e.satuan_name, b.produksi_date, b.branch_id, c.branch_name, SUM(b.item_qty) AS result FROM pengurangan_produksi b
							LEFT JOIN items a ON a.item_id = b.item_id 
							LEFT JOIN branches c ON c.branch_id = b.branch_id
							LEFT JOIN konversi_item d ON d.item_id = b.item_id
							LEFT JOIN satuan  e ON e.satuan_id = d.satuan_utama
							where b.produksi_date >= '$date1'
							and b.produksi_date <= '$date2'
							$where_branch2
							group by b.item_id");
	return $query;
}


function select_produksi($date1, $date2 , $where_branch){
	$query = mysql_query("SELECT a.*,b.menu_name, c.branch_name FROM produksi a 
							LEFT JOIN menus b ON b.menu_id = a.menu_id
							LEFT JOIN branches c on c.branch_id = a.branch_id
							WHERE  a.produksi_date >= '$date1'
							AND a.produksi_date <= 'date2'
							$where_branch
							GROUP BY a.produksi_id ORDER BY a.produksi_id
							");

	return $query;
}
function select_detail_produksi($branch_id, $produksi_code){
	$query = mysql_query("SELECT a.*,c.menu_name,d.item_name,e.branch_name, b.branch_id FROM pengurangan_produksi a
							LEFT JOIN produksi b ON b.produksi_code = a.produksi_code
							LEFT JOIN menus c ON c.menu_id = b.menu_id
							LEFT JOIN items d ON d.item_id = a.item_id
							LEFT JOIN branches e ON e.branch_id = b.branch_id
							WHERE  a.produksi_code  = '$produksi_code'
							AND b.branch_id = '$branch_id'
							GROUP BY a.pengurangan_produksi_id ORDER BY a.pengurangan_produksi_id
							");
	return $query;
}


function get_jumlah_pembelian($date1, $date2, $s_cabang){
	$query = mysql_query("SELECT count(purchase_id) as jumlah
							from purchases
							WHERE  purchase_date >= '$date1'
							AND purchase_date <= '$date2'
							and branch_id = '".$s_cabang."'
							 ");
	$result = mysql_fetch_object($query);
	return $result->jumlah;
}
function get_jumlah_penjualan($date1, $date2, $s_cabang){
	$query = mysql_query("SELECT count(transaction_id) as jumlah
							from transactions
							WHERE  transaction_date >= '$date1'
							AND transaction_date <= '$date2'
							and branch_id = '".$s_cabang."'
							 ");
	$result = mysql_fetch_object($query);
	return $result->jumlah;
}

function select_detail_purchases($purchase_code, $branch_id){
	$query = mysql_query("SELECT a.*, b.supplier_name, c.* FROM purchases a 
						  LEFT JOIN suppliers b on b.supplier_id = a.supplier_id
						  LEFT JOIN items c on c.item_id = a.item_id
						  WHERE a.purchase_code = '$purchase_code' and a.branch_id = '$branch_id'");
	return $query;	
}
function select_detail_transaction($transaction_code, $branch_id){
	$query = mysql_query("SELECT a.*, b.member_name, c.*,d.menu_name FROM transactions a 
						  LEFT JOIN members b on b.member_id = a.member_id
						  LEFT JOIN transaction_details c on c.transaction_id = a.transaction_id
						  LEFT JOIN menus d on d.menu_id = c.menu_id
						  WHERE a.transaction_code = '$transaction_code' and a.branch_id = '$branch_id'");
	return $query;	
}


function get_total_pembelian($date1, $date2, $s_cabang){
	$query = mysql_query("SELECT sum(purchase_total) as jumlah
							from purchases
							WHERE purchases_date >= '$date1'
							AND purchases_date <= '$date2'
							and branch_id = '".$s_cabang."'
							 ");
	$result = mysql_fetch_array($query);
	$result = ($result['jumlah']) ? $result['jumlah'] : "0";
	return $result;
}

?>
