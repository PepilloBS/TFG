    <!-- La principal función de esta interfaz será la conexión a la base de datos -->


<?php
    $servidor = 'localhost';
    $nombrebasedatos = 'constantesvitalesbd';
    $usuario = 'root';

    try{
        $conectarBD=new PDO("mysql:host=$servidor; dbname=$nombrebasedatos", $usuario, '');
    }
    catch(PDOException $e){
        echo "Error de conexion:" . $e->getMessage();
    }

?>