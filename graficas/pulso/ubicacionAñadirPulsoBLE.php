<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="../../css/Paciente/registro.css" rel="stylesheet">

        <script src="../../push.js/push.min.js"></script>

    </head>

    <!-- La principal función de esta interfaz es que el apciente pueda añadir la ubicación donde se ha tomado la medida antes de leer los valores vía Bluetooth -->


    <body>
        <?php
        require("../../basedatos.php");
        session_start();
        $DNIUsuario=$_SESSION['dni_usuario'];
        ?>
        <div class="barra">
            <ul>
            <li><a href='../../paciente/home.php'>Inicio</a></li>
            <li><a href='../../paciente/interfazperfil.php'>Perfil</a></li>
            <li><a href='../../paciente/interfazcv.php'>Mis Constantes Vitales</a></li>
            <li><a href='#informacion'>Informacion</a></li>
            <li><a href='../../desconectar.php'>Salir</a></li>
            </ul>
        </div>
        <div class="cuerpo">
            <div class="container">
                <div class="jumbotron">
                    <h1>Introducir Ubicación de la Toma</h1>
                </div>
            </div> 
            
            <form role="form" method="POST">
            <?php
                        if(isset($_POST['ubicacion'])){
                            $errores=array();

                            if($_POST['ubicacion']== null){
                                array_push($errores, "Se debe introducir un valor de pulso");
                            }
                            if(count($errores)>0){
                                ?>
                                <script>
                                <?php
                                for( $i=0;$i<count($errores);$i++){
                                    ?>
                                    Push.create("Notificacion emergente",{
                                        body: "<?php echo $errores[$i] ?>",
                                        icon: '../../imagenes/alerta.jpg',
                                        timeout: 15000,
                                        });
                                <?php
                                }
                                ?>
                                </script>
                                <?php  
                                
                            }else{
                                session_start();
                                $_SESSION['ubicacion']=$_POST['ubicacion'];
                                header("Location:añadirPulsoBLE.php");
                                die;
                            }
                        }

            ?>

              <table>
                <tr><th>Ubicación (Casa u Nombre del Hospital/Centro de Salud)</th><td><input type = 'text' name = 'ubicacion' ></th></tr>
                <tr><th><input type='reset' id='Restaurar' value='Restaurar'></th></tr>
                <tr><th><input type='submit' id='Confirmar' value='Confirmar'></th></tr>
              </table>
            </form>


        <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>            
    </body>
</html>



