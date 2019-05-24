<?php

class LdapWrapper {

    private $auth_username;
    private $auth_password;
    private $auth_upn;
    private $ds;
    private $credentialsValid;

    function __construct($user, $password) {
        $this->auth_username = $user;
        $this->auth_password = $password;
        $this->auth_upn = $user . LDAP_UPN_POSTFIX;
        $this->ds = ldap_connect(LDAP_HOST, LDAP_PORT) or die("LDAP didn't connecte!");
        ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    }

    public function doAuthenticate() {
        //echo "<br />DOAUTH()<br />";
        //echo "this->auth_upn: " . $this->auth_upn . "<br />";
        //echo "this->auth_password: "     . $this->auth_password . "<br />";
        if (@ldap_bind($this->ds, $this->auth_upn, $this->auth_password)) {
            // log in successful "; 
            $this->credentialsValid = true;
            return true;
        } else {
            // didn't work;
            $this->credentialsValid = false;
            return false;
        }
    }

    function getLastnameInfo($search) {
        $this->doAuthenticate();
        $filter = '(sn=' . $search . '*)';
        $searchRes = ldap_search($this->ds, LDAP_BASEDN, $filter);
        ldap_sort($this->ds, $searchRes, 'givenname');

        $info = ldap_get_entries($this->ds, $searchRes);

        $count = $info['count'];
        //echo 'RESULT COUNT: '.$count.'<br />';


        if ($count > 0) {
            for ($b = 0; $b < $count; $b++) {
                @$output[$b]['firstname'] = $info[$b]['givenname'][0];
                @$output[$b]['lastname'] = $info[$b]['sn'][0];
                @$output[$b]['mail'] = $info[$b]['mail'][0];
                @$output[$b]['tel'] = $info[$b]['telephonenumber'][0];
                @$output[$b]['dept'] = $info[$b]['department'][0];
                @$output[$b]['division'] = $info[$b]['division'][0];
                @$output[$b]['type'] = $info[$b]['extensionattribute1'][0];
                @$output[$b]['username'] = $info[$b]['samaccountname'][0];
                @$output[$b]['dn'] = $info[$b]['dn'][0];
                @$output[$b]['cn'] = $info[$b]['cn'][0];
            }
            
          //  echo "<pre>";
           // print_r($output);
           // echo "</pre>";
           // die();

            return $output;
        } else {
            return null;
        }
    }

    function getUsernameInfo($search = null) {

        if ($search == null) {
            $search = $this->auth_username;
        }

        $this->doAuthenticate();

        $filter = '(sAMAccountName=' . $search . ')';
        $searchRes = ldap_search($this->ds, LDAP_BASEDN, $filter);

        $info = ldap_get_entries($this->ds, $searchRes);

        
        // load return values into array, surpress errors for missing info
        $output = @array(
            'firstname' => $info[0]['givenname'][0],
            'lastname' => $info[0]['sn'][0],
            'mail' => $info[0]["mail"][0],
            'tel' => $info[0]['telephonenumber'][0],
            'dept' => $info[0]['department'][0],
            'division' => $info[0]['division'][0],
            'type' => $info[0]['extensionattribute1'][0],
            'username' => $search
        );

        //return($info);
        return($output);
    }

}
