<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['actualizarCliente'])){
		//Obtenemos los datos ingresados
		$nombre = $_POST['nombre'];
		$email  = $_POST['email'];
		$tel    = $_POST['telefono'];

		//Llamamos a la funcion para actualizar los datos
		$db->update_cliente($_GET['id'],$nombre,$tel,$email);
		//header("Location: index.php?action=clientes");//Se refresca la pagina para cargar el main
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=clientes");
                  </script>';
	}
	if(isset($_POST['cancelar'])){//Condicion para salir del formulario
		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=clientes");
                  </script>';
	}

	//Se realiza la consulta del registro a modificar llamando a la funcion
	//$data contiene la ifromacion del cliente solicitado
	$data = $db->one($_GET['id'],"clientes");
	

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
	                                                    			<div class="form-group col-md-12">
															            <input name="nombre" type="text" class="form-control" id="inputNombre" placeholder="Nombre completo" value="<?php echo $data[1] ?>">
															            <label for="inputNombre" class="col-form-label">Nombre</label>
															        </div>
	                                                    		</div>

															    <div class="form-row">
															        <div class="form-group col-md-6">
															            <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $data[3] ?>">
															            <label for="inputEmail" class="col-form-label">Email</label>
															        </div>
															        <div class="form-group col-md-6">
															            <input name="telefono" type="text" class="form-control" id="inputTelefono" placeholder="Telefono" value="<?php echo $data[2] ?>">
															            <label for="inputTelefono" class="col-form-label">Telefono</label>
															        </div>
															    </div>

															    <button type="submit" name="actualizarCliente" class="btn btn-primary">Guardar</button>
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