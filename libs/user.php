<?php

// wrapper class to encapsulate a user
// session ['user']

class User {

    function __construct() {
        // if session is set load up the user variables
        // otherwise
    }

    static function get_username() {
        return Session::get('user')['username'];
    }

    static function get_password() {
        $pwd = Session::get('user')['password'];
        $iv = Session::get('user')['iv'];
        return Encryption::decrypt($pwd, $iv);
    }

    static function get_firstname() {
        return Session::get('user')['firstname'];
    }

    static function get_lastname() {
        return Session::get('user')['lastname'];
    }

    static function isLoggedIn() {

        if (isset(Session::get('user')['auth'])) {
            return Session::get('user')['auth'];
        } else {
            return false;
        }
    }

    static function get_id() {
        if (isset(Session::get('user')['id'])) {
            return Session::get('user')['id'];
        } else {
            return false;
        }
    }

}
