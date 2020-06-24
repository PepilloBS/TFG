<?php 
require("../../basedatos.php");
session_start();
$DNIUsuario=$_SESSION['dni_usuario'];
$ubicacion=$_SESSION['ubicacion'];
$insertar = $conectarBD->prepare('INSERT INTO valorpulso(
    Pulso,Dni,Toma,Ubicacion) VALUES(
    :Pulso,:Dni, :Toma,:Ubicacion)'
    );
$horaToma=date("Y-m-d H:i:s");
$ok_m = $insertar->execute(array('Pulso' => $_GET['heartRate'],'Dni' => $DNIUsuario,'Toma' => $horaToma, 'Ubicacion'=>$ubicacion));


$consulta= $conectarBD-> prepare("SELECT * FROM limites WHERE Dniu='$DNIUsuario'");
$consulta->execute(array());
$lim=$consulta->fetch();

$consulta2= $conectarBD-> prepare("SELECT * FROM usuario WHERE Dni='$DNIUsuario'");
$consulta2->execute(array());
$usuario=$consulta2->fetch();
$nombre=$usuario['Nombre'];
$apellidos=$usuario['Apellidos'];


if($_GET['heartRate']> $lim['Limitepulsos']){
                                    
    $insertarnot = $conectarBD->prepare('INSERT INTO notificaciones(
        Dniu,Dnif,Fecha,Valor, Texto) VALUES(
        :Dniu, :Dnif,:Fecha, :Valor, :Texto)'
        );

    $ok_m1 = $insertarnot->execute(array(
        'Dniu' => $DNIUsuario,
        'Dnif' => $lim['Dnif'],
        'Fecha' => $horaToma,
        'Valor' => $_GET['heartRate'],
        'Texto' =>  "$nombre $apellidos ha superado el limite máximo en pulso cardíaco"
    ));

}

if($_GET['heartRate']< $lim['Limitepulsoi']){
    
    $insertarnot = $conectarBD->prepare('INSERT INTO notificaciones(
        Dniu,Dnif,Fecha,Valor, Texto) VALUES(
        :Dniu, :Dnif,:Fecha, :Valor, :Texto)'
        );

    $ok_m1 = $insertarnot->execute(array(
        'Dniu' => $DNIUsuario,
        'Dnif' => $lim['Dnif'],
        'Fecha' => $horaToma,
        'Valor' => $_GET['heartRate'],
        'Texto' =>  "$nombre $apellidos no ha superado el limite mínimo en pulso cardíaco"
    ));

}
?>
<script>
window.close();
</script>