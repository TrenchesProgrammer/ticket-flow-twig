<?php

require_once dirname(__DIR__) . '/src/auth.php';

logout();
setFlashMessage('success', 'You have been successfully logged out.');
header('Location: /login.php');
exit();
