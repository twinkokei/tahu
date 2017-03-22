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
 
 

?>
