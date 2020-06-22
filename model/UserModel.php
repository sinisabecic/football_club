<?php

include "UserAPI.php";

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
        $data_array =  array(
            "username" => $username,
            "email" => $email,
            "password" => hash('sha256', $password),
            "is_admin" => "0"
        );

        $rez = AddUser(json_encode($data_array));

        if ($rez->get_statusCode() != "201") {
            echo "vec postoji user";
            return false;
        }

        $content = $rez->get_content();

        $id = $content["_id"];

        $password = hash('sha256', $password);
        $string = "select * from userspass where username='$username'";
        $check = $this->db->query($string);
        $count = $check->num_rows;
        if ($count == 0) {
            $query = "insert into userspass set id='$id', username='$username', email='$email', password='$password'";
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
        $rez = GetByUsernameAndPass($emailusername, hash('sha256', $password));
        $content = $rez->get_content();

        if ($rez->get_statusCode() == "201") {
            $_SESSION['fk_login'] = true;
            $_SESSION['fk_id'] = $content[0]["_id"];
            $_SESSION['fk_username'] = $emailusername;

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
        $rez = GetById($id);
        $content = $rez->get_content();

        if ($content["is_admin"] == "1") {
            return true;
        } else {
            return false;
        }
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
        $data_array =  array(
            "username" => $username,
        );
        $rez = UpdateByID($id, json_encode($data_array));

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
        $data_array =  array(
            "email" => $email,
        );
        $rez = UpdateByID($id, json_encode($data_array));

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
        $data_array =  array(
            "email" => hash('sha256', $password),
        );
        $rez = UpdateByID($id, json_encode($data_array));

        $password = hash('sha256', $password);
        $string = 'update userspass set password="'.$password.'" where id="'.$id.'"';
        $result = mysqli_query($string);

        return $result;
    }

    /**
     * Change admin status
     * @param $id
     * @return bool|mysqli_result
     */
    public function change_admin($id)
    {
        if ($admin = is_admin($id)) {
            $updateAdmin = "0";
        } else {
            $updateAdmin = "1";
        }

        $data_array =  array(
            "is_admin" => $updateAdmin,
        );
        $rez = UpdateByID($id, json_encode($data_array));

        $string = 'update userspass set is_admin=NOT(is_admin) where id="'.$id.'"';
        $result = mysqli_query($string);

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
        if ($this->is_admin($id)) {
            $updateAdmin = "0";
        } else {
            $updateAdmin = "1";
        }

        $password = hash('sha256', $password);

        $data_array =  array(
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "is_admin" => $updateAdmin
        );

        $rez = UpdateByID($id, json_encode($data_array));
        
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
        $rez = DeleteById($id);
        
        $string = 'delete from userspass where id="'.$id.'"';
        $result = mysqli_query($this->db, $string);
        
        return $result;
    }
}
