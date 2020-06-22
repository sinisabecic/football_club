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

?>

<?php  if (!isset($_SESSION['fk_id'])) {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FK | Prijava korisnika</title>
    <base href="../../">
    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" href="dist/img/logo.svg">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/bootswatch/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/jquery.toast.css">


</head>

<body>

    <?php require_once '../../partials/navigation.php'; ?>


    <div class="container" style="margin-top:95px">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="well bs-component bg-siva2 animate__animated animate__fadeInDown">
                    <form class="form-horizontal" action="functions/user/login.php" method="post">
                        <fieldset>
                            <legend class="bordo">Prijava</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label siva2">Korisničko
                                    ime</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputEmail" name="emailusername"
                                        placeholder="Korisničko ime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label siva2">Lozinka</label>
                                <div class="col-lg-10 input">
                                    <input type="password" class="form-control" id="inputPassword" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-default">Odustani</button>
                                    <button type="submit" class="btn btn-primary">Prijava</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php   require('../../partials/footer.php'); ?>

    <script>
        $('form').validate({
            rules: {
                emailusername: {
                    minlength: 3,
                    maxlength: 15,
                    required: true
                },
                password: {
                    minlength: 3,
                    maxlength: 15,
                    required: true
                }
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>


</body>

</html>

<?php     # code...
} else {
    header('Location: http://'.BASE_URL.'/pages/login/error');
}
