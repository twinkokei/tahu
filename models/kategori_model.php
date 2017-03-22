<?php
function select(){
  $query = mysql_query("SELECT * FROM kategori");
  return $query;
}


function read_id($id){
  $query = mysql_query("SELECT * from kategori WHERE kategori_id = '$id'");
  $result = mysql_fetch_object($query);
  return $result;
}

function create_kategori($data){
  mysql_query("insert into kategori values(".$data.")");
}

function delete($id){
    $query = mysql_query("SELECT * from table WHERE kategori_utama_id = '$id'");
    while ($row = mysql_fetch_array($query))
    mysql_query("delete from kategori where kategori_id = '$id'");
}

function update_kategori($data, $id){
  mysql_query("update kategori set ".$data." where kategori_id = '$id'");
}

function create_type_pembeli_diskon($data){
  mysql_query("insert into type_diskon_pembeli values(".$data.")");
}


?>
