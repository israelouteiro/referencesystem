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
    if(isset($_POST['email'])){
        $email = addslashes($_POST['email']);
        $password = sha1($_POST['senha']);
            $sucess = mysql_query("SELECT * FROM usuarios WHERE email='$email' AND senha='$password' AND ativo='sim' ");
        if(haveResults($sucess)){
      
            $_SESSION['loggedU']['id'] = mysql_result($sucess,0,"id");
            $_SESSION['loggedU']['nome'] = mysql_result($sucess,0,"nome");
            $_SESSION['loggedU']['email'] = mysql_result($sucess,0,"email");
            $_SESSION['loggedU']['foto'] = mysql_result($sucess,0,"foto");
            $_SESSION['loggedU']['ultimo_login'] = mysql_result($sucess,0,"ultimo_login");
            $_SESSION['loggedU']['data_cadastro'] = mysql_result($sucess,0,"data_cadastro");
            $_SESSION['loggedU']['permissao'] = mysql_result($sucess,0,"permissao");

            $idx = mysql_result($sucess,0,"id");
            $now = date('Y-m-d H:i:s');
            mysql_query("UPDATE usuarios SET ultimo_login='$now' WHERE id='$idx' ");
            header("Location:index.php");

        }else{
            $existMail = mysql_query("SELECT * FROM usuarios WHERE email='$email' ");
            if(haveResults($existMail)){

                $isAtivo = mysql_query("SELECT * FROM usuarios WHERE email='$email' AND ativo='sim' ");
                if(haveResults($isAtivo)){
                    $error = "A senha digitada está incorreta";
                }else{
                    $error = "Conta não ativa, contacte o administrador do grupo";
                }

            }else{
                $error = "Email não cadastrado no grupo";
            }
        }
    }
    $success = "";
    if(isset($_POST['emailConvite'])){
        $emailConvite = addslashes($_POST['emailConvite']);
        $now = date("Y-m-d H:i:s");
        $jaConvidado = mysql_query("SELECT * FROM convidados WHERE email='$emailConvite' ");
        if(haveResults($jaConvidado)){
            $idxconvidade = mysql_result($jaConvidado,0,"id");
            $foi = mysql_query("UPDATE convidados SET dataHora_uconvite='$now' WHERE id='$idxconvidade' ");
        }else{
            $foi = mysql_query("INSERT INTO convidados SET email='$emailConvite',dataHora_convite='$now',dataHora_uconvite='$now' ");
        }

         $menny = montaEmailMCL("Congratulations you have been invited to participate in the trading system of references to go and do the registration:","Click Here", URLSite);
         mandaEmail($menny,"Congratulations you have been invited to reference system",$emailConvite);
         $success = "The invitation was sent to the email: ".$emailConvite;
    }
    $error_new = "";
    $successo_new = "";
    if(isset($_POST['new_nome']) && isset($_POST['new_email']) && isset($_POST['new_pais']) && 
        isset($_POST['new_estado']) && isset($_POST['new_cidade']) && isset($_POST['new_company']) && 
        isset($_POST['new_ocupation']) && isset($_POST['new_sobre']) && isset($_POST['new_pass']) && isset($_POST['new_repass'])){

            $new_nome = addslashes($_POST['new_nome']);
            $new_email = addslashes($_POST['new_email']);
            $new_pais = addslashes($_POST['new_pais']);
            $new_estado = addslashes($_POST['new_estado']);
            $new_cidade = addslashes($_POST['new_cidade']);
            $new_company = addslashes($_POST['new_company']);
            $new_ocupation = addslashes($_POST['new_ocupation']);
            $new_sobre = addslashes(str_replace('\n','<br>',$_POST['new_sobre']));
            $new_pass = addslashes($_POST['new_pass']);
            $new_repass = addslashes($_POST['new_repass']);
            $id_facebook = addslashes($_POST['id_facebook']);
            if($new_repass == $new_pass){
                $emailJa = mysql_query("SELECT * FROM usuarios WHERE email='$new_email' ");
                if(haveResults($emailJa)){
                    $error_new = "Already registered mail";
                }else{
                    $agora = date("Y-m-d H:i:s");
                    $senhas = sha1($new_pass);
                    $gravado = mysql_query("INSERT INTO usuarios SET nome='$new_nome', email='$new_email', senha='$senhas', data_cadastro='$agora', permissao='comum', id_facebook='$id_facebook',
                                            cargo='$new_ocupation', pais='$new_pais', estado='$new_estado', cidade='$new_cidade', empresa='$new_company', sobre='$new_sobre', ativo='nao'  ");
                    if($gravado){
                        $successo_new = "Email successfully registered, contact the group administrator to request its activation";

         $menny = montaEmailM("you have registered successfully and receive a new email when your registration is enabled by the administrator");
         mandaEmail($menny,"Successfully registered",$new_email);



          $menny = montaEmailM("Go to activate it","Visit",URLSite);
         mandaEmail($menny,"Just a new user register",'raphaella@racionalize.com.br');
         mandaEmail($menny,"Just a new user register",'israel@racionalize.com.br');

                    }else{
                        $error_new = "Error, please try again later";
                    }
                }
            }else{
                $error_new = "Password and confirmation password do not match";
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
                <div class="login-title" <?php if(!empty($successo_new)||!empty($error_new)){echo 'style="color:#38a0c9;"';}?> >
                    <p><?php if(!empty($successo_new)){echo $successo_new;}else{if(!empty($error_new)){echo $error_new; }else{echo 'Login to proceed:';}}?></p>
                    
                </div>
                <div class="login-form">
                    <form role="form" method="post" action="">
                        <div class="form-group <?php if(!empty($error)){echo 'has-error';}?>">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="<?php if(!empty($error)){ echo $error;}else{echo 'Email';}?>">
                        </div>
                      

                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="exampleInputPassword1"  name="senha" placeholder="Password">
                                <span class="input-group-btn">
                                    <button class="btn btn-default forgot" type="button" onclick="location.href=('forgot.php');"><img src="images/25.png"></button>
                                </span>
                            </div>
                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-info">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="login-wrapper">
                <div class="login-title">
                    <p>Recived an email inviting you?</p>
                </div>
                <div class="login-form">
                    <div class="text-center">
                        <button class="btn btn-success" data-toggle="modal" data-target="#enjoy-group">Enjoy group</button>
                    </div>
                </div>
                <div id="login-text-wrapper">
                    <div id="login-text" <?php if(!empty($success)){echo 'style="color:#38a0c9;"';}?> ><img src="images/23.png"> <?php if(!empty($success)){echo $success; }else{echo "Invite someone to enjoy the group";}?></div>
                </div>
                <div class="login-form">
                    <form class="form-inline" role="form" action="" method="post">
                        <div class="form-group">
                            <input type="email" name="emailConvite" class="form-control" id="inputEmail2" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <div class="text-center"><button type="submit" class="btn btn-info">Send</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="enjoy-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="enjoy-group-modal">
                            <div class="login-title">
                                <p>Personal Information</p>
                            </div>

                                <form role="form" action="" method="post">
                                <input type="hidden" name="id_facebook" id="facebookId">
                                    <div id="step1">
                                        <div class="group-modal-facebook"><img src="images/24.png" width="100%" onclick="logFacebook();"></div>
                                        <div class="group-modal-middle">or</div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="new_name" name="new_nome" placeholder="Full name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="new_email" name="new_email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="new_pais" name="new_pais" placeholder="Country" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="new_estado" name="new_estado" placeholder="State" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="new_cidade" name="new_cidade" placeholder="City" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary" onclick="gotoStep2();">Next</button>
                                        </div>
                                    </div>

                                    <div style="display:none;" id="step2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="" placeholder="Company"  name="new_company" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="" placeholder="Occupation" name="new_ocupation" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Write something about you..."  name="new_sobre" id="modal-textarea" required></textarea>
                                        </div>
                                        <div class="group-modal-middle"><img src="images/29.png"></div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="" placeholder="Password"  name="new_pass" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="" placeholder="Repeat password"  name="new_repass" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>


                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/iscript.js"></script>
    </body>
</html>