<?php


ob_start();
    session_start();
        session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
        

    include "conexao.php";
    $inicio = !empty($_GET['in']) ? $_GET['in'] : 0;
    $final =  $inicio + 12;
    $filtro = $_POST['filtro'];

                        if( empty($filtro) ){
                            $posts = mysql_query("SELECT * FROM postes ORDER BY dataHora DESC LIMIT $inicio,$final ");
                        }else{
                            if($filtro=='reference'){
                                $posts = mysql_query("SELECT * FROM postes WHERE tipo='reference' ORDER BY dataHora DESC LIMIT $inicio,$final ");
                            }else{
                                if($filtro=='request'){
                                   $posts = mysql_query("SELECT * FROM postes WHERE tipo='request' ORDER BY dataHora DESC LIMIT $inicio,$final ");
                                }else{
                                    if($filtro=='all'){
                                        $posts = mysql_query("SELECT * FROM postes ORDER BY dataHora DESC LIMIT $inicio,$final ");
                                    }else{
                                        $tags4T =mysql_query("SELECT * FROM tags_postes WHERE fk_tag='$filtro' ");
                                        $likeTag = "";
                                        if(haveResults($tags4T)){
                                            $likeTag .= "WHERE ";
                                            for($ff=0;$ff<mysql_num_rows($tags4T);$ff++){
                                               $idPos = mysql_result($tags4T,$ff,'fk_poste');
                                               if(($ff+1)<mysql_num_rows($tags4T)){
                                                    $likeTag .= "id='$idPos' OR "; 
                                               }else{
                                                    $likeTag .= "id='$idPos' "; 
                                               }
                                            }
                                            $posts = mysql_query("SELECT * FROM postes $likeTag ORDER BY dataHora DESC LIMIT $inicio,$final ");
                                        }else{
                                            //Nada
                                        }
                                    }
                                }
                            }
                        }


