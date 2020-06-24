<!DOCTYPE html>
<html>
<head>
    <title>Valores Glucosa</title>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/plotly.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.css">     
    <!--Estilo-->
    <link href="../../css/Paciente/grafica.css" rel="stylesheet">   

</head>

    <!-- La principal función de esta interfaz es colocar la gráfica de oxígeno en sangre correctamente -->


<body>  
    <div class="barra">
        <ul>
            <li><a href='../../paciente/home.php'>Inicio</a></li>
            <li><a href='../../paciente/interfazperfil.php'>Perfil</a></li>
            <li><a href='../../paciente/interfazcv.php'>Mis Constantes Vitales</a></li>
            <li><a href='#informacion'>Informacion</a></li>
            <li><a href='../../desconectar.php'>Salir</a></li>
        </ul>
    </div>
    <div class="container">
            <div class="jumbotron">
                <h1 id="perfil">Valores de Oxígeno en Sangre</h1>
            </div> 
        </div>  

        <div id="Grafico">
    </div>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#Grafico').load('graficaOxigeno.php');
    });
</script>