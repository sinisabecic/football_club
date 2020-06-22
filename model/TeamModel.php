<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 12.6.2020.
 * Time: 15.26
 */
class TeamModel
{

    /**
     * @var mysqli
     */
    public $db;

    /**
     * TeamModel constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_errno()) {
            echo 'Greska u povezivanju na bazu podataka';
            exit;
        }
    }

    public function fetchTeams()
    {
        $string = 'select * from tim';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function new_team($name, $datum_osnivanja)
    {
        $string = 'insert into tim set ime_tima="'.$name.'", osnovan="'.$datum_osnivanja.'", is_me=0';
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    public function delete_team($id)
    {
        $string = 'delete from tim where tim.id='.$id;
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    public function get_my_team()
    {
        $string = 'select fudbaler.ime as ime_fudbalera, fudbaler.broj_dresa as broj_dresa, fudbaler.prezime as prezime_fudbalera, fudbaler.pozicija as pozicija_fudbalera, tim.ime_tima as ime_tima from fudbaler
inner join tim on fudbaler.tim_id = tim.id
where tim.is_me=1';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function team_header()
    {
        $string = 'select tim.ime_tima, tim.osnovan from tim where tim.is_me=1';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
