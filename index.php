<?php

	//El index muestra la salida de las vistas al usuario, tambuen a traves de el enviaremos las distintas acciones que el usuario envie al controlador
	session_start();//Se inicia la session de usuario
	$url = getcwd();
	//Incluimos la pagina Login, para iniciar el sistema
	if(empty($_SESSION['user'])){//Si no existe una session, se manda la pagina para iniciar session
		include "views/modules/login.php";
	}
	if(!empty($_SESSION['user'])){//Si existe una session se manda a la pagina principal
		//require_once establece el codigo del archivo utilizado
		require_once "controllers/controller.php";
		require_once "models/model.php";

		$mvc = new mvcController();
		$mvc->plantilla();
	}

?>