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

// $target_dir = "dist/img/uploads/";
// $target_file = $target_dir . basename($_FILES['file']['name']);
// $uploadOk = 1;
// $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

// targer_dir je direktorijum kojem se pristupa preko front-enda, i a putanju do njega upisujemo u bazu (sa imenom fajla - target_dir + basename)

// if (isset($_POST['submit'])) {
//     $check = getimagesize($_FILES['file']['tmp_name']);

//     if ($check !== false) {
//         $uploadOk = 1;
//         if (move_uploaded_file($_FILES["file"]["tmp_name"], '../../'.$target_file)) {
//             $txt = "The file ". basename($_FILES["file"]["name"]). " has been uploaded.\n";
//             $myfile = fopen("log.txt", "w") or die("Unable to open file!");
//             fwrite($myfile, $txt);
//         } else {
//             $myfile = fopen("error-log.txt", "w") or die("Unable to open file!");
//             $txt = "Sorry, there was an error uploading your file.";
//             fwrite($myfile, $txt);
//         }
//         $myfile = fopen("log.txt", "w") or die("Unable to open file!");
//         $txt = 'File is an image - ' . $check['mime'] . ".\n";
//         fwrite($myfile, $txt);
//         fclose($myfile);
//         // if (isset($_POST['title']) && isset($_POST['blog_editor']) && isset($_SESSION['fk_id'])) {
//         $data = $_POST['blog_editor'];
//         $title = $_POST['title'];
//         $post_id = $_POST['post_id'];
//         $user_id = $_SESSION['fk_id'];
//         $image = $target_file;
            
//         $post = $blog->updatePost($post_id, $user_id, $data, $image, $title);
           
//         // Ovo sam koristio za provjeru
//         // echo '<strong>ID Korisnika:</strong> '. $user_id. ' <br/>';
//         // echo '<strong>Naslov:</strong> '. $title. ' <br/>';
//         // echo '<strong>Tekst:</strong> '. $data. ' <br/>';
//         // echo '<strong>Slika:</strong> '. $image. ' <br/>';
//         // echo '<strong>Post ID:</strong> '. $post_id. ' <br/>';
        
//         // upisujemo blog u bazu, pozivamo funkciju newPost iz modela, tj. klase Blog
//         if ($post) {
//             header('Location: http://'.BASE_URL.'/pages/blog'); // treba staviti da prikazuje blog
//         }
//     }
//     // } else {
//     //     $uploadOk = 0;
//     //     $myfile = fopen("error-log.txt", "w") or die("Unable to open file!");
//     //     $txt = 'File is not an image!'."\n";
//     //     fwrite($myfile, $txt);
//     //     fclose($myfile);
//     // }
// }

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    if (mysqli_connect_errno()) {
        echo 'Greska u povezivanju na bazu podataka';
        exit;
    }

if (isset($_POST['submit'])) {
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $target_dir = "dist/img/uploads/";
    $target_file = $target_dir . basename($post_image);
    
    $data = $_POST['blog_editor'];
    $title = $_POST['title'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['fk_id'];
    move_uploaded_file($post_image_temp, $target_file);
    
            
    $string = "UPDATE blog b 
                    SET b.user_id='$user_id', 
                    b.title='$title', 
                    b.content='$data', 
                    b.timestamp=NOW(), 
                    b.image='$target_file' 
                    WHERE b.b_id = '$post_id' ";

    $result = mysqli_query($conn, $string) or die(mysqli_connect_errno());

    if ($result) {
        header('Location: http://'.BASE_URL.'/pages/blog'); // treba staviti da prikazuje blog
    }
}
