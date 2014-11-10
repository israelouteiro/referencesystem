<?php
ob_start();
    session_start();
        session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

    include "conexao.php";
    $idPost = !empty($_GET['id']) ? $_GET['id'] : exit();
    $idUx = $_SESSION['loggedU']['id'];
    $now = date('Y-m-d H:i:s');
    $jCurti = mysql_query("SELECT * FROM likes WHERE fk_poste='$idPost' AND fk_usuario='$idUx' ");
    if(haveResults($jCurti)){
    	mysql_query("DELETE FROM likes WHERE fk_poste='$idPost' AND fk_usuario='$idUx' ");

    	$nCL = mysql_query("SELECT * FROM likes WHERE fk_poste='$idPost'");
    	$numLik = haveResults($nCL)? mysql_num_rows($nCL):0;
    	echo 'descurtiu:'.$numLik;
    }else{
    	mysql_query("INSERT INTO likes SET fk_poste='$idPost', fk_usuario='$idUx', dataHora='$now' ");

    	$nCL = mysql_query("SELECT * FROM likes WHERE fk_poste='$idPost'");
    	$numLik = haveResults($nCL)? mysql_num_rows($nCL):0;
    	echo 'curtiu:'.$numLik;
    }
?>