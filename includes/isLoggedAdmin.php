<?php
/*
	Reference system for Racionalize
	developed by israelOuteiro, out/2014
*/
ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
			if(isset($_SESSION['loggedU']['id']) && !empty($_SESSION['loggedU']['id']) && $_SESSION['loggedU']['id'] != ''){
				//Maybe Good login
					if($_SESSION['loggedU']['permissao'] != 'admin'){
					//Good login
					}else{
							header("Location:login.php");
							exit();
					}
			}else{
					header("Location:login.php");
					exit();
			}
/*
	Sessao de users logados;

	$_SESSION['loggedU']['id'];
	$_SESSION['loggedU']['nome'];
	$_SESSION['loggedU']['email'];
	$_SESSION['loggedU']['foto'];
	$_SESSION['loggedU']['ultimo_login'];
	$_SESSION['loggedU']['data_cadastro'];
	$_SESSION['loggedU']['permissao'];
*/
?>
