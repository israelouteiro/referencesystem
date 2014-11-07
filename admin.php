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
                            <td>
                                <textarea placeholder="Lorem ipsum dolor" id="admin-title-input"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea type="text" placeholder="Text" id="admin-text-input"></textarea>
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
                    <div class="uo2-button"><button class="btn btn-primary"><span><img src="images/31.png"></span> Back</button></div>
                    <div class="uo2-button text-center"><p>Admin Tools</p></div>
                    <div class="uo2-button"><button class="btn btn-warning"><span><img src="images/30.png"></span> Change Cover Image</button></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- end of undercover option 2 -->
        <?php include('./includes/edit.profile.inc.php'); ?>
        <div class="container">
            <div class="admin-divide"></div>
            <div class="admin-title"><p>Waiting for Approve</p></div>
            <div class="admin-module-wrapper">
                <div class="admin-user-module">
                    <div class="user-module-photo"><img src="images/35.png"></div>
                    <div class="user-module-text">
                            <p class="user-module-name">Usuário da Silva</p>
                            <p class="user-module-place">Brasília - DF</p>
                            <p class="user-module-infos">Diretor de Arte</p>
                            <p class="user-module-infos">Racionalize Comunicação</p>
                    </div>
                    <div class="user-module-close"><img src="images/34.png"></div>
                    <div class="user-module-decline"><img src="images/32.png" width="100%"></div>
                    <div class="user-module-accept"><img src="images/33.png" width="100%"></div>
                </div><!-- end of user module -->
                <div class="admin-user-module">
                    <div class="user-module-photo"><img src="images/35.png"></div>
                    <div class="user-module-text">
                            <p class="user-module-name">Usuário da Silva</p>
                            <p class="user-module-place">Brasília - DF</p>
                            <p class="user-module-infos">Diretor de Arte</p>
                            <p class="user-module-infos">Racionalize Comunicação</p>
                    </div>
                    <div class="user-module-close"><img src="images/34.png"></div>
                    <div class="user-module-decline"><img src="images/32.png" width="100%"></div>
                    <div class="user-module-accept"><img src="images/33.png" width="100%"></div>
                </div><!-- end of user module -->
                <div class="clear"></div>
            </div><!-- end of waiting for approve wrapper -->
            <div class="clear"></div>
            <div class="admin-divide"></div>
            <div class="admin-title"><p>Active Users</p></div>
             <div class="admin-module-wrapper">
                <div class="admin-user-module">
                    <div class="user-module-photo"><img src="images/35.png"></div>
                    <div class="user-module-text">
                        <p class="user-module-name">Usuário da Silva</p>
                        <p class="user-module-place">Brasília - DF</p>
                        <p class="user-module-infos">Diretor de Arte</p>
                        <p class="user-module-infos">Racionalize Comunicação</p>
                    </div>
                    <div class="user-module-close"><img src="images/34.png"></div>
                </div><!-- end of user module -->
                <div class="admin-user-module">
                    <div class="user-module-photo"><img src="images/35.png"></div>
                    <div class="user-module-text">
                        <p class="user-module-name">Usuário da Silva</p>
                        <p class="user-module-place">Brasília - DF</p>
                        <p class="user-module-infos">Diretor de Arte</p>
                        <p class="user-module-infos">Racionalize Comunicação</p>
                    </div>
                    <div class="user-module-close"><img src="images/34.png"></div>
                </div><!-- end of user module -->
                 <div class="admin-user-module">
                    <div class="user-module-photo"><img src="images/35.png"></div>
                    <div class="user-module-text">
                        <p class="user-module-name">Usuário da Silva</p>
                        <p class="user-module-place">Brasília - DF</p>
                        <p class="user-module-infos">Diretor de Arte</p>
                        <p class="user-module-infos">Racionalize Comunicação</p>
                    </div>
                    <div class="user-module-close"><img src="images/34.png"></div>
                </div><!-- end of user module -->
                <div class="clear"></div>
            </div><!-- end of active users wrapper -->
        </div><!-- end of container -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>