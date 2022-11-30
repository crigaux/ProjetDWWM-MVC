<div class="users">
	<h1>MEMBRES</h1>

	<h2>Modification</h2>

	<form method="POST" action="/admin/membre/edit/<?= $user->id ?>">
		<input type="text" name="lastname" placeholder="Nom*" value="<?= $lastname ?? $user->lastname ?>" required pattern="^[A-Za-z-' ]+$">
		<div class="errorMessage"><?= $errors['name'] ?? '' ?></div>
		<input type="text" name="firstname" placeholder="Prénom*" value="<?= $firstname ?? $user->firstname ?>" required pattern="^[A-Za-z-' ]+$">
		<div class="errorMessage"><?= $errors['firstname'] ?? '' ?></div>
		<input type="email" name="email" placeholder="Adresse mail*" value="<?= $email ?? $user->email ?>" required pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z-]+\.[a-zA-Z-.]+$">
		<div class="errorMessage"><?= $errors['email'] ?? '' ?></div>
		<input type="phone" name="phone" placeholder="Numéro de téléphone*" value="<?= $phoneNb ?? $user->phone ?>" required pattern="^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$">
		<div class="errorMessage"><?= $errors['phone'] ?? '' ?></div>
		<select name="role">
			<option value="1">Admin</option>
			<option value="2">Utilisateur</option>
		</select>
		<button type="submit">Modifier</button>
	</form>
</div>