<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once(__DIR__ . '/../../vendor/autoload.php');

	require_once(__DIR__ . '/../../config/regex.php');
	require_once(__DIR__ . '/../../config/config.php');
	require_once(__DIR__ . '/../../helpers/testInputs.php');
	require_once(__DIR__ . '/../../models/Reservation.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'contact.annexe.restaurant@gmail.com';                     //SMTP username
		$mail->Password   = 'Motdepasse1507';                               //SMTP password
		$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('contact.annexe.restaurant@gmail.com', 'Mailer');
		$mail->addAddress('crigaux057@gmail.com', 'Joe User');     //Add a recipient
		// $mail->addAddress('ellen@example.com');               //Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		//Attachments
		// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	die();
	if(explode('/', $_SERVER['REQUEST_URI'])[3] == 'edit'){

		$id = intval($id);

		$reservation = Reservation::get($id);
		$date = date('Y-m-d', strtotime($reservation->reservation_date));
		$time = date('H:i', strtotime($reservation->reservation_date));
		if($time == '12:00'){
			$time = '1';
		} else {
			$time = '2';
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$validation = intval(filter_input(INPUT_POST, 'validation', FILTER_SANITIZE_NUMBER_INT));
			$nbOfClients = intval(filter_input(INPUT_POST, 'nbOfClients', FILTER_SANITIZE_NUMBER_INT));
			$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
			$time = intval(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT));
			
			if(testInput($validation, TIME_REGEX) != 'true') {
				$errors['validation'] = testInput($validation, TIME_REGEX);
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

			if($validation == 1 && $reservation->validated_at == NULL){
				$validation = date('Y-m-d H:i:s', time());
			} else if($validation == 2) {
				$validation = NULL;
			} else {
				$validation = $reservation->validated_at;
			}


			if($time == 1) {
				$datetime = $date . ' 12:00:00';
			} else {
				$datetime = $date . ' 19:00:00';
			}

			if(empty($errors)) {
				$reservationUpdated = new Reservation($nbOfClients, $datetime, $id, $validation);
				if($reservationUpdated->update($id)){
					if($reservation->validated_at == NULL && $validation != NULL){
						// Envoie d'un mail de confirmation de réservation

					}
					SessionFlash::set('updated', 'Votre réservation a bien été modifiée.');
					header('Location: /admin/reservations');
					exit();
				} else {
					SessionFlash::set('error', 'La réservation n\'a pas pu être modifiée.');
					header('Location: /admin/reservations');
					exit();
				}
			}
		}
		include(__DIR__ . '/../../views/admin/dashboard.php');
		include(__DIR__ . '/../../views/admin/dbModifyReservation.php');
	} else if(explode('/', $_SERVER['REQUEST_URI'])[3] == 'delete'){
		$id = intval($id);

		$reservation = Reservation::get($id);

		if(Reservation::delete($id) === true) {
			SessionFlash::set('deleted', 'La réservation a bien été supprimée.');
			header('Location: /admin/reservations');
			exit();
		} else {
			SessionFlash::set('error', 'La réservation n\'a pas pu être supprimée.');
			header('Location: /admin/reservations');
			exit();
		}
	}