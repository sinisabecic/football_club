<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 17.00
 */
require '../../config.php';
require '../../model/TeamModel.php';
session_start();
$team = new TeamModel();

$id = $_POST['team_id'];

if (isset($id)) {
    $result = $team->delete_team($id);
    echo json_encode(array("success"=>"Uspješno"));
} else {
    echo json_encode(array("error"=>"Greška"));
}
