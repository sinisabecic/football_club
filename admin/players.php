<style>
    td {
        background: #556271;
        color: #fff;
        vertical-align: middle;
    }

    label {
        color: #fff;
        font-weight: 600;
    }
</style>
<?php
session_start();
require '../config.php';
require '../model/UserModel.php';
require '../model/SeasonModel.php';
require '../model/TeamModel.php';
require '../model/Player.php';

$user = new UserModel();
$season = new SeasonModel();
$player =  new Player();

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
                            <li class="active">Igrači</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 text-center">
                            <h3>Novi igrač</h3>
                            <form action="functions/admin/new_player.php" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon">Ime</span>
                                    <input type="text" name="ime" class="form-control">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Prezime</span>
                                    <input type="text" name="prezime" class="form-control">
                                </div>
                                <br>
                                <div>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i> Datum
                                        rođenja</span>
                                    <input type="number" name="dan" class="form-control-static" placeholder="DD (dan)">
                                    - <input type="number" name="mjesec" class="form-control-static"
                                        placeholder="MM (mjesec)"> - <input type="number" name="godina"
                                        class="form-control-static" placeholder="GGGG (godina)">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Pozicija u timu</span>
                                    <select name="pozicija" id="pozicija" class="form-control">
                                        <option value="">Izaberi poziciju</option>
                                        <option value="gk">GK (golman)</option>
                                        <option value="sw">SW (libero)</option>
                                        <option value="cb">CB (centralni bek)</option>
                                        <option value="lb">LB (lijevi bek)</option>
                                        <option value="db">DB (desni bek)</option>
                                        <option value="dmf">DMF (defanzivni vezni)</option>
                                        <option value="cmf">CMF (centralni vezni)</option>
                                        <option value="rmf">RMF (desni vezni)</option>
                                        <option value="lmf">LMF (lijevi vezni)</option>
                                        <option value="amf">AMF (ofanzivni vezni)</option>
                                        <option value="lwf">LWF (lijevo krilo)</option>
                                        <option value="rwf">RWF (desno krilo)</option>
                                        <option value="ss">SS (drugi napadač)</option>
                                        <option value="cf">CF (centarfor)</option>
                                    </select>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Broj dresa</span>
                                    <input type="number" class="form-control" name="br_dresa">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Tim</span>
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
                                <br>
                                <button type="submit" class="btn btn-primary">Sačuvaj</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- end row -->


        <div class="row">
            <div class="col-xs-12">
                <table id="datatable" class="table table-hover bg-danger">
                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Datum rodjenja</th>
                            <th>Pozicija</th>
                            <th>Broj dresa</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <?php
            if (sizeof($player->fetch_players()) == 0) {
            } else {
                for ($i = 0; $i<sizeof($player->fetch_players()); $i++) {
                    $players = $player->fetch_players();
                    echo '<tr><td>'.$players[$i]['ime'].'</td><td>'.$players[$i]['prezime'].'</td>
                        <td>'.$players[$i]['datum_rodjenja'].'</td>
                        <td>'.$players[$i]['pozicija'].'</td>
                        <td>'.$players[$i]['broj_dresa'].'</td>                        
                        <td>
                        <button class="btn btn-primary btn-xs" 
                        onclick="deletePlayer('.$players[$i]['id'].')">Ukloni</button>
                        <a href="/admin/edit_player.php?id='.$players[$i]['id'].'" class="bijela">
                        <button class="btn bg-plava w-700 btn-xs">Izmijeni</button></td></tr>
                        </a>';
                }
            } ?>
                </table>
            </div>
        </div>
    </div>

    <script src="public/js/jquery.js"></script>


    <script src="public/js/jquery.toast.js"></script>
    <script src="public/js/jquery.validate.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src=" https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

    <script src="bower_components/wysihtml5x/dist/wysihtml5x-toolbar.min.js"></script>
    <script src="bower_components/handlebars/handlebars.min.js"></script>
    <script src="bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>


    <script>
        function deletePlayer(item) {
            if (confirm('Da li ste sigurni?')) {
                var formData = {
                    'player_id': item
                };
                $.ajax({
                    type: 'POST',
                    url: 'functions/player/delete-player.php',
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
