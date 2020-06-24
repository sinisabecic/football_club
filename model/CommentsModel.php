<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 15.17
 */
class CommentsModel
{
    public $db;

    /**
     * Comments constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_errno()) {
            echo 'Error connecting to the database';
            exit;
        }
    }

    /**
     * @param $row
     */
    public function getComments($row)
    {
        $date = new DateTime($row['comments_timestamp']);
        $newDate = date_format($date, 'd.m.Y H:i:s');
        $username = $row['comments_username'];
        $comments_id = $row['comments_id'];
        $blog_id = $row['comments_blog_id'];
        $content = $row['comments_content'];
        $parent = $row['comments_parent'];

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '<div class="media">';
        echo '<a class="pull-left" href="#">';
        echo '<img class="media-object" src="http://placehold.it/64x64" alt="">';
        echo '</a>';
        echo '<div class="media-body">';
        echo '<h4 class="media-heading">' . $username . '<small>' . $newDate . '</small></h4>';
        echo $content;
        echo '<div class="reply">';
        echo '<a class="comment-reply-link" href="#comment" id="' . $comments_id . '">Reply&#187;</a>';
        echo '</div>';
        $string = 'SELECT blog_comments.id AS comments_id, blog_comments.blog_id AS comments_blog_id, blog_comments.content AS comments_content, blog_comments.timestamp AS comments_timestamp, blog_comments.parent AS comments_parent, userspass.username AS comments_username FROM blog_comments INNER JOIN userspass ON blog_comments.user_id = userspass.id WHERE blog_comments.parent =' . $comments_id .' and blog_comments.odobren=1';
        $result = mysqli_query($this->db, $string);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $this->getComments($row);
                }
            }
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function getAllCommentsForAdmin()
    {
        $string = 'SELECT blog_comments.id AS comments_id, blog_comments.blog_id AS comments_blog_id, 
            blog_comments.content AS comments_content, 
            blog_comments.timestamp AS comments_timestamp,
            blog.title as comments_blog_title, 
            userspass.username AS comments_username FROM blog_comments 
            INNER JOIN userspass ON blog_comments.user_id = userspass.id
            inner join blog on blog_comments.blog_id = blog.b_id
            order by blog_comments.`timestamp` DESC';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getOdobreniForAdmin()
    {
        $string = 'SELECT blog_comments.id AS comments_id, blog_comments.blog_id AS comments_blog_id, 
blog_comments.content AS comments_content, 
blog_comments.timestamp AS comments_timestamp,
blog.title as comments_blog_title, 
userspass.username AS comments_username FROM blog_comments 
INNER JOIN userspass ON blog_comments.user_id = userspass.id
inner join blog on blog_comments.blog_id = blog.b_id WHERE blog_comments.odobren = 1
order by blog_comments.`timestamp` DESC';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getNeodobreniForAdmin()
    {
        $string = 'SELECT blog_comments.id AS comments_id, blog_comments.blog_id AS comments_blog_id, 
blog_comments.content AS comments_content, 
blog_comments.timestamp AS comments_timestamp,
blog.title as comments_blog_title, 
userspass.username AS comments_username FROM blog_comments 
INNER JOIN userspass ON blog_comments.user_id = userspass.id
inner join blog on blog_comments.blog_id = blog.b_id WHERE blog_comments.odobren = 0
order by blog_comments.`timestamp` DESC';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function setOdobren($id)
    {
        $string = 'update blog_comments set odobren=1 where blog_comments.id='.$id;
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    /**
     * @param $id
     * @return int
     */
    public function getCommentsNumber($id)
    {
        $string = 'SELECT blog_comments.id AS comments_id, blog_comments.blog_id AS comments_blog_id, blog_comments.content AS comments_content, blog_comments.timestamp AS comments_timestamp, userspass.username AS comments_username FROM blog_comments INNER JOIN userspass ON blog_comments.user_id = userspass.id WHERE blog_comments.blog_id=' . $id .' and blog_comments.odobren=1';
        $result = mysqli_query($this->db, $string);

        return $result ? mysqli_num_rows($result) : 0;
    }

    /**
     * @param $user_id
     * @param $blog_id
     * @param $content
     * @param $timestamp
     * @param $parent
     * @return bool
     */
    public function newComment($user_id, $post_id, $content, $timestamp, $parent)
    {
        $string = "INSERT INTO blog_comments(id, user_id, blog_id, content, timestamp, parent, odobren)
        VALUES (NULL,
                (SELECT userspass.id FROM userspass WHERE userspass.id='$user_id'),
                (SELECT blog.b_id FROM blog WHERE blog.b_id='$post_id'),
                '$content', NOW(), '$parent', 0)";
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    /**
     * @param $blog_id
     */
    public function getCommentsByID($blog_id)
    {
        $string = 'SELECT blog_comments.id AS comments_id, blog_comments.blog_id AS comments_blog_id, blog_comments.content AS comments_content, blog_comments.timestamp AS comments_timestamp, blog_comments.parent AS comments_parent, userspass.username AS comments_username FROM blog_comments INNER JOIN userspass ON blog_comments.user_id = userspass.id WHERE blog_comments.blog_id=' . $blog_id. ' AND blog_comments.parent=0 and blog_comments.odobren=1';
        $result = mysqli_query($this->db, $string);
        if ($result) {
            $num_rows = mysqli_num_rows($result);
            if ($num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $this->getComments($row);
                }
            } else {
                echo '<h5 class="bordo">No comments available for this post!</h5>';
            }
        } else {
            echo '<h5 class="bordo">Could not fetch comments for this post!</h5>';
        }
    }
}
