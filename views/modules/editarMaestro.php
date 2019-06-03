<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['actualizarMaestro'])){
		//Obtenemos los datos ingresados
		$matricula = $_POST['matricula'];
		$nombre    = $_POST['nombre'];
		$email     = $_POST['email'];
		$password  = $_POST['password'];
		$carrera   = $_POST['carrera'];
		$nivel     = $_POST['nivel'];

		//Llamamos a la funcion para actualizar los datos
		$db->update_maestro($matricula,$nombre,$email,$password,$carrera,$nivel);
		//header("Location: index.php?action=clientes");//Se refresca la pagina para cargar el main
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=maestros");
                  </script>';
	}
	if(isset($_POST['cancelar'])){//Condicion para salir del formulario
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=maestros");
                  </script>';
	}

	//Se realiza la consulta del registro a modificar llamando a la funcion
	//$data contiene la ifromacion del cliente solicitado
	$data = $db->select_one($_GET['id'],"num_empleado","maestros");
	

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
	                                                    <h5>Modificar Maestros</h5>
	                                                </div>
	                                                <div class="toggle-source-preview"></div>
	                                                
	                                            </div>

	                                            <div class="source-preview-wrapper">
	                                                <div class="preview">
	                                                    <div class="preview-elements">
	                                                    	
	                                                    	<!-- Empieza la construccion del formulario de clientes -->
	                                                    	<!-- Obtenemos los valores para integrarlos con Select2 -->
	                                                    	<?php 
	                                                    		$select_carreras="";
	                                                    		$datos2 = $db->especial("Select * from carrera");
	                                                    		while( $row = $datos2->fetch() ){
	                                                    			$select_carreras = $select_carreras."<option value='".$row[0]."'";
	                                                    			if($row[0]==$data[4]){ $select_carreras .= ' selected';}
	                                                    			$select_carreras .= ">".$row[1]."</option>";
	                                                    		}

	                                                    	?>
	                                                    	
	                                                    	<!-- Empieza la construccion del formulario de clientes -->
	                                                    	<form action = "" method = "post" onsubmit="return checkSubmit();">

	                                                    		<div class="form-row">
	                                                    			<div class="form-group col-md-4">
															            <input name="matricula" type="text" class="form-control" id="inputMatricula" value="<?php echo $data[0] ?>">
															            <label for="inputMatricula" class="col-form-label">Matricula</label>
															        </div>

															        <div class="form-group col-md-4">
															            <input name="nombre" type="text" class="form-control" id="inputNombre" placeholder="Nombre completo" value="<?php echo $data[1] ?>">
															            <label for="inputNombre" class="col-form-label">Nombre</label>
															        </div>

															        <div class="form-group col-md-4">
															            <input name="email" type="email" class="form-control" id="inputEmail" value="<?php echo $data[2] ?>">
															            <label for="inputEmail" class="col-form-label">Email</label>
															        </div>
	                                                    		</div>

															    <div class="form-row">

															    	<div class="form-group col-md-2">
															            <input name="password" type="password" class="form-control" id="inputPass" placeholder="Contraseña" value="<?php echo $data[3] ?>">
															            <label for="inputPass" class="col-form-label">Contraseña</label>
															        </div>

															        <div class="form-group col-md-2">
															            <input name="password2" type="password" class="form-control" id="inputPass2" placeholder="Confirmar contraseña" value="<?php echo $data[3] ?>">
															            <label for="inputPass2" class="col-form-label">Confirmar</label>
															        </div>

															    	<div class="form-group col-md-1"><label class="col-form-label">Carrera</label></div>
															        <div class="form-group col-md-3">
															            <select name="carrera" id="carreras" class="js-example-basic-multiple" style="width: 100%">
																		<?php echo $select_carreras ?>
																		</select>
															        </div>

															        <div class="form-group col-md-1"><label class="col-form-label">Privilegios</label></div>
															        <div class="form-group col-md-3">
															            <select name="nivel" id="carreras" class="js-example-basic-multiple" style="width: 100%">
																		<option value="1" <?php if($data[5]==1){echo 'selected';} ?>>Total</option>
																		<option value="0" <?php if($data[5]==0){echo 'selected';} ?>>Parcial</option>
																		</select>
															        </div>

															    </div>

															    <?php
															    echo "<script>
																		$(document).ready(function() {
																		    $('.js-example-basic-multiple').select2();
																		});
																	</script>";
																?>

															    <button type="submit" name="actualizarMaestro" class="btn btn-primary">Registrar</button>
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