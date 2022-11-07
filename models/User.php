<?php
	require_once(__DIR__ . '/../config/Database.php');

	class User {
		private int $id;
		private string $lastname;
		private string $firstname;
		private string $email;
		private string $password;
		private string $phone;
		private bool $admin;
		private bool $newsletter;
		private string $created_at;
		private string $validated_at;
		private object $pdo;

		public function __construct($id, $lastname, $firstname, $email, $password, $phone, $admin, $newsletter) {

			$this->pdo = Database::getInstance();

			$this->id = $id;
			$this->lastname = $lastname;
			$this->firstname = $firstname;
			$this->email = $email;
			$this->password = $password;
			$this->phone = $phone;
			$this->admin = $admin;
			$this->newsletter = $newsletter;
		}

		public function setId($id) {
			$this->id = $id;
		}
		public function setLastname($lastname) {
			$this->lastname = $lastname;
		}
		public function setFirstname($firstname) {
			$this->firstname = $firstname;
		}
		public function setEmail($email) {
			$this->email = $email;
		}
		public function setPassword($password) {
			$this->password = $password;
		}
		public function setPhone($phone) {
			$this->phone = $phone;
		}
		public function setAdmin($admin) {
			$this->admin = $admin;
		}
		public function setNewsletter($newsletter) {
			$this->newsletter = $newsletter;
		}
		public function setValidated_at($validated_at) {
			$this->validated_at = $validated_at;
		}

		public function getId() {
			return $this->id;
		}
		public function getLastname() {
			return $this->lastname;
		}
		public function getFirstname() {
			return $this->firstname;
		}
		public function getEmail() {
			return $this->email;
		}
		public function getPassword() {
			return $this->password;
		}
		public function getPhone() {
			return $this->phone;
		}
		public function getAdmin() {
			return $this->admin;
		}
		public function getNewsletter() {
			return $this->newsletter;
		}
		public function getCreated_at() {
			return $this->created_at;
		}
		public function getValidated_at() {
			return $this->validated_at;
		}

		/**
		 * Méthode de création d'un utilisateur
		 *
		 * @return true si l'utilisateur a bien été créé, @return false sinon
		 *
		 */
		public function create() :mixed{
			$query = 
			"INSERT INTO `users` (`lastname`, `firstname`, `email`, `password`, `phone`, `admin`, `newsletter`) 
			VALUES (':lastname', ':firstname', ':email', ':password', ':phone', ':admin', ':newsletter');";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$sth->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
			$sth->bindValue(':email', $this->email, PDO::PARAM_STR);
			$sth->bindValue(':password', $this->password, PDO::PARAM_STR);
			$sth->bindValue(':phone', $this->phone, PDO::PARAM_STR);
			$sth->bindValue(':admin', $this->admin, PDO::PARAM_BOOL);
			$sth->bindValue(':newsletter', $this->newsletter, PDO::PARAM_BOOL);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de récupération d'un utilisateur
		 *	
		 * @param int $id
		 * 
		 * @return PDOStatement si l'utilisateur existe, @return false sinon.
		 *
		 */
		public static function get(int $id) :mixed {
			$query = "SELECT * FROM `users` WHERE `id` = ':id';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->fetch() === false) ? false : $sth->fetch();
			}
		}

		/**
		 * Méthode de récupération de tous les utilisateurs
		 *
		 * @return PDOStatement si il y a des utilisateurs, @return false sinon.
		 *
		 */
		public static function getAll() :mixed {
			$query = "SELECT * FROM `users`;";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			if($sth->execute()) {
				return ($sth->fetchAll() === false) ? false : $sth->fetchAll();
			}
		}

		/**
		 * Méthode de mise à jour d'un utilisateur
		 *
		 * @param int $id
		 * 
		 * @return true si l'utilisateur a bien été mis à jour, @return false sinon
		 *
		 */
		public function update($id) :mixed {
			$query = 
			"UPDATE `users` 
			SET `lastname` = ':lastname', `firstname` = ':firstname', `email` = ':email', `password` = ':password', `phone` = ':phone', `admin` = ':admin', `newsletter` = ':newsletter' 
			WHERE `id` = ':id';";

			$sth = $this->pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);
			$sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$sth->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
			$sth->bindValue(':email', $this->email, PDO::PARAM_STR);
			$sth->bindValue(':password', $this->password, PDO::PARAM_STR);
			$sth->bindValue(':phone', $this->phone, PDO::PARAM_STR);
			$sth->bindValue(':admin', $this->admin, PDO::PARAM_BOOL);
			$sth->bindValue(':newsletter', $this->newsletter, PDO::PARAM_BOOL);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de suppression d'un utilisateur
		 *
		 * @param int $id
		 * 
		 * @return true si l'utilisateur a bien été supprimé, @return false sinon
		 *
		 */
		public static function delete(int $id) :mixed {
			$query = "DELETE FROM `users` WHERE `id` = ':id';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de validation d'un utilisateur
		 *
		 * @param int $id
		 * 
		 * @return true si l'utilisateur a bien été validé, @return false sinon
		 *
		 */
		public static function validate(int $id) :mixed {
			$query = "UPDATE `users` SET `validated_at` = NOW() WHERE `id` = ':id';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			if($sth->execute()) {
				return ($sth->rowCount() == 1) ?  true : false;
			}
		}

		/**
		 * Méthode de récupération d'un utilisateur par son email
		 *
		 * @param string $email
		 * 
		 * @return true si l'utilisateur existe, @return false sinon.
		 *
		 */
		public static function isExist(string $email) :mixed {
			$query = "SELECT * FROM `users` WHERE `email` = ':email';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':email', $email, PDO::PARAM_STR);

			if($sth->execute()) {
				return ($sth->fetch() === false) ? false : true;
			}
		}

		/**
		 * Méthode permettant de récupérer le mot de passe d'un utilisateur en fonction de son email
		 *
		 * @param string $email
		 * 
		 * @return PDOStatement (le mot de passe) si l'email existe, @return false sinon.
		 *
		 */
		public static function passwordVerification(string $email) :mixed {
			$query = "SELECT `password` FROM `users` WHERE `email` = ':email';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':email', $email, PDO::PARAM_STR);

			if($sth->execute()) {
				return ($sth->fetch() === false) ? false : $sth->fetch();
			}
		}


		/**
		 * Méthode permettant de vérifier si un id existe et de valider le compte correspondant
		 *
		 * @param int $id
		 * 
		 * @return true si le compte existe et a été vérifié, @return false sinon.
		 *
		 */
		public static function idExist(int $id) :mixed {
			$query = "SELECT * FROM `users` WHERE `id` = ':id';";

			$pdo = Database::getInstance();
			$sth = $pdo->prepare($query);

			$sth->bindValue(':id', $id, PDO::PARAM_STR);

			if($sth->execute()) {
				return ($sth->fetch() === false) ? false : (self::validate($id)) ? true : false;
			}
		}
}