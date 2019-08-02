<?php 

	class Sql extends PDO {

		private $conn;


		public function __construct() {//Objetos instanciados conectam automaticamento ao banco.

			$this->conn = new PDO("mysql:dbname=dbphp7; host=127.0.0.1", "root", "");

		}//__contruct.


		private function setParams($statement, $parameters = array())  {

			foreach ($parameters as $key => $value) {
				
				$this->setParam($statement, $key, $value);

			}

		}//setParams.


		private function setParam($statement, $key, $value) {

			$statement->bindParam($key, $value);

		}//setParam.


		public function query($rawQuery, $params = array()) {

			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;

		}//query.


		public function select($rawQuery, $params = array()):array {

			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchALL(PDO::FETCH_ASSOC);

		}//select.

	}//Class Sql.

 ?>