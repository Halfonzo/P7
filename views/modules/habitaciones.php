<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['registrarHabita'])){
		//echo getcwd();

		//Proceso para guardar la imagen en el servidor
		$target_path = "assets/images/habitaciones/";
		$target_path = $target_path . basename($_FILES['uploadedfile']['name']); 
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);

		//Obtenemos los datos ingresados
		$numero = $_POST['numero'];
		$tipo   = $_POST['tipo'];
		$precio = $_POST['precio'];
		$desc   = $_POST['desc'];
		$img    = $target_path;

		$db->create_habitacion($numero,$tipo,$precio,$desc,$img);

	}

?>
<div class="content custom-scrollbar">

    <div id="project-dashboard" class="page-layout simple right-sidebar">

        <div class="page-content-wrapper custom-scrollbar">







            <!-- CONTENT -->
            <div class="page-content">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link btn active" id="home-tab" data-toggle="tab" href="#home-tab-pane" role="tab" aria-controls="home-tab-pane" aria-expanded="true"><i class="icon s-4 icon-key-change"></i>Ver</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn" id="budget-summary-tab" data-toggle="tab" href="#budget-summary-tab-pane" role="tab" aria-controls="budget-summary-tab-pane"><i class="icon s-4 icon-key-plus"></i>Registrar</a>
                    </li>

                </ul>

                <div class="tab-content">

                	<div class="tab-pane fade show active p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">
                        
                        <!-- WIDGET GROUP -->
                        <div class="widget-group row no-gutters">

                            <!-- WIDGET 6 -->
                            <div class="col-12 col-lg-9	 p-3">

                                <div class="widget widget6 card">

                                    <div class="widget-header px-4 row no-gutters align-items-center justify-content-between">

                                        <div class="col">
                                            <span class="h6">Habitaciones</span>
                                        </div>

                                        <div class="toggle-source-preview"></div>

                                        <i class="icon s-6 icon-account-search"></i>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                        <input type="text" id="search" placeholder="Buscador...">

                                    </div>

                                    <div class="widget-content">

                                        <!-- Empieza la construccion del formulario de clientes -->
                                    	<table id="sample-data-table" class="table">
											<thead>
											    <tr>
											        <th class="secondary-text">
											            <div class="table-header">
											                <span class="column-title">ID</span>
											            </div>
											        </th>
											        <th class="secondary-text">
											            <div class="table-header">
											                <span class="column-title">Número</span>
											            </div>
											        </th>
											        <th class="secondary-text">
											            <div class="table-header">
											                <span class="column-title">Tipo</span>
											            </div>
											        </th>
											        <th class="secondary-text">
											            <div class="table-header">
											                <span class="column-title">Precio</span>
											            </div>
											        </th>
											        <th class="secondary-text">
											            <div class="table-header">
											                <span class="column-title">Estado</span>
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
								                $listado = $db->table("habitaciones");
												?>
								                <tbody>
												<?php
								                    //Funcion que recorre todos los registros y los almacena para mostrarlos en la pagina
								                    while( $row = $listado->fetch() ){
													#while ($row=mysqli_fetch_object($listado)){
														$t_id=$row[0];
														$t_numero=$row[3];
														$t_tipo=$row[1];
														$t_precio=$row[2];
														$t_img=$row[6];
														$t_des=$row[4];
														$t_est=$row[5];
												?>
													<tr>
														<td><?php echo $t_id;?></td>
								                        <td><?php echo $t_numero;?></td>
								                        <td><?php echo $t_tipo;?></td>
								                        <td><?php echo "$".$t_precio;?></td>
								                        <td><?php echo $t_est;?></td>
								                        <td>
												        <a onclick="document.location.href='index.php?action=editarHabitacion&id=<?php echo $t_id ?>'"><i class="icon s-5 icon-pencil"></i></a>
												        &nbsp;&nbsp;&nbsp;&nbsp;
												        <a onclick="if(confirm('Se eliminara la habitacion')){document.location.href='index.php?action=eliminarHabitacion&id=<?php echo $t_id ?>'}"><i class="icon s-5 icon-key-remove"></i></a>
												        &nbsp;&nbsp;&nbsp;&nbsp;
												        <a onclick="$('#imgs').attr('src','<?php echo $t_img ?>');document.getElementById('desm').innerHTML = '<?php echo $t_des ?>';"><i class="icon s-5 icon-eye"></i></a>
												        &nbsp;&nbsp;&nbsp;&nbsp;
												        <a <?php if($t_est=="Ocupado"){ echo 'hidden';} ?> onclick="document.location.href='index.php?action=reservaciones&id=<?php echo $t_id ?>'"><i class="icon s-5 icon-arrow-right-drop-circle"></i></a>
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
                            <!-- / WIDGET 6 -->
                            <!-- WIDGET 6 -->
                            <div class="col-12 col-lg-3	 p-3">

                            	<div class="card mb-3">
								    <img id="imgs" class="card-img-top" src="assets/images/habitaciones/ojo.png" alt="Card image cap" height="270">
								    <div class="card-body">
								        <h4 class="card-title">Descripción</h4>
								        <p id="desm" class="card-text">...</p>
								        
								    </div>
								</div>

                            	<!--<div id="desm"></div>
                                <img id="imgs" src="assets/images/hotel.png">-->

                            </div>
                            <!-- / WIDGET 6 -->

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
	                                                    <h5>Registrar Habitación</h5>
	                                                </div>
	                                            </div>

	                                            <div class="source-preview-wrapper">
	                                                <div class="preview">
	                                                    <div class="preview-elements">
	                                                    	
	                                                    	<!-- Empieza la construccion del formulario de clientes -->
	                                                    	<form action = "" method = "post" enctype="multipart/form-data" action="http://localhost/TAW/Practica6/index.php?action=habitaciones">

	                                                    		<div class="form-row">

	                                                    			<div class="form-group col-md-4">
															            <input name="numero" type="text" class="form-control" id="inputNumero" placeholder="Ej. A101">
															            <label for="inputNumero" class="col-form-label">Numero</label>
															        </div>

															        <div class="form-group col-md-4">
																        <label for="Select1">Tipo</label>
																        <select name="tipo" class="form-control" id="Select1">
																            <option>Simple</option>
																            <option>Doble</option>
																            <option>Matrimonial</option>
																        </select>
																    </div>

																    <div class="form-group col-md-4">
															            <input name="precio" type="number" step="any" class="form-control" id="inputPrecio" placeholder="Ej. 550.99">
															            <label for="inputPrecio" class="col-form-label">Precio</label>
															        </div>

	                                                    		</div>

															    <div class="form-row">

															        <div class="form-group col-md-12">
																        <textarea name="desc" class="form-control" id="Textarea1" rows="1"></textarea>
																        <label for="Textarea1">&nbsp;&nbsp;Descripción</label>
																    </div>

															    </div>

															    <div class="form-row">
															    	<div class="form-group col-md-6">
																			<input class="btn btn-primary" name="uploadedfile" type="file" />
															    	</div>
															    </div>

															    <button type="submit" name="registrarHabita" class="btn btn-primary">Registrar</button>

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