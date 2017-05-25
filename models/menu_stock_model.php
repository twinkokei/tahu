<?php

function get_branch($id){
  $query = mysql_query("SELECT branch_name FROM branches WHERE branch_id = '$id'");
  $result = mysql_fetch_array($query);
  $row = $result['branch_name'];
  return $row;
}

 function get_stock($menu_id, $cabang){
  $query = mysql_query("select menu_stock_qty as result from menu_stock
                          where branch_id = '$cabang'
                          and menu_id = '$menu_id'
                          ");
    $row = mysql_fetch_array($query);
    
    $result = ($row['result']) ? $row['result'] : "0";
    return $result;
 }

function select($where){
  $query = mysql_query("SELECT a.*, b.*, c.branch_name FROM menu_stock a
                        LEFT JOIN menus b ON b.menu_id = a.menu_id
                        LEFT JOIN branches c ON c.branch_id = a.branch_id
                        $where order by a.menu_id");
  return $query;
}

function read_id($id,$branch_id){
  $query = mysql_query("SELECT a.*, b.*, c.branch_name FROM menu_stock a
                        JOIN menus b ON b.menu_id = a.menu_id
                        LEFT JOIN branches c on c.branch_id =a.branch_id
                        where a.menu_id = '$id' and a.branch_id = '$branch_id' ");
  $result = mysql_fetch_object($query);
  return $result;
}

function read_stock($id){
  $query = mysql_query("SELECT a.*, d.* FROM menu_stock a
                        left JOIN stock2 d on d.menu_id = a.menu_id
                        where a.menu_id = '$id'");
  $result = mysql_fetch_object($query);
  return $result;
}

// function create_config($table, $data){
//  mysql_query("insert into $table values(".$data.")");
//  return mysql_insert_id();
// }

function delete($id,$branch_id){
  mysql_query("delete from menu_stock where menu_id = '$id' and branch_id = '$branch_id'");
}

function update_stok($item_qty, $branch_id, $menu_id){
  mysql_query("update menu_stock set menu_stock_qty = '$item_qty' WHERE branch_id = '$branch_id' and menu_id = '$menu_id'");
}

function select_detail_recipe($menu_id){
  $query = mysql_query("SELECT a.* ,d.menu_name , b.item_id , b.item_qty ,c.item_name, a.menu_stock_qty * b.item_qty AS total_kebutuhan FROM menu_stock a
                      LEFT JOIN menu_recipes b ON b.menu_id = a.menu_id
                      LEFT JOIN items c ON c.item_id = b.item_id
                      LEFT JOIN menus d ON d.menu_id = a.menu_id
                      WHERE a.menu_id = '$menu_id'");
  return $query;

}

function select_menu_stock($menu_id){
    $query = mysql_query("SELECT a.* , b.menu_name FROM menu_stock a
          LEFT JOIN menus b ON b.menu_id = a.menu_id
          WHERE a.menu_id = '$menu_id'");
          return $query;
}

 ?>
