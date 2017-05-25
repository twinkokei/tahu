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
function select_satuan_name($where_menu_id){
	$query = mysql_query("SELECT a.satuan_utama, b.satuan_name FROM konversi_menu a 
						  LEFT JOIN satuan b ON b.satuan_id = a.satuan_utama
						  $where_menu_id");
	return $query;
}
function select_bank(){
	$query = mysql_query("select * from banks order by bank_id");

	return $query;
}

function select_keranjang(){
	$query = mysql_query("SELECT a.* , b.menu_name, c.satuan_name FROM keranjang a
						LEFT JOIN menus b ON b.menu_id = a.menu_id
						LEFT JOIN satuan_menu c on c.satuan_id = a.satuan
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

function select_menu_konversi($id){
	$query = mysql_query("SELECT a.*, b.satuan_id, b.satuan_name FROM konversi_menu a
				LEFT JOIN satuan_menu b ON b.satuan_id = a.satuan_konversi
				where a.menu_id = '$id'");
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


function create($data){
	mysql_query("insert into transactions values(".$data.")");
}


function create_journal($data_id, $data_url, $journal_type_id, $journal_credit, $user_id, $branch_id){
	mysql_query("insert into journals values(
				'',
				'$journal_type_id',
				'$data_id',
				'$data_url',
				'$journal_credit',
				'0',
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
?>
