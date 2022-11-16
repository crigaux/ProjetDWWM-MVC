<?php
	require_once(__DIR__ . '/../../models/Dish.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

	$starters = Dish::getAll(1);
	$dishes = Dish::getAll(2);
	$desserts = Dish::getAll(3);

	include(__DIR__ . '/../../views/admin/dashboard.php');
	include(__DIR__ . '/../../views/admin/dbMenu.php');