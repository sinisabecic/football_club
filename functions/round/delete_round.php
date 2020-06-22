<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 19.6.2020.
 * Time: 01.30
 */
require '../../config.php';
require '../../model/RoundModel.php';
session_start();
$round = new RoundModel();

$id = $_POST['round_id'];
$result = $round->delete_round($id);

if ($result) {
    echo json_encode(array("success"=>"Successfully deleted item"));
} else {
    echo json_encode(array("error"=>"Error deleting item"));
}
