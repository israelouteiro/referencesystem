<?php
ob_start();
    session_start();
        session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

    include "conexao.php";
    $idPost = !empty($_GET['id']) ? $_GET['id'] : exit();
    $suCom = mysql_query("SELECT * FROM comentarios WHERE fk_poste='$idPost' ORDER BY dataHora DESC ");
    if(haveResults($suCom)){
    	for($i=0;$i<mysql_num_rows($suCom);$i++){
    		$tex = mysql_result($suCom,$i,"texto");
    		$fk_usuario = mysql_result($suCom,$i,"fk_usuario");
    		$uZ = mysql_query("SELECT * FROM usuarios WHERE id='$fk_usuario' ");
    		if(haveResults($uZ)){
    			$fotoV = mysql_result($uZ,0,'foto');
    			$fotoVid_facebook = mysql_result($uZ,0,'id_facebook');
    		}


    						if(!empty($fotoV)){
                                $fotoV = "arquivos/".$fotoV;
                            }else{
                                if(!empty($fotoVid_facebook)){
                                    $fotoV = "http://graph.facebook.com/".$fotoVid_facebook."/picture?type=large";
                                }else{
                                    $fotoV = "images/02.png";
                                }
                            }
?>
	<div class="more-comment-modulo">
        <div class="more-comment-modulo-image" style="background:url(<?php echo $fotoV; ?>) no-repeat center center;background-size:cover;">
        	<img src="images/08.jpg" style="visibility:hidden;"></div>
        <div class="more-comment-modulo-text"><p><?php echo $tex; ?></p></div>
    </div>
    <div class="clear"></div>
<?php } }?>