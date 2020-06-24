<!-- La principal función de esta interfaz es mostrar la gráfica de tensión arterial correctamente -->

<?php
    session_start();
    function conexion_mysqli(){
        return mysqli_connect('localhost','root','','constantesvitalesbd');
    }
    $conexion=conexion_mysqli();
    $DNIUsuario=$_SESSION['dni_paciente'];
    


    $consulta="SELECT Tensionalta, TensionBaja,Toma, Ubicacion FROM valortension WHERE valortension.Dni = '$DNIUsuario' ORDER BY Toma";
    $valoresTension=mysqli_query($conexion,$consulta);
    $tensionalta=array();
    $tensionbaja=array();
    $tiempo=array();
    $ubicacion=array();

    while($fila=mysqli_fetch_row($valoresTension)){
        $tensionalta[]=$fila[0];
        $tensionbaja[]=$fila[1];
        $tiempo[]=$fila[2];
        $ubicacion[]=$fila[3];
    }

    $tensionalta=json_encode($tensionalta);
    $tensionbaja=json_encode($tensionbaja);
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

    ejeTensionAlta=array2json('<?php echo $tensionalta ?>');
    ejeTensionBaja=array2json('<?php echo $tensionbaja ?>');
    ejeTiempo=array2json('<?php echo $tiempo ?>');
    ejeUbicacion=array2json('<?php echo $ubicacion ?>');

    var grafica = {
        x: ejeTiempo,
        y: ejeTensionAlta,
        type: 'scatter',
        text:ejeUbicacion,
        name: 'Tensión sistólica'
    };

    var grafica2 = {
        x: ejeTiempo,
        y: ejeTensionBaja,
        type: 'scatter',
        text:ejeUbicacion,
        name: 'Tensión diastólica'
    };


    var graph = [grafica,grafica2];

    var layout = {
  title: '',
  xaxis: {
    title: 'Tiempo',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'Valor Tension (cm de Hg)',
    showline: false
  }
};

    Plotly.newPlot('graficaLineal', graph, layout);
</script>
