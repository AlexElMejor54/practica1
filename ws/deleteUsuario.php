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

    $user = filaAUser($fila);

    $stmt = $pdo->prepare("DELETE FROM alumno WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode([
        'success' => true,
        'message' => 'Alumno eliminado correctamente',
        'data' => $user->toArray()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
        'data' => null
    ], JSON_UNESCAPED_UNICODE);
}
