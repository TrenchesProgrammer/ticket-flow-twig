<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/src/auth.php';

session_start();

$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.html.twig', [
    'name' => 'World',
    'session' => getSession(),
    'currentPage' => 'home',
]);
