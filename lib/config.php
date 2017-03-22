<?php
ob_start();
session_start();
$con = mysql_connect("localhost","root","");
// koneksi
//mysql_select_db("warung_app", $con);
//$con = mysql_connect("localhost","ab3127_r35t0","x}.;1O9X.=xw");
mysql_select_db("tahu", $con);
unset($_SESSION['menu_active']);
unset($_SESSION['sub_menu_active']);
?>
