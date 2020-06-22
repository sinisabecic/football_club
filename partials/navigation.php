<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
    $(window).on('scroll', function() {
        if ($(window).scrollTop()) {
            $('nav').addClass('nav-scroll');
        } else {
            $('nav').removeClass('nav-scroll');
        }
    })
</script>

<!-- Navigation -->
<header class="navbar">

    <nav class="navbar navbar-inverse navbar-fixed-top nav-top" role="navigation">

        <div class="container text-right slogan animate__animated animate__slideInRight">
            <h4>West Ham Till I Die</h4>
        </div>
    </nav>

    <nav class="navbar navbar-inverse navbar-fixed-top nav-down" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand " href="index.php">
                    <img class="logo animate__animated animate__flipInX" src="dist/img/logo.svg" alt="">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Početna</a>
                    </li>
                    <li>
                        <a href="pages/about">Klub</a>
                    </li>
                    <li><a href="pages/blog">Novosti</a></li>
                    <?php
                if (isset($_SESSION['fk_login'])) {
                    $user = new UserModel();
                    if ($user->is_admin($_SESSION['fk_id'])) {
                        echo '<li><a href="admin"><i class="glyphicon glyphicon-user"></i> '.$_SESSION['fk_username'].'</a></li>
                            <li><a href="functions/user/logout.php" id="btn_logout"><i class="glyphicon glyphicon-log-out"></i> Odjavi se</a></li>';
                    } else {
                        echo '<li><a href="#"><i class="glyphicon glyphicon-user"></i> '.$_SESSION['fk_username'].'</a></li>
                            <li><a href="functions/user/logout.php" id="btn_logout"><i class="glyphicon glyphicon-log-out"></i> Odjavi se</a></li>';
                    }
                } else {
                    ?>
                    <li id="login"><a href="pages/login/"><i class="glyphicon glyphicon-log-in"></i> Prijava</a>
                    </li>
                    <li id="register"><a href="pages/register/">Registracija</a></li>
                    <?php
                } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header>