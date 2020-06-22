<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 11.6.2020.
 * Time: 12.08
 */
require '../../config.php';
require '../../model/UserModel.php';

$user = new UserModel();

session_start();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if($username!='' && $email!='' && $password!=''){
    $register = $user->register($username, $email, $password);
    
    if($register){
        header('Location: http://'.BASE_URL.'/admin/users.php');    
    }
    else {
        header('Location: http://'.BASE_URL.'/pages/register/error');
    }
} else {
    header('Location: http://'.BASE_URL.'/pages/register/error');
}