<div class="dishes">
	<h1>MENU</h1>
	<h2>Modification</h2>

	<form action="/admin/menu/edit/<?=$id?>" class="dishEditForm" method="POST">
		<input type="text" name="title"value="<?= $dish->title ?>" required>
		<div class="errorMessage">
			<?= $errors['title'] ?? '' ;?>
		</div>
		<input type="text" name="price"value="<?= $dish->price ?>" required>
		<div class="errorMessage">
			<?= $errors['price'] ?? '' ;?>
		</div>
		<textarea name="description" cols="30" rows="8" required><?= $dish->description ?></textarea>
		<div class="errorMessage">
			<?= $errors['description'] ?? '' ;?>
		</div>

		<button type="submit">Modifier</button>
	</form>
</div>