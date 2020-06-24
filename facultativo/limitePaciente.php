<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="../css/facultativo/registro.css" rel="stylesheet">

    </head>

    <!-- La principal función de esta interfaz es que el paciente mediante un formulario pueda modificar el rango de valores entre los que 
el paciente debería introducir sus datos de constantes vitales -->


    <body>
        <?php
        require("../basedatos.php");
        session_start();
        $DNIUsuario=$_SESSION['dni_paciente'];
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
                    <h1>Introducir nuevos límites para las constantes vitales del paciente</h1>
                </div>
            </div> 
            <div class="panel">
                <form role="form" method="POST">
                    <?php
                    if(isset($_POST['limitesuptenb'])&& isset($_POST['limiteinftenb']) && isset($_POST['limitesuptena']) && isset($_POST['limiteinftena']) || 
                    isset($_POST['limitesupglu']) && isset($_POST['limiteinfglu']) && isset($_POST['limitesupox']) && isset( $_POST['limiteinfpul']) || 
                    isset($_POST['limitesuptemp']) && isset($_POST['limiteinftemp'])){
                        $limitetena1= $_POST['limitesuptena'];
                        $limitetena2= $_POST['limiteinftena'];
                        $limitetenb1= $_POST['limitesuptenb'];
                        $limitetenb2= $_POST['limiteinftenb'];

                        $limiteglu1= $_POST['limitesupglu'];
                        $limiteglu2= $_POST['limiteinfglu'];

                        $limiteox1= $_POST['limitesupox'];
                        $limiteox2= $_POST['limiteinfox'];

                        $limitepul1= $_POST['limitesuppul'];
                        $limitepul2= $_POST['limiteinfpul'];

                        $limitetemp1= $_POST['limitesuptemp'];
                        $limitetemp2= $_POST['limiteinftemp'];

                        $errores=array();
                       
                        function esNumerico($dato){
                            if (($dato <= 0) || ($dato >= 1001)){
                                return -1;
                            }else{
                                return 0;
                            }
                        }
                        

                        if (esNumerico($limitetena1)==-1 || esNumerico($limitetena2)==-1 || esNumerico($limitetenb1)==-1 || esNumerico($limitetenb2)==-1 || esNumerico($limiteox1)==-1 || esNumerico($limiteox2)==-1 || esNumerico($limitepul1)==-1 || esNumerico($limitepul2)==-1 || esNumerico($limitetemp1)==-1 || esNumerico($limitetemp2)==-1){
                            ?>

                            <script>
                                Push.create("Notificacion emergente",{
                                    body: "Todos los campos deben ser numéricos entre 0 y 1000",
                                    icon: '../imagenes/alerta.jpg',
                                    timeout: 5000,
                                });
                            </script>
                            
                        <?php
                        }


                        $editar = $conectarBD->prepare(" UPDATE limites SET Limiteglucosas='$limiteglu1',Limiteglucosai='$limiteglu2',Limiteoxigenos='$limiteox1',
                        Limiteoxigenoi='$limiteox2',Limitepulsos='$limitepul1',Limitepulsoi='$limitepul2',Limitetemperaturas='$limitetemp1',Limitetemperaturai='$limitetemp2',
                        Limitetensionaltas='$limitetena1', Limitetensionaltai='$limitetena2',Limitetensionbajas='$limitetenb1',Limitetensionbajai='$limitetenb2',
                        Dniu='$DNIUsuario', Dnif='$DNIFacultativo'");
                        $ok_m = $editar->execute();
                        if ($ok_m) {
                            session_start();
                            header("Location:interfazPacientes.php");
                            die; 
                        }else{
                            echo "No se pue";
                            }
                        }

                    $editar = $conectarBD->prepare("SELECT * FROM limites WHERE Dniu='$DNIUsuario' AND Dnif='$DNIFacultativo'");
                    $editar->execute(array());
                    $lim = $editar->fetch();
 
                    
                    ?>
                    <table>
                        <tr><th>Modificar límites:</th></tr>
                        <tr><th> <?php ?></th></tr>
                        <tr><th>Límite superior glucosa en sangre</th><td><input type = 'text' name = 'limitesupglu' value="<?php echo $lim['Limiteglucosas'] ?>"></th></tr>
                        <tr><th>Límite inferior glucosa en sangre</th><td><input type = 'text' name = 'limiteinfglu' value="<?php echo $lim['Limiteglucosai'] ?>"></th></tr>

                        <tr><th>Límite superior Oxígeno en sangre</th><td><input type = 'text' name = 'limitesupox' value="<?php echo $lim['Limiteoxigenos'] ?> "></th></tr>
                        <tr><th>Límite inferior Oxígeno en sangre</th><td><input type = 'text' name = 'limiteinfox' value="<?php echo $lim['Limiteoxigenoi'] ?>"></th></tr>

                        <tr><th>Límite superior Temperatura corporal</th><td><input type = 'text' name = 'limitesuptemp' value="<?php echo $lim['Limitetemperaturas'] ?>"></th></tr>
                        <tr><th>Límite inferior Temperatura corporal</th><td><input type = 'text' name = 'limiteinftemp' value="<?php echo $lim['Limitetemperaturai'] ?>"></th></tr>

                        <tr><th>Límite superior Pulso cardíaco</th><td><input type = 'text' name = 'limitesuppul' value="<?php echo $lim['Limitepulsos'] ?>"></th></tr>
                        <tr><th>Límite inferior Pulso cardíaco</th><td><input type = 'text' name = 'limiteinfpul' value="<?php echo $lim['Limitepulsoi']  ?>"></th></tr>

                        <tr><th>Límite superior Tensión alta</th><td><input type = 'text' name = 'limitesuptena' value="<?php echo $lim['Limitetensionaltas'] ?>"></th></tr>
                        <tr><th>Límite inferior Tensión alta</th><td><input type = 'text' name = 'limiteinftena' value="<?php echo $lim['Limitetensionaltai'] ?>"></th></tr>
                        <tr><th>Límite superior Tensión baja</th><td><input type = 'text' name = 'limitesuptenb' value="<?php echo $lim['Limitetensionbajas'] ?>"></th></tr>
                        <tr><th>Límite inferior Tensión baja</th><td><input type = 'text' name = 'limiteinftenb' value="<?php echo $lim['Limitetensionbajai'] ?>"></th></tr>
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

