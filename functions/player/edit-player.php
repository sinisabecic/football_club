<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 11.6.2020.
 * Time: 12.08
 */
require '../../config.php';
require '../../model/UserModel.php';
require '../../model/Player.php';

$user = new UserModel();
$player = new Player();

session_start();

$id = $_POST['id'];
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$datum_rodjenja = $_POST['datum_rodjenja'];
$pozicija = $_POST['pozicija'];
$broj_dresa = $_POST['broj_dresa'];
$tim_id = $_POST['tim_id'];

// if (isset($_POST['edit_admin'])) {
//     $admin = "1";
// } else {
//     $admin = "0";
// }


if ($ime!='' && $prezime!='' && $datum_rodjenja!='' && $pozicija!='' && $broj_dresa!='' && $tim_id!='') {
    $update = $player->change_all($id, $ime, $prezime, $datum_rodjenja, $pozicija, $broj_dresa, $tim_id);

    if ($update) {
        header('Location: http://'.BASE_URL.'/admin/players.php');
    } else {
        header('Location: http://'.BASE_URL.'/pages/register/error');
    }
} else {
    header('Location: http://'.BASE_URL.'/pages/register/error');
}
