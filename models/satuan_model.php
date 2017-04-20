<?php
function select(){
  $query = mysql_query("SELECT * FROM satuan");
  return $query;
}


function read_id($id){
  $query = mysql_query("SELECT * from satuan WHERE satuan_id = '$id'");
  $result = mysql_fetch_object($query);
  return $result;
}

function create_satuan($data){
  mysql_query("insert into satuan values(".$data.")");
}

function delete($id){
    $query = mysql_query("SELECT * from table WHERE satuan_utama_id = '$id'");
    while ($row = mysql_fetch_array($query))
    mysql_query("delete from satuan where satuan_id = '$id'");
}

function update_satuan($data, $id){
  mysql_query("update satuan set ".$data." where satuan_id = '$id'");
}

?>
