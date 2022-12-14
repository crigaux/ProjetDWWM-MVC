<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../../vendor/autoload.php');

require_once(__DIR__ . '/../../models/Review.php');
require_once(__DIR__ . '/../../helpers/SessionFlash.php');
require_once(__DIR__ . '/../../helpers/testInputs.php');
require_once(__DIR__ . '/../../config/regex.php');

// ###############################################################################
// ###                    TEST SI L'UTILISATEUR EST UN ADMIN                   ###
// ###############################################################################

if ((isset($_SESSION) && $_SESSION['user']->admin != 1) || !isset($_SESSION)) {
	header('Location: /');
	exit;
}

// ###############################################################################
// ###                         AFFICHAGE DU DASHBOARD                          ###	
// ###############################################################################

if ($_SERVER['REQUEST_URI'] == '/admin/commentaires') {
	$reviews = Review::getAll();

	include(__DIR__ . '/../../views/admin/templates/dbHeader.php');
	include(__DIR__ . '/../../views/admin/dbReview.php');
	include(__DIR__ . '/../../views/admin/templates/dbFooter.php');
}

// ###############################################################################
// ###                       VALIDATION DU COMMENTAIRE                         ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/commentaire/edit/validate/' . $id) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id = intval($id);
		$errors = [];

		$validate = filter_input(INPUT_POST, 'validate', FILTER_SANITIZE_EMAIL);

		if (testInput($validate, MAIL_REGEX) == 'true') {
			if (review::moderate($id) == true) {
				$review = review::get($id);
				$mail = new PHPMailer(true);

				try {
					//Server settings
					$mail->CharSet = 'UTF-8';
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
					$mail->isSMTP();                                            //Send using SMTP
					$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
					$mail->Username   = 'contact.annexe.restaurant@gmail.com';                     //SMTP username
					$mail->Password   = 'ctaikohsrkluybqu';                               //SMTP password
					$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
					$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

					//Recipients
					$mail->setFrom('contact.annexe.restaurant@gmail.com', 'Restaurant l\'Annexe');
					$mail->addAddress($validate);     //Add a recipient
					// $mail->addAddress('ellen@example.com');               //Name is optional
					// $mail->addReplyTo('info@example.com', 'Information');
					// $mail->addCC('cc@example.com');
					// $mail->addBCC('bcc@example.com');

					//Attachments
					// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
					// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

					//Content
					$mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = 'Votre commentaire a ??t?? valid??';
					$mail->Body    = 'Bonjour ' . $review->firstname . ' ' . $review->lastname . ',<br> nous avons bien re??u votre commentaire. <br> Nous vous remercions pour l\'int??r??t que vous portez ?? notre ??tablissement et esp??rons vous revoir bient??t!';
					// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->send();
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}

				SessionFlash::set('message', 'Le commentaire a bien ??t?? valid??');
				header('Location: /admin/commentaires');
				exit;
			} else {
				SessionFlash::set('error', 'Le commentaire n\'a pas pu ??tre valid??');
				header('Location: /admin/commentaires');
				exit;
			}
		} else {
			SessionFlash::set('error', 'Le commentaire n\'a pas pu ??tre valid??');
			header('Location: /admin/commentaires');
			exit;
		}
	}
}

// ###############################################################################
// ###                         SUPPRIME UN COMMENTAIRE                         ###	
// ###############################################################################

else if ($_SERVER['REQUEST_URI'] == '/admin/commentaire/delete/' . $id) {
	$id = intval($id);

	if (Review::delete($id) == true) {
		SessionFlash::set('message', 'Le commentaire a bien ??t?? supprim??');
		header('Location: /admin/commentaires');
		exit;
	} else {
		SessionFlash::set('error', 'Le commentaire n\'a pas pu ??tre supprim??');
		header('Location: /admin/commentaires');
		exit;
	}
}
