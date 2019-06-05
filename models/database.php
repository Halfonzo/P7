<?php

	//Esta clase funcionara para realizar la conexion a la base de datos y ejecutar todas las sentencias
	class Database{
		//Datos para la conexion a la base de datos
		private $con;
		private $dbhost="localhost";
		private $dbuser="root";
		private $dbpass="";
		private $dbname="tutorias";
		function __construct(){
			$this->connect_db();
		}

		//Se crea la conexion con la base de datos y se establecen los parametros de conexion PDO
		public function connect_db(){
			try {
				$this->con = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
				//print "Conexión exitosa!";
			}
			catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "
				";
				die();
			}
			$con =null;
		}
		//Se ejecuta una sentencia para verificar si el usuario existe en los registros, solo devolvera True o False
		public function login($nick,$pass){
			$sql = "Select nivel From maestros Where email = '" . $nick . "' and password = '" . $pass . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			$return = $stmt->fetch();
			$return = $return[0];
			return $return;
			//Si la sentencia encuentra algun usuario registrado se devuelve True, en caso constrario False
			//La sentencia busca por el ID del usuario con el nickname y contraseña coincidentes
		}

		//Funcion para devolver todos los datos de una tabla en especifico, esto se mostraran en las tablas principales
		//La tabla seleccionada es enviada por parametro
		public function table($tabla){
			$sql = "Select * From " . $tabla;
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			//$return = $stmt->fetch();
  			return $stmt;
		}

		//Consulta especial para retornar un conjunto de datos, se manda como parametro la sentencia que se desea consultar
		public function especial($sql){
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			//$return = $stmt->fetch();
  			return $stmt;
		}

		//Funcion para registra a un nuevo estudiante en el sistema, s epasa como parametros su infromacion
		public function create_alumno($matricula,$nombre,$carrera,$tutor){
			$sql = "Insert into alumnos (matricula,nombre,id_carrera,id_tutor) values('" . $matricula ."','" . $nombre . "','" . $carrera . "','" . $tutor . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para eliminar un cliente en especifico, se pasa como parametro el id del cliente
		public function delete($id,$iden,$table){
			$sql = "Delete from " . $table . " Where " . $iden . "='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para retornar solo un registro de la tabla, esto se utilizara para la actualizacion de datos, como parametro se pasa el id del registro que se desea modificar
		public function select_one($id,$iden,$table){
			$sql = "Select * From " . $table . " where " . $iden . "='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			$return = $stmt->fetch();
  			return $return;
		}

		//Funcion para realizar la actualizacion de un cliente en especifico, se pasaran comom parametros todos los datos a actualizar
		public function update_alumno($matricula,$nombre,$carrera,$tutor){
			$sql = "Update alumnos set matricula='" . $matricula . "',nombre='" . $nombre . "',id_carrera='" . $carrera . "',id_tutor='" . $tutor . "' Where matricula='" . $matricula . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para realizar el registro de un nuevo cliente a la base de datos, esta funcion tiene como parametros los datos del cliente que se llena en el formulario
		public function create_maestro($matricula,$nombre,$email,$password,$carrera,$nivel){
			$sql = "Insert into maestros (num_empleado,nombre,email,password,id_carrera,nivel) values('" . $matricula ."','" . $nombre . "','" . $email . "','" . $password . "','" . $carrera . "','" . $nivel . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para realizar el registro de una nueva habitacion en la base de datos, esta funcion tiene como parametros los datos de la habitacion
		public function create_carrera($nombre){
			$sql = "Insert into carrera (nombre) values('" . $nombre ."')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para realizar la actualizacion de un cliente en especifico, se pasaran comom parametros todos los datos a actualizar
		public function update_carrera($id,$nombre){
			$sql = "Update carrera set nombre='" . $nombre . "' Where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para realizar el registro de una nueva reservacion en la base de datos, se pasan los valores ingresados por parametro
		public function create_materia($nombre,$maestro,$carrera){
			$sql = "Insert into materias (nombre,id_maestro,id_carrera) values('" . $nombre ."','" . $maestro . "','" . $carrera . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion que actualizara los datos de la habitacion en el caso de que se actualice la imagen
		public function update_materia($id,$nombre,$tutor,$carrera){
			$sql = "Update materias set nombre='" . $nombre . "',id_maestro='" . $tutor . "',id_carrera='" . $carrera . "' Where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para realizar el registro de una nueva reservacion en la base de datos, se pasan los valores ingresados por parametro
		public function create_grupo($nombre,$carrera){
			$sql = "Insert into grupos (nombre,id_carrera) values('" . $nombre ."','" . $carrera . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}
		
		//Funcion que actualizara los datos de la habitacion en el caso de que se actualice la imagen
		public function update_grupos($id,$nombre,$carrera){
			$sql = "Update grupos set nombre='" . $nombre . "',id_carrera='" . $carrera . "' Where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}
		
		//Funcion para ingresar datos a la lista clasealumno, se pasan como parametros el id_clase y id_alumno
		public function clasealumno($id_clase,$id_alumno){
			$sql = "Insert into clasealumno Values ('" . $id_clase . "','" . $id_alumno . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para ingresar datos a la lista clasealumno, se pasan como parametros el id_clase y id_alumno
		public function grupoclase($id_grupo,$id_materia){
			$sql = "Insert into grupoclase Values ('" . $id_grupo . "','" . $id_materia . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

	}
	
	

?>	

