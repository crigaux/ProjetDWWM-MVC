<?php
    require_once(__DIR__ . '/../config/regex.php');
    require_once(__DIR__ . '/../helpers/testInputs.php');

    $errors =[];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
        $phoneNb = trim(filter_input(INPUT_POST, 'phoneNb', FILTER_SANITIZE_NUMBER_INT));
        $password = filter_input(INPUT_POST, 'password');
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
        $cgu = filter_input(INPUT_POST, 'cgu', FILTER_SANITIZE_NUMBER_INT);
        $newsletter = filter_input(INPUT_POST, 'newsletter', FILTER_SANITIZE_NUMBER_INT);

        if(testInput($name, NAME_REGEX) != 'true') {
            $errors['name'] = testInput($name, NAME_REGEX);
        }
        if(testInput($firstname, NAME_REGEX) != 'true') {
            $errors['firstname'] = testInput($firstname, NAME_REGEX);
        }
        if(testInput($email, MAIL_REGEX) != 'true') {
            $errors['email'] = testInput($email, MAIL_REGEX);
        }
        if(testInput($phoneNb, PHONE_REGEX) != 'true') {
            $errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
        }
        if(testInput($password, PWD_REGEX) != 'true') {
            $errors['password'] = testInput($password, PWD_REGEX);
        }
        if(testInput($confirmPassword, PWD_REGEX) != 'true') {
            $errors['confirmPassword'] = testInput($confirmPassword, PWD_REGEX);
        }
        
        if($password != $confirmPassword) {
            $errors['password'] = 'Les deux mots de passes doivent correspondre';
        }

        if($cgu == NULL) {
            $errors['cgu'] = 'champ obligatoire';
        } else if($cgu != 1 && $cgu != NULL) {
            $errors['cgu'] = 'format non reconnu';
        }

        if($newsletter == NULL) {
            $errors['newsletter'] = 'champ obligatoire';
        } else if($newsletter != 1 && $cnewslettergu != NULL) {
            $errors['newsletter'] = 'format non reconnu';
        }

        if(empty($errors)) {
            header('Location: ./connectionController.php');
            exit();
        } else {
            var_dump($errors);
        }

    }

    include(__DIR__ . '/../views/templates/nav.php');
    include(__DIR__ . '/../views/register.php');