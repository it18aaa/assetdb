<?php

/**
 * encapsulates a person, to pass around
 *
 * @author ian
 */
class Person extends Model {

//put your code here
    private $firstname;
    private $lastname;
    private $username;
    private $tel;
    private $email;
    private $division;
    private $department;
    private $type;
    private $ID;

    public function __construct() {
        parent::__construct();
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getUsername() {
        return $this->username;
    }

    function getTel() {
        return $this->tel;
    }

    function getEmail() {
        return $this->email;
    }

    function getDivision() {
        return $this->division;
    }

    function getDepartment() {
        return $this->department;
    }

    function getID() {
        return $this->ID;
    }
    
    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDivision($division) {
        $this->division = $division;
    }

    function setDepartment($department) {
        $this->department = $department;
    }

    function setType($type) {
        $this->type = $type;
    }

    function getType() {
        return $this->type;
    }
    function setID($id) {
        $this->ID = $id;
    }

    static function getPersonFromDB($id) {
        $person = new Person();

        $sql = 'SELECT * FROM people WHERE id=' . $id;
        $data = $person->doQuery($sql);       
        
        if ($data != null) {

            $person->setUsername($data[0]['ljmuusername']);
            $person->setLastname($data[0]['lastname']);
            $person->setID($data[0]['id']);
            $person->setFirstname($data[0]['firstname']);
            $person->setEmail($data[0]['email']);
            $person->setTel($data[0]['tel']);
            $person->setDepartment($data[0]['department']);
            $person->setDivision($data[0]['division']);
            return $person;
        } else {
            return null;
        }

        
    }

    static function createPersonFromArray($arr) {

        $person = new Person();

        if (isset($arr['username'])) {
            $person->username = $arr['username'];
        }

        if (isset($arr['firstname'])) {
            $person->firstname = $arr['firstname'];
        }

        if (isset($arr['lastname'])) {
            $person->lastname = $arr['lastname'];
        }

        if (isset($arr['dept'])) {
            $person->department = $arr['dept'];
        }

        if (isset($arr['department'])) {
            $person->department = $arr['department'];
        }


        if (isset($arr['div'])) {
            $person->division = $arr['div'];
        }

        if (isset($arr['division'])) {
            $person->division = $arr['division'];
        }

        if (isset($arr['tel'])) {
            $person->tel = $arr['tel'];
        }

        if (isset($arr['telephone'])) {
            $person->tel = $arr['tel'];
        }


        if (isset($arr['mail'])) {
            $person->email = $arr['mail'];
        }

        if (isset($arr['email'])) {
            $person->email = $arr['email'];
        }


        if (isset($arr['type'])) {
            $person->type = $arr['type'];
        }

        if (isset($arr['id'])) {
            $person->ID = $arr['id'];
        }
 
        return $person;
    }

}
