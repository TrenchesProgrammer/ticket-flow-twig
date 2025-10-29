<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/src/auth.php';
require_once dirname(__DIR__) . '/src/tickets.php';

session_start();

// If user is not logged in, redirect to login page
if (!isLoggedIn()) {
    header('Location: /login.php');
    exit();
}

$session = getSession();
$userEmail = $session['email'];
$userTickets = getUserTickets($userEmail);

$ticketCounts = [
    'total' => count($userTickets),
    'open' => count(array_filter($userTickets, fn($t) => $t['status'] === 'open')),
    'in_progress' => count(array_filter($userTickets, fn($t) => $t['status'] === 'in_progress')),
    'closed' => count(array_filter($userTickets, fn($t) => $t['status'] === 'closed')),
];

// Sort tickets by date in descending order
usort($userTickets, function ($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

$recentTickets = array_slice($userTickets, 0, 5);

$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('dashboard.html.twig', [
    'session' => $session,
    'ticketCounts' => $ticketCounts,
    'recentTickets' => $recentTickets,
    'currentPage' => 'dashboard',
    'flash_message' => getFlashMessage()
]);
