<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 12.6.2020.
 * Time: 22.44
 */

require '../../config.php';
require '../../model/GameModel.php';
session_start();
$game = new GameModel();

if($_POST['game_id']!='' && $_POST['home_team']!='' && $_POST['guest_team']!=''){
    $action = $game->update_game($_POST['game_id'], $_POST['home_team'], $_POST['guest_team']);

    if($action){
        header('Location: http://'.BASE_URL.'/admin/statistics.php');
    } else {
        echo '<h1>Greska u unosu rezultata za utakmicu.</h1>';
    }
} else {
    echo '<h1>Greska u unosu rezultata za utakmicu. Nedostaju neki parametri.</h1>';
}