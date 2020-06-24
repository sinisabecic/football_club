<?php
session_start();
require '../config.php';
require '../model/UserModel.php';

$user = new UserModel();

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
                            <li><a href="admin/blog.php">Blog</a></li>
                            <li class="active">Spisak objava</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>



        <?php
    require '../model/BlogModel.php';
    $blog = new BlogModel();
    for ($i = 0; $i<sizeof($blog->getPosts()); $i++) {
        $posts = $blog->getPosts();
        echo '
        <div class="row">
        <div class="col-xs-12">
           <div class="panel  panel-default">
              <div class="col-xs-2">
                 <img src="'.$posts[$i]['image'].'" class="img-responsive" alt="">
                 <div class="clearfix"></div>
              </div>
              <div class="col-xs-8">
                 <div class="row">
                    <div class="col-xs-12">
                       <div class="big-font zuta" style="font-size:24px">'.$posts[$i]['title'].'</div>
                    </div>
                    <div class="col-xs-12 bijela">'.$blog->limit_text($blog->limitParagraphs($posts[$i]['content'], 1), 20).'</div>
                 </div>
              </div>
              <div class="col-xs-2">
                 <button type="button" class="btn btn-danger" onclick="delItem('.$posts[$i]['b_id'].')"><i class="fa fa-trash"></i> Izbriši</button>
                 <a href="/admin/edit_post.php?id='.$posts[$i]['b_id'].'"
                 <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i> Izmijeni</button>
                 </a>                                        
              </div>
           </div>
        </div>
     </div>
     <br>
                        ';
    } ?>



    </div>
</div>

<script src="public/js/jquery.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="bower_components/wysihtml5x/dist/wysihtml5x-toolbar.min.js"></script>
<script src="bower_components/handlebars/handlebars.min.js"></script>
<script src="bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.js"></script>

<script>
    $('#blog_editor').wysihtml5({
        toolbar: {
            fa: true
        }
    });
</script>

<script>
    function delItem(item) {
        if (confirm('Da li ste sigurni?')) {
            var formData = {
                'post_id': item
            };
            $.ajax({
                type: 'POST',
                url: 'functions/admin/delete_post.php',
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
                    alert("Greška, učitajte ponovo");
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
