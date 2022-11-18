<?php
	require_once(__DIR__ . '/../config/Database.php');

	class Dish {
		private int $id;
		private string $title;
		private string $price;
		private string $description;
		private int $active;
		private int $id_users;
		private int $id_dishes_types;
		private object $pdo;

		public function __construct($title, $price, $description, $id_users, $id_dishes_types, $active = false) {

			$this->pdo = Database::getInstance();

			$this->title = $title;
			$this->price = $price;
			$this->description = $description;
			$this->active = $active;
			$this->id_users = $id_users;
			$this->id_dishes_types = $id_dishes_types;
		}

		public function setTitle(string $title) {
			$this->title = $title;
		}
		public function setPrice(float $price) {
			$this->price = $price;
		}
		public function setDescription(string $description) {
			$this->description = $description;
		}
		public function setActive(bool $active) {
			$this->active = $active;
		}
		public function setId_users(int $id_users) {
			$this->id_users = $id_users;
		}
		public function setId_dishes_types(int $id_dishes_types) {
			$this->id_dishes_types = $id_dishes_types;
		}

		public function getTitle():string {
			return $this->title;
		}
		public function getPrice():float {
			return $this->price;
		}
		public function getDescription():string {
			return $this->description;
		}
		public function getActive():bool {
			return $this->active;
		}
		public function getId_users():int {
			return $this->id_users;
		}
		public function getid_dishes_types():int {
			return $this->id_dishes_types;
		}

		/**
		 * Méthode permettant de créer un nouveau plat
		 * 
		 * @return true si l'avis a été créé, false sinon
		 */
		public function create():bool {
			$query = 
			"INSERT INTO `dishes` (`title`, `price`, `description`, `active`, `id_users`, `id_dishes_types`) 
			VALUES (:title, :price, :description, :active, :id_users, :id_dishes_types);";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':title', $this->title);
			$sth->bindValue(':price', $this->price);
			$sth->bindValue(':description', $this->description);
			$sth->bindValue(':active', $this->active, PDO::PARAM_BOOL);
			$sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes_types', $this->id_dishes_types, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer tous les plats
		 * 
		 * @return array ou @return false si aucun plat n'a été trouvé
		 */
		public static function getAll(int $type = NULL):mixed {
			$pdo = Database::getInstance();
			if($type == NULL) {
				$query = "SELECT * FROM `dishes`";
				$sth = $pdo->prepare($query);
			} else {
				$query = "SELECT * FROM `dishes` WHERE `id_dishes_types` = :id_dishes_types";
				$sth = $pdo->prepare($query);
				$sth->bindValue(':id_dishes_types', $type, PDO::PARAM_INT);
			}
			if($sth->execute()) {
				return $sth->fetchAll();
			}
			return false;
		}

		/**
		 * Méthode permettant de récupérer un plat avec son id
		 * 
		 * @return object si le plat existe, false sinon
		 */
		public static function getById(int $id):mixed {
			$pdo = Database::getInstance();

			$query = "SELECT * FROM `dishes` WHERE `id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return $sth->fetch();
			}
			return false;
		}

		/**
		 * Méthode permettant de modifier un plat
		 * 
		 * @return true si le plat a été modifié, false sinon
		 */
		public function update($id):bool {
			$query = 
			"UPDATE `dishes` 
			SET `title` = :title, `price` = :price, `description` = :description, `active` = :active, `id_users` = :id_users, `id_dishes_types` = :id_dishes_types 
			WHERE `id` = :id;";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':title', $this->title);
			$sth->bindValue(':price', $this->price);
			$sth->bindValue(':description', $this->description);
			$sth->bindValue(':active', $this->active, PDO::PARAM_INT);
			$sth->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
			$sth->bindValue(':id_dishes_types', $this->id_dishes_types, PDO::PARAM_INT);
			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}

		/**
		 * Méthode permettant de supprimer un plat
		 * 
		 * @return true si le plat a été supprimé, false sinon
		 */
		public static function delete(int $id):bool {
			$pdo = Database::getInstance();

			$query = "DELETE FROM `dishes` WHERE `id` = :id;";

			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
			return false;
		}
	}