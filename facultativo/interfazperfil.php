<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="../css/Facultativo/tabla.css" rel="stylesheet">

    </head>

    <!-- La principal función de esta interfaz es mostrar los datos del facultativo que ha introducido en el registro -->


    <body>
        <?php
        session_start();
        require("../basedatos.php");

        $DNIUsuario=$_SESSION['dni_facultativo'];
        $num=$_SESSION['num'];
        $consulta = $conectarBD->prepare("SELECT * FROM facultativo WHERE facultativo.Dni = '$DNIUsuario'");
        $consulta2 = $conectarBD->prepare("SELECT * FROM tablaunion WHERE tablaunion.Dnif = '$DNIUsuario'");
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
                <h1 id="perfil">Perfil</h1>
            </div> 
        </div>   
        <table>
            <?php
            function conexion_mysqli(){
                return mysqli_connect('localhost','root','','constantesvitalesbd');
            }
            $conexion=conexion_mysqli();

            $consulta->execute(array());
            $usuario = $consulta->fetch();

            $consulta2->execute(array());
            $usuario2 = $consulta2->fetch();

            if(isset($usuario2['Dniu'])){

                $DNIU= $usuario2['Dniu'];

                $consulta3 = $conectarBD->prepare("SELECT * FROM usuario WHERE usuario.Dni ='$DNIU' ");

                $consulta3->execute(array());
                $usuario3 = $consulta3->fetch();
            }


            echo "<tr><th>DNI</th><td>". $usuario['Dni'] ."</td></tr>";
            echo "<tr><th>Nombre</th><td>" . $usuario['Nombre'] ."</td></tr>";
            echo "<tr><th>Apellidos</th><td>" . $usuario['Apellidos'] ."</td></tr>";
            echo "<tr><th>Sexo</th><td>" . $usuario['Sexo'] ."</td></tr>";
            echo "<tr><th>Fecha Nacimiento</th><td>" . $usuario['Fechanacimiento'] . "</td></tr>";
            echo "<tr><th>Email</th><td>" . $usuario['Email'] . "</td></tr>";
            if(isset($usuario2['Dniu'])){
                echo "<tr><th>Pacientes</th><td>" . $usuario3['Nombre'] . " " . $usuario3['Apellidos'] . "</td></tr>";
            }
            ?>
            
        </table>
    </div>
     
            <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>