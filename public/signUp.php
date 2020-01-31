<?php 

session_start();

// var_dump($_SESSION);

require_once "../bootstrap.php";
require_once "../lib/models/Users.php";

$parameters = [

    'email',
    'password',
    'name'

];



try {
    
    foreach ($parameters as $param) {
        
        $_SESSION['signUp'][$param] = $_POST[$param] ?? null;
        
        if ($_SESSION['signUp'][$param] === null) {

            throw new Exception('Invalid input!');

        }

    }

    $viewVars = [

        'confirmVars' => $_SESSION['signUp']

    ];

    echo $twig->render('signUp.twig', $viewVars);

} catch (Exception $e) {

    $_SESSION['error']['message'] = $e->getMessage();
    header('url:/twitterClone/index.php?error=on');

}

?>