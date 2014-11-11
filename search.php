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
                    <div class="uo3-button"><button class="btn btn-primary"><span><img src="images/31.png"></span> Back</button></div>
                    <div class="uo3-button-r"><button class="btn btn-success"><span><img src="images/40.png"></span> Export PDF</button></div>
                    <div class="uo3-button-r"><p>3 Posts added</p></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- end of undercover option 2 -->
        <?php include('./includes/edit.profile.inc.php'); ?>
        <div class="container">
            <div class="plataforma-col plataforma-col-left">
                <div class="search-header text-center"><p>Showing posts: <span class="search-header-result">#lifestyle</span></p></div>
            </div>
            <div class="plataforma-col plataforma-col-right">
                <div class="plataforma-search">
                    <form>
                        <input type="text" placeholder="Content search">
                        <input type="image" src="images/06.png">
                    </form>
                </div>
            </div>
        </div><!-- end of container -->
        <div class="container">
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
            <div class="col-sm-4 col-md-4"><?php include('./includes/hot.post.module.php'); ?></div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>