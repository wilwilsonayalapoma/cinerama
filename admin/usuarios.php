<?php
// usuarios.php - API para obtener listado de usuarios
require_once '../config/db.php';
header('Content-Type: application/json');

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

function respuesta($success, $message = '', $extra = []) {
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $extra));
    exit;
}

if ($accion === 'crear') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol_id = $_POST['rol_id'] ?? '';
    if (!$nombre || !$correo || !$rol_id) respuesta(false, 'Faltan datos obligatorios');
    if (!$password) respuesta(false, 'La contraseña es obligatoria');
    $hash = password_hash($password, PASSWORD_DEFAULT);
    require '../config/db.php';
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, rol_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('sssi', $nombre, $correo, $hash, $rol_id);
    if ($stmt->execute()) {
        respuesta(true, 'Usuario creado');
    } else {
        respuesta(false, 'Error al crear usuario');
    }
    $stmt->close();
    $conn->close();
} elseif ($accion === 'editar') {
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol_id = $_POST['rol_id'] ?? '';
    if (!$id || !$nombre || !$correo || !$rol_id) respuesta(false, 'Faltan datos obligatorios');
    require '../config/db.php';
    if ($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, correo=?, password=?, rol_id=? WHERE id=?");
        $stmt->bind_param('sssii', $nombre, $correo, $hash, $rol_id, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, correo=?, rol_id=? WHERE id=?");
        $stmt->bind_param('ssii', $nombre, $correo, $rol_id, $id);
    }
    if ($stmt->execute()) {
        respuesta(true, 'Usuario actualizado');
    } else {
        respuesta(false, 'Error al actualizar usuario');
    }
    $stmt->close();
    $conn->close();
} elseif ($accion === 'eliminar') {
    $id = $_POST['id'] ?? '';
    if (!$id) respuesta(false, 'ID faltante');
    require '../config/db.php';
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id=?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        respuesta(true, 'Usuario eliminado');
    } else {
        respuesta(false, 'Error al eliminar usuario');
    }
    $stmt->close();
    $conn->close();
} else {
    // Listar usuarios
    require '../config/db.php';
    $sql = "SELECT id, nombre, correo, rol_id FROM usuarios ORDER BY id DESC";
    $res = $conn->query($sql);
    $usuarios = [];
    while ($row = $res->fetch_assoc()) {
        $usuarios[] = $row;
    }
    $conn->close();
    echo json_encode($usuarios);
}
?>
