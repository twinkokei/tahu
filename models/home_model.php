<?php

function select_journals($id_1, $id_2)
{
	$query = mysql_query("select a.* from journals a 
						  where journal_type_id = '$id_1' or journal_type_id = '$id_2'");
	return $query; 
}	

?>
