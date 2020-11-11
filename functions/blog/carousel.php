<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 19.6.2020.
 * Time: 08.19
 */
require '../../config.php';
require '../../model/BlogModel.php';

$carousel = new BlogModel();

$carousel_list = $carousel->getLastThree();
if ($carousel_list) {
    echo json_encode($carousel_list);
}
