<?php

require "../bootstrap.php";

use Entity\Comment;

$post = $em->getRepository('Entity\Post')->findOneBy(array('id' => $_GET['id']));
//$post = $em->getRepository('Entity\Post')->find($_GET['id']);
//$post = $em->getRepository('Entity\Post')->findOneById($_GET['id']);

if (isset($_POST['message']) && !empty($_POST['message'])) {
    $com = new Comment;
    $com->setMessage($_POST['message']);
    $com->setDate(new \DateTime());
    $com->setAuthor($currentuser);
    $com->setPost($post);
    $em->persist($com);
    $em->flush();
}

$coms = $em->getRepository('Entity\Comment')->findBy(array('post' => $_GET['id']), array('date' => 'ASC'));

if (isset($_GET['delpost']) && $_GET['delpost'] == 1) {
    $em->remove($post);
    $em->flush();
    header('Location: post.php');
}

if (isset($_GET['delcom']) && !empty($_GET['delcom'])) {
    $com = $em->getRepository('Entity\Comment')->findOneBy(array('id' => $_GET['delcom']));
    $em->remove($com);
    $em->flush();
    header('Location:  comment.php?id=' . $post->getId() . '');
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
                                    <a href="comment.php?id=<?= $_GET['id'] ?>">Home</a>
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
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <a href="comment.php?id=<?= $post->getId() ?>&delpost=1" class="pull-right">X</a><br>
                                            <h4></h4>
                                            <?= date_format($post->getDate(), "y:m:d:H:i:s") ?>
                                            <a href="edit_post.php?id=<?= $post->getId() ?>" class="pull-right">edit</a>
                                        </div>
                                        <div class="panel-body">
                                            <?= $post->getMessage() ?>
                                        </div>
                                    </div>
                                </div>
<?php
foreach ($coms as $com) {
    echo '
        <div class="col-sm-push-2 col-sm-8">
            <div class="panel panel-default">
                <a href="comment.php?id=' . $post->getId() . '&delcom=' . $com->getId() . '" class="pull-right">X</a><br>
                <div class="panel-body">' . date_format($com->getDate(), "y:m:d:H:i:s") . '<br/>' . 
                    $com->getMessage() . 
                '</div>
            </div>
        </div>';
}
?>

                                <div class="col-sm-push-2 col-sm-8">
                                    <div class="well">
                                        <form class="form-horizontal" role="form" action="comment.php?id= <?= $_GET['id'] ?> " method="post">
                                            <h4>Commenter</h4>
                                            <div class="form-group" style="padding:14px;">
                                                <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                            </div>
                                            <button class="btn btn-primary pull-right" name="comment" type="submit">Envoyer</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
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
