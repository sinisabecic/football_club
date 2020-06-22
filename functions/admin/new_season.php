<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 14.51
 */

require '../../config.php';
require '../../model/SeasonModel.php';
session_start();
$season = new SeasonModel();

if(isset($_POST['godina_pocetka']) && isset($_POST['godina_kraja'])){

    $date_start = $_POST['godina_pocetka'];
    $date_end = $_POST['godina_kraja'];

    $action = $season->create_new($date_start, $date_end);

    if($action){
        header('Location: http://'.BASE_URL.'/admin/league.php');
    } else {
        echo 'Greska u kreiranju nove sezone.<br>';
        echo $date_start.'<br>';
        echo $date_end;
    }
}