<?php 
    
    include "includes/isLogged.php";
    include "includes/conexao.php";
    include "includes/queryUsuario.php";

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
            <div id="undercover_option_01">
                <?php include('./includes/logout.inc.php'); ?>
                <div id="uo1_photos">
                    <ul>
                        <?php
                        # $quser = mysql_query("SELECT * FROM ( SELECT * FROM usuarios ORDER BY rand() LIMIT 8 ) T1 ORDER BY nome ");
                        $quser = mysql_query(" SELECT * FROM usuarios WHERE ativo='sim' ORDER BY nome ASC LIMIT 8 ");
                         if(haveResults($quser)){
                            for($i=0;$i<mysql_num_rows($quser);$i++){ 
                                $fu = mysql_result($quser,$i,'foto');
                                $udfid = mysql_result($quser,$i,'id_facebook');
                                $udid = mysql_result($quser,$i,'id');
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
                                <li class="<?php if($idUx==$udid){echo 'userPhotoProfile'; } ?>" style="background:url(<?php echo $fu; ?>) no-repeat center center; background-size:cover;">
                                    <img src="images/02.jpg" width="100%" style="visibility:hidden;">
                                </li>
                            <?php }}?>

                        <li><img src="images/01.png" id="morePhotosButton" onclick="location.href=('allusers.php');//morePeople();"></li>
                    </ul>
                </div>
            </div>
        </div><!-- end of undercover option 1 -->
        <?php include('./includes/edit.profile.inc.php'); ?>
        <div class="container">
            <div class="plataforma-col plataforma-col-left">
                <div id="post-area-top">
                    <div id="post-area-top-left">
                        <table>
                            <tr>
                                <td onclick="$('#selectPicture').click();" class="selectPictureButton"><img src="images/10.png"></td>
                                <td width="12">&nbsp;</td>
                                <td onclick="$('#selectPicture').click();" class="selectPictureButton">Picture</td>
                                <!-- -->
                                <td width="47" align="middle"><img src="images/12.png"></td>
                                <td onclick="$('#selectFile').click();" class="selectFileButton"><img src="images/11.png"></td>
                                <td width="12">&nbsp;</td>
                                <td onclick="$('#selectFile').click();" class="selectFileButton">File</td>
                            </tr>
                        </table>
                    </div>
                    <div id="post-area-top-right">
                        <table>
                            <tr>
                                <td onclick="changeReference()" class="postReference"><img src="images/08.png" id="postReferenceImg"></td>
                                <td width="12">&nbsp;</td>
                                <td onclick="changeReference()" class="postReference">Reference</td>
                                <!-- -->
                                <td width="47" align="middle"><img src="images/12.png"></td>
                                <td onclick="changeReference()" class="postRequest"><img src="images/09.png" id="postRequestImg"></td>
                                <td width="12">&nbsp;</td>
                                <td onclick="changeReference()" class="postRequest">Request</td>
                            </tr>
                        </table>
                    </div>
                    <form class="post-area-top-form" enctype="multipart/form-data" onsubmit="return false;">
                        <input type="file" id="selectPicture" accept="image/*">
                    </form>
                    <form class="post-area-top-form" enctype="multipart/form-data" onsubmit="return false;">
                        <input type="file" id="selectFile">
                    </form>
                </div><!-- end of post area top -->
                <div id="post-area-tags">
                    <ul>

                    </ul>
                </div>
                <div id="post-area-middle">
                    <textarea placeholder="Write something..." id="post-area-middle-textarea"></textarea>
                </div>
                <div id="post-area-attaches">
                    <ul>

                    </ul>
                </div>
                <div id="post-area-bottom">
                    <div id="bottom-button-01">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Select tag <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" id="listaTags">
                                    
                            </ul>
                        </div>
                    </div>
                    <div id="bottom-button-02">
                        <form onsubmit="addTag();return false;"><input type="text" placeholder="New tag..." id="valorTags"></form>
                    </div>
                    <div id="bottom-button-03">
                        <button type="button" class="btn btn-primary btn-block" onclick="submitPost();">Publish</button>
                    </div>
                </div>
                <div class="clear"></div>


                <div id="all-posts-container">
                    <div class="btn-group text-center">
                  
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="textoFiltro">
                                All posts <span class="caret"></span>
                            </button>
                      
                        <ul class="dropdown-menu" role="menu">
                            <li><a style="cursor:pointer;" onclick="filtraPostes('reference','');">Reference</a></li>
                            <li><a style="cursor:pointer;" onclick="filtraPostes('request','');">Request</a></li>

                            <?php $tagsAtuais = mysql_query("SELECT * FROM tags");
                            if(haveResults($tagsAtuais)){ 
                                for($asd=0;$asd<mysql_num_rows($tagsAtuais);$asd++){
                                    $nome_tagvs = mysql_result($tagsAtuais,$asd,'nome');
                                    $id_tagvs = mysql_result($tagsAtuais,$asd,'id');
                                    ?>
                            <li><a  style="cursor:pointer;" onclick="filtraPostes('<?php echo $id_tagvs; ?>','<?php echo $nome_tagvs; ?>');"><?php echo $nome_tagvs; ?></a></li>
                            <?php }} ?>
                            <li><a style="cursor:pointer;" onclick="filtraPostes('all','');">All posts</a></li>
                        </ul>
                    </div>
                </div>



                <div id="allPosts"></div>
            </div><!-- end of left column -->
            <aside class="plataforma-col plataforma-col-right">
                <div class="plataforma-search">
                    <form method="post" action="search.php">
                        <input type="text" name="valorBusca" placeholder="Content search">
                        <input type="image" src="images/06.png">
                    </form>
                </div>
                <div class="plataforma-hottest-posts">
                    <header>
                        <ul>
                            <li><img src="images/05.png"></li>
                            <li><p>Hottests Posts</p></li>
                        </ul>                        
                    </header>




                    <?php 
                        #$hottestPosts = mysql_query("SELECT * FROM likes GROUP BY fk_poste LIMIT 3");
                        $hottestPosts = mysql_query("SELECT *, COUNT(fk_poste) FROM likes GROUP BY fk_poste ORDER BY COUNT(fk_poste) DESC LIMIT 0,3");
                        if(haveResults($hottestPosts)){
       
                            for($vvv=0;$vvv<mysql_num_rows($hottestPosts);$vvv++){ 

                                $fk_hotpost = mysql_result($hottestPosts,$vvv,'fk_poste');
                                $hotposte_atual = mysql_query("SELECT * FROM postes WHERE id='$fk_hotpost' ");
                                if(haveResults($hotposte_atual)){

                                    $post_id = mysql_result($hotposte_atual,0,"id");
                                    $post_texto = mysql_result($hotposte_atual,0,"texto");
                                    $post_dataHora = mysql_result($hotposte_atual,0,"dataHora");
                                    $post_tipo = mysql_result($hotposte_atual,0,"tipo");
                                    $post_fk_usuario = mysql_result($hotposte_atual,0,"fk_usuario");

                                    $post_texto = linkifyYouTubeURLsSmall($post_texto);
                                ?>
                        
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
                                <!-- <div class="posts-module-button">
                                    <img src="images/27.png" width="100%">
                                </div> -->
                                <div class="clear"></div>
                            </div>
                        </section>
                        <?php } ?>



                    <?php }
                    }?>
















                </div>
            </aside>
        </div>
        <form id="formEnvios">
            <input type="hidden" name="fe_tags" id="fe_tags" value="">
            <input type="hidden" name="fe_anexos" id="fe_anexos" value="">
            <input type="hidden" name="fe_type" id="fe_type" value="">
            <input type="hidden" name="fe_texto" id="fe_texto" value="">
        </form>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            <!--
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
            -->
              <div class="modal-body">
                <img src="" width="100%">
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







        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/linkfy.js"></script>
        <script src="js/script.js"></script>
        <script src="js/asyncUpload.js"></script>
        <script src="js/controlTags.js"></script>
        <script src="js/controlFormPost.js"></script>

        <script>
            function linkas(){
                $('.postTexto').linkify();
            }
            setTimeout(linkas,500);
        </script>
    </body>
</html>

