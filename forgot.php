<?php
ob_start();
    session_start();
        session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
            if(isset($_SESSION['loggedU']['id']) && !empty($_SESSION['loggedU']['id']) && $_SESSION['loggedU']['id'] != ''){
               header("Location:index.php");
               exit();
            }


include "includes/conexao.php";


$error = "";
$success = "";
    if(isset($_POST['email'])){
        $email = addslashes($_POST['email']);

        $existMail = mysql_query("SELECT * FROM usuarios WHERE email='$email' ");
            if(haveResults($existMail)){
                $isAtivo = mysql_query("SELECT * FROM usuarios WHERE email='$email' AND ativo='sim' ");
                if(haveResults($isAtivo)){
                    //Criar hash na base para user//
                    $idEsquecido = mysql_result($isAtivo,0,"id");
                    $hashU = rand(100,1000)."_".date("H-i-s_Y-m-d")."_".$idEsquecido;
                    $hOnB = mysql_query("UPDATE usuarios SET hashs='$hashU' WHERE id='$idEsquecido' ");
                    if($hOnB){
                        //enviar senha para o email
                        $menny = montaEmailMCL("Visit for registering a new password","Click Here", URLSite."recover.php?h=".$hashU);
                        mandaEmail($menny,"Recover your password on Refence System",$email);
                        $success = "Instructions to recover your password have been sent to your email";
                    }
                }else{
                    $error = "Conta não ativa, contacte o administrador do grupo";
                }
            }else{
                $error = "Email não cadastrado no grupo";
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
                            <td valign="top"><!-- <img src="images/03.png" class="adminToolButton" alt="Admin Tools"> --> &nbsp;</td><!-- only for admin -->
                        </tr>
                    </table>
                </div>
            </div><!-- coverImage -->
            <div class="login-wrapper">
                <div class="login-title" <?php if(!empty($success)){echo 'style="color:#38a0c9;"';}?> >
                    <p><?php if(!empty($success)){echo $success;}else{echo "Enter your email to recover password:";}?></p>
                    
                </div>
                <div class="login-form">
                    <form role="form" method="post" action="">
                        <div class="form-group <?php if(!empty($error)){echo 'has-error';}?>">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="<?php if(!empty($error)){ echo $error;}else{echo 'Email';}?>">
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-info" onclick="location.href=('login.php');">Back</button>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>