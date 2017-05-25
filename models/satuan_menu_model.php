<?php
function select(){
  $query = mysql_query("SELECT * FROM satuan_menu");
  return $query;
}


function read_id($id){
  $query = mysql_query("SELECT * from satuan_menu WHERE satuan_id = '$id'");
  $result = mysql_fetch_object($query);
  return $result;
}

function create_satuan($data){
  mysql_query("insert into satuan_menu values(".$data.")");
}

function delete($id){
    $query = mysql_query("SELECT * from table WHERE satuan_id = '$id'");
    while ($row = mysql_fetch_array($query))
    mysql_query("delete from satuan_menu where satuan_id = '$id'");
}

function update_satuan($data, $id){
  mysql_query("update satuan_menu set ".$data." where satuan_id = '$id'");
}

?>
