<?php

class View {

    function __construct() {
        
    }

    
    public function render($name) {

        require 'views/header.php';
        
        // loads up the view, which is a basic php file!
        require 'views/' . $name . '.php';

        require('views/footer.php');
    }
    
    public function uxTimeToDateStr($uxtime) 
    {
        if($uxtime > 10000 ) {
            return date("d/m/y", $uxtime);
        } else {
            return "";
        }
        
    }

}
