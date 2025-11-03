


<?php

$host = "localhost"; // o la dirección de tu servidor
$user = "root";
$pass = "";
$dbname = "universidad";

try {
    //nuevo objeto pdo
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    //función setattribute sobre pdo
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}

$sql  = "SELECT dni,apellido_1,apellido_2,nombre,direccion,localidad,provincia,fecha_nacimiento FROM alumnos limit 5";
$consulta = $pdo->prepare($sql);
$consulta->execute();
$contador = 0;

while($row = $consulta->fetch()){
     
    $contador++;
}

/*
$salida[0]["key"]="win11";
$salida[0]["value"]="windows11";

$salida[1]["key"]="win12";
$salida[1]["value"]="windows12";
*/


echo json_encode($salida);




?>
