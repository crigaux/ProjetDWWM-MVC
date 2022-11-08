<?php
	require_once(__DIR__ . '/../../models/Dish.php');
	require_once(__DIR__ . '/../../config/regex.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors =[];

		$type = intval(trim(filter_input(INPUT_GET, 'type', FILTER_SANITIZE_NUMBER_INT)));

		$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
		$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		$desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(empty($title) || empty($price) || empty($desc)) {
			$errors['empty'] = 'Veuillez remplir tous les champs';
		}

		if(empty($errors)){
			$dish = new Dish($title, $price, $desc, 1, $type);
			$dish->create();

			header('location: /controllers/admin/dbMenuController.php?added=1');
			exit;
			$message = 'Patient ajouté.';
		}
	}
	
	include(__DIR__ . '/../../views/admin/dashboard.php');
	include(__DIR__ . '/../../views/admin/dbAddMenu.php');