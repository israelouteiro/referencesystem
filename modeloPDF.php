<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">

<?php
    include "includes/conexao.php";
	$ids = $_GET['ids'];
	$ids = explode(',',$ids);

	for($i=0;$i<count($ids);$i++){
		$id = $ids[$i];
		$post = mysql_query("SELECT * FROM postes WHERE id='$id' ");
		if(haveResults($post)){
			$post_id = mysql_result($post,0,"id");
            $post_texto = mysql_result($post,0,"texto");
            $post_dataHora = mysql_result($post,0,"dataHora");
            $post_tipo = mysql_result($post,0,"tipo");
            $post_fk_usuario = mysql_result($post,0,"fk_usuario");

            ?>

            		<div class="col-sm-8 col-md-8 col-md-push-2 col-sm-push-2" id="export<?php echo $post_id; ?>">
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
                                    <div class="item <?php if($a==0){echo 'active';}?>" >
                                      <img src="arquivos/<?php echo $srcPhoto; ?>" alt="" width="100%" >
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
                                <p><?php echo $post_texto; ?></p>
                                <div class="posts-module-liked">
                                    <ul>
                                        <li><img src="images/07.png"></li>
                                        <?php $nLikes = 0;$lks = mysql_query("SELECT * FROM likes WHERE fk_poste='$post_id' ");if(haveResults($lks)){$nLikes=mysql_num_rows($lks);}?>
                                        <li><?php echo $nLikes; ?> Users liked</li>
                                    </ul>
                                </div>
                             
                                <div class="clear"></div>
                            </div>
                        </section>
                        </div>

            <?php

		}
	}
	
?>