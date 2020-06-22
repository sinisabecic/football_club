<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
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

    <title>Greška u prijavljivanju | Prijava korisnika</title>
    <base href="../../../">
    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" href="dist/img/logo.svg">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/bootswatch/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/jquery.toast.css">
    </base>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />

</head>

<body>

    <?php require_once '../../../partials/navigation.php'; ?>


    <div class="container" style="margin-top:95px">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="well bs-component bg-siva2 animate__animated animate__shakeX">
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



    <?php   require('../../../partials/footer.php'); ?>

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

    <script>
        $.toast({

            heading: 'Greška u prijavljivanju!', // Optional heading to be shown on the toast
            text: "Pokušajte ponovo.",
            icon: 'warning', // Type of toast icon
            showHideTransition: 'slide', // fade, slide or plain
            allowToastClose: true, // Boolean value true or false
            hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
            position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



            textAlign: 'left', // Text alignment i.e. left, right or center
            loader: false, // Whether to show loader or not. True by default
            loaderBg: '#9EC600', // Background color of the toast loader
            beforeShow: function() {}, // will be triggered before the toast is shown
            afterShown: function() {}, // will be triggered after the toat has been shown
            beforeHide: function() {}, // will be triggered before the toast gets hidden
            afterHidden: function() {} // will be triggered after the toast has been hidden
        });
    </script>


</body>

</html>