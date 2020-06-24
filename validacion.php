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

        <!-- La principal función de esta interfaz será que el facultativo a través de una contraseña pueda acceder al registro de este tipo de usuarios -->


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
                    <h1>Validación Registro Facultativo</h1>
                </div>
            </div> 
            <div class="panel">
                <form role="form" method="POST">
                    <?php
                        if(isset($_POST['validacion'])){
                            $validacion= $_POST['validacion'];
                            

                            $errores=array();

                            if(strlen($validacion)<0){
                                array_push($errores, "La validacion debe tener entre 2 y 30 caracteres.");
                            }
                            
                            $consulta=$conectarBD->prepare("SELECT Contraseña FROM validacion");
                            $consulta->execute(array('Contraseña'));
                            $array1 = $consulta->fetch();    

                            if($array1['Contraseña']!=$validacion){
                                array_push($errores, "La validacion es incorrecta.");
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
                                session_start();
                                header("Location:registroFacultativo.php");
                                die;
                                
                            }
                        }

                    
                    ?>
                    <table>
                        <tr><th>Introduce tus datos:</th></tr>
                        <tr><th>Escribe contraseña validación</th><td><input type = 'password' name = 'validacion' ></th></tr>
                        <th><input type='reset' id='Restaurar' value='Restaurar'></tr>
                        <th><input type='submit' id='Confirmar' value='Confirmar'></tr>
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

