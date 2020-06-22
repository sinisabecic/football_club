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
require '../../model/TeamModel.php';

$team = new TeamModel();

$team_header = $team->team_header();

$ime_tima = $team_header[0]['ime_tima'];
$osnovan = $team_header[0]['osnovan'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FK Lorem | Prijava korisnika</title>
    <base href="../../">
    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" href="dist/img/logo.svg">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/bootswatch/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/hover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
</head>

<body>

    <?php require_once '../../partials/navigation.php';?>

    <div class="page-holder" style="margin-top:85px">
        <div class="container">
            <div class="row">
                <div class="well text-center bg-bordo radius10 animate__animated animate__zoomIn">
                    <h1><?php echo $ime_tima ?>
                    </h1><br>
                    <h3>- Osnovan <?php echo $osnovan ?> -
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="well text-center radius10 animate__animated animate__zoomInUp"
                    style="background-color:#346135">
                    <?php
                if (sizeof($team->get_my_team())==0) {
                    'Nemamo registrovanih igrača!';
                } else {
                    for ($i = 0; $i < sizeof($team->get_my_team()); $i++) {
                        $players = $team->get_my_team();
                        echo '<div class="col-sm-3">
            <img class="img-circle hvr-grow"
                 src="dist/img/fudbaler.svg"
                 alt="Generic placeholder image" width="140" height="140">
            <h2 class="bijela">'.$players[$i]['ime_fudbalera'].' '.$players[$i]['prezime_fudbalera'].'</h2>
            <p><a class="btn btn-primary" style="text-transform: uppercase" role="button">'.$players[$i]['broj_dresa'].' '.$players[$i]['pozicija_fudbalera'].'</a></p>
</div>';
                    }
                }
                ?>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <?php require('../../partials/footer.php'); ?>


    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
</body>

</html>