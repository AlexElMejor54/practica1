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
    $db = new Database();
    $pdo = $db->getConexion();

    if (isset($_GET['id']) && $_GET['id'] !== '') {
        $id = (int) $_GET['id'];
        if ($id <= 0) {
            echo json_encode([
                'success' => false,
                'message' => 'El id debe ser un número positivo',
                'data' => null
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

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
        echo json_encode([
            'success' => true,
            'message' => 'Alumno encontrado',
            'data' => $user->toArray()
        ], JSON_UNESCAPED_UNICODE);
    } else {
        $stmt = $pdo->query("SELECT * FROM alumno ORDER BY id");
        $lista = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lista[] = filaAUser($fila)->toArray();
        }
        echo json_encode([
            'success' => true,
            'message' => 'Lista de alumnos',
            'data' => $lista
        ], JSON_UNESCAPED_UNICODE);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
        'data' => null
    ], JSON_UNESCAPED_UNICODE);
}
