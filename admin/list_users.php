<?php
session_start();
require '../config.php';
require '../model/UserModel.php';

$user = new UserModel();

// $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
//     if (mysqli_connect_errno()) {
//         echo 'Greska u povezivanju na bazu podataka';
//         exit;
//     }
        if ($user->is_admin($_SESSION['fk_id']) == 1) {
            ?>

<?php require('header.php'); ?>



<?php require('navigation.php') ?>

<div class="page-holder" style="margin-top:75px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="container">
                        <ul class="breadcrumb">
                            <li><a href="admin/index.php">Administracija</a></li>
                            <li><a href="admin/users.php">Korisnici</a></li>
                            <li class="active">Spisak korisnika</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-hover bg-siva">
                    <?php
            if (sizeof($user->get_users()) == 0) {
            } else { ?>
                    <tr>
                        <th>ID</th>
                        <th>Korisničko ime</th>
                        <th>E-mail</th>
                        <th>Admin</th>
                        <th>Akcija</th>
                    </tr>
                    <?php
                for ($i = 0; $i<sizeof($user->get_users()); $i++) {
                    $users = $user->get_users(); ?>
                    <tr>
                        <td><?php echo $users[$i]['id']; ?>
                        </td>
                        <td><?php echo $users[$i]['username']; ?>
                        </td>
                        <td><?php echo $users[$i]['email']; ?>
                        </td>
                        <td><?php echo $users[$i]['is_admin']; ?>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-xs"
                                onclick="deleteUser('<?php echo $users[$i]['id']; ?>')">Ukloni</button>
                            <a href="/admin/edit_user.php?id=<?php echo $users[$i]['id']; ?>"
                                class="bijela">
                                <button class="btn bg-plava w-700 btn-xs">Izmijeni</button></td>
                    </tr>
                    </a>
                    <?php
                }
                    } ?>
                </table>
            </div>
        </div>





    </div>
</div>

<script src="public/js/jquery.js"></script>
<script src="public/js/jquery.toast.js"></script>
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

<script>
    function deleteUser(item) {
        if (confirm('Da li ste sigurni?')) {
            var formData = {
                'user_id': item
            };
            $.ajax({
                type: 'POST',
                url: 'functions/user/delete_user.php',
                data: formData,
                success: function(response) {
                    if (response.error) {
                        console.log(response.error);
                        alert(response.error);

                    } else { // Ako je uspjesno izbrisano
                        console.log(response.success);
                        window.location.reload(true);
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert("Error deleting item. Reload page and try again...");
                },
                async: false
            });
        }
    }
</script>
</body>

</html>

<?php
        } else {
            header('Location: http://' . BASE_URL . '');
        }
