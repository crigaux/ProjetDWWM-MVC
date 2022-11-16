<?php
	require_once(__DIR__.'/../../models/Dish.php');
	require_once(__DIR__ . '/../../config/regex.php');
	require_once(__DIR__.'/../../helpers/SessionFlash.php');

if(explode('/', $_SERVER['REQUEST_URI'])[3] == 'add'){

	if(isset($type)){

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors =[];

			$type = intval($type);

			$active = intval(filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT));
			$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
			$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
			$desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);

			// Vérifie si le fichier est vide ou non
			if(!empty($_FILES["img"]["name"])){
				$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";
				$target_file = strtolower(str_replace(' ', '', $title)). '.' . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
				$target_path = $target_dir . $target_file;
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

				// Vérifie si le fichier existe déjà sur le serveur
				$dir_content = scandir($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/");
				if (in_array($target_file, $dir_content)) {
					$errors['file'] =  "Le fichier existe déjà.";
					$uploadOk = 0;
				}

				// Vérifie la taille du fichier
				if ($_FILES["img"]["size"] > 5000000) {
					$errors['file'] =  "Le fichier est trop volumineux.";
					$uploadOk = 0;
				}

				// Filtre les extensions du fichier
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
					$errors['file'] =  "Le fichier doit avoir l'extension JPG, JPEG, PNG & GIF.";
					$uploadOk = 0;
				}

				// Vérifie si $uploadOk est mis à 0 suite à une erreur
				if ($uploadOk != 0) {
					if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_path)) {
						$errors['file'] = "Une erreur s'est produite lors de l'upload.";
					}
				}
			} else {
				$errors['file'] = "Le fichier est vide.";
			}

			if(empty($title) || empty($price) || empty($desc)) {
				$errors['empty'] = 'Veuillez remplir tous les champs';
			}

			if(empty($errors)){
				$dish = new Dish($title, $price, $desc, 1, $type);
				$dish->create();
				SessionFlash::set('added', 'Le plat a bien été ajouté');
				header('location: /admin/menu');
				exit;
			}
		}
		
	}
	include(__DIR__ . '/../../views/admin/dashboard.php');
	include(__DIR__ . '/../../views/admin/dbAddMenu.php');

} else if (explode('/', $_SERVER['REQUEST_URI'])[3] == 'edit') {

	if(isset($id)) {
		$id = intval($id);
		$dish = Dish::getById($id);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors =[];

		$active = intval(filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT));
		$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
		$price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
		$desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);

		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/";
		if(!empty($_FILES["img"]["name"])){
			$target_file = strtolower(str_replace(' ', '', $title)). '.' . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
			$target_path = $target_dir . $target_file;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

			// Supprime l'ancienne image du plat
			$dir_content = scandir($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/");
			foreach ($dir_content as $dir_content_file) {
				$position = strpos($dir_content_file, '.');
				$file_name = substr($dir_content_file, 0, $position);
				if($file_name == strtolower(str_replace(' ', '', $title))){
					unlink($dir_content_file);
				}
			}

			// Vérifie la taille du fichier
			if ($_FILES["img"]["size"] > 5000000) {
				$errors['file'] =  "Le fichier est trop volumineux.";
				$uploadOk = 0;
			}

			// Filtre les extensions du fichier
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				$errors['file'] =  "Le fichier doit avoir l'extension JPG, JPEG, PNG & GIF.";
				$uploadOk = 0;
			}

			// Vérifie si $uploadOk est mis à 0 suite à une erreur
			if ($uploadOk != 0) {
				if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_path)) {
					echo "Le fichier ". htmlspecialchars( basename( $_FILES["img"]["name"])). " a bien été uploadé.";
				} else {
					echo "Une erreur s'est produite lors de l'upload.";
				}
			}
		} else {
			$dir_content = scandir($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/");

			foreach ($dir_content as $dir_content_file) {
				$position = strpos($dir_content_file, '.');
				$file_name = substr($dir_content_file, 0, $position);
				if($file_name == strtolower(str_replace(' ', '', $dish->title))){
					rename($target_dir . $dir_content_file, $target_dir . strtolower(str_replace(' ', '', $title.'.'.pathinfo($dir_content_file, PATHINFO_EXTENSION))));
				}
			}
		}

		if($active != 1 && $active != 2) {
			$errors['active'] = 'Veuillez choisir une option';
		}
		if(empty($title) || empty($price) || empty($desc)) {
			$errors['empty'] = 'Veuillez remplir tous les champs';
		}

		if(empty($errors)){
			$dish = new Dish($title, $price, $desc, 1, $dish->id_dishes_types, $active);
			$dish->update($id);
			SessionFlash::set('updated', 'Le plat a bien été mis à jour');
			header('location: /admin/menu');
			exit;
			$message = 'Patient ajouté.';
		}
	}
	
	include(__DIR__ . '/../../views/admin/dashboard.php');
	include(__DIR__ . '/../../views/admin/dbModifyMenu.php');

} else if (explode('/', $_SERVER['REQUEST_URI'])[3] == 'delete'){

	if(isset($id)){
		$id = intval($id);
		$dish = Dish::getById($id);

		// Supprime l'image du plat
		$dir_content = scandir($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/");
		foreach ($dir_content as $dir_content_file) {
			$position = strpos($dir_content_file, '.');
			$file_name = substr($dir_content_file, 0, $position);
			if($file_name == strtolower(str_replace(' ', '', $dish->title))){
				unlink($_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/".$dir_content_file);
			}
		}
		if(Dish::delete($id)) {
			SessionFlash::set('deleted', 'Le plat a bien été supprimé');
			header('Location: /admin/menu');
			exit();
		} else {
			SessionFlash::set('errorMessage', 'Le plat n\'a pas pu être supprimé');
			header('Location: /admin/menu');
			exit();
		}
	}
}