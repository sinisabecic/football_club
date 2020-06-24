<?php
session_start();
require '../config.php';
require '../model/UserModel.php';
require '../model/CommentsModel.php';

$user = new UserModel();
$comment = new CommentsModel();

if ($user->is_admin($_SESSION['fk_id']) == 1) {
    ?>

<?php require('header.php'); ?>



<?php require('navigation.php') ?>

<div class="page-holder" style="margin-top:75px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="container">
                        <ul class="breadcrumb">
                            <li><a href="admin/index.php">Administracija</a></li>
                            <li class="active">Komentari</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <h3 data-toggle="collapse" data-target="#komentari">Lista svih komentara <i
                            class="fa fa-arrow-circle-down"></i></h3>
                    <div id="komentari" class="collapse">
                        <table class="table table-bordered table-hover bg-siva">
                            <?php
        $lista_komentara = $comment->getAllCommentsForAdmin();
    if ($lista_komentara) {
        echo '<tr><th>Korisnik</th><th>Objava</th><th>Komentar</th><th>Datum</th><th>Ukloni</th>';
        for ($i = 0; $i < sizeof($lista_komentara); $i++) {
            $lista=$comment->getAllCommentsForAdmin();
            echo '<tr>
                    <td>'.$lista[$i]['comments_username'].'</td>
                    <td>'.$lista[$i]['comments_blog_title'].'</td>
                    <td>'.$lista[$i]['comments_content'].'</td>
                    <td>'. date('d-m-Y H:m:s', strtotime($lista[$i]['comments_timestamp'])) .'</td>
                    <td>
                    <button class="btn btn-primary btn-xs" 
                    onclick="deleteComment('.$lista[$i]['comments_id'].')">Ukloni</button></td></tr>';
        }
    } ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <h1 class="bijela">Istorija komentara</h1>
                    <?php
                    
    $lista_komentara = $comment->getAllCommentsForAdmin();
    if ($lista_komentara) {
        for ($i = 0; $i < sizeof($lista_komentara); $i++) {
            $lista = $comment->getAllCommentsForAdmin();
            echo '<div class="panel  panel-default"><div class="panel-heading"><span>' . $lista[$i]['comments_blog_title'] . '</span></div>
                                <div class="panel -body"><i>' . $lista[$i]['comments_content'] . '</i></div>
                                <div class="panel-footer"><span class="pull-left">' . $lista[$i]['comments_username'] . '</span><span class="pull-right">' . date('d-m-Y H:m:s', strtotime($lista[$i]['comments_timestamp'])) . '</span><div class="clearfix"></div></div>
                               
                                </div>';
        }
    } ?>
                </div>
                <div class="col-lg-4">
                    <h1 class="bijela">Odobreni komentari</h1>
                    <?php
                    $comment = new CommentsModel();
    $lista_komentara = $comment->getOdobreniForAdmin();
    if ($lista_komentara) {
        for ($i = 0; $i < sizeof($lista_komentara); $i++) {
            $lista = $comment->getOdobreniForAdmin();
            echo '<div class="panel  panel-default"><div class="panel-heading"><span>' . $lista[$i]['comments_blog_title'] . '</span></div>
                                <div class="panel -body"><i>' . $lista[$i]['comments_content'] . '</i></div>
                                <div class="panel-footer"><span class="pull-left">' . $lista[$i]['comments_username'] . '</span><span class="pull-right">' . date('d-m-Y H:m:s', strtotime($lista[$i]['comments_timestamp'])) . '</span><div class="clearfix"></div></div>
                               
                                </div>';
        }
    } else {
        echo '<br><span class="alert alert-info">Nema odobrenih komentara :(</span>';
    } ?>
                </div>
                <div class="col-lg-4">
                    <h1 class="bijela">Neodobreni</h1>
                    <?php
                    $comment = new CommentsModel();
    $lista_komentara = $comment->getNeodobreniForAdmin();
    if ($lista_komentara) {
        for ($i = 0; $i < sizeof($lista_komentara); $i++) {
            $lista = $comment->getNeodobreniForAdmin();
            echo '<div class="panel  panel-default"><div class="panel-heading"><span>' . $lista[$i]['comments_blog_title'] . '</span></div>
                                <div class="panel -body"><i>' . $lista[$i]['comments_content'] . '</i><br><p>
                                <form action="functions/admin/update_comment.php" method="POST">
                                <input type="hidden" name="comments_id" value="' . $lista[$i]['comments_id'] . '"> 
                                	<button class="btn btn-default" type="Sačuvaj" id="odobri">
                                	 <i class="fa fa-check"></i> Odobri
                                	</button>
                                </form>
                                
                                </p>
                                </div>
                                <div class="panel-footer"><span class="pull-left">' . $lista[$i]['comments_username'] . '</span><span class="pull-right">' . date('d-m-Y H:m:s', strtotime($lista[$i]['comments_timestamp'])) . '</span><div class="clearfix"></div></div>
                               
                                </div>';
        }
    } ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>

    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.min.js"></script>

    <script>
        function deleteComment(item) {
            if (confirm('Da li ste sigurni?')) {
                var formData = {
                    'comment_id': item
                };
                $.ajax({
                    type: 'POST',
                    url: 'functions/blog/delete-comment.php',
                    data: formData,
                    success: function(response) {
                        if (response.error) {
                            console.log(response.error);
                            alert(response.error);
                        } else {
                            console.log(response.success);
                            window.location.reload(true);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Greška");
                    },
                    async: false
                });
            }
        }
    </script>
    </body>

    </html>

    <?php
} else {
        header('Location: http://' . BASE_URL . '');
    }
