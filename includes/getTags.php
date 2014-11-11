<?php
ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	include "conexao.php";
	$jaTags = $_POST['jaTags'];
	$jaTags = explode(',',$jaTags);

	$cueri = mysql_query("SELECT * FROM tags ORDER BY nome ASC");

	if(haveResults($cueri)){
		$coloquei = 0;
		for($i=0;$i<mysql_num_rows($cueri);$i++){
			$idv = mysql_result($cueri,$i,'id');
			$nome = mysql_result($cueri,$i,'nome');
			if(podeAdd($idv,$jaTags)){
				$coloquei++;
				echo '<li><a style="cursor:pointer;" onclick="selecionaTag(\''.$idv.'\',\''.$nome.'\')">'.$nome.'</a></li>';
			}
		}
		if($coloquei==0){
			echo '<li><a style="cursor:pointer;" >Acabaram as Tags</a></li>';
		}
	}

	function podeAdd($idx,$jt){
		for( $a=0 ; $a < count($jt) ; $a++ ){
			if( floor($jt[$a]) == floor($idx) ){
				return false;
			}
		}
		return true;
	}
?>