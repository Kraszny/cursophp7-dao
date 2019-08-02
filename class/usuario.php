<?php 

	class Usuario {

		//Atributos.
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



		public function loadById($id) {//Busca um usuario pelo ID.

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

		}//loadById.



		public static function getList() {//Lista todos os usuarios da tabela.

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

		}//function getList.



		public static function search($login) {//Busca um usuario pelo login.

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN ORDER BY deslogin", array(
				":LOGIN"=>"%".$login."%"
			));

		}//function search.



		public function login($login, $password) {//Carrega um usuario autenticado(login e password).

			$sql = new Sql();

			$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			)); 

			if (count($result) > 0 ) {
				
				$row = $result[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));

			} else {

				throw new Exception("Login e/ou senha inválidos");
				

			}



		}//function login.



		public function __toString() {

			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));

		}//toString.


	}//Class Usuario.

 ?>