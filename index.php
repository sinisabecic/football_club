<?php

require 'config.php';
session_start();
require 'model/UserModel.php';
require 'model/StatisticsModel.php';
$stats = new StatisticsModel();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FK West Ham | Početna strana</title>
    <base href="">
    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" href="dist/img/logo.svg">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/bootswatch/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/fa/css/font-awesome.min.css">

    <link rel="stylesheet" href="public/css/jquery.toast.css">
    <link href="public/css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />


</head>

<body>

    <?php require_once 'partials/navigation.php'; ?>

    <div class="container-lg">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">

            </ol>
            <div class="carousel-inner" role="listbox">

            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!-- /.carousel -->
    </div>


    <div class="container" style="margin-top:55px">

        <!-- Lista postova -->
        <div class="row">

            <div class="page-header text-center">
                <h1 class="bordo bg-siva2">Najnovije vijesti<small></small></h1>

            </div>

            <?php
            require 'model/BlogModel.php';
            $blog = new BlogModel();
            $blog_list = $blog->getLastThree();
            for ($i = 0; $i < sizeof($blog_list); $i++) {
                $post = $blog_list;
                $id = $post[$i]['post_id'];
                $title = $post[$i]['post_title'];
                $image = $post[$i]['post_image'];
                $content = $blog->limit_text($blog->limitParagraphs($post[$i]['post_content'], 1), 30); ?>

                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail post-card hvr-hang">
                        <a href="pages/blog/single-post/?post='<?php echo $id; ?>'">
                            <img class="post-card-img" src="<?php echo $image; ?>" alt="..."></a>
                        <div class="caption">
                            <a href="pages/blog/single-post/?post='<?php echo $id; ?>'">
                                <h3><?php echo $title; ?>
                                </h3>
                            </a>
                            <p><?php echo $content ?>
                            </p>
                            <p><a href="pages/blog/single-post/?post='<?php echo $id; ?>'" class="btn btn-primary" role="button">Pročitaj &raquo;</a></p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div><!-- /.row -->
    </div>


    <div class="container">

        <div class="row" style="margin-top:45px;margin-bottom:40px">
            <div class="page-header text-center">
                <h1 class="bordo bg-siva2">Statistika<small></small></h1>
            </div>
            <div class="row">
                <div class="col-md-4 statistika">
                    <div class="well stats" style="background:#5A5A5A;color:#F5F5F5">
                        <h4><i class="fa fa-soccer-ball-o"></i> Lista strijelaca</h4>
                        <?php

                        if (sizeof($stats->lista_strelaca()) == 0) {
                            echo 'Nema strijelaca';
                        } else {
                            echo '<table class="table table-hover">';
                            for ($i = 0; $i < sizeof($stats->lista_strelaca()); $i++) {
                                $stats_strijelci = $stats->lista_strelaca();
                                echo '<tr><td>' . ($i + 1) . '</td><td>' . $stats_strijelci[$i]['stat_ime'] . ' ' . $stats_strijelci[$i]['stat_prezime'] . '</td><td>' . $stats_strijelci[$i]['br_golova'] . '</td></tr>';
                            }
                            echo '</table>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4 statistika">
                    <div class="well stats" style="color:#fff">
                        <h4><i class="fa fa-gift"></i> Lista asistenata</h4>
                        <?php

                        if (sizeof($stats->lista_asistenata()) == 0) {
                            echo 'Nema asistenata';
                        } else {
                            echo '<table class="table table table-hover">';
                            for ($j = 0; $j < sizeof($stats->lista_asistenata()); $j++) {
                                $stats_asistenti = $stats->lista_asistenata();
                                echo '<tr><td>' . ($j + 1) . '</td><td>' . $stats_asistenti[$j]['stat_ime'] . ' ' . $stats_asistenti[$j]['stat_prezime'] . '</td><td>' . $stats_asistenti[$j]['br_asistencija'] . '</td></tr>';
                            }
                            echo '</table>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-4 statistika">
                    <div class="well bg-bordo stats" style="color:#fff">
                        <h4><i class="fa fa-soccer-ball-o"></i> Lista utakmica</h4>
                        <?php

                        if (sizeof($stats->lista_utakmica()) == 0) {
                            echo 'Nema utakmica';
                        } else {
                            echo '<table class="table table-hover">';
                            for ($k = 0; $k < sizeof($stats->lista_utakmica()); $k++) {
                                $stats_utakmice = $stats->lista_utakmica();
                                echo '<tr><td>' . ($k + 1) . '</td><td style="text-align:right;">' . $stats_utakmice[$k]['domaci_tim'] . ' (' . $stats_utakmice[$k]['stat_home'] . ')</td><td>(' . $stats_utakmice[$k]['stat_guest'] . ') ' . $stats_utakmice[$k]['gostujuci_tim'] . '</td></tr>';
                            }
                            echo '</table>';
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container" style="margin-top:85px">
        <div class="row">
            <div class="page-header">
                <h1 class="bordo text-left bg-siva2 w-600 r-statistika"> Realna statistika<small class="siva">
                        2020/2021
                        godina</small></h1>
            </div>
            <div class="col-md-4">
                <h3 class="bordo">Tabela</h3>
                <hr class="siva2">
                <div id="fs-standings"></div>
                <script>
                    (function(w, d, s, o, f, js, fjs) {
                        w['fsStandingsEmbed'] = o;
                        w[o] = w[o] || function() {
                            (w[o].q = w[o].q || []).push(arguments)
                        };
                        js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
                        js.id = o;
                        js.src = f;
                        js.async = 1;
                        fjs.parentNode.insertBefore(js, fjs);
                    }(window, document, 'script', 'mw', 'https://cdn.footystats.org/embeds/standings.js'));
                    mw('params', {
                        leagueID: 2012
                    });
                </script>
            </div>

            <div class="col-md-4 forma">
                <h3 class="bordo">Forma našeg tima u ligi</h3>
                <hr class="siva2">
                <iframe src="https://footystats.org/api/club?id=153" height="100%" width="100%" style="height:420px; width:100%;" frameborder="0"></iframe>
            </div>

            <div class="col-md-4 naredni-mec">
                <h3 class="bordo">Naredni meč</h3>
                <hr class="siva2">
                <div id="fs-upcoming"></div>
                <script>
                    (function(w, d, s, o, f, js, fjs) {
                        w['fsUpcomingEmbed'] = o;
                        w[o] = w[o] || function() {
                            (w[o].q = w[o].q || []).push(arguments)
                        };
                        js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
                        js.id = o;
                        js.src = f;
                        js.async = 1;
                        fjs.parentNode.insertBefore(js, fjs);
                    }(window, document, 'script', 'fsUpcoming',
                        'https://cdn.footystats.org/embeds/upcoming.js'));
                    fsUpcoming('params', {
                        teamID: 153
                    });
                </script>
            </div>
        </div>
    </div><!-- End container  -->



    <!-- Futer -->
    <?php require('partials/footer.php') ?>




    <script>
        //    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'functions/blog/carousel.php',
            success: function(response) {
                console.log(response);
                console.log(response[0].post_id);
                for (var i = 0; i < response.length; i++) {
                    $('<div class="item"><img src="' + response[i].post_image +
                        '"><div class="carousel-caption"><a href="pages/blog/single-post/?post=' +
                        response[i].post_id + '"><h1 class="bijela">' + '' + response[i]
                        .post_title +
                        '</h1></div></div>').appendTo(
                        '.carousel-inner');
                    $('<li data-target="#carousel-example-generic" data-slide-to="' + i + '"></li>')
                        .appendTo('.carousel-indicators');
                }
                $('.item').first().addClass('active');
                $('.carousel-indicators > li').first().addClass('active');
                $('#carousel-example-generic').carousel();
            },
            async: false
        });
        //    })
    </script>

    <!-- <script>
$.toast({
    heading: 'Dobrodošli',
    text: 'Ovo je prezentacija sajta FK West Ham',
    position: 'bottom-right',
    icon: 'info',
    loader: true, // Change it to false to disable loader
    loaderBg: '#9EC600'
})
</script> -->

</body>

</html>