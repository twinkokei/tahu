<?php
 function get_stock($item_id, $cabang){
 	$query = mysql_query("select item_stock_qty as result from item_stocks
  												where branch_id = '$cabang'
  												and item_id = '$item_id'
  												");
  	$row = mysql_fetch_array($query);
  	
  	$result = ($row['result']) ? $row['result'] : "0";
  	return $result;
 }

 function get_img_old($id){
	$query = mysql_query("select item_img from items
						where item_id = '".$id."'");
	$result = mysql_fetch_array($query);
	$row = $result['item_img'];
	return $row;
}

 function select(){
  $query = mysql_query("select * from satuan");
  return $query;
}

// function select_stock(){
//   $q_all_stock = mysql_query("SELECT a.*, b.kategori_name FROM items a 
//                               LEFT JOIN kategori b ON b.kategori_id = a.item_kategori
//                               ORDER BY item_id");
//   return $q_all_stock;    
// }

function select_stock(){
  $q_all_stock = mysql_query("SELECT a.*, b.satuan_name FROM items a 
                              LEFT JOIN satuan b ON b.satuan_id = a.satuan_utama
                              ORDER BY item_id");
  return $q_all_stock;    
}

  function select_tabel_konversi($id){
  $query = mysql_query("SELECT a.* , b.satuan_name , c.satuan_name AS konversi, d.item_name FROM konversi_item a
                  LEFT JOIN satuan b ON b.satuan_id = a.satuan_utama
                  LEFT JOIN satuan c ON c.satuan_id = a.satuan_konversi
                  LEFT JOIN items d ON d.item_id = a.item_id
                  WHERE a.item_id = '$id'");
  return $query;
}
function select_konversi($where_satuan_yang_sudah_dipilih){
  $query = mysql_query("SELECT * from satuan $where_satuan_yang_sudah_dipilih");
  return $query;
}
?>
