<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loan
 *
 * @author ian
 * 
 * we are taking information out of several tables for this!
 * 
 */
class Loan extends Model {
    

    private $id;
    private $borrowerId;
    private $borrower;
    private $creatorId;
    private $creator;
    private $details;
    private $notes;
    private $time;
    
    private $isComplete;
    
    //  array of asset objects!
    private $assets;
    
    public function __construct() {
        parent::__construct();
    }
    
    // item ids, worked out from the 'loanassets' table
    function addLoanItem(Asset $item) {
            //$items[] = $item;
    }
    
    public static function getLoanFromDb($id) {
        $loan = new Loan();      
        
        // load up the relevent objects in the loan
        $loan->loadAssetList($id);    
        $loan->loadPeople($id);
        
        // fill in loan small details..!        
        
        $sql = "SELECT * FROM loans WHERE id=".$id;
        $data = $loan->doQuery($sql);
                
        $loan->setId($id);
        $loan->setDetails($data[0]['details']);
        $loan->setTime($data[0]['time']);
        $loan->setNotes($data[0]['notes']);
                                
        return $loan;
    }

    public function loadPeople($id) {
        $sql = "SELECT DISTINCT personid, creator FROM loans l ". 
               " INNER JOIN loanassets la ON l.id=la.loanid ".
               " WHERE l.id=".$id;
        $data = $this->doQuery($sql);
                
        $this->setCreatorId($data[0]['creator']);
        $this->setBorrowerId($data[0]['personid']);
        
        $this->setCreator(Person::getPersonFromDB($this->getCreatorId()));
        $this->setBorrower(Person::getPersonFromDB($this->getBorrowerID()));
        
    }
    public function loadAssetList($id) {
        $sql = "SELECT * FROM loanassets WHERE loanid=".$id;
        $detailsArr = $this->doQuery($sql);
        
        foreach($detailsArr as $oneItem) {            
            $assetObj = Asset::getAssetFromID($oneItem['assetid']);     
            
            $assetObj->setSignintime($oneItem['signintime']);
            $assetObj->setSignouttime($oneItem['signouttime']);
            $assetObj->setSigninbywhom($oneItem['signinpersonid']);
            $assetObj->setComplete($oneItem['complete']);
            $this->assets[] = $assetObj;            
        }
    }

    public function getAssets() {
        return $this->assets;
    }
    
    function getBorrowerId() {
        return $this->borrowerId;
    }

    function getCreatorId() {
        return $this->creatorId;
    }

    function setBorrowerId($borrowerId) {
        $this->borrowerId = $borrowerId;
    }

    function setCreatorId($creatorId) {
        $this->creatorId = $creatorId;
    }
    
    function getBorrower() {
        return $this->borrower;
    }

    function getCreator() {
        return $this->creator;
    }

    function setBorrower($borrower) {
        $this->borrower = $borrower;
    }

    function setCreator($creator) {
        $this->creator = $creator;
    }

    function getId() {
        return $this->id;
    }

    function getDetails() {
        return $this->details;
    }

    function getNotes() {
        return $this->notes;
    }

    function getIsComplete() {
        return $this->isComplete;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDetails($details) {
        $this->details = $details;
    }

    function setNotes($notes) {
        $this->notes = $notes;
    }

    function setIsComplete($isComplete) {
        $this->isComplete = $isComplete;
    }

    function getTime() {
        return $this->time;
    }

    function setTime($time) {
        $this->time = $time;
    }


    
}
