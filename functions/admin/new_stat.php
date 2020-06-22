<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 19.6.2020.
 * Time: 00.52
 */

require '../../config.php';
require '../../model/TeamModel.php';
require '../../model/Player.php';
require '../../model/StatisticsModel.php';
session_start();
$team = new TeamModel();
$player = new Player();
$stat = new StatisticsModel();

if($_POST['utakmica_id']!='' && $_POST['fudbaler_id']!='' && $_POST['br_golova']!='' && $_POST['br_asistencija']!='' && $_POST['zuti_karton']!='' && $_POST['crveni_karton']!=''){
    $action = $stat->new_entry($_POST['utakmica_id'], $_POST['fudbaler_id'], $_POST['br_golova'], $_POST['br_asistencija'], $_POST['zuti_karton'], $_POST['crveni_karton']);

    if($action){
        header('Location: http://'.BASE_URL.'/admin/statistics.php');
    } else {
        echo '<h1>Greska prilikom unosenja podataka za utakmicu i igraca.</h1>';
    }
} else {
    echo '<h1>Greska prilikom unosenja podataka za utakmicu i igraca. Nedostaju parametri.</h1>';
}