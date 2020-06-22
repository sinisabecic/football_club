<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 12.08
 */
require '../../config.php';
require '../../model/UserModel.php';

$user = new UserModel();

session_start();

$id = $_POST['id'];
$username = $_POST['edit_username'];
$email = $_POST['edit_email'];
$password = $_POST['edit_password'];
$admin = $_POST['edit_admin'];

if (isset($_POST['edit_admin'])) {
    $admin = "1";
} else {
    $admin = "0";
}


if ($username!='' && $email!='' && $password!='' && $admin!='') {
    $change_all = $user->change_all($id, $username, $email, $password, $admin);

    if ($change_all) {
        header('Location: http://'.BASE_URL.'/admin/list_users.php');
    } else {
        header('Location: http://'.BASE_URL.'/pages/register/error');
    }
} else {
    header('Location: http://'.BASE_URL.'/pages/register/error');
}
