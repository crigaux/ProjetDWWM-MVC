<?php
	require_once(__DIR__ . '/../../models/Dish.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

	if(isset($_GET['added'])){
		$added = intval(trim(filter_input(INPUT_GET, 'added', FILTER_SANITIZE_NUMBER_INT)));
	}

	$starters = Dish::getAll(1);
	$dishes = Dish::getAll(2);
	$desserts = Dish::getAll(3);

	include(__DIR__ . '/../../views/admin/dashboard.php');
	include(__DIR__ . '/../../views/admin/dbMenu.php');