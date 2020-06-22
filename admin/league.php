<?php
session_start();
require '../config.php';
require '../model/UserModel.php';
require '../model/SeasonModel.php';
require '../model/TeamModel.php';

$user = new UserModel();
$season = new SeasonModel();

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
                            <li class="active">Sezone</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="container">
                        <div class="well">
                            <h2 class="zuta">Nova sezona</h2>

                            <form action="functions/admin/new_season.php" class="form-inline" method="post">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label><i class="fa fa-calendar"></i> Početak sezone</label>
                                    </div>

                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">Godina</span>
                                            <input type="number" class="form-control" name="godina_pocetka">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label><i class="fa fa-calendar"></i> Kraj sezone</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">Godina</span>
                                            <input type="number" class="form-control" name="godina_kraja">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary pull-right">Nova sezona</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="container">
                        <div class="well">
                            <h2 class="zuta">Tekuća sezona</h2>
                            <div class="col-lg-6 col-lg-offset-3">
                                <?php
                                    $row = $season->get_current_season();
//                                    var_dump($row);
    $id = $row[0]['id'];
    $date_start = $row[0]['godina_pocetka'];
    $date_end = $row[0]['godina_svrsetka']; ?>
                                <form action="functions/admin/update_season.php" method="post" class="form text-center">
                                    <div class="text-center">
                                        <?php echo '<h3>'.$date_start.' - '.$date_end.'</h3>'; ?>
                                    </div>
                                    <input type="hidden" name="tekuca_id"
                                        value="<?php echo $id; ?>">
                                    <div class="input-group">
                                        <span class="input-group-addon">Šampion</span>
                                        <select name="tim" id="tim" class="form-control">
                                            <?php
                                                $team = new TeamModel();
    if (sizeof($team->fetchTeams())==0) {
        echo '<option>Nema timova!</option>';
    } else {
        for ($i = 0; $i < sizeof($team->fetchTeams()); $i++) {
            $teams = $team->fetchTeams();
            echo '<option value="'.$teams[$i]['id'].'">'.$teams[$i]['ime_tima'].'</option>';
        }
    } ?>
                                        </select>
                                    </div>
                                    <h4 class="text-center">Finalizuj sezonu!</h4>
                                    <button type="submit" class="btn btn-success">OK</button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="container">
                        <div class="well">
                            <h2 class="zuta">Prethodne sezone</h2>
                            <?php
                                if (sizeof($season->getPreviousSeasons())==0) {
                                    echo 'Nema prethodnih sezona!';
                                } else {
                                    echo '<table>';
                                    echo '<tr><th>Sezona:</th><th id="tim">Šampion:</th></tr>';
                                    for ($j = 0; $j < sizeof($season->getPreviousSeasons()); $j ++) {
                                        $seasons = $season->getPreviousSeasons();
                                        echo '<tr><td>'.$seasons[$j]['godina_pocetka'].' - '.$seasons[$j]['godina_svrsetka'].'</td><td id="tim">' .$seasons[$j]['ime_tima'].'</td></tr>';
                                    }
                                    echo '</table>';
                                } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/js/jquery.js"></script>
<script src="public/js/bootstrap.min.js"></script>

<style>
    #tim {
        padding-left: 20px;
    }
</style>
</body>

</html>

<?php
} else {
                                    header('Location: http://' . BASE_URL . '');
                                }
