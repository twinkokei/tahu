<?php

	function select(){
		$query = mysql_query("SELECT a.* , b.kategori_name
													FROM menus a
													LEFT JOIN kategori b ON b.kategori_id = a.menu_kategori
													ORDER BY menu_id");
		return $query;
	}

	function select_menu_kategori(){
		$query = mysql_query("select * from kategori order by kategori_id");
		return $query;
	}

	function select_item(){
		$query = mysql_query("select a.*
								from items a
								order by item_id");
		return $query;
	}


	function select_partner(){
		$query = mysql_query("select * from partners order by partner_id");
		return $query;
	}

	function select_recipe($menu_id){
		$query = mysql_query("SELECT a.*, b.item_name
								FROM menu_recipes a
								LEFT JOIN items b ON b.item_id = a.item_id
								where menu_id = '$menu_id' order by menu_recipe_id");
		return $query;
	}

	function read_id($id){
		$query = mysql_query("select *
				from menus
				where menu_id = '$id'");
		$result = mysql_fetch_object($query);
		return $result;
	}


	function read_item_id($id){
		$query = mysql_query("select *
				from menu_recipes
				where menu_recipe_id = '$id'");
		$result = mysql_fetch_object($query);
		return $result;
	}

	function create($data){
		mysql_query("insert into menus values(".$data.")");
	}

	function create_item($data){
		mysql_query("insert into menu_recipes values(".$data.")");
	}

	function update($data, $id){
		mysql_query("update menus set ".$data." where menu_id = '$id'");
	}

	function update_item($data, $id){
		mysql_query("update menu_recipes set ".$data." where menu_recipe_id = '$id'");
	}

	function delete($id){
		mysql_query("delete from menus  where menu_id = '$id'");
	}

	function delete_item($id){
		mysql_query("delete from menu_recipes  where menu_recipe_id = '$id'");
	}

	function get_img_old($id){
		$query = mysql_query("select menu_img from menus
							where menu_id = '".$id."'");
		$result = mysql_fetch_array($query);
		$row = $result['menu_img'];
		return $row;
	}

?>
