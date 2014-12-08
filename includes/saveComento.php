<?php

ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
include "conexao.php";

		$idUx = $_SESSION['loggedU']['id'];
		$dataHora = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$fk_poste = addslashes( $_POST['fk_poste']);
		$texto = addslashes(str_replace('\n','<br>',$_POST['texto']));

		$gravouPost = mysql_query("INSERT INTO comentarios SET texto='$texto', dataHora='$dataHora', fk_usuario='$idUx', fk_poste='$fk_poste' ");
		if($gravouPost){
			
				echo 'sim:successfully';
				
		}else{
			echo 'Error on MySQL';
		}

		
?>