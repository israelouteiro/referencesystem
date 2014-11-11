<?php
ob_start();
	session_start();
		session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	include "conexao.php";
	$inicio = $_POST['inicio'];
	$fin = $inicio+8;



                        # $quser = mysql_query("SELECT * FROM ( SELECT * FROM usuarios ORDER BY rand() LIMIT 8 ) T1 ORDER BY nome ");
                        $quser = mysql_query(" SELECT * FROM usuarios ORDER BY nome ASC LIMIT $inicio,$fin ");
                         if(haveResults($quser)){
                            for($i=0;$i<mysql_num_rows($quser);$i++){ 
                                $fu = mysql_result($quser,$i,'foto');
                                $udfid = mysql_result($quser,$i,'id_facebook');
                                if(!empty($fu)){
                                    $fu = "arquivos/".$fu;
                                }else{
                                    if(!empty($udfid)){
                                        $fu = "http://graph.facebook.com/".$udfid."/picture?type=large";
                                    }else{
                                        $fu = "images/02.png";
                                    }
                                }

                                ?>
                                <li style="background:url(<?php echo $fu; ?>) no-repeat center center; background-size:cover;">
                                    <img src="images/02.jpg" width="100%" style="visibility:hidden;">
                                </li>
                            <?php }} ?>