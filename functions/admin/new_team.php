<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 16.41
 */
require '../../config.php';
require '../../model/TeamModel.php';
require '../../model/Player.php';
session_start();
$team = new TeamModel();
$player = new Player();

if(($_POST['ime_tima'])!='' && ($_POST['dan'])!='' && ($_POST['mjesec'])!='' && ($_POST['godina'])!=''){
    $datum_osnivanja = $_POST['dan'].'.'.$_POST['mjesec'].'.'.$_POST['godina'];
    $naziv_tima = $_POST['ime_tima'];
    $action = $team->new_team($naziv_tima, $datum_osnivanja);

    if($action){
        header('Location: http://'.BASE_URL.'/admin/teams.php');
    } else {
        echo '<h1>Greska u kreiranju novog tima!</h1>';
    }
} else {
    echo '<h1>Greska u kreiranju novog tima! Nedostaje neki parametar!</h1>';
}