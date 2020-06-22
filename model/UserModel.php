<?php


class UserModel
{
    /**
     * @var mysqli
     */
    public $db;

    /**
     * UserModel constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_errno()) {
            echo 'Greska u povezivanju na bazu podataka';
            exit;
        }
    }

    /**
     * Sign up
     * @param $username
     * @param $email
     * @param $password
     * @return bool|mysqli_result
     */
    public function register($username, $email, $password)
    {
        $password = hash('sha256', $password);
        $string = "select * from userspass where username='$username' or email='$email'";
        $check = $this->db->query($string);
        $count = $check->num_rows;
        if ($count == 0) {
            $query = "insert into userspass set username='$username', email='$email', password='$password'";
            $result = mysqli_query($this->db, $query) or die(mysqli_connect_errno());
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Sign in
     * @param $emailusername
     * @param $password
     * @return bool|string
     */
    public function login($emailusername, $password)
    {
        $password = hash('sha256', $password);
        $string = "select id, username from userspass where (email='$emailusername' or username='$emailusername') and password='$password'";
        $result = mysqli_query($this->db, $string);
        $user_data = mysqli_fetch_array($result);
        $count = $result->num_rows;

        if ($count == 1) {
            $_SESSION['fk_login'] = true;
            $_SESSION['fk_id'] = $user_data['id'];
            $_SESSION['fk_username'] = $user_data['username'];

            return json_encode(array(
                'login' => $_SESSION['fk_login'],
                'user_id' => $_SESSION['fk_id'],
                'username' => $_SESSION['fk_username']
            ));
        } else {
            return false;
        }
    }

    /**
     * Sign out user
     * @return bool
     */
    public function logout()
    {
        $_SESSION['fk_login'] = false;
        session_destroy();
        return true;
    }

    /**
     * Check if user is admin
     * @param $id
     * @return mixed
     */
    public function is_admin($id)
    {
        $string = 'select userspass.`is_admin` as admin from userspass where userspass.`id`="'.$id.'"';
        $result = mysqli_query($this->db, $string);
        $user_data = mysqli_fetch_array($result);
        $admin = $user_data['admin'];

        return $admin;
    }

    /**
     * Fetch all users
     * @return bool|mysqli_result
     */
    public function get_users()
    {
        $string = 'select * from userspass';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
   

    /**
     * Fetch specific user details
     * @param $id
     * @return bool|mysqli_result
     */
    public function get_user_details($id)
    {
        $string = 'select * from userspass where id='.$id;
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    /**
     * Change username
     * @param $id
     * @param $username
     * @return bool|mysqli_result
     */
    public function change_username($id, $username)
    {
        $string = 'update userspass set username="'.$username.'" where id='.$id;
        $result = mysqli_query($this->db, $string);
        return $result;
    }

    /**
     * Change email
     * @param $id
     * @param $email
     * @return bool
     */
    public function change_email($id, $email)
    {
        $string = 'update userspass set email="'.$email.'" where id="'.$id.'"';
        $result = mysqli_query($this->db, $string);

        return true;
    }

    /**
     * Change password
     * @param $id
     * @param $password
     * @return bool|mysqli_result
     */
    public function change_password($id, $password)
    {
        $password = hash('sha256', $password);
        $string = 'update userspass set password="'.$password.'" where id="'.$id.'"';
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    /**
     * Change admin status
     * @param $id
     * @return bool|mysqli_result
     */
    public function change_admin($id)
    {
        $string = 'update userspass set is_admin=NOT(is_admin) where id="'.$id.'"';
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    /**
     * Change all fields
     * @param $id
     * @param $username
     * @param $email
     * @param $password
     * @param $admin
     * @return bool|mysqli_result
     */
    public function change_all($id, $username, $email, $password, $admin)
    {
        $password = hash('sha256', $password);
        $string = 'update userspass set username="'.$username.'", email="'.$email.'", password="'.$password.'", is_admin="'.$admin.'" where id="'.$id.'"';
        $result = mysqli_query($this->db, $string);
        return $result;
    }

    /**
     * Delete specific user
     * @param $id
     * @return bool
     */
    public function delete_user($id)
    {
        $string = 'delete from userspass where id="'.$id.'"';
        $result = mysqli_query($this->db, $string);

        return $result;
    }
}
