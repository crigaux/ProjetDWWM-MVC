<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $password = filter_input(INPUT_POST, 'password');

        
    }

    include(__DIR__ . '/../views/templates/nav.php');
    include(__DIR__ . '/../views/connection.php');