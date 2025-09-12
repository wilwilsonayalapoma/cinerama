<?php
// comentarios.php - API para CRUD de comentarios
header('Content-Type: application/json');
require_once __DIR__ . '/conexion.php';

$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'listar';

switch($accion) {
  case 'listar':
    $res = $conn->query("SELECT c.id, c.noticia_id, n.titulo as noticia, c.usuario_id, u.nombre as usuario, c.comentario, c.fecha FROM comentarios c LEFT JOIN noticias n ON c.noticia_id = n.id LEFT JOIN usuarios u ON c.usuario_id = u.id ORDER BY c.id DESC");
    $comentarios = [];
    while($row = $res->fetch_assoc()) {
      $comentarios[] = $row;
    }
    echo json_encode($comentarios);
    break;
  case 'crear':
    $noticia_id = $_POST['noticia_id'] ?? '';
    $usuario_id = $_POST['usuario_id'] ?? '';
    $comentario = $_POST['comentario'] ?? '';
    if($noticia_id && $comentario) {
      $stmt = $conn->prepare("INSERT INTO comentarios (noticia_id, usuario_id, comentario) VALUES (?, ?, ?)");
      $stmt->bind_param('iis', $noticia_id, $usuario_id, $comentario);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'editar':
    $id = $_POST['id'] ?? '';
    $comentario = $_POST['comentario'] ?? '';
    if($id && $comentario) {
      $stmt = $conn->prepare("UPDATE comentarios SET comentario=? WHERE id=?");
      $stmt->bind_param('si', $comentario, $id);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'eliminar':
    $id = $_POST['id'] ?? '';
    if($id) {
      $stmt = $conn->prepare("DELETE FROM comentarios WHERE id=?");
      $stmt->bind_param('i', $id);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  default:
    echo json_encode([]);
}
?>
