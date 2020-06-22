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
                            <li class="active">Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel bg-plava">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="big-font">Dodavanje vijesti</div>
                            </div>
                        </div>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#createBlog">
                        <div class="panel-footer">
                            <span class="pull-left bijela">Dodaj</span>
                            <span class="pull-right"><i
                                    class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
                <div id="createBlog" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Novi post</h4>
                            </div>
                            <div class="modal-body">
                                <form action="functions/admin/new_post.php" method="post" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                                        <span class="input-group-addon">Naslov</span>
                                        <input type="text" name="title" id="title" class="form-control">
                                    </div>
                                    <br>
                                    <input type="file" name="file" id="files" />
                                    <img id="image" />
                                    <textarea class="textarea" id="blog_editor" name="blog_editor"
                                        placeholder="Dodaj tekst ..."
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;"></textarea>
                                    <button type="submit" class="form-control btn btn-primary" name="submit"
                                        id="submit">Dodaj post</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Izađi</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel  bg-bordo">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-pencil fa-4x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="big-font bijela">Lista vijesti</div>
                            </div>
                        </div>
                    </div>
                    <a href="admin/list_news.php">
                        <div class="panel-footer">
                            <span class="pull-left bijela">Vidi</span>
                            <span class="pull-right"><i
                                    class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

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
</body>

</html>

<?php
} else {
        header('Location: http://' . BASE_URL . '');
    }
