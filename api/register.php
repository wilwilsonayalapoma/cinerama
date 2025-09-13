<?php
// register.php - VERSIÓN SIMPLIFICADA

// Limpiar buffer de salida
while (ob_get_level()) ob_end_clean();

// Headers primero
header('Content-Type: application/json; charset=utf-8');

// Incluir conexión
include_once __DIR__ . '/../config/db.php';

// Verificar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '{"success": false, "msg": "Método no permitido"}';
    exit;
}

// Verificar campos
if (!isset($_POST['nombre'], $_POST['correo'], $_POST['password'])) {
    echo '{"success": false, "msg": "Datos incompletos"}';
    exit;
}

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$password = $_POST['password'];

// Validaciones
if (empty($nombre) || empty($correo) || empty($password)) {
    echo '{"success": false, "msg": "Todos los campos son obligatorios"}';
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '{"success": false, "msg": "Correo electrónico no válido"}';
    exit;
}

if (strlen($password) < 6) {
    echo '{"success": false, "msg": "La contraseña debe tener al menos 6 caracteres"}';
    exit;
}

// Procesar registro
$nombre = $conn->real_escape_string($nombre);
$correo = $conn->real_escape_string($correo);
$password_hashed = password_hash($password, PASSWORD_DEFAULT);
$rol_id = 3;

// Verificar si existe
$check = $conn->query("SELECT id FROM usuarios WHERE correo = '$correo' LIMIT 1");
if ($check && $check->num_rows > 0) {
    echo '{"success": false, "msg": "El correo electrónico ya está registrado"}';
    exit;
}

// Insertar
$insert = $conn->query("INSERT INTO usuarios (nombre, correo, password, rol_id) 
                       VALUES ('$nombre', '$correo', '$password_hashed', $rol_id)");

if ($insert) {
    echo '{"success": true, "msg": "¡Registro exitoso! Ahora puedes iniciar sesión"}';
} else {
    echo '{"success": false, "msg": "Error en el servidor"}';
}

$conn->close();
exit;