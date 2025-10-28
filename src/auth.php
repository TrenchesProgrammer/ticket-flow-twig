<?php

// src/auth.php

define('USERS_FILE', dirname(__DIR__) . '/data/users.json');

function getUsers(): array {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $json = file_get_contents(USERS_FILE);
    return json_decode($json, true) ?: [];
}

function saveUsers(array $users): void {
    $json = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents(USERS_FILE, $json);
}

function signup(string $fullname, string $email, string $password): array {
    $users = getUsers();

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return ['success' => false, 'message' => 'Email already exists'];
        }
    }

    $newUser = [
        'fullname' => $fullname,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT) // Always hash passwords
    ];
    $users[] = $newUser;
    saveUsers($users);

    // Automatically log in the user after signup
    createSession($email, $fullname);

    return ['success' => true, 'message' => 'Signup successful'];
}

function login(string $email, string $password): array {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            createSession($user['email'], $user['fullname']);
            return ['success' => true, 'message' => 'Login successful'];
        }
    }
    return ['success' => false, 'message' => 'Invalid credentials'];
}

function createSession(string $email, string $fullname): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['email'] = $email;
    $_SESSION['fullname'] = $fullname;
}

function logout(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
}

function getSession(): ?array {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['email']) && isset($_SESSION['fullname'])) {
        return [
            'email' => $_SESSION['email'],
            'fullname' => $_SESSION['fullname'],
        ];
    }
    return null;
}

function isLoggedIn(): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['email']);
}
