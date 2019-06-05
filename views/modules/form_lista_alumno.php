<?php 

	include "../../models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos

?>
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
        $listado = $db->especial("SELECT (SELECT matricula FROM alumnos WHERE matricula = id_alumno),(SELECT nombre FROM alumnos WHERE matricula = id_alumno) FROM clasealumno WHERE id_clase =" . $_GET['value']);
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