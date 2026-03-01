<?php

require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/User.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';

    if ($nombre === '' || $apellidos === '' || $password === '' || $telefono === '' || $email === '' || $sexo === '' || $fecha_nacimiento === '') {
        echo json_encode([
            'success' => false,
            'message' => 'Todos los campos son obligatorios',
            'data' => null
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $user = new User($nombre, $apellidos, $password, $telefono, $email, $sexo);

    $db = new Database();
    $pdo = $db->getConexion();

    $stmt = $pdo->prepare(
        "INSERT INTO alumno (nombre, apellidos, password, telefono, email, sexo, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([$nombre, $apellidos, $password, $telefono, $email, $sexo, $fecha_nacimiento]);

    if ($stmt->rowCount() !== 1) {
        echo json_encode([
            'success' => false,
            'message' => 'No se insertó el registro en la base de datos',
            'data' => null
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $user->setId((int) $pdo->lastInsertId());

    echo json_encode([
        'success' => true,
        'message' => 'Alumno creado correctamente',
        'data' => $user->toArray()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
        'data' => null
    ], JSON_UNESCAPED_UNICODE);
}
