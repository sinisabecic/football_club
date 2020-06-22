<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 12.6.2020.
 * Time: 19.25
 */
require '../../config.php';
require '../../model/TeamModel.php';
require '../../model/Player.php';
require '../../model/GameModel.php';
session_start();
$team = new TeamModel();
$player = new Player();
$game = new GameModel();

if($_POST['id_kola']!='' && $_POST['domacin_id']!='' && $_POST['gost_id']!='' && $_POST['datum']!=''){
    $datum = date('Y-m-d H:i:s',strtotime($_POST['datum']));
    $action = $game->new_game($_POST['id_kola'], $_POST['domacin_id'], $_POST['gost_id'], $datum);
    if($action === true){
        header('Location: http://'.BASE_URL.'/admin/games.php');
    } else {
        echo '<h1>Greska pri kreiranju nove utakmice.</h1>';
        var_dump($action);
    }
} else {
    echo '<h1>Greska pri kreiranju nove utakmice. Nedostaje neki parametar.</h1>';
}