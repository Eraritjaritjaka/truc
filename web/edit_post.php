<?php

require "../bootstrap.php";

use Entity\Post;

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $post = $em->getRepository('Entity\Post')->findOneBy(array('id' => $_GET['id']));
}

if (isset($_POST['subject']) && isset($_POST['message'])) {
    if (!empty($_POST['subject']) && !empty($_POST['message'])) {
        $post->setSubject($_POST['subject']);
        $post->setMessage($_POST['message']);
        $em->persist($post);
        $em->flush();
        header('Location: comment.php?id=' . $post->getId() . '');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>IMIEBook - Comment</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">
                <!-- main right col -->
                <div class="column col-sm-12 col-xs-12" id="main">

                    <!-- top nav -->
                    <div class="navbar navbar-blue navbar-static-top">
                        <div class="navbar-header">
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="/formation-doctrine-juin2016-master/web/post.php" class="navbar-brand logo">b</a>
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <form class="navbar-form navbar-left" action="post.php">
                                <div class="input-group input-group-sm" style="max-width:360px;">
                                    <input type="text" class="form-control" placeholder="Search" name="search-word" id="srch-term">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" name="search" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="">Home</a>
                                </li>
                                <li>
                                    <a href="register.php">Register</a>
                                </li>
                                <li>
                                    <a href="login.php">Login</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /top nav -->

                    <div class="padding">
                        <div class="full col-sm-9">
                            <!-- content -->
                            <div class="row">
                                <div class="col-sm-push-2 col-sm-8">
                                    <div class="well">
                                        <form class="form-horizontal" role="form" method="POST" action="edit_post.php?id=<?= $post->getId() ?>">
                                            <h4>Editer</h4>
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?= $post->getId() ?>">
                                                <input class="form-control" type="text" name="subject" value="<?= $post->getSubject() ?>" />
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="message"><?= $post->getMessage() ?></textarea>
                                            </div>
                                            <button class="btn btn-primary pull-right" name="edit" type="submit">Enregistrer</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                        </form>
                                    </div>
                                </div>
                            </div><!--/row-->
                            <hr>
                        </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->

            </div>
        </div>
    </div>
    <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>