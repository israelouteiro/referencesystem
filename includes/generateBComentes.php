<?php
ob_start();
    session_start();
        session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

    include "conexao.php";
    $idPost = !empty($_GET['id']) ? $_GET['id'] : exit();
    $suCom = mysql_query("SELECT * FROM comentarios WHERE fk_poste='$idPost' ");
    if(haveResults($suCom)){
    	echo mysql_num_rows($suCom);
    }else{
    	echo '0';
    }
?>