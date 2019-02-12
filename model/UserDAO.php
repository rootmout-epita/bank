<?php

	//require_once(__ROOT__.'/model/SqliteConnection.php');
	require_once(__ROOT__.'/model/User.php');

	class UserDAO {

		private static $dao;

		private function __construct() {}

			public final static function getInstance() {

				if ( !isset(self::$dao) ) {

					self::$dao= new UserDAO();

				}

				return self::$dao;
				 
			}

			public final function findAll() {

				 $dbc = SqliteConnection::getInstance()->getConnection();
				 $query = "SELECT * FROM User ORDER BY mail";
				 $stmt = $dbc->query($query);
				 $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'User');
				 return $results;

			}

			public final function insert($st) {

				if ( $st instanceof User ) {

					 $dbc = SqliteConnection::getInstance()->getConnection();
					 // prepare the SQL statement
					 $query = "INSERT INTO User(mail, password)
								VALUES (:m,:p)";
					 $stmt = $dbc->prepare($query);

					 // bind the paramaters to avoid SQL injections
					 $stmt->bindValue(':m',$st->getMail(),PDO::PARAM_STR);
					 $stmt->bindValue(':p',$st->getPassword(),PDO::PARAM_STR);

					 // execute the prepared statement
					 $stmt->execute();
				}

			}

		public final function delete($obj) {

			if ( $obj instanceof User ) {

				$dbc = SqliteConnection::getInstance()->getConnection();
				// prepare the SQL statement
				$query = "DELETE FROM User WHERE mail = :m";

				$stmt = $dbc->prepare($query);

				// bind the paramaters
				$stmt->bindValue(':m',$obj->getMail(),PDO::PARAM_STR);

				// execute the prepared statement
				$stmt->execute();

			}

		}

		public final function update($obj,$password) {

			if ( $obj instanceof User ) {
				
				$dbc = SqliteConnection::getInstance()->getConnection();
				// prepare the SQL statement
				$query = "UPDATE User
							SET password = :p
							WHERE mail = :m";

				$stmt = $dbc->prepare($query);

				// bind the paramaters
				$stmt->bindValue(':m',$obj->getMail(),PDO::PARAM_STR);
				$stmt->bindValue(':p',$password,PDO::PARAM_STR);

				// execute the prepared statement
				$stmt->execute();

			}

		}

	}

?>
