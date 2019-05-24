<?php

class Auth_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function doLogin() {

        // need to sanitise this input really, quick hack!
        $username = $_POST['username'];
        $password = $_POST['password'];

        $ldap = new LdapWrapper($username, $password);

        // this needs reworking
        // if we have an ldap connection, do stuff
        if ($ldap->doAuthenticate()) {

            //if your name isn't down, you're not coming in
            // authorised through LDAP - 

            $userInfo = $ldap->getUsernameInfo();
            $userInfo['username'] = $username;

            // encrypt our password
            $iv = Encryption::getIV();
            $pwd = Encryption::encrypt($password, $iv);

            // store
            $userInfo['iv'] = $iv;
            $userInfo['password'] = $pwd;
            $userInfo['auth'] = 'true';

            // quick query to get the user id
            $sql = "SELECT id FROM people " .
                    "WHERE ljmuusername='$username'";
            $data = $this->doQuery($sql);

            $userInfo['id'] = $data[0]['id'];

            // set the user variables

            Session::set('user', $userInfo);
            // otherwise not authorised, fall back onto database    
        } else {
            //$userInfo['auth'] = false;
            //Session::set('user', $userInfo);

            $sql = "SELECT * from users WHERE username='$username'";

            echo "No LDAP Connection - trying to auth via database\n";
            echo "$sql";
            $data = $this->doQuery($sql);

            if (count($data) > 0) {

                $user = $data[0];
                echo "<pre>";
                print_r($user['username']);
                print_r($user['password']);
                echo "<br /><br />";
                print_r(md5($password));                                 
                echo "</pre>";
                
                if(md5($password) == $user['password'] ) {
                    echo "<h3>we're in business, do stuff!</h3>";
                    
                    //set the authenticated flag
                    $userInfo['auth'] = 'true';
                    $userInfo['username'] = $username;
                    $userInfo['personid'] = $user['personid'];
                    
                    // pull in firstname and lastname
                    
                    $sql = "SELECT firstname, lastname FROM people " .
                    "WHERE id='" . $user['personid'] ."'";       
                    
                    $data = $this->doQuery($sql);
                    
                    $userInfo['firstname'] = $data[0]['firstname'];
                    $userInfo['lastname'] = $data[0]['lastname'];
                    
                    /*echo "<pre>";
                    print_r($data);
                    echo "</pre>";
                    echo "<hr><hr>$sql";
                    die;*/
                    
                    // set the session 
                    Session::set('user', $userInfo);
                    
                } else {
                    // username is right but password is wrong
                    echo "<h1>access denied!</h1>";
                }                
            } else {
                echo "<h1>access denied!</h1>";
            }
            

            //die;
        }
        return;
    }

    function doLogout() {

        Session::set('user', null);
        return;
    }

}
