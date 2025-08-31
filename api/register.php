<?php
include_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['password'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol_id = 3; // Suscriptor por defecto
    $existe = $conn->query("SELECT id FROM usuarios WHERE correo='$correo' LIMIT 1");
    if ($existe && $existe->num_rows > 0) {
        echo json_encode(['success' => false, 'msg' => 'El correo ya está registrado']);
        exit;
    }
    $ok = $conn->query("INSERT INTO usuarios (nombre, correo, password, rol_id) VALUES ('$nombre', '$correo', '$password', $rol_id)");
    if ($ok) {
        echo json_encode(['success' => true]);
        exit;
    }
    echo json_encode(['success' => false, 'msg' => 'Error al registrar usuario']);
    exit;
}
echo json_encode(['success' => false, 'msg' => 'Datos incompletos']);
