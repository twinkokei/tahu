<?php

function select(){
	$query = mysql_query("select *
							from members
							order by member_id");
	return $query;
}


function read_id($id){
	$query = mysql_query("select *
							from members
			where member_id = '$id'");
	$result = mysql_fetch_object($query);
	return $result;
}


function create($data){
	mysql_query("insert into members values(".$data.")");
}

function update_member($data, $id){
	mysql_query("update members set ".$data." where member_id = '$id'");
}

function delete($id){
	mysql_query("delete from members where member_id = '$id'");
}
?>
