<?php

	//Formulario extra para realizar una consulta dinamica dentro de un DIV
	include "../../models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos
    $data = $db->especial("SELECT (SELECT nombre from carrera WHERE id = id_carrera) FROM grupos where id = ".$_GET['value']);
    $data = $data->fetch();

?>
<div class="form-row">
	&nbsp;&nbsp;&nbsp;&nbsp;

	<div class="form-group col-md-2"><label for="inputNombre" class="col-form-label">Carrera</label></div>
    <div class="form-group col-md-2">
        <input disabled name="carrera" type="text" class="form-control" id="inputCarrera" value="<?php echo $data[0] ?>">
    </div>
</div>