<?php

require '../../../config.php';
session_start();
require '../../../model/UserModel.php';
require '../../../model/BlogModel.php';
require '../../../model/CommentsModel.php';

$post_id = $_GET['post'];
$blog = new BlogModel();
$post = $blog->getSinglePost($post_id);
$sp_id = $post[0]['post_id'];
$sp_title = $post[0]['post_title'];
$sp_content = $post[0]['post_content'];
$sp_image = $post[0]['post_image'];
$sp_username = $post[0]['post_username'];
$date_temp = new DateTime($post[0]['post_timestamp']);
$sp_timestamp = date_format($date_temp, 'r');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FK West Ham | Blog</title>
    <base href="../../../">
    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" href="dist/img/logo.svg">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/bootswatch/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/jquery.toast.css">

    <link href="public/css/hover.css" rel="stylesheet" media="all">
</head>

<body>

    <?php require_once '../../../partials/navigation.php'; ?>

    <div class="page-holder">
        <div class="container" style="margin-top:75px">
            <div class="row">
                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Blog Post -->

                    <!-- Title -->
                    <h1 class="bordo w-600"><?php echo $sp_title; ?>
                    </h1>

                    <!-- Author -->
                    <p class="lead siva2 w-600">
                        by <a href="#" class="bordo"><?php echo $sp_username; ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p class="siva2 w-600"><span class="glyphicon glyphicon-time"></span> Postavljeno <?php echo $sp_timestamp; ?>
                    </p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-responsive"
                        src="<?php echo $sp_image ?>"
                        alt="image - <?php echo $sp_title ?>">

                    <hr>

                    <!-- Post Content -->
                    <p class="siva w-600" style="font-size:16px">
                        <?php echo $sp_content; ?>
                    </p>
                    <hr>

                    <!-- Blog Comments -->

                    <!-- Comments Form -->
                    <?php if (isset($_SESSION['fk_login'])) {
    $comments = new CommentsModel();
    $total_records = $comments->getCommentsNumber($post_id);

    $submit_date = date('Y-m-d g:i:s A');
    if (isset($_SESSION['fk_login'])) {
        $comment_username = $_SESSION['fk_username'];
    } ?>
                    <div id="respond">
                        <div class="well">
                            <h4>Ostavite komentar:</h4>
                            <!--                                                            <form id="commentform" class="margin-t" method="post">-->
                            <div class="form-group">
                                <input type="hidden" name="user_id" id="user_id"
                                    value="<?php echo $_SESSION['fk_id']; ?>">
                                <input type="hidden" name="post_id" id="post_id"
                                    value="<?php echo $post_id; ?>">
                                <input type="hidden" name="timestamp" id="timestamp"
                                    value="<?php echo $submit_date; ?>">
                                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                                <input type="hidden" name="parent_id" id="parent_id" value="0" />
                            </div>
                            <input type="submit" name="submit_comment" id="submit-comm" value="Pošalji komentar"
                                class="form-control btn btn-primary" />
                            <!--                                                            </form>-->
                        </div>
                    </div>
                    <?php
//                    if(isset($_POST['submit'])){
//                        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;
//                        $commentsContent = isset($_POST['comment']) ? $_POST['comment'] : 'No content'; //textarea name
//                        $comm_query = $comments->newComment($_SESSION['fk_id'], $post_id, $commentsContent, $submit_date, $parent_id);
//                        $myfile = fopen("log_file.txt", "w") or die("Unable to open file!");
//                        fwrite($myfile, $comm_query);
//
//                        if($comm_query){
//                            var_dump($comm_query);
//                        } else {
//                            echo "<h1>ERROR</h1>";
//                            var_dump($comm_query);
//                        }
//                    }
////                        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;

                    $comments->getCommentsByID($post_id); ?>
                    <?php
} else { ?>
                    <div class="well">
                        <h4>Morate se prijaviti ukoliko želite da komentarišete vijesti!</h4>
                        <a class="btn btn-primary" href="pages/login/">Prijavi se!</a>
                    </div>
                    <?php } ?>


                </div>

            </div>
        </div>
    </div>


    <?php  require('../../../partials/footer.php')  ?>


    <script>
        $('a.comment-reply-link').click(function(e) {
            var id = $(this).attr("id");
            $("#parent_id").attr("value", id);
            $('#comment').focus();
            e.preventDefault();
        });

        $('#submit-comm').click(function(e) {
            var formData = {
                'user_id': $('#user_id').val(),
                'post_id': $('#post_id').val(),
                'timestamp': $('#timestamp').val(),
                'content': $('#comment').val(),
                'parent': $('#parent_id').val()
            };
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: 'functions/blog/comment.php',
                data: formData,
                success: function(data) {
                    //console.log(data);
                    if (data.error) {
                        alert("Nije uspio upis komentara!");
                    } else {
                        console.log(data);
                        window.location.reload(true);
                    }
                },
                error: function(error) {
                    console.log("ERROR!");
                    console.log(JSON.stringify(error));
                },
                async: true
            });
            e.preventDefault();
        });
    </script>
</body>

</html>