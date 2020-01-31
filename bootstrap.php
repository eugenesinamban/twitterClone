<?php 

require __DIR__ . "/vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
$twig = new \Twig\Environment($loader,['debug' => True]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

?>