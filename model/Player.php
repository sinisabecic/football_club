<?php

/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 15.51
 */
class Player
{

    /**
     * @var mysqli
     */
    public $db;

    /**
     * Player constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_errno()) {
            echo 'Greska u povezivanju na bazu podataka';
            exit;
        }
    }

    public function new_player($ime, $prezime, $datum_rodjenja, $pozicija, $broj_dresa, $tim_id)
    {
        $string = 'insert into fudbaler(id, ime, prezime, datum_rodjenja, pozicija, broj_dresa,tim_id) values(NULL, "'.$ime.'", "'.$prezime.'", "'.$datum_rodjenja.'", "'.$pozicija.'", "'.$broj_dresa.'", (select tim.id from tim where tim.id='.$tim_id.'))';
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    public function fetch_players()
    {
        $string = 'SELECT * FROM fudbaler';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function change_all($id, $ime, $prezime, $datum_rodjenja, $pozicija, $broj_dresa, $tim_id)
    {
        $string = "update fudbaler set 
                    ime='$ime', 
                    prezime='$prezime', 
                    datum_rodjenja='$datum_rodjenja', 
                    pozicija='$pozicija',
                    broj_dresa='$broj_dresa',
                    tim_id='$tim_id'
                    where id='$id' ";

        $result = mysqli_query($this->db, $string);
        return $result;
    }


    public function delete_player($id)
    {
        $string = 'delete from fudbaler where id="'.$id.'"';
        $result = mysqli_query($this->db, $string);

        return $result;
    }
}
