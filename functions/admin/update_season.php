<?php

require '../../config.php';
require '../../model/SeasonModel.php';
session_start();
$season = new SeasonModel();

if (isset($_POST['tekuca_id']) && isset($_POST['tim'])) {
    $action = $season->update_season($_POST['tekuca_id'], $_POST['tim']);

    if ($action) {
        header('Location: http://'.BASE_URL.'/admin/league.php');
    } else {
        echo '<h1>Neuspjesna finalizacija sezone.</h1>';
    }
} else {
    echo '<h1>Neuspjesna finalizacija sezone. Nedostaju parametri.</h1>';
}
