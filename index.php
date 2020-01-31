<?php 

session_start();

require "bootstrap.php";

$error = $_SESSION['error'] ?? null;

$viewVars = [

    'error' => $error

];

echo $twig->render('index.twig', $viewVars);

$_SESSION = [];

?>