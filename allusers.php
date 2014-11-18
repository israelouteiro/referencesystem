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
            <div id="undercover_option_02">
                <?php include('./includes/logout.inc.php'); ?>
                <div id="uo2-buttons">
                    <div class="uo2-button"><button class="btn btn-primary" onclick="location.href=('index.php');"><span><img src="images/31.png"></span> Back</button></div>
                    <div class="uo2-button text-center"><p></p></div>
                    <div class="uo2-button"></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- end of undercover option 2 -->
        <?php include('./includes/edit.profile.inc.php'); ?>
        <div class="container">
            <div class="clear"></div>
            <div class="admin-divide"></div>
            <div class="admin-title"><p>All Users</p></div>
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


                   
                </div><!-- end of user module -->


                <?php } } ?>



                <div class="clear"></div>
            </div><!-- end of active users wrapper -->
        </div><!-- end of container -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/asyncUpload.js"></script>

    </body>
</html>