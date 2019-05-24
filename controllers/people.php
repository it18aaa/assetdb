<?php

// this is for adding and removing people from the database's
// correlates directly to the people table
// add
// view list
// edit / modify
// delete

class People extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->checkLogin();

        $data = $this->model->listPeople();
        $this->view->data = $data;
        $this->view->render('people/index');
    }

    function addPerson() {
        $this->checkLogin();

        // if we've been sent here from the LJMU user search, load up
        // view->person
        if (isset($_POST['submit'])) {
            // TODO :  santise  $POST variables
            $this->view->person = Person::createPersonFromArray($_POST);
        }

        $this->view->render('people/addPersonForm');
    }

    function details($id) {
        $this->checkLogin();

        $info = $this->model->details($id);
                
        if ($info['person'] != null) {
            $this->view->person = $info['person'];
            $this->view->loans = $info['loans'];
            $this->view->render('people/details');
        } else {
            $this->view->render('people/detailsNotFound');
        }
    }

    function doAddPerson() {

        $this->checkLogin();

        if (isset($_POST)) {

            // $_POST Needs filtering
            $inp = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $person = Person::createPersonFromArray($inp);

            $this->model->doAddPerson($person);

            header('Location: .');
        } else {
            echo "trying to bung stuff in without a form!";
        }
    }

}
