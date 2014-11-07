<?php
ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	include "conexao.php";
	$tag = addslashes($_POST['nome']);
	$idUx = $_SESSION['loggedU']['id'];
	$now = date('Y-m-d H:i:s');
	$gravou = mysql_query("INSERT INTO tags SET nome='$tag', dataHora='$now', fk_usuario='$idUx' ");

	if($gravou){
		echo 'sucesso';
	}else{
		echo 'error:'.$tag;
	}

?>