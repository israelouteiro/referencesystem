<?php
	/*
		added by israelOuteiro 06-11-14

		Model user

	*/


	/*
			$_SESSION['loggedU']['id'] = mysql_result($sucess,0,"id");
            $_SESSION['loggedU']['nome'] = mysql_result($sucess,0,"nome");
            $_SESSION['loggedU']['email'] = mysql_result($sucess,0,"email");
            $_SESSION['loggedU']['foto'] = mysql_result($sucess,0,"foto");
            $_SESSION['loggedU']['ultimo_login'] = mysql_result($sucess,0,"ultimo_login");
            $_SESSION['loggedU']['data_cadastro'] = mysql_result($sucess,0,"data_cadastro");
            $_SESSION['loggedU']['permissao'] = mysql_result($sucess,0,"permissao");
	*/

       $idUx = $_SESSION['loggedU']['id'];
	$queryUsuario = mysql_query("SELECT * FROM usuarios WHERE id='$idUx' ");
	if(haveResults($queryUsuario)){

		$user_nome = mysql_result($queryUsuario,0,"nome");
		$user_email = mysql_result($queryUsuario,0,"email");
		$user_foto = mysql_result($queryUsuario,0,"foto");
		$user_cargo = mysql_result($queryUsuario,0,"cargo");
		$user_pais = mysql_result($queryUsuario,0,"pais");
		$user_estado = mysql_result($queryUsuario,0,"estado");
		$user_cidade = mysql_result($queryUsuario,0,"cidade");
		$user_empresa = mysql_result($queryUsuario,0,"empresa");
		$user_sobre = mysql_result($queryUsuario,0,"sobre");

	}
	
?>