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
                            <td colspan="3"><h1>Lorem ipsum dolor sit amet consectetuer adipiscing elit</h1></td>
                        </tr>
                        <tr>
                            <td><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet</p></td>
                            <td width="10">&nbsp;</td>
                            <td valign="top"><img src="images/03.png" class="adminToolButton" alt="Admin Tools"></td><!-- only for admin -->
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
                        <li><img src="images/02.jpg" width="100%"></li>
                        <li><img src="images/03.jpg" width="100%"></li>
                        <li><img src="images/04.jpg" width="100%"></li>
                        <li><img src="images/02.jpg" width="100%"></li>
                        <li><img src="images/03.jpg" width="100%"></li>
                        <li><img src="images/04.jpg" width="100%"></li>
                        <li><img src="images/02.jpg" width="100%"></li>
                        <li><img src="images/03.jpg" width="100%"></li>
                        <li><img src="images/01.png" id="morePhotosButton"></li>
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
                    <div class="clear"></div>
                    <form id="post-area-top-form">
                        <input type="file" id="selectPicture">
                        <input type="file" id="selectFile">
                    </form>
                </div><!-- end of post area top -->
                <div id="post-area-middle">
                    <textarea placeholder="Write something..." id="post-area-middle-textarea"></textarea>
                    <div class="clear"></div>
                </div>
                <div id="post-area-bottom">
                    <div id="bottom-button-01">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Select tag <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Tag One</a></li>
                                <li><a href="#">Tag Two</a></li>
                                <li><a href="#">Tag Three</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="bottom-button-02">
                        <form onsubmit="addTag();return false;"><input type="text" placeholder="New tag..." id="valorTags"></form>
                    </div>
                    <div id="bottom-button-03">
                        <button type="button" class="btn btn-primary btn-block">Publish</button>
                    </div>
                    <div class="clear"></div>
                </div>
                <div id="all-posts-container">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">All posts <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Reference</a></li>
                            <li><a href="#">Request</a></li>
                            <li><a href="#">Post One</a></li>
                            <li><a href="#">Post Twoo</a></li>
                            <li><a href="#">Post Three</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Start of REFERENCE POST -->
                <div class="plataforma-post reference">
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-profile">
                            <div class="post-profile-image"><img src="images/07.jpg"></div>
                            <div class="post-profile-infos">
                                <p class="uo-name">Juliana Almeida</p>
                                <!-- Profile infos POPUP -->
                                <div class="post-profile-infos-popup">
                                    <div class="infos-popup-image">
                                        <img src="images/10.jpg">
                                    </div>
                                    <div class="infos-popup-infos">
                                        <p class="infos-popup-title">Juliana Almeida Silveira</p>
                                        <table>
                                            <tr>
                                                <td rowspan="2"><img src="images/26.png"></td>
                                                <td><p>Brasília - DF</p></td>
                                            </tr>
                                            <tr>
                                                <td><p>Brasil</p></td>
                                            </tr>
                                        </table>
                                        <p>Diretor de Arte</p>
                                        <p>Racionalize Comunicação</p>
                                    </div>
                                    <div class="infos-popup-text">
                                        <p class="infos-popup-title">About me:</p>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                                <!-- END of popup -->
                                <p>Brasília - DF</p>
                                <p>&nbsp;</p>
                                <p>20 de Outubro - 2014</p>
                            </div>
                            <div class="post-profile-flag"><img src="images/14.png"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="hottest-posts-module-link">
                            <ul>
                                <li>#lifeatyle</li>
                                <li>#design</li>
                                <li>#culture</li>
                            </ul>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="post-profile-bigimage">
                        <img src="images/06.jpg" width="100%">
                    </div>
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-liked">
                            <div class="post-liked-left">
                                <img src="images/17.png" class="post-liked-hearth">
                                <p>53 users liked</p>
                            </div>
                            <div class="post-liked-right">
                                <img src="images/16.png">
                                <p>15 comments</p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="plataforma-post-comment">
                            <div class="post-comment-image">
                                <img src="images/08.jpg">
                            </div>
                            <div class="post-comment-text">
                                <textarea placeholder="Write a comment..." class="post-comment-textarea"></textarea>
                            </div>
                            <div class="clear"></div>
                            <div class="more-comment">
                                <button class="btn btn-link more-comment-expand">View comments <span class="caret"></span></button>
                            </div>
                            <div class="more-comment-container">
                                <div class="more-comment-modulo">
                                    <div class="more-comment-modulo-image"><img src="images/08.jpg"></div>
                                    <div class="more-comment-modulo-text"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p></div>
                                </div>
                                <div class="more-comment-modulo">
                                    <div class="more-comment-modulo-image"><img src="images/08.jpg"></div>
                                    <div class="more-comment-modulo-text"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p></div>
                                </div>
                                <div class="more-comment-modulo">
                                    <div class="more-comment-modulo-image"><img src="images/08.jpg"></div>
                                    <div class="more-comment-modulo-text"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of REFERENCE POST -->
                <!-- Start of REQUEST POST -->
                <div class="plataforma-post request">
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-profile">
                            <div class="post-profile-image"><img src="images/07.jpg"></div>
                            <div class="post-profile-infos">
                                <p class="uo-name">Juliana Almeida</p>
                                <!-- Profile infos POPUP -->
                                <div class="post-profile-infos-popup">
                                    <div class="infos-popup-image">
                                        <img src="images/10.jpg">
                                    </div>
                                    <div class="infos-popup-infos">
                                        <p class="infos-popup-title">Juliana Almeida Silveira</p>
                                        <table>
                                            <tr>
                                                <td rowspan="2"><img src="images/26.png"></td>
                                                <td><p>Brasília - DF</p></td>
                                            </tr>
                                            <tr>
                                                <td><p>Brasil</p></td>
                                            </tr>
                                        </table>
                                        <p>Diretor de Arte</p>
                                        <p>Racionalize Comunicação</p>
                                    </div>
                                    <div class="infos-popup-text">
                                        <p class="infos-popup-title">About me:</p>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                                <!-- END of popup -->
                                <p>Brasília - DF</p>
                                <p>&nbsp;</p>
                                <p>20 de Outubro - 2014</p>
                            </div>
                            <div class="post-profile-flag"><img src="images/15.png"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="hottest-posts-module-link">
                            <ul>
                                <li>#lifeatyle</li>
                                <li>#design</li>
                                <li>#culture</li>
                            </ul>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="post-profile-bigimage">
                        <img src="images/06.jpg" width="100%">
                    </div>
                    <div class="plataforma-post-content">
                        <div class="plataforma-post-liked">
                            <div class="post-liked-left">
                                <img src="images/17.png" class="post-liked-hearth">
                                <p>53 users liked</p>
                            </div>
                            <div class="post-liked-right">
                                <img src="images/16.png">
                                <p>15 comments</p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="plataforma-post-comment">
                            <div class="post-comment-image">
                                <img src="images/08.jpg">
                            </div>
                            <div class="post-comment-text">
                                <textarea placeholder="Write a comment..." class="post-comment-textarea"></textarea>
                            </div>
                            <div class="clear"></div>
                            <div class="more-comment">
                                <button class="btn btn-link more-comment-expand">View comments <span class="caret"></span></button>
                            </div>
                            <div class="more-comment-container">
                                <div class="more-comment-modulo">
                                    <div class="more-comment-modulo-image"><img src="images/08.jpg"></div>
                                    <div class="more-comment-modulo-text"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p></div>
                                </div>
                                <div class="more-comment-modulo">
                                    <div class="more-comment-modulo-image"><img src="images/08.jpg"></div>
                                    <div class="more-comment-modulo-text"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p></div>
                                </div>
                                <div class="more-comment-modulo">
                                    <div class="more-comment-modulo-image"><img src="images/08.jpg"></div>
                                    <div class="more-comment-modulo-text"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of post request -->
            </div><!-- end of left column -->
            <aside class="plataforma-col plataforma-col-right">
                <div class="plataforma-search">
                    <form>
                        <input type="text" placeholder="Content search">
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
                    <?php include('./includes/hot.post.module.php'); ?>
                </div>
            </aside>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/asyncUpload.js"></script>
        <script src="js/controlTags.js"></script>
    </body>
</html>