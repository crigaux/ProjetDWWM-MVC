<?php
	require_once(__DIR__ . '/../models/Dish.php');

    $isOnMenu = true;
    
    $starters = Dish::getAllValidated(1);
	$dishes = Dish::getAllValidated(2);
	$desserts = Dish::getAllValidated(3);

    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/menu.php');
    include(__DIR__ . '/../views/templates/footer.php');