<?php
session_start();
require '../config.php';
require '../model/UserModel.php';
require '../model/SeasonModel.php';
require '../model/TeamModel.php';
require '../model/RoundModel.php';
require '../model/GameModel.php';
require '../model/Player.php';
require '../model/StatisticsModel.php';

$user = new UserModel();
$season = new SeasonModel();
$round = new RoundModel();
$team = new TeamModel();
$game = new GameModel();
$player = new Player();
$stats = new StatisticsModel();

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
                            <li class="active">Statistike</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <div class="well">
                    <h3 data-toggle="collapse" data-target="#utakmice">Utakmice bez rezultata <i
                            class="fa fa-arrow-circle-down"></i></h3>
                    <div id="utakmice" class="collapse">
                        <?php
                            if (sizeof($game->fetch_games()) == 0) {
                                echo '<div class="alert alert-danger">';
                                echo 'Nema utakmica.';
                                echo '</div>';
                            } else {
                                for ($i = 0; $i < sizeof($game->fetch_games()); $i++) {
                                    $games = $game->fetch_games();
                                    $game_id = $games[$i]['game_id'];
                                    $home_team = $games[$i]['home_team'];
                                    $guest_team = $games[$i]['guest_team'];
                                    $game_date = $games[$i]['game_date']; ?>
                        <form action="functions/admin/update_game.php" method="post" class="form-inline">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $home_team ?>
                                </span>
                                <input type="number" class="form-control-static" name="home_team">
                            </div>
                            <span><b> - </b></span>
                            <div class="input-group">
                                <input type="number" class="form-control-static" name="guest_team">
                                <span class="input-group-addon">
                                    <?php echo $guest_team ?>
                                </span>
                            </div>
                            <input type="hidden" name="game_id"
                                value="<?php echo $game_id; ?>">
                            <button type="submit" class="btn btn-primary">Sačuvaj</button>
                        </form>
                        <?php
                                }
                            } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="well">
                    <h3 data-toggle="collapse" data-target="#statistika">Statistika za igrača <i
                            class="fa fa-arrow-circle-down"></i></h3>
                    <div id="statistika" class="collapse">
                        <h4>Novi unos</h4>
                        <form action="functions/admin/new_stat.php" class="form-horizontal" method="post">
                            <div class="input-group">
                                <span class="input-group-addon">Utakmica</span>
                                <select name="utakmica_id" id="utakmica_id" class="form-control">
                                    <?php
                                        if (sizeof($game->fetch_all_games()) == 0) {
                                            echo '<option>Nema dostupnih utakmica</option>';
                                        } else {
                                            for ($j = 0; $j < sizeof($game->fetch_all_games()); $j++) {
                                                $games = $game->fetch_all_games();
                                                echo '<option value="'.$games[$j]['game_id'].'">'.$games[$j]['home_team'].' - '.$games[$j]['guest_team'].' ('.$games[$j]['game_date'].')</option>';
                                            }
                                        } ?>
                                </select>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Fudbaler</span>
                                <select name="fudbaler_id" id="fudbaler_id" class="form-control">
                                    <?php
                                        if (sizeof($player->fetch_players()) == 0) {
                                            echo '<option>Nema dostupnih igraca</option>';
                                        } else {
                                            for ($k = 0; $k < sizeof($player->fetch_players()); $k++) {
                                                $players = $player->fetch_players();
                                                echo '<option value="'.$players[$k]['id'].'">'.$players[$k]['ime'].' '.$players[$k]['prezime'].' ('.$players[$k]['pozicija'].')</option>';
                                            }
                                        } ?>
                                </select>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Broj golova</span>
                                <input type="number" name="br_golova" class="form-control">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Broj asistencija</span>
                                <input type="number" name="br_asistencija" class="form-control">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Žuti kartoni</span>
                                <input type="number" name="zuti_karton" class="form-control">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">Crveni karton</span>
                                <input type="number" name="crveni_karton" class="form-control">
                            </div>
                            <br>
                            <button type="submit" class="form-control btn btn-primary">Sačuvaj</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="well">
                            <h4><i class="fa fa-soccer-ball-o"></i> Lista strijelaca</h4>
                            <?php

                    if (sizeof($stats->lista_strelaca())==0) {
                        echo 'Nema strelaca';
                    } else {
                        echo '<table class="table table-bordered table-hover">';
                        for ($i = 0; $i < sizeof($stats->lista_strelaca()); $i++) {
                            $stats_strijelci = $stats->lista_strelaca();
                            echo '<tr><td>'.($i+1).'</td><td>'.$stats_strijelci[$i]['stat_ime'].' '.$stats_strijelci[$i]['stat_prezime'].'</td><td>'.$stats_strijelci[$i]['br_golova'].'</td></tr>';
                        }
                        echo '</table>';
                    } ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well">
                            <h4><i class="fa fa-gift"></i> Lista asistenata</h4>
                            <?php

                    if (sizeof($stats->lista_asistenata())==0) {
                        echo 'Nema asistenata';
                    } else {
                        echo '<table class="table table-bordered table-hover">';
                        for ($j = 0; $j < sizeof($stats->lista_asistenata()); $j++) {
                            $stats_asistenti = $stats->lista_asistenata();
                            echo '<tr><td>'.($j+1).'</td><td>'.$stats_asistenti[$j]['stat_ime'].' '.$stats_asistenti[$j]['stat_prezime'].'</td><td>'.$stats_asistenti[$j]['br_asistencija'].'</td></tr>';
                        }
                        echo '</table>';
                    } ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="well">
                            <h4><i class="fa fa-soccer-ball-o"></i> Lista utakmica</h4>
                            <?php

                    if (sizeof($stats->lista_utakmica())==0) {
                        echo 'Nema utakmica';
                    } else {
                        echo '<table class="table table-bordered table-hover">';
                        for ($k = 0; $k < sizeof($stats->lista_utakmica()); $k++) {
                            $stats_utakmice= $stats->lista_utakmica();
                            echo '<tr><td>'.($k+1).'</td><td style="text-align:right;">'.$stats_utakmice[$k]['domaci_tim'].' ('.$stats_utakmice[$k]['stat_home'].')</td><td>('.$stats_utakmice[$k]['stat_guest'].') '.$stats_utakmice[$k]['gostujuci_tim'].'</td></tr>';
                        }
                        echo '</table>';
                    } ?>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>











    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bower_components/moment/min/moment-with-locales.min.js"></script>
    <script type="text/javascript"
        src="bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker({
                locale: 'sr'
            });
        });
    </script>

    </body>

    </html>

    <?php
} else {
                        header('Location: http://' . BASE_URL . '');
                    }
