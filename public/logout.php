<?php

require_once dirname(__DIR__) . '/src/auth.php';

logout();
header('Location: /login.php');
exit();
