<?php
require_once(__DIR__ . '/../../models/User.php');
require_once(__DIR__ . '/../../config/regex.php');
require_once(__DIR__ . '/../../helpers/testInputs.php');

$user = User::get(id: $_SESSION['user']->id);

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
	} else if (User::isExist($email) == true && $email != $_SESSION['user']->email) {
		$errors['email'] = 'Cet email est déjà utilisé';
	}

	$phoneNb = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
	if (testInput($phoneNb, PHONE_REGEX) != 'true') {
		$errors['phoneNb'] = testInput($phoneNb, PHONE_REGEX);
	}

	$newsletter = intval(filter_input(INPUT_POST, 'newsletter', FILTER_SANITIZE_NUMBER_INT));
	if ($newsletter != 1 && $newsletter != NULL) {
		$errors['newsletter'] = 'format non reconnu';
	}

	$password = User::passwordVerification($_SESSION['user']->email);
	
	if (empty($errors)) {
		$user = new User($lastname, $firstname, $email, $phoneNb, 0, $newsletter);

		if ($user->update($_SESSION['user']->id) == true) {
			header('Location: /profil');
			exit();
		} else {
			SessionFlash::set('error', 'Une erreur est survenue lors de l\'enregistrement de votre compte');
			header('Location: /profil');
			exit();
		}
	}
}

include(__DIR__ . '/../../views/user/userHeader.php');
include(__DIR__ . '/../../views/user/userProfil.php');
