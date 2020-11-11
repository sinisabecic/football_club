<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 19.6.2020.
 * Time: 01.30
 */
require '../../config.php';
require '../../model/UserModel.php';
session_start();
$user = new UserModel();

$user_id = $_POST['user_id'];

if (isset($user_id)) {
    $result = $user->delete_user($user_id);
} else {
    $result = array('error' => 'Error deleting user.');
    echo json_encode($result);
}
