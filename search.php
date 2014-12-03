<?php 
    
    include "includes/isLogged.php";
    include "includes/conexao.php";
    include "includes/queryUsuario.php";

    $tipo = '';

    if(isset($_POST['valorBusca'])){
        $search = addslashes( $_POST['valorBusca'] );
        $hottestPosts = mysql_query("SELECT * FROM postes WHERE texto LIKE '%$search%' ORDER BY dataHora DESC");
        $expressaoProcurada = $_POST['valorBusca'];
        $tipo = 'busca';


        $pTags = mysql_query("SELECT * FROM tags WHERE nome like '%$search%' ");
        $queryTaaag = "";
        if(haveResults($pTags)){
            for($i=0;$i<mysql_num_rows($pTags);$i++){
                $tgs_fkpos = mysql_result($pTags,$i,'id');
                if(($i+1)<mysql_num_rows($pTags)){
                    $queryTaaag .= " fk_tag='$tgs_fkpos' OR ";
                }else{
                    $queryTaaag .= " fk_tag='$tgs_fkpos' ";
                }
            }
        }

    }

    if(isset($_GET['tag']) || !empty($queryTaaag) ){
        $tag = $_GET['tag'];
        $t4G = !empty($queryTaaag) ? mysql_query("SELECT * FROM tags_postes WHERE $queryTaaag ") : mysql_query("SELECT * FROM tags_postes WHERE fk_tag='$tag' ");
        $likeT4G = "";
        if(haveResults($t4G)){
            $likeT4G = " WHERE ";
            for($i=0;$i<mysql_num_rows($t4G);$i++){
                $tgs_fkpos = mysql_result($t4G,$i,'fk_poste');
                if(($i+1)<mysql_num_rows($t4G)){
                    $likeT4G .= " id='$tgs_fkpos' OR ";
                }else{
                    $likeT4G .= " id='$tgs_fkpos' ";
                }
            }
            $hottestPosts = mysql_query("SELECT * FROM postes $likeT4G ORDER BY dataHora DESC");
            $expressaoProcurada = !empty($queryTaaag) ? $expressaoProcurada : getTag($tag);
            $tipo = !empty($queryTaaag) ? 'btag': 'tag';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title></title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="coverImage">
                <div class="coverImageText">
                    <table>
                        <tr>
                            <td colspan="3"><h1><?php if(getConfig('titulo')){echo getConfig('titulo');} ?></h1></td>
                        </tr>
                        <tr>
                            <td><p><?php if(getConfig('legenda')){echo getConfig('legenda');} ?></p></td>
                            <td width="10">&nbsp;</td>
                            <td valign="top">
                                <?php if($_SESSION['loggedU']['permissao']=='admin'){ ?>
                                    <img src="images/03.png" class="adminToolButton" alt="Admin Tools">
                                <?php }else{echo '&nbsp;';} ?>
                            </td><!-- only for admin -->
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- undercover option 1 -->
        <div class="container">
            <div id="undercover_option_03">
                <?php include('./includes/logout.inc.php'); ?>
                <div id="uo3-buttons">
                    <div class="uo3-button"><button class="btn btn-primary" onclick="location.href=('index.php');"><span><img src="images/31.png"></span> Back</button></div>
                    <div class="uo3-button-r"><button class="btn btn-success" onclick="exportTS();"><span><img src="images/40.png"></span> Export PDF</button></div>
                    <div class="uo3-button-r"><p id="badgeExpost">0 Posts added</p></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- end of undercover option 2 -->
        <?php include('./includes/edit.profile.inc.php'); ?>
        <div class="container">
            <div class="plataforma-col plataforma-col-left">
                <div class="search-header text-center"><p>Showing posts: <span class="search-header-result"><?php if($tipo=='tag'){echo '#';} echo $expressaoProcurada;?></span></p></div>
            </div>
            <div class="plataforma-col plataforma-col-right">
                <div class="plataforma-search">
                    <form method="post" action="search.php">
                        <input type="text" name="valorBusca" placeholder="Content search">
                        <input type="image" src="images/06.png">
                    </form>
                </div>
            </div>
        </div><!-- end of container -->
        <div class="container">

                    <?php 


                        #$hottestPosts = mysql_query("SELECT * FROM likes GROUP BY fk_poste LIMIT 3");
                        //$hottestPosts = $querySearch; //mysql_query("SELECT *, COUNT(fk_poste) FROM likes GROUP BY fk_poste ORDER BY COUNT(fk_poste) DESC LIMIT 0,3");
                        if(haveResults($hottestPosts)){
                            for($i=0;$i<mysql_num_rows($hottestPosts);$i++){ 
                                

                                    $post_id = mysql_result($hottestPosts,$i,"id");
                                    $post_texto = mysql_result($hottestPosts,$i,"texto");
                                    $post_dataHora = mysql_result($hottestPosts,$i,"dataHora");
                                    $post_tipo = mysql_result($hottestPosts,$i,"tipo");
                                    $post_fk_usuario = mysql_result($hottestPosts,$i,"fk_usuario");

                                    $post_texto = linkifyYouTubeURLsSmall($post_texto);

                                ?>
                        <div class="col-sm-4 col-md-4" id="export<?php echo $post_id; ?>">
                        <section class="hottest-posts-module">
                            <div class="hottest-posts-module-image">

                            <?php $fotosDestePost = mysql_query("SELECT * FROM anexos WHERE fk_poste='$post_id' AND tipo='imagem' ");
                                if(haveResults($fotosDestePost)){
                             ?>
                            <div id="carousel-example-generic-hot<?php echo $post_id; ?>" class="carousel slide" data-ride="carousel">

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
                                  <a class="left carousel-control" href="#carousel-example-generic-hot<?php echo $post_id; ?>" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>

                                  <a class="right carousel-control" href="#carousel-example-generic-hot<?php echo $post_id; ?>" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                  <?php } ?>
                            </div>

                            <?php } ?>

                            </div>
                            <div class="hottest-posts-module-text">
                                <div class="hottest-posts-module-link">
                                    <ul>
                                        <?php
                                            $tags4tpost = mysql_query("SELECT * FROM tags_postes WHERE fk_poste='$post_id' ");
                                            if(haveResults($tags4tpost)){
                                                for($ix=0;$ix<mysql_num_rows($tags4tpost);$ix++){
                                                    $fk_hottag = mysql_result($tags4tpost,$ix,'fk_tag');
                                                    $recTag = mysql_query("SELECT * FROM tags WHERE id='$fk_hottag' ");
                                                    if(haveResults($recTag)){
                                                        $tag_nome = mysql_result($recTag,0,'nome');
                                                        $tag_id = mysql_result($recTag,0,'id');
                                                        echo '<li onclick="location.href=('."'".'search.php?tag='.$tag_id."'".');">#'.$tag_nome.'</li>';
                                                    }
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                                <p class="postTexto"><?php echo $post_texto; ?></p>
                                <div class="posts-module-liked">
                                    <ul>
                                        <li><img src="images/07.png"></li>
                                        <?php $nLikes = 0;$lks = mysql_query("SELECT * FROM likes WHERE fk_poste='$post_id' ");if(haveResults($lks)){$nLikes=mysql_num_rows($lks);}?>
                                        <li><?php echo $nLikes; ?> Users liked</li>
                                    </ul>
                                </div>
                                <div class="posts-module-button">
                                    <img src="images/27.png" width="100%" onclick="addToExport(<?php echo $post_id; ?>);" id="img_export<?php echo $post_id; ?>">
                                </div> 
                                <div class="clear"></div>
                            </div>
                        </section>
                        </div>
                        



                    <?php }
                    }?>





        </div>
        <form id="formExport">
            <input type="hidden" name="imgs_toex" id="imgs_toex">
        </form>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/linkfy.js"></script>
        <script src="js/script.js"></script>
        <script src="js/asyncUpload.js"></script>
        <script>
            function addToExport(idfs){
                //fazer lista das publicações p/ exportar
                if($('#imgs_toex').val()==''){
                    $('#imgs_toex').val(''+idfs);
                }else{
                    $('#imgs_toex').val($('#imgs_toex').val()+','+idfs);
                }
                //atualizar valor da lista no badge
                atualizaBadgExpo();
                //alterar icone do botao e evento;
                $('#img_export'+idfs).attr('onclick','removeToExport('+idfs+');');
                $('#img_export'+idfs).attr('src','images/28.png');
            }
            function removeToExport(idfs){
                removeFromExport(idfs);
                atualizaBadgExpo();
                //alterar icone do botao e evento;
                $('#img_export'+idfs).attr('onclick','addToExport('+idfs+');');
                $('#img_export'+idfs).attr('src','images/27.png');
            }
            function atualizaBadgExpo(){
                val = $('#imgs_toex').val();val = val.split(',');
                val = val.length;
                if($('#imgs_toex').val()==''){
                    val --;
                }
                $('#badgeExpost').html(val+' Posts added');
            }
            function removeFromExport(idx){
                valor = $('#imgs_toex').val();
                ind = valor.indexOf(','+idx+',');
                if( ind != -1 ){
                    // no meio //
                    valor = valor.replace(','+idx+',',',');
                }else{
                    ind = valor.indexOf(','+idx);
                    if( ind != -1 ){
                        // no final //
                        valor = valor.replace(','+idx,'');
                    }else{
                        ind = valor.indexOf(idx+',');
                        if( ind != -1 ){
                            // no inicio //
                            valor = valor.replace(idx+',','');
                        }else{
                            ind = valor.indexOf(idx);
                            if( ind != -1 ){
                                //só tem ele
                                valor = valor.replace(idx,'');
                            }
                        }
                    }
                }
                $('#imgs_toex').val(valor);
            }

            function exportTS(){
                if($('#imgs_toex').val()==''){
                    alert('Selecione pelo menos 1 post para exportar');
                }else{
                    showLoad();
                    $.post('arquivos/geraPDF.php',{imgs_toex:$('#imgs_toex').val()}).done(function(suss){
                        $('#fakeModal').html(suss);
                        $('#fakeButton').click();
                        hideLoad();
                    });
                }
            }
        </script>






        <span id="fakeButton" data-toggle="modal" data-target="#myModal" style="visibility:hidden;"></span>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            <!--
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
            -->
              <div class="modal-body" id="fakeModal">

              </div>
              <!--   
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
              -->
            </div>
          </div>
        </div>










<script>
    function linkas(){
        $('.postTexto').linkify();
    }
    setTimeout(linkas,500);
</script>

    </body>
</html>