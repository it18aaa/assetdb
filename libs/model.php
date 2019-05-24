<?php

class Model {

    function __construct() {
        //$this->database = new database et c... 

        $this->db = new Database();
    }

    function doQuery($sql) {
        $sth = $this->db->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

}
