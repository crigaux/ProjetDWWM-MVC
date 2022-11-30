<div class="dishes">
	<h1>MENU</h1>
	<h2>Ajouter un plat</h2>

	<form action="/admin/menu/ajout" class="dishEditForm" method="POST" enctype="multipart/form-data" >
		<select type="text" name="dish_type" required placeholder="Titre du plat">
			<option value="1" <?= (isset($dish_type) && $dish_type == 1) ? 'selected' : ''?>>Entrée</option>
			<option value="2" <?= (isset($dish_type) && $dish_type == 2) ? 'selected' : ''?>>Plat</option>
			<option value="3" <?= (isset($dish_type) && $dish_type == 3) ? 'selected' : ''?>>Dessert</option>
		</select>
		<div class="errorMessage">
			<?= $errors['dish_type'] ?? '' ;?>
		</div>
		<input type="text" name="title" required placeholder="Titre du plat" value="<?= $title ?? ''?>">
		<div class="errorMessage">
			<?= $errors['title'] ?? '' ;?>
		</div>
		<input type="text" name="price" required placeholder="Prix du plat" value="<?= $price ?? ''?>">
		<div class="errorMessage">
			<?= $errors['price'] ?? '' ;?>
		</div>
		<textarea name="description" cols="30" rows="8" required placeholder="Description du plat"><?= $description ?? ''?></textarea>
		<div class="errorMessage">
			<?= $errors['description'] ?? '' ;?>
		</div>
		<input type="file" name="img" required required>
		<div class="errorMessage">
			<?= $errors['img'] ?? '' ;?>
		</div>

		<button type="submit">Ajouter</button>
	</form>
</div>