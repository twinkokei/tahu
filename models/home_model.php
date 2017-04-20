<?php

function select_journal()
{
	$query = mysql_query("SELECT a.*, DATE(a.journal_date) as s_journal_date, SUM(a.journal_debit) AS penjualan, SUM(a.journal_credit) AS pembelian FROM journals a
												GROUP BY DATE(a.journal_date)");
	return $query;
}

?>
