<?php 

class Config {

    public static function dbConfig() : array {
        $host = 'localhost';
        $db = 'twitterclone';
        $user = 'root';
        $pass = '';
        $config = ['db' => $db, 'host' => $host, 'user' => $user, 'pass' => $pass];
        return $config;
    }
}

?>