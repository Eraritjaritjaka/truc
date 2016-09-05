<?php

require "../bootstrap.php";

use Entity\Post;
use Entity\PostLike;

if (isset($_POST['title']) && isset($_POST['message'])) {
    if (!empty($_POST['title']) && !empty($_POST['message'])) {
        $post = new Post;
        $post->setSubject($_POST['title']);
        $post->setMessage($_POST['message']);
        $post->setDate(new \DateTime());
        $post->setAuthor($currentuser);
        $em->persist($post);
        $em->flush();
    }
}

$posts = $em->getRepository('Entity\Post')->findBy(array(), array('date' => 'DESC'));

if (isset($_GET['search-word']) && !empty($_GET['search-word'])) {
    $searchs = $em->getRepository('Entity\Post')->getSearchText($_GET['search-word']);
}

if (isset($_GET['like']) && !empty($_GET['like'])) {
    $post = $em->getRepository('Entity\Post')->findOneBy(array('id' => $_GET['id']));
    $like = new PostLike();
    $like->setPost($post);
    $like->setUser($currentuser);
    if ($_GET['like'] == 2) {
        $like->setScore('-1');
    } else {
        $like->setScore('1');
    }
    $em->persist($like);
    $em->flush();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>IMIEBook</title>
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
                            <form class="navbar-form navbar-left" action="post.php" method="get">
                                <div class="input-group input-group-sm" style="max-width:360px;">
                                    <input type="text" class="form-control" placeholder="Search" name="search-word" id="srch-term">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Search</button>
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

                                <!-- main col left -->
                                <div class="col-sm-5">
                                    <div class="well">
                                        <form class="form-horizontal" role="form" action="post.php" method="post">
                                            <h4>What's New</h4>
                                            <div class="form-group" style="padding:14px;">
                                                <input type="text" class="form-control" name="title" placeholder="Titre"/>
                                                <hr/>
                                                <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                            </div>
                                            <button class="btn btn-primary pull-right" name="post" type="submit">Post</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                        </form>
                                    </div>
                                </div>

                                <!-- main col right -->
                                <div class="col-sm-7">
<?php
if (isset($_GET['search-word']) && !empty($_GET['search-word'])) {
    foreach ($searchs as $search) {
        echo '
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="comment.php?id=' . $search->getId() . 
                    '" class="pull-right">comments</a>
                    <h4>' . $search->getSubject() . '</h4>' . 
                    date_format($search->getDate(), "y:m:d:H:i:s") . 
                '</div>
                <div class="panel-body">' . 
                    $search->getMessage() . '.
                </div>
            </div>';
    }
} else {
    foreach ($posts as $post) {
        echo '
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="edit_post.php?id=' . $post->getId() . 
                    '" class="pull-right">édit</a>
                    <h4><a href="comment.php?id=' . $post->getId() . 
                    '">' . $post->getSubject() . '</a></h4>' . 
                    date_format($post->getDate(), "y:m:d:H:i:s") . 
                '<div class="pull-right"><a href="post.php?id=' . $post->getId() . 
                    '&like=1">like</a> / <a href="post.php?id=' . $post->getId() . 
                    '&like=2">dislike</a></div></div>
                <div class="panel-body">' . 
                    $post->getMessage() . '.
                </div>
            </div>';
    }
}
?>

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
