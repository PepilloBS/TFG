    <!-- La principal función de esta interfaz será cerrar la sesión en php y redirigir al usuario a la página de inicio -->

<?php
session_start();
session_destroy();
header("location:inicio.php");
?>