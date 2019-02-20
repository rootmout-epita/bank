<?php

	class User {
		
		private $mail;
		private $password;


		public function __construct() {

		}

		public function init($mail,$password) {

			$this->mail = $mail;
			$this->password = $password;

		}

		public function getMail() {

			return $this->mail;

		}
		
		public function getPassword() {

			return $this->password;

		}

	}
	
?>
