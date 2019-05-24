<?php

class Tickets extends Controller {

    function __construct() {
        parent::__construct();
        
    }

    public function index() {
        $this->checkLogin();        
        
        // display all open tickets
        
        // tickets are jobs that are opened by an object in the 
        // user database, and are assigned to a team or a user 
        // there will be a list of open tickets and closed tickets
        // tickets can have multiple notes associated with them from
        // anyone in the team!       
                
        $this->view->render("tickets/index");
        
    }
}
