<?php

class Userinfo_Model extends Model {

    function __construct() {
        //parent::__construct();
        $this->ldap = new LdapWrapper(User::get_username(), User::get_password());
    }

    function searchUsername($data) {
        return $this->ldap->getUsernameInfo($data);
    }

    function searchLastname($data) {
        return $this->ldap->getLastnameInfo($data);                      
    }

}
