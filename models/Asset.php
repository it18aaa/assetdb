<?php

class Asset extends Model {

    private $id;
    private $name;
    private $model;
    private $man;
    private $serial;
    private $typeid;
    private $notes;
    private $tempstatus;
    private $assetnumber;
    private $creatorId;
    private $creatorName;
    private $loans;
    
    // the following three relate to an asset as 
    // created in the context of a particular loan
    private $complete;
    private $signouttime;
    private $signintime;  
    private $signinbywhom;
    
    private $currentLoanId;
    private $currentBorrowerId;
    private $currentBorrowerName;
    private $currentLoanStatus;

    public function __construct() {
        parent::__construct();
    }

    static function getAssetFromID($id) {

        $item = new Asset();

        $sql = "SELECT * FROM assets WHERE ID=" . $id;
        $data = $item->doQuery($sql);

        $item->setId($id);
        $item->setName($data[0]['name']);
        $item->setModel($data[0]['model']);
        $item->setMan($data[0]['man']);
        $item->setTempStatus($data[0]['temp_status']);
        $item->setSerial($data[0]['serial']);
        $item->setTypeid($data[0]['typeid']);
        $item->setNotes($data[0]['notes']);
        $item->setAssetnumber($data[0]['assetnumber']);
        $item->setCreatorId($data[0]['creator']);

        $item->loadCreatorDetailsFromDB();

        $item->loadLoanDetailsFromDB();

        $item->loadLoanList();

        return $item;
    }

    private function loadLoanDetailsFromDB() {

        $sqlb = "SELECT * FROM loans l " .
                "   INNER JOIN loanassets la " .
                "       ON l.id=la.loanid " .
                "   INNER JOIN people p " .
                "       ON l.personid=p.id " .
                "   WHERE la.complete='N' " .
                "       AND la.assetid=" . $this->getId();

        $borrower = $this->doQuery($sqlb);

        if (count($borrower) > 0) {
            $borrower_name = $borrower[0]['firstname'] . " " . $borrower[0]['lastname'];

            $this->setCurrentBorrowerId($borrower[0]['personid']);
            $this->setCurrentBorrowerName($borrower_name);
            $this->setCurrentLoanId($borrower[0]['loanid']);
        } else {
            $this->setCurrentLoanId(null);
        }
        return;
    }

    private function loadLoanList() {
        $sql = "SELECT loanid FROM loanassets WHERE assetid=" . $this->getId();
        $data = $this->doQuery($sql);

        foreach ($data as $loanid) {
            $this->addLoan($loanid);            
            
            echo "</pre>";
        }
    }

    private function loadCreatorDetailsFromDB() {

        $sql = "SELECT * FROM people WHERE id=" . $this->getCreatorId();
        $data = $this->doQuery($sql);

        $creatorName = $data[0]['firstname'] . ' ' . $data[0]['lastname'];
        $this->setCreatorName($creatorName);
        return;
    }

    public function setId($input) {
        $this->id = $input;
    }

    public function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getModel() {
        return $this->model;
    }

    function getMan() {
        return $this->man;
    }

    function getSerial() {
        return $this->serial;
    }

    function getTypeid() {
        return $this->typeid;
    }

    function getNotes() {
        return $this->notes;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function setMan($man) {
        $this->man = $man;
    }

    function setSerial($serial) {
        $this->serial = $serial;
    }

    function setTypeid($typeid) {
        $this->typeid = $typeid;
    }

    function setNotes($notes) {
        $this->notes = $notes;
    }

    function getAssetnumber() {
        return $this->assetnumber;
    }

    function setAssetnumber($assetnumber) {
        $this->assetnumber = $assetnumber;
    }

    function getTempstatus() {
        return $this->tempstatus;
    }

    function setTempstatus($tempstatus) {
        $this->tempstatus = $tempstatus;
    }

    function getCreatorId() {
        return $this->creatorId;
    }

    function getCreatorName() {
        return $this->creatorName;
    }

    function getLoanId() {
        return $this->loanId;
    }

    function getBorrowerID() {
        return $this->borrowerID;
    }

    function getBorrowerName() {
        return $this->borrowerName;
    }

    function setCreatorId($creatorId) {
        $this->creatorId = $creatorId;
    }

    function setCreatorName($creatorName) {
        $this->creatorName = $creatorName;
    }

    function setLoanId($loanId) {
        $this->loanId = $loanId;
    }

    function setBorrowerID($borrowerID) {
        $this->borrowerID = $borrowerID;
    }

    function setBorrowerName($borrowerName) {
        $this->borrowerName = $borrowerName;
    }

    function getLoans() {
        return $this->loans;
    }

    function getCurrentLoanId() {
        return $this->currentLoanId;
    }

    function getCurrentBorrowerId() {
        return $this->currentBorrowerId;
    }

    function getCurrentBorrowerName() {
        return $this->currentBorrowerName;
    }

    function getCurrentLoanStatus() {
        return $this->currentLoanStatus;
    }

    function setCurrentLoanId($currentLoanId) {
        $this->currentLoanId = $currentLoanId;
    }

    function setCurrentBorrowerId($currentBorrowerId) {
        $this->currentBorrowerId = $currentBorrowerId;
    }

    function setCurrentBorrowerName($currentBorrowerName) {
        $this->currentBorrowerName = $currentBorrowerName;
    }

    function setCurrentLoanStatus($currentLoanStatus) {
        $this->currentLoanStatus = $currentLoanStatus;
    }

    function addLoan($id) {
        $this->loans[] = $id;
    }
    
    function getComplete() {
        return $this->completed;
    }

    function getSignouttime() {
        return $this->signouttime;
    }

    function getSignintime() {
        return $this->signintime;
    }

    function setComplete($completed) {
        $this->completed = $completed;
    }

    function setSignouttime($signouttime) {
        $this->signouttime = $signouttime;
    }

    function setSignintime($signintime) {
        $this->signintime = $signintime;
    }

    function getSigninbywhom() {
        return $this->signinbywhom;
    }

    function setSigninbywhom($signinbywhom) {
        $this->signinbywhom = $signinbywhom;
    }
   
}
