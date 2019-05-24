<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Assets extends Controller {

    function __construct() {
        parent::__construct();
        
    }

    function index()
    {
        $this->checkLogin();
        
        $data = $this->model->listAssets();
        $this->view->data = $data;
        $this->view->render('assets/index');
        
    }
    
    function details($id)
    {
        $this->checkLogin();
                
        $this->view->asset = $this->model->getAssetDetails($id);
        $this->view->render('assets/details');
    }
    
    
    
    
}
