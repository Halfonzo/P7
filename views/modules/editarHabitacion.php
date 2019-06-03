<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['actualizarHabitacion'])){
		//Obtenemos los datos ingresados
		$numero = $_POST['numero'];
		$tipo   = $_POST['tipo'];
		$precio = $_POST['precio'];
		$desc   = $_POST['desc'];

		if(empty($_FILES['uploadedfile']['name'])){
			//Llamamos a la funcion para actualizar los datos
			$db->update_habitacion($_GET['id'],$tipo,$precio,$numero,$desc);
		}
		else{
			//Proceso para guardar la imagen en el servidor
			$target_path = "assets/images/habitaciones/";
			$target_path = $target_path . basename($_FILES['uploadedfile']['name']); 
			move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
			//Llamamos a la funcion para actualizar los datos
			$db->update_habitacion_img($_GET['id'],$tipo,$precio,$numero,$desc,$target_path);
		}

		//header("Location: index.php?action=clientes");//Se refresca la pagina para cargar el main
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=habitaciones");
                  </script>';/**/
	}
	if(isset($_POST['cancelar'])){//Condicion para salir del formulario
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=habitaciones");
                  </script>';
	}

	//Se realiza la consulta del registro a modificar llamando a la funcion
	//$data contiene la ifromacion del cliente solicitado
	$data = $db->one($_GET['id'],"habitaciones");
	

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
	                                                    	<form action = "" method = "post" enctype="multipart/form-data" action="http://localhost/TAW/Practica6/index.php?action=habitaciones">

	                                                    		<div class="form-row">

	                                                    			<div class="form-group col-md-4">
															            <input name="numero" type="text" class="form-control" id="inputNumero" placeholder="Ej. A101" value="<?php echo $data[3] ?>">
															            <label for="inputNumero" class="col-form-label">Numero</label>
															        </div>

															        <div class="form-group col-md-4">
																        <label for="Select1">Tipo</label>
																        <select name="tipo" class="form-control" id="Select1">
																            <option <?php if($data[1]=='Simple'){echo 'selected';} ?>>Simple</option>
																            <option <?php if($data[1]=='Doble'){echo 'selected';} ?>>Doble</option>
																            <option <?php if($data[1]=='Matrimonial'){echo 'selected';} ?>>Matrimonial</option>
																        </select>
																    </div>

																    <div class="form-group col-md-4">
															            <input name="precio" type="number" step="any" class="form-control" id="inputPrecio" placeholder="Ej. 550.99" value="<?php echo $data[2] ?>">
															            <label for="inputPrecio" class="col-form-label">Precio</label>
															        </div>

	                                                    		</div>

															    <div class="form-row">

															        <div class="form-group col-md-12">
																        <textarea name="desc" class="form-control" id="Textarea1" rows="1"><?php echo $data[4] ?></textarea>
																        <label for="Textarea1">&nbsp;&nbsp;Descripción</label>
																    </div>

															    </div>

															    <div class="form-row">
															    	<div class="form-group col-md-6">
																			<input class="btn btn-primary" name="uploadedfile" type="file" />
															    	</div>
															    	<div class="form-group col-md-6">
															    		<font size="1">*Si no selecciona una nueva imagen, se mantendra la antigua por defecto.</font>
															    	</div>
															    </div>

															    <button type="submit" name="actualizarHabitacion" class="btn btn-primary">Guardar</button>
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