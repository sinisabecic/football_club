<?php
session_start();
require '../config.php';
require '../model/UserModel.php';
require '../model/Player.php';

$user = new UserModel();
$player = new Player();

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    if (mysqli_connect_errno()) {
        echo 'Greska u povezivanju na bazu podataka';
        exit;
    }
        if ($user->is_admin($_SESSION['fk_id']) == 1) {
            ?>

<?php require('header.php'); ?>

<?php require('navigation.php') ?>


<div class="container" style="margin-top:115px">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Izmjena igrača</h4>
            </div>
            <div class="modal-body">
                <?php

                // Ovo sam radio postupno na primitivan nacin kako bi se dobio konkretni korisnik za izmjenu
                if (isset($_GET['id'])) {
                    $player_id = $_GET['id'];
                }

            $query = "SELECT * FROM fudbaler f 
                        inner join tim t on t.id=f.tim_id
                        WHERE f.id=$player_id ";
            $select = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select)) {
                $id = $row['id'];
                $ime = $row['ime'];
                $prezime = $row['prezime'];
                $datum_rodjenja = $row['datum_rodjenja'];
                $pozicija = $row['pozicija'];
                $broj_dresa = $row['broj_dresa'];
                $tim_id = $row['tim_id'];
                $ime_tima = $row['ime_tima']; ?>

                <form action="functions/player/edit-player.php" method="post">

                    <input type="hidden" name="id" class="form-control"
                        value="<?php echo $player_id; ?>">

                    <div class="input-group">
                        <span class="input-group-addon"> Ime</span>
                        <input type="text" name="ime" class="form-control"
                            value="<?php echo $ime; ?>">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i> Prezime</span>
                        <input type="text" name="prezime" class="form-control"
                            value="<?php echo $prezime; ?>">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i> Datum rođenja</span>
                        <input type="text" name="datum_rodjenja" class="form-control"
                            value="<?php echo $datum_rodjenja; ?>">
                    </div>

                    <br>

                    <div class="input-group">
                        <span class="input-group-addon">Pozicija u timu</span>
                        <select name="pozicija" id="pozicija" class="form-control">
                            <option value="<?php echo $pozicija; ?>">
                                <?php echo $pozicija; ?>
                            </option>
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
                        <span class="input-group-addon"><i class="fa fa-key"></i> Broj dresa</span>
                        <input type="text" name="broj_dresa" class="form-control"
                            value="<?php echo $broj_dresa; ?>">
                    </div>
                    <br>

                    <input type="hidden" name="tim_id" class="form-control"
                        value="<?php echo $tim_id; ?>">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i> Naziv tima</span>
                        <input type="text" class="form-control"
                            value="<?php echo $ime_tima; ?>"
                            disabled>
                    </div>

                    <br>
                    <button type="submit" class="form-control btn btn-primary" name="submit" id="submit">Sačuvaj
                        izmjene</button>
                    <br>
                    <br>
                    <a href="/admin/list_users.php">
                        <button class="form-control btn btn-info w-700">Odustani
                        </button></a>
                </form>
                <?php
            } ?>
            </div>

        </div>




        <script src="public/js/jquery.js"></script>
        <script src="public/js/bootstrap.min.js"></script>
        <script src="bower_components/wysihtml5x/dist/wysihtml5x-toolbar.min.js"></script>
        <script src="bower_components/handlebars/handlebars.min.js"></script>
        <script src="bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.js"></script>



        </body>

        </html>

        <?php
        } else {
            header('Location: http://' . BASE_URL . '');
        }
