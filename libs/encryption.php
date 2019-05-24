<?php

/*
 *   simple encryption hiding passwords in session
 * 
 *   usage :-
 * 
 *     $iv = Encryption::getIV();
 *     $encpwd  = Encryption::encrypt("text to encrypt!", $iv);
 * 
 *     $iv needs to be stored along with the encrypted data
 *   
 *     $pwd = Encryption::decrypt($encpwd, $iv);
 * 
 */

class Encryption {
    function __construct() {       
    }

    public static function getIV() {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
    }
    
    public static function encrypt($data, $iv) {
        return  openssl_encrypt($data, AES_256_CBC, ENCRYPTION_KEY, 0, $iv);
    }

    public static function decrypt($data, $iv) {
        return openssl_decrypt($data, AES_256_CBC, ENCRYPTION_KEY, 0, $iv);
    }
}