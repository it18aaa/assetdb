<?php

class Bootstrap {

    function __construct() {
        ini_set('display_errors', 2);
        
        Session::init();              
        
        if (isset($_GET["url"])) {
            $url = $_GET["url"];
            $url = rtrim($url, '/');

            $url = explode('/', $url);
        } else {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }

        $inc = 'controllers/' . $url[0] . '.php';

        if (file_exists($inc)) {
            require $inc;
        } else {

            require 'controllers/error.php';
            $controller = new Error("cannot find ");
            $controller->index();
            return false;

            //throw new Exception("The file $inc doesn't exist");
        }

        // first part of url is class, instantiate the class
        $controller = new $url[0];
        $controller->loadModel($url[0]);

        // calling methods
        if (isset($url[2])) {
            if (method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2]);
            }
        } else {
            if (isset($url[1])) {
                // second part of url string is method
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}();
                }
            } else {
                // otherwise , show default view
                $controller->index();
            }
        }
    }

}
