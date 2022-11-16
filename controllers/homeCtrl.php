<?php
    require_once(__DIR__ . '/../config/regex.php');
    require_once(__DIR__ . '/../helpers/testInputs.php');
    require_once(__DIR__ . '/../models/Reservation.php');
    require_once(__DIR__ . '/../helpers/SessionFlash.php');

    $isOnHome = true;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors =[];

        $form = trim(filter_input(INPUT_POST, 'form', FILTER_SANITIZE_NUMBER_INT));
        
        if($form == 1) {
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
            $phoneNb = trim(filter_input(INPUT_POST, 'phoneNb', FILTER_SANITIZE_NUMBER_INT));
            $nbOfClients = intval(filter_input(INPUT_POST, 'nbOfClients', FILTER_SANITIZE_NUMBER_INT));
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
            $time = intval(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT));
            
            if(testInput($name, NAME_REGEX) != 'true') {
                $errors['name'] = testInput($name, NAME_REGEX);
            }
            if(testInput($phoneNb, PHONE_REGEX) != 'true') {
                $errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
            }
            if(testInput($nbOfClients, NB_REGEX) != 'true') {
                $errors['nbOfClients'] = testInput($nbOfClients, NB_REGEX);
            }
            if(testInput($date, DATE_REGEX) != 'true') {
                $errors['date'] = testInput($date, DATE_REGEX);
            }
            if(testInput($time, TIME_REGEX) != 'true') {
                $errors['time'] = testInput($time, TIME_REGEX);
            }

            if($time == 1) {
                $datetime = $date . ' 12:00:00';
            } else {
                $datetime = $date . ' 19:00:00';
            }

            if(empty($errors)) {
                $reservation = new Reservation($nbOfClients, $datetime, 2);
                $reservation->create();
                SessionFlash::set('added', 'Votre réservation a bien été prise en compte.');
            }

        } else if($form == 2) {
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
            $phoneNb = trim(filter_input(INPUT_POST, 'phoneNb', FILTER_SANITIZE_NUMBER_INT));
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
            $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT);
            $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
            $quantity = trim(filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_SPECIAL_CHARS));
            
            if(testInput($name, NAME_REGEX) != 'true') {
                $errors['name'] = testInput($name, NAME_REGEX);
            }
            if(testInput($phoneNb, PHONE_REGEX) != 'true') {
                $errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
            }
            if(testInput($date, DATE_REGEX) != 'true') {
                $errors['date'] = testInput($date, DATE_REGEX);
            }
            if(testInput($time, TIME_REGEX) != 'true') {
                $errors['time'] = testInput($time, DATE_REGEX);
            }
        }
    }

    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/home.php');
    include(__DIR__ . '/../views/templates/footer.php');