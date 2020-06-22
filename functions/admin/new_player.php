<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 16.16
 */
require '../../config.php';
require '../../model/TeamModel.php';
require '../../model/Player.php';
session_start();
$team = new TeamModel();
$player = new Player();

if(($_POST['ime'])!='' && ($_POST['prezime'])!='' && ($_POST['dan'])!='' && ($_POST['mjesec'])!='' && ($_POST['godina'])!='' && ($_POST['pozicija'])!='' && ($_POST['br_dresa'])!='' && ($_POST['tim'])!=''){
    $datum_rodjenja = $_POST['dan'].'.'.$_POST['mjesec'].'.'.$_POST['godina'];
    $action = $player->new_player($_POST['ime'], $_POST['prezime'], $datum_rodjenja, $_POST['pozicija'], $_POST['br_dresa'], $_POST['tim']);

    if($action){
        header('Location: http://'.BASE_URL.'/admin/players.php');
    } else {
        echo '<h1>Neuspješno kreiranje igrača!</h1>';
    }
} else {
    echo '<h1>Neuspješno kreiranje igrača! Nedostaje neki parametar.</h1>';
}