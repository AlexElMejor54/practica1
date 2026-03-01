<?php

require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/User.php';

header('Content-Type: application/json; charset=utf-8');

function filaAUser($fila)
{
    return new User(
        $fila['nombre'],
        $fila['apellidos'],
        $fila['password'],
        $fila['telefono'],
        $fila['email'],
        $fila['sexo'],
        $fila['id']
    );
}

try {
    if (!isset($_GET['id']) || $_GET['id'] === '') {
        echo json_encode([
            'success' => false,
            'message' => 'Falta el parámetro id',
            'data' => null
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $id = (int) $_GET['id'];
    if ($id <= 0) {
        echo json_encode([
            'success' => false,
            'message' => 'El id debe ser un número positivo',
            'data' => null
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $datos = [
        'nombre' => isset($_POST['nombre']) ? trim($_POST['nombre']) : '',
        'apellidos' => isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '',
        'password' => isset($_POST['password']) ? trim($_POST['password']) : '',
        'telefono' => isset($_POST['telefono']) ? trim($_POST['telefono']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'sexo' => isset($_POST['sexo']) ? trim($_POST['sexo']) : ''
    ];

    $db = new Database();
    $pdo = $db->getConexion();

    $stmt = $pdo->prepare("SELECT * FROM alumno WHERE id = ?");
    $stmt->execute([$id]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$fila) {
        echo json_encode([
            'success' => false,
            'message' => 'No se encontró ningún alumno con ese id',
            'data' => null
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $campos = [];
    $valores = [];

    if ($datos['nombre'] !== '') {
        $campos[] = 'nombre = ?';
        $valores[] = $datos['nombre'];
    }
    if ($datos['apellidos'] !== '') {
        $campos[] = 'apellidos = ?';
        $valores[] = $datos['apellidos'];
    }
    if ($datos['password'] !== '') {
        $campos[] = 'password = ?';
        $valores[] = $datos['password'];
    }
    if ($datos['telefono'] !== '') {
        $campos[] = 'telefono = ?';
        $valores[] = $datos['telefono'];
    }
    if ($datos['email'] !== '') {
        $campos[] = 'email = ?';
        $valores[] = $datos['email'];
    }
    if ($datos['sexo'] !== '') {
        $campos[] = 'sexo = ?';
        $valores[] = $datos['sexo'];
    }

    if (count($campos) > 0) {
        $valores[] = $id;
        $sql = "UPDATE alumno SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($valores);
    }

    $stmt = $pdo->prepare("SELECT * FROM alumno WHERE id = ?");
    $stmt->execute([$id]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    $user = filaAUser($fila);

    echo json_encode([
        'success' => true,
        'message' => 'Alumno modificado correctamente',
        'data' => $user->toArray()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
        'data' => null
    ], JSON_UNESCAPED_UNICODE);
}
