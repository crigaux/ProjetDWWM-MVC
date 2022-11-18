<?php
	require_once(__DIR__ . '/../../models/Order.php');
	require_once(__DIR__ . '/../../models/Reservation.php');
	require_once(__DIR__ . '/../../config/regex.php');
	require_once(__DIR__ . '/../../config/config.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

	$reservations = Reservation::getAll('orders');

	include(__DIR__ . '/../../views/admin/dashboard.php');
	include(__DIR__ . '/../../views/admin/dbOrders.php');