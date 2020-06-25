<style>
    td {
        background: #556271;
        color: #fff;
        vertical-align: middle;
    }

    label {
        color: #fff;
        font-weight: 600;
    }
</style>

<?php
session_start();
require '../config.php';
require '../model/UserModel.php';

$user = new UserModel();

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
                            <li><a href="admin/blog.php">Blog</a></li>
                            <li class="active">Spisak objava</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>

<?php
    require '../model/BlogModel.php';
    $blog = new BlogModel(); ?>

        <table id="datatable" class="table table-hover bg-danger">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Slika</th>
                    <th>Sadržaj</th>
                    <th>Ukloni</th>
                    <th>Izmijeni</th>
                </tr>
            </thead>
            <tbody class="bg-warning">
                <?php
            for ($i = 0; $i<sizeof($blog->getPosts()); $i++) {
                $posts = $blog->getPosts(); ?>
                <tr>
                    <td><?php echo $posts[$i]['b_id']; ?>
                    </td>
                    <td><?php echo $posts[$i]['title']; ?>
                    </td>
                    <td>
                        <img src="<?php echo $posts[$i]['image']; ?>"
                            width="30%" alt="">
                    </td>
                    <td><?php echo $blog->limit_text($blog->limitParagraphs($posts[$i]['content'], 1), 20); ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger"
                            onclick="delItem('<?php echo $posts[$i]['b_id']; ?>')"><i
                                class="fa fa-trash"></i> Izbriši</button>
                    </td>
                    <td>
                        <a
                            href="/admin/edit_post.php?id=<?php echo $posts[$i]['b_id'] ?>">
                            <button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Izmijeni</button>
                        </a>
                    </td>
                </tr>
                <?php
            } ?>

            </tbody>
        </table>




    </div>
</div>

<script src="public/js/jquery.js"></script>


<script src="public/js/jquery.toast.js"></script>
<script src="public/js/jquery.validate.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src=" https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

<script src="bower_components/wysihtml5x/dist/wysihtml5x-toolbar.min.js"></script>
<script src="bower_components/handlebars/handlebars.min.js"></script>
<script src="bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.js"></script>


<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>

<script>
    $('#blog_editor').wysihtml5({
        toolbar: {
            fa: true
        }
    });
</script>

<script>
    function delItem(item) {
        if (confirm('Da li ste sigurni?')) {
            var formData = {
                'post_id': item
            };
            $.ajax({
                type: 'POST',
                url: 'functions/admin/delete_post.php',
                data: formData,
                success: function(response) {
                    if (response.error) {
                        console.log(response.error);
                        alert(response.error);
                    } else {
                        console.log(response.success);
                        window.location.reload(true);
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert("Greška, učitajte ponovo");
                },
                async: false
            });
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>

</body>

</html>

<?php
} else {
                header('Location: http://' . BASE_URL . '');
            }
