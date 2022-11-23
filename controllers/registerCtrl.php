<?php
    require_once(__DIR__ . '/../config/regex.php');
    require_once(__DIR__ . '/../helpers/testInputs.php');
    require_once(__DIR__ . '/../helpers/SessionFlash.php');
    require_once(__DIR__ . '/../models/User.php');

    if(isset($_SESSION['user'])) {
        header('Location: /');
        exit();
    }
    
    $errors =[];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $lastname = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
        if(testInput($lastname, NAME_REGEX) != 'true') {
            $errors['name'] = testInput($lastname, NAME_REGEX);
        }

        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        if(testInput($firstname, NAME_REGEX) != 'true') {
            $errors['firstname'] = testInput($firstname, NAME_REGEX);
        }

        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
        if(testInput($email, MAIL_REGEX) != 'true') {
            $errors['email'] = testInput($email, MAIL_REGEX);
        } else if(User::isExist($email) == true) {
            $errors['email'] = 'Cet email est déjà utilisé';
        }

        $phoneNb = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
        if(testInput($phoneNb, PHONE_REGEX) != 'true') {
            $errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
        }

        $password = $_POST['password'];
        if(testInput($password, PWD_REGEX) != 'true') {
            $errors['password'] = testInput($password, PWD_REGEX);
        }

        $confirmPassword = $_POST['confirmPassword'];
        if($password != $confirmPassword) {
            $errors['password'] = 'Les deux mots de passes doivent correspondre';
        }

        $cgu = filter_input(INPUT_POST, 'cgu', FILTER_SANITIZE_NUMBER_INT);
        if($cgu == NULL) {
            $errors['cgu'] = 'champ obligatoire';
        } else if($cgu != 1 && $cgu != NULL) {
            $errors['cgu'] = 'format non reconnu';
        }

        $newsletter = intval(filter_input(INPUT_POST, 'newsletter', FILTER_SANITIZE_NUMBER_INT));
        if($newsletter != 1 && $newsletter != NULL) {
            $errors['newsletter'] = 'format non reconnu';
        }

        if(empty($errors)) {
            $user = new User($lastname, $firstname, $email, $phoneNb, 0, $newsletter);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user->setPassword($password);
            
            if($user->create() == true) {
                header('Location: /connexion');
                exit();
            } else {
                SessionFlash::set('error', 'Une erreur est survenue lors de l\'enregistrement de votre compte');
                header('Location: /inscription');
                exit();
            }
        }

    }

    include(__DIR__ . '/../views/templates/nav.php');
    include(__DIR__ . '/../views/register.php');