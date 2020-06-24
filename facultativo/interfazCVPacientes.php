<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="../css/Facultativo/tabla.css"  rel="stylesheet">

    </head>

    <!-- La principal función de esta interfaz es mostrar las últimas constantes vitales del paciente asignado -->


    <body>
        <?php
        require("../basedatos.php");
        session_start();

        $num=$_SESSION['num'];

        if($_SESSION['dni_paciente']==""){
            $DNIUsuario=$_GET['DNI'];
        }else{
            $DNIUsuario=$_SESSION['dni_paciente'];
        }
        
        $_SESSION['dni_paciente']=$DNIUsuario;
        $consultaG = $conectarBD->prepare("SELECT * FROM valorglucosa WHERE valorglucosa.Dni = '$DNIUsuario' AND valorglucosa.Toma= (SELECT MAX(valorglucosa.Toma) FROM valorglucosa)");
        $consultaO = $conectarBD->prepare("SELECT * FROM valoroxigeno WHERE valoroxigeno.Dni = '$DNIUsuario' AND valoroxigeno.Toma= (SELECT MAX(valoroxigeno.Toma) FROM valoroxigeno)");
        $consultaP = $conectarBD->prepare("SELECT * FROM valorpulso WHERE valorpulso.Dni = '$DNIUsuario' AND valorpulso.Toma= (SELECT MAX(valorpulso.Toma) FROM valorpulso)");
        $consultaTemp = $conectarBD->prepare("SELECT * FROM valortemperatura WHERE valortemperatura.Dni = '$DNIUsuario' AND valortemperatura.Toma= (SELECT MAX(valortemperatura.Toma) FROM valortemperatura)");
        $consultaTen = $conectarBD->prepare("SELECT * FROM valortension WHERE valortension.Dni = '$DNIUsuario' AND valortension.Toma= (SELECT MAX(valortension.Toma) FROM valortension)");
        
        $consultaG->execute(array());
        $usuarioG = $consultaG->fetch();

        $consultaO->execute(array());
        $usuarioO = $consultaO->fetch();

        $consultaP->execute(array());
        $usuarioP = $consultaP->fetch();

        $consultaTemp->execute(array());
        $usuarioTemp = $consultaTemp->fetch();

        $consultaTen->execute(array());
        $usuarioTen = $consultaTen->fetch();
  
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

        <div class="container">
            <div class="jumbotron">
                <h1>Constantes Vitales</h1>
            </div> 
        </div>   
            <table>
               
                <tr>
                    <th>Constantes Vitales</th>
                    <th>Valor</th>
                    <th>Última toma</th>
                    <th></th>
                </tr>

                <tr>
                    <td>Oxígeno en Sangre</th>
                    <td><?php if(empty($usuarioO)){
                            echo "-";
                    }else{
                            echo $usuarioO['Oxigeno'];
                        } ?></td>
                    <td><?php if(empty($usuarioO)){
                            echo "-";
                    }else{
                            echo $usuarioO['Toma'];
                        } ?></td>
                    <td><a href="graficas/oxigeno/indexOxigeno.php"> Ver todos los valores </a></td>
                </tr>

                <tr>
                    <td>Pulso cardíaco</th>
                    <td><?php if(empty($usuarioP)){
                            echo "-";
                    }else{
                            echo $usuarioP['Pulso'];
                        } ?></td>
                    <td><?php if(empty($usuarioP)){
                            echo "-";
                    }else{
                            echo $usuarioP['Toma'];
                        } ?></td>
                    <td><a href="graficas/pulso/indexPulso.php"> Ver todos los valores </a></td>

                </tr>

                <tr>
                    <td>Temperatura corporal</td>
                    <td><?php if(empty($usuarioTemp)){
                            echo "-";
                    }else{
                            echo $usuarioTemp['Temperatura'];
                        } ?></td>
                    <td><?php if(empty($usuarioTemp)){
                            echo "-";
                    }else{
                            echo $usuarioTemp['Toma'];
                        }  ?></td>
                    <td><a href="graficas/temperatura/indexTemperatura.php"> Ver todos los valores </a></td>

                </tr>

                <tr>
                    <td>Tensión arterial</td>
                    <td><?php if(empty($usuarioTen)){
                            echo "-";
                    }else{
                            echo $usuarioTen['Tensionalta'];
                        }  ?>/<?php if(empty($usuarioTen)){
                            echo "-";
                    }else{
                            echo $usuarioTen['Tensionbaja'];
                        }  ?></td>
                    <td><?php if(empty($usuarioTen)){
                            echo "-";
                    }else{
                            echo $usuarioTen['Toma'];
                        }  ?></td>
                    <td><a href="graficas/tension/indexTension.php"> Ver todos los valores </a></td>


                </tr>

                <tr>
                    <td>Glucosa en Sangre</td>
                    <td><?php if(empty($usuarioG)){
                            echo "-";
                    }else{
                            echo $usuarioG['Glucosa'];
                        } ?></td>
                    <td><?php if(empty($usuarioG)){
                            echo "-";
                    }else{
                            echo $usuarioG['Toma'];
                        }  ?></td>
                    <td><a href="graficas/glucosa/indexGlucosa.php"> Ver todos los valores </a></td>

                </tr>

                <td><a href="limitePaciente.php"> Modificar límites de las constantes</a></td>
            </table>
        </div>

            
            
            <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>