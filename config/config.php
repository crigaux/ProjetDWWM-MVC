<?php

	define('DSN', 'mysql:host=localhost;dbname=annexe;charset=utf8');
	define('USER', 'annexe_user');
	define('PWD', 'UIeO.E73q60e8C(W');

	// Gestion des dates et heures en français

	$formatHour = new IntlDateFormatter(
		locale: 'fr_FR',
		pattern: "HH'h'mm"
	);

	$formatDate = new IntlDateFormatter(
		locale: 'fr_FR',
		pattern: 'EEEE d MMMM yyyy'
	);