<?php 

session_start();

require_once "../lib/models/Users.php";

try {

    Users::signUp($_SESSION['signUp']);

    $_SESSION['signUp'] = [];

    header('location:/twitterClone/index.php');

} catch (Exception $e) {

    $_SESSION['error']['message'] = $e->getMessage();
    header('location:/twitterClone/index.php?error=on');

}

?>