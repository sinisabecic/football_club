<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 15.38
 */
require '../../config.php';
require '../../model/CommentsModel.php';
session_start();

$comment = new CommentsModel();

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];
$timestamp = $_POST['timestamp'];
$content = $_POST['content'];
$parent = $_POST['parent'];

$new_comment = $comment->newComment($user_id, $post_id, $content, $timestamp, $parent);

if ($new_comment) {
    echo json_encode(array("success"=>"success"));
} else {
    echo json_encode(array("error"=>"error!"));
}
