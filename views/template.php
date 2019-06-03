<!-- Esta pagina representa el molde, esta estructura la tendra toda la pagina, solo cambiara el contenido -->
<!DOCTYPE html>
<html>

<head>
    <title>Escolares</title>
    <?php include "cabeceras.php" ?>
</head>

<body class="layout layout-vertical layout-left-navigation layout-below-toolbar layout-below-footer">
    <main>
        <div id="wrapper">
            <aside id="aside" class="aside aside-left" data-fuse-bar="aside" data-fuse-bar-media-step="md" data-fuse-bar-position="left">
                <div class="aside-content bg-primary-700 text-auto">

                    <div class="aside-toolbar">

                        <div class="logo">
                            <span class="logo-icon">UP</span>
                            <span class="logo-text">Escolares</span>
                        </div>

                        <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block" data-fuse-aside-toggle-fold>
                            <i class="icon icon-backburger"></i>
                        </button>

                    </div>

                    <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item">

                        <li class="subheader">
                            <span>Administrativos</span>
                        </li>

                        <li class="nav-item" role="tab" id="heading-dashboards">

                            <?php
                                include "modules/navegacion.php"
                            ?>
                            
                        </li>

                    </ul>
                </div>

            </aside>





            <div class="content-wrapper">
                <nav id="toolbar" class="bg-white">

                    <div class="row no-gutters align-items-center flex-nowrap">

                        <div class="col">

                            <div class="row no-gutters align-items-center flex-nowrap">

                                <!-- Barra superior central  -->

                            </div>
                        </div>

                        <div class="col-auto">

                            <div class="row no-gutters align-items-center justify-content-end">

                                <div class="user-menu-button dropdown">

                                    <div class="dropdown-toggle ripple row align-items-center no-gutters px-2 px-sm-4" role="button" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="avatar-wrapper">
                                            <img class="avatar" src="assets/images/avatars/profile.jpg">
                                            <i class="status text-green icon-checkbox-marked-circle s-4"></i>
                                        </div>
                                        <span class="username mx-3 d-none d-md-block">Admin</span>
                                    </div>

                                    <div class="dropdown-menu" aria-labelledby="dropdownUserMenu">

                                        <a class="dropdown-item" href="#">
                                            <div class="row no-gutters align-items-center flex-nowrap">
                                                <i class="status text-green icon-checkbox-marked-circle"></i>
                                                <span class="px-3">Online</span>
                                            </div>
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="views/modules/logout.php">
                                            <div class="row no-gutters align-items-center flex-nowrap">
                                                <i class="icon-logout"></i>
                                                <span class="px-3">Logout</span>
                                            </div>
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Se agrega el contenido de la pagina seleccionada -->
                    <?php
                        $mvc = new mvcController();
                        $mvc->enlacesPaginasController();
                    ?>

                
            </div> 

        </div>
    </main>
</body>

</html>