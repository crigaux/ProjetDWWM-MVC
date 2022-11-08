<div class="dashboardContent">
		<div class="title">
			<h2>Menu</h2>
		</div>
		<div class="content">
			<form class="dbModif" method="POST" enctype="multipart/form-data">
				
				<input type="text" name="title" placeholder="Nom du plat" value="<?= $dish->title ?>">
				<input type="number" step="0.01" name="price" placeholder="Prix" value="<?= $dish->price ?>">
				<textarea name="desc"><?= $dish->description ?></textarea>
				<input type="file" name="img">
				<div>
					<button type="submit">Modifier</button>
				</div>
			</form>
		</div>
   </main>
</body>
</html>