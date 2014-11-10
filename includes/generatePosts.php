<?php
ob_start();
    session_start();
        session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

    include "conexao.php";
    $inicio = !empty($_GET['in']) ? $_GET['in'] : 0;
    $final =  $inicio + 6;
    $posts = mysql_query("SELECT * FROM postes ORDER BY dataHora DESC LIMIT $inicio,$final ");

    if(haveResults($posts)){
    for($ii=0;$ii <mysql_num_rows($posts); $ii++){
        $post_id = mysql_result($posts,$ii,"id");
        $post_texto = mysql_result($posts,$ii,"texto");
        $post_dataHora = mysql_result($posts,$ii,"dataHora");
        $post_tipo = mysql_result($posts,$ii,"tipo");
        $post_fk_usuario = mysql_result($posts,$ii,"fk_usuario");

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




        $luzer = mysql_query("SELECT * FROM usuarios WHERE id='$post_fk_usuario' ");
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
                                    $luzer_foto = "http://graph.facebook.com/".$luzer_foto."/picture?type=large";
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
                            <div class="post-profile-image"  style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;" ><img src="images/07.jpg" style="visibility:hidden;"></div>
                            <div class="post-profile-infos">
                                <p class="uo-name" onclick="$(this).next('.post-profile-infos-popup').toggle();"><?php echo $user_nome; ?></p>
                                <!-- Profile infos POPUP -->
                                <div class="post-profile-infos-popup" style="display:none;">
                                    <div class="infos-popup-image" style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;">
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
                            <div class="post-profile-flag"><img src="images/14.png"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="hottest-posts-module-link">
                            <ul>
                                    <?php $q_tags = mysql_query("SELECT * FROM tags_postes WHERE fk_poste='$post_id' "); if(haveResults($q_tags)){ 
                                        for($i=0;$i<mysql_num_rows($q_tags);$i++){
                                            $idtag = mysql_result($q_tags,$i,"fk_tag");
                                            $vtag = getTag($idtag);
                                        ?>
                                        <li>#<?php echo $vtag; ?></li>
                                    <?php }} ?>
                            </ul>
                        </div>
                        <p><?php echo $post_texto; ?></p>

                        <div class="post-area-attaches">
                            <ul>
                                <li><img src="images/37.png"> file_file.jpg </li>
                                <li><img src="images/37.png"> file_file.jpg </li>
                                <li><img src="images/37.png"> file_image.jpg </li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post-profile-bigimage">
                        



                        <?php $fotosDestePost = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' AND tipo='imagem' ");
                            if(haveResults($fotosDestePost)){
                         ?>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">

                            <?php for($a=0;$a<mysql_num_rows($fotosDestePost);$a++){
                                $srcPhoto = mysql_result($fotosDestePost,$a,"source");

                            ?>
                                <div class="item <?php if($a==0){echo 'active';}?>">
                                  <img src="arquivos/<?php echo $srcPhoto; ?>" alt="" width="100%">
                                  <div class="carousel-caption">
                                  </div>
                                </div>
                            <?php } ?>

                          </div>
                                <?php if(mysql_num_rows($fotosDestePost)>1){ ?>
                                <!-- Controls -->
                              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                              </a>

                              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                              </a>
                              <?php } ?>
                        </div>

                        <?php } ?>


                    </div>
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-liked">
                            <div class="post-liked-left">
                                <img src="images/18.png" class="post-liked-hearth">
                                <p>53 users liked</p>
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



                <?php }else{ ?>



                <!-- Start of REQUEST POST -->
                <div class="plataforma-post request">
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-profile">
                            <div class="post-profile-image"  style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;"><img src="images/07.jpg" style="visibility:hidden;"></div>
                            <div class="post-profile-infos">
                                <p class="uo-name" onclick="$(this).next('.post-profile-infos-popup').toggle();"><?php echo $user_nome; ?></p>
                                <!-- Profile infos POPUP -->
                                <div class="post-profile-infos-popup" style="display:none;">
                                    <div class="infos-popup-image" style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;">
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
                            <div class="post-profile-flag"><img src="images/15.png"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="hottest-posts-module-link">
                            <ul>
                                    <?php $q_tags = mysql_query("SELECT * FROM tags_postes WHERE fk_poste='$post_id' "); if(haveResults($q_tags)){ 
                                        for($i=0;$i<mysql_num_rows($q_tags);$i++){
                                            $idtag = mysql_result($q_tags,$i,"fk_tag");
                                            $vtag = getTag($idtag);
                                        ?>
                                        <li>#<?php echo $vtag; ?></li>
                                    <?php }} ?>
                            </ul>
                        </div>
                        <p><?php echo $post_texto; ?></p>

                        <div class="post-area-attaches">
                            <ul>
                                <li><img src="images/37.png"> file_file.jpg </li>
                                <li><img src="images/37.png"> file_file.jpg </li>
                                <li><img src="images/37.png"> file_image.jpg </li>
                            </ul>
                        </div>
                        <div class="clear"></div>


                    </div>
                    <div class="post-profile-bigimage">
                        <?php $fotosDestePost = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' AND tipo='imagem' ");
                            if(haveResults($fotosDestePost)){
                         ?>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">

                            <?php for($a=0;$a<mysql_num_rows($fotosDestePost);$a++){
                                $srcPhoto = mysql_result($fotosDestePost,$a,"source");

                            ?>
                                <div class="item <?php if($a==0){echo 'active';}?>">
                                  <img src="arquivos/<?php echo $srcPhoto; ?>" alt="">
                                  <div class="carousel-caption"></div>
                                </div>
                            <?php } ?>

                          </div>
                                <?php if(mysql_num_rows($fotosDestePost)>1){ ?>
                                <!-- Controls -->
                              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                              </a>

                              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                              </a>
                              <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-liked">
                            <div class="post-liked-left">
                                <img src="images/18.png" class="post-liked-hearth">
                                <p>53 users liked</p>
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


<? }}} //n tem resultados ainda; ?>