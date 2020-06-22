<?php
session_start();
require '../config.php';
require '../model/UserModel.php';
require '../model/SeasonModel.php';
require '../model/TeamModel.php';
require '../model/RoundModel.php';

$user = new UserModel();
$season = new SeasonModel();
$round = new RoundModel();
$team = new TeamModel();

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
                            <li class="active">Games</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <h3>Nova utakmica</h3>
                            <form action="functions/admin/new_game.php" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon">Kolo</span>
                                    <select name="id_kola" id="id_kola" class="form-control">
                                        <?php
                                            if (sizeof($round->get_all_rounds()) == 0) {
                                                echo '<option>Nema dostupnih rundi</option>';
                                            } else {
                                                for ($i = 0; $i < sizeof($round->get_all_rounds()); $i++) {
                                                    $rounds = $round->get_all_rounds();
                                                    echo '<option value="' . $rounds[$i]['id'] . '">' . $rounds[$i]['broj_kola'] . '</option>';
                                                }
                                            } ?>
                                    </select>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Domaćin</span>
                                    <select name="domacin_id" id="domacin_id" class="form-control">
                                        <?php
                                            if (sizeof($team->fetchTeams()) == 0) {
                                                echo '<option>Nema dostupnih timova</option>';
                                            } else {
                                                for ($j = 0; $j < sizeof($team->fetchTeams()); $j++) {
                                                    $teams = $team->fetchTeams();
                                                    echo '<option value="' . $teams[$j]['id'] . '">' . $teams[$j]['ime_tima'] . '</option>';
                                                }
                                            } ?>
                                    </select>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Gost</span>
                                    <select name="gost_id" id="gost_id" class="form-control">
                                        <?php
                                            if (sizeof($team->fetchTeams()) == 0) {
                                                echo '<option>Nema dostupnih timova</option>';
                                            } else {
                                                for ($k = 0; $k < sizeof($team->fetchTeams()); $k++) {
                                                    $teams = $team->fetchTeams();
                                                    echo '<option value="' . $teams[$k]['id'] . '">' . $teams[$k]['ime_tima'] . '</option>';
                                                }
                                            } ?>
                                    </select>
                                </div>
                                <br>
                                <div>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' name="datum" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <input type="submit" class="form-control btn btn-primary">
                            </form>
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
