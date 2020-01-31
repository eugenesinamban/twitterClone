<?php 

session_start();

// require_once "../bootstrap.php";
require_once "../lib/models/Posts.php";

try {

    Posts::insert(['post' => $_POST['post'], 'userId' => $_SESSION['auth']['id']]);

    header("location:./index.php");

} catch (Exception $e) {

    $_SESSION['error']['message'] = $e->getMessage();
    header('location:./index.php?error=on');

}

?>