<?php 

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;



		//=== Getters and Setters === 
		public function getIdusuario() {
			return $this->idusuario;
		}	

		public function setIdusuario($value) {
			$this->idusuario = $value;
		}

		//Get, Set deslogin
		public function getDeslogin() {
			return $this->deslogin;
		}

		public function setDeslogin($value) {
			$this->deslogin = $value;
		}

		//Get, Set dessenha
		public function getDessenha() {
			return $this->dessenha;
		}	

		public function setDessenha($value) {
			$this->dessenha = $value;
		}

		//Get, Set dtcadastro
		public function getDtcadastro() {
			return $this->dtcadastro;
		}

		public function setDtcadastro($value) {
			$this->dtcadastro = $value;
		} 
		//=============================


		public function loadById($id) {

			$sql = new Sql();

			$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if (count($result) > 0 ) {
				
				$row = $result[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));

			}

		}//loadById


		public function __toString() {

			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));

		}//toString


	}//Class Usuario

 ?>