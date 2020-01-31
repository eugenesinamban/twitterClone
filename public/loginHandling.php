<?php 

session_start();

require_once "../lib/models/Users.php";

try {

    $parameters = [

        'email',
        'password'

    ];

    foreach ($parameters as $param) {

        $objects[$param] = $_POST[$param];

    }
    
    Users::login($objects);

    header("location:/twitterClone/public/index.php");

} catch (Exception $e) {

    $_SESSION['error']['message'] = $e->getMessage();
    header("location:/twitterClone/index.php?error=on");

}


?>