if(haveResults($posts)){

    for($ixi=0; $ixi < mysql_num_rows($posts); $ixi++){
        $post_id = mysql_result($posts,$ixi,"id");
        $post_texto = mysql_result($posts,$ixi,"texto");
        $post_dataHora = mysql_result($posts,$ixi,"dataHora");
        $post_tipo = mysql_result($posts,$ixi,"tipo");
        $post_fk_usuario = mysql_result($posts,$ixi,"fk_usuario");

        $post_texto = linkifyYouTubeURLs($post_texto);

        $usuarioPostante = mysql_query("SELECT * FROM usuarios WHERE id='$post_fk_usuario' ");
        if(haveResults($usuarioPostante)){

            $user_nome = mysql_result($usuarioPostante,0,"nome");
            $user_email = mysql_result($usuarioPostante,0,"email");
            $user_foto = mysql_result($usuarioPostante,0,"foto");
            $user_cargo = mysql_result($usuarioPostante,0,"cargo");
            $user_pais = mysql_result($usuarioPostante,0,"pais");
            $user_estado = mysql_result($usuarioPostante,0,"estado");
            $user_cidade = mysql_result($usuarioPostante,0,"cidade");
            $user_empresa = mysql_result($usuarioPostante,0,"empresa");
            $user_sobre = mysql_result($usuarioPostante,0,"sobre");
            $user_idFacebook = mysql_result($usuarioPostante,0,"id_facebook");



                            if(!empty($user_foto)){
                                $foto_user = "arquivos/".$user_foto;
                            }else{
                                if(!empty($user_idFacebook)){
                                    $foto_user = "http://graph.facebook.com/".$user_idFacebook."/picture?type=large";
                                }else{
                                    $foto_user = "images/02.png";
                                }
                            }

        }

         $idUx = $_SESSION['loggedU']['id'];
    
        $luzer = mysql_query("SELECT * FROM usuarios WHERE id='$idUx' ");
        if(haveResults($luzer)){

            $luzer_nome = mysql_result($luzer,0,"nome");
            $luzer_email = mysql_result($luzer,0,"email");
            $luzer_foto = mysql_result($luzer,0,"foto");
            $luzer_cargo = mysql_result($luzer,0,"cargo");
            $luzer_pais = mysql_result($luzer,0,"pais");
            $luzer_estado = mysql_result($luzer,0,"estado");
            $luzer_cidade = mysql_result($luzer,0,"cidade");
            $luzer_empresa = mysql_result($luzer,0,"empresa");
            $luzer_sobre = mysql_result($luzer,0,"sobre");
            $luzer_idFacebook = mysql_result($luzer,0,"id_facebook");



                            if(!empty($luzer_foto)){
                                $luzer_foto = "arquivos/".$luzer_foto;
                            }else{
                                if(!empty($luzer_idFacebook)){
                                    $luzer_foto = "http://graph.facebook.com/".$luzer_idFacebook."/picture?type=large";
                                }else{
                                    $luzer_foto = "images/02.png";
                                }
                            }

        }

        $suCom = mysql_query("SELECT * FROM comentarios WHERE fk_poste='$post_id' ");
        if(haveResults($suCom)){
            $numComentos = mysql_num_rows($suCom);
        }else{
            $numComentos = 0;
        }

        if($post_tipo=='reference'){ 
            ?>

                <!-- Start of REFERENCE POST -->
                <div class="plataforma-post reference">
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-profile">
                            <div class="post-profile-image <?php if($idUx==$post_fk_usuario){echo 'userPhotoProfile'; } ?>"  style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;" ><img src="images/07.jpg" style="visibility:hidden;"></div>
                            <div class="post-profile-infos">
                                <p class="uo-name" onclick="$(this).next('.post-profile-infos-popup').toggle();"><?php echo $user_nome; ?></p>
                                <!-- Profile infos POPUP -->
                                <div class="post-profile-infos-popup" style="display:none;">
                                    <div class="infos-popup-image <?php if($idUx==$post_fk_usuario){echo 'userPhotoProfile'; } ?>" style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;">
                                        <img src="images/10.jpg" style="visibility:hidden;">
                                    </div>
                                    <div class="infos-popup-infos">
                                        <p class="infos-popup-title"><?php echo $user_nome; ?></p>
                                        <table>
                                            <tr>
                                                <td rowspan="2"><img src="images/26.png"></td>
                                                <td><p><?php echo $user_cidade; ?> - <?php echo $user_estado; ?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><?php echo $user_pais; ?></p></td>
                                            </tr>
                                        </table>
                                        <p><?php echo $user_cargo; ?></p>
                                        <p><?php echo $user_empresa; ?></p>
                                    </div>
                                    <div class="infos-popup-text">
                                        <p class="infos-popup-title">About me:</p>
                                        <p><?php echo $user_sobre; ?></p>
                                    </div>
                                </div>
                                <!-- END of popup -->



                                <p><?php echo $user_cidade; ?> - <?php echo $user_estado; ?></p>
                                <p>&nbsp;</p>


                                <?php $data = explode(' ',$post_dataHora);
                                $data = $data[0];
                                $data = explode('-',$data); ?>
                                <p><?php echo $data[2]; ?> de <?php echo nmes2tmes($data[1]); ?> - <?php echo $data[0]; ?></p>


                            </div>


                            <!-- 

                            Alternar esta flag com a lixeira se o camarada for administrador ou o dono do post...
                            
                            images/34.png 

                            -->
                            <?php 
                            if($idUx == $post_fk_usuario){
                                $havePower = true;
                            }else{
                                if($_SESSION['loggedU']['permissao'] == 'admin'){
                                    $havePower = true;
                                }else{
                                    $havePower = false;
                                }
                            }

                            ?>
                            <div class="post-profile-flag">
                                <img src="images/14.png" <?php if($havePower){ ?>style="cursor:pointer;"  
                                onmouseover="$(this).attr('src','images/34.png');" 
                                onmouseout="$(this).attr('src','images/14.png');" onclick="removePost('<?php echo $post_id; ?>');" <?php } ?> >
                            </div>
                            <div class="clear"></div>

                        </div>
                        <div class="hottest-posts-module-link">
                            <ul>
                                    <?php $q_tags = mysql_query("SELECT * FROM tags_postes WHERE fk_poste='$post_id' ");
                                     if(haveResults($q_tags)){ 
                                        for($i=0;$i<mysql_num_rows($q_tags);$i++){
                                            $idtag = mysql_result($q_tags,$i,"fk_tag");
                                            $vtag = getTag($idtag);
                                            if(!empty($vtag)){
                                        ?>
                                        <li onclick="location.href=('search.php?tag=<?php echo $idtag; ?>')">#<?php echo $vtag; ?></li>
                                    <?php }}} ?>
                            </ul>
                        </div>
                        <p class="postTexto"><?php echo $post_texto; ?></p>

                        <?php $arAnIt = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' AND tipo='arquivo' ");
                            if(haveResults($arAnIt)){
                         ?>
                        <div class="post-area-attaches">
                            <ul>   
                                <?php for($z=0;$z<mysql_num_rows($arAnIt);$z++){

                                    $ss = mysql_result($arAnIt,$z,"source");
                                    $source = explode('/',$ss);$source = $source[1];
                                    ?>
                                <li onclick="window.open('arquivos/<?php echo $ss; ?>','_new<?php echo $post_id; ?>')"><img src="images/37.png"> <?php echo $source; ?> </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <div class="clear"></div>
                    </div>
                    <div class="post-profile-bigimage">
                        



                        <?php $fotosDestePost = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' AND tipo='imagem' ");
                            if(haveResults($fotosDestePost)){
                         ?>
                        <div id="carousel-example-generic<?php echo $post_id; ?>" class="carousel slide" data-ride="carousel">

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">

                            <?php for($a=0;$a<mysql_num_rows($fotosDestePost);$a++){
                                $srcPhoto = mysql_result($fotosDestePost,$a,"source");

                            ?>
                                <div class="item <?php if($a==0){echo 'active';}?>" style="background:url(arquivos/<?php echo $srcPhoto; ?>) no-repeat center center;background-size:cover; cursor:pointer;"
                                onclick="$('#myModal img').attr('src','arquivos/<?php echo $srcPhoto; ?>');" data-toggle="modal" data-target="#myModal">
                                  <img src="images/06.jpg" alt="" width="100%" style="visibility:hidden;">
                                </div>
                            <?php } ?>

                          </div>
                                <?php if(mysql_num_rows($fotosDestePost)>1){ ?>
                                <!-- Controls -->
                              <a class="left carousel-control" href="#carousel-example-generic<?php echo $post_id; ?>" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                              </a>

                              <a class="right carousel-control" href="#carousel-example-generic<?php echo $post_id; ?>" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                              </a>
                              <?php } ?>
                        </div>

                        <?php } ?>


                    </div>
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-liked">

                            <div class="post-liked-left" id="likesObj<?php echo $post_id; ?>">
                             

                                <?php 
    $jCurti = mysql_query("SELECT * FROM likes WHERE fk_poste='$post_id' AND fk_usuario='$idUx' ");
    if(haveResults($jCurti)){ $img_lik = 'images/17.png'; }else{ $img_lik = 'images/18.png'; }?>

                                <img src="<?php echo $img_lik; ?>" class="post-liked-hearth" onclick="curtiu('<?php echo $post_id; ?>');">

                                <?php $likes = mysql_query("SELECT * FROM likes WHERE fk_poste='$post_id' ");
                                    if(haveResults($likes)){
                                        $numLikes = mysql_num_rows($likes);
                                    }else{
                                        $numLikes = 0;
                                    }
                                 ?>
                                <p><?php echo $numLikes; ?> users liked</p>

                            </div>

                            <div class="post-liked-right">
                                <img src="images/16.png">
                                <p id="bComm<?php echo $post_id; ?>"><?php echo $numComentos; ?> comments</p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="plataforma-post-comment">
                            <div class="post-comment-image userPhotoProfile" style="background:url(<?php echo $luzer_foto; ?>) no-repeat center center; background-size:cover;">
                                <img src="images/08.jpg" style="visibility:hidden;">
                            </div>
                            <div class="post-comment-text">
                                <textarea placeholder="Write a comment..." class="post-comment-textarea" onkeyup="if(event.keyCode==13){postComment('<?php echo $post_id; ?>'); }" id="textos_comentarios<?php echo $post_id; ?>"></textarea>
                            </div>
                            <div class="clear"></div>
                            <div class="more-comment">
                                <button class="btn btn-link more-comment-expand" onclick="$(this).parent().next('.more-comment-container').slideToggle();">View comments <span class="caret"></span></button>
                            </div>
                            <div class="more-comment-container" style="display:none;" id="lista_comentartio<?php echo $post_id; ?>">

                                
                            </div>
                        </div>
                    </div>
                </div><!-- end of REFERENCE POST -->
                <script>recarregaComentarios(<?php echo $post_id; ?>);</script>



                <?php 
        }else { 
            ?>

                <!-- Start of REQUEST POST -->
                <div class="plataforma-post request">
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-profile">
                            <div class="post-profile-image <?php if($idUx==$post_fk_usuario){echo 'userPhotoProfile'; } ?>"  style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;"><img src="images/07.jpg" style="visibility:hidden;"></div>
                            <div class="post-profile-infos">
                                <p class="uo-name" onclick="$(this).next('.post-profile-infos-popup').toggle();"><?php echo $user_nome; ?></p>
                                <!-- Profile infos POPUP -->
                                <div class="post-profile-infos-popup" style="display:none;">
                                    <div class="infos-popup-image <?php if($idUx==$post_fk_usuario){echo 'userPhotoProfile'; } ?>" style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;">
                                        <img src="images/10.jpg" style="visibility:hidden;">
                                    </div>
                                    <div class="infos-popup-infos">
                                        <p class="infos-popup-title"><?php echo $user_nome; ?></p>
                                        <table>
                                            <tr>
                                                <td rowspan="2"><img src="images/26.png"></td>
                                                <td><p><?php echo $user_cidade; ?> - <?php echo $user_estado; ?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><?php echo $user_pais; ?></p></td>
                                            </tr>
                                        </table>
                                        <p><?php echo $user_cargo; ?></p>
                                        <p><?php echo $user_empresa; ?></p>
                                    </div>
                                    <div class="infos-popup-text">
                                        <p class="infos-popup-title">About me:</p>
                                        <p><?php echo $user_sobre; ?></p>
                                    </div>
                                </div>
                                <!-- END of popup -->



                                <p><?php echo $user_cidade; ?> - <?php echo $user_estado; ?></p>
                                <p>&nbsp;</p>
                                <?php $data = explode(' ',$post_dataHora);$data = $data[0];$data = explode('-',$data); ?>
                                <p><?php echo $data[2];?> de <?php echo nmes2tmes($data[1]);?> - <?php echo $data[0]; ?></p>
                            </div>

                            <!-- 

                            Alternar esta flag com a lixeira se o camarada for administrador ou o dono do post...

                            images/34.png 

                            -->

                            <?php 

                                if($idUx == $post_fk_usuario){
                                    $havePower = true;
                                }else{
                                    if($_SESSION['loggedU']['permissao'] == 'admin'){
                                        $havePower = true;
                                    }else{
                                        $havePower = false;
                                    }
                                }

                            ?>
                            <div class="post-profile-flag">
                                <img src="images/15.png" <?php if($havePower){ ?>style="cursor:pointer;"  
                                onmouseover="$(this).attr('src','images/34.png');" 
                                onmouseout="$(this).attr('src','images/15.png');" onclick="removePost('<?php echo $post_id; ?>');" <?php } ?>>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="hottest-posts-module-link">
                            <ul>
                                    <?php $q_tags = mysql_query("SELECT * FROM tags_postes WHERE fk_poste='$post_id' "); if(haveResults($q_tags)){ 
                                        for($i=0;$i<mysql_num_rows($q_tags);$i++){
                                            $idtag = mysql_result($q_tags,$i,"fk_tag");
                                            $vtag = getTag($idtag);
                                            if(!empty($vtag)){
                                        ?>
                                        <li onclick="location.href=('search.php?tag=<?php echo $idtag; ?>')">#<?php echo $vtag; ?></li>
                                    <?php }}} ?>
                            </ul>
                        </div>
                        <p class="postTexto"><?php echo $post_texto; ?></p>


                        <?php $arAnIt = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' AND tipo='arquivo' ");
                            if(haveResults($arAnIt)){
                         ?>
                        <div class="post-area-attaches">
                            <ul>   
                                <?php for($z=0;$z<mysql_num_rows($arAnIt);$z++){
                                    $ss = mysql_result($arAnIt,$z,"source");
                                    $source = explode('/',$ss);
                                    $source = $source[1];
                                    ?>
                                <li onclick="window.open('arquivos/<?php echo $ss; ?>','_new<?php echo $post_id; ?>')"><img src="images/37.png"> <?php echo $source; ?> </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <div class="clear"></div>


                    </div>
                    <div class="post-profile-bigimage">
                        <?php $fotosDestePost = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' AND tipo='imagem' ");
                            if(haveResults($fotosDestePost)){
                         ?>
                        <div id="carousel-example-generic<?php echo $post_id; ?>" class="carousel slide" data-ride="carousel">

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">

                            <?php for($a=0;$a<mysql_num_rows($fotosDestePost);$a++){
                                $srcPhoto = mysql_result($fotosDestePost,$a,"source");

                            ?>
                                <div class="item <?php if($a==0){echo 'active';}?>" style="background:url(arquivos/<?php echo $srcPhoto; ?>) no-repeat center center;background-size:cover; cursor:pointer;"
                                onclick="$('#myModal img').attr('src','arquivos/<?php echo $srcPhoto; ?>');" data-toggle="modal" data-target="#myModal">
                                  <img src="images/06.jpg" alt="" width="100%" style="visibility:hidden;">
                                </div>
                            <?php } ?>

                          </div>
                                <?php if(mysql_num_rows($fotosDestePost)>1){ ?>
                                <!-- Controls -->
                              <a class="left carousel-control" href="#carousel-example-generic<?php echo $post_id; ?>" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                              </a>

                              <a class="right carousel-control" href="#carousel-example-generic<?php echo $post_id; ?>" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                              </a>
                              <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-liked">
                            <div class="post-liked-left" id="likesObj<?php echo $post_id; ?>">

                            <?php 
    $jCurti = mysql_query("SELECT * FROM likes WHERE fk_poste='$post_id' AND fk_usuario='$idUx' ");
    if(haveResults($jCurti)){ $img_lik = 'images/17.png'; }else{ $img_lik = 'images/18.png'; }

    ?>

                                <img src="<?php echo $img_lik; ?>" class="post-liked-hearth" onclick="curtiu('<?php echo $post_id; ?>');">


                                <?php $likes = mysql_query("SELECT * FROM likes WHERE fk_poste='$post_id' ");
                                    if(haveResults($likes)){
                                        $numLikes = mysql_num_rows($likes);
                                    }else{
                                        $numLikes = 0;
                                    }
                                 ?>
                                <p><?php echo $numLikes; ?> users liked</p>

                            </div>
                            <div class="post-liked-right">
                                <img src="images/16.png">
                                <p id="bComm<?php echo $post_id; ?>"><?php echo $numComentos; ?> comments</p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="plataforma-post-comment">
                            <div class="post-comment-image userPhotoProfile" style="background:url(<?php echo $luzer_foto; ?>) no-repeat center center; background-size:cover;">
                                <img src="images/08.jpg" style="visibility:hidden;">
                            </div>
                            <div class="post-comment-text">
                                <textarea placeholder="Write a comment..." class="post-comment-textarea" onkeyup="if(event.keyCode==13){postComment('<?php echo $post_id; ?>'); }" id="textos_comentarios<?php echo $post_id; ?>"></textarea>
                            </div>
                            <div class="clear"></div>
                            <div class="more-comment">
                                <button class="btn btn-link more-comment-expand" onclick="$(this).parent().next('.more-comment-container').slideToggle();">View comments <span class="caret"></span></button>
                            </div>
                            <div class="more-comment-container" style="display:none;" id="lista_comentartio<?php echo $post_id; ?>">
                                
                            </div>
                        </div>
                    </div>
                </div><!-- end of post request -->
                <script>recarregaComentarios(<?php echo $post_id; ?>);</script>
            <?php
        }


    }
}

?>
<script>
    function linkas(){
        $('.postTexto').linkify();
    }
    setTimeout(linkas,500);
</script>