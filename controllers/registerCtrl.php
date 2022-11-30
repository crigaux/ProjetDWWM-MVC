<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../vendor/autoload.php');

require_once(__DIR__ . '/../config/regex.php');
require_once(__DIR__ . '/../helpers/testInputs.php');
require_once(__DIR__ . '/../helpers/SessionFlash.php');
require_once(__DIR__ . '/../models/User.php');

if (isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lastname = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    if (testInput($lastname, NAME_REGEX) != 'true') {
        $errors['name'] = testInput($lastname, NAME_REGEX);
    }

    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
    if (testInput($firstname, NAME_REGEX) != 'true') {
        $errors['firstname'] = testInput($firstname, NAME_REGEX);
    }

    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
    if (testInput($email, MAIL_REGEX) != 'true') {
        $errors['email'] = testInput($email, MAIL_REGEX);
    } else if (User::isExist($email) == true) {
        $errors['email'] = 'Cet email est déjà utilisé';
    }

    $phoneNb = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
    if (testInput($phoneNb, PHONE_REGEX) != 'true') {
        $errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
    }

    $password = $_POST['password'];
    if (testInput($password, PWD_REGEX) != 'true') {
        $errors['password'] = testInput($password, PWD_REGEX);
    }

    $confirmPassword = $_POST['confirmPassword'];
    if ($password != $confirmPassword) {
        $errors['password'] = 'Les deux mots de passes doivent correspondre';
    }

    $cgu = filter_input(INPUT_POST, 'cgu', FILTER_SANITIZE_NUMBER_INT);
    if ($cgu == NULL) {
        $errors['cgu'] = 'champ obligatoire';
    } else if ($cgu != 1 && $cgu != NULL) {
        $errors['cgu'] = 'format non reconnu';
    }

    $newsletter = intval(filter_input(INPUT_POST, 'newsletter', FILTER_SANITIZE_NUMBER_INT));
    if ($newsletter != 1 && $newsletter != NULL) {
        $errors['newsletter'] = 'format non reconnu';
    }

    if (empty($errors)) {
        $user = new User($lastname, $firstname, $email, $phoneNb, 0, $newsletter);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user->setPassword($password);

        if ($user->create() == true) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'contact.annexe.restaurant@gmail.com';                     //SMTP username
                $mail->Password   = 'fldfoxotvybsynuo';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('contact.annexe.restaurant@gmail.com', 'Restaurant l\'Annexe');
                $mail->addAddress($email);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Votre inscription a bien été prise en compte';
                $mail->Body    = 'Bonjour ' . $firstname . ' ' . $lastname . ',<br> Nous sommmes ravis de vous compter parmis nos clients. <br> Nous vous attendons avec impatience !';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
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
