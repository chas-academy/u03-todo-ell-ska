<?php

use App\Controllers\Lists;

require_once __DIR__ . '/../controllers/lists.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['action'])) {
        die('Action is required');
    }

    switch ($_POST['action']) {
        case 'create':
            Lists::create($_POST['name']);
            break;
        case 'delete':
            Lists::delete($_POST['id']);
            break;
    }
}
