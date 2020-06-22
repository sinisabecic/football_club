<?php
    
    class ApiResponse {
        // Properties
        public $statusCode;
        public $content;
      
        function __construct($statusCode, $content) {
            $this->statusCode = $statusCode;
            $this->content = $content;
        }

        function get_statusCode() {
            return $this->statusCode;
        }
        function get_content() {
            return $this->content;
        }
    }

    function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();
    
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
    
                if ($data)
                {
                    $headers = array('Content-Type: application/json');
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                }
                break;
            case "PUT":
                $headers = array('Content-Type: application/json');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
    
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($curl);
    
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
    
        return new ApiResponse($statusCode, json_decode($result, true));;

    }

    function GetUsers()
    {
        return CallAPI('GET', 'http://localhost:3000/users');
    }

    function GetByUsernameAndPass($username, $password)
    {
        return CallAPI('GET', 'http://localhost:3000/users/'.$username.'/'.$password);
    }

    function GetById($id)
    {
        return CallAPI('GET', 'http://localhost:3000/users/'.$id);
    }

    function UpdateByID($id, $data)
    {
        return CallAPI('PUT', 'http://localhost:3000/users/'.$id, $data);
    }

    function AddUser($data)
    {
        return CallAPI('POST', 'http://localhost:3000/users', $data);
    }

    function DeleteById($id)
    {
        return CallAPI('DELETE', 'http://localhost:3000/users/'.$id);
    }

    /*body za AddUser
    $data_array =  array(
        "username" => "suka.3434asda",
        "password" => "Test.123",
        "is_admin" => "0" 
    );
    */

    /*body za npr update usera
    $data_array =  array(
        "is_admin" => "1" 
    );
    */

    //print_r(UpdateByID("5eef6185ae7fed28e8f01aff", json_encode($data_array))->get_content());
    //$rez = AddUser(json_encode($data_array))->get_content();
    //print_r(GetUsers()->get_content());
    //print_r(GetByUsernameAndPass("test", "test")->get_statusCode());

    //print_r(DeleteUser("5eef7da1ae7fed28e8f01b0d")->get_content());

?>