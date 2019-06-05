<?php

	//echo getcwd();
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos
    $db->especial("Delete From grupoclase Where id_materia = " . $_GET['id'] . " and id_grupo = " . $_GET['clase']);
    //echo "Delete From clasealumno Where id_alumno = " . $_GET['id'] . " and id_clase = " . $_GET['clase'];
    //Funcion que elimina un cliente en especifico
    //Se recarga la pagina principal para reflejar los cambios
    echo '<script type="text/javascript">
                    window.location.replace("index.php?action=grup-clase&value=' . $_GET['clase'] . '");
                  </script>';

?>