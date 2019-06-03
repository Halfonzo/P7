<?php

	include $url."/models/database.php";//Se incluye la clase para manejar la base de datos
	$msg="";//Este es un mensaje para notificar al usuario que ingreso datos incorrectos
    $nivel=-1;//Variable que definira el nivel de permisos del usuario

	if($_SERVER["REQUEST_METHOD"] == "POST") {
              
        $myusername = ($_POST['nick']);//Guardamos los datos del usuario para el inicio de session
        $mypassword = ($_POST['pass']);

        $db = new Database();//Se instancia la clase para manejar la base de datos
        $nivel = $db->login($myusername,$mypassword);
        if(!empty($nivel)){//LLamamos a la funcion que verifica los datos del usuario
        	//En caso de ser positivo, se redirigira a la pagina principal y se almacenara el usuario en la session
        	//header("Location: ".$url."/views/modules/main.php");
        	$_SESSION['user'] = $myusername;
            $_SESSION['nivel'] = $nivel;
            echo '<script type="text/javascript">
                    window.location.replace("index.php");
                  </script>';//Se refresca la pagina para cargar el main

        }
        elseif(empty($myusername) or empty($mypassword)){
        	//En caso de no ingresar ningun valor al formulario, se mostrara un mensaje de error
        	$msg="<font color='blue'>Ingrese sus datos</font>";
        }
        else{
        	//En caso de ingresar datos incorrectos, se mostrara un mensaje de error
        	$msg="<font color='red'>Usuario y/o Contraseña incorrectos</font>";
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Escolares</title>
	<?php include $url."/views/cabeceras.php" ?><!-- Se incluye el documento que añade las importaciones de estilo y demas -->
</head>
<body>
	<div class="content custom-scrollbar">

        <div id="login" class="p-8">

            <div class="form-wrapper md-elevation-8 p-8">

                <div class="logo bg-secondary">
                    <span>UP</span>
                </div>

                <div class="title mt-4 mb-8">Ingresa a tu cuenta</div>

                <form name="loginForm" novalidate action = "" method = "post">

                    <div class="form-group mb-4">
                        <input name="nick" type="email" class="form-control" id="loginFormInputEmail" aria-describedby="emailHelp" placeholder=" " />
                        <label for="loginFormInputEmail">Correo</label>
                    </div>

                    <div class="form-group mb-4">
                        <input name="pass" type="password" class="form-control" id="loginFormInputPassword" placeholder="Password" />
                        <label for="loginFormInputPassword">Contraseña</label>
                    </div>

                    <div id="msg" class="form-group mb-4" align="center">
                    	<?php echo $msg; $msg="" //En caso de que el usuario ingrese datos erroneos, se mostrara un mesnaje?>
                    </div>

                    <button type="submit" class="submit-button btn btn-block btn-secondary my-4 mx-auto" aria-label="LOG IN">
                        Iniciar
                    </button>

                </form>

                <div class="separator">
                    <span class="text">Halfonso</span>
                </div>

            </div>
        </div>

    </div>
</body>
</html>