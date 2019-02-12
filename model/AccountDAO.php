<?php
	ini_set('display errors', 'On');
	error_reporting(E_ALL);
	//require_once('SqliteConnection.php');

	class AccountDAO {

		private static $dao;

		public final static function getInstance() {
			 if(!isset(self::$dao)) {
					 self::$dao= new AccountDAO();
			 }
			 return self::$dao;
		}

		public final function findAll() {

			$dbc = SqliteConnection::getInstance()->getConnection();
			$query = "SELECT * FROM Account ORDER BY id";
			$stmt = $dbc->query($query);
			$results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Account');
			return $results;

		}

		public final function insert($st) {
			 if($st instanceof Account) {
					$dbc = SqliteConnection::getInstance()->getConnection();
					// prepare the SQL statement
					$query = "INSERT INTO Account (id, amount, lastOperation, user)
										 VALUES (NULL,:am,NULL,:us)";
					$stmt = $dbc->prepare($query);

					// bind the paramaters to avoid SQL injections
					//$stmt->bindValue(':id',$st->getId(),PDO::PARAM_INT);
					$stmt->bindValue(':am',$st->getAmount(),PDO::PARAM_INT);
					$stmt->bindValue(':p',$st->getUser(),PDO::PARAM_STR);

					// execute the prepared statement
					$stmt->execute();
			}
	 }

	 public function delete($obj) {
		 if($obj instanceof Account) {
			 $dbc = SqliteConnection::getInstance()->getConnection();
			 // prepare the SQL statement
			 $query = "DELETE FROM Account
						WHERE id = :id";

			 $stmt = $dbc->prepare($query);

			 // bind the paramaters
			 $stmt->bindValue(':id',$obj->getId(),PDO::PARAM_INT);

			 // execute the prepared statement
			 $stmt->execute();
		 }
	 }

	 public function update($obj,$amount,$lastOperation,$description) {
		 if($obj instanceof Account) {
			 $dbc = SqliteConnection::getInstance()->getConnection();
			 // prepare the SQL statement
			 $query = "UPDATE Account
						SET amount = :am,
						lastOperation = :lo,
						WHERE id = :id";

			 $stmt = $dbc->prepare($query);

			 // bind the paramaters
			 $stmt->bindValue(':id',$obj->getId(),PDO::PARAM_INT);
			 $stmt->bindValue(':am',$amount,PDO::PARAM_INT);
			 $stmt->bindValue(':lo',$lastOperation,PDO::PARAM_STR);

			 // execute the prepared statement
			 $stmt->execute();

		 }
	 }

	 public final function findOne($user) {
			if($user instanceof User) {
			 $dbc = SqliteConnection::getInstance()->getConnection();
			 // prepare the SQL statement
			 $query = "SELECT *
						FROM Account
						WHERE user = :u
						ORDER BY id";
			 $stmt = $dbc->query($query);
			 // bind the paramaters
			 $stmt->bindValue(':p',$user->getMail(),PDO::PARAM_STR);
			 // execute the prepared statement
			 $stmt->execute();
			 $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Account');
			 return $results;
		 }
	 }
 }


?>
