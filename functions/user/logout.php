<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 11.6.2020.
 * Time: 12.15
 */
require '../../config.php';
require '../../model/UserModel.php';
$user = new UserModel();

session_start();

$action = $user->logout();

if ($action) {
    header('Location: http://'.BASE_URL);
}
