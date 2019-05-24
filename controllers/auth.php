<?php

class Auth extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

//        $this->checkLogin();
        
        $this->view->render('auth/loginForm');
 
    }

    public function doLogin() {        
        $this->model->doLogin();
        header('location: '.URL);
    }

    public function doLogout() {        
        $this->model->doLogout();        
        header('location: '.URL.'auth');
    }

}
