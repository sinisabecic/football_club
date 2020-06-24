<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 14.36
 */
class BlogModel
{
    /**
     * @var mysqli
    */
    public $db;
    
    /**
     * BlogModel constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_errno()) {
            echo 'Greska u povezivanju na bazu podataka';
            exit;
        }
    }


    public function newPost($data, $user_id, $image, $title)
    {
        $string = 'INSERT INTO blog(b_id, user_id, title, content, timestamp, image) 
        VALUES 
            (NULL, 
            (SELECT u.id FROM userspass u WHERE u.id="' . $user_id . '"), 
            "' . $title . '", "' . $data . '", now(), "' . $image . '")';

        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());

        return $result;
    }

    public function updatePost($post_id, $user_id, $data, $image, $title)
    {
        $string = 'UPDATE blog b 
                    SET b.user_id=' . $user_id . ', 
                    b.title="' . $title . '", 
                    b.content="' . $data . '", 
                    b.timestamp=NOW(), 
                    b.image="'.$image.'" 
                    WHERE b.b_id = "'.$post_id.'" ';

        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());

        return $result;
    }

    public function getPosts()
    {
        $string = 'SELECT * FROM blog';
        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // with pagination
    public function getPostsPag($limit, $offset)
    {
        $string = 'SELECT blog.b_id AS post_id, blog.title AS post_title, blog.content AS post_content, blog.image AS post_image, blog.timestamp AS post_timestamp, userspass.username AS post_username FROM blog
        INNER JOIN userspass ON blog.user_id = userspass.id 
        ORDER BY post_timestamp LIMIT ' . $limit . ' OFFSET ' . $offset;

        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // ukupan broj postova
    /**
     * @return int
     */
    public function getNumPost()
    {
        $string = 'SELECT * FROM blog';
        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());
        return $result->num_rows;
    }

    /**
     * Limiting content to one paragraph
     */
    public function limitParagraphs($sHTML, $iLimit)
    {
        if (1 === preg_match('~(<p>.+?</p>){' . (int)$iLimit . '}~i', $sHTML, $aMatches)) {
            return $aMatches[0];
        }
        return $sHTML;
    }

    /**
     * Limiting content to number of words
     * @param $text
     * @param $limit
     * @return string
     */
    public function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }


    /**
     * Getting single post data
     */
    public function getSinglePost($id)
    {
        $string = 'SELECT blog.b_id AS post_id, 
                          blog.title AS post_title, 
                          blog.content AS post_content, 
                          blog.image AS post_image, 
                          blog.timestamp AS post_timestamp, 
                          userspass.username AS post_username 
                          FROM blog
                   INNER JOIN userspass ON blog.user_id = userspass.id 
                   WHERE blog.b_id=' . $id;

        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    /**
     * Delete specific post
     */
    public function deletePost($id)
    {
        $string = 'DELETE FROM blog WHERE blog.b_id=' . $id;
        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());

        return true;
    }

    /**
     * Get last 3 news
     */
    public function getLastThree()
    {
        $string = 'SELECT blog.b_id AS post_id, blog.title AS post_title, blog.content AS post_content, blog.image AS post_image, blog.timestamp AS post_timestamp, userspass.username AS post_username FROM blog INNER JOIN userspass ON blog.user_id = userspass.id ORDER BY blog.timestamp DESC LIMIT 3';
        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    /**
     * @param $value
     * @return array|int|null
     */
    public function searchByTitle($value)
    {
        $string = 'SELECT blog.b_id AS post_id, blog.title AS post_title, blog.content AS post_content, blog.image AS post_image, blog.timestamp AS post_timestamp, userspass.username AS post_username FROM blog INNER JOIN userspass ON blog.user_id = userspass.id where blog.title like "%'.$value.'%" order by blog.timestamp desc';
        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());

        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 0;
        }
    }

    /**
     * @param $value
     * @return array|int|null
     */
    public function searchByAuthor($value, $author)
    {
        $string = 'SELECT blog.b_id AS post_id, blog.title AS post_title, blog.content AS post_content, blog.image AS post_image, blog.timestamp AS post_timestamp, userspass.username AS post_username FROM blog INNER JOIN userspass ON blog.user_id = userspass.id where blog.title like "%'.$value.'%" and userspass.username like "%'.$author.'%" order by blog.timestamp desc';
        $result = mysqli_query($this->db, $string) or die(mysqli_connect_errno());

        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 0;
        }
    }
}
