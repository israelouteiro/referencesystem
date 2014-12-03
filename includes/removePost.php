<?php
ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	include "conexao.php";
	$id = addslashes($_POST['id']);
	
	mysql_query("DELETE FROM likes WHERE fk_poste='$id' ");
	mysql_query("DELETE FROM comentarios WHERE fk_poste='$id' ");
	mysql_query("DELETE FROM anexos WHERE fk_poste='$id' ");
	mysql_query("DELETE FROM tags_postes WHERE fk_poste='$id' ");
	//eventualmente poderiamos remover os anexos do servidor caso eles existissem;
	//porem, nao faremos isso visando garantir a integridade dos arquivos caso necessario a sua recuperação ;)
	$s = mysql_query("DELETE FROM postes WHERE id='$id' ");
	echo 'so';
?>