<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/src/auth.php';

session_start();

// If user is already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: /dashboard.php');
    exit();
}

$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new \Twig\Environment($loader);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $errors['general'] = 'Email and password are required.';
    } else {
        $result = login($email, $password);
        if ($result['success']) {
            header('Location: /dashboard.php');
            exit();
        } else {
            $errors['general'] = $result['message'];
        }
    }
}

echo $twig->render('login.html.twig', [
    'errors' => $errors,
    'session' => getSession()
]);
