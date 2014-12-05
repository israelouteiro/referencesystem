<?php

	ob_start();
		session_start();
			session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	include "conexao.php";
	$id = addslashes( $_POST['id'] );
		$posts = mysql_query("SELECT * FROM postes WHERE id='$id' ");
		if(haveResults($posts)){
				$post_id = mysql_result($posts,0,"id");
		        $post_texto = mysql_result($posts,0,"texto");
		        $post_dataHora = mysql_result($posts,0,"dataHora");
		        $post_tipo = mysql_result($posts,0,"tipo");
		        $post_fk_usuario = mysql_result($posts,0,"fk_usuario");
		        $post_texto = str_replace('\n', '<br>', $post_texto);


		        $post_type = $post_tipo == 'reference'? '' : 'changeReferenceState=true;changeReference();';
		        echo "
		        <div class=\"scriptsEdits\">
		        	<script>
		        		var latex = '".urlencode($post_texto)."';
		        		$('#post-area-middle-textarea').val(urldecode(latex));
		        		".$post_type."
		        			$('#fe_isedit').val('yap');
		        			$('#fe_fkposte').val('".$post_id."');
		        		";
		        	$fktags_post = mysql_query("SELECT * FROM tags_postes WHERE fk_poste='$post_id' ");
		        	if(haveResults($fktags_post)){
		        		for($i=0;$i<mysql_num_rows($fktags_post);$i++){
		        			$idTag = mysql_result($fktags_post,$i,"fk_tag");
		        			if(($i+1)<mysql_num_rows($fktags_post)){
		        				echo "selecionaTags('".$idTag."','".getTag($idTag)."');";
		        			}else{
		        				echo "selecionaTag('".$idTag."','".getTag($idTag)."');";
		        			}	
		        		}
		        	}
		        	$anexos_post = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' ");
		        	if(haveResults($anexos_post)){
		        		for($i=0;$i<mysql_num_rows($anexos_post);$i++){
		        			$anexo_id = mysql_result($anexos_post,$i,"id");
		        			$anexo_source = mysql_result($anexos_post,$i,"source");
		        			$anexo_tipo = mysql_result($anexos_post,$i,"tipo");
		        			$anexo_dataHora = mysql_result($anexos_post,$i,"dataHora");
		        			$anexo_fkUsuario = mysql_result($anexos_post,$i,"fk_usuario");
		        			$anexo_fkPoste = mysql_result($anexos_post,$i,"fk_poste");
		        			echo "sucessoArquivos('".$anexo_id."','".$anexo_source."','".$anexo_tipo."');";
		        		}
		        	}
		       	echo "
		       			//setParamEdit
		       			$('.scriptsEdits').remove();
		        	</script>
		       	</div>";
		}
?>