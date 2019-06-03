<?php

	class mvcController{
		//Llamar a la plantilla
		public function plantilla(){
			//Inlcude se utiliza para invocar el archivo que tiene el codigo HTML
			include "views/template.php";
		}

		//Interaccion con el usuario
		public function enlacesPaginasController(){
			if(isset($_GET["action"])){
				$enlacesController = $_GET["action"];
			}
			else{
				$enlacesController = "index";
			}
			$respuesta = enlacesPaginas::enlacesPaginasModel($enlacesController);

			include $respuesta;
		}
	}

?>