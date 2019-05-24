<?php

class Loans extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->checkLogin();
        
        // show a menu or a list of items that are currently out
        
        if (isset($_GET["completedLoans"]) && $_GET["completedLoans"] == true) {
            $completed = true;
        } else {
            $completed = false;
        }
        $this->view->data = $this->model->listLoans($completed);
        $this->view->render('loans/index');
    }

    function details($id) {
        // show details of a loan
        //
               
        $this->view->loan = $this->model->getLoan($id);
        $this->view->render('loans/details');
    }
    
    
    function create($id = null) {
        $this->checkLogin();

        // if not associated with a person
        if ($id == null)  {
            $data['people'] = $this->model->getPeople();

            $this->view->data = $data;
            $this->view->render('loans/create1');
            
        // second page was navigated to via a link
        } elseif (!isset($_POST['submit'])) {
                        
            $data['assets'] = $this->model->getAvailableAssets();                        
            $data['borrower'] = $this->model->getPerson($id);
            
            $this->view->data = $data;
            $this->view->render('loans/create2');
            
        // nextpage is from a form 
        } elseif (isset($_POST['page2'])) {           
            
            $borrower = $this->model->getPerson($id);                                  
            $itemids = $_POST['items'];
            
            foreach($itemids as $itemid)
            {
                $items[] = Asset::getAssetFromID($itemid);
            }
                        
            $this->view->borrower = $borrower;
            $this->view->items = $items;
            $this->view->render('loans/create3');
        // last page is from a form
        } elseif (isset($_POST['page3'])) {
            // write data to database,
            // and confirm the write
           
            $items = $_POST['items'];
            $notes = $_POST['notes'];
            $person = $id;
            
            $outcome = $this->model->doLoan($person, $items, $notes);

            $this->view->render('loans/create4');
        }
    }
    
    function returnAsset($assetid) {        
        $this->model->returnAsset($assetid);        
        header('Location: '. $_SERVER['HTTP_REFERER']);         
    }
    
    function allLoansByAsset() {
        $loans = $this->model->allLoansByAsset();                        
    }
}
