<?php
// categorias.php - API para CRUD de categorías
header('Content-Type: application/json');
require_once __DIR__ . '/conexion.php';

$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'listar';

switch($accion) {
  case 'listar':
    $res = $conn->query("SELECT id, nombre, color FROM categorias ORDER BY id ASC");
    $categorias = [];
    while($row = $res->fetch_assoc()) {
      $categorias[] = $row;
    }
    echo json_encode($categorias);
    break;
  case 'crear':
    $nombre = $_POST['nombre'] ?? '';
    $color = $_POST['color'] ?? '';
    if($nombre && $color) {
      $stmt = $conn->prepare("INSERT INTO categorias (nombre, color) VALUES (?, ?)");
      $stmt->bind_param('ss', $nombre, $color);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'editar':
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $color = $_POST['color'] ?? '';
    if($id && $nombre && $color) {
      $stmt = $conn->prepare("UPDATE categorias SET nombre=?, color=? WHERE id=?");
      $stmt->bind_param('ssi', $nombre, $color, $id);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'eliminar':
    $id = $_POST['id'] ?? '';
    if($id) {
      $stmt = $conn->prepare("DELETE FROM categorias WHERE id=?");
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
