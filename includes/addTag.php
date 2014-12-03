<?php
ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	include "conexao.php";
	$tag = addslashes($_POST['nome']);
	$idUx = $_SESSION['loggedU']['id'];
	$now = date('Y-m-d H:i:s');
	$tem = mysql_query("SELECT * FROM tags WHERE nome='$tag'");
	
	if(haveResults($tem)){
		echo 'sucesso:'.mysql_result($tem,0,'id');
	}else{
		$gravou = mysql_query("INSERT INTO tags SET nome='$tag', dataHora='$now', fk_usuario='$idUx' ");
		$gg = mysql_query("SELECT * FROM tags WHERE nome='$tag' AND dataHora='$now' AND fk_usuario='$idUx' ");
		if(haveResults($gg)){
			if($gravou){
				echo 'sucesso:'.mysql_result($gg,0,'id');
			}else{
				echo 'error:'.$tag;
			}
		}else{
			echo 'error:'.$tag;
		}
	}
?>