<?php

	//echo getcwd();
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos
    $db->delete_reservacion($_GET['id'],$_GET['hab']);//Funcion que elimina un cliente en especifico
    //Se recarga la pagina principal para reflejar los cambios
    echo '<script type="text/javascript">
                    window.location.replace("index.php?action=reservaciones");
                  </script>';/**/

?>