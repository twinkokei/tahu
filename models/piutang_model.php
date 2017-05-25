<?php

function select(){
	$query = mysql_query("SELECT a.*,b.member_name,c.transaction_total,c.transaction_uang_muka,c.kredit_id,c.transaction_piutang FROM transactions a
LEFT JOIN members b ON b.member_id = a.member_id
LEFT JOIN kredit c ON c.transaction_code = a.transaction_code
WHERE a.status = 1");
	return $query;
}

function create_journal($code, $data_url, $journal_type_id, $journal_kredit, $user_id, $branch_id, $jns_bayar, $bank, $no_rek){
	mysql_query("INSERT into journals values(
				'',
				'$journal_type_id',
				'$code',
				'$data_url',
				'0',
				'$journal_kredit',
				'0',
				'0',
				'',
				'".date("Y-m-d")."',
				'$jns_bayar',
				'$bank',
				'$no_rek',
				'',
				'',
				'".$_SESSION['user_id']."',
				'".$_SESSION['branch_id']."'
			)");
}

?>
