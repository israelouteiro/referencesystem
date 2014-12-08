<?php 
    
    include "includes/isLogged.php";
    include "includes/isLoggedAdmin.php";
    include "includes/conexao.php";
    include "includes/queryUsuario.php";
	
	/*
	ini_set('memory_limit','128M');
	ini_set('max_execution_time','36000');
	ini_set('post_max_size','128M');
	ini_set('upload_max_filesize','128M');
	ini_set('post_max_filesize','128M');
	*/


    if(isset($_FILES['fileUp']['name'])){
        $nomeFoto = $_FILES['fileUp']['name'];

        $getMime = explode('.', $nomeFoto);
        $mime = end($getMime);
        $randomName = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;



        if(move_uploaded_file($_FILES['fileUp']['tmp_name'], 'arquivos/'.$randomName )){
            setConfig('fcapa',$randomName);
            echo '<script>alert("The new background picture has successful changed. Please load this page again.");setTimeout(function(){location.href=("index.php");},500);</script>';
        }else{
			echo '<script>alert("Something wrong happened during the upload.");</script>';
		}
    }

                if(isset($_POST['confirma_pe'])){
                    $idcp = addslashes($_POST['confirma_pe']);
                    mysql_query("UPDATE usuarios SET ativo='sim' WHERE id='$idcp' ");

                    $us = mysql_query("SELECT * FROM usuarios WHERE id='$idcp' ");
                    if(haveResults($us)){
                        $em = mysql_result($us,0,'email');
                    $menny = montaEmailMCL("Your registration has been activated.","Visit",URLSite);
                    mandaEmail($menny,"Asset register",$em);
                    }
                }

                if(isset($_POST['remove_pe'])){
                    $idcp = addslashes($_POST['remove_pe']);
                    mysql_query("UPDATE usuarios SET ativo='naaaa' WHERE id='$idcp' ");

                    $us = mysql_query("SELECT * FROM usuarios WHERE id='$idcp' ");
                    if(haveResults($us)){
                        $em = mysql_result($us,0,'email');
                    $menny = montaEmailM("Your registration has been activated.");
                    mandaEmail($menny,"Your registration was denied",$em);
                    }
                }

                if(isset($_POST['deonfirma_pe'])){
                    $idcp = addslashes($_POST['deonfirma_pe']);
                    mysql_query("UPDATE usuarios SET ativo='nao' WHERE id='$idcp' ");

                    $us = mysql_query("SELECT * FROM usuarios WHERE id='$idcp' ");
                    if(haveResults($us)){
                        $em = mysql_result($us,0,'email');
                    $menny = montaEmailM("Your registration was denied by an administrator.");
                    mandaEmail($menny,"You was excluded",$em);
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
        <style>
        .coverImage {
            min-height: 350px;
            overflow: auto;
            background: url('arquivos/<?php echo getConfig('fcapa');?>') no-repeat top center;
            background-size: cover;
            color: #fff;
            padding: 0px 28px;
        } 
        </style>
    </head>
    <body>
        <div class="container">
            <div class="coverImage">
                <div class="coverImageText">
                    <table>
                        <tr>
                            <td>
                                <textarea placeholder="Lorem ipsum dolor" id="admin-title-input" onkeyup="if(event.keyCode==13){postTitulo(); }" style="overflow:hidden;"><?php if(getConfig('titulo')){echo getConfig('titulo');} ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea type="text" placeholder="Text" id="admin-text-input" onkeyup="if(event.keyCode==13){postLegenda(); }" style="overflow:hidden;"><?php if(getConfig('legenda')){echo getConfig('legenda');} ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- undercover option 1 -->
        <div class="container">
            <div id="undercover_option_02">
                <?php include('./includes/logout.inc.php'); ?>
                <div id="uo2-buttons">
                    <div class="uo2-button"><button class="btn btn-primary" onclick="location.href=('index.php');"><span><img src="images/31.png"></span> Back</button></div>
                    <div class="uo2-button text-center"><p>Admin Tools</p></div>
                    <div class="uo2-button"><button class="btn btn-warning" onclick="$('#fileUp').click();"><span><img src="images/30.png"></span> Change Cover Image</button></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- end of undercover option 2 -->
        <?php include('./includes/edit.profile.inc.php'); ?>
        <div class="container">
            <div class="admin-divide"></div>
            <div class="admin-title"><p>Waiting for Approve</p></div>
            <div class="admin-module-wrapper">

            <?php $userWaiting = mysql_query("SELECT * FROM usuarios WHERE ativo='nao' "); 
            if(haveResults($userWaiting)){
                for($i=0;$i<mysql_num_rows($userWaiting);$i++){
                    $fuser_nome = mysql_result($userWaiting,$i,"nome");
                    $fuser_email = mysql_result($userWaiting,$i,"email");
                    $fuser_foto = mysql_result($userWaiting,$i,"foto");
                    $fuser_cargo = mysql_result($userWaiting,$i,"cargo");
                    $fuser_pais = mysql_result($userWaiting,$i,"pais");
                    $fuser_estado = mysql_result($userWaiting,$i,"estado");
                    $fuser_cidade = mysql_result($userWaiting,$i,"cidade");
                    $fuser_empresa = mysql_result($userWaiting,$i,"empresa");
                    $fuser_sobre = mysql_result($userWaiting,$i,"sobre");
                    $fuser_idFacebook = mysql_result($userWaiting,$i,"id_facebook");
                    $fuser_id = mysql_result($userWaiting,$i,"id");


                            if(!empty($fuser_foto)){
                                $fuser_foto = "arquivos/".$fuser_foto;
                            }else{
                                if(!empty($fuser_idFacebook)){
                                    $fuser_foto = "http://graph.facebook.com/".$fuser_idFacebook."/picture?type=large";
                                }else{
                                    $fuser_foto = "images/02.png";
                                }
                            }
            ?>

                <div class="admin-user-module">
                    <div class="user-module-photo <?php if($idUx==$fuser_id){echo 'userPhotoProfile'; } ?>" style="background:url(<?php echo $fuser_foto; ?>) no-repeat center center;background-size:cover;">
                        <img src="images/35.png" style="visibility:hidden;">
                    </div>
                    <div class="user-module-text">
                        <p class="user-module-name" onclick="$('#prof<?php echo $fuser_id; ?>').toggle();"><?php echo $fuser_nome; ?></p>
                        <p class="user-module-place"><?php echo $fuser_cidade; ?> - <?php echo $fuser_estado; ?></p>
                        <p class="user-module-infos"><?php echo $fuser_cargo; ?></p>
                        <p class="user-module-infos"><?php echo $fuser_empresa; ?></p>
                    </div>
                    

                    <!-- PERFIL DA PESSOA -->

                    <div class="post-profile-infos-popup" style="display:none;" id="prof<?php echo $fuser_id; ?>">
                        <div class="infos-popup-image <?php if($idUx==$fuser_id){echo 'userPhotoProfile'; } ?>" style="background:url(<?php echo $fuser_foto; ?>) no-repeat center center;background-size:cover;">
                            <img src="images/10.jpg" style="visibility:hidden;">
                        </div>
                        <div class="infos-popup-infos" >
                            <p class="infos-popup-title"><?php echo $fuser_nome; ?></p>
                            <table>
                                <tr>
                                    <td rowspan="2">
                                        <img src="images/26.png">
                                    </td>
                                    <td><p><?php echo $fuser_cidade; ?> - <?php echo $fuser_estado; ?></p></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $fuser_pais; ?></p></td>
                                </tr>
                            </table>
                            <p><?php echo $fuser_cargo; ?></p>
                            <p><?php echo $fuser_empresa; ?></p>
                        </div>
                        <div class="infos-popup-text">
                            <p class="infos-popup-title">About me:</p>
                            <p><?php echo $fuser_sobre; ?></p>
                        </div>
                    </div>


                    <!-- FINAL PERFIL DA PESSOA -->

                    <div class="user-module-close" onclick="fexa(<?php echo $fuser_id; ?>)"><img src="images/34.png"></div>
                    <div class="user-module-decline" onclick="fexa(<?php echo $fuser_id; ?>)"><img src="images/32.png" width="100%"></div>
                    <div class="user-module-accept"  onclick="aceita(<?php echo $fuser_id; ?>)"><img src="images/33.png" width="100%"></div>
                </div><!-- end of user module -->
                <?php } } ?>


                <div class="clear"></div>
            </div><!-- end of waiting for approve wrapper -->
            <div class="clear"></div>
            <div class="admin-divide"></div>
            <div class="admin-title"><p>Active Users</p></div>
             <div class="admin-module-wrapper">

             <?php $userWaiting = mysql_query("SELECT * FROM usuarios WHERE ativo='sim' "); 
                    if(haveResults($userWaiting)){
                        for($i=0;$i<mysql_num_rows($userWaiting);$i++){
                            $fuser_nome = mysql_result($userWaiting,$i,"nome");
                            $fuser_email = mysql_result($userWaiting,$i,"email");
                            $fuser_foto = mysql_result($userWaiting,$i,"foto");
                            $fuser_cargo = mysql_result($userWaiting,$i,"cargo");
                            $fuser_pais = mysql_result($userWaiting,$i,"pais");
                            $fuser_estado = mysql_result($userWaiting,$i,"estado");
                            $fuser_cidade = mysql_result($userWaiting,$i,"cidade");
                            $fuser_empresa = mysql_result($userWaiting,$i,"empresa");
                            $fuser_sobre = mysql_result($userWaiting,$i,"sobre");
                            $fuser_idFacebook = mysql_result($userWaiting,$i,"id_facebook");
                            $fuser_id = mysql_result($userWaiting,$i,"id");


                                    if(!empty($fuser_foto)){
                                        $fuser_foto = "arquivos/".$fuser_foto;
                                    }else{
                                        if(!empty($fuser_idFacebook)){
                                            $fuser_foto = "http://graph.facebook.com/".$fuser_idFacebook."/picture?type=large";
                                        }else{
                                            $fuser_foto = "images/02.png";
                                        }
                                    }
                    ?>



                <div class="admin-user-module">
                    <div class="user-module-photo <?php if($idUx==$fuser_id){echo 'userPhotoProfile'; } ?>" style="background:url(<?php echo $fuser_foto; ?>) no-repeat center center;background-size:cover;">
                        <img src="images/35.png" style="visibility:hidden;">
                    </div>
                    <div class="user-module-text">
                        <p class="user-module-name" onclick="$('#prof<?php echo $fuser_id; ?>').toggle();"><?php echo $fuser_nome; ?></p>
                        <p class="user-module-place"><?php echo $fuser_cidade; ?> - <?php echo $fuser_estado; ?></p>
                        <p class="user-module-infos"><?php echo $fuser_cargo; ?></p>
                        <p class="user-module-infos"><?php echo $fuser_empresa; ?></p>
                    </div>



                    <!-- PERFIL DA PESSOA -->

                    <div class="post-profile-infos-popup" style="display:none;" id="prof<?php echo $fuser_id; ?>">
                        <div class="infos-popup-image <?php if($idUx==$fuser_id){echo 'userPhotoProfile'; } ?>" style="background:url(<?php echo $fuser_foto; ?>) no-repeat center center;background-size:cover;">
                            <img src="images/10.jpg" style="visibility:hidden;">
                        </div>
                        <div class="infos-popup-infos">
                            <p class="infos-popup-title"><?php echo $fuser_nome; ?></p>
                            <table>
                                <tr>
                                    <td rowspan="2">
                                        <img src="images/26.png">
                                    </td>
                                    <td><p><?php echo $fuser_cidade; ?> - <?php echo $fuser_estado; ?></p></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $fuser_pais; ?></p></td>
                                </tr>
                            </table>
                            <p><?php echo $fuser_cargo; ?></p>
                            <p><?php echo $fuser_empresa; ?></p>
                        </div>
                        <div class="infos-popup-text">
                            <p class="infos-popup-title">About me:</p>
                            <p><?php echo $fuser_sobre; ?></p>
                        </div>
                    </div>


                    <!-- FINAL PERFIL DA PESSOA -->


                    <div class="user-module-close" onclick="desaceita(<?php echo $fuser_id; ?>)"><img src="images/34.png"></div>
                </div><!-- end of user module -->


                <?php } } ?>



                <div class="clear"></div>
            </div><!-- end of active users wrapper -->
        </div><!-- end of container -->
        <form enctype="multipart/form-data" action="" method="post" id="formUpIm"onsubmit="showLoad('Enviando imagem, por favor aguarde.');">
            <input type="file" style="visibility:hidden;" name="fileUp" id="fileUp" onchange="$('#formUpIm').submit()">            
        </form>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/asyncUpload.js"></script>
        <script>
            
            function postTitulo(){
                if($('#admin-title-input').val()==''){
                    alert('Type something in the title first');
                }else{
                    $.post('includes/gravaTitulo.php',{valor:$('#admin-title-input').val()})
                    .done(function(retornous){
                        alert('Your Title has been changed');
                        location.href=('admin.php');
                    });
                }
            }

            function postLegenda(){
                if($('#admin-text-input').val()==''){
                    alert('Type something in the subtitle first');
                }else{
                    $.post('includes/gravaLegenda.php',{valor:$('#admin-text-input').val()})
                    .done(function(retornous){
                        alert('Your subtitle has been changed');
                        location.href=('admin.php');
                    });
                }
            }

            function fexa(idx){
                $('#remove_pe').val(idx);
                $('#confirma_pe').val('');
                $('#deonfirma_pe').val('');
                $('#formControl').submit();
            }    
            function aceita(idx){
                $('#confirma_pe').val(idx);
                $('#deonfirma_pe').val('');
                $('#remove_pe').val('');
                $('#formControl').submit();
            }
            function desaceita(idx){
                $('#deonfirma_pe').val(idx);
                $('#remove_pe').val('');
                $('#confirma_pe').val('');
                $('#formControl').submit();
            }
               
        </script>
        <form method="post" action="" id="formControl">
            <input type="hidden" name="remove_pe" id="remove_pe">
            <input type="hidden" name="confirma_pe" id="confirma_pe">
            <input type="hidden" name="deonfirma_pe" id="deonfirma_pe">
        </form>
    </body>
</html>