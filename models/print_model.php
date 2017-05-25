<?php 

function select_pembelian_bydate($date1, $date2){
     $query = mysql_query("SELECT a.*, b.journal_type_name, g.bank_name AS bank_kita, h.bank_name AS bank_client,
                        CASE a.journal_type_id
                            WHEN a.journal_type_id=1 THEN e.member_name
                            WHEN a.journal_type_id=2 THEN f.supplier_name
                            WHEN a.journal_type_id=5 THEN f.supplier_name
                            WHEN a.journal_type_id=6 THEN e.member_name
                        END AS CLIENT, i.branch_name, j.user_name, k.*
                        FROM journals a
                        LEFT JOIN journal_types b ON b.journal_type_id = a.journal_type_id
                        LEFT JOIN transactions c ON c.transaction_code = a.data_id
                        LEFT JOIN purchases d ON d.purchase_code = a.data_id
                        LEFT JOIN members e ON e.member_id = c.member_id
                        LEFT JOIN suppliers f ON f.supplier_id = d.supplier_id
                        LEFT JOIN banks g ON g.bank_id = a.bank_id
                        LEFT JOIN banks h ON h.bank_id = a.bank_id_to
                        LEFT JOIN branches i ON i.branch_id = a.branch_id
                        LEFT JOIN users j ON j.user_id = a.user_id
                        left join banks k on k.bank_id = k.bank_id
                         WHERE a.purchase_date >= '$date1' AND a.purchase_date <= '$date2'");
    return $query;      
    }

function select($transaction_id){
        $query = mysql_query("SELECT a.*, b.*, c.menu_name, d.member_name
                                                          FROM transactions a
                                                          LEFT JOIN transaction_details b ON b.transaction_id = a.transaction_id
                                                          LEFT JOIN menus c ON c.menu_id = b.menu_id
                                                          LEFT JOIN members d ON d.member_id = a.member_id
                                                          where a.transaction_id = '$transaction_id'");
        return $query;
}

function cabang(){
        $transaction_id = $_GET['transaction_id'];
        $query = mysql_query("SELECT b.branch_name, c.office_name
                                                        FROM transactions a
                                                        JOIN branches b ON b.branch_id = a.branch_id
                                                        JOIN office c ON c.office_id = c.office_id
                                                        WHERE transaction_id = '$transaction_id'"); 
        return $query;
}

?>