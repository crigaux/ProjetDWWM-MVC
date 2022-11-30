<?php
	require_once(__DIR__ . '/../../models/Dish.php');
	require_once(__DIR__ . '/../../helpers/SessionFlash.php');

	// ###############################################################################
	// ###                    TEST SI L'UTILISATEUR EST UN ADMIN                   ###	
	// ###############################################################################

	if((isset($_SESSION) && $_SESSION['user']->admin != 1) || !isset($_SESSION)){
		header('Location: /');
		exit;
	}

	// ###############################################################################
	// ###                         AFFICHAGE DU DASHBOARD                          ###	
	// ###############################################################################

	if($_SERVER['REQUEST_URI'] == '/admin/menu'){
		$starters = Dish::getAll(1);
		$dishes = Dish::getAll(2);
		$desserts = Dish::getAll(3);
	
		include(__DIR__ . '/../../views/test/templates/dbHeader.php');
		include(__DIR__ . '/../../views/test/dbdishes.php');
		include(__DIR__ . '/../../views/test/templates/dbFooter.php');
	} 

	// ###############################################################################
	// ###                            AJOUT D'UN PLAT                              ###	
	// ###############################################################################

	else if($_SERVER['REQUEST_URI'] == '/admin/menu/ajout'){

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors =[];

			// Nettoie le titre et vérifie qu'il n'est pas vide
			$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
			if(empty($title)){
				$errors['title'] = 'Veuillez entrer un titre';
			}
			// Nettoie le prix et vérifie qu'il n'est pas vide
			$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
			if(empty($price)){
				$errors['price'] = 'Veuillez entrer un prix';
			}
			// Nettoie la description et vérifie qu'elle n'est pas vide
			$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
			if(empty($description)){
				$errors['description'] = 'Veuillez entrer une description';
			}
			// Nettoie le type de plat et vérifie qu'il n'est pas vide
			$dish_type = intval(filter_input(INPUT_POST, 'dish_type', FILTER_SANITIZE_NUMBER_INT));
			if(empty($dish_type)){
				$errors['dish_type'] = 'Veuillez entrer un type de plat';
			}
			if($dish_type != 1 && $dish_type != 2 && $dish_type != 3){
				$errors['dish_type'] = 'Veuillez entrer un type de plat valide';
			}

			$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";

			if(empty($_FILES["img"]["name"])){
				$errors['img'] = 'Veuillez entrer une image';
			} else if($_FILES["img"]["type"] != 'image/jpeg'){
				$errors['img'] =  "Le fichier doit avoir l'extension JPG ou JPEG";
			} else {
				$target_file = strtolower(str_replace(' ', '', $title)). '.' . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
				$target_path = $target_dir . $target_file;
				$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

				// Vérifie la taille du fichier (max 5Mo)
				if($_FILES["img"]["size"] > 5 * 1024 * 1024) {
					$errors['img'] =  "Le fichier est trop volumineux.";
				}
				// Vérifie si il y a eu une erreur
				if(empty($errors)) {
					if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_path)) {
						$dish = new Dish($title, $price, $description, $_SESSION['user']->id, $dish_type);
						$dish->create();
						SessionFlash::set('message', 'Le plat a été ajouté.');					
						header('Location: /admin/commentaires');
						exit();
					}
				}
			}
		}
		include(__DIR__ . '/../../views/test/templates/dbHeader.php');
		include(__DIR__ . '/../../views/test/dishAdd.php');
		include(__DIR__ . '/../../views/test/templates/dbFooter.php');
	}

	// ###############################################################################
	// ###                 AFFICHAGE DU PLAT OU NON SUR L'ACCUEIL                  ###	
	// ###############################################################################

	else if($_SERVER['REQUEST_URI'] == '/admin/menu/edit/active/'.$id){
		$id = intval($id);
		$dish = Dish::getById($id);

		$errors = [];

		$active = intval(filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT));

		if(($active < 1 && $active > 2)){
			SessionFlash::set('error', 'Impossible de modifier l\'état du plat.');
			header('Location: /admin/menu');
			exit();
		}

		$dishUpdate = new Dish($dish->title, $dish->price, $dish->description, $dish->id_users, $dish->id_dishes_types, $active);
		$dishUpdate->update($id);

		if($active == 1){
			SessionFlash::set('message', 'Le plat est désormais visible sur l\'accueil.');
		} else {
			SessionFlash::set('message', 'Le plat n\'est désormais plus visible sur l\'accueil.');
		}

		header('location: /admin/menu');
		exit();
	} 

	// ###############################################################################
	// ###                          MISE À JOUR D'UN PLAT                          ###	
	// ###############################################################################

	else if($_SERVER['REQUEST_URI'] == '/admin/menu/edit/'.$id){
		$id = intval($id);
		$dish = Dish::getById($id);

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors =[];

			// Nettoie le titre et vérifie qu'il n'est pas vide
			$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
			if(empty($title)){
				$errors['title'] = 'Veuillez entrer un titre';
			}
			// Nettoie le prix et vérifie qu'il n'est pas vide
			$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
			if(empty($price)){
				$errors['price'] = 'Veuillez entrer un prix';
			}
			// Nettoie la description et vérifie qu'elle n'est pas vide
			$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
			if(empty($description)){
				$errors['description'] = 'Veuillez entrer une description';
			}
			
			// Si le titre du plat a été modifié, renomme l'image du plat
			$dir_content = scandir($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/");
			$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";

			foreach ($dir_content as $dir_content_file) {
				$position = strpos($dir_content_file, '.');
				$file_name = substr($dir_content_file, 0, $position);
				if($file_name == strtolower(str_replace(' ', '', $dish->title))){
					rename($target_dir . $dir_content_file, $target_dir . strtolower(str_replace(' ', '', $title.'.'.pathinfo($dir_content_file, PATHINFO_EXTENSION))));
				}
			}
			if(empty($errors)){
				// Met à jour le plat
				$dishUpdated = new Dish($title, $price, $description, $dish->id_users,  $dish->id_dishes_types);
				$dishUpdated->update($id);
	
				// Redirige vers la page des plats
				SessionFlash::set('message', 'Le plat a bien été modifié.');
				header('location: /admin/menu');
				exit();
			}
		}

		include(__DIR__ . '/../../views/test/templates/dbHeader.php');
		include(__DIR__ . '/../../views/test/dishModify.php');
		include(__DIR__ . '/../../views/test/templates/dbFooter.php');
		
	}

	// ###############################################################################
	// ###                          SUPPRESSION D'UN PLAT                          ###	
	// ###############################################################################

	else if($_SERVER['REQUEST_URI'] == '/admin/menu/delete/'.$id){
		$id = intval($id);
		Dish::delete($id);
		SessionFlash::set('message', 'Le plat a bien été supprimée.');
		header('location: /admin/menu');
		exit();
	
	} 

	// ###############################################################################
	// ###                    MISE À JOUR DE L'IMAGE D'UN PLAT                     ###	
	// ###############################################################################

	else if($_SERVER['REQUEST_URI'] == '/admin/menu/edit/img/'.$id){
		$id = intval($id);
		$dish = Dish::getById($id);

		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";
		if(!empty($_FILES["img"]["name"])){
			$target_file = strtolower(str_replace(' ', '', $dish->title)). '.' . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
			$target_path = $target_dir . $target_file;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

			// Supprime l'image du plat
			$dir_content = scandir($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/");
			foreach ($dir_content as $dir_content_file) {
				$position = strpos($dir_content_file, '.');
				$file_name = substr($dir_content_file, 0, $position);
				if($file_name == strtolower(str_replace(' ', '', $dish->title))){
					$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";
					rename($target_dir.$dir_content_file, $target_dir.$dish->id.'.'.pathinfo($dir_content_file, PATHINFO_EXTENSION));
				}
			}

			// Vérifie la taille du fichier
			if($_FILES["img"]["size"] > 5000000) {
				$errors['img'] =  "Le fichier est trop volumineux.";
				$uploadOk = 0;
			}

			// Filtre les extensions du fichier
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				$errors['img'] =  "Le fichier doit avoir l'extension JPG, JPEG, PNG & GIF.";
				$uploadOk = 0;
			}

			// Vérifie si $uploadOk est mis à 0 suite à une erreur
			if($uploadOk != 0) {
				if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_path)) {
					SessionFlash::set('message', 'L\'image a bien été modifiée.');
				} else {
					SessionFlash::set('error', 'L\'image n\'a pas pu être modifiée.');
				}
			} else {
				SessionFlash::set('error', 'L\'image n\'a pas pu être modifiée.');
			}
		}
		
		header('Location: /admin/menu');
		exit();
	}