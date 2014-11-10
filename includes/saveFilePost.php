<?php

ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
include "conexao.php";

		$idUx = $_SESSION['loggedU']['id'];
		$dataHora = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$dirup =  substr_replace(sha1(microtime(true)), '', 12).'/';
		$uploaddir = '../arquivos/'.$dirup;
		system('mkdir '.$uploaddir);
		system('chmod 777 '.$uploaddir);

		$file = $_POST['value'];
		$name = $_POST['name'];
		
		$getMime = explode('.', $name);
		$mime = end($getMime);
		
		$data = explode(',', $file);
		
		$encodedData = str_replace(' ','+',$data[1]);
		$decodedData = base64_decode($encodedData);
		
		$randomName =  str_replace("áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_",$name);
		
		$nomePhoto = $randomName;
		
		if(file_put_contents($uploaddir.$randomName, $decodedData)) {
			$now = date('Y-m-d H:i:s');
			$randomName = $dirup.$randomName;
			$gravou = mysql_query("INSERT INTO anexos SET source='$randomName', tipo='arquivo', dataHora='$now', fk_usuario='$idUx' ");
			if($gravou){
				$gravado = mysql_query("SELECT * FROM anexos WHERE source='$randomName' ANd tipo='arquivo' AND dataHora='$now' AND fk_usuario='$idUx' ");
				if(haveResults($gravado)){
					echo mysql_result($gravado,0,'id').":successfully";
				}else{
					echo "Erro no MySQL:".$randomName;
				}
			}else{
				echo "Erro no MySQL";
			}
		}else {
			echo "Algo deu errado, o arquivo pode ter sido corrompido.";
		}
		
?>