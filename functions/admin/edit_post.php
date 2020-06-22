<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 12.6.2020.
 * Time: 20.43
 */
require '../../config.php';
require '../../model/BlogModel.php';
session_start();
$blog = new BlogModel();

$target_dir = "dist/img/uploads/";
$target_file = $target_dir . basename($_FILES['file']['name']);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES['file']['tmp_name']);

    if ($check !== false) {
        $uploadOk = 1;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], '../../'.$target_file)) {
            $txt = "Slika ". basename($_FILES["file"]["name"]). " je dodata.\n";
            $myfile = fopen("log.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $txt);
        } else {
            $myfile = fopen("error-log.txt", "w") or die("Unable to open file!");
            $txt = "Greška!";
            fwrite($myfile, $txt);
        }
        $myfile = fopen("log.txt", "w") or die("Unable to open file!");
        $txt = 'File is an image - ' . $check['mime'] . ".\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        if (isset($_POST['title']) && isset($_POST['blog_editor']) && isset($_SESSION['fk_id'])) {
            $data = $_POST['blog_editor'];
            $title = $_POST['title'];
            $user_id = $_SESSION['fk_id'];
            $post_id = $_POST['post_id'];
            $image = $target_file;
            $post = $blog->updatePost($post_id, $user_id, $data, $image, $title);

            if ($post) {
                header('Location: http://'.BASE_URL.'/pages/blog'); // treba staviti da prikazuje blog
            } else {
                var_dump($post);
            }
        } else {
            echo 'Neki parametar nije podesen: '.$_POST['title'].' '.$_POST['blog_editor'].' '.$_SESSION['fk_id'];
        }
    } else {
        $uploadOk = 0;
        $myfile = fopen("error-log.txt", "w") or die("Unable to open file!");
        $txt = 'Fajl nije slika!'."\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}
