<?php

	class enlacesPaginas{
		public function enlacesPaginasModel($enlacesModel){
			if($enlacesModel=="alumnos" || $enlacesModel=="eliminarAlumno" || $enlacesModel=="editarAlumno" ||
			   $enlacesModel=="maestros" || $enlacesModel=="eliminarMaestro" || $enlacesModel=="editarMaestro"){
				$module = "views/modules/".$enlacesModel.".php";
			}
			else if ($enlacesModel=="index") {
				$module = "views/modules/inicio.php";
			}
			else{
				$module = "views/modules/inicio.php";
			}
			return $module;
		}
	}

?>