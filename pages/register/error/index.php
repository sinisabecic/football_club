<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 11.02
 */
require '../../../config.php';
session_start();
require '../../../model/UserModel.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FK | Registracija korisnika</title>
    <base href="../../../">
    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" href="dist/img/logo.svg">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/bootswatch/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/default.css">

</head>

<body>

    <?php require_once '../../../partials/navigation.php'; ?>

    <div class="page-holder">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="well bs-component">
                        <h3>Greška prilikom registracije!</h3>
                        <a href="pages/register" class="form-control btn btn-primary">Pokušajte ponovo!</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
</body>

</html>