<?php

require_once __DIR__ . '/models/User.php';


function post($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : null;
}

$nombre = post('nombre');
$apellidos = post('apellidos');
$contraseña = post('contraseña');
$telefono = post('telefono');
$email = post('email');
$sexo = post('sexo');


$required = ['nombre','apellidos','contraseña','telefono','email','sexo'];
foreach ($required as $r) {
    if (empty($_POST[$r])) {
        http_response_code(400);
        echo json_encode(['error' => "Campo $r es obligatorio"], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$user = new User($nombre, $apellidos, $contraseña, $telefono, $email, $sexo);


$storageFile = dirname(__DIR__) . '/usuarios.txt';
$line = $user->toJson() . PHP_EOL;
file_put_contents($storageFile, $line, FILE_APPEND | LOCK_EX);


header('Content-Type: application/json; charset=utf-8');
echo $user->toJson();

?>
