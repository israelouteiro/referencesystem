<?php
ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	include "conexao.php";
	$id = addslashes($_POST['id']);
	$s = mysql_query("DELETE FROM postes WHERE id='$id' ");
	echo 'so';
?>