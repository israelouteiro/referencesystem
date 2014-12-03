<?php
header("Cache-Control: no-cache, must-revalidate");
$c = addslashes( utf8_decode($_GET['chars']) );

include "../includes/conexao.php";

$campeonatis = mysql_query("SELECT * FROM tags WHERE nome LIKE '%".$c."%'");


$arr=array();
for($i=0;$i < mysql_num_rows($campeonatis);$i++){
	$nome = mysql_result($campeonatis,$i,"nome");
	$idx = mysql_result($campeonatis,$i,"id");
	$descricao = '';
	$imagem = '';

			$arr[]=array("id" => $idx, "data" => "".utf8_encode($nome), "thumbnail" => "brasoes".$imagem, "description" => "".utf8_encode($descricao));
			
}

echo json_encode($arr);
?>