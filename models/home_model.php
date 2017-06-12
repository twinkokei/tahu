<?php
function select_journal()
{
	$query = mysql_query("SELECT a.*, DATE(a.journal_date) as s_journal_date, SUM(a.journal_debit) AS penjualan, SUM(a.journal_credit) AS pembelian FROM journals a
												GROUP BY DATE(a.journal_date)");
	return $query;
}

function select_journals($id_1, $id_2)
{
	$query = mysql_query("select a.* from journals a
						  where journal_type_id = '$id_1' or journal_type_id = '$id_2'");
	return $query;
}

function select_piutang(){

	$query = mysql_query("SELECT a.*,b.member_name,c.transaction_total,c.transaction_uang_muka,c.kredit_id,c.transaction_piutang 					FROM transactions a
LEFT JOIN members b ON b.member_id = a.member_id
LEFT JOIN kredit c ON c.transaction_code = a.transaction_code
WHERE a.status = 1");
	return $query;
}

?>
