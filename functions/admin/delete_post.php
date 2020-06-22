<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 20.02
 */
require '../../config.php';
require '../../model/BlogModel.php';
session_start();
$blog = new BlogModel();

$id = $_POST['post_id'];
$action_delete = $blog->deletePost($id);

if ($action_delete) {
    echo json_encode(array("success"=>"Uspjesno obrisano"));
} else {
    echo json_encode(array("error"=>"Greska"));
}
