<?php

	class enlacesPaginas{
		public function enlacesPaginasModel($enlacesModel){
			if($enlacesModel=="alumnos" || $enlacesModel=="eliminarAlumno" || $enlacesModel=="editarAlumno" ||
			   $enlacesModel=="maestros" || $enlacesModel=="eliminarMaestro" || $enlacesModel=="editarMaestro" ||
			   $enlacesModel=="carreras" || $enlacesModel=="eliminarCarrera" || $enlacesModel=="editarCarrera" ||
			   $enlacesModel=="materias" || $enlacesModel=="eliminarMateria" || $enlacesModel=="editarMateria" ||
			   $enlacesModel=="grupos" || $enlacesModel=="eliminarGrupo" || $enlacesModel=="editarGrupo" ||
			   $enlacesModel=="alum-mate" || $enlacesModel=="eliminarAlum-Mate" || $enlacesModel=="grup-clase" ||
			   $enlacesModel=="eliminarGrup-Clase"){
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