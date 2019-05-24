<?php

class Controller {

    function __construct() {
        // default view ;
        $this->view = new View();
    }

    function checkLogin() {        
        // if the user is not logged in, send to the login page
        if (!User::isLoggedIn()) {                      
            header('location: ' . URL . 'auth');
        }        
    }

    // function to load in the relevent model

    public function loadModel($name) {
        $path = 'models/' . $name . '_model.php';

        if (file_exists($path)) {
            require 'models/' . $name . '_model.php';
            $modelName = $name . '_Model';

            // instantiate the model 
            $this->model = new $modelName();
        } else {
            //echo "No model: $path doesn't not exist!<br />";
        }
    }

}
