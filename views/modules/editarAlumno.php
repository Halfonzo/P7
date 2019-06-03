<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['actualizarAlumno'])){
		//Obtenemos los datos ingresados
		$matricula = $_POST['matricula'];
		$nombre    = $_POST['nombre'];
		$carrera   = $_POST['carrera'];
		$tutor     = $_POST['tutor'];

		//Llamamos a la funcion para actualizar los datos
		$db->update_alumno($_GET['id'],$nombre,$carrera,$tutor);
		//header("Location: index.php?action=clientes");//Se refresca la pagina para cargar el main
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=alumnos");
                  </script>';
	}
	if(isset($_POST['cancelar'])){//Condicion para salir del formulario
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=alumnos");
                  </script>';
	}

	//Se realiza la consulta del registro a modificar llamando a la funcion
	//$data contiene la ifromacion del cliente solicitado
	$data = $db->select_one($_GET['id'],"matricula","alumnos");
	

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
	                                                    <h5>Modificar Alumno</h5>
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
	                                                    			if($row[0]==$data[2]){ $select_carreras .= ' selected';}
	                                                    			$select_carreras .= ">".$row[1]."</option>";
	                                                    		}

	                                                    		$select_tutor="";
	                                                    		$datos2 = $db->especial("Select num_empleado,nombre from maestros");
	                                                    		while( $row = $datos2->fetch() ){
	                                                    			$select_tutor = $select_tutor."<option value='".$row[0]."'";
	                                                    			if($row[0]==$data[3]){ $select_tutor .= ' selected';}
	                                                    			$select_tutor .= ">".$row[1]."</option>";
	                                                    		}
	                                                    	?>
	                                                    	
	                                                    	<!-- Empieza la construccion del formulario de clientes -->
	                                                    	<form action = "" method = "post" onsubmit="return checkSubmit();">

	                                                    		<div class="form-row">
	                                                    			<div class="form-group col-md-4">
															            <input name="matricula" type="text" class="form-control" id="inputMatricula" value="<?php echo $data[0] ?>">
															            <label for="inputMatricula" class="col-form-label">Matricula</label>
															        </div>

															        <div class="form-group col-md-8">
															            <input name="nombre" type="text" class="form-control" id="inputNombre" placeholder="Nombre completo" value="<?php echo $data[1] ?>">
															            <label for="inputNombre" class="col-form-label">Nombre</label>
															        </div>
	                                                    		</div>

															    <div class="form-row">
															    	<div class="form-group col-md-1"><label class="col-form-label">Carrera</label></div>
															        <div class="form-group col-md-5">
															            <select name="carrera" id="carreras" class="js-example-basic-multiple" style="width: 100%">
																		<?php echo $select_carreras ?>
																		</select>
															        </div>

															        <div class="form-group col-md-1"><label class="col-form-label">Tutor:</label></div>
															        <div class="form-group col-md-5">
															            <select name="tutor" id="tutores" class="js-example-basic-multiple" style="width: 100%">
																		<?php echo $select_tutor ?>
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

															    <button type="submit" name="actualizarAlumno" class="btn btn-primary">Actualizar</button>
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