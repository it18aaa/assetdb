<?php

class UserInfo extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->checkLogin();
        $this->view->render('userinfo/index');
    }

    function search() {
        $this->checkLogin();
        // TODO : beautify !

        if (isset($_GET["username"]) && $_GET["username"] != null) {
            // username search    
            $data = $this->model->searchUsername($_GET["username"]);
            
            // if result returned, show it, otherwise 'not found' page
            header('location: show/' . $_GET['username']);
            
        } else if (isset($_GET["lastname"])) {
            // surname search - 
            // TODO: Sanitise post variables
            $data = $this->model->searchLastname($_GET["lastname"]);

            $this->view->results = $data;
            if (count($data) > 0) {
                $this->view->render('userinfo/searchResults');
            } else {
                $this->view->render('userinfo/noResult');                
            }
        } else {
            header('location: userinfo');
        }
    }

    function show($username) {
        $this->checkLogin();
        
        $data = $this->model->searchUsername($username);

        $this->view->data = $data;

        $this->view->render('userinfo/details');
    }

}
