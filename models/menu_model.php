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


	function select_tabel_konversi($id){
  		$query = mysql_query("SELECT a.* , b.satuan_name , c.satuan_name AS konversi, d.menu_name FROM konversi_menu a
		                  LEFT JOIN satuan_menu b ON b.satuan_id = a.satuan_utama
		                  LEFT JOIN satuan_menu c ON c.satuan_id = a.satuan_konversi
		                  LEFT JOIN menus d ON d.menu_id = a.menu_id
		                  WHERE a.menu_id = '$id'");
  		return $query;
	}

	function select_konversi($where_satuan_yang_sudah_dipilih){
		$query = mysql_query("SELECT * from satuan_menu $where_satuan_yang_sudah_dipilih");
		return $query;
	}

	function select_recipe($menu_id){
		$query = mysql_query("SELECT a.*, b.item_name , c.satuan_name
								FROM menu_recipes a
								LEFT JOIN items b ON b.item_id = a.item_id
								LEFT JOIN satuan c on c.satuan_id = a.satuan_id
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
