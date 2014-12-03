<?php

ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
include "conexao.php";

		

		$idUx = $_SESSION['loggedU']['id'];
		//$nomePhoto = "_ref_".rand(1000,100000).uniqid()."_".str_replace("áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_",$_FILES['foto']['name']);
		$dataHora = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$uploaddir = '../arquivos/';

		$file = $_POST['value'];
		$name = $_POST['name'];
		
		$getMime = explode('.', $name);
		$mime = end($getMime);
		
		$data = explode(',', $file);
		
		$encodedData = str_replace(' ','+',$data[1]);
		$decodedData = base64_decode($encodedData);
		
		$randomName = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;
		
		$nomePhoto = $randomName;
		
		if(file_put_contents($uploaddir.$randomName, $decodedData)) {
			//salvaImagem($uploaddir.$nomePhoto, 480);
			echo $randomName.":successfully";
		}else {
			echo "Algo deu errado, a imagem pode ter sido corrompida.";
		}
		
		$gravou = mysql_query("UPDATE usuarios SET foto='$randomName' WHERE id='$idUx' ");
		
?>