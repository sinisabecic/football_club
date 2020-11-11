<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 12.6.2020.
 * Time: 18.55
 */
class GameModel
{

    /**
     * @var mysqli
     */
    public $db;

    /**
     * GameModel constructor.
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
     * @param $id_kola
     * @param $domacin_id
     * @param $gost_id
     * @param $datum
     * @return bool|string
     */
    public function new_game($id_kola, $domacin_id, $gost_id, $datum)
    {
        $string = 'INSERT INTO utakmica(id, id_kola, domacin_id, gost_id, rezultat_domaci, rezultat_gost, datum, odigrana) 
                   VALUES(
                       NULL, 
                       (SELECT k_id FROM kolo WHERE kolo.ki_id=' . $id_kola . '),
                       (SELECT id FROM tim WHERE tim.id=' . $domacin_id . '), 
                       (SELECT id FROM tim WHERE tim.id=' . $gost_id . '), 
                       NULL, 
                       NULL, "' . $datum . '", 0)';
        $result = mysqli_query($this->db, $string);
        if ($result) {
            return true;
        } else {
            return $string;
        }
    }

    public function update_game($id, $rezultat_domaci, $rezultat_gost)
    {
        $string = 'UPDATE utakmica SET rezultat_domaci="' . $rezultat_domaci . '", rezultat_gost="' . $rezultat_gost . '", odigrana=1 WHERE id="' . $id . '"';
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    public function fetch_games()
    {
        $string = 'select utakmica.id as game_id, t1.ime_tima as home_team, t2.ime_tima as guest_team, utakmica.datum as game_date from utakmica inner join tim t1 on utakmica.domacin_id=t1.id
inner join tim t2 on utakmica.gost_id=t2.id where odigrana=0';
        $result  = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function fetch_all_games()
    {
        $string = 'select utakmica.id as game_id, t1.ime_tima as home_team, t2.ime_tima as guest_team, utakmica.datum as game_date from utakmica inner join tim t1 on utakmica.domacin_id=t1.id
inner join tim t2 on utakmica.gost_id=t2.id';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
