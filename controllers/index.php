<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //default view
       $this->checkLogin();
       $this->view->render('index/index');
    }

    function smirnoff() {
        echo "VIEW: SMIRNOFF";
    }

    function wilbur() {
        echo "VIEW: WILBUR";
    }

}
