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

    <!-- La principal función de esta interfaz es mostrar todaslas notificaciones que posee el facultativo a través de una tabla -->


    <body>
        <?php
        session_start();
        require("../basedatos.php");

        $num=$_SESSION['num'];

        $DNIUsuario=$_SESSION['dni_facultativo'];
        $consulta = $conectarBD->prepare("SELECT * FROM notificaciones WHERE notificaciones.Dnif = '$DNIUsuario'");
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
                    <h1>Notificaciones</h1>
                </div>
            </div> 
        
        <table>
        <?php
        function conexion_mysqli(){
            return mysqli_connect('localhost','root','','constantesvitalesbd');
        }
        $conexion=conexion_mysqli();

        $consulta=mysqli_query($conexion, "SELECT * FROM notificaciones WHERE Dnif='$DNIUsuario'");

        while($data= mysqli_fetch_array($consulta)){
        ?>

               
        <tr>
            <th><?php echo $data['Fecha'] ?></th>
            <th><?php echo $data['Texto'] ?></th>
            <th><?php echo $data['Valor'] ?></th>
            <th><?php echo "<a href='eliminarnotificacion.php?FECHA=".$data['Fecha']."'><input type=button value=Eliminar></a>" ?></th>
        </tr> 
        <?php    
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