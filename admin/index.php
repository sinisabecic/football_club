<?php
session_start();
require '../config.php';
require '../model/UserModel.php';

$user = new UserModel();

if ($user->is_admin($_SESSION['fk_id']) == 1) {
    ?>

<?php require('header.php'); ?>

<?php require('navigation.php') ?>


<div class="container" style="margin-top:75px">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header bijela">Kontrolna tabla</h1>
            <hr class="bg-zuta">
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel bg-bordo animate__animated animate__fadeInLeft">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Blog</div>
                        </div>
                    </div>
                </div>
                <a href="admin/blog.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel  bg-bordo animate__animated animate__fadeInLeft">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comment fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Komentari</div>
                        </div>
                    </div>
                </div>
                <a href="admin/comments.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel bg-bordo animate__animated animate__fadeInRight">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Korisnici</div>
                        </div>
                    </div>
                </div>
                <a href="admin/users.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel  bg-bordo animate__animated animate__fadeInRight">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Timovi</div>
                        </div>
                    </div>
                </div>
                <a href="admin/teams.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel  bg-plava animate__animated animate__fadeInLeft">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-circle-o fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Igrači</div>
                        </div>
                    </div>
                </div>
                <a href="admin/players.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel  bg-plava animate__animated animate__fadeInLeft">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-500px fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Kola</div>
                        </div>
                    </div>
                </div>
                <a href="admin/rounds.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel  bg-plava animate__animated animate__fadeInRight">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-trophy fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Sezone</div>
                        </div>
                    </div>
                </div>
                <a href="admin/league.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel  bg-plava animate__animated animate__fadeInRight">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-dashboard fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="big-font">Statistike</div>
                        </div>
                    </div>
                </div>
                <a href="admin/statistics.php">
                    <div class="panel-footer">
                        <span class="pull-left bijela">Pogledaj detalje</span>
                        <span class="pull-right"><i class="bijela glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>



</div>


<script src="public/js/jquery.js"></script>
<script src="public/js/bootstrap.min.js"></script>
</body>

</html>

<?php
} else {
        header('Location: http://' . BASE_URL . '');
    }
