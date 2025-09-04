<?php
include_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'], $_POST['correo'], $_POST['password'])) {
        $nombre = $conn->real_escape_string(trim($_POST['nombre']));
        $correo = $conn->real_escape_string(trim($_POST['correo']));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $rol_id = 3; // Suscriptor por defecto

        // Validar correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'msg' => 'Correo no válido']);
            exit;
        }

        // Verificar si el correo ya existe
        $existe = $conn->query("SELECT id FROM usuarios WHERE correo='$correo' LIMIT 1");
        if ($existe && $existe->num_rows > 0) {
            echo json_encode(['success' => false, 'msg' => 'El correo ya está registrado']);
            exit;
        }

        // Insertar usuario
        $ok = $conn->query("INSERT INTO usuarios (nombre, correo, password, rol_id) VALUES ('$nombre', '$correo', '$password', $rol_id)");

        if ($ok) {
            // Flag para frontend: mostrar mensaje de registro
            echo json_encode(['success' => true, 'msg' => '¡Registrado correctamente! Ahora inicia sesión.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'msg' => 'Error al registrar usuario']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'msg' => 'Datos incompletos']);
        exit;
    }
}

echo json_encode(['success' => false, 'msg' => 'Método no permitido']);
exit;
