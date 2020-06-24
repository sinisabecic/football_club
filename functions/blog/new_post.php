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

// targer_dir je direktorijum kojem se pristupa preko front-enda, i a putanju do njega upisujemo u bazu (sa imenom fajla - target_dir + basename)

if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES['file']['tmp_name']);

    if ($check !== false) {
        $uploadOk = 1;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], '../../'.$target_file)) {
            $txt = "The file ". basename($_FILES["file"]["name"]). " has been uploaded.\n";
            $myfile = fopen("log.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $txt);
        } else {
            $myfile = fopen("error-log.txt", "w") or die("Unable to open file!");
            $txt = "Sorry, there was an error uploading your file.";
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
            $image = $target_file;
            
            // Ovo sam koristio za provjeru
            // echo 'ID Korisnika '. $user_id. ' <br/>';
            // echo 'Naslov '. $title. ' <br/>';
            // echo 'Tekst '. $data. ' <br/>';
            // echo 'Slika '. $image. ' <br/>';

            // upisujemo blog u bazu, pozivamo funkciju newPost iz modela, tj. klase Blog
            $post = $blog->newPost($data, $user_id, $image, $title);
            if ($post) {
                header('Location: http://'.BASE_URL.'/pages/blog'); // treba staviti da prikazuje blog
            }
        }
    } else {
        $uploadOk = 0;
        $myfile = fopen("error-log.txt", "w") or die("Unable to open file!");
        $txt = 'File is not an image!'."\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}
