<!-- La principal función de esta interfaz es eliminar la notificación que el facultativo desee -->

<!DOCTYPE html>
<html>
    <?php 
        require("../basedatos.php");
        session_start();
        $DNIUsuario=$_SESSION['dni_facultativo'];
        $fecha=$_GET['FECHA'];

        $eliminar = $conectarBD->prepare("DELETE FROM notificaciones WHERE Dnif=? AND Fecha=?");
        $eliminar->execute( [$DNIUsuario, $fecha] );
        if($eliminar){
            header("Location:notificaciones.php");
            die;

        }

        echo  $texto;

    ?>
</html>