<?php
// usuario_crud.php - API para crear, editar y eliminar usuarios
require_once '../config/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $id = intval($_POST['id'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $rol_id = intval($_POST['rol_id'] ?? 2);
    $password = trim($_POST['password'] ?? '');

    if ($accion === 'crear') {
        if ($nombre && $correo && $password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nombre, correo, password, rol_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssi', $nombre, $correo, $hash, $rol_id);
            $ok = $stmt->execute();
            echo json_encode(['success' => $ok]);
            exit;
        }
    }
    if ($accion === 'editar') {
        if ($id && $nombre && $correo) {
            if ($password) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET nombre=?, correo=?, password=?, rol_id=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssii', $nombre, $correo, $hash, $rol_id, $id);
            } else {
                $sql = "UPDATE usuarios SET nombre=?, correo=?, rol_id=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssii', $nombre, $correo, $rol_id, $id);
            }
            $ok = $stmt->execute();
            echo json_encode(['success' => $ok]);
            exit;
        }
    }
    if ($accion === 'eliminar') {
        if ($id) {
            $sql = "DELETE FROM usuarios WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $ok = $stmt->execute();
            echo json_encode(['success' => $ok]);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'msg' => 'Acción inválida']);
exit;
?>
