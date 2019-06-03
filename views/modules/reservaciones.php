<?php
    
    include "models/database.php";
    $db = new Database();//Se instancia la clase para manejar la base de datos
    $indic="0";
    //echo getcwd();
    //include 'views/modules/ajaxpro2.php';
    //print_r($json);
    //Cuando el usuario presione el boton de registrar, se llamara a la funcion para guardar los datos
    if(isset($_POST['reservar'])){

        //Obtenemos los datos ingresados
        $habitacion = $_POST['itemName'];
        $cliente    = $_POST['itemName2'];
        $fecha      = $_POST['fecha'];
        $dias       = $_POST['dias'];

        $db->create_reservacion($habitacion,$cliente,$fecha,$dias);
    }

    if(empty($_GET['id'])){
        $indic = '-1';
    }
    else{
        $indic = $db->one($_GET['id'],"habitaciones");
    }
    

?>
<div class="content custom-scrollbar">

    <div id="project-dashboard" class="page-layout simple right-sidebar">

        <div class="page-content-wrapper custom-scrollbar">







            <!-- CONTENT -->
            <div class="page-content">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link btn active" id="home-tab" data-toggle="tab" href="#home-tab-pane" role="tab" aria-controls="home-tab-pane" aria-expanded="true"><i class="icon s-4 icon-key-change"></i>Reservar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn" id="budget-summary-tab" data-toggle="tab" href="#budget-summary-tab-pane" role="tab" aria-controls="budget-summary-tab-pane"><i class="icon s-4 icon-key-plus"></i>Ver</a>
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade show active p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">
                        
                        <!-- WIDGET GROUP -->
                        <div class="widget-group row no-gutters">

                            <!-- WIDGET 6 -->
                            <div class="col-12 col-lg-9  p-3">
                                <div class="card mb-3">
                                    <div class="widget widget6 card">

                                        <div class="widget-header px-4 row no-gutters align-items-center justify-content-between">

                                            <div class="col">
                                                <span class="h6">Reservaciones</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="widget-content">
                                        <div class="source-preview-wrapper">
                                            <div class="preview">
                                                <div class="preview-elements">
                                                    
                                                    <!-- Empieza la construccion del formulario de clientes -->
                                                    <form action="http://localhost/TAW/Practica6/index.php?action=reservaciones" method = "post">

                                                        <div class="form-row">
                                                            <div class="form-group col-md-1"></div>
                                                            <div class="form-group col-md-5">
                                                                <label for="items">Habitacion</label>
                                                                <select name="itemName" class="itemName form-control" id="items" value="11">
                                                                    <option <?php if($indic!='-1'){echo 'value="' . $indic[0] . '" selected';}?>><?php if($indic=='-1'){echo "";}else{echo $indic[3];} ?></option>
                                                                </select>
                                                            </div>

                                                            <script>
                                                                  $('.itemName').select2({
                                                                    placeholder: 'Seleccione una habitación',
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
                                                                  document.getElementById("items").onchange = function(){
                                                                    var vla = document.getElementById('items').value;
                                                                    var urr = "index.php?action=reservaciones&id=".concat(vla);
                                                                    window.location=urr;}
                                                            </script>

                                                            <div class="form-group col-md-5">
                                                                <label for="items2">Cliente</label>
                                                                <select name="itemName2" class="itemName2 form-control" id="items2">
                                                                </select>
                                                            </div>

                                                            <script>
                                                                  $('.itemName2').select2({
                                                                    placeholder: 'Seleccione un cliente',
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

                                                            <div class="form-group col-md-1"></div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-1"></div>
                                                            <div class="form-group col-md-5">
                                                                <input name="fecha" class="form-control" type="date" value="<?php echo date ("Y-m-d"); ?>" id="example-date-input"/>
                                                                <label for="example-date-input">Fecha de ingreso</label>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <input name="dias" class="form-control" type="number" value="1" id="example-number-input"/>
                                                                <label for="example-number-input">Dias de hospedaje</label>
                                                            </div>
                                                            <div class="form-group col-md-1"></div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-1"></div>
                                                            <div class="form-group col-md-5">
                                                                <button type="submit" name="reservar" class="btn btn-primary">Reservar</button>
                                                            </div>
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- WIDGET 6 -->
                            <div class="col-12 col-lg-3  p-3">

                                <div class="card mb-3">
                                    <img id="imgs" class="card-img-top" src='<?php if($indic=='-1'){echo "assets/images/habitaciones/ojo.png";}else{echo $indic[6];}?>' alt="Card image cap" height="270">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php if($indic=='-1'){echo "...";}else{echo $indic[1];}?></h4>
                                        <p id="desm" class="card-text"><?php if($indic=='-1'){echo "...";}else{echo $indic[4];}?></p>
                                        
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
                                                        <h5>Reservaciones</h5>
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
                                                                                <span class="column-title">ID</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Cliente</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Habitacion</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Tipo de Habitacion</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Fecha</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Dias</span>
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
                                                                    $listado = $db->reser_especial();
                                                                    ?>
                                                                    <tbody>
                                                                    <?php
                                                                        //Funcion que recorre todos los registros y los almacena para mostrarlos en la pagina
                                                                        while( $row = $listado->fetch() ){
                                                                        #while ($row=mysqli_fetch_object($listado)){
                                                                            $t_id=$row[0];
                                                                            $t_cliente=$row[1];
                                                                            $t_numero=$row[2];
                                                                            $t_tipo=$row[3];
                                                                            $t_fecha=$row[4];
                                                                            $t_dias=$row[5];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $t_id;?></td>
                                                                            <td><?php echo $t_cliente;?></td>
                                                                            <td><?php echo $t_numero;?></td>
                                                                            <td><?php echo $t_tipo;?></td>
                                                                            <td><?php echo $t_fecha;?></td>
                                                                            <td><?php echo $t_dias;?></td>
                                                                            <td>
                                                                            <a onclick="document.location.href='index.php?action=editarReservacion&id=<?php echo $t_id ?>'"><i class="icon s-7 icon-account-edit"></i></a>
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                                            <a onclick="if(confirm('Se eliminara la reservación')){document.location.href='index.php?action=eliminarReservacion&id=<?php echo $t_id ?>&hab=<?php echo $t_numero ?>'}"><i class="icon s-7 icon-account-remove"></i></a>
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
                    
                </div>

            </div>
            <!-- / CONTENT -->

        </div>

    </div>

    <script type="text/javascript" src="assets/js/apps/dashboard/project.js"></script>

</div>