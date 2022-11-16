<div class="dashboardContent">
		<div class="title">
			<h2>Réservations</h2>
		</div>
		<div class="content">
			<form class="dbModif" method="POST" enctype="multipart/form-data">
				<select name="validation" pattern="^[1-2]$" required>
					<option value="1" <?= $reservation->validated_at != NULL ? 'selected="selected"' : '' ?>>Validée</option>
					<option value="2" <?= $reservation->validated_at == NULL ? 'selected="selected"' : '' ?>>Non validée</option>
				</select>
				<div class="errorMessage">
					<?= $errors['validation'] ?? '' ;?>
				</div>

				<input type="text" value="<?= $reservation->lastname ?? ''?>" disabled>
				<div class="errorMessage"><?= $errors['name'] ?? '' ?></div>

				<input type="tel" value="<?= $reservation->phone ?? ''?>" disabled>
				<div class="errorMessage"><?= $errors['phoneNb'] ?? '' ?></div>

				<input type="number" min="1" max="8" step="1" placeholder="Nombre de personne (max 8 personnes)" name="nbOfClients" value="<?= $reservation->number_of_persons ?? ''?>" pattern="^[1-8]$" required>
				<div class="errorMessage"><?= $errors['nbOfClients'] ?? '' ?></div>

				<input type="date" name="date" value="<?= $date ?? ''?>" pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$" required>
				<div class="errorMessage"><?= $errors['date'] ?? '' ?></div>

				<select name="time" pattern="^[1-2]$" required>
					<option value="0">Choisissez votre créneaux</option>
					<option value="1" <?= $time == 1 ? 'selected' : '' ?>>Midi</option>
					<option value="2" <?= $time == 2 ? 'selected' : '' ?>>Soir</option>
				</select>
				<div class="errorMessage"><?= $errors['time'] ?? '' ?></div>

				<button type="submit">Modifier</button>
			</form>
		</div>
   </main>
</body>
</html>