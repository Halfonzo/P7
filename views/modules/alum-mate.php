<?php
	
	include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

	//Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
	if(isset($_POST['registrarAlumno'])){
		//Obtenemos los datos ingresados
		$materia = $_POST['materia'];
		$alumno = $_POST['alumno'];

		$db->clasealumno($materia,$alumno);

		echo '<script type="text/javascript">
                    window.location.replace("index.php?action=alum-mate&value=' . $materia . '");
                  </script>';
		
	}

	$value="";
	if(!empty($_GET['value'])){
		$value = $_GET['value'];
		$data = $db->especial("SELECT nombre, (SELECT nombre FROM carrera WHERE id = id_carrera) FROM materias WHERE id = " . $_GET['value']);
		$data = $data->fetch();
	}

?>
<div class="content custom-scrollbar">

    <div id="project-dashboard" class="page-layout simple right-sidebar">

        <div class="page-content-wrapper custom-scrollbar">






        	<form action = "" method = "post">
            <!-- CONTENT -->
            <div class="page-content">

                <!-- WIDGET GROUP -->
                <div class="widget-group row no-gutters">
                	
                    <!-- WIDGET 6 -->
                    <div class="col-12 col-lg-6  p-3">
                        <div class="card mb-3">

                            <div class="widget-content">
                                <div class="source-preview-wrapper">
                                    <div class="preview">
                                        <div class="preview-elements">
                                            
                                            <!-- Empieza la construccion del formulario de clientes -->

                                            	<!-- Obtenemos los valores para integrarlos con Select2 -->
                                            	<?php 
                                            		$select_carreras="<option value='-1'>Clase</option>";
                                            		$datos2 = $db->especial("Select id,nombre from materias");
                                            		while( $row = $datos2->fetch() ){
                                            			$select_carreras = $select_carreras."<option";
                                            			if($row[0]==$value){$select_carreras .= " selected";}
                                            			$select_carreras .= " value='".$row[0]."'>".$row[1]."</option>";
                                            		}
                                        		?>

                                        		<div class="form-row">
                                        			&nbsp;&nbsp;&nbsp;&nbsp;
											        <div class="form-group col-md-5">
											            <select name="materia" id="carreras" class="js-example-basic-multiple" style="width: 100%" onchange="change_clase()">
														<?php echo $select_carreras ?>
														</select>
											        </div>
											    </div>

											    <script type="text/javascript">
											    	function change_clase(){
											    		$('#claseForm').load("http://localhost/TAW/Practica7/views/modules/form_clase.php?value="+document.getElementById('carreras').value);
											    		$('#listaalumnos').load("http://localhost/TAW/Practica7/views/modules/form_lista_alumno.php?value="+document.getElementById('carreras').value);
											    	}
											    </script>
											    <?php
											    echo "<script>
														$(document).ready(function() {
														    $('.js-example-basic-multiple').select2();
														});
													</script>";
												?>
                                            	
                                            	<div id="claseForm">
                                            		<div class="form-row">
                                            		&nbsp;&nbsp;&nbsp;&nbsp;
                                            		<div class="form-group col-md-2"><label for="inputNombre" class="col-form-label">Maestro</label></div>
											        <div class="form-group col-md-5">
											            <input disabled name="nombre" type="text" class="form-control" id="inputNombre" value="<?php if(!empty($data[0])){echo $data[0];} ?>">
											        </div>

                                            		<div class="form-group col-md-2"><label for="inputNombre" class="col-form-label">Carrera</label></div>
											        <div class="form-group col-md-2">
											            <input disabled name="carrera" type="text" class="form-control" id="inputCarrera" value="<?php if(!empty($data[1])){echo $data[1];} ?>">
											        </div>
                                        			</div>
                                            	</div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- WIDGET 6 -->
                    <div class="col-12 col-lg-6  p-3">
                        <div class="card mb-3">

                            <div class="widget-content">
                                <div class="source-preview-wrapper">
                                    <div class="preview">
                                        <div class="preview-elements">
                                            
                                            <!-- Empieza la construccion del formulario de clientes -->
                                            

                                            	<!-- Obtenemos los valores para integrarlos con Select2 -->
                                            	<?php 
                                            		$select_carreras2="<option value='-1'>Alumno</option>";
                                            		$datos2 = $db->especial("Select matricula,nombre from alumnos");
                                            		while( $row = $datos2->fetch() ){
                                            			$select_carreras2 = $select_carreras2."<option value='".$row[0]."'>".$row[1]."</option>";
                                            		}
                                        		?>

                                        		<div class="form-row">
                                        			&nbsp;&nbsp;&nbsp;&nbsp;
											        <div class="form-group col-md-5">
											            <select name="alumno" id="alumno" class="js-example-basic-multiple2" style="width: 100%" onchange="change_alumno()">
														<?php echo $select_carreras2 ?>
														</select>
											        </div>
											        <div class="form-group col-md-6">
											        	<button type="submit" name="registrarAlumno" id="registrarAlumno" class="btn btn-primary" >Registrar</button>
											        </div>
											    </div>

											    <script type="text/javascript">
											    	function change_alumno(){
											    		$('#alumnoForm').load("http://localhost/TAW/Practica7/views/modules/form_alumno.php?value="+document.getElementById('alumno').value);
											    	}
											    </script>
											    <?php
											    echo "<script>
														$(document).ready(function() {
														    $('.js-example-basic-multiple2').select2();
														});
													</script>";
												?>
                                            	
                                            	<div id="alumnoForm">
                                            		<div class="form-row">
                                            		&nbsp;&nbsp;&nbsp;&nbsp;
                                            		<div class="form-group col-md-2"><label for="inputNombre" class="col-form-label">Matricula</label></div>
											        <div class="form-group col-md-5">
											            <input disabled name="nombre" type="text" class="form-control" id="inputNombre">
											        </div>

                                            		<div class="form-group col-md-2"><label for="inputNombre" class="col-form-label">Carrera</label></div>
											        <div class="form-group col-md-2">
											            <input disabled name="carrera" type="text" class="form-control" id="inputCarrera">
											        </div>
                                        			</div>
                                            	</div>

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- WIDGET 6 -->
                    <div class="col-12 col-lg-12  p-3">
                        <div class="card mb-3">

                            <div class="widget-content">
                                <div class="source-preview-wrapper">
                                    <div class="preview">
                                        <div class="preview-elements" id="listaalumnos">
                                        	<br>
                                        	&nbsp;&nbsp;&nbsp;&nbsp;
                                            <i class="icon s-6 icon-account-search"></i>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" id="search" placeholder="Buscador...">
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
												                <span class="column-title">Controles</span>
												            </div>
												        </th>
												    </tr>
												</thead>
												

													<!-- Inicia el llenado de la tabla con datos -->
													<?php 
													//Se llama la funcion que retorna los datos de la tabla
									                $listado = $db->especial("SELECT (SELECT matricula FROM alumnos WHERE matricula = id_alumno),(SELECT nombre FROM alumnos WHERE matricula = id_alumno) FROM clasealumno WHERE id_clase = " . $value);
													?>
									                <tbody>
													<?php
									                    //Funcion que recorre todos los registros y los almacena para mostrarlos en la pagina
									                    while( $row = $listado->fetch() ){
														#while ($row=mysqli_fetch_object($listado)){
															$t_matricula=$row[0];
															$t_nombre=$row[1];
													?>
														<tr>
															<td><?php echo $t_matricula;?></td>
									                        <td><?php echo $t_nombre;?></td>
									                        <td>
													        <a onclick="if(confirm('Se eliminara al Alumno')){document.location.href='index.php?action=eliminarAlum-Mate&id=<?php echo $t_matricula ?>&clase='+document.getElementById('carreras').value}"><i class="icon s-7 icon-account-remove"></i></a>
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
            <!-- / CONTENT -->
        </form>

        </div>

    </div>

    <script type="text/javascript" src="assets/js/apps/dashboard/project.js"></script>

</div>