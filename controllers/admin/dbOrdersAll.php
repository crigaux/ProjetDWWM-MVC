<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once(__DIR__ . '/../../vendor/autoload.php');

	require_once(__DIR__ . '/../../config/regex.php');
	require_once(__DIR__ . '/../../config/config.php');
	require_once(__DIR__ . '/../../helpers/testInputs.php');
	require_once(__DIR__ . '/../../models/Reservation.php');
	require_once(__DIR__ . '/../../models/Order.php');
	require_once(__DIR__ . '/../../models/Dish.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

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

		$orders = Order::get($reservation->id);
		$dishes = Dish::getAll();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$validation = intval(filter_input(INPUT_POST, 'validation', FILTER_SANITIZE_NUMBER_INT));
			$userId = intval(filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT));
			$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
			$time = intval(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT));
			$dishesList = filter_input(INPUT_POST, 'dishesNames', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
			$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

			if(testInput($validation, TIME_REGEX) != 'true') {
				$errors['validation'] = testInput($validation, TIME_REGEX);
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
				$error = [];
				for($i = 0 ; $i < count($dishesList) ; $i++) {
					$orderUpdated = new Order($quantity[$i], $dishesList[$i], $id);
					if($orderUpdated->update($orders[$i]->id) == false) {
						$error['update'] = true;
					}
				}

				$reservationUpdated = new Reservation(0, $datetime, $reservation->id_users, $validation);
				if($reservationUpdated->update($id) == false) {
					$error['update'] = true;
				}

				if($error['update'] == true){
					if($reservation->validated_at == NULL && $validation != NULL){
						$message ='Bonjour ' . $reservation->firstname . ' ' . $reservation->lastname . ', <br> Votre réservation du ' . $formatDate->format(strtotime($reservation->reservation_date)) . ' a été validée. <br>
						Détail de votre commande : <br><br>';
						foreach ($orders as $order) {
							$message .= $order->quantity . ' x <strong>' . $order->title . '</strong><br>';
						}
						$message .= '<br>Votre commande sera prête à votre arrivée !';

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
							$mail->addAddress($reservation->email);     //Add a recipient
							// $mail->addAddress('ellen@example.com');               //Name is optional
							// $mail->addReplyTo('info@example.com', 'Information');
							// $mail->addCC('cc@example.com');
							// $mail->addBCC('bcc@example.com');
					
							//Attachments
							// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
							// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
					
							//Content
							$mail->isHTML(true);                                  //Set email format to HTML
							$mail->Subject = 'Votre réservation a été validée';
							$mail->Body    = $message;
							// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					
							$mail->send();
							echo 'Message has been sent';
						} catch (Exception $e) {
							echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}
					}
					SessionFlash::set('updated', 'Votre commande a bien été modifiée.');
					header('Location: /admin/commandes');
					exit();
				} else {
					SessionFlash::set('errorMessage', 'La commande n\'a pas pu être modifiée.');
					header('Location: /admin/commandes');
					exit();
				}
			}
		}
		include(__DIR__ . '/../../views/admin/dashboard.php');
		include(__DIR__ . '/../../views/admin/dbModifyOrders.php');
	} else if(explode('/', $_SERVER['REQUEST_URI'])[3] == 'delete'){
		$id = intval($id);

		$reservation = Order::get($id);

		if(Order::delete($id) === true) {
			SessionFlash::set('deleted', 'La réservation a bien été supprimée.');
			header('Location: /admin/commandes');
			exit();
		} else {
			SessionFlash::set('error', 'La réservation n\'a pas pu être supprimée.');
			header('Location: /admin/commandes');
			exit();
		}
	}