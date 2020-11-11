<?php

/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 12.6.2020.
 * Time: 22.52
 */
class StatisticsModel
{

    /**
     * @var mysqli
     */
    public $db;

    /**
     * StatisticsModel constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if (mysqli_connect_errno()) {
            echo 'Greska u povezivanju na bazu podataka';
            exit;
        }
    }

    public function new_entry($utakmica_id, $fudbaler_id, $br_golova, $br_asistencija, $zuti_karton, $crveni_karton)
    {
        $string = 'insert into statistika(id, utakmica_id, fudbaler_id, br_golova, br_asistencija, zuti_karton, crveni_karton) 
values (NULL, (select id from utakmica where utakmica.id=' . $utakmica_id . '), (select id from fudbaler where fudbaler.id=' . $fudbaler_id . '), "' . $br_golova . '", "' . $br_asistencija . '", "' . $zuti_karton . '", "' . $crveni_karton . '")';
        $result = mysqli_query($this->db, $string);

        return $result;
    }

    public function lista_strelaca()
    {
        $string = 'select f1.ime as stat_ime, f2.prezime as stat_prezime, sum(statistika.br_golova) as br_golova from statistika 
left join fudbaler f1 on statistika.fudbaler_id=f1.id 
left join fudbaler f2 on statistika.fudbaler_id=f2.id
group by f1.id
limit 10';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function lista_asistenata()
    {
        $string = 'select f1.ime as stat_ime, f2.prezime as stat_prezime, sum(statistika.br_asistencija) as br_asistencija from statistika 
left join fudbaler f1 on statistika.fudbaler_id=f1.id 
left join fudbaler f2 on statistika.fudbaler_id=f2.id
group by f1.id
limit 10';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function lista_utakmica()
    {
        $string = 'select utakmica.rezultat_domaci as stat_home, utakmica.rezultat_gost as stat_guest, t1.ime_tima as domaci_tim, t2.ime_tima as gostujuci_tim from utakmica
inner join tim t1 on utakmica.domacin_id = t1.id
inner join tim t2 on utakmica.gost_id = t2.id limit 10';
        $result = mysqli_query($this->db, $string);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
