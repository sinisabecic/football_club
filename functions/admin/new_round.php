<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 18.39
 */

require '../../config.php';
require '../../model/RoundModel.php';
session_start();
$round = new RoundModel();

if($_POST['id_prvenstva']!='' && $_POST['broj_kola']!=''){
    $action = $round->new_round($_POST['broj_kola'], $_POST['id_prvenstva']);

    if($action){
        header('Location: http://'.BASE_URL.'/admin/rounds.php');
    } else {
        echo '<h1>Greska u pri kreiranju novog kola.</h1>';
    }
} else {
    echo '<h1>Greska u pri kreiranju novog kola. Niste unijeli neki parametar!</h1>';
}