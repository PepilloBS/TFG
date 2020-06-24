<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="../css/Facultativo/inicioF.css" rel="stylesheet">

        <script src="../push.js/push.min.js"></script>

        <?php
            require("../basedatos.php");
            session_start();
            $DNIUsuario=$_SESSION['dni_facultativo'];

            $consulta = $conectarBD->prepare("SELECT * FROM notificaciones WHERE notificaciones.Dnif ='$DNIUsuario' ");
            $consulta->execute(array());
            $usuario = $consulta->fetch();
            $num= 0;

            function conexion_mysqli(){
                return mysqli_connect('localhost','root','','constantesvitalesbd');
            }
                
            $conexion=conexion_mysqli();

            $notem= mysqli_query($conexion, "SELECT * FROM notificaciones WHERE Dnif='$DNIUsuario'");
            while($data= mysqli_fetch_array($notem)){
                $num=$num+1;
        ?>
        <script>
            Push.create("Notificacion emergente",{
                body: "<?php echo $data['Texto'] ?>",
                timeout: 10000,
                onClick: function (){
                    window.location="notificaciones.php";
                    this.close();
                }
            });
        </script>

        <?php 
        } 
        $_SESSION['num']=$num;
        ?>
    </head>

    <!-- La principal función de esta interfaz es mostrar la página de inicio de los facultativos -->


    <body>
        <div class="barra">
            <ul>             
                <li><a href='homeFacultativo.php'>Inicio</a></li>
                <li><a href='interfazperfil.php'>Perfil</a></li>
                <li><a href='interfazPacientes.php'>Constantes Vitales Pacientes</a></li>
                <li><a href='#informacion'>Informacion</a></li>
                <li><a href='../desconectar.php'>Salir</a></li>
                <li><a href='notificaciones.php'><?php echo $num ?> Notificaciones</a></li>               
            </ul>
        </div>
        <div class="container">
            <div class="jumbotron">
                <h1>VITALBASE</h1>
                <h5>Aplicación web capaz de guardar todas sus constantes vitales.</h5>
            </div> 
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div id="panel">
                        <div id="titulo-panel">
                            <h1>Información:</h1>
                        </div>
                        <div id="cuerpo-panel">  
                            <h5>Esta aplicación surge de un Trabajo de Fin de Carrera para poder mejorar las mediciones de constantes vitales vía remota.
                                La gran ventaja que ofrece esta aplicación es ahorrar el número de trayectos al hospital, el poder guardar y ver todas sus mediciones, las notificaciones por si has obtenido un valor fuera de los límites normales, entre otros casos.
                             </h5>
                        </div>
                     </div>
                </div>
                <div class="col-sm-6">
                    <div id ="panel-logo">
                        <div id= "imagen-logo">
                        <style>
                            img {
                            position: absolute;
                            right: 50px;
                            }
                            </style>
                            <img src="../imagenes/logoVB.png" alt="Logo VitalBase"></img>
                        </div>    
                    </div>
                </div>
            </div>
        </div>

        <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>