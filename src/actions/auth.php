<?php

require_once __DIR__ . '/../lib/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['action'])) {
        die('Action is required');
    }

    switch ($_POST['action']) {
        case 'sign-up':
            Auth::register($_POST['username'], $_POST['password']);
            break;
        case 'log-in':
            Auth::logIn($_POST['username'], $_POST['password']);
            break;
        case 'log-out':
            Auth::logOut();
            break;
        case 'delete':
            Auth::deleteUser();
            break;
    }
}
