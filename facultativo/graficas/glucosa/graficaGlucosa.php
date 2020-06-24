<!-- La principal función de esta interfaz es mostrar la gráfica de glucosa en sangre correctamente -->

<?php
    session_start();
    function conexion_mysqli(){
        return mysqli_connect('localhost','root','','constantesvitalesbd');
    }
    $conexion=conexion_mysqli();
    $DNIUsuario=$_SESSION['dni_paciente'];

    $consulta="SELECT Glucosa,Toma,Ubicacion FROM valorglucosa WHERE valorglucosa.Dni = '$DNIUsuario' ORDER BY Toma";
    $valoresGlucosa=mysqli_query($conexion,$consulta);
    $glucosa=array();
    $tiempo=array();
    $ubicacion=array();

    while($fila=mysqli_fetch_row($valoresGlucosa)){
        $glucosa[]=$fila[0];
        $tiempo[]=$fila[1];
        $ubicacion[]=$fila[2];
    }

    $glucosa=json_encode($glucosa);
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

    ejeGlucosa=array2json('<?php echo $glucosa ?>');
    ejeTiempo=array2json('<?php echo $tiempo ?>');
    ejeUbicacion=array2json('<?php echo $ubicacion ?>');

    var grafica = {
        x: ejeTiempo,
        y: ejeGlucosa,
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
    title: 'Valor Glucosa (mg/dl)',
    showline: false
  }
};

    Plotly.newPlot('graficaLineal', graph, layout);
</script>
