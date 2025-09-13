<?php
include_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['noticia_id']) &&
    isset($_POST['usuario_id'])
) {
    $noticia_id = intval($_POST['noticia_id']);
    $usuario_id = intval($_POST['usuario_id']);
    // Validar que el usuario exista
    $usuario_check = $conn->query("SELECT id FROM usuarios WHERE id = $usuario_id LIMIT 1");
    if (!$usuario_check || $usuario_check->num_rows === 0) {
        echo json_encode(['success' => false, 'msg' => 'Usuario no válido.']);
        exit;
    }
    $existe = $conn->query("SELECT id FROM destacados WHERE noticia_id=$noticia_id AND usuario_id=$usuario_id LIMIT 1");
    if ($existe && $existe->num_rows == 0) {
        $conn->query("INSERT INTO destacados (noticia_id, usuario_id) VALUES ($noticia_id, $usuario_id)");
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'msg' => 'Ya has destacado esta noticia.']);
    }
    exit;
}
echo json_encode(['success' => false, 'msg' => 'Datos incompletos']);
