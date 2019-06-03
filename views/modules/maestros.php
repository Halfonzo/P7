<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['registrarMaestro'])){
		//Obtenemos los datos ingresados
		$matricula = $_POST['matricula'];
		$nombre    = $_POST['nombre'];
		$email     = $_POST['email'];
		$password  = $_POST['password'];
		$carrera   = $_POST['carrera'];
		$nivel     = $_POST['nivel'];

		//echo $carrera.$tutor;
		//LLamamos a la funcion que registrara los datos en la bd, le enviamos los parametros
		$db->create_maestro($matricula,$nombre,$email,$password,$carrera,$nivel);
	}

?>
<div class="content custom-scrollbar">

    <div id="project-dashboard" class="page-layout simple right-sidebar">

        <div class="page-content-wrapper custom-scrollbar">







            <!-- CONTENT -->
            <div class="page-content">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link btn active" id="home-tab" data-toggle="tab" href="#home-tab-pane" role="tab" aria-controls="home-tab-pane" aria-expanded="true"><i class="icon s-4 icon-account-card-details"></i>Ver</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn" id="budget-summary-tab" data-toggle="tab" href="#budget-summary-tab-pane" role="tab" aria-controls="budget-summary-tab-pane"><i class="icon s-4 icon-account-edit"></i>Registrar</a>
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
	                                                    <h5>Maestros Registrados</h5>
	                                                </div>
	                                                <div class="toggle-source-preview"></div>

	                                                <i class="icon s-6 icon-account-search"></i>
	                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
	                                                <input type="text" id="search" placeholder="Buscador...">
	                                                
	                                            </div>

	                                            <div class="source-preview-wrapper">
	                                                <div class="preview">
	                                                    <div class="preview-elements">
	                                                    	
	                                                    	<!-- Empieza la construccion del formulario de clientes -->
	                                                    	<table id="sample-data-table" class="table">
																<thead>
																    <tr>
																        <th class="secondary-text">
																            <div class="table-header">
																                <span class="column-title">Matricula</span>
																            </div>
																        </th>
																        <th class="secondary-text">
																            <div class="table-header">
																                <span class="column-title">Nombre</span>
																            </div>
																        </th>
																        <th class="secondary-text">
																            <div class="table-header">
																                <span class="column-title">E-Mail</span>
																            </div>
																        </th>
																        <th class="secondary-text">
																            <div class="table-header">
																                <span class="column-title">Carrera</span>
																            </div>
																        </th>
																        <th class="secondary-text">
																            <div class="table-header">
																                <span class="column-title">Controles</span>
																            </div>
																        </th>
																    </tr>
																</thead>
																

																	<!-- Inicia el llenado de la tabla con datos -->
																	<?php 
																	//Se llama la funcion que retorna los datos de la tabla
													                $listado = $db->especial("SELECT num_empleado, nombre, email, (SELECT nombre FROM carrera WHERE id = id_carrera) FROM maestros");
																	?>
													                <tbody>
																	<?php
													                    //Funcion que recorre todos los registros y los almacena para mostrarlos en la pagina
													                    while( $row = $listado->fetch() ){
																		#while ($row=mysqli_fetch_object($listado)){
																			$t_matricula=$row[0];
																			$t_nombre=$row[1];
																			$t_email=$row[2];
																			$t_carrera=$row[3];
																	?>
																		<tr>
																			<td><?php echo $t_matricula;?></td>
													                        <td><?php echo $t_nombre;?></td>
													                        <td><?php echo $t_email;?></td>
													                        <td><?php echo $t_carrera;?></td>
													                        <td>
																	        <a onclick="document.location.href='index.php?action=editarMaestro&id=<?php echo $t_matricula ?>'"><i class="icon s-7 icon-account-edit"></i></a>
																	        &nbsp;&nbsp;&nbsp;&nbsp;
																	        <a onclick="if(confirm('Se eliminara el Maestro')){document.location.href='index.php?action=eliminarMaestro&id=<?php echo $t_matricula ?>'}"><i class="icon s-7 icon-account-remove"></i></a>
													                        </td>
													                    </tr>	
																	<?php
																		}
																	?>
																	</tbody>
																	<!-- Temina el llenado de la tabla con datos -->

															</table>

															<!-- Este Scrip funciona para agregar los controles de ordenamiento -->
															<script type="text/javascript">
															$('#sample-data-table').DataTable({
															    responsive: true,
															    dom       : 'rt<"dataTables_footer"ip>'
															});
															</script>

															<!-- Este scrip funciona para realizar busquedas en los registros de la tabla -->
															<script>
															 // Write on keyup event of keyword input element
															 $(document).ready(function(){
															 $("#search").keyup(function(){
															 _this = this;
															 // Show only matching TR, hide rest of them
															 $.each($("#sample-data-table tbody tr"), function() {
															 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
															 $(this).hide();
															 else
															 $(this).show();
															 });
															 });
															});
															</script>
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

                    <div class="tab-pane fade p-3" id="budget-summary-tab-pane" role="tabpanel" aria-labelledby="budget-summary-tab">

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
	                                                    <h5>Registrar Maestros</h5>
	                                                </div>
	                                            </div>

	                                            <div class="source-preview-wrapper">
	                                                <div class="preview">
	                                                    <div class="preview-elements">

	                                                    	<!-- Obtenemos los valores para integrarlos con Select2 -->
	                                                    	<?php 
	                                                    		$select_carreras="";
	                                                    		$datos2 = $db->especial("Select * from carrera");
	                                                    		while( $row = $datos2->fetch() ){
	                                                    			$select_carreras = $select_carreras."<option value='".$row[0]."'>".$row[1]."</option>";
	                                                    		}

	                                                    	?>
	                                                    	
	                                                    	<!-- Empieza la construccion del formulario de clientes -->
	                                                    	<form action = "" method = "post" onsubmit="return checkSubmit();">

	                                                    		<div class="form-row">
	                                                    			<div class="form-group col-md-4">
															            <input name="matricula" type="text" class="form-control" id="inputMatricula">
															            <label for="inputMatricula" class="col-form-label">Matricula</label>
															        </div>

															        <div class="form-group col-md-4">
															            <input name="nombre" type="text" class="form-control" id="inputNombre" placeholder="Nombre completo">
															            <label for="inputNombre" class="col-form-label">Nombre</label>
															        </div>

															        <div class="form-group col-md-4">
															            <input name="email" type="email" class="form-control" id="inputEmail">
															            <label for="inputEmail" class="col-form-label">Email</label>
															        </div>
	                                                    		</div>

															    <div class="form-row">

															    	<div class="form-group col-md-2">
															            <input name="password" type="password" class="form-control" id="inputPass" placeholder="Contraseña">
															            <label for="inputPass" class="col-form-label">Contraseña</label>
															        </div>

															        <div class="form-group col-md-2">
															            <input name="password2" type="password" class="form-control" id="inputPass2" placeholder="Confirmar contraseña">
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
																		<option value="1">Total</option>
																		<option value="0" selected>Parcial</option>
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

															    <button type="submit" name="registrarMaestro" class="btn btn-primary">Registrar</button>
															</form>

															<script type="text/javascript">
																var statSend = false;
																function checkSubmit() {
																    if (!statSend) {
																        statSend = true;
																        return true;
																    } else {
																        alert("El formulario ya se esta enviando...");
																        return false;
																    }
																}
															</script>
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