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

// $user_id = $_POST['user_id'];
// $post_id = $_POST['post_id'];
// $timestamp = $_POST['timestamp'];
// $content = $_POST['content'];
// $parent = $_POST['parent'];

// $new_comment = $comment->newComment($user_id, $post_id, $content, $timestamp, $parent);

// if ($new_comment) {
//     echo json_encode(array("success"=>"success"));
// } else {
//     echo json_encode(array("error"=>"error!"));
// }


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    if (mysqli_connect_errno()) {
        echo 'Greska u povezivanju na bazu podataka';
        exit;
    }


if (isset($_POST['submit_comment'])) {
    $user_id = $_POST['user_id'];
    $blog_id = $_POST['blog_id'];
    $timestamp = $_POST['timestamp'];
    $content = $_POST['content'];
    $parent = $_POST['parent_id'];

    // echo 'Korisnik ID ' .$user_id .' ';
    // echo 'Post ID ' .$post_id.' ';
    // echo 'Datum postavljanja ' .$timestamp.' ';
    // echo 'Sadrzaj ' .$content.' ';
    // echo 'Parent ' .$parent.' ';

    $string = "INSERT INTO blog_comments(id, user_id, blog_id, content, timestamp, parent, odobren)
    VALUES (NULL,
            (SELECT userspass.id FROM userspass WHERE userspass.id='$user_id'),
            (SELECT blog.b_id FROM blog WHERE blog.b_id='$blog_id'),
            '$content', NOW(), '$parent', 0)";

    $result = mysqli_query($conn, $string);

    if ($result) {
        header('Location: http://'.BASE_URL.'/pages/blog');
    }
}
