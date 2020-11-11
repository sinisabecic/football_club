<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 11.02
 */
require '../../config.php';
session_start();
require '../../model/UserModel.php';
require '../../model/BlogModel.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FK | Blog</title>
    <base href="../../">
    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" href="dist/img/logo.svg">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/bootswatch/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link href="public/css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
</head>

<body>

    <?php require_once '../../partials/navigation.php'; ?>

    <div class="page-holder">
        <div class="container" style="margin-top:55px;">
            <div class="page-header text-center">
                <h1 class="bordo bg-siva2 radius10">Novosti<small></small></h1>

            </div>
            <div class="row">

                <?php
                $blog = new BlogModel();

                $total = $blog->getNumPost();
                $limit = 5;
                $pages = ceil($total / $limit);

                $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                    'options' => array(
                        'default' => 1,
                        'min_range' => 1
                    ),
                )));

                $actual_link = 'http://' . BASE_URL . '/pages/blog/';

                $offset = ($page - 1) * $limit;

                $start = $offset + 1;
                $end = min(($offset + $limit), $total);
                for ($i = 0; $i < sizeof($blog->getPostsPag($limit, $offset)); $i++) {
                    $post = $blog->getPostsPag($limit, $offset);

                    $id = $post[$i]['post_id'];
                    $title = $post[$i]['post_title'];
                    $image = $post[$i]['post_image'];
                    $date_temp = new DateTime($post[$i]['post_timestamp']);
                    $timestamp = date_format($date_temp, 'r');
                    $content = $blog->limitParagraphs($post[$i]['post_content'], 1);
                    $username = $post[$i]['post_username']; ?>

                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail post-card hvr-hang">
                            <a href="pages/blog/single-post/?post='<?php echo $id; ?>'">
                                <img src="<?php echo $image; ?>" class="post-card-img" alt="...">
                            </a>
                            <div class="caption">
                                <p class="bg-bordo radius6 text-center" style="color:#fff"><?php echo $timestamp; ?>
                                </p>
                                <a href="pages/blog/single-post/?post='<?php echo $id; ?>'">
                                    <h3><?php echo $title; ?>
                                    </h3>
                                </a>
                                <p><?php echo $content; ?>
                                </p>
                                <p><a href="<?php echo $actual_link . 'single-post/?post=' . $id; ?>" class="btn btn-primary" role="button">Pročitaj više</a></p>
                            </div>
                        </div>
                    </div>

                <?php
                } ?>
            </div>
            <div class="text-center" style="margin-top:65px;">
                <hr>
                <?php
                $prevlink = ($page > 1) ? '<a class="btn btn-primary" href="' . $actual_link . '?page=1"
                title="Prva stranica">&laquo;</a> <a class="btn btn-primary"
                href="' . $actual_link . '?page=' . ($page - 1) . '" title="Prethodna stranica">&lsaquo;</a>' : '<a
                class="btn btn-primary disabled">&laquo;</a> <a class="btn btn-primary disabled">&lsaquo;</a>';

                // The "forward" link
                $nextlink = ($page < $pages) ? '<a class="btn btn-primary" href="'
                    . $actual_link . '?page=' . ($page + 1) . '" title=" Sledeća stranica">&rsaquo;</a> <a
                    class="btn btn-primary" href="' . $actual_link . '?page=' . $pages . '"
                    title="Last page">&raquo;</a>' : '<a class="btn btn-primary disabled">&rsaquo;</a> <a
                    class="btn btn-primary disabled">&raquo;</a>';
                echo '<div id="paging">
                    <p class="bordo">', $prevlink, ' Stranica ', $page, ' od ', $pages, ' stranica, prikazivanje ', $start, '-', $end,
                    ' od ',
                    $total,
                    ' rezultata ',
                    $nextlink,
                    ' </p>
                </div>';

                ?>
            </div>
        </div>
        <?php require('../../partials/footer.php'); ?>
        <script src="public/js/jquery.js"></script>
        <script src="public/js/bootstrap.min.js"></script>
</body>

</html>