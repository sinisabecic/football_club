<?php

/**
 * Created by Visual Studio Code.
 * User: nikola
 * Date: 12.6.2020.
 * Time: 13.57
 */
class SeasonModel
{
    /**
     * @var mysqli
     */
    public $db;

    /**
     * SeasonModel constructor.
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
     * Create new season if last is finished
     * @param $date_start
     * @param $date_end
     * @return bool|mysqli_result
     */
    public function create_new($date_start, $date_end)
    {
        /**
         * Check if last season has ended
         */
        $string = 'select prvenstvo.finished from prvenstvo order by id desc limit 1';
        $result_check = mysqli_query($this->db, $string);
        $count_check = $result_check->num_rows;
        
        if ($count_check == 0 or $count_check > 0) {
            $string1 = 'insert into prvenstvo set godina_pocetka="'.$date_start.'", godina_svrsetka="'.$date_end.'", finished=0';
            $result = mysqli_query($this->db, $string1);

            return $result;
        } else {
            return false;
        }
    }

    /**
     * Update season - set finished and set winner
     * @param $id
     * @param $winner_id
     * @return bool|mysqli_result
     */
    public function update_season($id, $winner_id)
    {
        $string = 'update prvenstvo set finished=1, winner='.$winner_id.' where id='.$id;
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    /**
     * Get previous finished seasons
     * @return array|null
     */
    public function getPreviousSeasons()
    {
        $string = 'select prvenstvo.id as prvenstvo_id, prvenstvo.godina_pocetka as godina_pocetka, prvenstvo.godina_svrsetka as godina_svrsetka, tim.ime_tima as ime_tima from prvenstvo inner join tim on prvenstvo.winner=tim.id where prvenstvo.finished=1 order by godina_svrsetka desc';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function get_current_season()
    {
        $string = 'select prvenstvo.id, prvenstvo.godina_pocetka, prvenstvo.godina_svrsetka from prvenstvo order by id desc limit 1';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function get_all_seasons()
    {
        $string = 'select prvenstvo.id, prvenstvo.godina_pocetka, prvenstvo.godina_svrsetka from prvenstvo';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
