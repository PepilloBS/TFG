<!-- La principal función de esta interfaz es la creación de las gráfica de los valores de pulso cardíaco -->

<?php
    session_start();
    function conexion_mysqli(){
        return mysqli_connect('localhost','root','','constantesvitalesbd');
    }
    $conexion=conexion_mysqli();
    $DNIUsuario=$_SESSION['dni_usuario'];

    $consulta="SELECT Pulso,Toma,Ubicacion FROM valorpulso WHERE valorpulso.Dni = '$DNIUsuario' ORDER BY Toma";
    $valoresPulso=mysqli_query($conexion,$consulta);
    $pulso=array();
    $tiempo=array();
    $ubicacion=array();

    while($fila=mysqli_fetch_row($valoresPulso)){
        $pulso[]=$fila[0];
        $tiempo[]=$fila[1];
        $ubicacion[]=$fila[2];
    }

    $pulso=json_encode($pulso);
    $tiempo=json_encode($tiempo);
    $ubicacion=json_encode($ubicacion);
?>

<div id="graficaLineal"></div>

<script type="text/javascript">
    function array2json(json){
        var json_parse= JSON.parse(json);
        var array_final= [];
        for( var valor in json_parse){
            array_final.push(json_parse[valor]);
        }
        return array_final;
    }
</script>

<script type="text/javascript">

    ejePulso=array2json('<?php echo $pulso ?>');
    ejeTiempo=array2json('<?php echo $tiempo ?>');
    ejeUbicacion=array2json('<?php echo $ubicacion ?>');


    var grafica = {
        x: ejeTiempo,
        y: ejePulso,
        type: 'scatter',
        text: ejeUbicacion
    };

    var graph = [grafica];

    
    var layout = {
  title: '',
  xaxis: {
    title: 'Tiempo',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'Valor Pulso (ppm)',
    showline: false
  }
};

    Plotly.newPlot('graficaLineal', graph, layout);
</script>
