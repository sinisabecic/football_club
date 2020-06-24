<?php
session_start();
require '../config.php';
require '../model/UserModel.php';
require '../model/BlogModel.php';

$blog = new BlogModel();

$user = new UserModel();

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    if (mysqli_connect_errno()) {
        echo 'Greska u povezivanju na bazu podataka';
        exit;
    }
if ($user->is_admin($_SESSION['fk_id']) == 1) {
    ?>

<?php require('header.php'); ?>
<?php require('navigation.php') ?>


<div class="container" style="margin-top:115px">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Izmjena korisnika</h4>
            </div>
            <div class="modal-body">
                <?php
            // Ovo sam radio postupno na primitivan nacin kako bi se dobio konkretni korisnik za izmjenu
                if (isset($_GET['id'])) {
                    $post_id = $_GET['id'];
                }

    $query = "SELECT * FROM blog b
                     INNER JOIN userspass u ON b.user_id = u.id 
                     WHERE b.b_id= $post_id";

    $select = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($select)) {
        $id = $row['b_id'];
        $title = $row['title'];
        $data = $row['content'];
        $image = $row['image']; ?>



                <form action="functions/blog/edit-post.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                        <span class="input-group-addon">Naslov</span>
                        <input type="text" name="title" id="title" class="form-control"
                            value="<?php echo $title; ?>">
                    </div>
                    <br>
                    <input type="hidden" id="post_id" name="post_id"
                        value="<?php echo $id; ?>">

                    <div class="form-group">
                        <label for="image">Azuriraj sliku</label>
                        <input type="file" class="select-chosen" name="image">
                    </div>

                    <!-- <input type="file" name="file" id="files" />
                    <img id="image" /> -->

                    <textarea class="textarea" id="blog_editor" name="blog_editor" placeholder="Dodaj tekst..."
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;">
                            <?php echo $data; ?></textarea>
                    <button type="submit" class="form-control btn btn-primary" name="submit" id="submit">Sačuvaj
                        post</button>
                </form>

            </div>
            <div class="modal-footer">
                <a href="/admin/blog.php">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
                </a>
            </div>
        </div>
    </div>
    <?php
    } ?>



    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="bower_components/wysihtml5x/dist/wysihtml5x-toolbar.min.js"></script>
    <script src="bower_components/handlebars/handlebars.min.js"></script>
    <script src="bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.js"></script>

    <script>
        $('#blog_editor').wysihtml5({
            toolbar: {
                fa: true
            }
        });
    </script>


    </body>

    </html>

    <?php
} else {
        header('Location: http://' . BASE_URL . '');
    }
