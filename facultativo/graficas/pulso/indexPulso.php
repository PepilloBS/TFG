<!DOCTYPE html>
<html>
<head>
    <title>Valores Pulso</title>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/plotly.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.css">     
    <!--Estilo-->
    <link href="../../../css/Facultativo/grafica.css" rel="stylesheet">   

</head>

    <!-- La principal función de esta interfaz es mostrar la gráfica de pulso cardíaco correctamente -->


<body>  
    <div class="barra">
        <ul>             
                <li><a href='../../homeFacultativo.php'>Inicio</a></li>
                <li><a href='../../interfazperfil.php'>Perfil</a></li>
                <li><a href='../../interfazPacientes.php'>Constantes Vitales Pacientes</a></li>
                <li><a href='#informacion'>Informacion</a></li>
                <li><a href='../../desconectar.php'>Salir</a></li>
                <li><a href='../../notificaciones.php'>Notificaciones </a></li>               
        </ul>
    </div>
    <div class="container">
            <div class="jumbotron">
                <h1 id="perfil">Valores Pulso Cardíaco</h1>
            </div> 
        </div>  

    <div id="Grafico">
    </div>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#Grafico').load('graficaPulso.php');
    });
</script>