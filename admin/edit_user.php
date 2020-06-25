<?php
session_start();
require '../config.php';
require '../model/UserModel.php';

$user = new UserModel();

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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Izmjena korisnika</h4>
            </div>
            <div class="modal-body">
                <?php

                // Ovo sam radio postupno na primitivan nacin kako bi se dobio konkretni korisnik za izmjenu
                if (isset($_GET['id'])) {
                    $user_id = $_GET['id'];
                }

            $query = "SELECT * FROM userspass WHERE id='$user_id' ";
            $select = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select)) {
                $id = $row['id'];
                $user = $row['username'];
                $email = $row['email'];
                $pass = $row['password'];
                $is_admin = $row['is_admin']; ?>

                <form action="functions/user/edit-user.php" method="post">
                    <div class="input-group">
                        <span class="input-group-addon" for="">ID (MongoDB ID): </span>
                        <span class="input-group-addon"> <?php echo $id; ?></span>
                        <input type="hidden" name="id" class="form-control"
                            value="<?php echo $id; ?>">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon">Novo korisničko ime</span>
                        <input type="text" name="edit_username" class="form-control"
                            value="<?php echo $user; ?>">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i>Novi e-mail</span>
                        <input type="text" name="edit_email" class="form-control"
                            value="<?php echo $email; ?>">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i>Nova šifra</span>
                        <input type="password" name="edit_password" class="form-control"
                            value="<?php echo $pass; ?>">
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input name="edit_admin" type="checkbox" aria-label="Checkbox for following text input"
                                    <?php echo($is_admin == 1 ? 'checked' : ''); ?>>
                                <span> Admin</span><br><br>
                            </div>
                        </div>
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
