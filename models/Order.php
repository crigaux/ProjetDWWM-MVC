<?php
	require_once(__DIR__ . '/../config/Database.php');

	class User {
		private int $id;
		private int $quantity;
		private int $id_dishes;
		private int $id_reservations;
		private object $pdo;

		public function __construct(int $quantity, int $id_dishes, int $id_reservations) {

			$this->pdo = Database::getInstance();

			$this->quantity = $quantity;
			$this->id_dishes = $id_dishes;
			$this->id_reservations = $id_reservations;
		}

		public function setQuantity(int $quantity) {
			$this->quantity = $quantity;
		}

		public function setId_dishes(int $id_dishes) {
			$this->id_dishes = $id_dishes;
		}

		public function setId_reservations(int $id_reservations) {
			$this->id_reservations = $id_reservations;
		}

		public function getQuantity():int {
			return $this->quantity;
		}

		public function getId_dishes():int {
			return $this->id_dishes;
		}

		public function getId_reservations():int {
			return $this->id_reservations;
		}

		/**
		 * Méthode permettant de créer une nouvelle commande
		 * 
		 * @return true si la commande a été créée, @return false sinon
		 */
		public function create():bool {
			$query = "INSERT INTO `orders` (`quantity`, `id_dishes`, `id_reservations`) VALUES (':quantity', ':id_dishes', ':id_reservations');";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':quantity', $this->quantity, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes', $this->id_dishes, PDO::PARAM_INT);
			$sth->bindValue(':id_reservations', $this->id_reservations, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de mettre à jour une commande
		 * 
		 * @param int $id
		 * 
		 * @return true si la commande a été mise à jour, @return false sinon
		 */
		public function update(int $id):bool {
			$query = "UPDATE `orders` SET `quantity` = ':quantity', `id_dishes` = ':id_dishes', `id_reservations` = ':id_reservations' WHERE `id` = ':id';";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':quantity', $this->quantity, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes', $this->id_dishes, PDO::PARAM_INT);
			$sth->bindValue(':id_reservations', $this->id_reservations, PDO::PARAM_INT);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de supprimer une commande
		 * 
		 * @param int $id
		 * 
		 * @return true si la commande a été supprimée, @return false sinon
		 */
		public static function delete(int $id):bool {
			$query = "DELETE FROM `orders` WHERE `id` = ':id';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode permettant de récupérer une commande
		 * 
		 * @param int $id
		 * 
		 * @return PDOStatement si la commande a été récupérée, @return false sinon
		 */
		public static function get(int $id):mixed {
			$query = "SELECT * FROM `orders` WHERE `id` = ':id';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->fetch() === false) ?  false : $sth->fetch();
			}
		}

		/**
		 * Méthode permettant de récupérer toutes les commandes
		 * 
		 * @return array si les commandes ont été récupérées, @return false sinon
		 */
		public static function getAll():mixed {
			$query = "SELECT * FROM `orders`;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			if($sth->execute()) {
				return ($sth->fetchAll() === false) ?  false : $sth->fetchAll();
			}
		}

		/**
		 * Méthode permettant de récupérer toutes les commandes d'une réservation
		 * 
		 * @param int $id_reservations
		 * 
		 * @return array si les commandes ont été récupérées, @return false sinon
		 */
		public static function getAllByReservation(int $id_reservations):mixed {
			$query = 
			"SELECT `dishes`.`title`, `dishes`.`price`, `orders`.`quantity` 
			FROM `orders` 
			INNER JOIN `dishes`
			ON `dishes`.`id` = `orders`.`id_dishes` 
			WHERE `orders`.`id_reservations` = ':id_reservations';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id_reservations', $id_reservations, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->fetchAll() === false) ?  false : $sth->fetchAll();
			}
		}

		/**
		 * Méthode permettant de récupérer toutes les commandes à une date donnée
		 * 
		 * @param int $date
		 * 
		 * @return array si les commandes ont été récupérées, @return false sinon
		 */
		public static function getAllByDate(string $date):mixed {
			$query = "SELECT * FROM `orders` INNER JOIN `reservations` WHERE `reservations`.`reservation_date` = ':date';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':date', $date);

			if($sth->execute()) {
				return ($sth->fetchAll() === false) ?  false : $sth->fetchAll();
			}
		}
	}