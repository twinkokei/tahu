<?php

function select($where){
	$query = mysql_query("SELECT a.*
							FROM transactions a
							JOIN members b ON b.member_id = a.member_id
							JOIN menus d ON d.menu_id = a.menu_id
							JOIN branches e ON e.branch_id = a.branch_id
							$where
							ORDER BY transaction_id");
	return $query;
}

function select_satuan_konversi($i_menu_id){
	$query = mysql_query("SELECT a.satuan_konversi FROM konversi_menu a
							WHERE a.menu_id = '$i_menu_id'
							UNION SELECT b.menu_satuan FROM menus b
							WHERE b.menu_id = '$i_menu_id'");
	return $query;
}

function select_bank(){
	$query = mysql_query("select * from banks order by bank_id");

	return $query;
}

function select_keranjang(){
	$query = mysql_query("SELECT a.* , b.menu_name FROM keranjang a
						LEFT JOIN menus b ON b.menu_id = a.menu_id
						ORDER BY keranjang_id");
	return $query;
}

function select_member(){
	$query = mysql_query("select * from members order by member_id ");
	return $query;
}

function select_menu(){
	$query = mysql_query("select * from menus order by menu_id");
	return $query;
}

function select_branch(){
	$query = mysql_query("select * from branches order by branch_id");
	return $query;
}

function select_satuan(){
	$query = mysql_query("SELECT * FROM satuan ORDER BY satuan_id");
	return $query;
}

function read_id($id){
	$query = mysql_query("select a.*,b.member_name
			from transactions a
			join members b on b.member_id = a.member_id

			where transaction_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}

function update_menu_stock($i_menu_id,$i_branch_id,$i_qty){
	$query = mysql_query("UPDATE menu_stock SET menu_stock_qty = menu_stock_qty + '$i_qty' WHERE menu_id = '$i_menu_id' AND branch_id = '$i_branch_id'");
}

function update_item_stock($item_id, $i_branch_id, $item_qty){
	$query = mysql_query("UPDATE item_stocks SET item_stock_qty = item_stock_qty - '$item_qty' WHERE item_id = '$item_id' AND branch_id = '$i_branch_id'");
}

function create($data){
	mysql_query("insert into transactions values(".$data.")");
}


function create_journal($data_id, $data_url, $journal_type_id, $journal_credit, $user_id, $branch_id){
	mysql_query("insert into journals values(
				'',
				'$journal_type_id',
				'$data_id',
				'$data_url',
				'0',
				'$journal_credit',
				'0',
				'0',
				'',
				'".date("Y-m-d")."',
				'',
				'',
				'',
				'',
				'',
				'".$_SESSION['user_id']."',
				'$branch_id'
	)");
}

function update($data, $id){
	mysql_query("update purchases set ".$data." where purchase_id = '$id'");
}

function delete($id){
	mysql_query("delete from keranjang where keranjang_id = '$id'");
}

function grand_total(){
	$query = mysql_query("SELECT SUM(qty) AS grand_qty ,SUM(total) AS grand_total 	
						FROM keranjang");
	return $query;
}

function check_stok($item_id, $item_qty, $branch_id)
{
	$result = 0;	
	$query = mysql_query("select item_stock_qty as result from item_stocks where item_id = '$item_id' and branch_id = '$branch_id'");
	$row = mysql_fetch_array($query);


	if ($row['result']>=$item_qty) {
		$result  = 1;
	}

	return $result;
}

function check_stok_bahan_real($item_id, $branch_id)
{
	$result = 0;
	$query = mysql_query("select item_stock_qty as result from item_stocks where item_id = '$item_id' and branch_id = '$branch_id'");
	$row = mysql_fetch_array($query);


	if ($row['result']) {
		$result  = $row['result'];
	}

	return $result;
}

?>
