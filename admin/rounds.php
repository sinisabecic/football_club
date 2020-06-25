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
require '../model/RoundModel.php';

$user = new UserModel();
$season = new SeasonModel();
$round = new RoundModel();

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
                            <li class="active">Kola</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <h3>Novo kolo</h3>
                            <form action="functions/admin/new_round.php" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon">Broj kola</span>
                                    <input type="number" class="form-control" name="broj_kola">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Prvenstvo</span>
                                    <select name="id_prvenstva" id="id_prvenstva" class="form-control">
                                        <?php
                                            if (sizeof($season->get_all_seasons()) == 0) {
                                                echo '<option>Nema sezona za odabir.</option>';
                                            } else {
                                                for ($i = 0; $i < sizeof($season->get_all_seasons()); $i++) {
                                                    $seasons = $season->get_all_seasons();

                                                    echo '<option value="'.$seasons[$i]['id'].'">'.$seasons[$i]['godina_pocetka'].' - '.$seasons[$i]['godina_svrsetka'].'</option>';
                                                }
                                            } ?>
                                    </select>
                                </div>
                                <br>
                                <input type="submit" class="form-control btn btn-primary" value="Sačuvaj">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- /.col-lg-12 -->
            <div class="col-lg-12">
                <div class="well">
                    <h3 data-toggle="collapse">Lista kola
                    </h3>
                    <table id="datatable" class="table table-hover bg-danger">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Broj kola</th>
                                <th>Sezona</th>
                                <th>Akcija</th>
                            </tr>
                        </thead>
                        <?php
            if (sizeof($round->get_all_rounds()) == 0) {
                echo '<div class="alert alert-danger">';
                echo 'Nema utakmica.';
                echo '</div>';
            } else {
                for ($i = 0; $i < sizeof($round->get_all_rounds()); $i++) {
                    $rounds = $round->get_all_rounds();
                    $k_id = $rounds[$i]['k_id'];
                    $broj_kola = $rounds[$i]['broj_kola'];
                    $godina_pocetka = $rounds[$i]['godina_pocetka'];
                    $godina_svrsetka = $rounds[$i]['godina_svrsetka'];

                    echo '<tr>
                        <td>'.$k_id.'</td>
                        <td>'.$broj_kola.'</td>
                        <td>'.$godina_pocetka.' - '.$godina_svrsetka.'</td>                                        
                        <td>
                        <button class="btn btn-primary btn-xs"
                        onclick="deleteRound('.$k_id.')">Ukloni</button></td></tr>'; ?>

                        <?php
                }
            } ?>
                    </table>

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
        function deleteRound(item) {
            if (confirm('Da li ste sigurni?')) {
                var formData = {
                    'round_id': item
                };
                $.ajax({
                    type: 'POST',
                    url: 'functions/round/delete_round.php',
                    data: formData,
                    success: function(response) {
                        if (response.error) {
                            console.log(response.error);
                            alert(response.error);

                        } else { // Ako je uspjesno izbrisano
                            console.log(response.success);
                            window.location.reload(true);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Greška u brisanju kola.");
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
