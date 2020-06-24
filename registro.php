<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="css/Inicio/estiloInicio.css" rel="stylesheet">

        <script src="push.js/push.min.js"></script>
    </head>

    <!-- La principal función de esta interfaz será generar un formulario a partir del cual se registrará el paciente -->

    <body>
        <?php
        require("basedatos.php");
        ?>
        <div class="barra">
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="registro.php">Registro</a></li>
            </ul>
        </div>
        <div class="cuerpo">
            <div class="container">
                <div class="jumbotron">
                    <h1>Registro de Paciente</h1>
                </div>
            </div> 
            <div class="panel">
                <form role="form" method="POST">
                    <?php
                        if(isset($_POST['nombre'])){
                            $nombre= $_POST['nombre'];
                            $apellidos= $_POST['apellidos'];
                            $dni= $_POST['dni'];
                            $sexo= $_POST['sexo'];
                            $fechanacimiento= $_POST['fechanacimiento'];
                            $email= $_POST['email'];
                            $contraseña1= $_POST['contraseña'];
                            $contraseña2= $_POST['contraseña2'];

                            $errores=array();

                            if(strlen($nombre)<2||strlen($nombre)>30){
                                array_push($errores, "El nombre debe tener entre 2 y 30 caracteres.");
                            }
                            if(strlen($apellidos)<2||strlen($apellidos)>50){
                                array_push($errores, "Los apellidos deben tener entre 2 y 50 caracteres.");
                            }
                            if(strlen($dni)!=9){
                                array_push($errores,"El DNI debe tener 9 caracteres.");
                            }else{
                                $letra = substr($dni, -1);
                                $numeros = substr($dni, 0, -1);
                                if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) != $letra && strlen($letra) != 1 && strlen ($numeros) != 8 ){
                                    array_push($errores,"Introduce un DNI existente.");
                                }
                            }

                            if($sexo!="Hombre"&&$sexo!="Mujer"){
                                array_push($errores,"En Sexo debe escribir Hombre o Mujer");
                            }

                            if(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
                                array_push($errores,"Introduce un email existente");
                            }

                            if(strlen($contraseña1)<3 ||strlen($contraseña2)<3 ||strlen($contraseña1)>15 ||strlen($contraseña2)>15){
                                array_push($errores,"La contraseña debe tener entre 3 y 15 caracteres.");
                            } else if($contraseña1!=$contraseña2){
                                array_push($errores,"Las contraseñas deben ser iguales.");

                            }
                            if(count($errores)>0){
                                ?>
                                <script>
                                <?php
                                for( $i=0;$i<count($errores);$i++){
                                    ?>
                                    Push.create("Notificacion emergente",{
                                        body: "<?php echo $errores[$i] ?>",
                                        icon: 'imagenes/alerta.jpg',
                                        timeout: 15000,
                                        });
                                <?php
                                }
                                ?>
                                </script>
                                <?php                             
                            }else{
                                $insertar = $conectarBD->prepare('INSERT INTO usuario(
                                    Nombre,Apellidos,Dni,Sexo,Fechanacimiento,Email,Contrasena) VALUES(
                                    :Nombre,:Apellidos, :Dni, :Sexo, :Fechanacimiento, :Email, :Contrasena)'
                                    );
                                $ok_m = $insertar->execute(array(
                                    'Nombre' => $_POST['nombre'],
                                    'Apellidos' => $_POST['apellidos'],
                                    'Dni' => $_POST['dni'],
                                    'Sexo' => $_POST['sexo'],
                                    'Fechanacimiento' => $_POST['fechanacimiento'],
                                    'Email' => $_POST['email'],
                                    'Contrasena' => password_hash($_POST['contraseña'], PASSWORD_DEFAULT, array("cost"=> 12))
                                ));
                                if ($ok_m) {
                                    session_start();
                                    header("Location:login.php");
                                    die;
                                }else{
                                    ?>
                                    <script>
                                    Push.create("Notificacion emergente",{
                                        body: "Correo o DNI ya está siendo utilizado por un usuario",
                                        icon: 'imagenes/alerta.jpg',
                                        timeout: 15000,
                                        });
                                    </script>
                                <?php
                                }
                            }
                        }

                    
                    ?>
                    <table>
                        <tr><th>Introduce tus datos:</th></tr>
                        <tr><th>Nombre</th><td><input type = 'text' name = 'nombre' ></th></tr>
                        <tr><th>Apellidos</th><td><input type = 'text' name = 'apellidos'></th></tr>
                        <tr><th>DNI</th><td><input type = 'text' name = 'dni'></th></tr>
                        <tr><th>Sexo(Hombre o Mujer)</th><td><input type = 'text' name = 'sexo'></th></tr>
                        <tr><th>Fecha de Nacimiento</th><td><input type = 'date' name = 'fechanacimiento'></th></tr>
                        <tr><th>Email</th><td><input type = 'text' name = 'email' placeholder="usuario@correo.com"></th></tr>
                        <tr><th>Contraseña</th><td><input type = 'password' name = 'contraseña' ></th></tr>
                        <tr><th>Repite la contraseña</th><td><input type = 'password' name = 'contraseña2' ></th></tr>
                        <th><input type='reset' id='Restaurar' value='Restaurar'></tr>
                        <th><input type='submit' id='Confirmar' value='Confirmar'></tr>
                        <tr><th><a href="validacion.php">Registro Facultativo</a></th></tr>
                    </table>
                </form>
            </div>
        </div>

        <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>

