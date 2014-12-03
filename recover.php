<?php
ob_start();
    session_start();
        session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
            if(isset($_SESSION['loggedU']['id']) && !empty($_SESSION['loggedU']['id']) && $_SESSION['loggedU']['id'] != ''){
               header("Location:index.php");
               exit();
            }

include "includes/conexao.php";

$success = "";
$hax = addslashes($_GET['h']);
$mostraForm = false;
$existMail = mysql_query("SELECT * FROM usuarios WHERE hashs='$hax' AND hashs != '' ");

            if(haveResults($existMail)){
                $idx = mysql_result($existMail,0,"id");
                $zeraHash = mysql_query("UPDATE usuarios SET hashs='' WHERE id='$idx' ");
                if($zeraHash){
                    $mostraForm = true;
                }
            }else{
                $success = "This hash already used or invalid";
            }





    if(isset($_POST['password'])){
        $idUser = addslashes($_POST['id']);
        $passwd = sha1($_POST['password']);

        $alterou = mysql_query("UPDATE usuarios SET senha='$passwd' WHERE id='$idUser' ");

        if($alterou){
            $success = "Password changed";
        }else{
            $success = "Error, try forgot again";
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
                    <p><?php if(!empty($success)){echo $success;}else{echo "Enter your new password:";}?></p>
                </div>

                <?php if($mostraForm){ ?>

                <div class="login-form">
                    <form role="form" method="post" action="">
                    <input type="hidden" name="id" value="<?php echo "$idx"; ?>">
                        <div class="form-group <?php if(!empty($error)){echo 'has-error';}?>">
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="<?php if(!empty($error)){ echo $error;}else{echo 'Password';}?>">
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-info" onclick="if(window.confirm('If you quit now your hash will expire')){location.href=('login.php');}">Back</button>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>

                <?php } else{ ?>

                    <div class="login-form">
                    <form role="form" method="post" action="">
                        <div class="text-center">
                            <button type="button" class="btn btn-info" onclick="location.href=('login.php');">Back</button>
                        </div>
                    </form>
                </div>

                <?php } ?>
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