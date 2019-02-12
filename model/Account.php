<?php

	class Account {
		
		private $id;
		private $amount;
		private $lastOperation;
		private $user;


		public function __construct() {

		}

		public function init($id,$amount,$lastOperation,$user) {

			$this->id = $id;
			$this->amount = $amount;
			$this->lastOperation = $lastOperation;
			$this->user = $user;

		}

		public function getId() {

			return $this->id;

		}
		
		public function getAmount() {

			return $this->amount;

		}
		
		public function getLastOperation() {

			return $this->lastOperation;

		}
		
		public function getUser() {

			return $this->user;

		}

	}
	
?>
