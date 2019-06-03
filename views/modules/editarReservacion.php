<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

    //Se realiza la consulta del registro a modificar llamando a la funcion
	//$data contiene la ifromacion del cliente solicitado
	$data = $db->edit_especial($_GET['id']);

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['actualizarReservacion'])){
		//Obtenemos los datos ingresados
		$habitacion = $_POST['itemName2'];
		$cliente   = $_POST['itemName'];
		$fecha     = $_POST['fecha'];
		$dias      = $_POST['dias'];

		//Llamamos a la funcion para actualizar los datos
		$db->update_especial($data[5],$habitacion,$_GET['id'],$habitacion,$cliente,$fecha,$dias);
		//header("Location: index.php?action=clientes");//Se refresca la pagina para cargar el main
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=reservaciones");
                  </script>';
	}
	if(isset($_POST['cancelar'])){//Condicion para salir del formulario
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=reservaciones");
                  </script>';
	}
	

?>
<div class="content custom-scrollbar">

    <div id="project-dashboard" class="page-layout simple right-sidebar">

        <div class="page-content-wrapper custom-scrollbar">







            <!-- CONTENT -->
            <div class="page-content">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link btn active" id="home-tab" data-toggle="tab" href="#home-tab-pane" role="tab" aria-controls="home-tab-pane" aria-expanded="true"><i class="icon s-4 icon-book-minus"></i>Editar</a>
                    </li>

                </ul>

                <div class="tab-content">

                	<div class="tab-pane fade show active p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">
                        
                        <div class="doc forms-doc page-layout simple full-width">
	                        <!-- CONTENT -->
	                        <div class="page-content p-6">
	                            <div class="content container">
	                                <div class="row">
                                		
	                                	<!-- FORM CONTROLS -->
	                                    <div class="col-12">
	                                        <div class="example">
	                                            <div class="description">
	                                                <div class="description-text">
	                                                    <h5>Modificar Infromación</h5>
	                                                </div>
	                                                <div class="toggle-source-preview"></div>
	                                                
	                                            </div>

	                                            <div class="source-preview-wrapper">
	                                                <div class="preview">
	                                                    <div class="preview-elements">
	                                                    	
	                                                    	<!-- Empieza la construccion del formulario de clientes -->
	                                                    	<form action = "" method = "post">

	                                                    		<div class="form-row">
	                                                    			<div class="form-group col-md-6">
	                                                                <label for="items2">Habitación</label>
	                                                                <select name="itemName2" class="itemName2 form-control" id="items2">
	                                                                	<option value="<?php echo $data[5] ?>" selected><?php echo $data[1] ?></option>
	                                                                </select>
	                                                            	</div>

	                                                                <div class="form-group col-md-6">
	                                                                <label for="items2">Cliente</label>
	                                                                <select name="itemName" class="itemName form-control" id="items">
	                                                                	<option value="<?php echo $data[4] ?>" selected><?php echo $data[0] ?></option>
	                                                                </select>
	                                                            	</div>

	                                                            <script>
	                                                                  $('.itemName2').select2({
	                                                                    placeholder: 'Seleccione una Habitacion',
	                                                                    ajax: {
	                                                                      url: 'select2_habitacion.php',
	                                                                      dataType: 'json',
	                                                                      delay: 250,
	                                                                      processResults: function (data) {
	                                                                        return {
	                                                                          results: data
	                                                                        };
	                                                                      },
	                                                                      cache: true
	                                                                    }
	                                                                  });
	                                                            </script>
	                                                            <script>
	                                                                  $('.itemName').select2({
	                                                                    placeholder: 'Seleccione una Habitacion',
	                                                                    ajax: {
	                                                                      url: 'select2_cliente.php',
	                                                                      dataType: 'json',
	                                                                      delay: 250,
	                                                                      processResults: function (data) {
	                                                                        return {
	                                                                          results: data
	                                                                        };
	                                                                      },
	                                                                      cache: true
	                                                                    }
	                                                                  });
	                                                            </script>
	                                                    		</div>

															    <div class="form-row">
															        <div class="form-group col-md-6">
															            <input name="fecha" class="form-control" type="date" value="<?php echo $data[2]; ?>" id="example-date-input"/>
                                                                		<label for="example-date-input">Fecha de ingreso</label>
															        </div>
															        <div class="form-group col-md-6">
															            <input name="dias" class="form-control" type="number" value="<?php echo $data[3] ?>" id="example-number-input"/>
                                                                		<label for="example-number-input">Dias de hospedaje</label>
															        </div>
															    </div>

															    <button type="submit" name="actualizarReservacion" class="btn btn-primary">Guardar</button>
															    &nbsp;&nbsp;&nbsp;&nbsp;
															    <button type="submit" name="cancelar" class="btn btn-primary">Cancelar</button>
															</form>
	                                                    	<!-- Termina la construccion del formulario del cliente-->

	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>

	                                </div>
	                            </div>
	                        </div>
                    	</div>

                    </div>

                </div>

            </div>
            <!-- / CONTENT -->

        </div>

    </div>

    <script type="text/javascript" src="assets/js/apps/dashboard/project.js"></script>

</div>