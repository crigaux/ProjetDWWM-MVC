		<div class="dashboardContent">
			<div class="title">
					<h2>Commandes</h2>
			</div>

			<?php $message = SessionFlash::get('updated') ?>
			<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">'.$message.'</div></div>'; ?>

			<?php $message = SessionFlash::get('deleted') ?>
			<?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">'.$message.'</div></div>'; ?>

			<?php $errorMessage = SessionFlash::get('errorMessage') ?>
			<?= ($errorMessage == '') ? '' : '<div class="errorContainer"><div class="errorMessage">'.$errorMessage.'</div></div>'; ?>

			<div class="content">
					<table>
						<tr>
							<th>Validée</th>
							<th>Nom</th>
							<th>Téléphone</th>
							<th>Date</th>
							<th>Créneaux</th>
							<th>Plats</th>
							<th></th>
						</tr>
						<?php foreach ($reservations as $reservation) {
							$orders = Order::get($reservation->id);
						?>
							<tr class="colored" id="<?= $reservation->id ?>">
									<td><?= ($reservation->validated_at == NULL) ? 'Non' : 'Oui' ; ?></td>
									<td class="name"><?= $reservation->lastname ?></td>
									<td class="phone"><?= $reservation->phone ?></td>
									<td class="date"><?= ucfirst($formatDate->format(strtotime($reservation->reservation_date))) ?></td>
									<td class="time"><?= ucfirst($formatHour->format(strtotime($reservation->reservation_date))) ?></td>
									<td class="dish">
										<?php foreach ($orders as $order) {
											echo "<div>$order->title x $order->quantity</div>";
										} ?>
									</td>
									<td class="edit">
										<a href="<?="/admin/commande/edit/$reservation->id"?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></a>
										<button class="btnDeleteConf"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
									</td>
								</tr>
						<?php } ?> 
					</table>
			</div>
		</div>
		<div class="modale">
			<div class="modaleContent">
					<h2>Supprimer le plat</h2>
					<div class="modaleBtn">
						<button>Annuler</button>
						<a class="deleteOrderLink" href="">Supprimer</a>
					</div>
			</div>
		</div>
	</main>

	<script src="../../public/assets/js/deleteConfirm.js"></script>
</body>
</html>