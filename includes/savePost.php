<?php

ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
include "conexao.php";

		$idUx = $_SESSION['loggedU']['id'];
		$dataHora = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$tags = addslashes( $_POST['fe_tags']);
		$tags = explode(',',$tags);
		$anexos = addslashes( $_POST['fe_anexos']);
		$anexos = explode(',',$anexos);

		$type = addslashes( $_POST['fe_type']);
		$texto = addslashes(str_replace('\n','<br>',$_POST['fe_texto']));

		if( isset($_POST['fe_isedit']) && !empty($_POST['fe_isedit']) && $_POST['fe_isedit']=='yap' ){
			$fk_poste = addslashes($_POST['fe_fkposte']);

			$gravouPost = mysql_query("UPDATE postes SET texto='$texto', tipo='$type' WHERE id='$fk_poste' ");
			if($gravouPost){
					mysql_query("DELETE FROM tags_postes WHERE fk_poste='$fk_poste' ");
					mysql_query("UPDATE anexos SET fk_poste='' WHERE fk_poste='$fk_poste' ");
					for($i=0;$i<count($tags);$i++){
						$single_tag = $tags[$i];
						mysql_query("INSERT INTO tags_postes SET fk_poste='$fk_poste', fk_tag='$single_tag' ");
					}
					for($i=0;$i<count($anexos);$i++){
						$single_an = $anexos[$i];
						mysql_query("UPDATE anexos SET fk_poste='$fk_poste' WHERE id='$single_an' ");
					}
					echo 'sim:successfully';
			}else{
				echo 'Erro no MySQL';
			}

		}else{
			$gravouPost = mysql_query("INSERT INTO postes SET texto='$texto', dataHora='$dataHora', tipo='$type', fk_usuario='$idUx' ");
			if($gravouPost){
				$pgv = mysql_query("SELECT * FROM postes WHERE texto='$texto' AND dataHora='$dataHora' AND tipo='$type' AND fk_usuario='$idUx' ");
				if(haveResults($pgv)){
					$idPostado = mysql_result($pgv,0,'id');
					for($i=0;$i<count($tags);$i++){
						$single_tag = $tags[$i];
						mysql_query("INSERT INTO tags_postes SET fk_poste='$idPostado', fk_tag='$single_tag' ");
					}
					for($i=0;$i<count($anexos);$i++){
						$single_an = $anexos[$i];
						mysql_query("UPDATE anexos SET fk_poste='$idPostado' WHERE id='$single_an' ");
					}
					echo 'sim:successfully';
				}
			}else{
				echo 'Erro no MySQL';
			}
		}

		
?>