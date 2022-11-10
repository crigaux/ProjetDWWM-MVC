	<div class="dashboardContent">
		<div class="title">
			<h2>Menu</h2>
		</div>
		<div class="content">
			<form class="dbModif" method="POST" enctype="multipart/form-data">
				<input type="text" name="title" placeholder="Nom du plat" required>
				<div class="error"><?= $errors['empty'] ?? '' ?></div>
				<input type="number" step="0.01" name="price" placeholder="Prix" required>
				<div class="error"><?= $errors['empty'] ?? '' ?></div>
				<textarea name="desc" required>Description du plat</textarea>
				<div class="error"><?= $errors['empty'] ?? '' ?></div>
				<input type="file" name="img" required>
				<div class="error"><?= $errors['file'] ?? '' ?></div>
				<div>
					<button type="submit">Ajouter</button>
				</div>
			</form>
		</div>
   </main>

</body>
</html>