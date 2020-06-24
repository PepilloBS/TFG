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
    <?php
        require("../basedatos.php");
        session_start();

        $num=$_SESSION['num'];
        $DNIUsuario=$_SESSION['dni_facultativo'];
    ?>

    <!-- La principal función de esta interfaz es mostrar una lista de pacientes a cargo del propio facultativo -->


    <body>
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
                <h1>Lista Pacientes</h1>
            </div> 
        </div>   

    <table>       
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>Fecha de Nacimiento</th>
            <th>Email</th>
            <th><a href='introducirPaciente.php'><input type=button value='Introducir nuevo paciente'></a></th>
        </tr>

        <?php
        $_SESSION['dni_paciente']="";

        function conexion_mysqli(){
            return mysqli_connect('localhost','root','','constantesvitalesbd');
        }
        $conexion=conexion_mysqli();

        $consulta=mysqli_query($conexion, "SELECT u.* FROM usuario u, tablaunion t WHERE u.Dni=t.Dniu AND t.Dnif='$DNIUsuario'");

        while($data= mysqli_fetch_array($consulta)){
        ?>

               
        <tr>
            <th><?php echo $data['Nombre'] ?></th>
            <th><?php echo $data['Apellidos'] ?></th>
            <th><?php echo $data['Dni'] ?></th>
            <th><?php echo $data['Fechanacimiento'] ?></th>
            <th><?php echo $data['Email'] ?></th>

            <?php
            echo "<th><a href='interfazCVpacientes.php?DNI=".$data['Dni']."'><input type=button value=CV></a></th>";
            $_SESSION[$data['Dni']]=$data['Dni'];
            ?>
        </tr>
        
        <?php
        }
        ?>
        </table>
            <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>