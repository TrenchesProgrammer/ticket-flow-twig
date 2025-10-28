<?php

// src/tickets.php

define('TICKETS_FILE', dirname(__DIR__) . '/data/tickets.json');

function getTickets(): array {
    if (!file_exists(TICKETS_FILE)) {
        return [];
    }
    $json = file_get_contents(TICKETS_FILE);
    return json_decode($json, true) ?: [];
}

function getUserTickets(string $email): array {
    $allTickets = getTickets();
    return array_filter($allTickets, function($ticket) use ($email) {
        return $ticket['user'] === $email;
    });
}

function saveTickets(array $tickets): void {
    file_put_contents(TICKETS_FILE, json_encode($tickets, JSON_PRETTY_PRINT));
}

function addTicket(string $userEmail, string $title, string $description): void {
    $tickets = getTickets();
    $newTicket = [
        'id' => uniqid('TICKET-'),
        'user' => $userEmail,
        'title' => $title,
        'description' => $description,
        'status' => 'open',
        'date' => date('Y-m-d'),
    ];
    $tickets[] = $newTicket;
    saveTickets($tickets);
}

function updateTicket(string $ticketId, string $description, string $status): void {
    $tickets = getTickets();
    foreach ($tickets as &$ticket) {
        if ($ticket['id'] === $ticketId) {
            $ticket['description'] = $description;
            $ticket['status'] = $status;
            break;
        }
    }
    saveTickets($tickets);
}

function deleteTicket(string $ticketId): void {
    $tickets = getTickets();
    $tickets = array_filter($tickets, function($ticket) use ($ticketId) {
        return $ticket['id'] !== $ticketId;
    });
    saveTickets(array_values($tickets));
}
