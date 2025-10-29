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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        if (!empty($title) && !empty($description)) {
            addTicket($userEmail, $title, $description);
            setFlashMessage('success', 'Ticket added successfully!');
        } else {
            setFlashMessage('error', 'Title and description cannot be empty.');
        }
    } elseif ($action === 'update') {
        $ticketId = $_POST['ticket_id'] ?? '';
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? '';
        if (!empty($ticketId) && !empty($description) && !empty($status)) {
            updateTicket($ticketId, $description, $status);
            setFlashMessage('success', 'Ticket updated successfully!');
        } else {
            setFlashMessage('error', 'Ticket ID, description, and status cannot be empty.');
        }
    } elseif ($action === 'delete') {
        $ticketId = $_POST['ticket_id'] ?? '';
        if (!empty($ticketId)) {
            deleteTicket($ticketId);
            setFlashMessage('success', 'Ticket deleted successfully!');
        } else {
            setFlashMessage('error', 'Ticket ID cannot be empty.');
        }
    }

    header('Location: /tickets.php');
    exit();
}

$userTickets = getUserTickets($userEmail);

$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('tickets.html.twig', [
    'session' => $session,
    'tickets' => $userTickets,
    'currentPage' => 'tickets',
    'flash_message' => getFlashMessage()
]);
