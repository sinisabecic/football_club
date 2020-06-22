<?php


require '../../config.php';
require '../../model/UserModel.php';
$user = new UserModel();

session_start();

$email_username = $_POST['emailusername'];
$password = $_POST['password'];

if ($email_username!='' && $password!='') {
    $login = $user->login($email_username, $password);

    if ($login) {
        header('Location: http://'.BASE_URL.'/pages/login/success');
    } else {
        header('Location: http://'.BASE_URL.'/pages/login/error');
    }
} else {
    header('Location: http://'.BASE_URL.'/pages/login/error');
}
