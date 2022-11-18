<?php

	require_once(__DIR__.'/../../models/Dish.php');

	$patients = Dish::getAll();
	echo json_encode($patients);