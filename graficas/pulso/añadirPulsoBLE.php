<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--Bootstrap para CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Estilo-->
        <link href="../../css/Paciente/registro.css" rel="stylesheet">

        <script src="../../push.js/push.min.js"></script>

    </head>

    <!-- La principal función de esta interfaz la lectura de los valores de pulso cardíaco que genera el dispositivo por Bluetooth -->


    <body>
        <?php
        require("../../basedatos.php");
        session_start();
        $DNIUsuario=$_SESSION['dni_usuario'];
        ?>
        <div class="barra">
            <ul>
            <li><a href='../../paciente/home.php'>Inicio</a></li>
            <li><a href='../../paciente/interfazperfil.php'>Perfil</a></li>
            <li><a href='../../paciente/interfazcv.php'>Mis Constantes Vitales</a></li>
            <li><a href='#informacion'>Informacion</a></li>
            <li><a href='../../desconectar.php'>Salir</a></li>
            </ul>
        </div>
        <div class="cuerpo">
            <div class="container">
                <div class="jumbotron">
                    <h1>Introducir nuevo valor de pulso vía Bluetooth</h1>
                </div>
            </div> 
            <button>Añadir Valor Vía Bluetooth </button>
            <style>
                button {
                    margin-left: 40%;
                    margin-top: 10%;
                    width: 300px;
                    height: 100px;
                    text-decoration: underline;
                }
            </style>



        <!--Bootstrap para JS-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
        function onClick(){
  navigator.bluetooth.requestDevice({
    filters: [{
      services: ['heart_rate'],
    }]
  }).then(device => device.gatt.connect())
  .then(server => server.getPrimaryService('heart_rate'))
  .then(service => {
    chosenHeartRateService = service;
    return Promise.all([
      service.getCharacteristic('heart_rate_measurement')
        .then(handleHeartRateMeasurementCharacteristic),
    ]);
  });
}

function handleHeartRateMeasurementCharacteristic(characteristic) {
  return characteristic.startNotifications()
  .then(char => {
    characteristic.addEventListener('characteristicvaluechanged',onHeartRateChanged);
  });
}

function onHeartRateChanged(event) {
  const characteristic = event.target;
  console.log(parseHeartRate(characteristic.value));
  
}

function parseHeartRate(data) {
  const flags = data.getUint8(0); 
  const result = [];
  const rate16Bits = flags & 0x1;
  let index = 1;
  if (rate16Bits) {
    result.heartRate = data.getUint16(index, /*littleEndian=*/true);
    index += 2;
    window.open("insertarPulsoBLE.php?heartRate="+ result.heartRate);
  } else {
    result.heartRate = data.getUint8(index);
    index += 1;
    window.open("insertarPulsoBLE.php?heartRate="+ result.heartRate);
  }
  return result;    
}


document.querySelector('button').addEventListener('click', function() {
        onClick();
    });
        </script>
            
    </body>
</html>



