<?php
include_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['noticia_id']) &&
    isset($_POST['usuario_id']) &&
    isset($_POST['comentario'])
) {
    $noticia_id = intval($_POST['noticia_id']);
    $usuario_id = intval($_POST['usuario_id']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    // Validar que el usuario exista
    $usuario_check = $conn->query("SELECT id FROM usuarios WHERE id = $usuario_id LIMIT 1");
    if (!$usuario_check || $usuario_check->num_rows === 0) {
        echo json_encode(['success' => false, 'msg' => 'Usuario no válido.']);
        exit;
    }
    if (strlen($comentario) < 2) {
        echo json_encode(['success' => false, 'msg' => 'El comentario es muy corto.']);
        exit;
    }
    $conn->query("INSERT INTO comentarios (noticia_id, usuario_id, comentario) VALUES ($noticia_id, $usuario_id, '$comentario')");
    echo json_encode(['success' => true]);
    exit;
}
echo json_encode(['success' => false, 'msg' => 'Datos incompletos']);
