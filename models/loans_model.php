<?php

class Loans_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function listLoans($isComplete = false) {
        if ($isComplete == false) {
            $complete = 'N';
        } else {
            $complete = 'Y';
        }

        $sql1 = 'SELECT p.firstname, p.lastname, a.name, l.notes, l.personid, ' .
                'l.id as loanid, la.signouttime as signouttime, la.assetid ' .
                'FROM people as p ' .
                '   JOIN loans as l ' .
                '       ON p.id=l.personid ' .
                '   JOIN loanassets AS la ' .
                '       ON l.id=la.loanid ' .
                '   JOIN assets AS a' .
                '       ON la.assetid=a.id ' .
                'WHERE ' .
                "   la.complete='$complete'" .
                '   ORDER BY la.signouttime DESC';

        return $this->doQuery($sql1);
    }

    function getPeople() {
        $sql = 'SELECT * from people ORDER BY lastname,firstname';

        return $this->doQuery($sql);
    }

    function getAvailableAssets() {

        $sql = "SELECT a.* FROM assets a WHERE " .
                " a.id NOT IN (SELECT la.assetid FROM loanassets la WHERE la.complete='N')";

        return $this->doQuery($sql);
    }

    function getPerson($id) {

        return Person::getPersonFromDB($id);
    }

    function doLoan($person_id, $items, $notes) {

// create a new loan and get id;
        $loan_time = time();
        $loan_creator_id = User::get_id();
        $loan_person_id = $person_id;

        $loans_sql = "INSERT INTO loans (personid, creator, time, notes) " .
                " VALUES (:person_id, :creator_id, :time, :notes)";

        $loanassets_sql = "INSERT INTO loanassets (loanid, assetid, signouttime, complete) " .
                " VALUES (:loanid, :assetid, :time, :iscomplete) ";

        try {
            $stmnt = $this->db->prepare($loans_sql);

            $stmnt->bindParam(':person_id', $loan_person_id);
            $stmnt->bindParam(':creator_id', $loan_creator_id);
            $stmnt->bindParam(':time', $loan_time);
            $stmnt->bindParam(':notes', $notes);

            $stmnt->execute();
        } catch (PDOException $e) {
            echo "PDO Error Code: " . $e->getCode();
            echo "<br /> " . $e->getMessage();
        }

        $loanid = $this->db->lastInsertID();
        $no = 'N';

        foreach ($items as $assetid) {
            $stmnt = $this->db->prepare($loanassets_sql);
            $stmnt->bindParam(':loanid', $loanid);
            $stmnt->bindParam(':assetid', $assetid);
            $stmnt->bindParam(':time', $loan_time);
            $stmnt->bindParam(':iscomplete', $no);

            $stmnt->execute();
        }
    }

    function getLoan($id) {

        return Loan::getLoanFromDb($id);
    }

    function returnAsset($assetid) {

        $asset = Asset::getAssetFromID($assetid);

        $sql = "UPDATE loanassets SET complete=:complete, " .
                " signintime=:time, " .
                " signinpersonid=:id " .
                " WHERE assetid=:assetid AND loanid=:loanid";

        $stmt = $this->db->prepare($sql);

        $a = "Y";
        $b = time();
        $c = User::get_id();
        $d = $assetid;
        $e = $asset->getCurrentLoanId();

        $stmt->bindValue(':complete', $a);
        $stmt->bindValue(':time', $b);
        $stmt->bindValue(':id', $c);
        $stmt->bindValue(':assetid', $d);
        $stmt->bindValue(':loanid', $e);
        
        $stmt->execute();
    }

}
