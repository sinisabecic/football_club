<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 19.6.2020.
 * Time: 01.30
 */
require '../../config.php';
require '../../model/CommentsModel.php';
session_start();

$comment = new CommentsModel();

$comment_id = $_POST['comment_id'];

if (isset($comment_id)) {
    $result = $comment->delete_comment($comment_id);
} else {
    $result = array('error' => 'Greška');

    echo json_encode($result);
}
