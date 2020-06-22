<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 19.6.2020.
 * Time: 01.30
 */
require '../../config.php';
require '../../model/Player.php';
session_start();
$player = new Player();

$player_id = $_POST['player_id'];

if (isset($player_id)) {
    $result = $player->delete_player($player_id);
} else {
    $result = array('error'=>'Error deleting user.');

    echo json_encode($result);
}
