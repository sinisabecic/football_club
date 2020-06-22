<?php
/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 11.6.2020.
 * Time: 22.16
 */
require '../../config.php';
$comment_id = $_POST['comments_id'];
require '../../model/CommentsModel.php';

$comment = new CommentsModel();
$akcija = $comment->setOdobren($comment_id);
if($akcija){
    header('Location: http://'.BASE_URL.'/admin/comments.php');
}
