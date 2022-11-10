<div class="dashboardContent">
		<div class="title">
			<h2>Menu</h2>
		</div>
		<div class="content">
			<form class="dbModif" method="POST" enctype="multipart/form-data" action="<?= "/admin/menu/edit/$id" ?>">
				<select name="active">
					<option value="1" <?= $dish->active == 1 ? 'selected="selected"' : '' ?>>Affiché</option>
					<option value="2" <?= $dish->active == 2 ? 'selected="selected"' : '' ?>>Pas affiché</option>
				</select>
				<div class="errorMessage">
					<?= $errors['active'] ?? '' ;?>
				</div>
				<input type="text" name="title" placeholder="Nom du plat" value="<?= $dish->title ?>">
				<div class="errorMessage">
					<?= $errors['title'] ?? '' ;?>
				</div>
				<input type="number" step="0.01" name="price" placeholder="Prix" value="<?= $dish->price ?>">
				<div class="errorMessage">
					<?= $errors['price'] ?? '' ;?>
				</div>
				<textarea name="desc"><?= $dish->description ?></textarea>
				<div class="errorMessage">
					<?= $errors['dish'] ?? '' ;?>
				</div>
				<input type="file" name="img" value="<?= $_SERVER['DOCUMENT_ROOT'] . "/public/assets/galery/"?>">
				<div class="errorMessage">
					<?= $errors['file'] ?? '' ;?>
				</div>
				<div>
					<button type="submit">Modifier</button>
				</div>
			</form>
		</div>
   </main>
</body>
</html>