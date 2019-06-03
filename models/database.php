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
		public function create_habitacion($numero,$tipo,$precio,$desc,$img){
			$sql = "Insert into habitaciones (tipo,precio,numero,descripcion,estado,img) values('" . $tipo ."','" . $precio . "','" . $numero . "','" . $desc . "','Disponible','" . $img . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para realizar el registro de una nueva reservacion en la base de datos, se pasan los valores ingresados por parametro
		public function create_reservacion($habitacion,$cliente,$fecha,$dias){
			$sql = "Insert into reservaciones (id_cliente,id_habitacion,fecha,dias) values('" . $cliente ."','" . $habitacion . "','" . $fecha . "','" . $dias . "')";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();

  			//Al reservar una habitacion se debe actualizar el estado de la habitacion seleccionada
  			$sql = "Update habitaciones set estado='Ocupado' Where id='" . $habitacion . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		

		

		

		//Funcion que actualizara los datos de la habitacion en el caso de que se actualice la imagen
		public function update_habitacion_img($id,$tipo,$precio,$numero,$desc,$img){
			$sql = "Update habitaciones set tipo='" . $tipo . "',precio='" . $precio . "',numero='" . $numero . "',descripcion='" . $desc . "',img='" . $img . "' Where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion que actualizara los datos de la habitacion en el caso de que NO se actualice la imagen
		public function update_habitacion($id,$tipo,$precio,$numero,$desc){
			$sql = "Update habitaciones set tipo='" . $tipo . "',precio='" . $precio . "',numero='" . $numero . "',descripcion='" . $desc . "' Where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		

		//Funcion especial para eliminar la reservacion y modificar el estado de la habitacion
		public function delete_reservacion($id,$hab){
			$sql = "Delete from reservaciones Where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();

  			//Actualizamos la habitacion
  			$sql = "Update habitaciones set estado='Disponible' where numero='" . $hab . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para recabar los datos y utilizar un Select2
		public function select2(){
			$sql = "Select id,numero From habitaciones where estado='Disponible'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			//$return = $stmt->fetch();
  			return $stmt;
		}

		//Funcion para recabar los datos y utilizar un Select2
		public function select2_user(){
			$sql = "Select id,nombre From clientes";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			//$return = $stmt->fetch();
  			return $stmt;
		}

		//Funcion especial para recavar los datos de la reservacion tomando datos de dstintas tablas
		public function reser_especial(){
			$sql = "SELECT id,(Select nombre from clientes where id=id_cliente)as cliente,(Select numero from habitaciones where id=id_habitacion)as numero, (Select tipo from habitaciones WHERE id=id_habitacion)as tipo, fecha, dias FROM reservaciones";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			//$return = $stmt->fetch();
  			return $stmt;
		}

		//Funcion para modificar el registro de la reservacion, consulta datos de multiples tablas
		public function edit_especial($id){
			$sql = "SELECT (Select nombre from clientes where id=id_cliente)as cliente,(Select numero from habitaciones where id=id_habitacion)as numero, fecha, dias, (Select id from clientes where id=id_cliente)as id_cliente, (Select id from habitaciones where id=id_habitacion)as id_habitacion FROM reservaciones Where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			$return = $stmt->fetch();
  			return $return;
		}

		//Funcion para actualizar los datos de la reservacion
		public function update_especial($ida,$idn,$id,$habitacion,$cliente,$fecha,$dias){
			//Caso especial para modificar el estado de la habitacion
			$sql = "Update habitaciones set estado='Disponible' where id='" . $ida . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();

  			//Se actualizan los datos de la nueva habitacion
  			$sql = "Update habitaciones set estado='Ocupado' where id='" . $idn . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();

  			//Se actualizan los datos de la tabla de reservaciones
  			$sql = "Update reservaciones set id_cliente='" . $cliente . "', id_habitacion='" . $habitacion ."', fecha='" . $fecha . "',dias='" . $dias . "' where id='" . $id . "'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
		}

		//Funcion para consultar las ganancias por el mes especificado
		public function ganancias($fecha){
			$sql = "SELECT ((SELECT precio from habitaciones WHERE id=id_habitacion)*dias)as ganancias FROM reservaciones WHERE fecha LIKE '%" . $fecha . "%'";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			//$return = $stmt->fetch();
  			return $stmt;
		}

		//Funcion para calcular el numero de clientes de acurdo a sus visitas
		public function visitas(){
			$sql = "SELECT COUNT(id)as total, (SELECT COUNT(id) FROM clientes WHERE visitas>5)as habituales, (SELECT COUNT(id) FROM clientes WHERE visitas<=5)as esporadicos FROM clientes";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			$return = $stmt->fetch();
  			return $return;
		}

		//Funcion para calcular el numero de hbaitaciones ocupadas y desocupadas
		public function habit(){
			$sql = "SELECT COUNT(id)as total, (SELECT COUNT(id) from habitaciones WHERE estado='Disponible') as disponible, (SELECT COUNT(id) from habitaciones WHERE estado='Ocupado') as ocupado FROM habitaciones";
			$stmt = $this->con->prepare($sql);
  			$stmt->execute();
  			$return = $stmt->fetch();
  			return $return;
		}

	}
	
	

?>	

