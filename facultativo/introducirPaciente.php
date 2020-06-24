<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="../css/Facultativo/registro.css" rel="stylesheet">

        <script src="../push.js/push.min.js"></script>

    </head>

    <!-- La principal función de esta interfaz es la introducción de nuevos pacientes a cargo del facultativo -->


    <body>
        <?php
        require("../basedatos.php");
        session_start();
        $DNIFacultativo=$_SESSION['dni_facultativo'];
        $num=$_SESSION['num'];
        
        ?>
        <div class="barra">
            <ul>             
                <li><a href='homeFacultativo.php'>Inicio</a></li>
                <li><a href='interfazperfil.php'>Perfil</a></li>
                <li><a href='interfazPacientes.php'>Constantes Vitales Pacientes</a></li>
                <li><a href='#informacion'>Informacion</a></li>
                <li><a href='../desconectar.php'>Salir</a></li>
                <li><a href='notificaciones.php'><?php echo $num ?> Notificaciones </a></li>               
            </ul>
        </div>
        <div class="cuerpo">
            <div class="container">
                <div class="jumbotron">
                    <h1>Introducir nuevos pacientes</h1>
                </div>
            </div> 
            <div class="panel">
                <form role="form" method="POST">
                    <?php
                    if(isset($_POST['nombre'])|| isset($_POST['apellidos']) || isset($_POST['dni']) || isset($_POST['correo']) ){
                        $nombre= $_POST['nombre'];
                        $apellidos= $_POST['apellidos'];
                        $dni= $_POST['dni'];
                        $correo= $_POST['correo'];

                        $errores=array();
                       
                        function estaVacio($dato){
                            if ($dato==""){
                                return -1;
                            }else{
                                return 0;
                            }
                        }
                        

                        if (estaVacio($nombre)==-1 || estaVacio($apellidos)==-1 || estaVacio($dni)==-1 || estaVacio($correo)==-1 ){
                            ?>

                            <script>
                                Push.create("Notificacion emergente",{
                                    body: "Todos los campos deben estar rellenos",
                                    icon: '../imagenes/alerta.jpg',
                                    timeout: 5000,
                                });
                            </script>
                            
                        <?php 
                        }else{

                            $consulta= $conectarBD-> prepare("SELECT * FROM usuario WHERE Nombre='$nombre' AND Apellidos='$apellidos' AND 
                            Dni='$dni' AND Email='$correo'");

                            $consulta->execute(array());
                            $array = $consulta->fetch();


                            if(isset($array['Dni'])){

                                $insertar = $conectarBD->prepare('INSERT INTO tablaunion (Dnif, Dniu) VALUES(:Dnif,:Dniu)');
                                $ok_m = $insertar->execute(array(
                                    'Dnif' => $DNIFacultativo,
                                    'Dniu' => $_POST['dni']));

                                $insertarlim = $conectarBD->prepare('INSERT INTO limites(Limiteglucosas,Limiteglucosai,Limiteoxigenos,
                                Limiteoxigenoi,Limitepulsos,Limitepulsoi,Limitetemperaturas,Limitetemperaturai,
                                Limitetensionaltas, Limitetensionaltai ,Limitetensionbajas,Limitetensionbajai,
                                Dniu, Dnif) VALUES (:Limiteglucosas,:Limiteglucosai,:Limiteoxigenos,
                                :Limiteoxigenoi,:Limitepulsos,:Limitepulsoi,:Limitetemperaturas,:Limitetemperaturai,
                                :Limitetensionaltas, :Limitetensionaltai ,:Limitetensionbajas,:Limitetensionbajai,
                                :Dniu, :Dnif)');

                                $ok_m2 = $insertarlim->execute(array(
                                    'Limiteglucosas'=>'1000',
                                    'Limiteglucosai'=>'0',
                                    'Limiteoxigenos'=>'1000',
                                    'Limiteoxigenoi'=>'0',
                                    'Limitepulsos'=>'1000',
                                    'Limitepulsoi'=>'0',
                                    'Limitetemperaturas'=>'1000',
                                    'Limitetemperaturai'=>'0',
                                    'Limitetensionaltas'=>'1000',
                                    'Limitetensionaltai'=>'0',
                                    'Limitetensionbajas'=>'1000',
                                    'Limitetensionbajai'=>'0',
                                    'Dniu'=>$_POST['dni'],
                                    'Dnif'=>$DNIFacultativo));
     


                                if ($ok_m && $ok_m2) {
                                        session_start();
                                        header("Location:interfazPacientes.php");
                                        die; 
                                }else{
                                    ?>

                            <script>
                                Push.create("Notificacion emergente",{
                                    body: "Error al introducir el paciente",
                                    icon: '../imagenes/alerta.jpg',
                                    timeout: 5000,
                                });
                            </script>
                            
                        <?php 
                                }

                            }else{
                                ?>

                            <script>
                                Push.create("Notificacion emergente",{
                                    body: "El paciente no existe",
                                    icon: '../imagenes/alerta.jpg',
                                    timeout: 5000,
                                });
                            </script>
                            
                        <?php 
                            }
                    }
                }

    
                    ?>
                    <table>
                        <tr><th>Introducir datos del paciente: </th></tr>
                        <tr><th> <?php ?></th></tr>
                        <tr><th>Nombre</th><td><input type = 'text' name = 'nombre' value=""></th></tr>
                        <tr><th>Apellidos</th><td><input type = 'text' name = 'apellidos' value=""></th></tr>
                        <tr><th>DNI</th><td><input type = 'text' name = 'dni' value=""></th></tr>
                        <tr><th>Correo</th><td><input type = 'email' name = 'correo' value=""></th></tr>


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

