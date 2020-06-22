<?php

/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 18.40
 */
class RoundModel
{

    /**
     * @var mysqli
     */
    public $db;

    /**
     * RoundModel constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_errno()) {
            echo 'Greska u povezivanju na bazu podataka';
            exit;
        }
    }

    public function get_all_rounds()
    {
        $string = 'select * from kolo k
                   inner join prvenstvo p on k.id_prvenstva=p.id';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function new_round($br_kola, $id_prvenstva)
    {
        $string = 'insert into kolo set broj_kola="'.$br_kola.'", 
                                id_prvenstva="'.$id_prvenstva.'"';
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    public function delete_round($id)
    {
        $string = 'delete from kolo where k_id='.$id;
        $result = mysqli_query($this->db, $string);
        return $result;
    }
}
