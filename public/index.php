<?php 

session_start();

require_once "../bootstrap.php";
require_once "../lib/models/Posts.php";
require_once "../lib/models/Utilities.php";

$posts = new Posts();
$utilities = new Utilities();

$viewVars = [

    'posts' => $posts,
    'utilities' => $utilities

];

echo $twig->render('/public/index.twig', $viewVars);


?>