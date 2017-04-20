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

function select_detail_purchases($purchase_code, $branch_id){
	$query = mysql_query("SELECT a.*, b.supplier_name, c.* FROM purchases a 
						  LEFT JOIN suppliers b on b.supplier_id = a.supplier_id
						  LEFT JOIN items c on c.item_id = a.item_id
						  WHERE a.purchase_code = '$purchase_code' and a.branch_id = '$branch_id'");
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
