<?php 

    $ganancias = 0;

    //Si no se manda ningun parametro, se establece la fecha actual
    if(empty($_GET['fecha'])){
        $fecha = date ("Y-m");
    }
    else{
        $fecha = $_GET['fecha'];
    }

    include 'models/database.php';//Se importa la clase para realizar la conexion a la base de datos
    $db = new Database();

    $mone = $db->ganancias($fecha);//Se obtiene el resultado de la base de datos
    //Se llama la funcion que retorna los datos de la tabla
    //Funcion que recorre todos los registros y los almacena para mostrarlos en la pagina
    while( $row = $mone->fetch() ){
    #while ($row=mysqli_fetch_object($listado)){
        $ganancias += $t_id=$row[0];
    }

    $visi = $db->visitas();//Se obtienen el numero de clientes

    $habit = $db->habit();//Se obtienen los valores de las habitaciones


?>
<div class="content custom-scrollbar">

    <div id="project-dashboard" class="page-layout simple right-sidebar">

        <div class="page-content-wrapper custom-scrollbar">







            <!-- CONTENT -->
            <div class="page-content">
                        
                <!-- WIDGET GROUP -->
                <div class="widget-group row no-gutters">

                    <!-- WIDGET 1 -->
                    <div class="col-12 col-sm-6 col-xl-3 p-3">

                        <div class="widget widget1 card">

                            <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">

                                <div class="col">

                                    <span class="h6">Ganancias por Mes</span>

                                </div>

                            </div>

                            <div class="widget-content pt-8 pb-7 d-flex flex-column align-items-center justify-content-center">

                                <div class="title text-secondary"><h1><?php echo '$'.$ganancias ?></h1></div>

                                <div class="sub-title h6 text-muted">Pesos Mexicanos</div>

                            </div>

                            <div class="widget-footer p-9 bg-light row no-gutters align-items-center">

                                <input onchange="location.href ='index.php?action=finanzas&fecha='.concat(document.getElementById('example-date-input').value);" value="<?php echo $_GET['fecha'] ?>" name="fecha" class="form-control" type="month" id="example-date-input"/>

                            </div>
                        </div>
                    </div>
                    <!-- / WIDGET 1 -->
                    <!-- WIDGET 2 -->
                    <div class="col-12 col-sm-6 col-xl-3 p-3">

                        <div class="widget widget2 card">

                            <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">

                                <div class="col">
                                    <span class="h6">Habitaciones Disponibles</span>
                                </div>

                            </div>

                            <div class="widget-content pt-8 pb-7 d-flex flex-column align-items-center justify-content-center">
                                <div class="title text-danger"><h1><?php echo $habit[1] ?></h1></div>
                                <div class="sub-title h6 text-muted">Habitaciones</div>
                            </div>

                            <div class="widget-footer p-9 bg-light row no-gutters align-items-center">
                                <span class="text-muted">Total de Habitaciones: </span>
                                <span class="ml-2"><?php echo $habit[0] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- / WIDGET 2 -->
                    <!-- WIDGET 2 -->
                    <div class="col-12 col-sm-6 col-xl-3 p-3">

                        <div class="widget widget2 card">

                            <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">

                            <div class="col">
                                <span class="h6">Habitaciones Ocupadas</span>
                            </div>
                            </div>

                            <div class="widget-content pt-8 pb-7 d-flex flex-column align-items-center justify-content-center">
                                <div class="title text-warning"><h1><?php echo $habit[2] ?></h1></div>
                                <div class="sub-title h6 text-muted">Habitaciones</div>
                            </div>

                            <div class="widget-footer p-9 bg-light row no-gutters align-items-center">
                                <span class="text-muted">Total de Habitaciones: </span>
                                <span class="ml-2"><?php echo $habit[0] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- / WIDGET 2 -->
                    <!-- WIDGET 6 -->
                    <div class="col-12 col-lg-3 p-3">

                        <div class="widget widget6 card">

                            <div class="widget-header px-4 row no-gutters align-items-center justify-content-between">

                                <div class="col">
                                    <span class="h6">Clientes</span>
                                </div>

                            </div>

                            <div class="widget-content">

                                <div class="row no-gutters">

                                    <div class="col-12">

                                        <div class="widget-content pt-8 pb-6 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning"><h1><?php echo $visi[0] ?></h1></div>
                                            <div class="sub-title h6 text-muted">Clientes</div>
                                        </div>

                                    </div>

                                    <div class="divider col-12"></div>

                                    <div id="added-tasks" class="col-6 d-flex flex-column align-items-center justify-content-center py-4">

                                        <div class="count h2"><?php echo $visi[1] ?></div>

                                        <div class="count-title">Habituales</div>

                                    </div>

                                    <div id="completed-tasks" class="col-6 d-flex flex-column align-items-center justify-content-center py-4">

                                        <div class="count h2"><?php echo $visi[2] ?></div>

                                        <div class="count-title">Esporádicos</div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / WIDGET 6 -->
                    
                </div>

            <!-- / CONTENT -->
            </div>

        </div>

    </div>

    <script type="text/javascript" src="assets/js/apps/dashboard/project.js"></script>

</div>