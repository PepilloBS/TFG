<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="css/Inicio/estiloInicio.css" rel="stylesheet">

        <script src="push.js/push.min.js"></script>

    </head>

    <!-- La principal función de esta interfaz será hacer de login para cualquier tipo de usuario. 
    Para ello, se deberá introducir el email y contraseña que ha sido escrito en el registro y comprobar que dichos email y contraseña existen en la base de datos -->

    <body>
        <?php
        require("basedatos.php");
        ?>
        <div class="barra">
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="registro.php">Registro</a></li>
            </ul>
        </div>
        <div class="cuerpo">
            <div class="container">
                <div class="jumbotron">
                    <h1>Registro de usuario</h1>
                </div>
            </div> 
            <div class="panel">
                    <?php
                        if(isset($_POST['Email'])){
                            $Email=$_POST['Email'];
                            $Contrasena=$_POST['Contrasena'];

                            $consulta=$conectarBD->prepare("SELECT usuario.Dni, usuario.Contrasena FROM usuario WHERE usuario.Email ='$Email'");
                            $consulta->execute(array('Dni', 'Contrasena'));
                            $array1 = $consulta->fetch();    
                            
                            $consulta2=$conectarBD->prepare("SELECT facultativo.Dni, facultativo.Contrasena FROM facultativo WHERE facultativo.Email ='$Email'");
                            $consulta2->execute(array('Dni', 'Contrasena'));
                            $array2 = $consulta2->fetch();     
                            
                            
                            if($_POST['Email']=="" && $_POST['Contrasena']==""){
                            ?>

                                <script>
                                    Push.create("Notificacion emergente",{
                                        body: "Escribe un correo y una contraseña",
                                        icon: 'imagenes/alerta.jpg',
                                        timeout: 5000,
                                    });
                                </script>
                                
                            <?php 
                            }else if($_POST['Email']==""){
                                ?>

                                <script>
                                    Push.create("Notificacion emergente",{
                                        body: "Escribe un correo",
                                        icon: 'imagenes/alerta.jpg',
                                        timeout: 5000,
                                    });
                                </script>
                                
                            <?php 

                            }else if($_POST['Contrasena']==""){
                                ?>

                                <script>
                                    Push.create("Notificacion emergente",{
                                        body: "Escribe una contraseña",
                                        icon: 'imagenes/alerta.jpg',
                                        timeout: 5000,
                                    });
                                </script>
                                
                            <?php                                

                            }else if(isset($array1['Dni'])){                               
                                if(password_verify($Contrasena,$array1['Contrasena'])){
                                    session_start();
                                    $_SESSION['dni_usuario']=$array1['Dni'];
                                    header("Location:paciente/home.php");
                                }else{
                                ?>

                                <script>
;                                    Push.create("Notificacion emergente",{
                                        body: "Correo y contraseña incorrectos array1",
                                        icon: 'imagenes/alerta.jpg',
                                        timeout: 5000,
                                    });
                                </script>
                                
                            <?php 
                                }
                            }else if(isset($array2['Dni'])){                               
                                if(password_verify($Contrasena,$array2['Contrasena'])){
                                    session_start();
                                    $_SESSION['dni_facultativo']=$array2['Dni'];
                                    header("Location:facultativo/homeFacultativo.php");
                                }else{
                                ?>

                                <script>
                                    Push.create("Notificacion emergente",{
                                        body: "Correo y contraseña incorrectos",
                                        icon: 'imagenes/alerta.jpg',
                                        timeout: 5000,
                                    });
                                </script>
                                
                            <?php 
                                }
                            }
                        }
 
                    ?>
                    <form role="form" method="POST">
                        <table>
                            <tr><th> Introduce tu email y contraseña: </th></tr>
                            <tr><th>Email</th><td><input type = 'text' name = 'Email'></th></tr>
                            <tr><th>Contraseña</th><td><input type = 'password' name = 'Contrasena' ></th></tr>
                            <th><input type='reset' id='Restaurar' value='Restaurar'></th>
                            <th><input type='submit' id='Confirmar' value='Confirmar'></th>
                        </table>
                    </form>
            </div>
        </div>

        <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>