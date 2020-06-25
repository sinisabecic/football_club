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

$user = new UserModel();
$season = new SeasonModel();
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
                            <li class="active">Timovi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 text-center">
                            <h3>Novi tim</h3>
                            <form action="functions/admin/new_team.php" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon">Ime kluba</span>
                                    <input type="text" name="ime_tima" class="form-control" placeholder="Ime tima">
                                </div>
                                <br>
                                <div>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i> Datum
                                        osnivanja</span>
                                    <input type="number" class="form-control-static" name="dan" placeholder="DD (dan)">
                                    - <input type="number" class="form-control-static" name="mjesec"
                                        placeholder="MM (mjesec)"> - <input type="number" class="form-control-static"
                                        name="godina" placeholder="GGGG (godina)">
                                </div>
                                <br>
                                <input type="submit" value="Sačuvaj" class="form-control btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <h3>Timovi</h3>

                            <table id="datatable" class="table table-hover bg-danger">
                                <thead>
                                    <tr>
                                        <th>ID Tima</th>
                                        <th>Ime tima</th>
                                        <th>Osnovan</th>
                                        <th>Ukloni</th>
                                    </tr>
                                </thead>
                                <?php  for ($i = 0; $i < sizeof($team->fetchTeams()); $i++) {
        $teams = $team->fetchTeams();
        echo '<tr>
        <td>'.$teams[$i]['id'].'</td>
        <td>'.$teams[$i]['ime_tima'].'</td>
        <td>'.$teams[$i]['osnovan'].'</td>
        <td><button class="btn btn-warning btn-sm" onclick="delTeam('.$teams[$i]['id'].')">
        <i class="fa fa-trash-o"></i></button>
        </td></tr>';
    } ?>
                        </div>
                    </div>
                </div>
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
        function delTeam(item) {
            if (confirm('Da li ste sigurni?')) {
                var formData = {
                    'team_id': item
                };
                $.ajax({
                    type: 'POST',
                    url: 'functions/team/delete_team.php',
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
