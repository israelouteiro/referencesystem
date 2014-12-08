<?php

ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
include "conexao.php";


		$idUx = $_SESSION['loggedU']['id'];
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
			$now = date('Y-m-d H:i:s');
			$gravou = mysql_query("INSERT INTO anexos SET source='$randomName', tipo='imagem', dataHora='$now', fk_usuario='$idUx' ");
			if($gravou){
				$gravado = mysql_query("SELECT * FROM anexos WHERE source='$randomName' ANd tipo='imagem' AND dataHora='$now' AND fk_usuario='$idUx' ");
				if(haveResults($gravado)){
					echo mysql_result($gravado,0,'id').":successfully";
				}else{
					echo "Error on MySQL";
				}
			}else{
				echo "Error on MySQL";
			}
		}else {
			echo "Something went wrong. The image might be too big.";
		}
		
		
		
?>