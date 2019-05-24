<?php

class People_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function listPeople() {

        $sth = $this->db->prepare('SELECT * FROM people ORDER BY lastname');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    function details($id) {

        // count and list loans
        $sql = 'SELECT id, time FROM loans WHERE personid=' . $id ;
        $loans = $this->doQuery($sql);
        $info['loans'] = $loans;
        $info['person'] = Person::getPersonFromDB($id);

        return $info;
    }

    function doAddPerson(Person $person) {
        // add person
        echo "adding person!";

        echo "firstname " . $person->getFirstname() . "<br />";
        echo "lastname " . $person->getLastname() . "<br />";
        echo "username " . $person->getUsername() . "<br />";
        echo "tel " . $person->getTel() . "<br />";
        echo "email " . $person->getEmail() . "<br />";


        $sql = 'INSERT INTO people '
                . '(firstname, lastname, ljmuusername, email, tel) '
                . 'VALUES '
                . '(:fname, :lname, :uname, :email, :tel)';
        echo $sql;
        $sth = $this->db->prepare($sql);
        try {
            $sth->execute(
                    array(':fname' => $person->getFirstname(),
                        ':lname' => $person->getLastname(),
                        ':uname' => $person->getUsername(),
                        ':email' => $person->getEmail(),
                        ':tel' => $person->getTel()));
        } catch (Exception $e) {
            echo ' caught exception:', $e->getMessage(), '\n';
        }
    }

}
